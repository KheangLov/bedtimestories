<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  if(isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id = $user_id";
    if($conn->query($delete_sql) === true) {
      header("Location: user.php?deleted=success");
    } else {
      header("Location: user.php?deleted=fail");
    }
  } else if($_GET['ban']) {
    $user_id = $_GET['ban'];
    $ban_sql = "UPDATE users SET status = LOWER('BAN') WHERE id = $user_id";
    if($conn->query($ban_sql) === true) {
      header("Location: user.php?banned=success");
    } else {
      header("Location: user.php?banned=fail");
    }
  }
?>