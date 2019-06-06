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
  $msg_img = '';
  $error_img = '';
  $msg_thumb = '';
  $error_thumb = '';
  $image = '';
  $target = '';
  $thumbnail = '';
  $check_required = false;
  $post_id = $_GET['id'];
  $check_id_sql = "SELECT * FROM stories WHERE id = $post_id LIMIT 1";
  $check_id_result = mysqli_query($conn, $check_id_sql);
  if(mysqli_num_rows($check_id_result) != 0) {
    $post_sql = "SELECT stories.*, users.id AS users_id, categories.id AS cate_id, categories.name AS cate_name FROM stories INNER JOIN users ON stories.user_id = users.id INNER JOIN categories ON stories.category_id = categories.id WHERE stories.id = $post_id";
    $post_result = mysqli_query($conn, $post_sql);
    if(mysqli_num_rows($post_result) > 0) {
      $data = $post_result->fetch_array();
    }
    if(isset($_POST['upload_image'])) {
      $uploadedImg = false;
      $uploadedThumb = false;
      $file_extens = array("jpg", "png", "jpeg", "gif");
      $image = $_FILES['image']['name'];
      $thumbnail = $_FILES['thumbnail']['name'];
      $img_tmpname = $_FILES['image']['tmp_name'];
      $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
      $img_size = $_FILES["image"]["size"];
      $thumb_size = $_FILES["thumbnail"]["size"];
      $img_des = "../assets/upload/images/" . $image;
      $thumb_des = "../assets/upload/thumbnails/" . $thumbnail;
      $img_type = strtolower(pathinfo($img_des, PATHINFO_EXTENSION));
      $thumb_type = strtolower(pathinfo($thumb_des, PATHINFO_EXTENSION));
      if($img_size > 2000000) {
        $error_img = "Image size is too large!";
      } else {
        if(!in_array($img_type, $file_extens)) {
          $error_img = "Image's file extension is not valid!";
        } else {
          if(move_uploaded_file($img_tmpname, $img_des)) {
            $upload_img_sql = "UPDATE stories SET image = '$image' WHERE id = $post_id";
            if($conn->query($upload_img_sql) === true) {
              $msg_img = "Feature image have been uploaded!";
              $uploadedImg = true;
            } else {
              $error_img = "Feature image fail to upload!";
              $uploadedImg = true;
            }
          } else {
            $error_img = "Can't upload image!";
          }
        }
      }
      if($thumb_size > 2000000) {
        $error_thumb = "Files's size are too large!";
      } else {
        if(!in_array($thumb_type, $file_extens)) {
          $error_thumb = "Image's file extension is not valid!";
        } else {
          if(move_uploaded_file($thumb_tmpname, $thumb_des)) {
            $upload_thumb_sql = "UPDATE stories SET thumbnail = '$thumbnail' WHERE id = $post_id";
            if($conn->query($upload_thumb_sql) === true) {
              $msg_thumb = "Thumbnail image have been uploaded!";
              $uploadedThumb = true;
            } else {
              $error_thumb = "Thumbnail image fail to upload!";
              $uploadedThumb = true;
            }
          } else {
            $error_thumb = "Can't upload thumbnail!";
          }
        }
      }
      if($uploadedImg === true && $uploadedThumb === true) {
        header("Location: image-post.php?id={$post_id}");
      }
    }
  } else {
    header("Location: post.php?post_id=wrong");
  }
?>

    <div class="content">
      <form action="image-post.php?id=<?php echo $post_id; ?>" id="post-form" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Thumbnail</h3>
                <h4 class="text-danger"><?php echo $error_thumb != '' ? $error_thumb : ''; ?></h4>
                <h4 class="text-success"><?php echo $msg_thumb != '' ? $error_thumb : ''; ?></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                    <img src="../assets/upload/<?php echo $data['thumbnail'] != '' ? 'thumbnails/' . $data['thumbnail'] : 'no-image.png'; ?>" class="img-responsive" alt="">
                  </div>
                  <div class="col-xs-8">
                    <input type="file" name="thumbnail" id="thumbnail-input" class="input-display">
                    <button type="button" id="thumbnail-button" class="btn btn-default btn-sm mar-top">Choose File</button>
                    <span id="thumbnail-text" class="file-text">No file chosen!</span>
                  </div>
                  <div class="col-xs-4">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Featured Image</h3>
                <h4 class="text-danger"><?php echo $error_img != '' ? $error_img : ''; ?></h4>
                <h4 class="text-success"><?php echo $msg_img != '' ? $error_img : ''; ?></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                    <img src="../assets/upload/<?php echo $data['image'] != '' ? 'images/' . $data['image'] : 'no-image.png'; ?>" class="img-responsive" alt="">
                  </div>
                  <div class="col-xs-8">
                    <input type="file" name="image" id="image-input" class="input-display">
                    <button type="button" id="image-button" class="btn btn-default btn-sm mar-top">Choose File</button>
                    <span id="image-text" class="file-text">No file chosen!</span>
                  </div>
                  <div class="col-xs-4">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="add-post">Upload Thumbnail<br>and Featured Image</h3>
                  </div>
                  <div class="col-sm-4">
                    <input type="submit" value="Upload" name="upload_image" class="btn btn-primary btn-lg mar-top-bot">
                  </div>
                </div>
              </div>
              <div class="card-body"></div>
            </div>
          </div>
        </div>
      </form>
    </div>
      
<?php
  include "share/footer.inc.php";
?>