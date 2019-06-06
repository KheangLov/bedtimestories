<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN && strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  if(isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $delete_sql = "DELETE FROM stories WHERE id = $post_id";
    if($conn->query($delete_sql) === true) {
      header("Location: post.php?deleted=success");
    } else {
      header("Location: post.php?deleted=fail");
    }
  } else if($_GET['ban']) {
    $post_id = $_GET['ban'];
    $ban_sql = "UPDATE stories SET status = 'ban' WHERE id = $post_id";
    if($conn->query($ban_sql) === true) {
      header("Location: post.php?banned=success");
    } else {
      header("Location: post.php?banned=fail");
    }
  }
?>