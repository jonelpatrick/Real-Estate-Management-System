<?php
	session_start();
	session_destroy();

	$type = $_SESSION['user_type'];

	header('Location: ../login.php');	
	
	
?>