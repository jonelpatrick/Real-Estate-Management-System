<?php 
 include '../dbconnect/connect.php';
 session_set_cookie_params(600);
 session_start();

if($_POST['login']){

	$username = $_POST['username'];
	$password = mysql_real_escape_string($_POST['password']);
 	$login_type = $_POST['user_type'];
 	/*
 	//customer
 	if($login_type == 0){
 		$sql = "SELECT 
 				customer.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path 
 				FROM customer 
 				INNER JOIN account 
 				ON customer.account_id = account.id 
 				WHERE customer.deleted = 0
                AND status = 0
                AND username = '$username'
                AND password = '$password'"; 

 		$_SESSION['user_type'] = 'customer';

 	}else if($login_type == 1){ //client

 		$sql = "SELECT 
 				client.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path 
 				FROM client 
 				INNER JOIN account 
 				ON client.account_id = account.id 
 				WHERE client.deleted = 0 
                AND status = 0
                AND username = '$username'
                AND password = '$password'"; 	

 		$_SESSION['user_type'] = 'client';	

 	}else{   //employee

 		$sql = "SELECT 
 				employee.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path,
                position 
 				FROM employee 
 				INNER JOIN account 
 				ON employee.account_id = account.id 
 				WHERE employee.deleted = 0 
                AND status = 0
                AND username = '$username'
                AND password = '$password'"; 				
 		
 	}
    */

    $sql = "    SELECT 
                customer.id id,
                firstname,
                middlename,
                lastname,
                image_path,
                position
                FROM customer 
                INNER JOIN account 
                ON customer.account_id = account.id 
                WHERE customer.deleted = 0
                AND status = 0
                AND username = '$username'
                AND password = '$password'
UNION ALL
                SELECT 
                client.id id,
                firstname,
                middlename,
                lastname,
                image_path,
                position
                FROM client 
                INNER JOIN account 
                ON client.account_id = account.id 
                WHERE client.deleted = 0 
                AND status = 0
                AND username = '$username'
                AND password = '$password'
UNION ALL

                SELECT 
                employee.id id,
                firstname,
                middlename,
                lastname,
                image_path,
                position 
                FROM employee 
                INNER JOIN account 
                ON employee.account_id = account.id 
                WHERE employee.deleted = 0 
                AND status = 0
                AND username = '$username'
                AND password = '$password'

    ";

 	$result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
         while($row = mysqli_fetch_assoc($result)) {
         	
         	$id = $row['id'];
         	$firstname = $row['firstname'];
         	$middlename = $row['middlename'];
         	$lastname = $row['lastname'];
            $image_path = $row['image_path'];
            
            if($image_path == "" || $image_path == NULL){
                $image_path = "noimage.png";
            }
            
            $position = $row['position'];
            $_SESSION['user_type'] = $position;
            
         }
    }else{

    	$_SESSION['ERR'] = "Login error. please try again!";
    
    	header('Location: ../login.php');exit;	
    	
    }
 	
}

$_SESSION['user'] = $firstname.' '.$middlename.' '.$lastname;
$_SESSION['user_id'] = $id;
$_SESSION['image_path'] = $image_path;

header('Location: ../pages/dashboard.php');
echo $id.'<br>';
echo $firstname.'<br>';
echo $middlename.'<br>';
echo $lastname.'<br>';



?>