<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
?>

  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Property</a>
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
                        property.id pid,
                        `client_id`, 
                        `property_relation`,
                        `date_management_commence`, 
                        `property_name`,
                        `address`, 
                        block,
                        lot,
                        `city`,
                        `postal_code`, 
                        `property_size`, 
                        `subject_to`,
                        price_per_sqm,
                        `price`,
                        size_unit,
                        availability,
                        `payment_mode`, 
                        `monthly_payment`,
                        `property_type`,
                        `caretaker`, 
                        `additional_info`,
                         firstname,
                         middlename,
                         lastname,
                         property_condition,
                         price_bought,
                         property.image_path image_path
                        FROM `property` 
                        INNER JOIN client ON
                        property.client_id = client.id 
                        WHERE property.deleted = 0 
                        ORDER BY property.id DESC";

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
                         // $image_path = getPropertyImage($id,$mysqli);previous image_path
                          $image_path = $row['image_path'];
                          $monthly_payment = $row['monthly_payment'];
                          $availability = convertAvailability($row['availability']);
                          $block = $row['block'];
                          $lot = $row['lot'];
                          $price_per_sqm = number_format($row['price_per_sqm']);

                          $monthly_payment        = number_format($monthly_payment);

                          if($x == 0){
                            echo '<tr style="width: 100%;">';
                            $x = 1;
                          }else{
                            echo '<tr style="width: 100%;" class="odd-bg">';
                            $x = 0;
                          }
                          if($monthly_payment == 0){
                            $monthly_payment = 'Not applicable';
                          }

                          
                          echo ' <td style="width: 10%;">';
                         
                          if($image_path != "no-image-land.png"){
                            echo '<img src="../uploads/'.$image_path.'" style="width: 150px; height: 140px;">';
                          }else{
                            echo '<img src="../system-images/no-image-land.png" style="width: 150px; height: 140px;">';
                          }
                          echo '</td> ';
                          echo '<td style="width: 40%;">';
                          echo ' <span>Property Name: </span> <span>'.$row['property_name'].'</span><br>';
                          echo ' <span>In charge: </span> <span>'.$name.'</span><br>';
                          echo ' <span>Relation on the property: </span> <span class="box-owner">'.$relation.'</span><br>';
                          echo ' <span>Commencement Date: </span> <span>'.$row['date_management_commence'].'</span><br>';
                          if($block == 0 && $lot != 0){
                            echo ' <span>Address: </span> <span> '.' lot '.$lot.' ,'.$row['address'].' </span><br>';
                          }else if($lot == 0 && $block != 0){
                            echo ' <span>Address: </span> <span> block '.$block.' ,'.$row['address'].' </span><br>';  
                          }else if($block == 0 && $lot == 0){
                            echo ' <span>Address: </span> <span> '.$row['address'].' </span><br>';  
                          }
                          else{
                            echo ' <span>Address: </span> <span> block '.$block.' lot '.$lot.' ,'.$row['address'].' </span><br>';  
                          }
                          

                          echo ' <span>City: </span> <span>'.$row['city'].' | </span> '.$availability.'<br>';
                          echo "</td>";

                          echo '<td style="width: 40%;">';
                          echo ' <span>Property Size: </span> <span>'.$row['property_size'].'</span><span> '.$size_unit.'</span><br>';
                          echo ' <span>Subject To: </span> <span>'.$subject_to.'</span><br>';
                          echo ' <span>Payable: </span> <span>'.$payable.'</span><br>';
                          echo ' Price per Sq.m:<span style="color:#1410e0;"> ₱'.$price_per_sqm.'.00</span> <span>Monthly Payment: </span> <span class="monthly">₱ '. $monthly_payment .'</span><br>';
                          echo ' <span>Property Type: </span> <span>'.$property_type.'</span><br>';
                          echo ' <span>Retail Price: </span> <span class="price price2">₱ '.number_format($row['price']).'</span>';
                           echo ' <span>Bought Price: </span> <span class="price ">₱ '.number_format($row['price_bought']).'</span><br>';
                          echo "</td>";

                          echo '<td style="width: 5%;">';
                          echo '<a target="_blank" href="../pages/legal-document.php?id='.$id.'" class="toolproperty btn btn-primary view" title="View Attachment" style="color:#fff;"><i class="fas fa-eye"></i> <i class="fas fa-file-signature"></i> </a><br>';

                          echo '<button class="toolproperty btn btn-primary" title="Edit Property" onclick="showPropertyModal('.$id.');"><i class="far fa-edit"></i> </button><br>';

                          echo ' <button class="toolproperty btn btn-danger" title="Delete Property" onclick="deleteProperty('.$id.')"> <i class="fa fa-trash" aria-hidden="true"></i> </button>';
                           if($row['availability'] == 1){
                             echo '<button class="btn btn-warning" title="Switch to Available" onclick="switchToAvailable('.$id.');"><i class="fas fa-toggle-on"></i>  </button>';
                           }                          
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
 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

<script type="text/javascript">

  function switchToAvailable(id){
      var id = id;            
      var table = "property";
      
      $('#tableIdSW').val(id);
      $('#dbtableSW').val(table);      
      $('#confirmSwitch').modal({show:true}); 
     
  }

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
    $(".menu-records-documents").addClass("active");
});
  
</script>