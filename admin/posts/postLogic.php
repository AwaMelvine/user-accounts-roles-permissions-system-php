<?php
  $post_id = 0;
  $title = "";
  $isEditting = false;
  $published = false;
  $posts = array();
  $errors = array();

  // ACTION: update post
  if (isset($_POST['update_post'])) {
      $post_id = $_POST['post_id'];
      updatePost($post_id);
  }
  // ACTION: Save Post
  if (isset($_POST['save_post'])) {
      savePost();
  }
  // ACTION: fetch post for editting
  if (isset($_GET["edit_post"])) {
    $post_id = $_GET['edit_post'];
    editPost($post_id);
  }

  // ACTION: Delete post
  if (isset($_GET['delete_post'])) {
    $post_id = $_GET['delete_post'];
    softDeletePost($post_id);
  }

  function updatePost($post_id){
    // pull in global form variables into function
    global $conn, $errors, $title, $published, $isEditting;
    // validate form
    $errors = validatePost($_POST, ['update_post']);

    if (count($errors) === 0) {
      // receive form values
      $title = esc($_POST['title']);

      if (isset($_POST['published'])) {
        $published = "true";
      } else {
        $published = "false";
      }

      $sql = "UPDATE posts SET title='$title', published=$published WHERE id=$post_id";

      if (mysqli_query($conn, $sql)) {
        $_SESSION['success_msg'] = "Post successfully updated";
        $isEditting = false;
        header("location: " . BASE_URL . "admin/posts/postList.php");
      } else {
        $_SESSION['error_msg'] = "Something went wrong. Could not save post in Database";
      }
    }
  }

  // Save post to database
  function savePost(){
    global $conn, $errors, $title, $published;
    $errors = validatePost($_POST, ['save_post']);
    if (count($errors) === 0) {
       // receive form values
       $title = esc($_POST['title']);
       if (isset($_POST['published'])) {
         $published = "true";
       }
       $user_id = $_SESSION['user']['id'];

       $sql = "INSERT INTO posts(user_id, title, published, isDeleted) VALUES ($user_id, '$title', $published, 0)";
       if (mysqli_query($conn, $sql)) {
         $_SESSION['success_msg'] = "Post created successfully";
         header("location: " . BASE_URL . "admin/posts/postList.php");
       } else {
         $_SESSION['error_msg'] = "Something went wrong. Could not save post in Database";
       }
    }
  }

  function getAllPosts(){
    global $conn;
    $sql = "SELECT * FROM posts WHERE isDeleted=false";
    $result = mysqli_query($conn, $sql);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;
  }

  function editPost($post_id){
    global $conn, $post_id, $title, $published, $isEditting;
    $sql = "SELECT * FROM posts WHERE id=$post_id AND isDeleted=false";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    $post_id = $post['id'];
    $title = $post['title'];
    $published = $post['published'];
    $isEditting = true;
  }

  function softDeletePost($post_id)
  {
    global $conn;
    $sql = "UPDATE posts SET isDeleted=true WHERE id=$post_id";
    $result = mysqli_query($conn, $sql);

    $_SESSION['success_msg'] = "Post trashed!!";
    header("location: " . BASE_URL . "admin/posts/postList.php");
  }

?>
