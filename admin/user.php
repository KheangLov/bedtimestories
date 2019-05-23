<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  include "share/header.inc.php";
  $msg = '';
  $error = '';
  if(isset($_GET['page'])) {
    $get_page = $_GET['page'];
  } else {
    $get_page = 1;
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
    if($banned === strtolower(SUCCESS)) {
      $msg = 'User have been banned!';
    } else if($banned === strtolower(FAIL)) {
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
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
  $number_of_user = mysqli_num_rows($result);
  $per_page = PERPAGE;
  $first_page_result = ($get_page - 1) * $per_page;
  $users_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id ORDER BY role_id, updated_date LIMIT $first_page_result, $per_page";
  $users_result = mysqli_query($conn, $users_sql);
?>

    <div class="content">
      <a href="new-user.php" class="btn btn-default btn-addp">Add New</a>
      <?php
        if(mysqli_num_rows($users_result) > 0) :
      ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-tasks">
                <div class="card-header">
                  <h2 class="add-post">All Users</h2>
                  <h4 class="text-danger"><?php echo $error != '' ? $error : ''; ?></h4>
                  <h4 class="text-success"><?php echo $msg != '' ? $msg : ''; ?></h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
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
                        while($row = $users_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><strong><?php echo ucfirst($row['fullname']); ?></strong></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo strtolower($row['status']) == strtolower(ACTIVE) ? '<span class="label label-success">' . ucfirst($row['status']) . '</span>' : (strtolower($row['status']) == strtolower(INACTIVE) ? '<span class="label label-danger">' . ucfirst($row['status']) . '</span>' : (strtolower($row['status']) == strtolower(BAN) ? '<span class="label label-warning">' . ucfirst($row['status']) . '</span>' : '')); ?></td>
                            <td><span class="label label-default"><?php echo ucfirst($row['role_name']); ?></span></td>
                            <td class="td-actions">
                              <a href="show-user.php?<?php echo "id={$row['id']}"; ?>" class="btn btn-primary">
                                <i class="fa fa-list-alt"></i>
                              </a>
                              <a href="edit-user.php?<?php echo "id={$row['id']}"; ?>" class="btn btn-info">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <?php
                                if(strtolower($row['role_name']) != 'admin' || strtolower($row['status']) != strtolower(ACTIVE)) :
                              ?>
                                  <?php
                                    if(strtolower($row['status']) == strtolower(ACTIVE)) :
                                  ?>
                                      <a href="#" onClick="banUser(<?php echo $row['id']; ?>)" class="btn btn-warning">
                                        <i class="fa fa-ban"></i>
                                      </a>
                                  <?php
                                    endif;
                                  ?>
                                <a href="#" onClick="deleteUser(<?php echo $row['id']; ?>)" class="btn btn-danger">
                                  <i class="fa fa-times"></i>
                                </a>
                              <?php
                                endif;
                              ?>
                            </td>
                          </tr>
                      <?php
                        endwhile;
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
      <?php
        endif;
      ?>
      <div class="pagination-wrap text-right">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li>
              <a href="user.php?page=1" aria-label="Previous">
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
              // var_dump($number_of_page);
              for($page=1; $page<=$number_of_page; $page++) :
            ?>
                <li class="<?php echo $page == $get_page ? 'active' : ''; ?>"><a href="user.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
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
              <a href="user.php?page=<?php echo $number_of_page; ?>" aria-label="Next">
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