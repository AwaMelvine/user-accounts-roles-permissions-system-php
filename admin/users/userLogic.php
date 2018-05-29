<?php

  $user_id = 0;
  $firstname = "";
  $lastname = "";
  $email = "";
  $isEditting = false;
  $users = array();
  $errors = array();

  // ACTION: update user
  if (isset($_POST['update_user'])) {
      $user_id = $_POST['user_id'];
      updateUser($user_id);
  }
  // ACTION: Save User
  if (isset($_POST['save_user'])) {
      saveUser();
  }
  // ACTION: fetch user for editting
  if (isset($_GET["edit_user"])) {
    $user_id = $_GET['edit_user'];
    editUser($user_id);
  }

  if (isset($_POST['save_permissions'])) {
    $permission_ids = $_POST['permission'];
    $user_id = $_POST['user_id'];
    saveUserPermissions($permission_ids, $user_id);
  }

  // ACTION: Delete user
  if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    deleteUser($user_id);
  }

  function updateUser($user_id){
    global $conn, $errors, $firstname, $lastname, $email, $isEditting;
    $errors = validateUser($_POST, ['update_user', 'role_id']);

    // receive all input values from the form
    $firstname = esc($_POST['firstname']);
    $lastname = esc($_POST['lastname']);
    $email = esc($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database
    $profile_picture = uploadProfilePicture();

    if (count($errors) === 0) {
       $sql = "UPDATE users SET
                  firstname='$firstname',
                  lastname='$lastname',
                  email='$email',
                  password='$password',
                  profile_picture='$profile_picture' WHERE id=$user_id";
       mysqli_query($conn, $sql);

       if (isset($_POST['role_id'])) {
         $role_id = esc($_POST['role_id']);
         $sql_del = "DELETE FROM role_user WHERE user_id=$user_id";
         $sql_ins = "INSERT INTO role_user (user_id, role_id) VALUES ($user_id, $role_id)";

         mysqli_query($conn, $sql_del);
         mysqli_query($conn, $sql_ins);
       }

       $_SESSION['success_msg'] = "New user created successfully";
       header("location: " . BASE_URL . "admin/users/userList.php");
    } else {
      // continue editting if there were errors
      $isEditting = true;
    }
  }

  // Save user to database
  function saveUser(){
    global $conn, $errors, $firstname, $lastname, $email, $isEditting;
    $errors = validateUser($_POST, ['save_user']);

    // receive all input values from the form
    $firstname = esc($_POST['firstname']);
    $lastname = esc($_POST['lastname']);
    $email = esc($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database
    $profile_picture = uploadProfilePicture();

    if (count($errors) === 0) {
       $sql = "INSERT INTO users(firstname, lastname, email, password, profile_picture)
                  VALUES ('$firstname', '$lastname', '$email', '$password', '$profile_picture')";
       if (mysqli_query($conn, $sql)) {
         $_SESSION['success_msg'] = "User created successfully";
         header("location: " . BASE_URL . "admin/users/userList.php");
       } else {
         $_SESSION['error_msg'] = "Something went wrong. Could not save user in Database";
       }
    }
  }

  function getAllUsers(){
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $users;
  }

  function editUser($user_id){
    global $conn, $firstname, $lastname, $email, $isEditting;
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $user_id = $user['id'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $email = $user['email'];
    $isEditting = true;
  }

  function getAllRoles(){
    global $conn;
    $sql = "SELECT id, name FROM roles";
    $result = mysqli_query($conn, $sql);

    $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $roles;
  }

  function deleteUser($user_id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id=$user_id";
    mysqli_query($conn, $sql);

    $_SESSION['success_msg'] = "Role trashed!!";
    header("location: " . BASE_URL . "admin/users/userList.php");
  }


?>
