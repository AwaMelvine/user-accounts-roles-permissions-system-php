<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/admin/roles/roleLogic.php') ?>
<?php
  $roles = getAllRoles();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Area - User Roles </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <!-- TO DO:  -->
  <!-- 1.1: Manage users, Manage roles, manage user roles/Assign permissions, -->
  <div class="col-md-8 col-md-offset-2">
    <a href="roleForm.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>
      Create new role
    </a>
    <hr>

    <h1 class="text-center">Roles</h1>
    <br />

    <?php if (isset($roles)): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>N</th>
            <th>Role name</th>
            <th colspan="3" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($roles as $key => $value): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $value['name'] ?></td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/roles/assignPermissions.php?assign_permissions=<?php echo $value['id'] ?>" class="btn btn-sm btn-info">
                  permissions
                </a>
              </td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/roles/roleForm.php?edit_role=<?php echo $value['id'] ?>" class="btn btn-sm btn-success">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
              </td>
              <td class="text-center">
                <a href="<?php echo BASE_URL ?>admin/roles/roleForm.php?delete_role=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <h2 class="text-center">No roles in database</h2>
    <?php endif; ?>

  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
