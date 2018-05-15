<?php include('config.php'); ?>
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
          <form class="form" action="login.php" method="post">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="username" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
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
