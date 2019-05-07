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
        <li class="active">
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
              Profile
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