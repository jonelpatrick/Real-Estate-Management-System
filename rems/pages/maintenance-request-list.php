<?php
  include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Maintenance
        </li>
        <li class="breadcrumb-item active"><a href= "maintenance-request-list.php">Request List</a></li>
      </ol>    

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Maintenance Request</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Request Date</th>
                      <th>Requestor Name</th>
                      <th>Property Name</th>
                      <th>Property Location</th>
                      <th>City</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Date</th>
                      <th>Requestor Name</th>
                      <th>Property Name</th>
                      <th>Property Location</th>
                      <th>City</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT 
                            maintenance_request.id mid,
                            firstname,
                            middlename,
                            lastname,
                            property_name,
                            property.address paddress,
                            maintenance_request.contact_number mcontact,
                            city,
                            request_date,
                            property_access_by,
                            repair_request
                            FROM maintenance_request 
                            INNER JOIN customer ON 
                            maintenance_request.customer_id = customer.id 
                            INNER JOIN property ON
                            maintenance_request.property_id = property.id 
                            WHERE property.deleted = 0 
                            AND maintenance_request.deleted = 0
                            AND scheduled = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                        
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['mid'];
                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                                      
                           echo '<tr>';
                           echo '<td>'.$row['request_date'].'</td>';
                           echo '<td>'.$name.'</td>';
                           echo '<td>'.$row['property_name'].'</td>';
                           echo '<td>'.$row['paddress'].'</td>';
                           echo '<td>'.$row['city'].'</td>';
                            echo '<td style="width:15px;"><button title="Schedule Maintenance" onclick="onSchedule('.$id.')" class="toolbar-edit" > <i class="far fa-clock"></i>'.''.'</button></td>';
                           echo '<td style="width:15px;"><button title="View Request" class="toolbar-edit" onclick="generateRequest('.$id.');" > <i class="fas fa-eye"></i>'.''.'</button></td>';
                           echo '<td style="width:15px;"><button title="Delete Request" class="toolbar-delete" onclick="showDeleteRequest('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
<div class="modal fade" id="scheduleMaintenance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Make a Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../cli/functions.php" method="POST">
        <div class="schedule-detail-body">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
          <input type="submit" name="submit" value="Schedule now" class="btn btn-primary">    
        </div>
      </form>
    </div>
  </div>
</div>
 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">



<?php
  include '../template/footer.php';
?>
<script type="text/javascript">

   function generateRequest(id){
   
    window.open('../snippet/maintenance-request-form.php?id='+ id);
  }
   function showDeleteRequest(id){    
      var id = id;            
      var table = "maintenance_request";
      var redirect = '../pages/maintenance-request-list.php'
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }

  function onSchedule(id){
    var idl = id;
    
     $('.schedule-detail-body').load('../snippet/make-a-schedule.php?id=' + id,function(){           
          $('#scheduleMaintenance').modal({show:true});          
      });  
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
    $(".menu-maintenance").addClass("active");
});

</script>