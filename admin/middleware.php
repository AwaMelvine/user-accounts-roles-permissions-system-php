<?php

  // if user is NOT logged in, redirect them to login page
  if (!isset($_SESSION['user'])) {
    header("location: " . BASE_URL . "login.php");
  }

  // if user is logged in and this user is NOT an admin user, redirect them to landing page
  if (isset($_SESSION['user']) && !isAdmin($_SESSION['user']['id'])) {
    header("location: " . BASE_URL);
  }

  // accepts user id and post id and returns true if user can update post or false otherwise
  function canUpdatePost($user_id, $post_id){
    global $conn;

    $role_sql ="SELECT name FROM roles WHERE id=(SELECT role_id FROM role_user WHERE user_id=$user_id LIMIT 1)";
    $role_result = mysqli_query($conn, $role_sql);
    $userRole = mysqli_fetch_assoc($role_result)['name'];

    if (is_null($userRole)) {
      $_SESSION['error_msg'] = "Sorry, you don't or you no longer have permission to access resource";
      header("location: " . BASE_URL);
      exit(0);
    }

    if ($userRole === "Editor") {
      return true; // true because Editor can update any post
    }

    if ($userRole === "Author") {
      $post_sql = "SELECT user_id FROM posts WHERE id=$post_id";
      $post_result = mysqli_query($conn, $post_sql);
      $post_user_id = mysqli_fetch_assoc($post_result)['user_id'];

      // if current user is the author of the post, then they can update the post
      if ($post_user_id == $user_id) { // authors can update their own posts
        return true;
      } else { // if post is not created by this author
        return false;
      }
    }

  }

  // accepts user id and post id and returns true if user can delete post or false otherwise
  function canDeletePost($user_id, $post_id) {

  }

  // accepts user id and post id and checks if user can publis/unpublish a post
  function canPublishUnpublishPost($user_id, $post_id) {

  }

  // Accepts a user id and returns true if user is admin and false if otherwise
  function isAdmin($user_id) {
    global $conn;
    $sql = "SELECT * FROM roles WHERE id=(SELECT role_id FROM role_user WHERE user_id=$user_id) LIMIT 1";
    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results) > 0) {
      return true;
    } else {
      return false;
    }
  }
?>
