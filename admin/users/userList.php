<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/admin/users/userLogic.php') ?>
<?php
  $users = getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Area - Users </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <!-- TO DO:  -->
  <!-- 1.1: Manage users, Manage users, manage user users/Assign permissions, -->
  <div class="col-md-8 col-md-offset-2">
    <a href="userForm.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>
      Create new user
    </a>
    <hr>

    <h1 class="text-center">Users</h1>
    <br />

    <?php if (isset($users)): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>N</th>
            <th>User</th>
            <th colspan="2" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $key => $value): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $value['firstname'] ?> <?php echo $value['lastname'] ?></td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/users/userForm.php?edit_user=<?php echo $value['id'] ?>" class="btn btn-sm btn-success">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
              </td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/users/userForm.php?delete_user=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <h2 class="text-center">No users in database</h2>
    <?php endif; ?>

  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
