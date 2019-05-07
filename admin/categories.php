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
        <li class="active">
          <a href="post.html" style="color: #c3c2c2;">
            <i class="fa fa-pencil-square-o"></i>Posts <b class="caret drop-custom"></b>
          </a>
          <ul class="post-menu">
            <li><a href="allpost.html">All Posts</a></li>
            <li><a href="newpost.html">Add New</a></li>
            <li class="selected"><a href="categories.html">Categories</a></li>
          </ul>
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
          <div class="col-sm-12">
            <div class="card card-tasks">
              <div class="card-header">
                <h2 class="add-post">Add New Categories</h3>
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked="">
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                      </th>
                      <th>Author</th>
                      <th>Title</th>
                      <th>Date</th>
                    </tr>
                  </thead>
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
                          <img src="" class="img-raised">
                        </div>
                      </td>
                      <td class="text-left">Thomas and the New World</td>
                      <td class="td-actions">Sep-11-2018</td>
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
                          <img src="" class="img-raised">
                        </div>
                      </td>
                      <td class="text-left">The Holiday Girls</td>
                      <td class="td-actions">Sep-09-2018</td>
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
                          <img src="" class="img-raised">
                        </div>
                      </td>
                      <td class="text-left">Changeling</td>
                      <td class="td-actions">Sep-09-2018</td>
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
                          <img src="" class="img-raised">
                        </div>
                      </td>
                      <td class="text-left">Nikki & the Long Lost Treasure</td>
                      <td class="td-actions">Sep-08-2018</td>
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
                          <img src="" class="img-raised">
                        </div>
                      </td>
                      <td class="text-left">Tate’s Time Traveling Top</td>
                      <td class="td-actions">Sep-08-2018</td>
                    </tr>
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
                        <img src="" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Terry the Trouble Bunny</td>
                    <td class="td-actions">Sep-08-2018</td>
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
                        <img src="" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Samba & the Missing Letters</td>
                    <td class="td-actions">Sep-08-2018</td>
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
                        <img src="" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">The Moonlight Farmers</td>
                    <td class="td-actions">Sep-08-2018</td>
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
                        <img src="" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">Kris Snowman – Rockstar On Tour</td>
                    <td class="td-actions">Sep-08-2018</td>
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
                        <img src="" class="img-raised">
                      </div>
                    </td>
                    <td class="text-left">My Sister the Werewolf</td>
                    <td class="td-actions">Sep-08-2018</td>
                  </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked="">
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                      </th>
                      <th>Author</th>
                      <th>Title</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="pagination-wrap text-right">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
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