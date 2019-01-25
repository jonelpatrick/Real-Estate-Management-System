<?php 
session_start();
require_once '../database/connect.php';
require_once '../database/db-class.php';
$db = new database($pdo);
$username = $_POST['username'];
$password = md5($_POST['password']);
$sql="SELECT * FROM registered_users where username='$username' AND password='$password'";
$rows = $db->select($sql);
	
	if(!empty($rows)){
		foreach ($rows as $rkey => $rvalue) {
			$name=$rvalue['firstname']." " .$rvalue['lastname'];
            $firstname=$rvalue['firstname'];
            $middlename=$rvalue['middlename'];
            $lastname=$rvalue['lastname'];
			$position=$rvalue['position'];
            $uname=$rvalue['username'];
			$_SESSION['user']=$name;
            $_SESSION['fname']=$firstname;
            $_SESSION['mname']=$middlename;
            $_SESSION['lname']=$lastname;
			$_SESSION['position']=$position;
            $_SESSION['username']=$uname;
			echo "success".' '.$name;
			header('Location:http://localhost/rental_reservation/index.php');
		}
   }else{
    		echo "Username and password did not match.";
   }	

    
?>