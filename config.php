<?php
	session_start();
	// connect to database
	$conn = mysqli_connect("localhost", "root", "", "user-accounts");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

  // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));

  // Path to include folder
	define ('INCLUDE_PATH', realpath(dirname(__FILE__) . '/includes' ));
	define('BASE_URL', 'http://localhost/cwa/user-accounts/');


	

?>
