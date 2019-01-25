<?php
require_once 'core/database/connect2.php'; 
session_start();
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$comments = $_POST['comments']; 
$datecreated = $_POST['datecreated'];

$sql="INSERT INTO `contacts`( fullname, email, comments, datecreated ) VALUES ('$fullname', '$email', '$comments', '$datecreated')";  
//$result = mysqli_query($mysqli,$sql);
if (mysqli_query($mysqli,$sql)) {

		header("Location: contactus.php");		
	 
	} else {
		
	   echo $sql;
	}


?>