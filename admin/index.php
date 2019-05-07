<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../assets/libraries/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="wrapper clearfix">
    <aside id="mySidenav" class="sidebar">
      <div class="sidebar-header text-center">
        <h3 class="site-name">Bedtimestories</h3>
      </div>
      <ul class="nav nav-menu">
        <li class="active">
          <a href="index.html">
            <i class="fa fa-tachometer"></i>Dashboard
          </a>
        </li>
        <li>
          <a href="../index.html">
            <i class="fa fa-globe"></i>Homepage
          </a>
        </li>
        <li>
          <a href="post.html">
            <i class="fa fa-pencil-square-o"></i>Posts <b class="caret drop-custom"></b>
          </a>
        </li>
        <li>
          <a href="user.html">
            <i class="fa fa-user"></i>Profile
          </a>
        </li>
        <li>
          <a href="table.html">
            <i class="fa fa-table"></i>Tables
          </a>
        </li>
        <li>
          <a href="form.html">
            <i class="fa fa-wpforms"></i>Forms
          </a>
        </li>
      </ul>
      <!-- <div class="sidebar-profile text-center">
        <div class="profile-wrapper">
          <div class="profile-overlay" style="background-image: url('../assets/image/user-avatar-placeholder.png')"></div>
        </div>
        <h3 class="profile-name">Kheang</h3>
      </div> -->
    </aside>
    <div class="main-wrapper">
      <nav class="navbar navbar-default navbar-main">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
              Dashboard
            </a>
          </div>
      
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu card card-navbar">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user fa-nav"></i>
                </a>
                <ul class="dropdown-menu card card-navbar">
                  <li><a href="user.html">Admin</a></li>
                  <li><a href="form.html">Edit</a></li>
                  <li><a href="../login.html">Log Out</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-right">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </nav>

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
      <div class="footer-be text-right">
        <p class="copyright">&copy; 2018, made with <i class="fa fa-heart fa-danger"></i> by Kheang</p>
      </div>

    </div>
  </div>
  
  <script src="../assets/libraries/jQuery/jquery.min.js"></script>
  <script src="../assets/libraries/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
  <script src="../assets/js/script.js"></script>
</body>
</html>