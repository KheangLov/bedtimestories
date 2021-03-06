<?php
  include "../share/db-conn.inc.php";
  include "../share/constant.inc.php";
  session_start();
  $text = "";
  if($_SESSION['isLogin'] == true) {
    // if(!isset($_SESSION['access_token'])) {
    //   header("Location: ../login.php");
    //   // exit();
    // }
    $text = "Welcome to our homepage user: ";
  } else {
    $_SESSION['error'] = 'Please login first!';
    header("Location:../login.php");
  }
  // if(!isset($_SESSION['access_token'])) {
  //   header("Location:../login.php");
  // }
  // var_dump($_SESSION['isLogin']);
  // $_SESSION['isLogin'] == false;
  $userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo BEDTIMESTORIES; ?> - Admin Panel</title>
  <link rel="shortcut icon" href="../assets/images/icon-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/libraries/bootstrap3-editable/css/bootstrap-editable.css">
  <link rel="stylesheet" href="../assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/libraries/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="wrapper clearfix">
    <aside class="sidebar" id="sidebar-main">
      <div class="sidebar-header text-center">
        <img src="../assets/images/icon-logo.png" alt="" class="img-responsive img-display" id="sidebar-img">
        <h3 class="site-name" id="sidebar-title"><?php echo BEDTIMESTORIES; ?></h3>
      </div>
      <ul class="nav nav-menu">
        <li class="sidebar-li<?php echo $index === true ? ' active' : ''; ?>">
          <a href="index.php">
            <i class="fa fa-tachometer icon-script"></i>
            <div class="sidebar-text-link">Dashboard</div>
          </a>
        </li>
        <li class="sidebar-li<?php echo $profile === true ? ' active' : ''; ?>">
          <a href="profile.php">
            <i class="fa fa-user-circle icon-script"></i>
            <div class="sidebar-text-link">Profile</div>
          </a>
        </li>
        <?php
          if(strtolower($_SESSION['role_name']) == ADMIN) :
        ?>
            <li class="sidebar-li<?php echo $user === true ? ' active' : ''; ?>">
              <a href="user.php">
                <i class="fa fa-user icon-script"></i>
                <div class="sidebar-text-link">Users</div>
              </a>
            </li>
            <li class="sidebar-li<?php echo $page === true ? ' active' : ''; ?>">
              <a href="page.php">
                <i class="fa fa-columns icon-script"></i>
                <div class="sidebar-text-link">Pages</div>
              </a>
            </li>
        <?php    
          endif;
          if(strtolower($_SESSION['role_name']) == ADMIN || strtolower($_SESSION['role_name']) == AUTHOR) :
        ?>
            <li class="sidebar-li<?php echo $cate === true ? ' active' : ''; ?>">
              <a href="category.php">
                <i class="fa fa-table icon-script"></i>
                <div class="sidebar-text-link">Categories</div>
              </a>
            </li>
            <li class="sidebar-li<?php echo $post === true ? ' active' : ''; ?>">
              <a href="post.php">
                <i class="fa fa-pencil-square-o icon-script"></i>
                <div class="sidebar-text-link">Posts</div>
              </a>
            </li>
        <?php    
          endif;
        ?>
      </ul>
    </aside>
    <div class="main-wrapper" id="site-wrapper">
      <nav class="navbar navbar-default navbar-main">
        <div class="container-fluid">
          <div class="navbar-header">
            <div class="btn-toggle-sidebar" id="toggle-sidebar" onclick="btnSidebarToggleIn()">
              <i class="fa fa-bars"></i>
            </div>
            <div class="btn-toggle-sidebar btn-show-sidebar" id="long-sidebar" onclick="btnSidebarToggleOut()">
              <i class="fa fa-ellipsis-v"></i>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand float-left" href="#">
              <?php echo $index === true ? DASHBOARD : ($profile === true ? PROFILE : ($user === true ? USERS : ($post === true ? POSTS : ($cate === true ? CATEGORIES : ($page === true ? PAGES : ''))))); ?>
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
                  <li role="separator" class="divider no-margin"></li>
                  <?php
                    $get_user_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = $userId";
                    $get_user_result = mysqli_query($conn, $get_user_sql);
                    if(mysqli_num_rows($get_user_result) > 0) {
                      $get_user = $get_user_result->fetch_array();
                    }
                  ?>
                  <li><a href="profile.php"><?php echo ucfirst($get_user['fullname']); ?></a></li>
                  <li><a href=""><?php echo ucfirst($get_user['role_name']); ?></a></li>
                  <li><a href="../logout.php">Log Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>