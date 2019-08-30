<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";

  if(isset($_GET['vkey'])) {
    $vkey = trim($_GET['vkey']);
    $sql = "SELECT verified, vkey FROM users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $update = "UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1";
      if($conn->query($update)) {
        header("Location: login.php?verified=1");
      } else {
        header("Location: login.php?verified=0");
      }
    } else {

    }
  } else {
    die("Something went wrong!");
  }
?>