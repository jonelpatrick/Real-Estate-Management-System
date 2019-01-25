<?php
	session_set_cookie_params(600);
	session_start();

	if(!isset($_SESSION['user_id'])|| $_SESSION['user_id']==0){
		header('Location: ../login.php');
	}
	
?>