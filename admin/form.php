<?php
  include "share/header.inc.php";
?>

    <div class="content">
      <div class="row">
        <div class="col-sm-6">
          <div class="card card-info">
            <div class="card-header">
              <h4 class="header">Stacked Form</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="info-name">Email</label>
                <input type="email" name="name" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <label class="info-name">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <input type="checkbox" name="check" class="check-box"> Subscribe to newsletter
                <div class="text-left btn-wrap">
                  <button class="btn btn-default btn-mar">SUBMIT</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card card-info">
            <div class="card-header">
              <h4 class="header">Horizontal Form</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Email</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Username</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" name="user" class="form-control" placeholder="Username">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Password</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    <input type="checkbox" name="checkbox" class="check-box"> Remember me
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    <div class="text-left btn-wrap">
                      <button class="btn btn-default btn-mar">SIGN IN</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="card card-info">
            <div class="card-header">
              <h4 class="header">Form Elements</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">With help</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="">
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    A block of help text that breaks onto a new line.
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Password</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Placeholder</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="placeholder">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Disabled</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Disabled input here..." disabled>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Checked boxes and radios</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="checkbox">
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    <input type="checkbox">
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    <input type="radio">
                  </div>
                  <div class="col-sm-offset-3 col-sm-9">
                    <input type="radio">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 text-right">
                    <label class="info-name">Inline checkboxes</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="checkbox"> a
                    <input type="checkbox"> b
                    <input type="checkbox"> c
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