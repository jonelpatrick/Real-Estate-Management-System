<?php 
require_once 'core/database/connect2.php';
session_start();
				$emailaddress = $_POST['emailaddress'];  
				$sql="INSERT INTO `subscriber`(`id`,'emailaddress') VALUES ('', '$emailaddress')";  
				$result = mysqli_query($mysqli,$sql);

header("Location: index.php");
?>