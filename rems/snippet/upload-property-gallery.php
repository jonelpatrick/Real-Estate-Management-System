<?php
include_once("../dbconnect/connect.php");
 define("UPLOAD_DIR_PROPIMAGE", "../../property-gallery/"); 

if(!empty($_FILES)){

	$upload_dir = "../../property-gallery/";
	$fileName = $_FILES['file']['name'];
	$property_id = $_POST['property_id'];

	$uploaded_file = $upload_dir.$fileName;
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){

			//insert file information into db table
			$mysql_insert = "INSERT INTO property_gallery (image_path,property_id)VALUES('".$fileName."','".$property_id."')";
			mysqli_query($mysqli, $mysql_insert) or die("database error:". mysqli_error($mysqli));
		}
}
?>