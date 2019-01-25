<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';

define("UPLOAD_DIR", "../uploads/"); 
define("UPLOAD_DIR_GAL", "../gallery/");

$action = $_POST["action"];
$_SESSION['ERR']="";
switch ($action) { 
	case 'aboutus' :
		aboutus($mysqli);
		break;
	  
	case 'addgallery':        
    	addgallery($mysqli);
        break;

    case 'addnews':        
    	addnews($mysqli);
        break;

     case 'updateEvents':        
    	updateEvents($mysqli);
        break;

     case 'confirmDeleteEvents':        
    	confirmDeleteEvents($mysqli);
        break;

    case 'confirmDeleteMessage':        
    	confirmDeleteMessage($mysqli);
        break;
     
     

}
 
function aboutus($mysqli){ 
	$id = $_POST['id'];
	$address = $_POST['address'];
	$cell_number = $_POST['cell_number'];
	$phone_number = $_POST['phone_number'];
	$fb_link = $_POST['fb_link'];
	$twitter_link = $_POST['twitter_link'];
	$in_link = $_POST['in_link'];
	$gplus_link = $_POST['gplus_link'];
	$email_address = $_POST['email_address'];
	$short_article = $_POST['short_article'];
	$full_article = $_POST['full_article'];
	$services = $_POST['services'];   
	$sql = "UPDATE aboutdetails set address = '$address', cell_number = '$cell_number', phone_number = '$phone_number', fb_link = '$fb_link', twitter_link = '$twitter_link', in_link = '$in_link', gplus_link = '$gplus_link', email_address = '$email_address', short_article = '$short_article', full_article = '$full_article', services = '$services' WHERE id = 1";

	if (mysqli_query($mysqli,$sql)) { 
		 $_SESSION['ERR'] = "";

	}else{
			echo mysqli_error($mysqli);
		 $_SESSION['ERR']="Something went wrong: error(102)";exit;
	}
 header('Location: ../pages/about-us-details.php'); 
}

function addgallery($mysqli){
 	
	$eventname = $_POST['eventname'];
	$eventdescription = $_POST['eventdescription']; 
	$image_path='noimage.png';  

	//upload image
	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
		
		$_SESSION['ERR']="Image file is invalid";

	}else{			
			$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        $_SESSION['ERR']="Cant upload the image";
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR_GAL . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR_GAL . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR_GAL . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO gallery(title, description, img) VALUES ('$eventname','$eventdescription','$name')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(05)";
		}
	}//end upload image

	header('Location: ../pages/gallery_site.php');
}//end of function

function addnews($mysqli){
$news_title = $_POST['news_title'];
$news_description = $_POST['news_description'];
$news_created = $_POST['news_created']; 

$sql = "INSERT INTO news_updates(id, news_title, news_description, news_created) VALUES ('', '$news_title','$news_description','$news_created')";
$result = mysqli_query($mysqli,$sql);
header('Location: ../pages/news_updates.php');
}

function updateEvents($mysqli){
$id = $_POST['id'];
$news_title = $_POST['news_title'];
$news_description = $_POST['news_description']; 

$sql = "UPDATE news_updates 
			SET news_title = '$news_title',  
			news_description = '$news_description'
			WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);
header('Location: ../pages/news_updates.php');
} 

function confirmDeleteEvents($mysqli){
$id = $_POST["tableId"];

$sql = "DELETE FROM `news_updates` WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);
header('Location: ../pages/news_updates.php');

}

function confirmDeleteMessage($mysqli){
$id = $_POST["id"];

$sql = "DELETE FROM `contacts` WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);
header('Location: ../pages/c-quires.php');

}
?>

