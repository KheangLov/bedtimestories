<?php
  $index = false;
  $home = true;
  $about = false;
  $stories = false;
  include "share/header.inc.php";
?>

  <section class="bg bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="inner-col">
            <h1 class="sect-header">The storytelling app for families</h1>
            <h4 class="sect-text">Awake the inner storyteller with diverse and empowering stories for young & old. Storytelling has never been easier.</h4>
            <a href="#sect-tab" class="btn btn-default btn-lg btn-bcolor">How does it work?</a>
            <a href="index.html" class="btn btn-default btn-lg btn-bwhite">Explore Library</a>
            <div class="sect-link">
              <a href="http://www.parents-choice.org/product.cfm?product_id=35555" class="link">
                Parents' Choice Approved App
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <img src="assets/images/Hero-Karlotta@1x-8bd462e8.jpg" alt="Hero-Karlotta@1x-8bd462e8" class="img-responsive">
          <div class="story-link text-center">
            <a href="stories/karlotta.html" class="link">Karlotta the Knight</a> with her squire and steed.
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg bg-color">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="inner-col">
            <img src="assets/images/family.svg" alt="family" class="img-responsive">
            <h3 class="col-header">Quality Family Time</h3>
            <p class="col-text">Storytelling plays a vital role when growing up. Create lasting memories and embark on fantastic journeys with beloved characters.</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="inner-col">
            <img src="assets/images/bookshelf.svg" alt="bookshelf" class="img-responsive">
            <h3 class="col-header">Teach Valuable Life Lessons</h3>
            <p class="col-text">We deeply care about diversity and empowerment - each Storyworld contains educational aspects and storytelling tips to teach valuable life lessons.</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="inner-col">
            <img src="assets/images/book.svg" alt="book" class="img-responsive">
            <h3 class="col-header">A Safety Net for Storytelling</h3>
            <p class="col-text">Each story includes an easy-to-remember summary of Storypoints and the interactive Storybuilder generates millions of exciting storylines.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="sect-tab" class="bg bg-white">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="tab-header">A platform for families</h2>
          <p class="tab-text">
            We deeply care about captivating stories - Bedtime Stories is built to help you tell better stories and helps you engage with your family through storytelling.
          </p>
          <ul class="nav nav-pills nav-stacked nav-custom">
            <li class="active">
              <a data-toggle="tab" href="#first-story">
                <h3 class="inner-theader">Growing collection of Storyworlds</h3>
                <p class="inner-ttext">
                  Explore exciting Storyworlds in every imaginable genre for storytellers, readers and listeners from young to old.
                </p>
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#second-story">
                <h3 class="inner-theader">Endless source of storylines</h3>
                <p class="inner-ttext">
                  Storyworlds are growing collections of thematically-related stories written by authors from around the world.
                </p>
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#third-story">
                <h3 class="inner-theader">Growing collection of Storyworlds</h3>
                <p class="inner-ttext">
                  Interactively create your very own adventures - generate millions of hilarious stories in your genre of choice.
                </p>
              </a>
            </li>
          </ul>
          <a href="https://itunes.apple.com/us/app/bedtime-stories-read-tell/id1231933548" class="app-store">
            <img src="assets/images/app-store.svg" alt="app-store" class="img-appstore">
          </a>
        </div>
        <div class="col-sm-6">
          <div class="tab-content">
            <div id="first-story" class="tab-pane fade in active">
              <img src="assets/images/explore@1x-5ede6cd7.jpg" alt="explore@1x" class="img-responsive img-center">
            </div>
            <div id="second-story" class="tab-pane fade">
              <img src="assets/images/storyworld@1x-8aff2543.jpg" alt="storyworld@1x" class="img-responsive img-center">
            </div>
            <div id="third-story" class="tab-pane fade">
              <img src="assets/images/storybuilder@1x-c2817d58.jpg" alt="storybuilder@1x" class="img-responsive img-center">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="jumbotron jumbo-bg no-mar">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="jumbo-header"> Stay in the know </h1>
          <h2 class="jumbo-text"> 
            Receive must-read articles and feature updates 
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

  <section class="bg bg-color more-padding">
    <div class="container">
      <div class="text-center last-sect">
        <h1 class="header">Don't be shy, say hi!</h1>
        <p class="text">
          We might deal with trolls, werewolfs and huge dogs, <br>
          but we don’t bite.
        </p>
        <a href="mailto:support@getbedtimestories.com" class="btn btn-default btn-lg btn-git">Get in touch</a>
      </div>
      <div class="img-wrap">
        <div class="img-overlay" style="background-image: url('assets/images/budo-00685600.png')"></div>
      </div>
    </div>
  </section>

<?php
  include "share/footer.inc.php";
?>