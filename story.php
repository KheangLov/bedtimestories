<?php
  $index = true;
  $home = false;
  $about = false;
  $stories = false;
  include "share/header.inc.php";
  $story_id = 0;
  if(isset($_GET['id'])) {
    $story_id = $_GET['id'];
  }
  $sql = "SELECT * FROM stories WHERE id = {$story_id}";
  $result = mysqli_query($conn, $sql);
?>
  <div class="container">
    <?php
      if(mysqli_num_rows($result) > 0) :
        $data = $result->fetch_assoc();
    ?>
    <div class="row no-gutter single-post">
      <div class="col-md-9 main-content">
        <main class="content">
          <h2 class="story-title"><?php echo $data['title']; ?></h2>
          <p class="story-text">
            <?php echo $data['content']; ?>
          </p>
          <?php
            $img_sql = "SELECT * FROM images WHERE story_id = {$story_id}";
            $img_result = mysqli_query($conn, $img_sql);
            while($imgs = $img_result->fetch_assoc()) :
          ?>
              <img src="../assets/upload/images/<?php echo $imgs['name']; ?>" alt="<?php echo $imgs['name']; ?>" class="img-responsive img-radius">
          <?php
            endwhile;
          ?>
        </main>
      </div>
      <div class="col-md-3 suggest-bar">
        <aside class="suggestion">
          <h3 class="suggest-header">Suggestion</h3>
          <?php
            $sug_sql = "SELECT stories.*, categories.name AS cate_name FROM stories
              INNER JOIN categories ON stories.category_id = categories.id 
              ORDER BY stories.created_date DESC LIMIT 5";
            $sug_result = mysqli_query($conn, $sug_sql);
            if(mysqli_num_rows($sug_result) > 0) :
          ?>
              <ul class="list-unstyled suggest-menu">
                <?php
                  while($sug = $sug_result->fetch_assoc()) :
                ?>
                    <li class="suggest-item clearfix">
                      <a href="story.php?id=<?php echo $sug['id']; ?>" class="suggest-inner card">
                        <div class="suggest-thumb">
                          <div style="background-image: url('<?php echo $sug['thumbnail'] != '' ? 'assets/upload/thumbnails/' . $sug['thumbnail'] : 'assets/upload/no-image.png'; ?>')" class="thumb-overlay"></div>
                        </div>
                        <div class="suggest-description card-body">
                          <h6 class="suggest-title"><?php echo $sug['title']; ?></h6>
                          <span class="suggest-type"><i class="fa fa-user"></i><?php echo $sug['cate_name']; ?></span>
                        </div>
                      </a>
                    </li>
                <?php
                  endwhile;
                ?>
              </ul>
          <?php
            endif;
          ?>
        </aside>
      </div>
    </div>
    <?php
      endif;
    ?>
  </div>
<?php
  include "share/footer.inc.php";
?>