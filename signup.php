<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>UserAccounts - Sign up</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <style media="screen">
      #image_display {
        height: 90px;
        width: 80px;
        float: right;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <h2 class="text-center">Sign up</h2>
          <form class="form" action="signup.php" method="post" enctype="multipart/form-data">
            <!-- row for first and last name -->
            <div class="row">
              <div class="col-md-6">

                <!-- Firstname  -->
                <?php if (isset($errors['firstname'])): ?>
                  <div class="form-group has-error">
                <?php else: ?>
                  <div class="form-group">
                <?php endif; ?>
                  <label class="control-label">First name</label>
                  <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control">
                  <?php if (isset($errors['firstname'])): ?>
                    <span class="help-block"><?php echo $errors['firstname'] ?></span>
                  <?php endif; ?>
                </div>

              </div>
              <div class="col-md-6">
                <!-- Lastname -->
                <?php if (isset($errors['lastname'])): ?>
                  <div class="form-group has-error">
                <?php else: ?>
                  <div class="form-group">
                <?php endif; ?>
                  <label class="control-label">Last name</label>
                  <input type="text" name="lastname" value="<?php echo $lastname; ?>" class="form-control">
                  <?php if (isset($errors['lastname'])): ?>
                    <span class="help-block"><?php echo $errors['lastname'] ?></span>
                  <?php endif; ?>
                </div>

              </div>
            </div>
            <!-- // end row -->

            <?php if (isset($errors['email'])): ?>
              <div class="form-group has-error">
            <?php else: ?>
              <div class="form-group">
            <?php endif; ?>
              <label class="control-label">Email Address</label>
              <input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
              <?php if (isset($errors['email'])): ?>
                <span class="help-block"><?php echo $errors['email'] ?></span>
              <?php endif; ?>
            </div>

            <?php if (isset($errors['password'])): ?>
              <div class="form-group has-error">
            <?php else: ?>
              <div class="form-group">
            <?php endif; ?>
              <label class="control-label">Password</label>
              <input type="password" name="password" class="form-control">
              <?php if (isset($errors['password'])): ?>
                <span class="help-block"><?php echo $errors['password'] ?></span>
              <?php endif; ?>
            </div>

            <?php if (isset($errors['passwordConf'])): ?>
              <div class="form-group has-error">
            <?php else: ?>
              <div class="form-group">
            <?php endif; ?>
              <label class="control-label">Password confirmation</label>
              <input type="password" name="passwordConf" class="form-control">
              <?php if (isset($errors['passwordConf'])): ?>
                <span class="help-block"><?php echo $errors['passwordConf'] ?></span>
              <?php endif; ?>
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
                  <input type="file" name="profile_picture" id="profile_picture" value="" style="display: none;">
                </div>
                <div class="form-group">
                  <button type="submit" name="signup_btn" class="btn btn-success">Sign up</button>
                </div>
              </div>
              <div class="col-md-6">
                <img src="" id="image_display" alt="">
              </div>
            </div>
            <!-- // end row -->
            <p>Aready have an account? <a href="login.php">Sign in</a></p>
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
      $('#profile_picture').click();

      // a 'change' event occurs when user selects image from the system.
      // when that happens, grab the image and display it
      $(document).on('change', '#profile_picture', function(){
        // grab the file
        var file = $('#profile_picture')[0].files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // set the value of the input for profile picture
                $('#profile_picture').attr('value', file.name);
                // display the image
                $('#image_display').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
      });

    });
  });
</script>
