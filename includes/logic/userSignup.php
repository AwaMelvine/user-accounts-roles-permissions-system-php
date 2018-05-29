<?php include(INCLUDE_PATH . "/logic/common_functions.php"); ?>
<?php
	// variable declaration
	$firstname = "";
	$lastname  = "";
	$email  = "";
	$errors  = [];

	// SIGN UP USER
	if (isset($_POST['signup_btn'])) {
		// validate form values
		$errors = validateUser($_POST, ['signup_btn']);

		// if no errors, proceed with signup
		if (count($errors) === 0) {
			// receive all input values from the form
			$firstname = esc($_POST['firstname']);
			$lastname = esc($_POST['lastname']);
			$email = esc($_POST['email']);
			$password = $_POST['password']; // do not escape passwords for security reasons
			$password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database
			$profile_picture = uploadProfilePicture();

			// insert user into database
			$query = "INSERT INTO users(firstname, lastname, email, password, token, verified, profile_picture, created_at, updated_at)
					  VALUES('$firstname', '$lastname', '$email', '$password', null, false, '$profile_picture', now(), now())";
			mysqli_query($conn, $query);

			// get id of created user
			$user_id = mysqli_insert_id($conn);

			// log user in
			loginById($user_id);
		}
	}

	// USER LOGIN
	if (isset($_POST['login_btn'])) {
		$email = esc($_POST['email']);
		$password = $_POST['password'];

		if (empty($email)) { $errors['email'] = "Email required"; }
		if (empty($password)) { $errors['password'] = "Password required"; }
		if (empty($errors)) {
			$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) { // if user was found
				$user = mysqli_fetch_assoc($result);
				if (password_verify($password, $user['password'])) { // if password matches
					// log user in
					loginById($user['id']);
				} else { // if password does not match
					$_SESSION['error_msg'] = "Wrong credentials";
				}
			} else { // if no user found
				$_SESSION['error_msg'] = "Wrong credentials";
			}
		}
	}


?>
