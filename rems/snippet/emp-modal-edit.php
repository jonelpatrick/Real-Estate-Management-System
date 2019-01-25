<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';

define("UPLOAD_DIR", "../uploads/");

$id = $_GET['id'];

$sql = "SELECT 
        firstname,
        middlename,
        lastname,
        age,
        gender,
        physical_address,
        email_address,
        contact_number,
        image_path,
        account_id,
        status,position 
        FROM employee 
        WHERE id = '$id'";

$result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    
        while($row = mysqli_fetch_assoc($result)) {
        	$firstname = $row['firstname'];
        	$middlename = $row['middlename'];
        	$lastname = $row['lastname'];
        	$age = $row['age'];
        	$gender = $row['gender'];
        	$physical_address = $row['physical_address'];
        	$email_address = $row['email_address'];
        	$contact_number = $row['contact_number'];
        	$image = $row['image_path'];
        	$account_id = $row['account_id'];
        	$status = $row['status'];  
          $position = $row['position'];

        $sql = "SELECT username, password FROM account WHERE id = '$account_id'";      	
  			$result = mysqli_query($mysqli,$sql);        	
			if (mysqli_num_rows($result) > 0) {	   
				while($row = mysqli_fetch_assoc($result)) {
					$username = $row['username'];
					$password = $row['password'];
				}
			}
        }
    }

?>
<form method="POST" action="../cli/functions.php" enctype="multipart/form-data">

 <div class="modal-body">

  <input type="hidden" value="editEmployee" name="action">
  <input type="hidden" value="<?php echo $id; ?>" name="id">
  <div class="input-group mb-3" style="margin-bottom: 0 !important;">
     <div class="form-group" style="width:100%;">
        <label>Upload Image</label>
        <div class="input-group addborder">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgInp" name="image">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload' src="<?php echo UPLOAD_DIR.$image; ?>"/>
    </div>
   
  </div>
   <div class="form-group">          
    <input type="text" class="form-control" id="formFirstname" placeholder="Firstname" name="firstname" value="<?php echo $firstname; ?>">
  </div>
   <div class="form-group">          
    <input type="text" class="form-control" id="formMiddlename" placeholder="middlename" name="middlename" value="<?php echo $middlename; ?>">
  </div>
   <div class="form-group">        
    <input type="text" class="form-control" id="formLastname" placeholder="Lastname" name="lastname" value="<?php echo $lastname; ?>">
  </div>
   <div class="form-group">          
    <input type="text" class="form-control" id="formAge" placeholder="Age" name="age" value="<?php echo $age; ?>">
  </div>
   <div class="form-group inline-layout">
      <label class="radio-inline">Sex: </label>
      <label class="radio-inline">
        <input type="radio" name="formRadioSex" value="0" <?php if($gender == 0){ echo 'checked'; } ?>>Male
      </label>
      <label class="radio-inline">
        <input type="radio" name="formRadioSex" value="1" <?php if($gender == 1){ echo 'checked'; } ?>>Female
      </label>
  </div>
  <div class="form-group">          
    <input type="text" class="form-control" id="formPhysicalAddress" placeholder="Physical Address" name="physicaladdress" value="<?php echo $physical_address; ?>">           
  </div>
  <div class="form-group">          
    <input type="email" class="form-control" id="formEmail" aria-describedby="emailHelp" placeholder="Email Address" name="emailaddress" value="<?php echo $email_address; ?>">          
  </div> 
   <div class="form-group">          
    <input type="text" class="form-control" id="formContactNumber" placeholder="Contact Number" name="contactnumber" value="<?php echo $contact_number; ?>">          
  </div>

  <div class="form-group inline-layout">  
  <label class="radio-inline">Status: </label> 
    <select class="custom-select radio-inline" name="status">
    <option value = "0" <?php if($status == 0){ echo 'selected'; } ?> >Active</option>
    <option value = "1" <?php if($status == 1){ echo 'selected'; } ?> >Inactive</option>          
    </select>
  </div>

   <div class="form-group inline-layout"> 
    
    <label class="radio-inline">Position: </label> 
    <select class="custom-select radio-inline" name="position">
    <option value="Customer" <?php if($position == 'Customer'){ echo 'selected'; } ?> >Customer</option>
    <option value="Client" <?php if($position == 'Client'){ echo 'selected'; } ?> >Client</option>
    <option value="Clerk" <?php if($position == 'Clerk'){ echo 'selected'; } ?> >Clerk</option>
    <option value="Manager" <?php if($position == 'Manager'){ echo 'selected'; } ?> >Manager</option>    
    <option value="Administrator" <?php if($position == 'Administrator'){ echo 'selected'; } ?> >Administrator</option>            
    </select>
  </div>

  <div class="jumbotron">
     <div class="form-group">          
      <input type="text" class="form-control" id="formUsername" placeholder="Username" name="username" value="<?php echo $username; ?>">          
    </div>       
    <div class="form-group">          
      <input type="password" class="form-control" id="formPassword" placeholder="Password" name="password" value="<?php echo $password; ?>">
    </div>
   </div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	  <button  type="submit" class="btn btn-primary">Save changes</button>           
	</div>
</form> 
