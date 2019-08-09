<?php
  $index = true;
  $home = false;
  $about = false;
  $stories = false;
  include "share/header.inc.php";
  include "share/explore.inc.php";
  $cate_id = 0;
  if(isset($_GET['cate_id'])) {
    $cate_id = $_GET['cate_id'];
  }
?>

  <div class="container">
    <?php
      $sql = "";
      if($cate_id != 0) {
        $sql = "SELECT stories.*, categories.`name` AS cate_name FROM stories
          LEFT JOIN categories ON stories.`category_id` = categories.`id`
          WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public' AND categories.id = {$cate_id}";
      } else {
        $sql = "SELECT stories.*, categories.`name` AS cate_name FROM stories
          LEFT JOIN categories ON stories.`category_id` = categories.`id`
          WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public'";
      }
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) :
    ?>
        <section class="section-wrapper">
          <div class="section-header">
            <h4 class="section-title">All Stories</h4>
          </div>
          <div class="block-grid-xs-2 block-grid-sm-4 block-grid-md-6 block-grid-lg-6">
            <?php
              while($rows = $result->fetch_assoc()) :
            ?>
                <div class="block-grid-item">
                  <a href="story.php?id=<?php echo $rows['id']; ?>" class="block-inner card">
                    <div class="thumbnail">
                      <div style="background-image: url('<?php echo $rows['thumbnail'] != '' ? 'assets/upload/thumbnails/' . $rows['thumbnail'] : 'assets/upload/no-image.png'; ?>')" class="thumbnail-overlay"></div>
                    </div>
                    <div class="block-description card-body">
                      <h4 class="block-title"><?php echo $rows['title']; ?></h4>
                      <span class="block-type"><i class="fa fa-user"></i><?php echo $rows['cate_name']; ?></span>
                      <p class="block-text"><?php echo $rows['description']; ?></p>
                    </div>
                  </a>
                </div>
            <?php
              endwhile;
            ?>
          </div>
        </section>
    <?php
      endif;
    ?>
  </div>

<?php
  include "share/footer.inc.php";
?>