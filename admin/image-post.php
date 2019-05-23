<?php
  $post = true;
  $index = false;
  $profile = false;
  $user = false;
  include "share/header.inc.php";
  $msg = '';
  $error = '';
  $image = '';
  $target = '';
  $thumbnail = '';
  $check_required = false;
  $post_id = $_GET['id'];
  $post_sql = "SELECT stories.*, users.id AS users_id, categories.id AS cate_id, categories.name AS cate_name FROM stories INNER JOIN users ON stories.user_id = users.id INNER JOIN categories ON stories.category_id = categories.id WHERE stories.id = $post_id";
  $post_result = mysqli_query($conn, $post_sql);
  if(mysqli_num_rows($post_result) > 0) {
    $data = $post_result->fetch_array();
  }
  if(isset($_POST['upload_image'])) {
    $image = $_FILES['image']['name'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $img_tmpname = $_FILES['image']['tmp_name'];
    $thumb_tmpname = $_FILES['thumbnail']['tmp_name'];
    $img_des = "../assets/upload/images/" . $image;
    $thumb_des = "../assets/upload/thumbnails/" . $thumbnail;
    if(move_uploaded_file($img_tmpname, $img_des)) {
      $msg = "Feature image have been upload successfully!";
    } else {
      $error = "There was an error while uploading feature image!";
    }
    if(move_uploaded_file($thumb_tmpname, $thumb_des)) {
      $msg = "Thumbnail have been upload successfully!";
    } else {
      $error = "There was an error while uploading thumbnail!";
    }
    $upload_sql = "UPDATE stories SET image = '$image', thumbnail = '$thumbnail' WHERE id = $post_id";
    if($conn->query($upload_sql) === true) {
      header("Location: post.php?images=uploaded");
    } else {
      header("Location: post.php?images=failed");
    }
  }
  // var_dump($image);
  // var_dump($thumbnail);
?>

    <div class="content">
      <form action="image-post.php?id=<?php echo $post_id; ?>" id="post-form" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="add-post">Thumbnail</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                    <img src="<?php echo $thumb_des != '' ? $thumb_des : ''; ?>" class="img-responsive" alt="">
                  </div>
                  <div class="col-xs-8">
                    <input type="file" name="thumbnail" id="thumbnail-input" class="input-display" id="thumbnail-button">
                    <button type="button" id="thumbnail-button" class="btn btn-default btn-sm mar-top" id="thumbnail-button">Choose File</button>
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
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                    <img src="<?php echo $img_des != '' ? $img_des : ''; ?>" class="img-responsive" alt="">
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