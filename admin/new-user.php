<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  include "share/header.inc.php";
  $error = '';
  $msg = '';
  $check_required = false;
  if(isset($_POST['add_user'])) {

  }
?>

    <div class="content">
      <div class="row">
        <div class="col-sm-8">
          <div class="card card-info">
            <div class="card-header">
              <h4 class="header">Add User</h4>
            </div>
            <div class="card-body">
              <form action="new-user.php" method="post">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Firstname</label>
                      <input type="text" name="firstname" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Lastname</label>
                      <input type="text" name="lastname" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Email Address</label>
                      <input type="email" name="email" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Password</label>
                      <input type="password" name="password" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Confirm Password</label>
                      <input type="password" name="con_password" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
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
                      <label class="info-name">Date of Birth</label>
                      <input type="date" name="dob" class="form-control">
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
                      <input type="text" name="phone" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="info-name">About Me</label>
                      <textarea name="about" class="form-control" rows="3"></textarea>
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