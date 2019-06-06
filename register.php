<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
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
      $firstname = trim($_POST['firstname']);
      $lastname = trim($_POST['lastname']);
      $fullname = trim($_POST['firstname']) . trim($_POST['lastname']);
      $email = trim($_POST['email']);
      $gender = trim($_POST['gender']);
      if(trim($_POST['password']) === trim($_POST['confirm_pass'])) {
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $phone = trim($_POST['phone']);
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $about = $_POST['about'];
        $quote = $_POST['quote'];
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
        $sql = "SELECT * FROM users WHERE LOWER(fullname) = LOWER('$fullname')";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) != 0) {
          $error = 'User already exist!';
        } else {
          if($role != '' && $status != '') {
            $stmt = "INSERT INTO users(firstname, lastname, fullname, email, gender, password, phone, dob, address, city, country, about, quote, role_id, status, created_date, updated_date) 
            VALUES('$firstname', '$lastname', '$fullname', '$email', '$gender', '$password', '$phone', '$dob', '$address', '$city', '$country', '$about', '$quote', $role, '$status', '$created_date', '$updated_date')";
            if($conn->query($stmt) === true) {
              $msg = 'New record created successfully';
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
  <div class="container">
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
                      <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                      <input type="text" name="firstname" class="form-control input-lg" placeholder="First Name">
                    </div>
                    <div class="col-xs-6 col-half-padd-left">
                      <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                      <input type="text" name="lastname" class="form-control input-lg" placeholder="Last Name">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <?php echo $check_required== true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                  <input type="email" name="email" class="form-control input-lg" placeholder="Email">
                </div>
                <div class="form-group">
                  <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                  <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                  <input type="password" name="confirm_pass" class="form-control input-lg" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6 col-half-padd-right">
                      <select name="gender" class="form-control input-lg">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-half-padd-left">
                      <input type="date" name="dob" class="form-control input-lg">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="phone" class="form-control input-lg" onkeypress="numberOnly(event)" placeholder="Phone">
                </div>
                <div class="form-group">
                  <textarea name="address" cols="30" rows="3" placeholder="Address" class="form-control input-lg"></textarea>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6 col-half-padd-right">
                      <input type="text" name="city" placeholder="City" class="form-control input-lg">
                    </div>
                    <div class="col-xs-6 col-half-padd-left">
                      <input type="text" name="country" placeholder="Country" class="form-control input-lg">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="about" cols="30" rows="3" placeholder="About" class="form-control input-lg"></textarea>
                </div>
                <div class="form-group">
                  <input type="text" name="quote" class="form-control input-lg" placeholder="Quote">
                </div>
                <input type="submit" name="register" class="btn btn-default btn-lg btn-block btn-getstarted" value="Register">
                <div class="row">
                  <div class="col-sm-6">
                  </div>
                  <div class="col-sm-6">
                    <div class="register-wrapper text-right">
                      <a href="login.php" class="regi-link">Login</a>
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