<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  session_start();
  $error = '';
  $warning = '';
  $_SESSION['isLogin'] = false;

  if(isset($_GET['permission']) && strtolower($_GET['permission']) === 'denied') {
    $warning = "You don't have permission!";
  }

  if(!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
  }

  if(isset($_POST['login'])) {
    $name = trim($_POST['name']);
    $pass = trim($_POST['password']);
    if(empty($name) && empty($pass)) {
      $error = "Please insert username and password!";
    }
    elseif(empty($name)) {
      $error = "Please insert username!";
    }
    elseif(empty($pass)) {
      $error = "Please insert password!";
    }
    else {
      $sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(fullname) = LOWER('$name') LIMIT 1";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $data = $result->fetch_array();
        $_SESSION['user_id'] = (string)$data['id'];
        $_SESSION['name'] = $data['fullname'];
        $_SESSION['role_name'] = $data['role_name'];
        if(strtolower($data["status"]) != 'active') {
          $error = "Admin haven't give you a Login permission yet!";
        } else {
          if(password_verify($pass, trim($data['password']))) {
            $_SESSION['isLogin'] = true;
            $_SESSION['success_mess'] = true;
            header("Location:admin/index.php");
          } else {
            $error = 'Wrong password!';
          }
        }
      } else {
        $error = 'Wrong username!';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo BEDTIMESTORIES . ' - ' . LOGIN; ?></title>
  <link rel="shortcut icon" href="assets/images/icon-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <div class="login-wrapper">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="card card-info">
            <div class="card-header text-center">
              <img src="assets/images/icon-logo.png" alt="bedtimestories" class="img-responsive img-login">
              <h4 class="header-login">Login</h4>
              <h4 class="text-info"><?php echo $_SESSION['isLogin'] == false ? 'You have been logged out!' : ''; ?></h5>
              <h4 class="text-danger"><?php echo $error; ?></h5>
            </div>
            <div class="card-body">
              <form action="login.php" method="post">
                <div class="form-group">
                  <input type="text" name="name" class="form-control input-lg" placeholder="Username">
                </div>
                <div class="form-group password-wrap">
                  <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                  <input type="checkbox" name="check" class="check-box"> Remember me
                </div>
                <button class="btn btn-default btn-lg btn-block btn-getstarted" type="submit" name="login">Login</button>
                <div class="row">
                  <div class="col-sm-6">
                  </div>
                  <div class="col-sm-6">
                    <div class="register-wrapper text-right">
                      <a href="register.php" class="regi-link">Register</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="assets/libraries/jQuery/jquery.min.js"></script>
  <script src="assets/libraries/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>