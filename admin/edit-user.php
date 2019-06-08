<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  $cate = false;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != strtolower(ADMIN)) {
    header("Location: index.php?permission=denied");
  }
  $error = '';
  $msg = '';
  $profile = '';
  $pro_tmpname = '';
  $pro_des = '';
  $check_required = false;
  $user_id = null;
  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
  }
  $check_id_sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
  $check_id_result = mysqli_query($conn, $check_id_sql);
  if(mysqli_num_rows($check_id_result) != 0) {
    $user_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = $user_id";
    $user_result = mysqli_query($conn, $user_sql);
    if(mysqli_num_rows($user_result) > 0) {
      $data = $user_result->fetch_array();
    }
    if(isset($_POST['edit'])) {
      $firstname = trim($_POST['firstname']);
      $lastname = trim($_POST['lastname']);
      $fullname = $firstname . $lastname;
      $sql = "SELECT * FROM users WHERE LOWER(fullname) = LOWER('$fullname') AND id != $user_id";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $error = 'User already exist!';
      } else {
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $status = $_POST['status'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $about = $_POST['about'];
        $quote = $_POST['quote'];
        if($_FILES['profile']['name'] != '') {
          $profile = $_FILES['profile']['name'];
          $pro_tmpname = $_FILES['profile']['tmp_name'];
          $pro_des = "../assets/upload/profiles/" . $profile;
          if(move_uploaded_file($pro_tmpname, $pro_des)) {
            $msg = "Profile image have been upload successfully!";
          } else {
            $error = "There was an error while uploading profile image!";
          }
        }
        $updated_date = date("Y-m-d h:i:s");
        $update = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', fullname = '$fullname', email = '$email', image = '$profile', role_id = $role, gender = '$gender', dob = '$dob', status = '$status', address = '$address', city = '$city', country = '$country', phone = '$phone', about = '$about', quote = '$quote', updated_date = '$updated_date' WHERE id = $user_id";
        if($conn->query($update) === true) {
          header("Location: user.php?updated=success");
        } else {
          header("Location: user.php?updated=fail");
        }
      }
    }
    if(isset($_POST['change_password'])) {
      $old_password = trim($_POST['old_password']);
      if(password_verify($old_password, trim($data['password']))) {
        if(trim($_POST['password']) === trim($_POST['con_password'])) {
          $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
          $update_pass = "UPDATE users SET password = '$password' WHERE id = $user_id";
          if($conn->query($update_pass) === true) {
            $msg = 'Password have been changed!';
          } else {
            $error = 'Error updating password: ' . $conn->error;
          }
        } else {
          $error = 'Wrong password confirmation!';
        }
      } else {
        $error = 'Wrong old password!';
      }
    }
  } else {
    header("Location: user.php?user_id=wrong");
  }
?>

    <div class="content">
      <div class="row">
        <form action="edit-user.php?<?php echo "id=$user_id"; ?>" method="post">
          <div class="col-sm-8">
            <div class="card card-info">
              <div class="card-header">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#edit-user">Edit Profile</a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#edit-password">Change Password</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="tab-content">
                    <div class="tab-pane fade card-body in active" id="edit-user">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Firstname</label>
                          <input type="text" name="firstname" class="form-control" value="<?php echo $data['firstname']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Lastname</label>
                          <input type="text" name="lastname" class="form-control" value="<?php echo $data['lastname']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Email Address</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Role</label>
                          <?php
                            $count_admin_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'admin'";
                            $count_admin_result = mysqli_query($conn, $count_admin_sql);
                            $count_admin = $count_admin_result->fetch_array();
                            if($count_admin['count_user'] <= 1 && strtolower($data['role_name']) == ADMIN) :
                          ?>
                              <input type="text" name="role" class="form-control" value="<?php echo ucfirst($data['role_name']); ?>" disabled>
                          <?php
                            else :
                          ?>
                              <select name="role" class="form-control">
                                <?php
                                  $role_sql = "SELECT * FROM roles";
                                  $role_result = mysqli_query($conn, $role_sql);
                                  if(mysqli_num_rows($role_result) > 0) :
                                    while($role = $role_result->fetch_assoc()) :
                                ?>
                                      <option value="<?php echo $role['id'] ?>" <?php echo strtolower($data['role_name']) == strtolower($role['name']) ? 'selected' : ''; ?>><?php echo ucfirst($role['name']); ?></option>
                                <?php
                                    endwhile;
                                  endif;
                                ?>
                              </select>
                          <?php
                            endif;
                          ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Gender</label>
                          <select name="gender" class="form-control">
                            <option value="male" <?php echo strtolower($data['gender']) == 'male' ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo strtolower($data['gender']) == 'female' ? 'selected' : ''; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Date of Birth</label>
                          <input type="date" name="dob" class="form-control" value="<?php echo $data['dob']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Status</label>
                          <select name="status" class="form-control">
                            <option value="<?php echo ACTIVE; ?>" <?php echo strtolower($data['status']) == strtolower(ACTIVE) ? 'selected' : ''; ?>><?php echo ucfirst(ACTIVE); ?></option>
                            <option value="<?php echo INACTIVE; ?>" <?php echo strtolower($data['status']) == strtolower(INACTIVE) ? 'selected' : ''; ?>><?php echo ucfirst(INACTIVE); ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="info-name">Address</label>
                          <textarea name="address" class="form-control" rows="3"><?php echo $data['address']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">City</label>
                          <input type="text" name="city" class="form-control" value="<?php echo $data['city']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Country</label>
                          <input type="text" name="country" class="form-control" value="<?php echo $data['country']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Phone</label>
                          <input type="text" name="phone" class="form-control" onkeypress="numberOnly(event)" value="<?php echo $data['phone']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="info-name">About Me</label>
                          <textarea name="about" class="form-control" rows="3"><?php echo $data['about']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="info-name">Quote</label>
                          <textarea name="quote" class="form-control" rows="3"><?php echo $data['quote']; ?></textarea>
                          <div class="text-right btn-wrap">
                            <a href="user.php" class="btn btn-danger btn-mar">Cancel</a>
                            <input type="submit" name="edit" class="btn btn-info btn-mar" value="Edit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade card-body" id="edit-password">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="info-name">Old Password</label>
                          <input type="password" name="old_password" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="info-name">New Password</label>
                          <input type="password" name="password" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="info-name">Confirm Password</label>
                          <input type="password" name="con_password" class="form-control">
                          <div class="text-right btn-wrap">
                            <a href="user.php" class="btn btn-danger btn-mar">Cancel</a>
                            <input type="submit" name="change_password" class="btn btn-info btn-mar" value="Change Password">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card card-profile">
              <div class="card-body text-center">
                <div class="author">
                  <a href="#" class="profile-upload">
                    <img src="../assets/upload/profiles/<?php echo $data['image'] != '' ? $data['image'] : 'user-avatar-placeholder.png'; ?>" class="img-profile img-addit">
                  </a>
                  <div class="btn-profile-wrapper">
                    <input type="file" name="profile" id="profile-input" class="input-display">
                    <button type="button" id="profile-button" class="btn btn-default btn-upload-profile" data-toggle="tooltip" data-placement="top" title="Upload Profile"><i class="fa fa-camera icon-profile-upload"></i></button>
                  </div>
                  <span id="profile-text" class="file-text mar-top-bot">No file chosen!</span>
                  <!-- <input type="submit" name="add_profile" class="btn btn-primary btn-sm" value="Upload"> -->
                </div>
                <!-- <form action="edit-user.php?id=<?php // echo $user_id; ?>" method="post" enctype="multipart/form-data">
                </form> -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
<?php
  include "share/footer.inc.php";
?>