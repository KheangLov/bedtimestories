<?php
  $index = false;
  $home = true;
  $about = false;
  $stories = false;
  include "share/header.inc.php";

  // $sql = "SELECT page_buttons.name AS btn_name, page_buttons.link AS btn_link, page_buttons.classes AS btn_classes, 
  //   pages.position, pages.name AS page_name, pages.id AS page_id, page_types.name AS pt_name, 
  //   page_posts.title, page_posts.content, page_posts.description, page_posts.image 
  //   FROM page_buttons
  //   INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
  //   INNER JOIN pages ON page_posts.page_id = pages.id
  //   INNER JOIN page_types ON pages.page_type_id = page_types.id";
  // SELECT * FROM pages
  //     INNER JOIN page_types ON pages.page_type_id = page_types.id
  //     INNER JOIN page_posts ON pages.id = page_posts.page_id
  //     WHERE LOWER(page_types.name) = 'type1'
  $sql = "SELECT * FROM pages";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) :
    $sql_ptype = "SELECT pages.*, page_types.name AS pt_name FROM pages
      INNER JOIN page_types ON pages.page_type_id = page_types.id";
    $result_ptype = mysqli_query($conn, $sql_ptype);
    if(mysqli_num_rows($result_ptype) > 0) :
      while($data = $result_ptype->fetch_assoc()) :
        if(strtolower($data['pt_name']) == 'type1') :
          $pId = $data['id'];
          $post_sql = "SELECT * FROM page_posts
            INNER JOIN pages ON page_posts.page_id = pages.id
            WHERE pages.id = {$pId} AND LOWER(pages.status) = 'show' LIMIT 1";
          $result_post = mysqli_query($conn, $post_sql);
          if(mysqli_num_rows($result_post) > 0) :
            $rows = $result_post->fetch_array();
  ?>
            <section class="bg bg-white">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="inner-col">
                      <h1 class="sect-header"><?php echo $rows['title']; ?></h1>
                      <h4 class="sect-text"><?php echo $rows['content']; ?></h4>
                      <?php
                        $check_btn = "SELECT page_buttons.*, pages.id AS page_id FROM page_buttons
                          INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
                          INNER JOIN pages ON page_posts.page_id = pages.id
                          WHERE pages.id = {$pId}";
                        $result_btn = mysqli_query($conn, $check_btn);
                        while($btns = $result_btn->fetch_assoc()) :
                      ?>
                          <a href="<?php echo $btns['link']; ?>" class="<?php echo $btns['classes']; ?>"><?php echo $btns['name']; ?></a>
                      <?php
                        endwhile;
                      ?>
                      <!-- <a href="index.php" class="btn btn-default btn-lg btn-bwhite">Explore Library</a> -->
                      <!-- <div class="sect-link">
                        <a href="http://www.parents-choice.org/product.cfm?product_id=35555" class="link">
                          Parents' Choice Approved App
                        </a>
                      </div> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <img src="assets/upload/post_images/<?php echo $rows['image']; ?>" alt="Hero-Karlotta@1x-8bd462e8.jpg" class="img-responsive">
                    <div class="story-link text-center">
                      Karlotta the Knight with her squire and steed.
                    </div>
                  </div>
                </div>
              </div>
            </section>
  <?php
          endif;
        elseif(strtolower($data['pt_name']) == 'type2') :
          $pId = $data['id'];
          $post_sql = "SELECT * FROM page_posts
            INNER JOIN pages ON page_posts.page_id = pages.id
            WHERE pages.id = {$pId} AND LOWER(pages.status) = 'show' LIMIT 3";
          $result_post = mysqli_query($conn, $post_sql);
          if(mysqli_num_rows($result_post) > 0) :
  ?>
            <section class="bg bg-color">
              <div class="container">
                <div class="row">
                  <?php
                    while($rows = $result_post->fetch_assoc()):
                  ?>
                      <div class="col-sm-4">
                        <div class="inner-col">
                          <img src="assets/upload/post_images/<?php echo $rows['image']; ?>" alt="<?php echo $rows['image']; ?>" class="img-responsive">
                          <h3 class="col-header"><?php echo $rows['title']; ?></h3>
                          <p class="col-text"><?php echo $rows['content']; ?></p>
                        </div>
                      </div>
                  <?php
                    endwhile;
                  ?>
                </div>
              </div>
            </section>
  <?php
          endif;
        elseif(strtolower($data['pt_name']) == 'type3') :
          $pId = $data['id'];
          $post_sql = "SELECT pages.*, page_buttons.name AS btn_name, page_buttons.link AS btn_link, page_buttons.classes AS btn_classes, 
            pages.position, pages.name AS page_name, pages.id AS page_id, page_types.name AS pt_name, 
            page_posts.title, page_posts.content, page_posts.description, page_posts.image 
            FROM page_buttons
            INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
            INNER JOIN pages ON page_posts.page_id = pages.id
            INNER JOIN page_types ON pages.page_type_id = page_types.id
            WHERE pages.id = {$pId} AND LOWER(pages.status) = 'show' LIMIT 3";
          $result_post = mysqli_query($conn, $post_sql);
          if(mysqli_num_rows($result_post) > 0) :
  ?>
            <section id="sect-tab" class="bg bg-white">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                    <h2 class="tab-header">A platform for families</h2>
                    <p class="tab-text">
                      We deeply care about captivating stories - Bedtime Stories is built to help you tell better stories and helps you engage with your family through storytelling.
                    </p>
                    <ul class="nav nav-pills nav-stacked nav-custom">
                      <?php
                        $i = 0;
                        while($rows = $result_post->fetch_assoc()):
                          $i++;
                      ?>
                          <li class="post-tab<?php echo $i == 1 ? ' active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $rows['btn_link']; ?>">
                              <h3 class="inner-theader"><?php echo $rows['title']; ?></h3>
                              <p class="inner-ttext">
                                <?php echo $rows['content']; ?>
                              </p>
                            </a>
                          </li>
                      <?php
                        endwhile;
                      ?>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <div class="tab-content">
                      <?php
                        $post_sql = "SELECT page_buttons.name AS btn_name, page_posts.image 
                          FROM page_buttons
                          INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
                          INNER JOIN pages ON page_posts.page_id = pages.id
                          WHERE pages.id = {$pId}";
                        $result_post = mysqli_query($conn, $post_sql);
                        $i = 0;
                        while($rows = $result_post->fetch_assoc()) :
                          $i++;
                      ?>
                          <div id="<?php echo $rows['btn_name']; ?>" class="tab-pane fade<?php echo $i == 1 ? ' in active' : ''; ?>">
                            <img src="assets/upload/post_images/<?php echo $rows['image']; ?>" alt="<?php echo $rows['image']; ?>" class="img-responsive img-center">
                          </div>
                      <?php
                        endwhile;
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </section>
  <?php
          endif;
        elseif(strtolower($data['pt_name']) == 'type4') :
          $pId = $data['id'];
          $post_sql = "SELECT * FROM page_posts
            INNER JOIN pages ON page_posts.page_id = pages.id
            WHERE pages.id = {$pId} AND LOWER(pages.status) = 'show' LIMIT 1";
          $result_post = mysqli_query($conn, $post_sql);
          if(mysqli_num_rows($result_post) > 0) :
            $rows = $result_post->fetch_array();
  ?>
            <div class="jumbotron jumbo-bg no-mar">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                    <h1 class="jumbo-header"><?php echo $rows['title']; ?></h1>
                    <h2 class="jumbo-text"> 
                    <?php echo $rows['content']; ?>
                    </h2>
                  </div>
                  <div class="col-sm-6">
                    <div class="input-group input-group-lg">
                      <input type="text" class="form-control form-custom" placeholder="Enter your email">
                      <span class="input-group-btn">
                        <button class="btn btn-default btn-form" type="button">Subscribe</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  <?php        
          endif;
        elseif(strtolower($data['pt_name']) == 'type5'):
          $pId = $data['id'];
          $post_sql = "SELECT pages.*, page_buttons.name AS btn_name, page_buttons.link AS btn_link, page_buttons.classes AS btn_classes, 
            pages.name AS page_name, pages.id AS page_id, page_types.name AS pt_name, 
            page_posts.title, page_posts.content, page_posts.description, page_posts.image 
            FROM page_buttons
            INNER JOIN page_posts ON page_buttons.page_post_id = page_posts.id
            INNER JOIN pages ON page_posts.page_id = pages.id
            INNER JOIN page_types ON pages.page_type_id = page_types.id
            WHERE pages.id = {$pId} AND LOWER(pages.status) = 'show' LIMIT 1";
          $result_post = mysqli_query($conn, $post_sql);
          if(mysqli_num_rows($result_post) > 0) :
            $rows = $result_post->fetch_array();
  ?>
            <section class="bg bg-color more-padding">
              <div class="container">
                <div class="text-center last-sect">
                  <h1 class="header"><?php echo $rows['title']; ?></h1>
                  <p class="text">
                    <?php echo $rows['content']; ?>
                  </p>
                  <a href="<?php echo $rows['btn_link']; ?>" class="<?php echo $rows['btn_classes']; ?>"><?php echo $rows['btn_name']; ?></a>
                </div>
                <div class="img-wrap">
                  <div class="img-overlay" style="background-image: url('assets/upload/post_images/<?php echo $rows['image']; ?>')"></div>
                </div>
              </div>
            </section>
  <?php
          endif;
        endif;
      endwhile;
    endif;
  endif;
?>

<?php
  include "share/footer.inc.php";
?>