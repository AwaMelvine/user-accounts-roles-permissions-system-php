<?php

  // Accept a user ID and
  // returns true if user is admin and false if otherwise
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

  function loginById($user_id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$user_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);

      // put logged in user into session array
      $_SESSION['user'] = getUserById($user_id);
      $_SESSION['success_msg'] = "You are now logged in";

      // if user is admin, redirect to dashboard, otherwise to homepage
      if (isAdmin($user['id'])) {
        header('location: ' . BASE_URL . 'admin/dashboard.php');
        exit(0);
      } else {
        header('location: ' . BASE_URL . 'index.php');
        exit(0);
      }
    }
  }

  // Accept a user object and fields that should be ignored during validation
  //  validates user and return an array with the error messages
  function validateUser($user, $ignoreFields) {
  		global $conn;
      $errors = [];

  	  foreach ($user as $key => $value) {
        if (in_array($key, $ignoreFields)) {
          continue;
        }
  			if (empty($user[$key])) {
  				$errors[$key] = "This field is required";
  			}
  	  }

  		if (isset($user['passwordConf']) && ($user['password'] !== $user['passwordConf'])) {
        $errors['passwordConf'] = "The two passwords do not match";
      }

      // When creating new user Ensure that no user is registered twice.
      // the email should be unique for each user
      if (in_array('save_user', $ignoreFields)) {
        $sql = "SELECT * FROM users WHERE email='" . $user['email'] . "' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
          $errors['email'] = "Email already exists";
        }
      }

  		return $errors;
  }



  // Accept a post object and fields that should be ignored during validation
  //  validates post and return an array with the error messages
  function validatePost($post, $ignoreFields) {
  		global $conn;
      $errors = [];

  	  foreach ($post as $key => $value) {
        if (in_array($key, $ignoreFields)) {
          continue;
        }
  			if (empty($post[$key])) {
  				$errors[$key] = "This field is required";
  			}
  	  }

  		return $errors;
  }

  // Accept a post object and fields that should be ignored during validation
  //  validates post and return an array with the error messages
  function validateRole($role, $ignoreFields) {
  		global $conn;
      $errors = [];

  	  foreach ($role as $key => $value) {
        if (in_array($key, $ignoreFields)) {
          continue;
        }
  			if (empty($role[$key])) {
  				$errors[$key] = "This field is required";
  			}
  	  }

  		return $errors;
  }

  // upload's user profile profile picture and returns the name of the file
  function uploadProfilePicture()
  {
    // if file was sent from signup form ...
    if (!empty($_FILES) && !empty($_FILES['profile_picture']['name'])) {
        // Get image name
        $profile_picture = date("Y.m.d") . $_FILES['profile_picture']['name'];
        // define Where image will be stored
        $target = ROOT_PATH . "/static/images/" . $profile_picture;
        // upload image to folder
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
          return $profile_picture;
          exit();
        }else{
          echo "Failed to upload image";
        }
    }
  }

  // Get user info from user id
  function getUserById($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // returns user in an array format:
    // ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
    return $user;
  }

  // escape value from form
  function esc(String $value) {
    // bring the global db connect object into function
    global $conn;

    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);

    return $val;
  }



?>
