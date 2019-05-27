<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN || strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  if(isset($_GET['delete'])) {
    $cate_id = $_GET['delete'];
    $delete_sql = "DELETE FROM categories WHERE id = $cate_id";
    if($conn->query($delete_sql) === true) {
      header("Location: category.php?deleted=success");
    } else {
      header("Location: category.php?deleted=fail");
    }
  }
?>