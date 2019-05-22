<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  session_start();
  $text = "";
  if($_SESSION['isLogin'] == true) {
    $text = "Welcome to our homepage user: ";
  } else {
    $_SESSION['error'] = 'Please login first!';
    header("Location:../login.php");
  }
  $_SESSION['isLogin'] == false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
  <link rel="shortcut icon" href="../assets/images/icon-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="wrapper clearfix">
    <aside class="sidebar">
      <div class="sidebar-header text-center">
        <h3 class="site-name"><?php echo BEDTIMESTORIES; ?></h3>
      </div>
      <ul class="nav nav-menu">
        <li class="<?php echo $index === true ? 'active' : ''; ?>">
          <a href="index.php">
            <i class="fa fa-tachometer"></i>Dashboard
          </a>
        </li>
        <li class="<?php echo $profile === true ? 'active' : ''; ?>">
          <a href="profile.php">
            <i class="fa fa-user-circle"></i>Profile
          </a>
        </li>
        <li class="<?php echo $user === true ? 'active' : ''; ?>">
          <a href="user.php">
            <i class="fa fa-user"></i>Users
          </a>
        </li>
        <li class="<?php echo $post === true ? 'active' : ''; ?>">
          <a href="post.php">
            <i class="fa fa-pencil-square-o"></i>Posts
          </a>
        </li>
      </ul>
    </aside>
    <div class="main-wrapper">
      <nav class="navbar navbar-default navbar-main">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
              <?php echo $index === true ? DASHBOARD : ($profile === true ? PROFILE : ($user === true ? USERS : ($post === true ? POSTS : ''))); ?>
            </a>
          </div>
      
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu card card-navbar">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user fa-nav"></i>
                </a>
                <ul class="dropdown-menu card card-navbar">
                  <li><a href="../home.php"><strong>See Homepage</strong></a></li>
                  <li><a href=""><?php echo ucfirst($_SESSION['name']); ?></a></li>
                  <li><a href=""><?php echo ucfirst($_SESSION['role_name']); ?></a></li>
                  <li><a href="../logout.php">Log Out</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-right">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </nav>