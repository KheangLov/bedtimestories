<?php
  $post = true;
  $index = false;
  $profile = false;
  $user = false;
  $cate = false;
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN && strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
  } else {
    $get_page = 1;
  }
  if(isset($_GET['deleted'])) {
    $deleted = strtolower(trim($_GET['deleted']));
    if($deleted === strtolower(SUCCESS)) {
      $msg = 'Post have been deleted!';
    } else if($deleted === strtolower(FAIL)) {
      $error = 'Fail to delete post!';
    }
  } else if(isset($_GET['updated'])) {
    $updated = strtolower(trim($_GET['updated']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'Post have been updated!';
    } else {
      $error = 'Fail to update post!';
    }
  }
  $sql = "SELECT * FROM stories";
  $result = mysqli_query($conn, $sql);
  $number_of_post = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $posts_sql = "SELECT stories.*, categories.name AS cate_name FROM stories INNER JOIN categories ON stories.category_id = categories.id LIMIT $first_page_result, $per_page";
  $posts_result = mysqli_query($conn, $posts_sql);
?>

    <div class="content">
      <a href="new-post.php" class="btn btn-default btn-addp">Add New</a>
      <?php
        if(isset($_GET['post_id']) && strtolower($_GET['post_id']) === 'wrong') :
      ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> Cannot find the provided post id!
          </div>
      <?php
        endif;
        if(mysqli_num_rows($posts_result) > 0) :
      ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-tasks">
                <div class="card-header">
                  <h2 class="add-post">All Posts</h2>
                  <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                  <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
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
                        if($get_page == 1) {
                          $i = 0;
                        } else {
                          $i = ($get_page - 1) * 10;
                        }
                        while($posts = $posts_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td class="img-row">
                              <div class="img-wrapper">
                                <a href="image-post.php?id=<?php echo $posts['id']; ?>">
                                  <img src="<?php echo $posts['thumbnail'] != '' ? '../assets/upload/thumbnails/' . $posts['thumbnail'] : '../assets/upload/no-image.png' ; ?>" class="img-raised">
                                </a>
                              </div>
                            </td>
                            <td>
                              <a href="<?php echo $_posts['id'] == $_SESSION['user_id'] ? 'edit-post.php?id=' . $posts['id'] : ''; ?>">
                                <strong><?php echo $posts['title']; ?></strong>
                              </a>
                            </td>
                            <td><?php echo $posts['cate_name']; ?></td>
                            <td><?php echo strtolower($posts['status']) == strtolower(PUBLISH) ? '<span class="label label-success">' . ucfirst($posts['status']) . '</span>' : (strtolower($posts['status']) == strtolower(DRAFT) ? '<span class="label label-danger">' . ucfirst($posts['status']) . '</span>' : (strtolower($posts['status']) == strtolower(BAN) ? '<span class="label label-warning">' . ucfirst($posts['status']) . '</span>' : '')); ?></td>
                            <td><?php echo strtolower($posts['visibility']) == strtolower(PRIVATEVIS) ? '<span class="label label-info">' . ucfirst($posts['visibility']) . '</span>' : (strtolower($posts['visibility']) == strtolower(PUBLICVIS) ? '<span class="label label-primary">' . ucfirst($posts['visibility']) . '</span>' : ''); ?></td>
                            <?php
                              if($posts['user_id'] == $_SESSION['user_id'] || strtolower($_SESSION['role_name']) == ADMIN) :
                            ?>
                                <td class="td-actions">
                                  <a href="#" onClick="banPost(<?php echo $posts['id']; ?>)" class="btn btn-warning">
                                    <i class="fa fa-ban"></i>
                                  </a>
                                  <a href="#" onClick="deletePost(<?php echo $posts['id']; ?>)" class="btn btn-danger">
                                    <i class="fa fa-times"></i>
                                  </a>
                                </td>
                            <?php
                              else :
                            ?>
                                <td>
                                  <a href="">No Action</a>
                                </td>
                            <?php
                              endif;
                            ?>
                          </tr>
                      <?php
                        endwhile;
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
              </div>
            </div>
          </div>
      <?php
        endif;
      ?>
      <div class="pagination-wrap text-right">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li>
              <a href="user.php?page=1" aria-label="Previous">
                <i class="fa fa-angle-double-left"></i>
              </a>
            </li>
            <?php
              if($get_page != '' && $get_page != 1) :
            ?>
                <li>
                  <a href="#" onClick="prevUser(<?php echo $get_page; ?>)" aria-label="Previous">
                    <i class="fa fa-angle-left"></i>
                  </a>
                </li>
            <?php
              endif;
              $number_of_page = ceil($number_of_post / $per_page);
              for($page=1; $page<=$number_of_page; $page++) :
            ?>
                <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="user.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php
              endfor;
              if($get_page != '' && $get_page != $number_of_page) :
            ?>
                <li>
                  <a href="#" onClick="nextUser(<?php echo $get_page; ?>)" aria-label="Next">
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
            <?php
              endif;
            ?>
            <li>
              <a href="post.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
                <i class="fa fa-angle-double-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
      
<?php
  include "share/footer.inc.php";
?>