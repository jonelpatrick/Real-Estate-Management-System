<?php
require_once 'core/database/connect2.php'; 

	$pid = $_POST['pid'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$ref_num = $_POST['ref_num']; 
	 
			//insert file information into db table
			$sql="INSERT INTO `reference_number`('id', 'p_id', 'firstname', 'surname', 'contact', 'email') VALUES ('$ref_num', '$pid', '$firstname', '$surname', '$contact', '$email')";  
			$result = mysqli_query($mysqli,$sql); 
			//header("Location: index.php");
?>