<?php
	// variable declaration
	$firstname = "";
	$lastname  = "";
	$email  = "";
	$errors = array();

	// SIGN UP USER
	if (isset($_POST['signup_btn'])) {
		// receive all input values from the form
		$firstname = esc($_POST['firstname']);
		$lastname = esc($_POST['lastname']);
		$email = esc($_POST['email']);
    // do not escape passwords
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];

		// form validation: ensure that the form is correctly filled
		if (empty($username)) {  $errors['username'] = "Username required"; }
		if (empty($email)) { $errors['email'] = "Email required"; }
		if (empty($password)) { $errors['password'] = "Password reqquired"; }
		if (empty($password)) { $errors['passwordConf'] = "Password confirmation reqquired"; }
		if ($password != $passwordConf) { $errors['passwordConf'] = "The two passwords do not match";}

		// Form validation continues: Ensure that no user is registered twice.
		// the email should be unique
		$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		if ($user) { // if user exists
      $errors['email'] = "Email already exists";
		}

		// register user if there are no errors in the form
		if (count($errors) === 0) {
			$password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database
			$query = "INSERT INTO users (firstname, lastname, email, password, token, verified, created_at, updated_at)
					  VALUES('$firstname', '$lastname', '$email', '$password', null, false, now(), now())";
			mysqli_query($conn, $query);

			// get id of created user
			$user_id = mysqli_insert_id($conn);

			// put logged in user into session array
			$_SESSION['user'] = getUserById($user_id);
      header('location: ' . BASE_URL . 'admin/dashboard.php');
      exit(0);
		}
	}

	// USER LOGIN
	if (isset($_POST['login_btn'])) {
		$email = esc($_POST['email']);
		$password = esc($_POST['password']);

		if (empty($email)) { $errors['email'] = "Email required"; }
		if (empty($password)) { $errors['password'] = "Password required"; }
		if (empty($errors)) {
			$password = password_hash($password, PASSWORD_DEFAULT); // encrypt password
			$sql = "SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				// get id of created user
				$user_id = mysqli_fetch_assoc($result)['id'];

				// put logged in user into session array
				$_SESSION['user'] = getUserById($user_id);

				// redirect to admin area
				header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
			} else {
				array_push($errors, 'Wrong credentials');
			}
		}
	}

	// escape value from form
	function esc(String $value) {
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
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
?>
