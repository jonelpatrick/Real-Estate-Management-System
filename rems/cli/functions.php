<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

 define("UPLOAD_DIR", "../uploads/");

$action = $_POST["action"];
$_SESSION['ERR']="";

switch ($action) {

    case 'addclient':        
    	addclient($mysqli);
        break;

    case 'confirmDelete':
    	confirmDelete($mysqli,$_POST['redirectpage']);
	    break; 

	case 'editClient' :
		editClient($mysqli);
		break;
	
	case 'addEmployee' :
		addEmployee($mysqli);
		break;	

	case 'editEmployee' :
		editEmployee($mysqli);
		break;	

	case 'attachproperty' :
		attachproperty($mysqli);
		break;	

	case 'addmaintenance' :
		addmaintenance($mysqli);
		break;

	case 'updateproperty' :
		updateproperty($mysqli);
		break;
		
	case 'aboutus' :
		aboutus($mysqli);
		break;
	case 'editCustomer' :
		editCustomer($mysqli);
		break;
	case 'addCustomer' :
		addCustomer($mysqli);
		break;
	case 'sell-property' :
		sellProperty($mysqli);
		break;
	case 'payment_transaction' :
		paymentTransaction($mysqli);
		break;
	case 'edit_payment_transaction' :
		editPaymentTransaction($mysqli);
		break;
	case 'updateProfileEmployee' :
		updateProfileEmployee($mysqli);
		break;
	case 'updateProfileCustomer' :
		updateProfileCustomer($mysqli);
		break;
	case 'updateProfileClient' :
		updateProfileClient($mysqli);
		break;
	case 'schedule_maintenance' :
		insertScheduleMaintenance($mysqli);
		break;
	case 'pay-to-client' :
		payToClient($mysqli);
		break;
	case 'edit_client_payment_transaction' :
		editClientPayment($mysqli);
		break;

	case 'switchToAvailable' :
		switchToAvailable($mysqli);
		break;

	case 'addDevidedProperty' :
		addDevidedProperty($mysqli);
		break;
}
function addDevidedProperty($mysqli){
	$property_id = $_POST['property_id'];
	$size = $_POST['sub_property_size'];
	$unit = $_POST['sub_size_unit'];
	$price = $_POST['sub_price'];
	$orig_unit = $_POST['orig_size_unit'];
	$orig_size = $_POST['orig_size'];
	$person = $_SESSION['user_id'];

	if($orig_unit == 1){
		$orig_size = $orig_size * 10;
	}
	$final_size = $orig_size - $size;
	$sql = "INSERT INTO devided_property 
			(property_id,
			orig_property_current_size,
			property_size,
			size_unit,
			property_price,
			devided_by)
			VALUES
			('$property_id',
			'$final_size',
			'$size',
			'$unit',
			'$price',
			'$person')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(06)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function switchToAvailable($mysqli){
	$table = $_POST["dbtable"];
	$id = $_POST["tableId"];

	$sql = "UPDATE property SET availability = 0 WHERE id = '$id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(06)";
	}
	//property_sold
	$sql = "UPDATE property_sold SET deleted = 1 WHERE property_id = '$id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(06s)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function editClientPayment($mysqli){

	$id = $_POST['transaction_id'];
	$method = $_POST['method_of_payment'];
	$amount_paid = $_POST['amount_paid'];

	$sql = "UPDATE client_payment_transaction
			SET 
			method_of_payment = '$method',
			amount_paid = '$amount_paid'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(402EPT)";
	}
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function payToClient($mysqli){
		
	$client_id = $_POST['client_idL'];
	$property_id = $_POST['property_id'];
	$date_paid = date('Y-m-d');
	$method_of_payment = $_POST['method_of_payment'];
	$amount_paid = $_POST['amount_paid'];
	$transacted_by = $_SESSION['user_id'];
	
	$due_date = getNextDueDate2(getPrevDueDate2($client_id,$property_id,$mysqli),$client_id,$mysqli,'client_payment_transaction');
	
	$sql = "INSERT INTO client_payment_transaction (
			client_id,
			property_id,
			date_paid,
			due_date,
			method_of_payment,
			amount_paid,
			transacted_by)
			VALUES (
			'$client_id',
			'$property_id',
			'$date_paid',
			'$due_date',
			'$method_of_payment',
			'$amount_paid',
			'$transacted_by')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(401CP)";
	}
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function insertScheduleMaintenance($mysqli){

	$id = $_POST['maintenance_request_id'];
	$schedule = $_POST['schedule'];
	$person = $_POST['person_in_charge'];

	$sql = "INSERT INTO maintenance_scheduled 
			(maintenance_request_id,
			scheduled_date,
			person_in_charge)
			VALUES 
			('$id',
			'$schedule',
			'$person')";

	if (mysqli_query($mysqli,$sql)) {

		updateMaintenanceRequestSchedule($id,$mysqli);
		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(0811M)";
	}

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateMaintenanceRequestSchedule($id,$mysqli){

	$sql = "UPDATE maintenance_request 
			SET scheduled = 1 
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(0811MR)";
	}
}

function updateProfileClient($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];	
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$username = $_POST['username'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE client
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0811)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE client
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email',
				image_path = '$name'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(08121)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(113321)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateProfileCustomer($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];	
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$username = $_POST['username'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE customer
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0811)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE customer
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email',
				image_path = '$name'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(08121)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(113321)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function updateProfileEmployee($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];	
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$username = $_POST['username'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE employee
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0811)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE employee
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				gender = '$sex',				
				physical_address = '$physical_address',
				contact_number = '$phone',
				email_address = '$email',
				image_path = '$name'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			username = '$username',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="success";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(08121)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(113321)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editPaymentTransaction($mysqli){

	$id = $_POST['payment_transaction_id'];
	$method = $_POST['method_of_payment'];
	$amount_paid = $_POST['amount_paid'];

	$sql = "UPDATE payment_transaction
			SET 
			method_of_payment = '$method',
			amount_paid = '$amount_paid'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(402)";
	}
	
	header('Location: ../pages/payment-transaction.php');
}

function paymentTransaction($mysqli){



	$customer_id =  getIdViaCustomerName($_POST['customer_id'],$mysqli);//return id from name
	$property_sold_id = $_POST['property_sold_id'];
	$date_paid = date('Y-m-d');
	$method_of_payment = $_POST['method_of_payment'];
	$amount_paid = $_POST['amount_paid'];
	$transacted_by = $_SESSION['user_id'];

	$due_date = getNextDueDate(getPrevDueDate($customer_id,$mysqli),$customer_id,$mysqli,'payment_transaction');
	
	$sql = "INSERT INTO payment_transaction (
			customer_id,
			property_sold_id,
			date_paid,
			due_date,
			method_of_payment,
			amount_paid,
			transacted_by)
			VALUES (
			'$customer_id',
			'$property_sold_id',
			'$date_paid',
			'$due_date',
			'$method_of_payment',
			'$amount_paid',
			'$transacted_by')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(401)";
	}

	header('Location: ../pages/payment-transaction.php');

}

function sellProperty($mysqli){

	$propertyId = $_POST['propertyId'];
	$customer_id = getIdViaCustomerName($_POST['customer_id'],$mysqli);
	$total_amount = $_POST['total_amount'];
	$terms_of_payment = $_POST['terms_of_payment'];
	$monthly_payment = $_POST['monthly_payment'];
	$date_added = date("Y-m-d");
	$transacted_by = $_SESSION['user_id'];
	$first_due_date = getFirstDueDate();
	
	$sql = "INSERT INTO 
			property_sold (
				customer_id,
				property_id,
				total_amount,
				terms_of_payment,
				monthly_payment,
				transacted_by,
				date_added,first_due_date) VALUES(
				'$customer_id',
				'$propertyId',
				'$total_amount',
				'$terms_of_payment',
				'$monthly_payment',
				'$transacted_by',
				'$date_added',
				'$first_due_date')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 	setPropertySold($propertyId,$mysqli);
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(301)";
	}

	header('Location: ../pages/sell-property.php');
}
function setPropertySold($id,$mysqli){
	$sql = "UPDATE property 
			SET 
			availability = 1
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 	
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(1001)";exit();
	}
}

function addCustomer($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;

	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;

	exit;
	*/

	//insert account and get account id
	 $account_id = getAccountId($username,$password,'../pages/customer-list.php',$mysqli);


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
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO customer(firstname, middlename, lastname, age, gender, physical_address, email_address, contact_number, image_path, account_id, status) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$physical_address','$email_address','$contact_number','$name','$account_id','$status')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="success";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(205)";
		}
	}//end upload image

	header('Location: ../pages/customer-list.php');
}//end of function

function editCustomer($mysqli){

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;
	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;
	exit;*/

	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE customer SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {
						
				$sql = "SELECT account_id FROM customer WHERE id = '$id'";
				 $result = mysqli_query($mysqli,$sql);
			      if (mysqli_num_rows($result) > 0) { 

			         while($row = mysqli_fetch_assoc($result)) {

			         	$account_id = $row['account_id'];

			         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
			         	if (mysqli_query($mysqli,$sql)) {

							$_SESSION['ERR']="success";		
						 
						} else {
							
						   $_SESSION['ERR']="Something went wrong: error(206)";
						}
			         }
			     }			

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(207)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE customer SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status',image_path = '$name' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

			$sql = "SELECT account_id FROM customer WHERE id = '$id'";
			 $result = mysqli_query($mysqli,$sql);
		      if (mysqli_num_rows($result) > 0) { 

		         while($row = mysqli_fetch_assoc($result)) {

		         	$account_id = $row['account_id'];

		         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
		         	if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="success";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(208)";
					}
		         }
		     }		
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(209)";
		}
    }//end upload image

	header('Location: ../pages/customer-list.php');
}

function updateproperty($mysqli){

	$client_id = $_POST['client_id'];
	$property_relation = $_POST['radioRelationProperty'];
	$date_management_commence = $_POST['dateManagement'];
	$property_name = $_POST['property_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$postal_code = $_POST['postal_code'];
	$property_size = $_POST['property_size'];
	$subject_to = $_POST['subject_to'];
	$price = $_POST['price'];
	$size_unit = $_POST['size_unit'];
	$payment_mode = $_POST['payment_mode'];
	$monthly_payment = $_POST['monthly_payment'];
	$property_type = $_POST['property_type'];
	$caretaker = $_POST['caretaker'];
	$additional_info = $_POST['additional_info'];
	$condition = $_POST['condition'];
	$property_id = $_POST['property_id'];
	$image_path = "";
	$block = $_POST['propBlock'];
	$lot = $_POST['propLot'];
	$price_per_sqm = $_POST['price_per_sqm'];
	$price_bought = $_POST['price_bought'];


	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){

		$sql = "UPDATE property SET
			client_id = '$client_id',
			property_relation = '$property_relation',
			date_management_commence = '$date_management_commence',
			property_name = '$property_name',
			block = '$block',
			lot = '$lot',
			address = '$address',
			city = '$city',
			postal_code = '$postal_code',
			property_size = '$property_size',
			subject_to = '$subject_to',
			price_per_sqm = '$price_per_sqm',
			price_bought = '$price_bought',
			price = '$price',
			size_unit = '$size_unit',
			payment_mode = '$payment_mode',
			monthly_payment = '$monthly_payment',
			property_type = '$property_type',
			caretaker = '$caretaker',
			additional_info = '$additional_info',
			property_condition = '$condition'			
			WHERE id =  '$property_id'";

	}else{

		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    $image_path = $name;

	    $sql = "UPDATE property SET
			client_id = '$client_id',
			property_relation = '$property_relation',
			date_management_commence = '$date_management_commence',
			property_name = '$property_name',
			block = '$block',
			lot = '$lot',
			address = '$address',
			city = '$city',
			postal_code = '$postal_code',
			property_size = '$property_size',
			subject_to = '$subject_to',
			price_per_sqm = '$price_per_sqm',
			price_bought = '$price_bought',
			price = '$price',
			size_unit = '$size_unit',
			payment_mode = '$payment_mode',
			monthly_payment = '$monthly_payment',
			property_type = '$property_type',
			caretaker = '$caretaker',
			additional_info = '$additional_info',
			property_condition = '$condition',
			image_path = '$image_path'
			WHERE id =  '$property_id'";
	}

	//echo $sql;

	if (mysqli_query($mysqli,$sql)) {

		 $_SESSION['ERR'] = "success";

	}else{
			echo mysqli_error($mysqli);
		 $_SESSION['ERR']="Something went wrong: error(150)";exit;
	}
 	header('Location: ../pages/property.php');

}

function addmaintenance($mysqli){

	$customer_id = getIdViaCustomerName($_POST['maintenance_customer_id'] ,$mysqli);
	
	$property_id = $_POST['property_id'];
	$contact_number = $_POST['contact_number'];
	$request_date = $_POST['request_date'];
	$property_access_by = $_POST['property_access_by'];
	$repair_request = mysqli_real_escape_string($mysqli,$_POST['repair_request']);

	$sql = "INSERT INTO maintenance_request(
		customer_id,
		property_id,
		contact_number,
		request_date,
		property_access_by,
		repair_request) VALUES (
		'$customer_id',
		'$property_id',
		'$contact_number',
		'$request_date',
		'$property_access_by',
		'$repair_request')";

	if (mysqli_query($mysqli,$sql)) {

		// $_SESSION['ERR'] = "";
		 $_SESSION['ERR']="success";
		 

	}else{
			echo mysqli_error($mysqli);
		 $_SESSION['ERR']="Something went wrong: error(102)";
	}
 header('Location: ../pages/maintenance-request.php');
}

function attachproperty($mysqli){

	$client_id = getIdViaClientName($_POST['client_id'],$mysqli);
	$block = $_POST['propBlock'];
	$lot = $_POST['propLot'];
	$property_relation = $_POST['radioRelationProperty'];
	$date_management_commence = $_POST['dateManagement'];
	$property_name = $_POST['property_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$postal_code = $_POST['postal_code'];
	$property_size = $_POST['property_size'];
	$subject_to = $_POST['subject_to'];
	$price = $_POST['price'];
	$size_unit = $_POST['size_unit'];
	$payment_mode = $_POST['payment_mode'];
	$monthly_payment = $_POST['monthly_payment'];
	$property_type = $_POST['property_type'];
	$caretaker = $_POST['caretaker'];
	$additional_info = $_POST['additional_info'];
	$condition = $_POST['condition'];
	$price_bought = $_POST['price_bought'];
	$image_path = "";
	$price_per_sqm = $_POST['price_per_sqm'];



	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
		$image_path = "no-image-land.png";

	}else{

		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    $image_path = $name;
	}
/*
	echo $client_id.'<br>'.
	$property_relation.'<br>'.
	$date_management_commence.'<br>'.
	$property_name.'<br>'.
	$address.'<br>'.
	$city.'<br>'.
	$postal_code.'<br>'.
	$property_size.'<br>'.
	$subject_to.'<br>'.
	$price.'<br>'.
	$payment_mode.'<br>'.
	$monthly_payment.'<br>'.
	$property_type.'<br>'.
	$caretaker.'<br>'.
	$price_bought.'<br>'.
	$additional_info.'<br>'.
	$image_path;
	exit;
*/
	$sql = "INSERT INTO property (
			client_id, 
			property_relation, 
			date_management_commence, 
			property_name,
			block,
			lot,
			address,
			city,
			postal_code,
			property_size,
			subject_to,
			price_per_sqm,
			price_bought,
			price,			
			size_unit,
			payment_mode,
			monthly_payment,
			property_type,
			caretaker,
			additional_info,
			property_condition,
			image_path )VALUES(
			'$client_id',
			'$property_relation',
			'$date_management_commence',
			'$property_name',
			'$block',
			'$lot',
			'$address',
			'$city',
			'$postal_code',
			'$property_size',
			'$subject_to',
			'$price_per_sqm',
			'$price_bought',
			'$price',			
			'$size_unit',
			'$payment_mode',
			'$monthly_payment',
			'$property_type',
			'$caretaker',
			'$additional_info',
			'$condition',
			'$image_path')";

	if (mysqli_query($mysqli,$sql)) {

		$sqlmax = "SELECT max(id) maxid FROM property";
		$result = mysqli_query($mysqli,$sqlmax);
		$row = mysqli_fetch_array($result);
		$property_id = $row["maxid"];

		$sql = "UPDATE uploads SET property_id = '$property_id' WHERE property_id = 0";
		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="success";	
		}else{
			 $_SESSION['ERR']="Something went wrong: error(99)";
		}
			 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(100)";
	}
	echo $_SESSION['ERR'];
	header('Location: ../pages/attach-property.php');

}

function addclient($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;

	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;

	exit;
	*/

	//insert account and get account id
	 $account_id = getAccountId($username,$password,'../pages/client-list.php',$mysqli);


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
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO client(firstname, middlename, lastname, age, gender, physical_address, email_address, contact_number, image_path, account_id, status) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$physical_address','$email_address','$contact_number','$name','$account_id','$status')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="success";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(05)";
		}
	}//end upload image

	header('Location: ../pages/client-list.php');
}//end of function

function confirmDelete($mysqli,$url){

	$table = $_POST["dbtable"];
	$id = $_POST["tableId"];
		
	if($table == 'client' || $table == 'employee'){
		
		$sql = "SELECT account_id FROM ".$table." WHERE id = '$id'";
		 $result = mysqli_query($mysqli,$sql);
	      if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {

	         	$account_id = $row['account_id'];

	         	$sql = "UPDATE account set deleted = 1 WHERE id = '$account_id'";
	         	if (mysqli_query($mysqli,$sql)) {

					$_SESSION['ERR']="success";		
				 
				} else {
					
				   $_SESSION['ERR']="Something went wrong: error(07)";
				}
	         }
	     }
	}
	
	$sql = "UPDATE ".$table." SET deleted = 1 WHERE id = '$id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="success";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(06)";
	}

	echo $_SESSION['ERR'];
	header('Location: '.$url.'');
}

function editClient($mysqli){

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;
	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;
	exit;*/

	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE client SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {
						
				$sql = "SELECT account_id FROM client WHERE id = '$id'";
				 $result = mysqli_query($mysqli,$sql);
			      if (mysqli_num_rows($result) > 0) { 

			         while($row = mysqli_fetch_assoc($result)) {

			         	$account_id = $row['account_id'];

			         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
			         	if (mysqli_query($mysqli,$sql)) {

							$_SESSION['ERR']="success";		
						 
						} else {
							
						   $_SESSION['ERR']="Something went wrong: error(08)";
						}
			         }
			     }			

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(09)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE client SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status',image_path = '$name' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

			$sql = "SELECT account_id FROM client WHERE id = '$id'";
			 $result = mysqli_query($mysqli,$sql);
		      if (mysqli_num_rows($result) > 0) { 

		         while($row = mysqli_fetch_assoc($result)) {

		         	$account_id = $row['account_id'];

		         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
		         	if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="success";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(08)";
					}
		         }
		     }		
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11)";
		}
    }//end upload image

	header('Location: ../pages/client-list.php');
}

function getAccountId($username,$password,$url_link,$mysqli){
	$user = $username;
	$pass = $password;
	$url = $url_link;
	$account_id =0;

	$sql = "INSERT INTO account (username,password) VALUES ('$user','$pass')";
	if(mysqli_query($mysqli,$sql)){
		$sqlmax = "SELECT max(id) maxid FROM account";
		$result = mysqli_query($mysqli,$sqlmax);
		$row = mysqli_fetch_array($result);
		$account_id = $row["maxid"];
		
	}else{
		 $_SESSION['ERR']="Something went wrong(04)";
		 //header('Location: '.$url.'');exit;
	}

	return $account_id;
}


function addEmployee($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$position = $_POST['position'];
	$account_id = 0;

	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;

	exit;
	*/

	//insert account and get account id
	 $account_id = getAccountId($username,$password,'../pages/employee-list.php',$mysqli);


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
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO employee(firstname, middlename, lastname, age, gender, position, physical_address, email_address, contact_number, image_path, account_id, status) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$position','$physical_address','$email_address','$contact_number','$name','$account_id','$status')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="success";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(05)";
		}
	}//end upload image

	header('Location: ../pages/employee-list.php');
}//end of function


function editEmployee($mysqli){

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$position = $_POST['position'];
	$image_path='noimage.png';
	$account_id = 0;
	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;
	exit;*/

	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE employee SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender', position = '$position',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

						
				$sql = "SELECT account_id FROM employee WHERE id = '$id'";
				 $result = mysqli_query($mysqli,$sql);
			      if (mysqli_num_rows($result) > 0) { 

			         while($row = mysqli_fetch_assoc($result)) {

			         	$account_id = $row['account_id'];

			         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
			         	if (mysqli_query($mysqli,$sql)) {

							$_SESSION['ERR']="success";		
						 
						} else {
							
						   $_SESSION['ERR']="Something went wrong: error(08)";
						}
			         }
			     }			

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(09)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE employee SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender', position = '$position',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status',image_path = '$name' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

			 $sql = "SELECT account_id FROM employee WHERE id = '$id'";
			 $result = mysqli_query($mysqli,$sql);
		      if (mysqli_num_rows($result) > 0) { 

		         while($row = mysqli_fetch_assoc($result)) {

		         	$account_id = $row['account_id'];

		         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
		         	if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="success";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(08)";
					}
		         }
		     }		
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11)";
		}
    }//end upload image

	header('Location: ../pages/employee-list.php');
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
		 $_SESSION['ERR'] = "success";

	}else{
			echo mysqli_error($mysqli);
		 $_SESSION['ERR']="Something went wrong: error(102)";exit;
	}
 header('Location: ../pages/about-us-details.php'); 
}


?>