<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/admin/roles/roleLogic.php') ?>
<?php
  $permissions = getAllPermissions();
  if (isset($_GET['assign_permissions'])) {
    $role_id = $_GET['assign_permissions'];
    $r_permissions = getRoleAllPermissions($role_id);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Area - Assign permissions </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <div class="col-md-4 col-md-offset-4">
    <a href="roleList.php" class="btn btn-success">
      <span class="glyphicon glyphicon-chevron-left"></span>
      Roles
    </a>
    <hr>
    <h1 class="text-center">Assign permissions</h1>
    <br />
    <?php if (count($permissions) > 0): ?>
    <form action="assignPermissions.php" method="post">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>N</th>
            <th>Role name</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($permissions as $key => $value): ?>
            <tr class="text-center">
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $value['name']; ?></td>
              <td>
                  <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">

                  <?php if (in_array($value['id'], array_column($r_permissions, "id"))): ?>
                    <input type="checkbox" name="permission[]" value="<?php echo $value['id'] ?>" checked>
                  <?php else: ?>
                    <input type="checkbox" name="permission[]" value="<?php echo $value['id'] ?>" >
                  <?php endif; ?>


              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3">
              <button type="submit" name="save_permissions" class="btn btn-block btn-success">Save permissions</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>

    <?php else: ?>
      <h2 class="text-center">No permissions in database</h2>
    <?php endif; ?>

  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
