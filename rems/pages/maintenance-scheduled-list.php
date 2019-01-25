<?php
  include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Maintenance - Scheduled List
        </li>
        <li class="breadcrumb-item active"><a href= "maintenance-request-list.php">Maintenance Scheduled List</a></li>
      </ol>    

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of schedule</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Schedule Date</th>
                      <th>Request Date</th>
                      <th>Requestor Name</th>
                      <th>Property Name</th>
                      <th>Property Location</th>                      
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>Schedule Date</th>
                      <th>Request Date</th>
                      <th>Requestor Name</th>
                      <th>Property Name</th>
                      <th>Property Location</th>                                        
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php                    

                    $sql = "SELECT
                            maintenance_scheduled.id msid,
                            scheduled_date,
                            person_in_charge,
                            firstname,
                            middlename,
                            lastname,
                            customer.contact_number contact,
                            property_name,
                            property.address paddress,
                            city,
                            request_date,
                            property_access_by,
                            repair_request
                            FROM maintenance_scheduled
                            INNER JOIN maintenance_request 
                            ON maintenance_scheduled.maintenance_request_id = maintenance_request.id
                            INNER JOIN customer 
                            ON maintenance_request.customer_id = customer.id 
                            INNER JOIN property ON
                            maintenance_request.property_id = property.id 
                            WHERE property.deleted = 0
                            AND maintenance_scheduled.deleted = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                        
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['msid'];
                          $scheduled_date = $row['scheduled_date'];
                          $client_name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $person_in_charge = $row['person_in_charge'];
                          $property_name = $row['property_name'];
                          $address = $row['paddress'].', '.$row['city'];
                          $request_date = $row['request_date'];
                          $property_access_by = $row['property_access_by'];
                          $repair_request = $row['repair_request'];
                          $contact = $row['contact'];
                                      
                           echo '<tr>';
                           echo '<td>'.$scheduled_date.'</td>';
                           echo '<td>'.$request_date.'</td>';
                           echo '<td>'.$client_name.'</td>';
                           echo '<td>'.$property_name.'</td>';
                           echo '<td>'.$address.'</td>';
                           
                           echo '<td style="width:15px;"><button title="View Request" class="toolbar-edit" onclick="generateJobOrder('.$id.');" > <i class="fas fa-eye"></i>'.''.'</button></td>';
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


<script type="text/javascript">

   function generateJobOrder(id){
   
    window.open('../snippet/maintenance-job-order.php?id='+ id);
  }
   function showDeleteRequest(id){    
      var id = id;            
      var table = "maintenance_scheduled";
      var redirect = '../pages/maintenance-scheduled-list.php'
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }


</script>

<?php
  include '../template/footer.php';
?>
<script type="text/javascript">
      $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-maintenance").addClass("active");
});
</script>