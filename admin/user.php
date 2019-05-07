<?php
  include "share/header.inc.php";
?>

      <div class="content">
        <div class="row">
          <div class="col-sm-4">
            <div class="card card-profile">
              <div class="image">
                <img src="" alt="">
              </div>
              <div class="card-body text-center">
                <div class="author">
                  <a href="#">
                    <img src="../assets/images/user-avatar-placeholder.png" class="img-profile" alt="user-avatar-placeholder">
                    <p class="author-name">Kheang Lov</p>
                  </a>
                  <p class="slug">@kheang</p>
                  <p class="text-profile">
                    "I like the way you work it <br>
                    No diggity <br>
                    I wanna bag it up"
                  </p>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="row text-center">
                  <div class="col-sm-4">
                    <span class="profile-footer">12</span>
                    <span class="profile-footer">Files</span>
                  </div>
                  <div class="col-sm-4">
                    <span class="profile-footer">2GB</span>
                    <span class="profile-footer">Used</span>
                  </div>
                  <div class="col-sm-4">
                    <span class="profile-footer">24,6$</span>
                    <span class="profile-footer">Spent</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="card card-info">
              <div class="card-header">
                <h4 class="header">Edit Profile</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Username</label>
                      <input type="text" name="name" class="form-control" value="Kheang">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Email Address</label>
                      <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">First Name</label>
                      <input type="text" name="firstname" class="form-control" value="Kheang">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="info-name">Last Name</label>
                      <input type="text" name="lastname" class="form-control" value="Lov">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="info-name">Address</label>
                      <input type="text" name="address" class="form-control" value="Phnom Penh, Cambodia">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">City</label>
                      <input type="text" name="address" class="form-control" value="Phnom Penh">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Country</label>
                      <input type="text" name="address" class="form-control" value="Cambodia">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="info-name">Postal Code</label>
                      <input type="text" name="address" class="form-control" placeholder="ZIP Code">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="info-name">About Me</label>
                      <textarea name="about" class="form-control" rows="3">Oh so, your weak rhyme You doubt I'll bother, reading into it</textarea>
                        <div class="text-right btn-wrap">
                          <button class="btn btn-default btn-mar">Update Profile</button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
  include "share/footer.inc.php";
?>