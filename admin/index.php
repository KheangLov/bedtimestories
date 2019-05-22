<?php
  $index = true;
  $profile = false;
  $user = false;
  $post = false;
  include "share/header.inc.php";
?>

    <div class="content">
      <div class="row">
        <div class="col-sm-3">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <i class="fa fa-globe fa-warning"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <span class="text">Capacity</span>
                  <span class="number">150GB</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-repeat"></i>
              <span class="notify">Update now</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <i class="fa fa-money fa-success"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <span class="text">Revenue</span>
                  <span class="number">$1,345</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-calendar"></i>
              <span class="notify">Last day</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <i class="fa fa-times fa-danger"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <span class="text">Errors</span>
                  <span class="number">23</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-clock-o"></i>
              <span class="notify">In the last hour</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <i class="fa fa-heart-o fa-infoo"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <span class="text">Follower</span>
                  <span class="number">+45K</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-repeat"></i>
              <span class="notify">Update now</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-tasks">
            <div class="card-header">
              <h4 class="header">Tasks</h4>
              <span class="sub-header">Backend Development</span>
            </div>
            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="img-row">
                      <div class="img-wrapper">
                        <img src="../assets/images/thomas_and_the_new_world.jpg" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Thomas and the New World</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit Task">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="img-row">
                      <div class="img-wrapper">
                        <img src="../assets/images/the_holiday_girl.jpg" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">The Holiday Girls</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit Task">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="img-row">
                      <div class="img-wrapper">
                        <img src="../assets/images/Changeling.jpg" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Changeling</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit Task">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="img-row">
                      <div class="img-wrapper">
                        <img src="../assets/images/Nikki & the Long Lost Treasure.jpg" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Nikki & the Long Lost Treasure</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit Task">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-repeat"></i>
              <span class="notify">Update now</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="card card-work">
            <div class="card-header">
              <h4 class="header">Email Statistics</h4>
              <span class="sub-header">Last Campaign Performance</span>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-calendar fa-work"></i>
              <span class="work-text"> Number of emails sent</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-work">
            <div class="card-header">
              <h4 class="header">New Visitators</h4>
              <span class="sub-header">Out Of Total Number</span>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-check fa-work"></i>
              <span class="work-text"> Campaign sent 2 days ago</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-work">
            <div class="card-header">
              <h4 class="header">Orders</h4>
              <span class="sub-header">Total Number</span>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-clock-o fa-work"></i>
              <span class="work-text"> Updated 3 minutes ago</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card card-work">
            <div class="card-header">
              <h4 class="header">Subscriptions</h4>
              <span class="sub-header">Our Users</span>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
              <hr>
              <i class="fa fa-repeat fa-work"></i>
              <span class="work-text"> Total users</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php
  include "share/footer.inc.php";
?>