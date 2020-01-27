<?php
  $servername = "sql205.epizy.com";
  $username = "epiz_24437212";
  $password = "TyTkdEjA2R";
  $dbname = "epiz_24437212_bedtimestories";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>