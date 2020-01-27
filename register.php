<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  if($_SESSION['isLogin'] === true) {
    header("Location: admin/index.php?permission=denied");
  }
  $error = '';
  $msg = '';
  $check_required = false;
  if(isset($_POST['register'])) {
    if($_POST['firstname'] == '' && $_POST['lastname'] == '' && $_POST['email'] == '' && $_POST['password'] == '' && $_POST['confirm_pass'] == '') {
      $check_required = true;
    } else if($_POST['firstname'] == '') {
      $check_required = true;
    } else if($_POST['lastname'] == '') {
      $check_required = true;
    } else if($_POST['email'] == '') {
      $check_required = true;
    } else if($_POST['password'] == '') {
      $check_required = true;
    } else if($_POST['confirm_pass'] == '') {
      $check_required = true;
    } else {
      if(trim($_POST['password']) === trim($_POST['confirm_pass'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $fullname = trim($_POST['firstname']) . trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $gender = trim($_POST['gender']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $status = INACTIVE;
        $default_role = SUBSCRIBER;
        $role_sql = "SELECT * FROM roles WHERE LOWER(name) = '$default_role' LIMIT 1";
        $roles_result = mysqli_query($conn, $role_sql);
        if(mysqli_num_rows($roles_result) > 0) {
          $data = $roles_result->fetch_array();
          $role = $data["id"];
        }
        $created_date = date("Y-m-d h:i:s");
        $updated_date = date("Y-m-d h:i:s");
        $sql = "SELECT * FROM users WHERE LOWER(fullname) = LOWER('$fullname') OR email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) != 0) {
          $error = 'User already exist!';
        } else {
          if($role != '' && $status != '') {
            $vkey = md5(time().$fullname);
            $verified = 0;
            $stmt = "INSERT INTO users(firstname, lastname, fullname, email, gender, password, role_id, status, vkey, verified, created_date, updated_date) 
              VALUES('$firstname', '$lastname', '$fullname', '$email', '$gender', '$password', $role, '$status', '$vkey', $verified, '$created_date', '$updated_date')";
            if($conn->query($stmt)) {
              $to = $email;
              $subject = 'Email verification';
              $message = "<a href=\"http://bedtimestories.devs/verify.php?vkey={$vkey}\">Verify Account</a>";
              $headers = "From: kheang015@gmail.com \r\n";
              $headers .= "MIME-Version: 1.0 \r\n";
              $headers .= "Content-type:text/html; charset=UTF-8 \r\n";
              mail($to, $subject, $message, $headers);
              $msg = 'New record created, please check your email to verified!';
            } else {
              $error = "Error: " . $conn->error;
            }
          } else {
            $error = "No default role and status!";
          }
        }
      } else {
        $error = 'Wrong password confirmation!';
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
  <title><?php echo BEDTIMESTORIES . ' - ' . REGISTER; ?></title>
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container con-wrapper">
    <div class="login-wrapper">
      <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <div class="card card-info">
            <div class="card-header text-center">
              <img src="assets/images/icon-logo.png" alt="bedtimestories" class="img-responsive img-login">
              <h4 class="header-login">Register</h4>
              <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
              <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
            </div>
            <div class="card-body">
              <form action="register.php" method="post">
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6 col-half-padd-right">
                      <div class="row">
                        <div class="col-sm-6">
                          <label class="info-name">Firstname</label>
                        </div>
                        <div class="col-sm-6 text-right">
                          <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?>
                        </div>
                      </div>
                      <input type="text" name="firstname" class="form-control input-lg">
                    </div>
                    <div class="col-xs-6 col-half-padd-left">
                      <div class="row">
                        <div class="col-sm-6">
                          <label class="info-name">Lastname</label>
                        </div>
                        <div class="col-sm-6 text-right">
                          <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?>
                        </div>
                      </div>
                      <input type="text" name="lastname" class="form-control input-lg">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                      <label class="info-name">Email</label>
                    </div>
                    <div class="col-sm-6 text-right">
                      <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?>
                    </div>
                  </div>
                  <input type="email" name="email" class="form-control input-lg">
                </div>
                <div class="form-group">
                  <label class="info-name">Gender</label>
                  <select name="gender" class="form-control input-lg">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <label class="info-name">Password</label>
                    </div>
                    <div class="col-sm-6 text-right">
                      <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?>
                    </div>
                  </div>
                  <input type="password" name="password" class="form-control input-lg">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <label class="info-name">Confirm Password</label>
                    </div>
                    <div class="col-sm-6 text-right">
                      <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?>
                    </div>
                  </div>
                  <input type="password" name="confirm_pass" class="form-control input-lg">
                </div>
                <input type="submit" name="register" class="btn btn-default btn-lg btn-block btn-getstarted" value="Register">
                <div class="row">
                  <div class="col-sm-12">
                     <div class="register-wrapper text-left">
                      <a href="index.php" class="regi-link">Bedtimestories</a>
                      <a href="login.php" class="regi-link dis-flex">Login</a>
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