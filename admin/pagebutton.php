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
    $check_id_sql = "SELECT * FROM page_buttons WHERE id = $id LIMIT 1";
    $check_id_result = mysqli_query($conn, $check_id_sql);
    if(mysqli_num_rows($check_id_result) != 0) {
      $edit_sql = "SELECT page_buttons.*, page_posts.title AS page_name 
        FROM page_buttons 
        INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
        WHERE page_buttons.id = $id";
      $edit_result = mysqli_query($conn, $edit_sql);
      if(mysqli_num_rows($edit_result) > 0) {
        $edit = $edit_result->fetch_array();
      }
    } else {
      header("Location: pagebutton.php?id=wrong");
    }
  }
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
    if($get_page < 1) {
      header("Location: pagebutton.php?page=1");
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
      $check_page_name_sql = "SELECT * FROM page_buttons WHERE LOWER(name) = LOWER('$page_name')";
      $check_page_name_result = mysqli_query($conn, $check_page_name_sql);
      if(mysqli_num_rows($check_page_name_result) != 0) {
        $error = 'Page post already exist!';
      } else {
        $page_link = trim($_POST['link']);
        $page_id = trim($_POST['page_post']);
        $page_classes = trim($_POST['classes']);
        $insert_page = "INSERT INTO page_buttons(`name`, `page_post_id`, `link`, `classes`) 
          VALUES('{$page_name}', {$page_id}, '{$page_link}', '{$page_classes}')";
        if($conn->query($insert_page)) {
          header("Location: pagebutton.php?page=posted");
        } else {
          $error = "Error: " . $conn->error;
        }
      }
    }
  }

  if(isset($_POST['edit_page'])) {
    $page_name = trim($_POST['name']);
    $check_page_sql = "SELECT * FROM page_buttons WHERE LOWER(name) = LOWER('{$page_name}') AND `id` != {$id}";
    $check_page_result = mysqli_query($conn, $check_page_sql);
    if(mysqli_num_rows($check_page_result) > 0) {
        $error = 'Page post already existed!'; 
    } else {
      $page_link = trim($_POST['link']);
      $page_id = trim($_POST['page_post']);
      $page_classes = trim($_POST['classes']);
      $update_cate = "UPDATE `page_buttons`
        SET `name` = '{$page_name}', `link` = '{$page_link}', `page_post_id` = {$page_id}, `classes` = '{$page_classes}' 
        WHERE `id` = {$id}";
      if($conn->query($update_cate) === true) {
        header("Location: pagebutton.php?updated=success");
      } else {
        $error = "Error: " . $conn->error;
        // header("Location: category.php?updated=fail");
      }
    }
  }
  $sql = "SELECT * FROM page_buttons";
  $result = mysqli_query($conn, $sql);
  $number_of_user = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $page_sql = "SELECT page_buttons.*, page_posts.title AS page_name 
    FROM page_buttons 
    INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
    LIMIT $first_page_result, $per_page";
  $pages_result = mysqli_query($conn, $page_sql);
?>

    <div class="content">
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
              <h2 class="add-post"><?php echo $id == '' ? 'Add' : 'Edit'; ?> Page Button</h2>
            </div>
            <div class="card-body">
              <form action="pagebutton.php<?php echo $id != '' ? '?id=' . $id : ''; ?>" method="post">
                <div class="form-group">
                  <label class="info-name">Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo isset($_GET['id']) && $edit['name'] != '' ? $edit['name'] : ''; ?>">
                </div>
                <div class="form-group">
                  <label class="info-name">Link</label>
                  <textarea name="link" cols="3" rows="3" class="form-control">
                    <?php echo isset($_GET['id']) && $edit['link'] != '' ? trim($edit['link']) : ''; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label class="info-name">Page Post</label>
                  <select name="page_post" class="form-control">
                    <?php
                      $get_ptype_sql = "SELECT * FROM page_posts";
                      $get_ptype_result = mysqli_query($conn, $get_ptype_sql);
                      if(mysqli_num_rows($get_ptype_result) > 0) :
                        while($rows = $get_ptype_result->fetch_assoc()) :
                          var_dump($rows);
                    ?>
                          <option value="<?php echo $rows['id']; ?>"<?php echo isset($_GET['id']) && $rows['title'] == $edit['page_name'] ? ' selected' : ''; ?>><?php echo ucfirst($rows['title']); ?></option>
                    <?php
                        endwhile;
                      endif;
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="info-name">Classes</label>
                  <input type="text" name="classes" class="form-control" value="<?php echo isset($_GET['id']) && $edit['classes'] != '' ? $edit['classes'] : ''; ?>">
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
                      <h2 class="add-post">All Page Buttons</h2>
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
                        <th>Link</th>
                        <th>Page Post</th>
                        <th>Classes</th>
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
                            <td><strong><?php echo $ptypes['name']; ?></strong></td>
                            <td><?php echo $ptypes['link']; ?></td>
                            <td><?php echo $ptypes['page_name']; ?></td>
                            <td><?php echo $ptypes['classes']; ?></td>
                            <td class="td-actions">
                              <a href="pagebutton.php?<?php echo "id={$ptypes['id']}"; ?>" class="btn-icon btn-icon-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="ti-pencil"></i>
                              </a>
                              <a href="#" onClick="deletePageButton(<?php echo $ptypes['id']; ?>)" class="btn-icon btn-icon-danger" data-toggle="tooltip" data-placement="top" title="Delete">
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
                        <th>Link</th>
                        <th>Page Post</th>
                        <th>Classes</th>
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
        if(mysqli_num_rows($pages_result) > 0) :
      ?>
          <div class="pagination-wrap text-right">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="pagebutton.php?page=1" aria-label="Previous">
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
                  // if($get_page > $number_of_page) {
                  //   header("Location: pagebutton.php?page=$number_of_page");
                  // }
                  // var_dump($number_of_page);
                  for($page=1; $page<=$number_of_page; $page++) :
                ?>
                    <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="pagebutton.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
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
                  <a href="pagebutton.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
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