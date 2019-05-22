<?php
  $user = true;
  $index = false;
  $profile = false;
  $post = false;
  include "share/header.inc.php";
  $users_sql = "SELECT users.*, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id";
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
                        $i = 0;
                        while($row = $users_result->fetch_assoc()) :
                          $i++;
                      ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><strong><?php echo ucfirst($row['fullname']); ?></strong></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo strtolower($row['status']) == strtolower(ACTIVE) ? '<span class="label label-success">' . ucfirst($row['status']) . '</span>' : (strtolower($row['status']) == strtolower(INACTIVE) ? '<span class="label label-warning">' . ucfirst($row['status']) . '</span>' : (strtolower($row['status']) == strtolower(BAN) ? '<span class="label label-danger">' . ucfirst($row['status']) . '</span>' : '')); ?></td>
                            <td><span class="label label-default"><?php echo ucfirst($row['role_name']); ?></span></td>
                            <td class="td-actions">
                              <a href="show-user.php?<?php echo "id={$row['id']}"; ?>" class="btn btn-primary">
                                <i class="fa fa-list-alt"></i>
                              </a>
                              <a href="edit-user.php?<?php echo "id={$row['id']}"; ?>" class="btn btn-info">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <?php
                                if(strtolower($row['role_name']) != 'admin') :
                              ?>
                                  <?php
                                    if(strtolower($row['status']) == strtolower(ACTIVE)) :
                                  ?>
                                      <a href="" type="button" rel="tooltip" title="" class="btn btn-warning" data-original-title="Remove">
                                        <i class="fa fa-ban"></i>
                                      </a>
                                  <?php
                                    endif;
                                  ?>
                                  <a href="" type="button" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove">
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
              <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
              <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
      
<?php
  include "share/footer.inc.php";
?>