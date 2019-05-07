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
        <li class="active">
          <a href="post.html" style="color: #c3c2c2;">
            <i class="fa fa-pencil-square-o"></i>Posts
          </a>
          <ul class="post-menu">
            <li><a href="allpost.html">All Posts</a></li>
            <li class="selected"><a href="newpost.html">Add New</a></li>
          </ul>
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
              Posts
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
          <div class="col-sm-9">
            <div class="card">
              <div class="card-header">
                <h2 class="add-post">Add New Post</h2>
              </div>
              <div class="card-body">
                <input type="text" name="add" class="form-control input-lg">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <button class="btn btn-default"><i class="fa fa-camera-retro"></i> Add Media</button>
                <button class="btn btn-default"><i class="fa fa-film"></i> Add Gallery Video</button>
              </div>
              <div class="card-body">
                <textarea name="content" id="" cols="30" rows="30" class="form-control"></textarea>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Excerpt</h3>
              </div>
              <div class="card-body">
                <textarea name="content" id="" cols="30" rows="3" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Publish</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <button class="btn btn-default">Save Draft</button>
                  </div>
                  <div class="col-sm-6 text-right">
                    <button class="btn btn-default">Preview</button>
                  </div>
                </div>
                <span class="status"><i class="fa fa-thermometer-full"></i>Status: <strong>Draft</strong></span>
                <span class="status"><i class="fa fa-eye"></i>Visibility: <strong>Public</strong></span>
                <span class="status"><i class="fa fa-calendar"></i>Publish: <strong>immediately</strong></span>
                <div class="btn-wrap text-right">
                  <button class="btn btn-default btn-pub">Publish</button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Categories</h3>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs tabs-custom">
                  <li class="active"><a data-toggle="tab" href="#all-categories">All Categories</a></li>
                  <li><a data-toggle="tab" href="#most-used">Most Used</a></li>
                </ul>
                <div class="tab-content">
                  <div id="all-categories" class="tab-pane fade in active">
                    <input type="checkbox" class="tab-check"> Education <br>
                    <input type="checkbox" class="tab-check"> News <br>
                    <input type="checkbox" class="tab-check"> Sport <br>
                    <input type="checkbox" class="tab-check"> Technology
                  </div>
                  <div id="most-used" class="tab-pane fade">
                    <input type="checkbox" class="tab-check"> Technology <br>
                    <input type="checkbox" class="tab-check"> Sport <br>
                    <input type="checkbox" class="tab-check"> News
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="#" class="add-cat"><i class="fa fa-plus"></i> Add New Categories</a>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Tags</h3>
              </div>
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control input-sm" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="submit">
                      Add
                    </button>
                  </div>
                </div>
                <div class="text-wrap">
                  <span class="sub-text">Separate tags with commas</span>
                </div>
                <div class="link-wrap">
                  <a href="#" class="tags-link">Choose from the most used tags</a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Featured Image</h3>
              </div>
              <div class="card-body">
                <a href="#" class="img-link">Set featured image</a>
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