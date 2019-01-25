<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Maintenance Request</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="row">       
        <div class="col-lg-8 offset-2">
         <form action="../cli/functions.php" method="POST">
          <input type="hidden" name="action" value="addmaintenance">
          <div class="card mb-3">
            <div class="card-header">
             Request for Maintenance
            </div>
            <div class="card-body">
            
              <div class="form-group">  
                <label>Requestor: </label> 
                <!--  session error /no -->
                <input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

                <?php if($_SESSION['user_type'] == 'Customer'){  ?>

                 <input type="hidden" name="client_id">
                 <label><?php echo $_SESSION['user']; ?></label>
                 <input type="hidden" name="maintenance_customer_id" value="<?php echo $_SESSION['user_id']; ?>">
                <?php } else { ?>
                   <!--
                 <input class="editable-select" list="customer" name="customer_id" placeholder="Select Customer here"  />
                <datalist id="customer">
                  <?php
                      $sql = "SELECT 
                              property_sold.id pid,
                              customer_id id,
                              customer.firstname firstname,
                              customer.middlename middlename,
                              customer.lastname lastname 
                              FROM property_sold 
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id 
                              WHERE property_sold.deleted = 0";
                              
                       $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) {                             
                           while($row = mysqli_fetch_assoc($result)) {
                            $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                            $id  = $row['id'];
                            
                            echo '<option value="'.$name.'">';
                        
                           }
                        }
                    ?>           
                </datalist>   
                   -->
                   <!--
                <select id="client_id_select" class="custom-select radio-inline" name="customer_id" >
                    <?php
                      $sql = "SELECT 
                              property_sold.id pid,
                              customer_id id,
                              customer.firstname firstname,
                              customer.middlename middlename,
                              customer.lastname lastname 
                              FROM property_sold 
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id 
                              WHERE property_sold.deleted = 0";

                       $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) { 

                            echo '<option value="0">Select Customer from the list...</option>';

                           while($row = mysqli_fetch_assoc($result)) {
                            $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                            $id  = $row['id'];
                            echo '<option value="'.$id.'">'.$name.'</option>';
                           }
                        }
                    ?>                    
                </select>
                -->
                  <input id="maintenanceCustomer" class="editable-select" list="customer" name="maintenance_customer_id" placeholder="Select Customer here" />
                  <datalist id="customer">
                    <?php
                          $sql = "SELECT 
                              property_sold.id pid,
                              customer_id id,
                              customer.firstname firstname,
                              customer.middlename middlename,
                              customer.lastname lastname 
                              FROM property_sold 
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id 
                              WHERE property_sold.deleted = 0";

                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) {                             
                             while($row = mysqli_fetch_assoc($result)) {
                              $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              $id  = $row['id'];
                              echo '<option value="'.$name.'">';
                             }
                          }
                      ?>           
                  </datalist>   
                  <span class="btn btn-primary" onclick="getProperty()"> Select</span>
                <?php } ?>
              </div>            
                <div id="property_select" class="form-group">
                  <label>Property: </label> 
                  <select class="custom-select radio-inline" name="property_id" >
                      <?php
                      $customer_id = $_SESSION['user_id'];
                        $sql = "SELECT 
                                property_name,
                                city,
                                property.id id,
                                address 
                                FROM property_sold 
                                INNER JOIN property 
                                ON property_sold.property_id = property.id
                                WHERE property_sold.deleted = 0 
                                AND property_sold.customer_id = '$customer_id'";
                                
                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) { 
                             while($row = mysqli_fetch_assoc($result)) {

                              $property = $row['property_name'].' - '.$row['address'].' '.$row['city'];
                              $id  = $row['id'];
                              echo '<option value="'.$id.'">'.$property.'</option>';

                             }
                          }
                      ?>                    
                  </select>

                </div>
                <div class="form-group">   
                  <label>Contact Number of the [Tenant,Agent,Landlord]</label>
                  <input type="number" name="contact_number" class="form-control">
                </div> 
                <div class="form-group">   
                  <label>Request Date:</label>
                  <input class="form-control" data-date-format="yyyy-mm-dd" id="datepicker" name="request_date" >
                </div>

                <input type="hidden" name="property_access_by" value="0">
                <!--  
                <div class="form-group">   
                  <label>Property Access By:</label>
                  <label class="form-control" style="border: none;">
                    <input id="forSale" type="radio" name="property_access_by" value="0" checked> Tenant
                  </label>
                  <label class="form-control" style="border: none;">
                    <input id="forRent" type="radio" name="property_access_by"  value="1"> Agent
                  </label>
                   <label class="form-control" style="border: none;">
                    <input id="forLease" type="radio" name="property_access_by"  value="2"> Landlord
                  </label>
                </div>
                -->
                <div class="form-group">   
                  <label>Repair Request</label>
                  <textarea name="repair_request" class="form-control"></textarea>
                </div>           
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" value="Submit Request">
                </div>
              </div>
    
            </div>
          </div>
        </div>
      </form>
      </div><!--row -->
    </div>
</div>

<?php

	include '../template/footer.php';
?>
<script type="text/javascript">

  function getProperty(){
    var cname = $('#maintenanceCustomer').val();
    /*
    cname = 's';
  //alert(cname); pangit ni mas nindot ang nasa baba
    $('#property_select').load('../snippet/maintenance-request-api.php?name=' + cname,function(){           
              
      });  
      */
      $.get("../snippet/maintenance-request-api.php?name="+cname, function (data) {
  
        $("#property_select").html(data);
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
    $(".menu-maintenance-request").addClass("active");
});

</script>