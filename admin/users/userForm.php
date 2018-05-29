<?php include('../../config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/common_functions.php') ?>
<?php include(ROOT_PATH . '/admin/users/userLogic.php'); ?>
<?php  $roles = getAllRoles(); ?>

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

    <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">

          <a href="userList.php" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Users
          </a>
          <hr>


          <?php if ($isEditting === true ): ?>
            <h2 class="text-center">Update Admin user</h2>
          <?php else: ?>
            <h2 class="text-center">Create Admin user</h2>
          <?php endif; ?>
          <br>


          <form class="form" action="userForm.php" method="post" enctype="multipart/form-data">
            <!-- row for first and last name -->
            <div class="row">
              <div class="col-md-6">

                <?php if ($isEditting === true): ?>
                  <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <?php endif; ?>

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

            <div class="form-group">
              <label class="control-label">User Role</label>
              <select class="form-control" name="role_id">
                <option value="" ></option>
                <?php foreach ($roles as $role): ?>
                  <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                <?php endforeach; ?>
              </select>
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
                  <?php if ($isEditting === true ): ?>
                    <button type="submit" name="update_user" class="btn btn-primary">Updpate user</button>
                  <?php else: ?>
                    <button type="submit" name="save_user" class="btn btn-success">Save user</button>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <img src="" id="image_display" alt="">
              </div>
            </div>
            <!-- // end row -->
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
