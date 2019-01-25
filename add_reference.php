<?php
require_once 'core/database/connect2.php'; 
session_start();

$ref_num = $_POST['ref_num'];
$pid = $_POST['pid'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$contact = $_POST['contact'];
$email = $_POST['email']; 
$date_created = $_POST['date_created'];
$sql="INSERT INTO `reference_number`(`id`, `p_id`, `firstname`, `surname`, `contact`, `email`, `date_created`) VALUES ('$ref_num', '$pid', '$firstname', '$surname', '$contact', '$email', '$date_created')";  
$result = mysqli_query($mysqli,$sql);
header("Location: property.php");
?>