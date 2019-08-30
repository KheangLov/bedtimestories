<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN && strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  if(isset($_GET['delete'])) {
    $img_id = $_GET['delete'];
    $delete_sql = "DELETE FROM images WHERE id = $img_id";
    if($conn->query($delete_sql) === true) {
      header("Location: images.php?deleted=success");
    } else {
      header("Location: images.php?deleted=fail");
    }
  }
?>