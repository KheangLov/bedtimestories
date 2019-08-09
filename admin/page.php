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
    $check_id_sql = "SELECT * FROM pages WHERE id = $id LIMIT 1";
    $check_id_result = mysqli_query($conn, $check_id_sql);
    if(mysqli_num_rows($check_id_result) != 0) {
      $edit_sql = "SELECT pages.*, page_types.name AS pt_name FROM pages 
        INNER JOIN page_types ON pages.page_type_id = page_types.id
        WHERE pages.id = $id";
      $edit_result = mysqli_query($conn, $edit_sql);
      if(mysqli_num_rows($edit_result) > 0) {
        $edit = $edit_result->fetch_array();
      }
    } else {
      header("Location: page.php?id=wrong");
    }
  }
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
    if($get_page < 1) {
      header("Location: page.php?page=1");
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
    if(!empty($_POST['name'])) {
      $page_name = trim($_POST['name']);
      $check_page_name_sql = "SELECT * FROM pages WHERE LOWER(name) = LOWER('$page_name')";
      $check_page_name_result = mysqli_query($conn, $check_page_name_sql);
      if(mysqli_num_rows($check_page_name_result) != 0) {
        $error = 'Page already exist!';
      } else {
        $page_type = $_POST['page_type'];
        $page_status = trim($_POST['status']);
        $page_positon = $_POST['position'];
        $page_create = date("Y-m-d h:i:s");
        $page_update = date("Y-m-d h:i:s");
        $insert_page = "INSERT INTO pages(`name`, `page_type_id`, `status`, `position`, `created_date`, `updated_date`) 
          VALUES('{$page_name}', {$page_type}, '{$page_status}', {$page_positon}, '{$page_create}', '{$page_update}')";
        if($conn->query($insert_page)) {
          header("Location: page.php?page=posted");
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    }
  }

  if(isset($_POST['edit_page'])) {
    $page_name = trim($_POST['name']);
    $check_page_sql = "SELECT * FROM pages WHERE LOWER('name') = LOWER('{$page_name}') AND `id` != {$id}";
    $check_page_result = mysqli_query($conn, $check_page_sql);
    if(mysqli_num_rows($check_page_result) > 0) {
        $error = 'Page already existed!'; 
    } else {
      $page_type = $_POST['page_type'];
      $page_status = trim($_POST['status']);
      $page_positon = $_POST['position'];
      $page_update = date("Y-m-d h:i:s");
      $update_cate = "UPDATE pages 
        SET `name` = '{$page_name}', `page_type_id` = {$page_type}, `status` = '{$page_status}', `position` = '{$page_positon}', `updated_date` = '{$page_update}'
        WHERE `id` = {$id}";
      if($conn->query($update_cate) === true) {
        header("Location: page.php?updated=success");
      } else {
        $error = "Error: " . $conn->error;
        // header("Location: category.php?updated=fail");
      }
    }
  }
  $sql = "SELECT * FROM pages";
  $result = mysqli_query($conn, $sql);
  $number_of_user = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $page_sql = "SELECT pages.*, page_types.name AS pt_name 
    FROM pages 
    INNER JOIN page_types ON pages.page_type_id = page_types.id
    ORDER BY pages.updated_date DESC LIMIT $first_page_result, $per_page";
  $pages_result = mysqli_query($conn, $page_sql);
?>

    <div class="content">
      <div class="row">
        <div class="col-sm-6">
          <!-- <a href="new-page.php" class="btn btn-default btn-addp">
            <span class="btn-label">
              <i class="ti-plus"></i> 
            </span>
            Add Pages
          </a> -->
          <a href="pagetype.php" class="btn btn-default btn-addp">
            <span class="btn-label">
              <i class="ti-plus"></i> 
            </span>
            Add Page Types
          </a>
          <a href="pagepost.php" class="btn btn-default btn-addp">
            <span class="btn-label">
              <i class="ti-plus"></i> 
            </span>
            Add Page Posts
          </a>
        </div>
        <div class="col-sm-6 text-right">
        </div>
      </div>
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
              <h2 class="add-post"><?php echo $id == '' ? 'Add' : 'Edit'; ?> Page</h2>
            </div>
            <div class="card-body">
              <form action="page.php<?php echo $id != '' ? '?id=' . $id : ''; ?>" method="post">
                <div class="form-group">
                  <label class="info-name">Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['name'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label class="info-name">Page Type</label>
                  <select name="page_type" class="form-control">
                    <?php
                      $get_ptype_sql = "SELECT * FROM page_types";
                      $get_ptype_result = mysqli_query($conn, $get_ptype_sql);
                      if(mysqli_num_rows($get_ptype_result) > 0) :
                        while($rows = $get_ptype_result->fetch_assoc()) :
                    ?>
                          <option value="<?php echo $rows['id']; ?>"<?php echo isset($_GET['id']) && $rows['name'] == $edit['pt_name'] ? ' selected' : ''; ?>><?php echo ucfirst($rows['name']); ?></option>
                    <?php
                        endwhile;
                      endif;
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="info-name">Position</label>
                  <input type="number" name="position" class="form-control" value="<?php echo isset($_GET['id']) != '' ? $edit['position'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label class="info-name">Status</label>
                  <select name="status" class="form-control">
                    <option value="<?php echo SHOW; ?>"<?php echo isset($_GET['id']) && strtolower($edit['status']) == SHOW ? ' selectd' : ''; ?>><?php echo ucfirst(SHOW); ?></option>
                    <option value="<?php echo HIDE; ?>"<?php echo isset($_GET['id']) && strtolower($edit['status']) == HIDE ? ' selectd' : ''; ?>><?php echo ucfirst(HIDE); ?></option>
                  </select>
                </div>
                <div class="form-group text-right">
                  <input type="submit" name="<?php echo $id == '' ? 'add' : 'edit'; ?>_page" class="btn btn-<?php echo $id == '' ? 'primary' : 'info'; ?>" value="<?php echo $id == '' ? 'Add' : 'Edit'; ?>">
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
                      <h2 class="add-post">All Pages</h2>
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
                        <th>Page Type</th>
                        <th>Position</th>
                        <th>Status</th>
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
                        while($ptypes = $pages_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><strong><?php echo $i; ?></strong></td>
                            <td><strong><?php echo $ptypes['name']; ?></strong></td>
                            <td><?php echo $ptypes['pt_name']; ?></td>
                            <td><?php echo $ptypes['position']; ?></td>
                            <td><?php echo strtolower($ptypes['status']) == SHOW ? '<span class="label label-primary">' . ucfirst(SHOW) . '</span>' : (strtolower($ptypes['status']) == HIDE ? '<span class="label label-danger">' . ucfirst(HIDE) . '</span>' : ''); ?></td>
                            <td class="td-actions">
                              <a href="page.php?<?php echo "id={$ptypes['id']}"; ?>" class="btn-icon btn-icon-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="ti-pencil"></i>
                              </a>
                              <a href="#" onClick="deletePage(<?php echo $ptypes['id']; ?>)" class="btn-icon btn-icon-danger" data-toggle="tooltip" data-placement="top" title="Delete">
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
                        <th>Page Type</th>
                        <th>Position</th>
                        <th>Status</th>
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
              <a href="page.php?page=1" aria-label="Previous">
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
                header("Location: page.php?page=$number_of_page");
              }
              // var_dump($number_of_page);
              for($page=1; $page<=$number_of_page; $page++) :
            ?>
                <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="page.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
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
              <a href="page.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
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