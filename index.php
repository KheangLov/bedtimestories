<?php
  $index = true;
  $home = false;
  $about = false;
  $stories = false;
  include "share/header.inc.php";
  include "share/explore.inc.php";
?>

  <div class="container">
    <?php
      $latest_sql = "SELECT stories.*, categories.`name` AS cate_name FROM stories
        LEFT JOIN categories ON stories.`category_id` = categories.`id`
        WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public' 
        ORDER BY created_date DESC LIMIT 6";
      $latest_result = mysqli_query($conn, $latest_sql);
      if(mysqli_num_rows($latest_result) > 0) :
    ?>
        <section class="section-wrapper">
          <div class="section-header">
            <h4 class="section-title">Latest Posts</h4>
          </div>
          <div class="block-grid-xs-2 block-grid-sm-4 block-grid-md-6 block-grid-lg-6">
            <?php
              while($rows = $latest_result->fetch_assoc()) :
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

      $all_stories_sql = "SELECT stories.*, categories.`name` AS cate_name FROM stories
        LEFT JOIN categories ON stories.`category_id` = categories.`id`
        WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public' LIMIT 12";
      $all_stories_result = mysqli_query($conn, $all_stories_sql);
      if(mysqli_num_rows($all_stories_result) > 0) :
    ?>
        <section class="section-wrapper">
          <div class="section-header">
            <h4 class="section-title">All Stories</h4>
            <a href="seemore.php" class="see-more">See More</a>
          </div>
          <div class="block-grid-xs-2 block-grid-sm-4 block-grid-md-6 block-grid-lg-6">
            <?php
              while($rows = $all_stories_result->fetch_assoc()) :
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

      $cates_sql = "SELECT * FROM categories";
      $cates_result = mysqli_query($conn, $cates_sql);
      if(mysqli_num_rows($cates_result) > 0) :
        while($all_cates = $cates_result->fetch_assoc()) :
          $cate_id = $all_cates['id'];
          $cate_name = $all_cates['name'];
          $count_cate_sql = "SELECT COUNT(*) AS count_cate FROM categories
            INNER JOIN stories ON categories.id = stories.category_id
            WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public' AND LOWER(categories.name) = LOWER('{$cate_name}')";
          $result_cate_count = mysqli_query($conn, $count_cate_sql);
          $count_cate = $result_cate_count->fetch_assoc();
          $cate_sql = "SELECT categories.name AS cate_name, stories.* FROM categories
            INNER JOIN stories ON categories.id = stories.category_id 
            WHERE LOWER(stories.`status`) = 'publish' AND LOWER(stories.`visibility`) = 'public' AND LOWER(categories.name) = LOWER('{$cate_name}') LIMIT 6";
          $cate_result = mysqli_query($conn, $cate_sql);
          if(mysqli_num_rows($cate_result) > 0) :
    ?>
            <section class="section-wrapper">
              <div class="section-header">
                <h4 class="section-title"><?php echo $cate_name; ?></h4>
                <?php
                  if($count_cate['count_cate'] > 6) :
                ?>
                    <a href="seemore.php?cate_id=<?php echo $cate_id; ?>" class="see-more">See More</a>
                <?php
                  endif;
                ?>
              </div>
              <div class="block-grid-xs-2 block-grid-sm-4 block-grid-md-6 block-grid-lg-6">
                <?php
                  while($rows = $cate_result->fetch_assoc()) :
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
        endwhile;
      endif;
    ?>
  </div>

<?php
  include "share/footer.inc.php";
?>