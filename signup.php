<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>UserAccounts - Sign up</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  </head>
  <body>

    <?php include(INCLUDE_PATH . "/layouts/navbar.php") ?>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <h2 class="text-center">Sign up</h2>
          <form class="form" action="signup.php" method="post">
            <!-- row for first and last name -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>First name</label>
                  <input type="text" name="firstname" value="" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Last name</label>
                  <input type="text" name="lastname" value="" class="form-control">
                </div>
              </div>
            </div>
            <!-- // end row -->
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <label>Password confirmation</label>
              <input type="password" name="passwordConf" class="form-control">
            </div>
            <!-- row for profile image upload -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Profile Image</label>
                  <button type="button" id="profile_img_btn" class="btn btn-default" style="display: block;">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload image
                  </button>

                  <!-- form upload input field: Hide this and use button instead - for styling purposes -->
                  <input type="file" name="profile_input" id="profile_input" value="" style="display: none;">

                </div>
                <div class="form-group">
                  <button type="submit" name="signup_btn" class="btn btn-success">Sign up</button>
                </div>
              </div>
              <div class="col-md-6">
                <div id="image_display">

                </div>
              </div>
            </div>
            <!-- // end row -->
            <p>Aready have an account? <a href="signin.php">Sign in</a></p>
          </form>
        </div>
      </div>
    </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
<script type="text/javascript">
  $(document).ready(function(){

    // when user clicks on the upload profile image button ...
    $(document).on('click', '#profile_img_btn', function(){
      // ...use Jquery to click on the hidden file input field
      $('#profile_input').click();

      // a 'change' event occurs when user selects image from the system.
      // when that happens, grab the image and display it
      $(document).on('change', '#profile_input', function(){

      });

    });
  });
</script>
