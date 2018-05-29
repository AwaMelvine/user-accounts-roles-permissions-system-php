<?php include('../../config.php') ?>
<?php include(ROOT_PATH . '/includes/logic/common_functions.php') ?>
<?php include(ROOT_PATH . '/admin/roles/roleLogic.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Create new role </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/admin_navbar.php") ?>

  <!-- TO DO:  -->
  <!-- 1.1: Manage users, Manage roles, manage user roles/Assign permissions, -->
  <div class="col-md-8 col-md-offset-2">
      <a href="roleList.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-chevron-left"></span>
        Roles
      </a>
      <hr>

      <?php if ($isEditting === true): ?>
        <h1 class="text-center">Update Role</h1>
      <?php else: ?>
        <h1 class="text-center">Create Role</h1>
      <?php endif; ?>

      <br />
      <form class="form" action="roleForm.php" method="post">

        <?php if ($isEditting === true): ?>
          <input type="hidden" name="role_id" value="<?php echo $role_id ?>">
        <?php endif; ?>

        <?php if (isset($errors['name'])): ?>
          <div class="form-group has-error">
        <?php else: ?>
          <div class="form-group">
        <?php endif; ?>

          <label class="control-label">Role name</label>
          <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
          <?php if (isset($errors['name'])): ?>
            <span class="help-block"><?php echo $errors['name'] ?></span>
          <?php endif; ?>
        </div>

        <?php if (isset($errors['description'])): ?>
          <div class="form-group has-error">
        <?php else: ?>
          <div class="form-group">
        <?php endif; ?>

          <label class="control-label">Description</label>
          <textarea name="description" value="<?php echo $description; ?>"  rows="3" cols="10" class="form-control"><?php echo $description; ?></textarea>

          <?php if (isset($errors['description'])): ?>
            <span class="help-block"><?php echo $errors['description'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <?php if ($isEditting === true): ?>
            <button type="submit" name="update_role" class="btn btn-primary">Update Role</button>
          <?php else: ?>
            <button type="submit" name="save_role" class="btn btn-success">Save Role</button>
          <?php endif; ?>
        </div>
      </form>
  </div>
  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
</body>
</html>
