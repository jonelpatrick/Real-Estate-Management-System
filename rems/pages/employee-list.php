<?php
  include '../template/header.php';
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Employee List</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="btn-container">  
        <button class="btn btn-primary" data-toggle="modal" data-target="#addnewemployee">Add New Employee</button>
       
      </div>

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Employee</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Position</th>
                      <th>Status</th>
                     <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Position</th>
                      <th>Status</th>
                      <th></th>
                       <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT id,firstname,middlename,lastname,email_address,status,position FROM employee WHERE deleted= 0";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $status = $row['status'];
                          $id = $row["id"];
                          echo '<tr>'; 
                          echo '<td>'.$name.'</td>';
                          echo '<td>'.$row['email_address'].'</td>';
                          echo '<td>'.$row['position'].'</td>';
                          if($status == 0){
                            $status = 'active';
                            echo '<td style="width:35px;"><span class="status-ac">'.$status.'</span></td>';
                          }else{
                            $status = 'inactive';
                             echo '<td style="width:35px;"><span class="status-in">'.$status.'</span></td>';
                          }
                         
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditEmp('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteEmp('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="addnewemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="client-body">
        <div class="modal-body">
    
          <form method="POST" action="../cli/functions.php" id="myform" enctype="multipart/form-data">
            <input type="hidden" value="addEmployee" name="action">

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
                  <img id='img-upload'/>
              </div>
             
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" id="formFirstname" placeholder="Firstname" name="firstname">
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" id="formMiddlename" placeholder="middlename" name="middlename">
            </div>
             <div class="form-group">        
              <input type="text" class="form-control" id="formLastname" placeholder="Lastname" name="lastname">
            </div>
             <div class="form-group">          
              <input type="Number" class="form-control" id="formAge" placeholder="Age" name="age">
            </div>
             <div class="form-group inline-layout">
                <label class="radio-inline">Sex: </label>
                <label class="radio-inline">
                  <input type="radio" name="formRadioSex" value="0" checked>Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="formRadioSex" value="1">Female
                </label>
            </div>
            <div class="form-group">          
              <input type="text" class="form-control" id="formPhysicalAddress" placeholder="Physical Address" name="physicaladdress">          
            </div>
            <div class="form-group">          
              <input type="email" class="form-control" id="formEmail" aria-describedby="emailHelp" placeholder="Email Address" name="emailaddress">          
            </div> 
             <div class="form-group">          
              <input type="text" class="form-control" id="formContactNumber" placeholder="Contact Number" name="contactnumber">          
            </div>

            <div class="form-group inline-layout">  
            <label class="radio-inline">Status: </label> 
              <select class="custom-select radio-inline" name="status">
              <option>Active</option>
              <option>Inactive</option>          
              </select>
            </div>
             <div class="form-group inline-layout">  
              <label class="radio-inline">Position: </label> 
              <select class="custom-select radio-inline" name="position">              
              <option value="Clerk">Clerk</option>            
              <option value="Manager">Manager</option>              
              <option value="Administrator">Administrator</option>
              </select>
            </div>

            <div class="jumbotron">
               <div class="form-group">          
                <input type="text" class="form-control" id="formUsername" placeholder="Username" name="username">          
              </div>       
              <div class="form-group">          
                <input type="password" class="form-control" id="formPassword" placeholder="Password" name="password">
                <input type="checkbox" onclick="myFunction()"><i class="small text-muted">Show Password</i>
              </div>
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

 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

<?php
  include '../template/footer.php';
?>

<script type="text/javascript">
    function myFunction() {
    var x = document.getElementById("formPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

  function showEditEmp(id){    
      var id = id;            
      $('.client-body').load('../snippet/emp-modal-edit.php?id=' + id,function(){           
          $('#addnewemployee').modal({show:true}); 
         
      });                    
  }
  function showDeleteEmp(id){    
      var id = id;            
      var table = "client";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

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
    $(".menu-employee-list").addClass("active");
});

 
</script>