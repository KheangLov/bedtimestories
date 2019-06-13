<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  $cate = false;
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != strtolower(ADMIN)) {
    header("Location: index.php?permission=denied");
  }
  $username = $_SESSION['name'];
  $user_id = $_GET['id'];
  $user_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = $user_id";
  $user_result = mysqli_query($conn, $user_sql);
?>

    <div class="content">
      <?php
        if(mysqli_num_rows($user_result) > 0) :
          $data = $user_result->fetch_array();
      ?>
          <div class="row">
            <div class="col-sm-4">
              <div class="card card-profile">
                <div class="image">
                  <img src="" alt="">
                </div>
                <div class="card-body text-center">
                  <div class="author">
                    <a href="#">
                    <img src="../assets/upload/profiles/<?php echo $data['image'] != '' ? $data['image'] : 'user-avatar-placeholder.png'; ?>" class="img-profile img-addit">
                      <p class="author-name"><?php echo ucfirst($data['firstname']) . ' ' . ucfirst($data['lastname']); ?></p>
                    </a>
                    <p class="slug"><?php echo '@' . $data['lastname']; ?></p>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <hr>
                  <p class="text-profile">
                    <?php echo $data['quote'] != '' ? '"' . $data['quote'] . '"' : ''; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="card card-info">
                <div class="card-header">
                  <h4 class="header">Profile Detail</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Username" value="<?php echo ucfirst($data['fullname']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $data['email']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">Role</label>
                        <input type="text" name="role" class="form-control" placeholder="Role" value="<?php echo ucfirst($data['role_name']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="info-name">Firstname</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="<?php echo ucfirst($data['firstname']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="info-name">Lastname</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo ucfirst($data['lastname']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="info-name">Gender</label>
                        <input type="text" name="gender" class="form-control" placeholder="Gender" value="<?php echo ucfirst($data['gender']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="info-name">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth" value="<?php echo $data['dob']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="info-name">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Address" disabled><?php echo $data['address']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">City</label>
                        <input type="text" name="address" class="form-control" placeholder="City" value="<?php echo ucfirst($data['city']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">Country</label>
                        <input type="text" name="address" class="form-control" placeholder="Country" value="<?php echo ucfirst($data['country']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="info-name">Phone</label>
                        <input type="text" name="address" class="form-control" placeholder="Phone" value="<?php echo ucfirst($data['phone']); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="info-name">About Me</label>
                        <textarea name="about" class="form-control" rows="3" placeholder="About Me" disabled><?php echo $data['about']; ?></textarea>
                        <?php
                          $count_admin_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'admin'";
                          $count_admin_result = mysqli_query($conn, $count_admin_sql);
                          $count_admin = $count_admin_result->fetch_array();
                          if($count_admin['count_user'] > 1 || strtolower($data['role_name']) != ADMIN) :
                        ?>
                            <div class="text-right btn-wrap">
                              <!-- <button class="btn btn-default btn-mar">Update Profile</button> -->
                              <a href="edit-user.php?id=<?php echo $user_id; ?>" class="btn btn-default btn-mar">Edit Profile</a>
                            </div>
                        <?php
                          endif;
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        endif;
      ?>
    </div>
    
<?php
  include "share/footer.inc.php";
?>