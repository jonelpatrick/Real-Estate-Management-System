<?php
	include '../template/header.php';
    include '../cli/global-functions.php';

    $customer_id = $_SESSION['user_id'];
?>

  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="property-list.php">Property</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
             <i class="fas fa-map"></i>
              List of Property</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-property" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     </tr>
                  </thead>
                  <tfoot>
                 
                  </tfoot>
                  <tbody>
                  <?php
                  //availability true = sold
                     $sql = "SELECT 
                        property_sold.id pid,                        
                        `property_relation`,
                        `date_management_commence`, 
                        `property_name`,
                        `address`, 
                        `city`,
                        `postal_code`, 
                        `property_size`, 
                        `subject_to`,
                        `price`,
                        size_unit,
                        availability,
                        `payment_mode`, 
                        property_sold.monthly_payment pmonth,
                        `property_type`,
                        `caretaker`, 
                        `additional_info`,
                         firstname,
                         middlename,
                         lastname,                         
                         property_condition,
                         property.image_path image_path
                        FROM property_sold
                        INNER JOIN customer 
                        ON property_sold.customer_id = customer.id 
                        INNER JOIN property 
                        ON property_sold.property_id = property.id
                        WHERE property_sold.deleted = 0
                        AND customer_id = '$customer_id'";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x =0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['pid'];
                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $payable = payable($row['payment_mode']);
                          $property_type = propertyType($row['property_type']);
                          $subject_to = subjectTo($row['subject_to']);
                          $relation = relation($row['property_relation']);
                          $size_unit = sizeUnit($row['size_unit']);
                          //$image_path = getPropertyImage($id,$mysqli);
                          $image_path = $row['image_path'];
                          
                          $availability = convertAvailability($row['availability']);

                          if($x == 0){
                            echo '<tr style="width: 100%;">';
                            $x = 1;
                          }else{
                            echo '<tr style="width: 100%;" class="odd-bg">';
                            $x = 0;
                          }
                          
                          echo ' <td style="width: 10%;">';
                          if($image_path != ""){
                            echo '<img src="../uploads/'.$image_path.'" style="width: 150px; height: 140px;">';
                          }else{
                            echo '<img src="../system-images/no-image-land.png" style="width: 150px; height: 140px;">';
                          }
                          echo '</td> ';
                          echo '<td style="width: 40%;">';
                          echo ' <span>Property Name: </span> <span>'.$row['property_name'].'</span><br>';
                          echo ' <span>Property assigned: </span> <span>'.$name.'</span><br>';
                          echo ' <span>Relation on the property: </span> <span class="box-owner"> bought </span><br>';
                          echo ' <span>Commencement Date: </span> <span>'.$row['date_management_commence'].'</span><br>';
                          echo ' <span>Address: </span> <span>'.$row['address'].'</span><br>';
                          echo ' <span>City: </span> <span>'.$row['city'].'';
                          echo "</td>";

                          echo '<td style="width: 40%;">';
                          echo ' <span>Property Size: </span> <span>'.$row['property_size'].'</span><span> '.$size_unit.'</span><br>';                          
                          echo ' <span>Payable: </span> <span>'.$payable.'</span><br>';
                          echo ' <span>Monthly Payment: </span> <span class="monthly">'.$row['pmonth'].'.00 </span><br>';
                          echo ' <span>Property Type: </span> <span>'.$property_type.'</span><br>';
                          echo ' <span>Price: </span> <span class="price price2">'.$row['price'].'</span><br>';
                          echo "</td>";

                          echo '<td style="width: 5%;">';
                         
                          echo "</td>";
                          echo "</tr>";
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
<div class="modal fade" id="updateProperty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px;">
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Update Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="property-body">
        <div class="modal-body">
    
         
        </div>
    </div>
  </div>
  </div>
</div>

<script type="text/javascript">

  function showPropertyModal(id){    
      var id = id;            
      $('.property-body').load('../snippet/property-modal-edit.php?id=' + id,function(){           
          $('#updateProperty').modal({show:true}); 
         
      });                    
  }
  function deleteProperty(id){    
      var id = id;            
      var table = "property";
      var redirect = '../pages/property.php';
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }


 
</script>

<?php

function payable($payable){
  $payable = $payable;

  switch ($payable) {
    case 0:
      $payable = "One Time Payment";    
      break;
    case 1:
      $payable = "1 year";    
      break;
    case 2:
      $payable = "2 years";    
      break;
    case 3:
      $payable = "3 years";    
      break;
    case 4:
      $payable = "4 years";    
      break;
    case 5:
      $payable = "5 years";    
      break;
    case 6:
      $payable = "6 years";    
      break;
    case 7:
      $payable = "7 years";    
      break;
    case 8:
      $payable = "8 years";    
      break;       
    case 9:
      $payable = "9 years";    
      break; 
    case 10:
      $payable = "10 years";    
      break; 

    default:
      $payable = "Something went wrong";
      break;
  }
  return $payable;
}

function propertyType($type){
  $type = $type;

    switch ($type) {

      case 0:
        $type = "Vacant Land";
        break;

      case 1:
        $type = "Residential Land";
        break;

      case 2:
        $type = "Commercial Land";
        break;  

      default:
        $type = "Something went wrong";
        break;
    }

    return $type;

}

function subjectTo($var){

   $var = $var;

    switch ($var) {

      case 0:
        $var = "For Sale";
        break;

      case 1:
        $var = "For Rent";
        break;

      case 2:
        $var = "For Lease";
        break;  

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}

function relation($var){

   $var = $var;

    switch ($var) {

      case 0:
        $var = "Owner";
        break;

      case 1:
        $var = "Board Member";
        break;

      case 2:
        $var = "Developer";
        break;  

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}

function sizeUnit($var){
   $var = $var;

    switch ($var) {

      case 0:
        $var = "Square meter";
        break;

      case 1:
        $var = "Hectare";
        break;

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}

include '../template/footer.php';

?>
<script type="text/javascript">
    $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-property-list").addClass("active");
});
</script>