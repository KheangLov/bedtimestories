<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  $cate = false;
  $page = false;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != strtolower(ADMIN)) {
    header("Location: index.php?permission=denied");
  }
  $error = '';
  $msg = '';
  $check_required = false;
  date_default_timezone_set('Asia/Bangkok');
  if(isset($_POST['add_user'])) {
    if($_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['email'] == '' || $_POST['password'] == '' || $_POST['con_password'] == '') {
      $check_required = true;
    } else {
      if(strlen($_POST['password']) >= 8) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $fullname = $firstname . $lastname;
        if(trim($_POST['password']) === trim($_POST['con_password'])) {
          $pass_exp = '';
          $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
          $gender = $_POST['gender'];
          $address = $_POST['address'];
          $phone = $_POST['phone'];
          $city = $_POST['city'];
          $country = $_POST['country'];
          $dob = $_POST['dob'];
          $status = $_POST['status'];
          $role = $_POST['role'];
          $about = $_POST['about'];
          $quote = $_POST['quote'];
          $pass_type = $_POST['password_types'];
          if($pass_type == 0) {
            $nom = $_POST['number_of_months'];
            $pass_exp = date('Y-m-d', strtotime("+" . $nom . " months"));
          }
          $created_date = date("Y-m-d h:i:s");
          $updated_date = date("Y-m-d h:i:s");
          $vkey = md5(time().$fullname);
          $sql = "SELECT * FROM users WHERE LOWER(fullname) = LOWER('$fullname') OR email = '$email'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) != 0) {
            $error = 'User already exist!';
          } else {
            if($role != '' && $status != '') {
              // $stmt = "INSERT INTO users(firstname, lastname, fullname, email, gender, password, phone, dob, 
              //     address, city, country, about, quote, role_id, status, 
              //     created_date, updated_date, vkey, verified, password_types, password_expired_date, expired) 
              //   VALUES('$firstname', '$lastname', '$fullname', '$email', '$gender', '$password', '$phone', '$dob', 
              //     '$address', '$city', '$country', '$about', '$quote', $role, '$status', 
              //     '$created_date', '$updated_date', '$vkey', 0, $pass_type, '$pass_exp', 0)";
              $stmt = "";
              if($pass_type == 0 && $pass_exp != "") {
                $stmt = "INSERT INTO users(firstname, lastname, fullname, email, gender, password, phone, dob, 
                    address, city, country, about, quote, role_id, status, 
                    created_date, updated_date, vkey, verified, password_types, password_expired_date, expired) 
                  VALUES('$firstname', '$lastname', '$fullname', '$email', '$gender', '$password', '$phone', '$dob', 
                    '$address', '$city', '$country', '$about', '$quote', $role, '$status', 
                    '$created_date', '$updated_date', '$vkey', 0, $pass_type, '$pass_exp', 0)";
              } else {
                $stmt = "INSERT INTO users(firstname, lastname, fullname, email, gender, password, phone, dob, 
                    address, city, country, about, quote, role_id, status, 
                    created_date, updated_date, vkey, verified, password_types, expired) 
                  VALUES('$firstname', '$lastname', '$fullname', '$email', '$gender', '$password', '$phone', '$dob', 
                    '$address', '$city', '$country', '$about', '$quote', $role, '$status', 
                    '$created_date', '$updated_date', '$vkey', 0, $pass_type, 0)";
              }
              if($stmt != "") {
                if($conn->query($stmt) === true) {
                  $to = $email;
                  $subject = 'Email verification';
                  $message = "<a href=\"http://bedtimestories.devs/verify.php?vkey={$vkey}\">Verify Account</a>";
                  $headers = "From: kheang015@gmail.com \r\n";
                  $headers .= "MIME-Version: 1.0 \r\n";
                  $headers .= "Content-type:text/html; charset=UTF-8 \r\n";
                  mail($to, $subject, $message, $headers);
                  $msg = 'New record created successfully';
                } else {
                  $error = "Error: " . $conn->error;
                }
              }
            } else {
              $error = "No default role and status!";
            }
          }
        } else {
          $error = 'Password and Confirmation Password are not the same please check again!';
        } 
      } else {
        $error = "Password length must be 8 characters long!";
      }
    }
  }
?>
    <!-- <h1 id="date_time"><?php // echo date('Y-m-d h:i:sa', strtotime("+3 months")); ?></h1> -->
    <h1 id="date_time"><?php // echo date('M d, Y H:i:s', strtotime("+12 months")); ?></h1>
    <!-- <h1 id="show_datetime"></h1> -->
    <input type="hidden" name="" id="show_datetime">
    <div class="content">
      <div class="row">
        <div class="col-sm-8">
          <div class="card card-info">
            <div class="card-header">
              <h4 class="header">Add User</h4>
              <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
              <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
            </div>
            <div class="card-body">
              <form action="new-user.php" method="post">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Firstname <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></label>
                      <input type="text" name="firstname" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Lastname <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></label>
                      <input type="text" name="lastname" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Email Address <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></label>
                      <input type="email" name="email" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Password <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></label>
                      <input type="password" name="password" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Confirm Password <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></label>
                      <input type="password" name="con_password" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="info-name">Password Types</label>
                      <select name="password_types" id="password_types" class="form-control">
                        <option value="0">Non-Life Time</option>
                        <option value="1">Life Time</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="info-name">Number of Months</label>
                      <select name="number_of_months" id="number_of_months" class="form-control">
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="info-name">Gender</label>
                      <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="info-name">Status</label>
                      <select name="status" class="form-control">
                        <option value="<?php echo ACTIVE; ?>"><?php echo ucfirst(ACTIVE); ?></option>
                        <option value="<?php echo INACTIVE; ?>"><?php echo ucfirst(INACTIVE); ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Role</label>
                      <select name="role" class="form-control">
                        <?php
                          $role_sql = "SELECT * FROM roles";
                          $role_result = mysqli_query($conn, $role_sql);
                          if(mysqli_num_rows($role_result) > 0) :
                            while($role = $role_result->fetch_assoc()) :
                        ?>
                              <option value="<?php echo $role['id'] ?>"><?php echo ucfirst($role['name']); ?></option>
                        <?php
                            endwhile;
                          endif;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Date of Birth</label>
                      <input type="date" name="dob" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="info-name">Address</label>
                      <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">City</label>
                      <input type="text" name="city" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Country</label>
                      <input type="text" name="country" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Phone</label>
                      <input type="text" name="phone" onkeypress="numberOnly(event)" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">About Me</label>
                      <textarea name="about" class="form-control" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Quote</label>
                      <textarea name="quote" class="form-control" rows="3"></textarea>
                      <div class="text-right btn-wrap">
                        <a href="" class="btn btn-danger btn-mar">Cancel</a>
                        <input type="submit" name="add_user" class="btn btn-primary btn-mar" value="Add">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php
  include "share/footer.inc.php";
?>