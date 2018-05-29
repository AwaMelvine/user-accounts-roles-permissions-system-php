<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/admin/posts/postLogic.php') ?>
<?php
  $posts = getAllPosts();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Area - User posts </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <!-- TO DO:  -->
  <!-- 1.1: Manage users, Manage posts, manage user roles/Assign permissions, -->
  <div class="col-md-8 col-md-offset-2">
    <a href="postForm.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>
      Create new post
    </a>
    <a href="postForm.php" class="btn btn-danger">
      <span class="glyphicon glyphicon-trash"></span>
      Trash
    </a>
    <hr>

    <h1 class="text-center">Posts</h1>
    <br />

    <?php if (isset($posts)): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>N</th>
            <th>Post title</th>
            <th colspan="3" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $key => $value): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $value['title'] ?></td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/posts/postForm.php?publish_post=<?php echo $value['id'] ?>" class="btn btn-sm btn-info">Publish</a>
              </td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/posts/postForm.php?edit_post=<?php echo $value['id'] ?>" class="btn btn-sm btn-success">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
              </td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/posts/postForm.php?delete_post=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>                   
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <h2 class="text-center">No posts in database</h2>
    <?php endif; ?>

  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
