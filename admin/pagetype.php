<?php
  $cate = false;
  $post = false;
  $index = false;
  $profile = false;
  $user = false;
  $page = true;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  $pt_id = '';
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $pt_id = $_GET['id'];
    $check_id_sql = "SELECT * FROM page_types WHERE id = $pt_id LIMIT 1";
    $check_id_result = mysqli_query($conn, $check_id_sql);
    if(mysqli_num_rows($check_id_result) != 0) {
      $edit_sql = "SELECT * FROM page_types WHERE id = $pt_id";
      $edit_result = mysqli_query($conn, $edit_sql);
      if(mysqli_num_rows($edit_result) > 0) {
        $edit = $edit_result->fetch_array();
      }
    } else {
      header("Location: pagetype.php?pt_id=wrong");
    }
  }
  if(isset($_POST['add_ptype'])) {
    if($_POST['name'] != '') {
      $cate_name = trim($_POST['name']);
      $cate_desc = trim($_POST['description']);
      $check_cate_sql = "SELECT * FROM page_types WHERE LOWER(name) = LOWER('$cate_name')";
      $check_pt_result = mysqli_query($conn, $check_cate_sql);
      if(mysqli_num_rows($check_pt_result) != 0) {
        $error = 'Page type already existed!';
      } else {
        $insert_cate = "INSERT INTO page_types(name, description) VALUES('$cate_name', '$cate_desc')";
        if($conn->query($insert_cate) === true) {
          header("Location: pagetype.php?inserted=success");
        } else {
          header("Location: pagetype.php?inserted=fail");
        }
      }
    }
  }
  if(isset($_POST['edit_ptype'])) {
    $cate_name = trim($_POST['name']);
    $cate_desc = trim($_POST['description']);
    $check_cate_sql = "SELECT * FROM page_types WHERE LOWER('name') = LOWER('$cate_name') AND id != $pt_id";
    $check_pt_result = mysqli_query($conn, $check_cate_sql);
    if(mysqli_num_rows($check_pt_result) > 0) {
        $error = 'Page type already existed!'; 
    } else {
      $update_cate = "UPDATE page_types SET name = '$cate_name', description = '$cate_desc' WHERE id = $pt_id";
      if($conn->query($update_cate) === true) {
        header("Location: pagetype.php?updated=success");
      } else {
        $error = "Error: " . $conn->error;
        // header("Location: category.php?updated=fail");
      }
    }
  }
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
  } else {
    $get_page = 1;
  }
  if(isset($_GET['deleted'])) {
    $deleted = strtolower(trim($_GET['deleted']));
    if($deleted === strtolower(SUCCESS)) {
      $msg = 'Page type have been deleted!';
    } else if($deleted === strtolower(FAIL)) {
      $error = 'Fail to delete Page type!';
    }
  } else if(isset($_GET['updated'])) {
    $updated = strtolower(trim($_GET['updated']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'Page type have been updated!';
    }
  } else if(isset($_GET['inserted'])) {
    $updated = strtolower(trim($_GET['inserted']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'Page type have been created!';
    } else {
      $error = 'Fail to created Page type!';
    }
  }
  $sql = "SELECT * FROM page_types";
  $result = mysqli_query($conn, $sql);
  $number_of_post = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $pt_sql = "SELECT * FROM page_types LIMIT $first_page_result, $per_page";
  $pt_result = mysqli_query($conn, $pt_sql);
?>

    <div class="content">
      <?php
        if(isset($_GET['pt_id']) && strtolower($_GET['pt_id']) === 'wrong') :
      ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> Cannot find the provided post id!
          </div>
      <?php
        endif;
      ?>
      <?php
        if($error != '') :
      ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <?php echo $error; ?>
          </div>
      <?php
        endif;
      ?>
      <div class="row">
        <div class="col-sm-4">
          <div class="card card-tasks">
            <div class="card-header">
              <h2 class="add-post"><?php echo $pt_id == '' ? 'Add' : 'Edit'; ?> Page Types</h2>
            </div>
            <div class="card-body">
              <form action="pagetype.php<?php echo $pt_id != '' ? '?id=' . $pt_id : ''; ?>" method="post">
                <div class="form-group">
                  <label class="info-name">Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['name'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label class="info-name">Description</label>
                  <input type="text" name="description" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['description'] : ''; ?>">
                </div>
                <div class="form-group text-right">
                  <input type="submit" name="<?php echo $pt_id == '' ? 'add' : 'edit'; ?>_ptype" class="btn btn-<?php echo $pt_id == '' ? 'primary' : 'info'; ?>" value="<?php echo $pt_id == '' ? 'Add' : 'Edit'; ?>">
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
          if(mysqli_num_rows($pt_result) > 0) :
        ?>
            <div class="col-sm-8">
              <div class="card card-tasks">
                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2 class="add-post">All Page Types</h2>
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
                        <th>Name</th>
                        <th>Description</th>
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
                        while($ptypes = $pt_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><strong><?php echo $i; ?></strong></td>
                            <td><strong><?php echo $ptypes['name']; ?></strong></td>
                            <td><?php echo $ptypes['description']; ?></td>
                            <td class="td-actions">
                              <a href="pagetype.php?<?php echo "id={$ptypes['id']}"; ?>" class="btn-icon btn-icon-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="ti-pencil"></i>
                              </a>
                              <a href="#" onClick="deletePageType(<?php echo $ptypes['id']; ?>)" class="btn-icon btn-icon-danger" data-toggle="tooltip" data-placement="top" title="Delete">
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
                        <th>Name</th>
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
      <?php
        if(mysqli_num_rows($pt_result) > 0) :
      ?>
          <div class="pagination-wrap text-right">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="pagetype.php?page=1" aria-label="Previous">
                    <i class="fa fa-angle-double-left"></i>
                  </a>
                </li>
                <?php
                  if($get_page != '' && $get_page != 1) :
                ?>
                    <li>
                      <a href="#" onClick="prevCate(<?php echo $get_page; ?>)" aria-label="Previous">
                        <i class="fa fa-angle-left"></i>
                      </a>
                    </li>
                <?php
                  endif;
                  $number_of_page = ceil($number_of_post / $per_page);
                  for($page=1; $page<=$number_of_page; $page++) :
                ?>
                    <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="pagetype.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                <?php
                  endfor;
                  if($get_page != '' && $get_page != $number_of_page) :
                ?>
                    <li>
                      <a href="#" onClick="nextCate(<?php echo $get_page; ?>)" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                <?php
                  endif;
                ?>
                <li>
                  <a href="pagetype.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
                    <i class="fa fa-angle-double-right"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
      <?php
        endif;
      ?>
    </div>
      
<?php
  include "share/footer.inc.php";
?>