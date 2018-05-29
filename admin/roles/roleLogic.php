<?php

  $role_id = 0;
  $name = "";
  $description = "";
  $isEditting = false;
  $roles = array();
  $errors = array();

  // ACTION: update role
  if (isset($_POST['update_role'])) {
      $role_id = $_POST['role_id'];
      updateRole($role_id);
  }
  // ACTION: Save Role
  if (isset($_POST['save_role'])) {
      saveRole();
  }
  // ACTION: fetch role for editting
  if (isset($_GET["edit_role"])) {
    $role_id = $_GET['edit_role'];
    editRole($role_id);
  }

  if (isset($_POST['save_permissions'])) {
    $permission_ids = $_POST['permission'];
    $role_id = $_POST['role_id'];
    saveRolePermissions($permission_ids, $role_id);
  }

  // ACTION: Delete role
  if (isset($_GET['delete_role'])) {
    $role_id = $_GET['delete_role'];
    deleteRole($role_id);
  }

  function updateRole($role_id){
    // pull in global form variables into function
    global $conn, $errors, $name, $isEditting;
    // validate form
    $errors = validateRole($_POST, ['update_role']);

    if (count($errors) === 0) {
      // receive form values
      $name = esc($_POST['name']);
      $description = esc($_POST['description']);

      $sql = "UPDATE roles SET name='$name', description='$description' WHERE id=$role_id";

      if (mysqli_query($conn, $sql)) {
        $_SESSION['success_msg'] = "Role successfully updated";
        $isEditting = false;
        header("location: " . BASE_URL . "admin/roles/roleList.php");
      } else {
        $_SESSION['error_msg'] = "Something went wrong. Could not save role in Database";
      }
    }
  }

  // Save role to database
  function saveRole(){
    global $conn, $errors, $name, $description;

    $errors = validateRole($_POST, ['save_role']);
    if (count($errors) === 0) {
       // receive form values
       $name = esc($_POST['name']);
       if (isset($_POST['published'])) {
         $published = "true";
       }

       $sql = "INSERT INTO roles(name, description) VALUES ('$name', '$description')";
       if (mysqli_query($conn, $sql)) {
         $_SESSION['success_msg'] = "Role created successfully";
         header("location: " . BASE_URL . "admin/roles/roleList.php");
       } else {
         $_SESSION['error_msg'] = "Something went wrong. Could not save role in Database";
       }
    }
  }

  function getAllRoles(){
    global $conn;
    $sql = "SELECT * FROM roles";
    $result = mysqli_query($conn, $sql);

    $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $roles;
  }

  function getAllPermissions(){
    global $conn;
    $sql = "SELECT * FROM permissions";
    $result = mysqli_query($conn, $sql);

    $permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $permissions;
  }

  function getRoleAllPermissions($role_id){
    global $conn;
    $sql = "SELECT * FROM permissions WHERE id=(SELECT permission_id FROM permission_role WHERE role_id=$role_id)";
    $result = mysqli_query($conn, $sql);

    $r_permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $r_permissions;
  }

  function editRole($role_id){
    global $conn, $name, $description, $isEditting;
    $sql = "SELECT * FROM roles WHERE id=$role_id";
    $result = mysqli_query($conn, $sql);
    $role = mysqli_fetch_assoc($result);

    $role_id = $role['id'];
    $name = $role['name'];
    $description = $role['description'];
    $isEditting = true;
  }

  function deleteRole($role_id) {
    global $conn;
    $sql = "DELETE FROM roles WHERE id=$role_id";
    mysqli_query($conn, $sql);

    $_SESSION['success_msg'] = "Role trashed!!";
    header("location: " . BASE_URL . "admin/roles/roleList.php");
  }

  function saveRolePermissions($permission_ids, $role_id)
  {
    global $conn;

    $sql = "DELETE FROM permission_role WHERE role_id=$role_id";
    mysqli_query($conn, $sql);

    foreach ($permission_ids as $id) {
      $sql_2 = "INSERT INTO permission_role (role_id, permission_id) VALUES ($role_id, $id)";
      mysqli_query($conn, $sql_2);
    }

    $_SESSION['success_msg'] = "Permissions saved";
    header("location: roleList.php");
  }


?>
