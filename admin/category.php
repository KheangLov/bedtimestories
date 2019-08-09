<?php
  $cate = true;
  $post = false;
  $index = false;
  $profile = false;
  $user = false;
  $page = false;
  ob_start();
  include "share/header.inc.php";
  if(strtolower($_SESSION['role_name']) != ADMIN && strtolower($_SESSION['role_name']) != AUTHOR) {
    header("Location: index.php?permission=denied");
  }
  $msg = '';
  $error = '';
  $cate_id = '';
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $cate_id = $_GET['id'];
    $check_id_sql = "SELECT * FROM categories WHERE id = $cate_id LIMIT 1";
    $check_id_result = mysqli_query($conn, $check_id_sql);
    if(mysqli_num_rows($check_id_result) != 0) {
      $edit_sql = "SELECT * FROM categories WHERE id = $cate_id";
      $edit_result = mysqli_query($conn, $edit_sql);
      if(mysqli_num_rows($edit_result) > 0) {
        $edit = $edit_result->fetch_array();
      }
    } else {
      header("Location: category.php?cate_id=wrong");
    }
  }
  if(isset($_POST['add_cate'])) {
    if($_POST['name'] != '') {
      $cate_name = trim($_POST['name']);
      $cate_desc = trim($_POST['description']);
      $check_cate_sql = "SELECT * FROM categories WHERE LOWER(name) = LOWER('$cate_name')";
      $check_cate_result = mysqli_query($conn, $check_cate_sql);
      if(mysqli_num_rows($check_cate_result) != 0) {
        $error = 'Category already existed!';
      } else {
        $insert_cate = "INSERT INTO categories(name, description) VALUES('$cate_name', '$cate_desc')";
        if($conn->query($insert_cate) === true) {
          header("Location: category.php?inserted=success");
        } else {
          header("Location: category.php?inserted=fail");
        }
      }
    }
  }
  if(isset($_POST['edit_cate'])) {
    $cate_name = trim($_POST['name']);
    $cate_desc = trim($_POST['description']);
    $check_cate_sql = "SELECT * FROM categories WHERE LOWER('name') = LOWER('$cate_name') AND id != $cate_id";
    $check_cate_result = mysqli_query($conn, $check_cate_sql);
    if(mysqli_num_rows($check_cate_result) > 0) {
        $error = 'Category already existed!'; 
    } else {
      $update_cate = "UPDATE categories SET name = '$cate_name', description = '$cate_desc' WHERE id = $cate_id";
      if($conn->query($update_cate) === true) {
        header("Location: category.php?updated=success");
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
      $msg = 'Category have been deleted!';
    } else if($deleted === strtolower(FAIL)) {
      $error = 'Fail to delete category!';
    }
  } else if(isset($_GET['updated'])) {
    $updated = strtolower(trim($_GET['updated']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'Category have been updated!';
    }
    // } else {
    //   $error = 'Fail to update category!';
    // }
  } else if(isset($_GET['inserted'])) {
    $updated = strtolower(trim($_GET['inserted']));
    if($updated === strtolower(SUCCESS)) {
      $msg = 'Category have been created!';
    } else {
      $error = 'Fail to created category!';
    }
  }
  $sql = "SELECT * FROM categories";
  $result = mysqli_query($conn, $sql);
  $number_of_post = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $cate_sql = "SELECT * FROM categories LIMIT $first_page_result, $per_page";
  $cate_result = mysqli_query($conn, $cate_sql);
?>

    <div class="content">
      <?php
        if(isset($_GET['cate_id']) && strtolower($_GET['cate_id']) === 'wrong') :
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
                  <h2 class="add-post"><?php echo $cate_id == '' ? 'Add' : 'Edit'; ?> Categories</h2>
                </div>
                <div class="card-body">
                  <form action="category.php<?php echo $cate_id != '' ? '?id=' . $cate_id : ''; ?>" method="post">
                    <div class="form-group">
                      <label class="info-name">Name</label>
                      <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['name'] : ''; ?>">
                    </div>
                    <div class="form-group">
                      <label class="info-name">Description</label>
                      <input type="text" name="description" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['description'] : ''; ?>">
                    </div>
                    <div class="form-group text-right">
                      <input type="submit" name="<?php echo $cate_id == '' ? 'add' : 'edit'; ?>_cate" class="btn btn-<?php echo $cate_id == '' ? 'primary' : 'info'; ?>" value="<?php echo $cate_id == '' ? 'Add' : 'Edit'; ?>">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
              if(mysqli_num_rows($cate_result) > 0) :
            ?>
                <div class="col-sm-8">
                  <div class="card card-tasks">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-sm-8">
                          <h2 class="add-post">All Categories</h2>
                          <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                          <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input type="text" name="search" id="search-category" class="form-control input-mar" placeholder="Search">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-striped" id="table-category">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Category Name</th>
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
                            while($cates = $cate_result->fetch_assoc()) :
                              $i++;
                          ?>
                              <tr>
                                <td><strong><?php echo $i; ?></strong></td>
                                <td><strong><?php echo $cates['name']; ?></strong></td>
                                <td><?php echo $cates['description']; ?></td>
                                <td class="td-actions">
                                  <a href="category.php?<?php echo "id={$cates['id']}"; ?>" class="btn-icon btn-icon-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="ti-pencil"></i>
                                  </a>
                                  <a href="#" onClick="deleteCate(<?php echo $cates['id']; ?>)" class="btn-icon btn-icon-danger" data-toggle="tooltip" data-placement="top" title="Delete">
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
                            <th>Category Name</th>
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
              <a href="category.php?page=1" aria-label="Previous">
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
                <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="category.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
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
              <a href="category.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
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