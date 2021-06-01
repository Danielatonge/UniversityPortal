<?php include 'database.php';?>
<?php session_start();?>
<?php

if(isset($_POST['login_submit'])) {
	// get username and password from inputs
	$user_uname = mysqli_real_escape_string($con, $_POST['user_uname']);
	$user_pass = mysqli_real_escape_string($con, $_POST['user_pass']);

	// get user data from database		
	$q = "SELECT * FROM users WHERE user_uname = '$user_uname'";
	$result = mysqli_query($con, $q);
	
	if(!$result) {
		die('Query failed: '.mysqli_error($con));
	}
	
	if(mysqli_num_rows($result) == 0) {
		// if username is not found, don't bother comparing passwords
		// l = x means login authentication failed
		header('Location: ../index.php?l=x');
	} else {
		// if username is found, verify password
		$user = mysqli_fetch_array($result);
		if(password_verify($user_pass, $user['user_pass'])) {
			// if password is verified, set session variables
			$_SESSION['userid'] = $user['user_id'];			
			$_SESSION['username'] = $user['user_uname'];
			$_SESSION['role'] = $user['user_role'];
			
			
			if($_SESSION['role'] == 'admin') {
				header('Location: ../admin-portal.php');
			} elseif($_SESSION['role'] == 'teacher') {
				header('Location: ../teacher-portal.php');		
			} else {
                header('Location: ../student-portal.php');
            }
		} else {
			header('Location: ../index.php?l=x');
		}	
	}
}	
?>