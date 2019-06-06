<?php
  $profile = true;
  $index = false;
  $user = false;
  $post = false;
  $cate = false;
  include "share/header.inc.php";
  $username = $_SESSION['name'];
  $user_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(fullname) = LOWER('$username')";
  $user_result = mysqli_query($conn, $user_sql);
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
      $updated_date = date("Y-m-d h:i:s");
      $update = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', fullname = '$fullname', email = '$email', role_id = $role, gender = '$gender', dob = '$dob', status = '$status', address = '$address', city = '$city', country = '$country', phone = '$phone', about = '$about', quote = '$quote', updated_date = '$updated_date' WHERE id = $user_id";
      if($conn->query($update) === true) {
        header("Location: user.php?updated=success");
      } else {
        header("Location: user.php?updated=fail");
      }
    }
  }
?>

    <div class="content">
      <?php
        if(mysqli_num_rows($user_result) > 0) :
          $data = $user_result->fetch_array();
      ?>
          <form action="profile.php" method="post">
            <div class="row">
              <div class="col-sm-4">
                <div class="card card-profile">
                  <div class="image">
                    <img src="" alt="">
                  </div>
                  <div class="card-body text-center">
                    <div class="author">
                      <a href="#" class="profile-upload">
                        <img src="../assets/upload/profiles/<?php echo $data['image'] != '' ? $data['image'] : 'user-avatar-placeholder.png'; ?>" class="img-profile img-addit">
                        <p class="author-name"><?php echo ucfirst($data['firstname']) . ' ' . ucfirst($data['lastname']); ?></p>
                      </a>
                      <p class="slug"><?php echo '@' . $data['lastname']; ?></p>
                      <div class="btn-profile-wrapper" id="btn-upload-pro-img" hidden>
                        <input type="file" name="profile" id="profile-input" class="input-display">
                        <button type="button" id="profile-button" class="btn btn-default btn-upload-profile" data-toggle="tooltip" data-placement="top" title="Upload Profile"><i class="fa fa-camera icon-profile-upload"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center">
                    <hr>
                    <p class="text-profile">
                      <?php echo $data['quote'] != '' ? '"' . $data['quote'] . '"' : ''; ?>
                    </p>
                    <div class="form-group" id="quote-input" hidden>
                      <input type="text" name="quote" class="form-control" placeholder="Quote" value="<?php echo $data['quote'] != '' ? '"' . $data['quote'] . '"' : ''; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card card-info">
                  <div class="card-header">
                    <h4 class="header">User's Profile</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Username</label>
                          <input type="text" name="name" class="form-control" value="<?php echo ucfirst($data['fullname']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Email Address</label>
                          <input type="email" name="email" class="form-control input-rev-read" value="<?php echo $data['email']; ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Role</label>
                          <input type="text" name="role" class="form-control input-rev-read" id="pro-role-input" value="<?php echo ucfirst($data['role_name']); ?>" disabled>
                          <?php
                            $count_admin_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'admin'";
                            $count_admin_result = mysqli_query($conn, $count_admin_sql);
                            $count_admin = $count_admin_result->fetch_array();
                            if($count_admin['count_user'] <= 1 && strtolower($data['role_name']) == ADMIN) :
                          ?>
                              <input type="text" name="role" class="form-control" id="role-select" value="<?php echo ucfirst($data['role_name']); ?>" disabled>
                          <?php
                            else :
                          ?>
                              <select name="role" class="form-control" id="role-select">
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
                          <label class="info-name">Firstname</label>
                          <input type="text" name="firstname" class="form-control input-rev-read" value="<?php echo ucfirst($data['firstname']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Lastname</label>
                          <input type="text" name="lastname" class="form-control input-rev-read" value="<?php echo ucfirst($data['lastname']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Gender</label>
                          <input type="text" name="gender" class="form-control input-rev-read" value="<?php echo ucfirst($data['gender']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="info-name">Date of Birth</label>
                          <input type="date" name="dob" class="form-control input-rev-read" value="<?php echo $data['dob']; ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="info-name">Address</label>
                          <textarea name="address" class="form-control input-rev-read" rows="3" disabled><?php echo $data['address']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">City</label>
                          <input type="text" name="address" class="form-control input-rev-read" value="<?php echo ucfirst($data['city']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Country</label>
                          <input type="text" name="address" class="form-control input-rev-read" value="<?php echo ucfirst($data['country']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="info-name">Phone</label>
                          <input type="text" name="address" class="form-control input-rev-read" onkeypress="numberOnly(event)" value="<?php echo ucfirst($data['phone']); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="info-name">About Me</label>
                          <textarea name="about" class="form-control input-rev-read" rows="3" disabled><?php echo $data['about']; ?></textarea>
                            <div class="text-right btn-wrap">
                              <input type="submit" name="edit_pro" class="btn btn-info btn-mar" id="btn-editpro-display" value="Edit">
                              <button type="button" class="btn btn-default btn-mar" id="btn-update-profile-no-readonly">Update Profile</button>
                              <button type="button" class="btn btn-primary btn-mar" id="btn-update-profile-readonly">View Profile</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
      <?php
        endif;
      ?>
    </div>
    
<?php
  include "share/footer.inc.php";
?>