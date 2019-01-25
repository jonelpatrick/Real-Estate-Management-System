<?php
	include '../template/header.php';

  define("UPLOAD_DIR", "../record-documents/");

?>

  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Sales & Property
        </li>
        <li class="breadcrumb-item active">
        <a href="property-sold.php">Property Sold</a></li>
      </ol>    


       <div class="row">        

         <div class="col-lg-12">
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-outdent myiconcolor"></i>
             Property Sold</div>                           
            <div class="card-body">
             
               <div class="table-responsive">
                <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                   <tr></tr>
                  </thead>
                  <tfoot>
                 
                  </tfoot>
                  <tbody class="table-body">
                    <?php 
                      $sql = "SELECT 
                              property_sold.id id,
                              property.property_name property_name,
                              property.property_size property_size,                              
                              property.address address,
                              property.city city,
                              property.property_condition property_condition,
                              property.subject_to subject_to,
                              property.date_management_commence date_management_commence,
                              property.image_path image_path,
                              size_unit,
                              property.block block,
                              property.lot lot,
                              customer.firstname fname,
                              customer.middlename mname,
                              customer.lastname lname,
                              property.price_per_sqm price_per_sqm,
                              property_sold.total_amount price,
                              property_sold.date_added date_added,
                              property_sold.terms_of_payment terms,
                              employee.firstname efname,
                              employee.middlename emname,
                              employee.lastname elname
                              FROM property_sold
                              INNER JOIN property 
                              ON property_sold.property_id = property.id
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id
                              INNER JOIN employee 
                              ON property_sold.transacted_by = employee.id
                              WHERE property_sold.deleted = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x=0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $property_name = $row['property_name'];
                          $property_size = $row['property_size'];
                          $price_per_sqm = number_format($row['price_per_sqm']);
                          $price         = number_format($row['price']);
                          $date_added    = $row['date_added'];
                          $employee      = $row['efname'].' '.$row['emname'].' '.$row['elname'];

                          $block = $row['block'];
                          $lot = $row['lot']; 
                          $name = $row['fname'].' '.$row['mname'].' '.$row['lname'];                        
                          
                          if($block == 0 && $lot != 0){
                            $address = ' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                          }else if($lot == 0 && $block != 0){
                             $address = ' Block '.$block.' '.$row['address'].' '.$row['city'];
                          }else if($block == 0 && $lot == 0){
                             $address = $row['address'].' '.$row['city'];  
                          }
                          else{
                              $address = ' Block '.$block.' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                          }

                          $subject_to = subjectTo($row['subject_to']);
                          $date_commence = $row['date_management_commence'];
                          $property_condition = $row['property_condition'];
                          $image_path = $row['image_path'];
                          $size_unit = $row['size_unit'];
                          $terms = $row['terms'];

                          if($size_unit == 0){
                            $size_unit = 'square meter';
                          }else{
                            $size_unit = 'Hectare';
                          }
                          
                          if($x == 0){
                            echo '<tr style="width: 100%;">';
                            $x = 1;
                          }else{
                            echo '<tr style="width: 100%;" class="odd-bg">';
                            $x = 0;
                          }  
                          if($property_condition == 0){
                            $property_condition = "Good Condition";
                          }else if($property_condition == 1){
                            $property_condition = "Bad Condition";                            
                          }else{
                            $property_condition = "Repaired Condition";                            
                          }

                          echo '<td width="100px;">';   
                          if($image_path == 'no-image-land.png'){
                             echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                          } else{
                             echo '<img src="../uploads/'.$image_path.'" style="width: 100px; height: 100px;"></td> ';
                          }              
                         
                          echo '<td width="30%">';
                          echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                          echo '<span class="small text-muted">Property Size: </span> '.$property_size.' '.$size_unit.'<br>';
                          echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';                          
                        //  echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                          echo '<span class="Lease" style="margin-right:1em;"> Sold </span>  to '.$name.'<br>';
                          echo '<hr>';
                          echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                         //echo '<button class="toolproperty btn btn-primary view tracking"><i class="fas fa-eye"></i> </button><br>';
                          echo '</td>';
                          echo '<td >';
                          echo '<span> Price per sq.m: ₱ '.$price_per_sqm.'.00</span><br>';
                          echo '<span> Bought Price : ₱ '.$price.'.00</span><br>';
                          echo '<span> Date Sold : '.$date_added.' </span><br>';
                          echo '<span> Terms : '.$terms.' years </span><br>';
                          echo '<span> Transacted by : '.$employee.' </span><br>';
                          echo '</td>';

                          echo "</tr>";
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
<script type="text/javascript" src="../lib/canvasjs.min.js"></script>
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
    $(".menu-property-sold").addClass("active");
     $(".menu-sales-property").addClass("active");
});
</script>