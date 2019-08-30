<?php
  $index = false;
  $home = false;
  $about = true;
  $stories = false;
  include "share/header.inc.php";
  include "share/explore.inc.php";
?>

  <div class="container">
    <div class="row no-gutter single-post">
      <div class="col-md-9 main-content">
      <?php
        $sql = "SELECT page_posts.*, pages.*, page_types.name AS pt_name FROM page_posts
          INNER JOIN pages ON page_posts.page_id = pages.id
          INNER JOIN page_types ON pages.page_type_id = page_types.id
          WHERE LOWER(page_types.name) = 'type6' AND LOWER(pages.status) = 'show' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) :
          $rows = $result->fetch_array();
      ?>
          <main class="content">
            <h2 class="story-title"><?php echo $rows['title']; ?></h2>
            <p class="story-text">
            <?php echo $rows['content']; ?>
            </p>  
            <img src="assets/upload/post_images/<?php echo $rows['image']; ?>" alt="<?php echo $rows['image']; ?>" class="img-responsive img-radius">
            <section class="section-wrapper about">
              <div class="about-header more-margin">
                <h4 class="about-title">Press</h4>
              </div>
              <div class="stories">
                <a href="https://newliteraryvoices.net/2018/02/25/one-more-story-please/" class="story">
                  <h3 class="sub-header"> One more story, please! </h3>
                  <p class="sub-text">
                    New Literary Voices — February 2018
                  </p>
                </a>
              </div>
              <div class="stories">
                <a href="https://issuu.com/storymonstersink/docs/smi_2018_02_february_digital/30" class="story">
                  <h3 class="sub-header"> Sparking Imagination with Stellar Science </h3>
                  <p class="sub-text">
                    Story Monsters Ink — February 2018  
                  </p>
                </a>
              </div>
              <div class="stories">
                <a href="https://luxtimes.lu/culture-life/32600-mullerthal-trolls-invade-bedtime-story-app" class="story">
                  <h3 class="sub-header"> Mullerthal trolls invade bedtime story app </h3>
                  <p class="sub-text">
                    Luxembourg Times — January 2018
                  </p>
                </a>
              </div>
              <div class="stories">
                <a href="http://www.parents-choice.org/product.cfm?product_id=35555" class="story">
                  <h3 class="sub-header"> Parents' Choice Award for Bedtime Stories </h3>
                  <p class="sub-text">
                    Parents' Choice — January 2018
                  </p>
                </a>
              </div>
            </section>
          </main>
      <?php
        endif;
      ?>
      </div>
      <div class="col-md-3 suggest-bar">
        <aside class="suggestion">
          <div class="about-sidebar">
            <h3 class="about-sideheader">Join us?</h3>
            <p class="about-sidetext">
              We are always looking for authors from all around the world to join us and create exciting new characters and adventures.
            </p>
            <!-- <a href="join.html" class="btn btn-default btn-join">Join our team <i class="fa fa-heart"></i></a> -->
          </div>
          <!-- <div class="about-sidebar">
            <h3 class="about-sideheader">Download</h3>
            <a href="http://media.getbedtimestories.com/bedtimestories-presskit.zip" class="btn btn-default btn-lg btn-join">Download Press Kit <i class="fa fa-download"></i></a>
          </div> -->
        </aside>
      </div>
    </div>
  </div>

<?php
  include "share/footer.inc.php";
?>