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
    <aside class="sidebar">
      <div class="sidebar-header text-center">
        <h3 class="site-name">Bedtimestories</h3>
      </div>
      <ul class="nav nav-menu">
        <li>
          <a href="index.html">
            <i class="fa fa-tachometer"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../index.html">
            <i class="fa fa-globe"></i>
            <span>Homepage</span>
          </a>
        </li>
        <li>
          <a href="post.html">
            <i class="fa fa-pencil-square-o"></i>Posts <b class="caret drop-custom"></b>
          </a>
        </li>
        <li>
          <a href="user.html">
            <i class="fa fa-user"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="table.html">
            <i class="fa fa-table"></i>
            <span>Tables</span>
          </a>
        </li>
        <li class="active">
          <a href="form.html">
            <i class="fa fa-wpforms"></i>
            <span>Forms</span>
          </a>
        </li>
      </ul>
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
              Forms
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