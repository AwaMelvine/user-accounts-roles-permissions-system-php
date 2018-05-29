<!-- the whole site is wrapped in a container div to give it some margin on the sides -->
<!-- closing container div can be found in the footer -->
<div class="container">

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo BASE_URL . 'admin/dashboard.php' ?>">Admin</a>
      </div>
      <!-- <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">

        <?php if (isset($_SESSION['user'])): ?>
          <li>
            <a href="#"><?php echo $_SESSION['user']['firstname'] ?></a>
          </li>
          <li>
            <a href="<?php echo BASE_URL . 'logout.php' ?>" style="color: red;">logout</a>
          </li>
        <?php else: ?>
          <li><a href="<?php echo BASE_URL . 'signup.php' ?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="<?php echo BASE_URL . 'login.php' ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </nav>
