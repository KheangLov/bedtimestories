  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6 m-b">
          <div class="inner-footer">
            <a href="<?php //echo $stories == true ? '../' : ''; ?>index.php" class="brand-footer">
              <div class="row mar-bot">
                <div class="col-sm-2 text-center no-padd">
                  <div class="logo-brand">
                    <img src="<?php //echo $stories == true ? '../' : ''; ?>assets/images/icon-logo.png" alt="Bedtimestories" class="img-logo">
                  </div>
                </div>
                <div class="col-sm-10 no-lpadd">
                  <div class="text-brand">
                    <h2 class="name"> Bedtime Stories </h2>
                    <h3 class="text"> Exciting tales for young & old </h3>
                  </div>
                </div>
              </div>
            </a>
            <div class="text-footer">
              The storytelling app for families - read diverse <br>
              & empowering stories or tell them in your own <br>
              words.
            </div>
            <a href="#" class="cpyr-footer">
              &copy; Little Light Studio GmbH
            </a>
          </div>
        </div>
        <div class="col-md-2 m-b">
          <div class="inner-footer">
            <h2 class="menu-header">Product</h2>
            <ul class="list-unstyled">
              <li><a href="<?php echo $stories == true ? '../' : ''; ?>home.php">Home</a></li>
              <li><a href="<?php echo $stories == true ? '../' : ''; ?>index.php">Library</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 m-b">
          <div class="inner-footer">
            <h2 class="menu-header">Company</h2>
            <ul class="list-unstyled">
              <li><a href="<?php echo $stories == true ? '../' : ''; ?>aboutus.php">About Us</a></li>
              <li><a href="<?php echo $stories == true ? '../' : ''; ?>admin/index.php">Admin Site</a></li>
              <!-- <li><a href="<?php // echo $stories == true ? '../' : ''; ?>register.php">Register</a></li>
              <li><a href="<?php // echo $stories == true ? '../' : ''; ?>login.php">Log In</a></li> -->
            </ul>
          </div>
        </div>
        <div class="col-md-2 m-b">
          <div class="inner-footer">
            <h2 class="menu-header">Connect with us</h2>
            <ul class="list-unstyled">
              <li><a href="https://facebook.com/"><i class="fa fa-facebook-square"></i> Facebook</a></li>
              <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i> Twitter</a></li>
              <li><a href="https://instagram.com/"><i class="fa fa-instagram"></i> Instagram</a></li>
              <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i> Google-Plus</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v4.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- Your customer chat code -->
  <div class="fb-customerchat" attribution=setup_tool page_id="261157801473036" theme_color="#8E51C7"></div>
  
  <script src="assets/libraries/jQuery/jquery.min.js"></script>
  <script src="assets/libraries/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>