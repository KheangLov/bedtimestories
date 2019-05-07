<?php
  $servername = "localhost";
  $username = "bedtimestories";
  $password = "not4you";
  $dbname = "bedtimestories";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>