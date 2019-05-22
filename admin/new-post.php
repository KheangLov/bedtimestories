<?php
  $post = true;
  $index = false;
  $profile = false;
  $user = false;
  include "share/header.inc.php";
?>

    <div class="content">
      <div class="row">
        <div class="col-sm-9">
          <div class="card">
            <div class="card-header">
              <h2 class="add-post">Add New Post</h2>
            </div>
            <div class="card-body">
              <input type="text" name="add" class="form-control input-lg">
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <button class="btn btn-default"><i class="fa fa-camera-retro"></i> Add Media</button>
              <button class="btn btn-default"><i class="fa fa-film"></i> Add Gallery Video</button>
            </div>
            <div class="card-body">
              <textarea name="content" id="" cols="30" rows="30" class="form-control"></textarea>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="add-post">Excerpt</h3>
            </div>
            <div class="card-body">
              <textarea name="content" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <div class="card-header">
              <h3 class="add-post">Publish</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <button class="btn btn-default">Save Draft</button>
                </div>
                <div class="col-sm-6 text-right">
                  <button class="btn btn-default">Preview</button>
                </div>
              </div>
              <span class="status"><i class="fa fa-thermometer-full"></i>Status: <strong>Draft</strong></span>
              <span class="status"><i class="fa fa-eye"></i>Visibility: <strong>Public</strong></span>
              <span class="status"><i class="fa fa-calendar"></i>Publish: <strong>immediately</strong></span>
              <div class="btn-wrap text-right">
                <button class="btn btn-default btn-pub">Publish</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="add-post">Categories</h3>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs tabs-custom">
                <li class="active"><a data-toggle="tab" href="#all-categories">All Categories</a></li>
                <li><a data-toggle="tab" href="#most-used">Most Used</a></li>
              </ul>
              <div class="tab-content">
                <div id="all-categories" class="tab-pane fade in active">
                  <input type="checkbox" class="tab-check"> Education <br>
                  <input type="checkbox" class="tab-check"> News <br>
                  <input type="checkbox" class="tab-check"> Sport <br>
                  <input type="checkbox" class="tab-check"> Technology
                </div>
                <div id="most-used" class="tab-pane fade">
                  <input type="checkbox" class="tab-check"> Technology <br>
                  <input type="checkbox" class="tab-check"> Sport <br>
                  <input type="checkbox" class="tab-check"> News
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="#" class="add-cat"><i class="fa fa-plus"></i> Add New Categories</a>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="add-post">Tags</h3>
            </div>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control input-sm" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default" type="submit">
                    Add
                  </button>
                </div>
              </div>
              <div class="text-wrap">
                <span class="sub-text">Separate tags with commas</span>
              </div>
              <div class="link-wrap">
                <a href="#" class="tags-link">Choose from the most used tags</a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="add-post">Featured Image</h3>
            </div>
            <div class="card-body">
              <a href="#" class="img-link">Set featured image</a>
            </div>
          </div>
        </div>
      </div>
    </div>
      
<?php
  include "share/footer.inc.php";
?>