<?php
  include '../template/header.php';

  $id = $_SESSION['user_id'];
  $user_type = $_SESSION['user_type'];
  
  switch ($user_type) {

    case 'Client':
      
       $sql = "SELECT 
              client.id id,
              account_id,
              image_path,
              firstname,
              middlename,
              lastname,
              contact_number,              
              gender,
              email_address,
              physical_address,
              status,
              username,              
              password 
              FROM client
              INNER JOIN account
              ON client.account_id = account.id
              WHERE client.deleted = 0 AND client.id = '$id'";

        $result = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($result) > 0) { 
           while($row = mysqli_fetch_assoc($result)) {

            $image_path = $row['image_path'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $email = $row['email_address'];
            $address = $row['physical_address'];
            $active = $row['status'];                        
            $phone = $row['contact_number'];
            $password  = $row['password'];
            $sex = $row['gender'];
            $username = $row['username'];
            $account_id = $row['account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
           }

         }

        $login_type = 'Client';
      break;

    case 'Customer':
      
      $sql = "SELECT 
              customer.id id,
              account_id,
              image_path,
              firstname,
              middlename,
              lastname,
              contact_number,              
              gender,
              email_address,
              physical_address,
              status,
              username,              
              password 
              FROM customer
              INNER JOIN account
              ON customer.account_id = account.id
              WHERE customer.deleted = 0 AND customer.id = '$id'";

        $result = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($result) > 0) { 
           while($row = mysqli_fetch_assoc($result)) {

            $image_path = $row['image_path'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $email = $row['email_address'];
            $address = $row['physical_address'];
            $active = $row['status'];                        
            $phone = $row['contact_number'];
            $password  = $row['password'];
            $sex = $row['gender'];
            $username = $row['username'];
            $account_id = $row['account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
           }

         }

        $login_type = 'Customer';
      break;

    default:

      $sql = "SELECT 
              employee.id id,
              account_id,
              image_path,
              firstname,
              middlename,
              lastname,
              contact_number,              
              gender,
              email_address,
              physical_address,
              status,
              username,              
              password 
              FROM employee
              INNER JOIN account
              ON employee.account_id = account.id
              WHERE employee.deleted = 0 AND employee.id = '$id'";

        $result = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($result) > 0) { 

           while($row = mysqli_fetch_assoc($result)) {

            $image_path = $row['image_path'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $email = $row['email_address'];
            $address = $row['physical_address'];
            $active = $row['status'];                        
            $phone = $row['contact_number'];
            $password  = $row['password'];
            $sex = $row['gender'];
            $username = $row['username'];
            $account_id = $row['account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
           }

         }
         $login_type = 'Employee';

      break;
  }
  
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="myprofile.php">My Profile</a>
        </li>
        <li class="breadcrumb-item active">Settings</li>
      </ol>    
     <form method="POST" action="../cli/functions.php" enctype="multipart/form-data">
      <input type="hidden" name="action" value="updateProfile<?php echo  $login_type; ?>">
      <input type="hidden" name="user_id" value="<?php echo $id; ?>">
      <input type="hidden" name="account_id" value="<?php echo  $account_id; ?>">
      <div class="row">
         <label id="profileMessage" style="color:red;"></label> 
        <div class="col-lg-8 offset-2">
         <div class="btn-container">  
            <input type="submit" class="btn btn-primary" value="Update Profile" />
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-6">
               <div class="input-group mb-3" >
                 <div class="form-group" style="width:100%;">
                    <img id='img-upload' style="height: 300px;" src="../uploads/<?php echo $image_path; ?>" />
                    
                    <div class="input-group addborder">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp" name="image">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    
                </div>             
              </div>
            </div> 
            <div class="col-lg-6">
               <div class="form-group">   
                  <label>Firstname :</label>
                  <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div> 
                <div class="form-group">   
                  <label>Middlename :</label>
                  <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>">
                </div> 
                <div class="form-group">   
                  <label>Lastname :</label>
                  <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                </div> 
                
                <div class="form-group inline-layout">
                    <label class="radio-inline">Sex: </label>
                    <label class="radio-inline">
                      <input type="radio" name="formRadioSex" value="0" <?php if($sex == 0){ echo 'checked';} ?>>Male
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="formRadioSex" value="1" <?php if($sex == 1){ echo 'checked';} ?>>Female
                    </label>
                </div>
            </div>
        </div>          
         <div class="form-group">   
            <label>Physical Address :</label>
            <textarea class="form-control" name="physical_address"><?php echo $address; ?></textarea>
          </div> 
          <div class="form-group">           
            <label>Phone Number :</label>
            <input type="Number" class="form-control" name="phone" value="<?php echo $phone; ?>">  
          </div> 
           <div class="form-group">   
              <label>Email Address :</label>
              <input type="email" class="form-control" name="email_address" value="<?php echo $email; ?>">
            </div> 
         
           <div class="jumbotron">
              <div class="form-group">   
                <label>Username :</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
              </div>      
              <div class="form-group">  
               <label>Password :</label>        
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="<?php echo $password; ?>" >
              </div>
              <div class="form-group">          
               <label>Confirm Password :</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php echo $password; ?>">
              </div>
           </div>
        </div>
        
    </div><!-- row -->
  </form>
</div>
 <input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">


<?php
  include '../template/footer.php';
?>
 
<script type="text/javascript">

  transactionValidate();
  function transactionValidate(){
     var error = $('#transactResult').val();
     if(error != ""){
         if(error == "success"){
          processingSuccess();
         }else{
          processingError();
         }
     }      
  }
    $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-myprofile").addClass("active");
});
</script>