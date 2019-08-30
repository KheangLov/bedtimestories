<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN) {
    header("Location: index.php?permission=denied");
  }
  if(isset($_GET['delete'])) {
    $ptype_id = $_GET['delete'];
    $delete_sql = "DELETE FROM page_posts WHERE id = $ptype_id";
    if($conn->query($delete_sql) === true) {
      header("Location: pagepost.php?deleted=success");
    } else {
      header("Location: pagepost.php?deleted=fail");
    }
  }
?>