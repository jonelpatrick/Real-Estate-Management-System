<?php
	include '../template/header.php';

  define("UPLOAD_DIR", "../record-documents/");

 

?>

<style type="text/css">
	.btn-sale{
		    text-transform: uppercase;
    	
	}
	.tracking-table:hover{
		background:#82e2ec;
		cursor: pointer;
	}
 
</style>
  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Tracking Sheet
        </li>
        <li class="breadcrumb-item active">
        <a href="legal-documents.php">Property Tracking</a></li>
      </ol>    
    
    
       <div class="row">
         <div class="col-lg-12">
         	<h2 class="text-center" style="margin: 1em 0;">Available Properties for <span class="btn-sale">sale</span></h2>
            <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
           <i class="fas fa-sign-in-alt myiconcolor"></i>
             Remaining Property</div>            
            <div class="card-body">                        

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Property Name</th>
                      <th>Location</th>
                      <th>Land Size</th>
                     <th>Size Unit</th>
                      <th>Price(sq.m)</th>
                      <th>Orig. Price</th>
                      <th>Current Price</th>
                      <th>Date Commenced</th>                      
                    </tr>
                  </thead>
                  <tfoot>
                 
                  </tfoot>
                  <tbody>
                  <?php
                     $sql = "SELECT 
                              id,
                              property_name,
                              property_size,                              
                              address,
                              city,
                              property_condition,
                              subject_to,
                              date_management_commence,
                              image_path,
                              size_unit,
                              price_bought,
                              price,
                              price_per_sqm,
                              block,
                              lot
                              FROM property 
                              WHERE deleted = 0 
                              AND availability = 0";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                         $block = $row['block'];
                         $lot = $row['lot'];
                          if($block == 0){
                          	$block = "";
                          }else{
                          	$block = "Block ".$block;
                          }
                          if($lot == 0){
                          	$lot = "";
                          }else{
                          	$lot = "Lot ".$lot;
                          }
                          $name 	= $row['property_name'];
                          $size 	= $row['property_size'];
                          $address 	= $block.' '.$lot.' '.$row['address'].' '.$row['city'];
                          $unit 	= $row['size_unit'];
                          $origPrice = number_format($row['price_bought']);
                          $price 	= number_format($row['price']);
                          $pricePerSqm = number_format($row['price_per_sqm']);
 						  $date_commence = $row['date_management_commence'];	
                          $id = $row["id"];

                          if($unit == 0){
                          	$unit = "sq.m";
                          }else{
                          	$unit = "hectare";
                          }

                          echo '<tr class="tracking-table" onclick="showDetails('.$id.');">';
                          echo '<td>'.$name.'</td>';
                          echo '<td>'.$address.'</td>';
                          echo '<td>'.$size.'</td>';
                          echo '<td>'.$unit.'</td>';
                          echo '<td>₱ '.$pricePerSqm.'</td>';
                          echo '<td>₱ '.$origPrice.'</td>';
                          echo '<td>₱ '.$price.'</td>';
                          echo '<td>'.$date_commence.'</td>';
                          echo '</tr>';

                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>

            </div>
           
          </div>
         </div>

  
       </div>
    </div>
</div>


<!-- modal -->
<div class="modal fade" id="propertyDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px;margin-top: 5%;">
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Property Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">

     
    </div>
  </div>
  </div>
</div>


<?php

function subjectTo($var){

   $var = $var;

    switch ($var) {

      case 0:
        $var = "Available";
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
include '../template/footer.php';

?>
<script type="text/javascript">
$(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-tracking-sheet").addClass("active");
});

function showDetails(id){
	
 	$('.modal-body').load('../snippet/property-detail-modal.php?id=' + id,function(){           
      $('#propertyDetails').modal({show:true}); 
     
  	});   
}
</script>