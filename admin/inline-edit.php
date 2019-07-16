<?php
  include "../share/db-conn.inc.php";
  if(isset($_POST)){
    $sql = "UPDATE users SET ".$_POST['name']."='".$_POST['value']."' WHERE id=".$_POST['pk'];
    $conn->query($sql);
    echo 'Updated successfully.';
  }
?>