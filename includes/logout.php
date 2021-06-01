<?php session_start();?>
<?php
	$_SESSION['userid'] 		= null;
	$_SESSION['username'] 		= null;
	$_SESSION['role'] 			= null;
	
	header('Location: ../index.php');
		
?>