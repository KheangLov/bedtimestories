<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  ob_start();
  date_default_timezone_set('Asia/Bangkok');
  
  session_start();

  $data = ['email'];
  
  $error = '';
  $warning = '';
  $msg = '';
  
  $_SESSION['isLogin'] = false;

  if(isset($_GET['verified']) && $_GET['verified'] == 1) {
    $msg = 'Email have been verified, you may login anytime now!';
  } else {
    $error = "Can't verified your email, something went wrong!";
  }

  if(isset($_GET['permission']) && strtolower($_GET['permission']) === 'denied') {
    $warning = "You don't have permission!";
  }

  if(!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
  }

  if(isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    if(empty($email) && empty($pass)) {
      $error = "Please insert email and password!";
    }
    elseif(empty($email)) {
      $error = "Please insert email!";
    }
    elseif(empty($pass)) {
      $error = "Please insert password!";
    }
    else {
      $sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE email = '$email' AND status = 'active' LIMIT 1";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $data = $result->fetch_array();
        if(!empty($data['password_expired_date'])) {
          if(date('Y-m-d') >= $data['password_expired_date']) {
            $update = "UPDATE users SET expired = 1 WHERE id = {$data['id']}";
            if($conn->query($update)) {
              header("Location: password.php?id={$data['id']}");
            } else {
              $error = "Error: " . $conn->error;
            }
          }
        }
        if($data['verified'] == 1) {
          $_SESSION['user_id'] = (string)$data['id'];
          $_SESSION['name'] = $data['fullname'];
          $_SESSION['role_name'] = $data['role_name'];
          if(strtolower($data["status"]) != 'active') {
            $error = "Admin haven't give you a Login permission yet!";
          } else {
            if(password_verify($pass, trim($data['password']))) {
              $_SESSION['isLogin'] = true;
              $_SESSION['success_mess'] = true;
              header("Location: admin/index.php");
            } else {
              $error = 'Wrong password!';
            }
          }
        } else {
          $id = $data['id'];
          $vkey = md5(time().$data['fullname']);
          $update = "UPDATE users SET vkey = '$vkey', verified = 0 WHERE id = $id";
          if($conn->query($update)) {
            $to = $data['email'];
            $subject = 'Email verification';
            $message = "<a href=\"http://mybedtimestories.epizy.com/verify.php?vkey={$vkey}\">Verify Account</a>";
            $headers = "From: lovsokheang@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0 \r\n";
            $headers .= "Content-type:text/html; charset=UTF-8 \r\n";
            mail($to, $subject, $message, $headers);
            $msg = "Your email haven't verified yet, please check your email!";
          } else {
            $error = "Error: " . $conn->error;
          }
        }
      } else {
        $error = 'Wrong email or user is not Active, please contact Admin!';
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
  <div class="container con-wrapper">
    <div class="login-wrapper">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="card card-info">
            <div class="card-header text-center">
              <img src="assets/images/icon-logo.png" alt="bedtimestories" class="img-responsive img-login">
              <h4 class="header-login">Login</h4>
              <h4 class="text-danger"><?php echo $error; ?></h4>
              <h4 class="text-success"><?php echo $msg; ?></h4>
            </div>
            <div class="card-body">
              <form action="login.php" method="post">
                <div class="form-group">
                  <label class="info-name">Email</label>
                  <input type="email" name="email" class="form-control input-lg">
                </div>
                <div class="form-group password-wrap">
                  <label class="info-name">Password</label>
                  <input type="password" name="password" class="form-control input-lg">
                  <input type="checkbox" name="check" class="check-box"> Remember me
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <button class="btn btn-default btn-lg btn-block btn-getstarted" type="submit" name="login">
                        <i class="fa fa-sign-in"></i>
                        Login
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="register-wrapper text-left">
                        <a href="index.php" class="regi-link">Bedtimestories</a>
                        <a href="register.php" class="regi-link dis-flex">Register</a>
                    </div>
                  </div>
                  <div class="col-sm-6">
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