<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="shortcut icon" href="assets/images/icon-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <header class="masthead">
    <nav class="navbar navbar-default navbar-custom" data-spy="affix" data-offset-top="70">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php //echo $stories == true ? '../' : ''; ?>index.php" class="navbar-brand">
            <img src="<?php //echo $stories == true ? '../' : ''; ?>assets/images/icon-logo.png" alt="Bedtimestories" class="brand-image"> Bedtimestories
          </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php echo $home == true ? 'active' : ''; ?>">
            <a href="<?php //echo $stories == true ? '../' : ''; ?>home.php">Home</a>
          </li>
          <li class="<?php echo $index == true ? 'active' : ''; ?>">
            <a href="<?php //echo $stories == true ? '../' : ''; ?>index.php">Library</a>
          </li>
          <li class="<?php echo $about == true ? 'active' : ''; ?>">
            <a href="<?php //echo $stories == true ? '../' : ''; ?>aboutus.php">About Us</a>
          </li>
          <!-- <li class="btn-reg"><a href="register.php" class="bcolor">Register</a></li> -->
          <li class="btn-log"><a href="logout.php" class="bwhite">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>