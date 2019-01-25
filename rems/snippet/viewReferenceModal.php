<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
 
$id = $_GET['id'];  
$sql = "SELECT p_id, firstname, surname, contact, email, date_created FROM reference_number WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    
        while($row = mysqli_fetch_assoc($result)) {
          $pid = $row['p_id']; 
        	$fullname = $row['firstname']; 
          $email = $row['email']; 
          $contact = $row['contact'];
          $date = $row['date_created'];  
        }
    } 
?> 
<!-- modal -->


      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Messaged by: <?php echo $fullname?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="client-body">
        <div class="modal-body"> 

           <h5 style="padding: 20px;font-size: 17px;"><?php echo $fullname; ?></h5>  
        </div>

        <form method="POST" action="../cli/web-functions.php" id="addnews" enctype="multipart/form-data">
        <input type="hidden" value="confirmDeleteMessage" name="action">
        <input type="hidden" value="<?php echo $id; ?>" name="id">
        <div class="modal-footer"> 
          <button  type="submit" class="btn btn-danger">Delete this Message</button>      
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>     
        </div>
        </form>
 
    </div>

