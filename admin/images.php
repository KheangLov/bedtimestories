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
  $msg_img = '';
  $error_img = '';
  if(isset($_POST['img'])) {
    if($_POST['img'] == 'uploaded') {
      $msg_img = "Feature image have been uploaded!";
    } else {
      $error_img = "Feature image fail to upload!";
    }
  }
  if(isset($_POST['upload'])) {
    if(!empty(array_filter($_FILES['images']['name']))) {
      $file_extens = array("jpg", "png", "jpeg", "gif");
      foreach($_FILES['images']['name'] as $key=>$val) {
        $img_name = $_FILES['images']['name'][$key];
        $img_tmpname = $_FILES["images"]["tmp_name"][$key];
        $img_size = $_FILES["images"]["size"][$key];
        $img_des = "../assets/upload/images/" . $img_name;
        $img_type = strtolower(pathinfo($img_des, PATHINFO_EXTENSION));
        if(!in_array($img_type, $file_extens)) {
          $error_img = "Image's file extension is not valid!";
        } else {
          if(move_uploaded_file($img_tmpname, $img_des)) {
            $upload_img_sql = "INSERT INTO images(name, size, type)
              VALUES('$img_name', $img_size, '$img_type')";
            if($conn->query($upload_img_sql)) {
              header("Location: images.php?img=uploaded");
            } else {
              header("Location: images.php?img=failed");
            }
          } else {
            $error_img = "Can't upload image!";
          }
        }
      }
    }
  }

  $sql = "SELECT * FROM images";
  $result = mysqli_query($conn, $sql);
?>

  <div class="content">
    <form action="images.php" method="post" enctype="multipart/form-data">
      <input type="file" name="images[]" id="multiple_upload" class="input-display" multiple>
      <button type="button" id="multiple_upload_button" class="btn btn-default btn-sm"><i class="ti-gallery"></i><strong> Add Images</strong></button>
      <span id="multiple_upload_text" class="file-text">No file chosen!</span>
      <input type="submit" name="upload" class="btn btn-default btn-sm" id="btn_images_upload" value="Upload">
    </form>

    <div class="row">
      <div class="col-sm-12">
        <div class="card card-tasks">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-8">
                <h2 class="add-post">All Images</h2>
                <h4 class="text-success"><?php echo $msg_img != '' ? $msg_img : ''; ?></h4>
                <h4 class="text-danger"><?php echo $error_img != '' ? $error_img : ''; ?></h4>
              </div>
              <div class="col-sm-4">
                <!-- <div class="form-group">
                  <input type="text" name="search" id="search-post" class="form-control input-mar" placeholder="Search">
                  <input type="hidden" name="role_name" id="user_role" value="<?php // echo $_SESSION['role_name'] ?>">
                  <input type="hidden" name="user_id" id="user_id" value="<?php // echo $_SESSION['user_id'] ?>">
                </div> -->
              </div>
            </div>
          </div>
          <?php
            if(mysqli_num_rows($result) > 0) :
          ?>
              <div class="card-body">
                <div class="row custom-row" id="image_data">
                  <?php
                    while($row = $result->fetch_assoc()) :
                  ?>
                      <div class="col-sm-3 custom-col text-center">
                        <img src="../assets/upload/images/<?php echo $row['name']; ?>" alt="" class="img-responsive custom-img">
                        <button onClick="deleteImage(<?php echo $row['id']; ?>)" class="btn btn-default btn-img">
                          <i class="ti-trash"></i>
                        </button>
                      </div>
                  <?php
                    endwhile;
                  ?>
                </div>
              </div>
          <?php
            endif;
          ?>
        </div>
      </div>
    </div>
  </div>
      
<?php
  include "share/footer.inc.php";
?>