<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/includes/logic/common_functions.php') ?>
<?php include(ROOT_PATH . '/admin/posts/postLogic.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Create new post </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <!-- TO DO:  -->
  <!-- 1.1: Manage users, Manage posts, manage user roles/Assign permissions, -->
  <div class="col-md-8 col-md-offset-2">

      <a href="postList.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-chevron-left"></span>
        Posts
      </a>
      <hr>

      <?php if ($isEditting === true): ?>
        <h1 class="text-center">Update Post</h1>
      <?php else: ?>
        <h1 class="text-center">Create Post</h1>
      <?php endif; ?>

      <br />
      <form class="form" action="postForm.php" method="post">

        <?php if ($isEditting === true): ?>
          <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <?php endif; ?>

        <?php if (isset($errors['title'])): ?>
          <div class="form-group has-error">
        <?php else: ?>
          <div class="form-group">
        <?php endif; ?>

          <label class="control-label">Post title</label>
          <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
          <?php if (isset($errors['title'])): ?>
            <span class="help-block"><?php echo $errors['title'] ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label class="control-label">
            <?php if ($published == true): ?>
              <input type="checkbox" name="published" checked="true" > Publish
            <?php else: ?>
              <input type="checkbox" name="published" > Publish
            <?php endif; ?>
          </label>
        </div>
        <div class="form-group">

          <?php if ($isEditting === true): ?>
            <button type="submit" name="update_post" class="btn btn-primary">Update Post</button>
          <?php else: ?>
            <button type="submit" name="save_post" class="btn btn-success">Save Post</button>
          <?php endif; ?>

        </div>
      </form>
  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
