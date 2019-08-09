<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  $output = '';
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
  } else {
    $get_page = 1;
  }
  $user_role = '';
  $user_id = 0;
  if(isset($_POST['role'])) {
    $user_role = $_POST['role'];
  }
  if(isset($_POST['id'])) {
    $user_id = $_POST['id'];
  }
  if(isset($_POST['query'])) {
    $search = $_POST['query'];
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $number_of_user = mysqli_num_rows($result);
    $per_page = PERPAGE;
    $first_page_result = ($get_page - 1) * $per_page;
    $sql_search = "SELECT stories.*, categories.name AS cate_name 
      FROM stories INNER JOIN categories ON stories.category_id = categories.id 
      WHERE LOWER(title) LIKE '%{$search}%' LIMIT $first_page_result, $per_page";
    $search_result = mysqli_query($conn, $sql_search);
    if(mysqli_num_rows($search_result) > 0) {
      $output .= "
        <thead>
          <tr>
            <th>#</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Visibility</th>
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
          <td><strong>" . $i . "</strong></td>
          <td class=\"img-row\">
            <div class=\"img-wrapper\">
              <a href=\"#\">
                <img src=\"";
        if($row['thumbnail'] != '') {
          $output .= "../assets/upload/thumbnails/" . $row['thumbnail'];
        } else {
          $output .= '../assets/upload/no-image.png';
        }
        $output .= "\" class=\"img-raised\">
              </a>
            </div>
          </td>
          <td>";
        if($user_role === ADMIN) {
          $output .= "<a href=\"edit-post.php?id=" . $row['id'] . "\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
            <strong>" . $row['title'] . "</strong>
          </a>";
        } else {
          $output .= "<a href=\"";
          if($row['user_id'] == $user_id) {
            $output .= 'edit-post.php?id=' . $row['id'];
          } else {
            $output .= '';
          }
          $output .= "\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
            <strong>" . $row['title'] . "</strong>
          </a>";
        }
        $output .= "<td>" . $row['cate_name'] . "</td>
          <td>";
        if(strtolower($row['status']) == strtolower(PUBLISH)) {
          $output .= '<span class="label label-success">' . ucfirst($row['status']) . '</span>';
        } else if(strtolower($row['status']) == strtolower(DRAFT)) {
          $output .= '<span class="label label-danger">' . ucfirst($row['status']) . '</span>';
        } else if(strtolower($rowp['status']) == strtolower(BAN)) {
          $output .= '<span class="label label-warning">' . ucfirst($row['status']) . '</span>';
        }
        $output .= "</td>
          <td>";
        if(strtolower($row['visibility']) == strtolower(PRIVATEVIS)) {
          $output .= '<span class="label label-info">' . ucfirst($row['visibility']) . '</span>';
        } else if(strtolower($row['visibility']) == strtolower(PUBLICVIS)) {
          $output .= '<span class="label label-primary">' . ucfirst($row['visibility']) . '</span>';
        }
        $output .= '</td>';
        if($row['user_id'] == $user_id || strtolower($user_role) == ADMIN) {
          $output .= "<td class=\"td-actions\">
          <a href=\"#\" onClick=\"banPost(" . $row['id'] . ")\" class=\"btn-icon btn-icon-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ban\">
            <i class=\"ti-na\"></i>
          </a>
          <a href=\"#\" onClick=\"deletePost(" . $row['id'] . ")\" class=\"btn-icon btn-icon-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\">
            <i class=\"ti-trash\"></i>
          </a>
        </td>";
        } else {
          $output .= "<td>
              <a href=\"#\">No Action</a>
            </td>";
        }
      }
        $output .= "</tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Thumbnail</th>
              <th>Title</th>
              <th>Category</th>
              <th>Status</th>
              <th>Visibility</th>
              <th>Action</th>
            </tr>
          </tfoot>";
      echo $output;
    } else {
      echo '<h4>No records found!</h4>';
    }
  } else {
    $sql_search = "SELECT * FROM categories WHERE LOWER(name) LIKE '%$search%' LIMIT $first_page_result, $per_page";
  }
?>