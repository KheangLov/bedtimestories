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
  $image = '';
  $target = '';
  $thumbnail = '';
  $check_required = false;
  $default_status = DRAFT;
  $default_visibility = PRIVATEVIS;
  $default_time_text = IMMEDIATELY;
  $username = $_SESSION['name'];
  $get_user_sql = "SELECT * FROM users WHERE LOWER(fullname) = LOWER('$username')";
  $get_user_result = mysqli_query($conn, $get_user_sql);
  $img_name_arr = [];
  $img_size_arr = [];
  $img_type_arr = [];
  if(mysqli_num_rows($get_user_result) > 0) {
    $get_user = $get_user_result->fetch_array();
    $post_user = $get_user['id'];
  }
  date_default_timezone_set('Asia/Bangkok');
  if(isset($_POST['img'])) {
    if($_POST['img'] == 'uploaded') {
      $msg = "Feature image have been uploaded!";
    } else {
      $error = "Feature image fail to upload!";
    }
  }

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
    $post_title = trim($_POST['title']);
    if($post_title != '') {
      $post_content = $_POST['content'];
      $post_desc = $_POST['description'];
      $post_cate = trim($_POST['category']);
      $post_status = strtolower($default_status);
      $post_vis = strtolower($default_visibility);
      $post_user = $get_user['id'];

      $file_extens = array("jpg", "png", "jpeg", "gif");
      $thumbnail = $_FILES['thumbnail']['name'];
      $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
      $thumb_size = $_FILES["thumbnail"]["size"];
      $thumb_des = "../assets/upload/thumbnails/" . $thumbnail;
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

      if(!empty(array_filter($_FILES['images']['name']))) {
        $file_extens = array("jpg", "png", "jpeg", "gif");
        foreach($_FILES['images']['name'] as $key=>$val) {
          $img_name = $_FILES['images']['name'][$key];
          $img_tmpname = $_FILES["images"]["tmp_name"][$key];
          $img_size = $_FILES["images"]["size"][$key];
          $img_des = "../assets/upload/images/" . $img_name;
          $img_type = strtolower(pathinfo($img_des, PATHINFO_EXTENSION));
          if(!in_array($img_type, $file_extens)) {
            $error = "Image's file extension is not valid!";
          } else {
            if(move_uploaded_file($img_tmpname, $img_des)) {
              array_push($img_name_arr, $img_name);
              array_push($img_size_arr, $img_size);
              array_push($img_type_arr, $img_type);
            } else {
              $error = "Can't upload image!";
            }
          }
        }
      }

      if($thumbnail != '') {
        $post_thumbnail = $thumbnail;
      } else {
        $post_thumbnail = '';
      }
      $post_create = date("Y-m-d h:i:s");
      $post_update = date("Y-m-d h:i:s");
      $draft_post_sql = "INSERT INTO stories(title, thumbnail, content, description, status, visibility, user_id, category_id, created_date, updated_date)
                        VALUES('$post_title', '$post_thumbnail', '$post_content', '$post_desc', '$post_status', '$post_vis', $post_user, $post_cate, '$post_create', '$post_update')";
      if($conn->query($draft_post_sql) === true) {
        $story_id = 0;
        $get_story_sql = "SELECT * FROM stories ORDER BY id DESC LIMIT 1";
        $story_result = mysqli_query($conn, $get_story_sql);
        if(mysqli_num_rows($story_result) > 0) {
          $story_data = $story_result->fetch_array();
          $story_id = $story_data['id'];
        }
        if(count($img_name_arr) > 0) {
          for($i=0; $i<count($img_name_arr); $i++) 
          {
            $uploaded_date = date("Y-m-d h:i:s");
            $updated_date = date("Y-m-d h:i:s");
            var_dump('Name: ' . $img_name_arr[$i] . $img_size_arr[$i] . $img_type_arr[$i]);
            $upload_img_sql = "INSERT INTO images(name, size, type, story_id, uploaded_date, updated_date)
              VALUES('$img_name_arr[$i]', $img_size_arr[$i], '$img_type_arr[$i]', $story_id, '$uploaded_date', '$updated_date')";
            if($conn->query($upload_img_sql)) {
              header("Location: new-post.php?img=uploaded");
            } else {
              header("Location: new-post.php?img=failed");
            }
          }
        }
        header("Location: post.php?post=draft");
      } else {
        $error = "Error: " . $conn->error;
      }
    } else {
      $error = 'Please input the title!';
    }
  }
  if(isset($_POST['save_publish'])) {
    $post_title = trim($_POST['title']);
    $post_content = $_POST['content'];
    $post_desc = $_POST['description'];
    if($post_title == '' || $post_content == '') {
      $check_required = true;
    } else {
      $post_cate = trim($_POST['category']);
      $post_status = strtolower(PUBLISH);
      $post_vis = strtolower(PUBLICVIS);
      $post_user = $get_user['id'];

      if(!empty($_FILES['thumbnail']['name'])) {
        $file_extens = array("jpg", "png", "jpeg", "gif");
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
        $thumb_size = $_FILES["thumbnail"]["size"];
        $thumb_des = "../assets/upload/thumbnails/" . $thumbnail;
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

      if(!empty(array_filter($_FILES['images']['name']))) {
        $file_extens = array("jpg", "png", "jpeg", "gif");
        foreach($_FILES['images']['name'] as $key=>$val) {
          $img_name = $_FILES['images']['name'][$key];
          $img_tmpname = $_FILES["images"]["tmp_name"][$key];
          $img_size = $_FILES["images"]["size"][$key];
          $img_des = "../assets/upload/images/" . $img_name;
          $img_type = strtolower(pathinfo($img_des, PATHINFO_EXTENSION));
          if(!in_array($img_type, $file_extens)) {
            $error = "Image's file extension is not valid!";
          } else {
            if(move_uploaded_file($img_tmpname, $img_des)) {
              array_push($img_name_arr, $img_name);
              array_push($img_size_arr, $img_size);
              array_push($img_type_arr, $img_type);
            } else {
              $error = "Can't upload image!";
            }
          }
        }
      }

      if($thumbnail != '') {
        $post_thumbnail = $thumbnail;
      } else {
        $post_thumbnail = '';
      }
      $post_create = date("Y-m-d h:i:s");
      $post_update = date("Y-m-d h:i:s");
      $publish_post_sql = "INSERT INTO stories(title, content, description, thumbnail, status, visibility, user_id, category_id, created_date, updated_date)
                        VALUES('$post_title', '$post_content', '$post_desc', '$post_thumbnail', '$post_status', '$post_vis', $post_user, $post_cate, '$post_create', '$post_update')";
      if($conn->query($publish_post_sql) === true) {
        $story_id = 0;
        $get_story_sql = "SELECT * FROM stories ORDER BY id DESC LIMIT 1";
        $story_result = mysqli_query($conn, $get_story_sql);
        if(mysqli_num_rows($story_result) > 0) {
          $story_data = $story_result->fetch_array();
          $story_id = $story_data['id'];
        }
        if(count($img_name_arr) > 0) {
          for($i=0; $i<count($img_name_arr); $i++) 
          {
            $uploaded_date = date("Y-m-d h:i:s");
            $updated_date = date("Y-m-d h:i:s");
            var_dump('Name: ' . $img_name_arr[$i] . $img_size_arr[$i] . $img_type_arr[$i]);
            $upload_img_sql = "INSERT INTO images(name, size, type, story_id, uploaded_date, updated_date)
              VALUES('$img_name_arr[$i]', $img_size_arr[$i], '$img_type_arr[$i]', $story_id, '$uploaded_date', '$updated_date')";
            if($conn->query($upload_img_sql)) {
              header("Location: new-post.php?img=uploaded");
            } else {
              header("Location: new-post.php?img=failed");
            }
          }
        }
        header("Location: post.php?post=publish");
      } else {
        $error = "Error: " . $conn->error;
      }
    }
  }
  // if(count($img_name_arr) > 0) {
  //   for($i=0; $i<count($img_name_arr); $i++) 
  //   {
  //     var_dump('Name: ' . $img_name_arr[$i] . $img_size_arr[$i] . $img_type_arr[$i]);
  //   }
  // }
?>

    <div class="content">
      <form action="new-post.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-9">
            <div class="card">
              <div class="card-header">
                <h2 class="add-post">Title</h2>
                <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
              </div>
              <div class="card-body">
                <input type="text" name="title" id="post_title" class="form-control input-lg">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                <input type="file" name="thumbnail" id="thumbnail-input" class="input-display">
                <button type="button" id="thumbnail-button" class="btn btn-default btn-sm"><i class="fa fa-camera-retro"></i> Add Thumbnail</button>
                <span id="thumbnail-text" class="file-text">No file chosen!</span>
              </div>
              <div class="card-body">
                <textarea name="content" id="post_content" cols="30" rows="30" class="form-control"></textarea>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Description</h3>
                <?php echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
              </div>
              <div class="card-body">
                <textarea name="description" id="post_description" cols="30" rows="3" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Publish</h3>
              </div>
              <div class="card-body">
                <span class="status"><i class="fa fa-thermometer-full"></i>Status: <strong><?php echo ucfirst($default_status); ?></strong></span>
                <span class="status"><i class="fa fa-eye"></i>Visibility: <strong><?php echo ucfirst($default_visibility); ?></strong></span>
                <span class="status"><i class="fa fa-calendar"></i>Publish: <strong><?php echo ucfirst($default_time_text); ?></strong></span>
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
                        <option value="<?php echo $categories['id']; ?>"><?php echo ucfirst($categories['name']); ?></option>
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
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Featured Image</h3>
                <!-- <h4 class="text-danger"><?php //echo $error_img != '' ? $error_img : ''; ?></h4> -->
                <!-- <h4 class="text-success"><?php //echo $msg_img != '' ? $error_img : ''; ?></h4> -->
              </div>
              <div class="card-body">
                <div class="row">
                  <!-- <div class="col-xs-12">
                    <img src="../assets/upload/<?php //echo $data['image'] != '' ? 'images/' . $data['image'] : 'no-image.png'; ?>" class="img-responsive" alt="">
                  </div> -->
                  <div class="col-xs-8">
                    <input type="file" name="images[]" id="image-input" class="input-display" multiple>
                    <button type="button" id="image-button" class="btn btn-default btn-sm mar-top">Choose File</button>
                    <span id="image-text" class="file-text">No file chosen!</span>
                    <input type="submit" name="upload_image" class="btn btn-default btn-sm" id="btn_images_upload" value="Upload">
                  </div>
                  <div class="col-xs-4">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
      
<?php
  include "share/footer.inc.php";
?>