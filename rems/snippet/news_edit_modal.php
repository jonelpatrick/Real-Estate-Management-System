<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
 
$id = $_GET['id'];  
$sql = "SELECT news_title, news_description FROM news_updates WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    
        while($row = mysqli_fetch_assoc($result)) { 
        	$news_title = $row['news_title'];
        	$news_description = $row['news_description'];   
        }
    } 
?>
<form method="POST" action="../cli/functions.php" enctype="multipart/form-data">
<!-- modal -->
<div class="modal fade firstmodal" id="addnews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">New Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="client-body">
        <div class="modal-body"> 
          <form method="POST" action="../cli/web-functions.php" id="addnews" enctype="multipart/form-data">
            <input type="hidden" value="addnews" name="action"> 
            <div class="input-group mb-3" style="margin-bottom: 0 !important;"> 
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" placeholder="News Title" name="news_title" required=" " value="<?php echo $news_title ?>"> 
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" placeholder="News Description" name="news_description" required=" "  value="<?php echo $news_title ?>"> 
            </div>       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button  type="submit" class="btn btn-primary">Save changes</button>           
        </div>
      </form>   
    </div>
    </div>
  </div>
</div>
</form> 


<form method="POST" action="../cli/web-functions.php" enctype="multipart/form-data">
 <input type="hidden" value="updateEvents" name="action">
  <input type="hidden" class="form-control" id="formFirstname" placeholder="Firstname" name="id" value="<?php echo $id; ?>">
  
 <div class="modal-body">   
   <div class="form-group">          
    <input type="text" class="form-control" id="formFirstname" placeholder="Firstname" name="news_title" value="<?php echo $news_title; ?>">
  </div>
   <div class="form-group">          
    <input type="text" class="form-control" id="formMiddlename" placeholder="middlename" name="news_description" value="<?php echo $news_description; ?>">
  </div>
  
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button  type="submit" class="btn btn-primary">Save changes</button>           
  </div>
</form> 

