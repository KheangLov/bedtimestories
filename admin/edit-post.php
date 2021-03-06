<?php
  $post = true;
  $index = false;
  $profile = false;
  $user = false;
  $cate = false;
  $page = false;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN && strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  $thumb = '';
  $_SESSION['image'] = '';
  $target = '';
  $_SESSION['thumbnail'] = '';
  $check_required = false;
  $post_id = $_GET['id'];
  $check_id_sql = "SELECT * FROM stories WHERE id = $post_id LIMIT 1";
  $check_id_result = mysqli_query($conn, $check_id_sql);
  if(mysqli_num_rows($check_id_result) != 0) {
    $post_sql = "SELECT stories.*, users.id AS users_id, categories.id AS cate_id, categories.name AS cate_name 
      FROM stories 
      INNER JOIN users ON stories.user_id = users.id 
      INNER JOIN categories ON stories.category_id = categories.id 
      WHERE stories.id = $post_id";
    $post_result = mysqli_query($conn, $post_sql);
    if(mysqli_num_rows($post_result) > 0) {
      $data = $post_result->fetch_array();
    }
    $thumb = $data['thumbnail'];
    if(isset($_POST['add_category'])) {
      $cate_name = trim($_POST['cate_name']);
      $cate_desc = trim($_POST['cate_description']);
      if($cate_name != '') {
        $check_cate_sql = "SELECT * FROM categories WHERE LOWER(name) = LOWER('$cate_name')";
        $check_cate_result = mysqli_query($conn, $check_cate_sql);
        if(mysqli_num_rows($check_cate_result) != 0) {
          $error = 'Category already exist!';
        } else {
          $cate_sql = "INSERT INTO categories(name, description) VALUES('$cate_name', '$cate_desc')";
          if($conn->query($cate_sql) === true) {
            $msg = 'New category created successfully';
          } else {
            $error = "Error: " . $conn->error;
          }
        }
      } else {
        $error = 'Please input category name!';
      }
    }
    if(isset($_POST['save_draft'])) {
      if(!empty($_FILES['thumbnail']['name'])) {
        $file_extens = array("jpg", "png", "jpeg", "gif");
        $thumb = $_FILES['thumbnail']['name'];
        $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
        $thumb_size = $_FILES["thumbnail"]["size"];
        $thumb_des = "../assets/upload/thumbnails/" . $thumb;
        $thumb_type = strtolower(pathinfo($thumb_des, PATHINFO_EXTENSION));
        if($thumb_size > 2000000) {
          $error_thumb = "File's size is too large!";
        } else {
          if(!in_array($thumb_type, $file_extens)) {
            $error_thumb = "Image's file extension is not valid!";
          } else {
            move_uploaded_file($thumb_tmpname, $thumb_des);
          }
        }
      }

      $post_title = trim($_POST['title']);
      $post_content = $_POST['content'];
      $post_desc = $_POST['description'];
      $post_cate = trim($_POST['category']);
      $post_status = strtolower(DRAFT);
      $post_vis = trim($_POST['visibility']);
      $post_user = $data['users_id'];
      $post_update = date("Y-m-d h:i:s");
      $draft_post_sql = "UPDATE stories 
        SET title = '$post_title', content = '$post_content', description = '$post_desc', 
        status = '$post_status', visibility = '$post_vis', user_id = $post_user, 
        category_id = $post_cate, updated_date = '$post_update',
        thumbnail = '$thumb'
        WHERE id = $post_id";
      // var_dump($conn->query($draft_post_sql));
      if($conn->query($draft_post_sql) === true) {
        header("Location: post.php?post=draft_updated");
      } else {
        $error = "Error: " . $conn->error;
      }
    }
    if(isset($_POST['save_publish'])) {
      if(!empty($_FILES['thumbnail']['name'])) {
        $file_extens = array("jpg", "png", "jpeg", "gif");
        $thumb = $_FILES['thumbnail']['name'];
        $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
        $thumb_size = $_FILES["thumbnail"]["size"];
        $thumb_des = "../assets/upload/thumbnails/" . $thumb;
        $thumb_type = strtolower(pathinfo($thumb_des, PATHINFO_EXTENSION));
        if($thumb_size > 2000000) {
          $error_thumb = "File's size is too large!";
        } else {
          if(!in_array($thumb_type, $file_extens)) {
            $error_thumb = "Image's file extension is not valid!";
          } else {
            move_uploaded_file($thumb_tmpname, $thumb_des);
          }
        }
      }
      $post_title = trim($_POST['title']);
      $post_content = $_POST['content'];
      $post_desc = $_POST['description'];
      if($post_title == '' || $post_content == '') {
        $check_required = true;
      } else {
        $post_cate = trim($_POST['category']);
        $post_status = PUBLISH;
        $post_vis = trim($_POST['visibility']);
        $post_user = $data['users_id'];
        $post_update = date("Y-m-d h:i:s");
        $publish_post_sql = "UPDATE stories 
          SET title = '$post_title', content = '$post_content', description = '$post_desc', 
          status = '$post_status', visibility = '$post_vis', user_id = $post_user, 
          category_id = $post_cate, updated_date = '$post_update', thumbnail = '$thumb'
          WHERE id = $post_id";
        var_dump($conn->query($publish_post_sql));
        if($conn->query($publish_post_sql) === true) {
          header("Location: post.php?post=publish_updated");
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    }
  } else {
    header("Location: post.php?post_id=wrong");
  }
?>

    <div class="content">
      <form action="edit-post.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-9">
            <div class="card">
              <div class="card-header">
                <h2 class="add-post">Title <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?></h2>
                <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
              </div>
              <div class="card-body">
                <input type="text" name="title" class="form-control input-lg" value="<?php echo $data['title']; ?>">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <input type="file" name="thumbnail" id="thumbnail-input" class="input-display">
                <button type="button" id="thumbnail-button" class="btn btn-default btn-sm"><i class="fa fa-camera-retro"></i> Add Thumbnail</button>
                <span id="thumbnail-text" class="file-text">No file chosen!</span>
              </div>
              <div class="card-body">
                <?php echo $check_required == true ? '<span class="text-danger">* required</span>' : ''; ?> 
                <textarea name="content" id="" cols="30" rows="30" class="form-control"><?php echo $data['content']; ?></textarea>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Description</h3>
              </div>
              <div class="card-body">
                <textarea name="description" id="" cols="30" rows="3" class="form-control"><?php echo $data['description']; ?></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Publish</h3>
              </div>
              <div class="card-body">
                <span class="status">
                  <i class="fa fa-thermometer-full"></i>Status: <strong><?php echo ucfirst($data['status']); ?></strong>
                  <!-- <select name="status" class="form-control input-sm">
                    <option value="publish"<?php echo strtolower($data['status']) === PUBLISH ? ' selected' : ''; ?>>Publish</option>
                    <option value="draft"<?php echo strtolower($data['status']) === DRAFT ? ' selected' : ''; ?>>Draft</option>
                  </select> -->
                </span>
                <span class="status">
                  <i class="fa fa-eye"></i>Visibility: <strong id="post_visibility"><?php // echo ucfirst($data['visibility']); ?></strong>
                  <select name="visibility" class="form-control input-sm">
                    <option value="public"<?php echo strtolower($data['visibility']) === PUBLICVIS ? ' selected' : ''; ?>>Public</option>
                    <option value="private"<?php echo strtolower($data['visibility']) === PRIVATEVIS ? ' selected' : ''; ?>>Private</option>
                  </select>
                </span>
                <span class="status"><i class="fa fa-calendar"></i>Publish: <strong><?php echo date('Y-m-d', strtotime($data['updated_date'])); ?></strong></span>
                <div class="btn-wrap text-right">
                  <div class="row">
                    <div class="col-sm-6 text-left">
                      <input type="submit" name="save_draft" value="Save Draft" class="btn btn-default">
                    </div>
                    <div class="col-sm-6">
                      <input type="submit" name="save_publish" value="Publish" class="btn btn-primary">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Categories</h3>
              </div>
              <div class="card-body">
                <select name="category" class="form-control input-sm">
                  <?php
                    $get_cate_sql = "SELECT * FROM categories";
                    $get_cate_result = mysqli_query($conn, $get_cate_sql);
                    if(mysqli_num_rows($get_cate_result) > 0) :
                      while($categories = $get_cate_result->fetch_assoc()) :
                  ?>
                        <option value="<?php echo $categories['id']; ?>"<?php echo $data['cate_name'] == $categories['name'] ? ' selected' : ''; ?>><?php echo ucfirst($categories['name']); ?></option>
                  <?php
                      endwhile;
                    endif;
                  ?>
                </select>
              </div>
              <div class="card-footer">
                <a type="button" data-toggle="collapse" data-target="#add-cate-form" class="add-cat"><i class="fa fa-plus"></i> Add New Category</a>
                <div id="add-cate-form" class="collapse text-right">
                  <input type="text" name="cate_name" class="form-control input-sm mar-top-bot" placeholder="Category Name">
                  <textarea name="cate_description" class="form-control input-sm mar-top-bot" placeholder="Category Description" cols="3" rows="3"></textarea>
                  <input type="submit" class="btn btn-default btn-sm" name="add_category" value="Add">
                </div>
              </div>
            </div>
            <!-- <div class="card">
              <div class="card-header">
                <h3 class="add-post">Featured Image</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                  </div>
                  <div class="col-xs-8">                
                    <input type="file" name="images[]" id="image-input" class="input-display" multiple>
                    <button type="button" id="image-button" class="btn btn-default btn-sm mar-top">Choose File</button>
                    <span id="image-text" class="file-text">No file chosen!</span>
                  </div>
                  <div class="col-xs-4">
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </form>
    </div>
      
<?php
  include "share/footer.inc.php";
?>