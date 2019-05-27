<?php
  $permission = '';
  if(isset($_GET['permission'])) {
    $permission = $_GET['permission'];
  }
  $index = true;
  $profile = false;
  $user = false;
  $post = false;
  $cate = false;
  include "share/header.inc.php";
?>

    <div class="content">
      <?php
        if(strtolower($permission) === 'denied') :
      ?>
          <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> You don't have permission to access this path!
          </div>
      <?php
        endif;
      ?>
      <div class="row">
        <div class="col-sm-3">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <i class="fa fa-globe fa-warning"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <?php
                    $count_user_sql = "SELECT COUNT(*) AS count_user FROM users";
                    $count_user_result = mysqli_query($conn, $count_user_sql);
                    $count_user = $count_user_result->fetch_array();
                  ?>
                  <span class="text"><?php echo ucfirst(USER); ?></span>
                  <span class="number"><?php echo $count_user['count_user'] > 1 ? $count_user['count_user'] . " People" : $count_user['count_user'] . " Person"; ?></span>
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
                  <?php
                    $count_admin_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'admin'";
                    $count_admin_result = mysqli_query($conn, $count_admin_sql);
                    $count_admin = $count_admin_result->fetch_array();
                  ?>
                  <span class="text"><?php echo ucfirst(ADMIN); ?></span>
                  <span class="number"><?php echo $count_admin['count_user'] > 1 ? $count_admin['count_user'] . " People" : $count_admin['count_user'] . " Person"; ?></span>
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
                  <i class="fa fa-times fa-danger"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <?php
                    $count_author_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'author'";
                    $count_author_result = mysqli_query($conn, $count_author_sql);
                    $count_author = $count_author_result->fetch_array();
                  ?>
                  <span class="text"><?php echo ucfirst(AUTHOR); ?></span>
                  <span class="number"><?php echo $count_author['count_user'] > 1 ? $count_author['count_user'] . " People" : $count_author['count_user'] . " Person"; ?></span>
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
                  <i class="fa fa-heart-o fa-infoo"></i>
                </div>
                <div class="col-sm-7 text-right">
                  <?php
                    $count_subscriber_sql = "SELECT COUNT(*) AS count_user, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE LOWER(roles.name) = 'subscriber'";
                    $count_subscriber_result = mysqli_query($conn, $count_subscriber_sql);
                    $count_subscriber = $count_subscriber_result->fetch_array();
                  ?>
                  <span class="text"><?php echo ucfirst(SUBSCRIBER); ?></span>
                  <span class="number"><?php echo $count_subscriber['count_user'] > 1 ? $count_subscriber['count_user'] . " People" : $count_subscriber['count_user'] . " Person"; ?></span>
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
              <h4 class="header">Latest Posts</h4>
              <span class="sub-header">Stories</span>
            </div>
            <div class="card-body">
            <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Visibility</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 0;
                        $posts_sql = "SELECT stories.*, categories.name AS cate_name FROM stories INNER JOIN categories ON stories.category_id = categories.id ORDER BY stories.updated_date LIMIT 5";
                        $posts_result = mysqli_query($conn, $posts_sql);
                        if(mysqli_num_rows($posts_result) > 0) :
                          while($posts = $posts_result->fetch_assoc()) :
                            $i++;
                      ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td class="img-row">
                                <div class="img-wrapper">
                                  <a href="image-post.php?id=<?php echo $posts['id']; ?>">
                                    <img src="<?php echo $posts['thumbnail'] != '' ? '../assets/upload/images/' . $posts['thumbnail'] : '../assets/upload/no-image.png' ; ?>" class="img-raised">
                                  </a>
                                </div>
                              </td>
                              <td>
                                <a href="edit-post.php?<?php echo "id={$posts['id']}"; ?>">
                                  <strong><?php echo $posts['title']; ?></strong>
                                </a>
                              </td>
                              <td><?php echo $posts['cate_name']; ?></td>
                              <td><?php echo strtolower($posts['status']) == strtolower(PUBLISH) ? '<span class="label label-success">' . ucfirst($posts['status']) . '</span>' : (strtolower($posts['status']) == strtolower(DRAFT) ? '<span class="label label-danger">' . ucfirst($posts['status']) . '</span>' : (strtolower($posts['status']) == strtolower(BAN) ? '<span class="label label-warning">' . ucfirst($posts['status']) . '</span>' : '')); ?></td>
                              <td><?php echo strtolower($posts['visibility']) == strtolower(PRIVATEVIS) ? '<span class="label label-info">' . ucfirst($posts['visibility']) . '</span>' : (strtolower($posts['visibility']) == strtolower(PUBLICVIS) ? '<span class="label label-primary">' . ucfirst($posts['visibility']) . '</span>' : ''); ?></td>
                              <td class="td-actions">
                                <a href="#" onClick="banPost(<?php echo $posts['id']; ?>)" class="btn btn-warning">
                                  <i class="fa fa-ban"></i>
                                </a>
                                <a href="#" onClick="deletePost(<?php echo $posts['id']; ?>)" class="btn btn-danger">
                                  <i class="fa fa-times"></i>
                                </a>
                              </td>
                            </tr>
                      <?php
                          endwhile;
                        endif;
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Visibility</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
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