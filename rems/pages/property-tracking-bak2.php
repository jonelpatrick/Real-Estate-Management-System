<?php
	include '../template/header.php';

  define("UPLOAD_DIR", "../record-documents/");

 //initialize hidden value
  $sql = "SELECT COUNT( * ) available
      FROM  `property` 
      WHERE availability = 0 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $remaining = $row['available'];
       }
   }

   $sql = "SELECT COUNT( * ) sold
       FROM  `property_sold` 
       WHERE deleted = 0 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $sold = $row['sold'];
       }
   }

?>
<script type="text/javascript">
window.onload = function () {
  //var value1 = Number(document.getElementById('inputSold').value);//sold
  //var value2 = Number(document.getElementById('inputRemaining').value);//remaining
  var value1 = Number(<?php echo $sold; ?>);
  var value2 = Number(<?php echo $remaining; ?>);

  var chart = new CanvasJS.Chart("chartContainer",

{
  title:{
    text: "Property Tracking & Monitoring",
  },
  data: [
  {
    type: "pie",
    showInLegend: true,
    legendText: "{label}",
        indexLabel: "{label} : {y}",
        indexLabelFontColor: "black",
    dataPoints: [
      {  y: value1,  label: "Sold"  },
      {  y: value2,  label: "Remaining"  }
            
    ]
  }
  ]
});
chart.render();
function dataPointChanged() {

  var value1 = Number(document.getElementById('inputSold').value);//sold
  var value2 = Number(document.getElementById('inputRemaining').value);//remaining
      
    chart.options.data[0].dataPoints[0].y = value1;   // sold
    chart.options.data[0].dataPoints[1].y = value2;  //remaining
    chart.render();

    document.getElementById('inputRemaining').value = value1;
}

//dynamic call of value
function checkNewValue(){    
          
    $('#dynamicValue').load('../snippet/tracking-dynmic-chart.php',function(){                            
    });                    
}
/*
var button = document.getElementById( "button" );
button.addEventListener( "click",  dataPointChanged);
*/
setInterval(function(){dataPointChanged()}, 2000);
setInterval(function(){checkNewValue()}, 1000);
}

</script>

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
      <!--hidden value -->
       <div id="dynamicValue">
        <input type="hidden" id="inputRemaining" value="">
        <input type="hidden" id="inputSold" value="">
      </div>
      <!--hidden value -->
      <div class="row" style="margin-bottom: 2em;">
        <div class="col-lg-12">
          
          <div id="chartContainer" style="height: 420px; max-width: 1000px; margin: 0px auto;"></div>          
        </div>
      </div>
      <hr>
      <div class="row"> <span class="trial"></span></div>
       <div class="row">
         <div class="col-lg-6">
            <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
           <i class="fas fa-sign-in-alt myiconcolor"></i>
             Remaining Property</div>            
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
                              block,
                              lot
                              FROM property 
                              WHERE deleted = 0 AND availability = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x=0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $property_name = $row['property_name'];
                          $property_size = $row['property_size'];
                          $block = $row['block'];
                          $lot = $row['lot'];                        
                          
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

                          echo '<td>';   
                          if($image_path == "no-image-land.png"){
                             echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                          }else{
                             echo '<img src="../uploads/'.$image_path.'" style="width: 100px; height: 100px;"></td> ';
                          }
                         
                          echo '<td>';
                          echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                          echo '<span class="small text-muted">Property Size: </span> '.$property_size.' '.$size_unit.'<br>';
                          echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';
                         
                          //echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                          echo '<span class="'.$subject_to.'">'.$subject_to.'</span><br>';
                          echo '<hr>';
                          echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                        //  echo '<button class="toolproperty btn btn-primary view tracking"><i class="fas fa-eye"></i> </button><br>';
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

         <div class="col-lg-6">
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
                              customer.lastname lname
                              FROM property_sold
                              INNER JOIN property 
                              ON property_sold.property_id = property.id
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id
                              WHERE property_sold.deleted = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x=0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $property_name = $row['property_name'];
                          $property_size = $row['property_size'];

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

                          echo '<td>';   
                          if($image_path == 'no-image-land.png'){
                             echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                          } else{
                             echo '<img src="../uploads/'.$image_path.'" style="width: 100px; height: 100px;"></td> ';
                          }              
                         
                          echo '<td>';
                          echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                          echo '<span class="small text-muted">Property Size: </span> '.$property_size.' '.$size_unit.'<br>';
                          echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';                          
                        //  echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                          echo '<span class="Lease" style="margin-right:1em;"> Sold </span>  to '.$name.'<br>';
                          echo '<hr>';
                          echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                         //echo '<button class="toolproperty btn btn-primary view tracking"><i class="fas fa-eye"></i> </button><br>';
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
    $(".menu-tracking-sheet").addClass("active");
});
</script>