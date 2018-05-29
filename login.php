<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>UserAccounts - Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  </head>
  <body>
    <?php include(INCLUDE_PATH . "/layouts/navbar.php") ?>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <h2 class="text-center">Login</h2>
          <!-- display form error messages  -->
          <?php include(INCLUDE_PATH . "/layouts/messages.php") ?>

          <form class="form" action="login.php" method="post">
            <?php if (isset($errors['email'])): ?>
              <div class="form-group has-error">
            <?php else: ?>
              <div class="form-group">
            <?php endif; ?>
              <label class="control-label">Email Address</label>
              <input type="email" name="email" id="password" value="<?php echo $email; ?>" class="form-control">
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
              <input type="password" name="password" id="password" class="form-control">
              <?php if (isset($errors['password'])): ?>
                <span class="help-block"><?php echo $errors['password'] ?></span>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <button type="submit" name="login_btn" class="btn btn-success">Login</button>
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
          </form>
        </div>
      </div>
    </div>

<?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
