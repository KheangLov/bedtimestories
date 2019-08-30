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
    $sql_search = "SELECT * FROM categories WHERE LOWER(name) LIKE '%$search%' LIMIT $first_page_result, $per_page";
    $search_result = mysqli_query($conn, $sql_search);
    if(mysqli_num_rows($search_result) > 0) {
      $output .= "
        <thead>
          <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Description</th>
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
          <td><strong>" . $row['name'] . "</strong></td>
          <td>" . $row['description'] . "</td>";
        $output .= "<td class=\"td-actions\">
            <a href=\"category.php?id=" . $row['id'] . "\" class=\"btn-icon btn-icon-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">
              <i class=\"ti-pencil\"></i>
            </a>
            <a href=\"#\" onClick=\"deleteCate(" . $row['id'] . ")\" class=\"btn-icon btn-icon-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\">
              <i class=\"ti-trash\"></i>
            </a>
          </td>
        </tr>";
      }
        $output .= "</tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Description</th>
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