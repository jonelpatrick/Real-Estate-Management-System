<?php 

include '../dbconnect/connect.php';

$id = $_POST['image_id'];

$sql = " DELETE FROM property_gallery WHERE id = '$id'";
if (mysqli_query($mysqli,$sql)) {

	$_SESSION['ERR']="success";		
 
} else {
	
   $_SESSION['ERR']="Something went wrong: error(06s)";
}


?>