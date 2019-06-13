<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  $output = '';
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
  } else {
    $get_page = 1;
  }
  if(isset($_POST['query'])) {
    $search = $_POST['query'];
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $number_of_user = mysqli_num_rows($result);
    $per_page = PERPAGE;
    $first_page_result = ($get_page - 1) * $per_page;
    $sql_search = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(users.fullname) LIKE '%$search%' ORDER BY FIELD(roles.name, 'admin', 'author', 'subscriber') ASC, updated_date DESC LIMIT $first_page_result, $per_page";
    $search_result = mysqli_query($conn, $sql_search);
    if(mysqli_num_rows($search_result) > 0) {
      $output .= "
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
      ";
      $i = 0;
      while($row = $search_result->fetch_assoc()) {
        $i++;
        $output .= "
        <tr>
          <td>" . $i . "</td>
          <td><strong>" . ucfirst($row['fullname']) . "</strong></td>
          <td>" . $row['email'] . "</td>
          <td>";
          if(strtolower($row['status']) == ACTIVE) {
            $output .= '<span class="label label-success">'. ucfirst($row['status']) . '</span>';
          } elseif(strtolower($row['status']) == INACTIVE) {
            $output .= '<span class="label label-danger">' . ucfirst($row['status']) . '</span>';
          } elseif(strtolower($row['status']) == BAN) {
            $output .= '<span class="label label-warning">' . ucfirst($row['status']) . '</span>';
          } else {
            $output .= '';
          }
        $output .= "</td>
          <td><span class=\"label label-default\">" . ucfirst($row['role_name']) . "</span></td>
          <td class=\"td-actions\">
            <a href=\"show-user.php?id=" . $row['id'] . "\" class=\"btn-icon btn-icon-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View\">
              <i class=\"ti-image\"></i>
            </a>
            <a href=\"edit-user.php?id=" . $row['id'] . "\" class=\"btn-icon btn-icon-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
              <i class=\"ti-pencil\"></i>
            </a>
              ";
        if(strtolower($row['role_name']) != ADMIN || strtolower($row['status']) != strtolower(ACTIVE)) {
          if(strtolower($row['status']) == strtolower(ACTIVE)) {
            $output .=
                "
                    <a href=\"#\" onClick=\"banUser(" . $row['id'] . ")\" class=\"btn-icon btn-icon-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ban\">
                      <i class=\"ti-na\"></i>
                    </a>
                ";
          }
          $output .=
            "
              <a href=\"#\" onClick=\"deleteUser(" . $row['id'] . ")\" class=\"btn-icon btn-icon-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\">
                <i class=\"ti-close\"></i>
              </a>
            ";
        }
        $output .=
        "
          </td>
        </tr>
        ";
      }
      $output .= "</tbody>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Status</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </tfoot>";
      echo $output;
    } else {
      echo '<h4>No records found!</h4>';
    }
  } else {
    $sql_search = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id ORDER BY FIELD(roles.name, 'admin', 'author', 'subscriber') ASC, updated_date DESC LIMIT $first_page_result, $per_page";
  }
?>