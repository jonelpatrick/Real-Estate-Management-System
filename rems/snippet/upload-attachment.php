<?php
include_once("../dbconnect/connect.php");

if(!empty($_FILES)){

	$upload_dir = "../record-documents/";
	$fileName = $_FILES['file']['name'];
	$property_id = 0;

	$uploaded_file = $upload_dir.$fileName;
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){

			//insert file information into db table
			$mysql_insert = "INSERT INTO uploads (file_name, upload_time,property_id)VALUES('".$fileName."','".date("Y-m-d H:i:s")."','".$property_id."')";
			mysqli_query($mysqli, $mysql_insert) or die("database error:". mysqli_error($mysqli));
		}
}
?>