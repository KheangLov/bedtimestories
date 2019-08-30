<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  date_default_timezone_set('Asia/Bangkok');
  ob_start();
  session_start();
  $error = '';
  $warning = '';
  $msg = '';
  $user_id = "";
  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
  }
  if(isset($_POST['submit'])) {
    $sql = "SELECT * FROM users WHERE id = {$user_id}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $data = $result->fetch_array();
      if(password_verify(trim($_POST['old_pass']), trim($data['password']))) {
        $new_pass = trim($_POST['new_pass']);
        $con_pass = trim($_POST['con_pass']);
        if($new_pass != $con_pass) {
          $error = "Wrong password confirmation!";
        } else {
          $pass = password_hash($new_pass, PASSWORD_DEFAULT);
          $nom = $_POST['number_of_months'];
          $pass_exp = date('Y-m-d', strtotime("+" . $nom . " months"));
          $update = "UPDATE users SET password = '{$pass}', 
            password_expired_date = '{$pass_exp}', 
            expired = 0 WHERE id = {$user_id}";
          if($conn->query($update)) {
            header("Location: login.php");
          } else {
            $error = "Error: " . $conn->error;
          }
        }
      } else {
        $error = "Wrong old password!";
      }
    } else {
      $error = "Can't fint user with id, #{$user_id}!";
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
              <h4 class="header-login">Password Form</h4>
              <h4 class="text-danger"><?php echo $error; ?></h4>
              <h4 class="text-success"><?php echo $msg; ?></h4>
            </div>
            <div class="card-body">
              <form action="password.php?id=<?php echo $user_id; ?>" method="post">
                <div class="form-group">
                  <label class="info-name">Old password</label>
                  <input type="password" name="old_pass" class="form-control input-lg">
                </div>
                <div class="form-group">
                  <label class="info-name">Number of Months</label>
                  <select name="number_of_months" id="number_of_months" class="form-control">
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="info-name">New password</label>
                  <input type="password" name="new_pass" class="form-control input-lg">
                </div>
                <div class="form-group">
                  <label class="info-name">Confirm password</label>
                  <input type="password" name="con_pass" class="form-control input-lg">
                </div>
                <button class="btn btn-default btn-lg btn-block btn-getstarted" type="submit" name="submit">Login</button>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="register-wrapper text-left">
                      <a href="login.php" class="regi-link">Login</a>
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