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
        <li>
          <a href="user.html">
            <i class="fa fa-user"></i>Profile
          </a>
        </li>
        <li class="active">
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
              Tables
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
          <div class="col-sm-12">
            <div class="card card-transparent">
              <div class="card-header">
                <h4 class="header">Table on Plain Background</h4>
                <span class="sub-header">Here Is A Subtitle For This Table</span>
              </div>
              <div class="card-body">
                <table class="table" rules="none">
                  <tbody class="tbody">
                    <tr>
                      <th>Name</th>
                      <th>Country</th>
                      <th>City</th>
                      <th>Salary</th>
                    </tr>
                    <tr>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td>$36,738</td>
                    </tr>
                    <tr>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td>$36,738</td>
                    </tr>
                    <tr>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td>$36,738</td>
                    </tr>
                    <tr>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td>$36,738</td>
                    </tr>
                    <tr>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td>$36,738</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-colorful">
                <div class="card-header">
                  <h4 class="header">Regular Table with Colors</h4>
                </div>
                <div class="card-body">
                  <table class="table" rules="none">
                    <tbody class="tbody">
                      <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Salary</th>
                      </tr>
                      <tr class="success">
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                      </tr>
                      <tr class="info">
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                      </tr>
                      <tr class="warning">
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                      </tr>
                      <tr>
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                      </tr>
                      <tr class="danger">
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                      </tr>
                    </tbody>
                  </table>
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