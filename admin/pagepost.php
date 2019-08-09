<?php
  $user = false;
  $index = false;
  $profile = false;
  $post = false;
  $cate = false;
  $page = true;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  $id = '';
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
    $check_id_sql = "SELECT * FROM page_posts WHERE id = $id LIMIT 1";
    $check_id_result = mysqli_query($conn, $check_id_sql);
    if(mysqli_num_rows($check_id_result) != 0) {
      $edit_sql = "SELECT page_posts.*, pages.name AS page_name 
        FROM page_posts 
        INNER JOIN pages ON page_posts.page_id = pages.id
        WHERE page_posts.id = $id";
      $edit_result = mysqli_query($conn, $edit_sql);
      if(mysqli_num_rows($edit_result) > 0) {
        $edit = $edit_result->fetch_array();
      }
    } else {
      header("Location: pagepost.php?id=wrong");
    }
  }
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
    if($get_page < 1) {
      header("Location: pagepost.php?page=1");
    }
  } else {
    $get_page = 1;
  }
  if(isset($_GET['pages']) && strtolower($_GET['pages']) == POSTED) {
    $msg = 'Page have been created successfully!';
  }
  if(isset($_GET['deleted'])) {
    $deleted = strtolower(trim($_GET['deleted']));
    if($deleted === strtolower(SUCCESS)) {
      $msg = 'User have been deleted!';
    } else if($deleted === strtolower(FAIL)) {
      $error = 'Fail to delete user!';
    }
  } else if(isset($_GET['banned'])) {
    $banned = strtolower(trim($_GET['banned']));
    if($banned === SUCCESS) {
      $msg = 'User have been banned!';
    } else if($banned === FAIL) {
      $error = 'Fail to ban user!';
    }
  } else if(isset($_GET['updated'])) {
    $updated = strtolower(trim($_GET['updated']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'User have been updated!';
    } else {
      $error = 'Fail to update user!';
    }
  }

  if(isset($_POST['add_page'])) {
    if(!empty($_POST['title'])) {
      $page_name = trim($_POST['title']);
      $check_page_name_sql = "SELECT * FROM page_posts WHERE LOWER(title) = LOWER('$page_name')";
      $check_page_name_result = mysqli_query($conn, $check_page_name_sql);
      if(mysqli_num_rows($check_page_name_result) != 0) {
        $error = 'Page post already exist!';
      } else {
        $page_content = trim($_POST['content']);
        $page_id = trim($_POST['page']);
        $page_description = trim($_POST['description']);
        $page_create = date("Y-m-d h:i:s");
        $page_update = date("Y-m-d h:i:s");
        $post_image = '';
        if(!empty($_FILES['post_image']['name'])) {
          $file_extens = array("jpg", "png", "jpeg", "gif", "svg");
          $post_image = $_FILES['post_image']['name'];
          $post_image_tmpname = $_FILES['post_image']['tmp_name'];
          $post_image_size = $_FILES["post_image"]["size"];
          $post_image_des = "../assets/upload/post_images/" . $post_image;
          $post_image_type = strtolower(pathinfo($post_image_des, PATHINFO_EXTENSION));
          if($post_image_size > 2000000) {
            $error_post_image = "File's size is too large!";
          } else {
            if(!in_array($post_image_type, $file_extens)) {
              $error_post_image = "Image's file extension is not valid!";
            } else {
              move_uploaded_file($post_image_tmpname, $post_image_des);
            }
          }
        }
        $insert_page = "INSERT INTO page_posts(`title`, `page_id`, `description`, `content`, `image`, `created_date`, `updated_date`) 
          VALUES('{$page_name}', {$page_id}, '{$page_description}', '{$page_content}', '{$post_image}', '{$page_create}', '{$page_update}')";
        if($conn->query($insert_page)) {
          header("Location: pagepost.php?page=posted");
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    }
  }

  if(isset($_POST['edit_page'])) {
    $page_name = trim($_POST['title']);
    $check_page_sql = "SELECT * FROM page_posts WHERE LOWER(title) = LOWER('{$page_name}') AND `id` != {$id}";
    $check_page_result = mysqli_query($conn, $check_page_sql);
    if(mysqli_num_rows($check_page_result) > 0) {
        $error = 'Page post already existed!'; 
    } else {
      $page_content = trim($_POST['content']);
      $page_id = trim($_POST['page']);
      $page_description = trim($_POST['description']);
      $page_update = date("Y-m-d h:i:s");
      $post_image = '';
      if(!empty($_FILES['post_image']['name'])) {
        $file_extens = array("jpg", "png", "jpeg", "gif", "svg");
        $post_image = $_FILES['post_image']['name'];
        $post_image_tmpname = $_FILES['post_image']['tmp_name'];
        $post_image_size = $_FILES["post_image"]["size"];
        $post_image_des = "../assets/upload/post_images/" . $post_image;
        $post_image_type = strtolower(pathinfo($post_image_des, PATHINFO_EXTENSION));
        if($post_image_size > 2000000) {
          $error_post_image = "File's size is too large!";
        } else {
          if(!in_array($post_image_type, $file_extens)) {
            $error_post_image = "Image's file extension is not valid!";
          } else {
            move_uploaded_file($post_image_tmpname, $post_image_des);
          }
        }
      }
      $update_cate = "UPDATE `page_posts`
        SET `title` = '{$page_name}', `content` = '{$page_content}', `page_id` = {$page_id}, `description` = '{$page_description}', `updated_date` = '{$page_update}', `image` = '{$post_image}' 
        WHERE `id` = {$id}";
      if($conn->query($update_cate) === true) {
        header("Location: pagepost.php?updated=success");
      } else {
        $error = "Error: " . $conn->error;
        // header("Location: category.php?updated=fail");
      }
    }
  }
  $sql = "SELECT * FROM page_posts";
  $result = mysqli_query($conn, $sql);
  $number_of_user = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $page_sql = "SELECT page_posts.*, pages.name AS page_name 
    FROM page_posts 
    INNER JOIN pages ON page_posts.page_id = pages.id
    ORDER BY page_posts.updated_date DESC LIMIT $first_page_result, $per_page";
  $pages_result = mysqli_query($conn, $page_sql);
?>

    <div class="content">
      <a href="pagebutton.php" class="btn btn-default btn-addp">
        <span class="btn-label">
          <i class="ti-plus"></i> 
        </span>
        Add Button
      </a>
      <?php
        if(isset($_GET['user_id']) && strtolower($_GET['user_id']) === 'wrong') :
      ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> Cannot find the provided page id!
          </div>
      <?php
        endif;
      ?>
      <div class="row">
        <div class="col-sm-4">
          <div class="card card-tasks">
            <div class="card-header">
              <h2 class="add-post"><?php echo $id == '' ? 'Add' : 'Edit'; ?> Page Post</h2>
            </div>
            <div class="card-body">
              <form action="pagepost.php<?php echo $id != '' ? '?id=' . $id : ''; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="info-name">Title</label>
                  <input type="text" name="title" class="form-control" value="<?php echo isset($_GET['id']) && $edit['title'] != '' ? $edit['title'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label class="info-name">Content</label>
                  <textarea name="content" id="post_content" cols="3" rows="3" class="form-control">
                    <?php echo isset($_GET['id']) && $edit['content'] != '' ? trim($edit['content']) : ''; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label class="info-name">Page</label>
                  <select name="page" class="form-control">
                    <?php
                      $get_ptype_sql = "SELECT * FROM pages";
                      $get_ptype_result = mysqli_query($conn, $get_ptype_sql);
                      if(mysqli_num_rows($get_ptype_result) > 0) :
                        while($rows = $get_ptype_result->fetch_assoc()) :
                    ?>
                          <option value="<?php echo $rows['id']; ?>"<?php echo isset($_GET['id']) && $rows['name'] == $edit['page_name'] ? ' selected' : ''; ?>><?php echo ucfirst($rows['name']); ?></option>
                    <?php
                        endwhile;
                      endif;
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="info-name">Description</label>
                  <input type="text" name="description" class="form-control" value="<?php echo isset($_GET['id']) && $edit['description'] != '' ? $edit['description'] : ''; ?>">
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="file" name="post_image" id="thumbnail-input" class="input-display">
                      <button type="button" id="thumbnail-button" class="btn btn-default btn-sm"><i class="fa fa-camera-retro"></i> Add Image</button>
                      <span id="thumbnail-text" class="file-text">No file chosen!</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group text-right">
                      <input type="submit" name="<?php echo $id == '' ? 'add' : 'edit'; ?>_page" class="btn btn-<?php echo $id == '' ? 'primary' : 'info'; ?>" value="<?php echo $id == '' ? 'Add' : 'Edit'; ?>">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
          if(mysqli_num_rows($pages_result) > 0) :
        ?>
            <div class="col-sm-8">
              <div class="card card-tasks">
                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2 class="add-post">All Page Posts</h2>
                      <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                      <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                    </div>
                    <div class="col-sm-4">
                      <!-- <div class="form-group">
                        <input type="text" name="search" id="search-posttype" class="form-control input-mar" placeholder="Search">
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-striped" id="table-category">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Page</th>
                        <th>Description</th>
                        <th width="11%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($get_page == 1) {
                          $i = 0;
                        } else {
                          $i = ($get_page - 1) * 10;
                        }
                        while($ptypes = $pages_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><strong><?php echo $i; ?></strong></td>
                            <td><strong><?php echo $ptypes['title']; ?></strong></td>
                            <td><?php echo $ptypes['content']; ?></td>
                            <td><?php echo $ptypes['page_name']; ?></td>
                            <td><?php echo $ptypes['description']; ?></td>
                            <td class="td-actions">
                              <a href="pagepost.php?<?php echo "id={$ptypes['id']}"; ?>" class="btn-icon btn-icon-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="ti-pencil"></i>
                              </a>
                              <a href="#" onClick="deletePagePost(<?php echo $ptypes['id']; ?>)" class="btn-icon btn-icon-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="ti-trash"></i>
                              </a>
                            </td>
                          </tr>
                      <?php
                        endwhile;
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Page</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
        <?php
          endif;
        ?>
      </div>
      <div class="pagination-wrap text-right">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li>
              <a href="pagepost.php?page=1" aria-label="Previous">
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
              $number_of_page = ceil($number_of_user / $per_page);
              if($get_page > $number_of_page) {
                header("Location: pagepost.php?page=$number_of_page");
              }
              // var_dump($number_of_page);
              for($page=1; $page<=$number_of_page; $page++) :
            ?>
                <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="pagepost.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php
              endfor;
              // var_dump($get_page);
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
              <a href="pagepost.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
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