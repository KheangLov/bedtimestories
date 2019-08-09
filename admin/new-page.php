<?php
  $post = false;
  $index = false;
  $profile = false;
  $user = false;
  $cate = false;
  $page = true;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  $post_image = '';
  if(isset($_POST['add_page_type'])) {
    $ptype_name = trim($_POST['ptype_name']);
    $ptype_desc = trim($_POST['ptype_description']);
    if($ptype_name != '') {
      $check_ptype_sql = "SELECT * FROM page_types WHERE LOWER(name) = LOWER('$ptype_name')";
      $check_ptype_result = mysqli_query($conn, $check_ptype_sql);
      if(mysqli_num_rows($check_ptype_result) != 0) {
        $error = 'Page type already exist!';
      } else {
        $cate_sql = "INSERT INTO page_types(name, description) VALUES('$ptype_name', '$ptype_desc')";
        if($conn->query($cate_sql) === true) {
          $msg = 'New page type created successfully';
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    } else {
      $error = 'Please input page type name!';
    }
  }
  if(isset($_POST['post_page'])) {
    if(!empty($_POST['page_name'])) {
      $page_name = trim($_POST['page_name']);
      $check_page_name_sql = "SELECT * FROM pages WHERE LOWER(name) = LOWER('$page_name')";
      $check_page_name_result = mysqli_query($conn, $check_page_name_sql);
      if(mysqli_num_rows($check_page_name_result) != 0) {
        $error = 'Page type already exist!';
      } else {
        $page_type = $_POST['page_type'];
        $page_status = trim($_POST['page_status']);
        $page_create = date("Y-m-d h:i:s");
        $page_update = date("Y-m-d h:i:s");
        $insert_page = "INSERT INTO pages(`name`, `page_type_id`, `status`, `created_date`, `updated_date`) 
          VALUES('{$page_name}', {$page_type}, '{$page_status}', '{$page_create}', '{$page_update}')";
        if($conn->query($insert_page)) {
          $page_sql = "SELECT * FROM pages WHERE LOWER(name) = LOWER('$page_name')";
          $page_result = mysqli_query($conn, $page_sql);
          if(mysqli_num_rows($page_result) > 0) {
            $page_data = $page_result->fetch_array();
            $page_id = $page_data['id'];
          }
          $post_title = trim($_POST['post_title']);
          $post_content = trim($_POST['post_content']);
          $post_description = trim($_POST['post_description']);
          if(!empty($_FILES['post_image']['name'])) {
            $file_extens = array("jpg", "png", "jpeg", "gif");
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
          $insert_page_post = "INSERT INTO page_posts(title, content, image, page_id, description) 
            VALUES('{$post_title}', '{$post_content}', '{$post_image}', {$page_id}, '{$post_description}')";
          if($conn->query($insert_page_post) === true) {
            header("Location: page.php?pages=posted");
          } else {
            $error = "Error: " . $conn->error;
          }
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    }
  }
?>

    <div class="content">
      <form action="new-page.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-9">
            <div class="card">
              <div class="card-header">
                <h2 class="add-post">Post Title</h2>
                <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                <?php // echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
              </div>
              <div class="card-body">
                <input type="text" name="post_title" id="post_title" class="form-control input-lg">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <?php // echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
                <input type="file" name="post_image" id="thumbnail-input" class="input-display">
                <button type="button" id="thumbnail-button" class="btn btn-default btn-sm"><i class="fa fa-camera-retro"></i> Add Image</button>
                <span id="thumbnail-text" class="file-text">No file chosen!</span>
              </div>
              <div class="card-body">
                <textarea name="post_content" id="post_content" cols="30" rows="30" class="form-control"></textarea>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Description</h3>
                <?php // echo $check_required == true ? '<h5 class="text-danger">* required</h5>' : ''; ?>
              </div>
              <div class="card-body">
                <textarea name="post_description" id="post_description" cols="30" rows="3" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h2 class="page-name">Page Name</h2>
              </div>
              <div class="card-body">
                <input type="text" name="page_name" id="page_title" class="form-control input-md">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h2 class="page-name">Page Status</h2>
              </div>
              <div class="card-body">
                <select name="page_status" class="form-control input-sm">
                  <option value="<?php echo SHOW; ?>"><?php echo ucfirst(SHOW); ?></option>
                  <option value="<?php echo HIDE; ?>"><?php echo ucfirst(HIDE); ?></option>
                </select>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Page types</h3>
              </div>
              <div class="card-body">
                <select name="page_type" class="form-control input-sm">
                  <?php
                    $get_ptype_sql = "SELECT * FROM page_types";
                    $get_ptype_result = mysqli_query($conn, $get_ptype_sql);
                    if(mysqli_num_rows($get_ptype_result) > 0) :
                      while($rows = $get_ptype_result->fetch_assoc()) :
                  ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo ucfirst($rows['name']); ?></option>
                  <?php
                      endwhile;
                    endif;
                  ?>
                </select>
              </div>
              <div class="card-footer">
                <a type="button" data-toggle="collapse" data-target="#add-type-form" class="add-cat"><i class="fa fa-plus"></i> Add New Page Type</a>
                <div id="add-type-form" class="collapse text-right">
                  <input type="text" name="ptype_name" class="form-control input-sm mar-top-bot" placeholder="Name">
                  <textarea name="ptype_description" class="form-control input-sm mar-top-bot" placeholder="Description" cols="3" rows="3"></textarea>
                  <input type="submit" class="btn btn-default btn-sm" name="add_page_type" value="Add">
                </div>
              </div>
            </div>
            <!-- <div class="card">
              <div class="card-header">
                <h3 class="add-post">Buttons</h3>
              </div>
              <div class="card-body" id="button_body"></div>
              <div class="card-footer">
                <a type="button" data-toggle="collapse" data-target="#add-btn-form" class="add-cat"><i class="fa fa-plus"></i> Add New Button</a>
                <div id="add-btn-form" class="collapse text-right">
                  <input type="text" name="pbtn_name" class="form-control input-sm mar-top-bot" id="page_btn_name" placeholder="Name">
                  <input type="text" name="pbtn_link" class="form-control input-sm mar-top-bot" id="page_btn_link" placeholder="Link">
                  <input type="submit" class="btn btn-default btn-sm" name="add_page_btn" value="Add">
                  <button class="btn btn-default btn-sm" id="add_page_btn">Add</button>
                </div>
              </div>
            </div> -->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <a href="page.php" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-sm-6 text-right">
                    <input type="submit" name="post_page" value="Post" class="btn btn-primary">
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