<?php
	include '../template/header.php';
  define("UPLOAD_DIR", "../record-documents/");

?>
<script>
window.onload = function () {


var chart = new CanvasJS.Chart("chartContainer", {
  exportEnabled: true,
  title :{
    text: "Property Sold"
  },
  axisY: {
    includeZero: false,
    minimum: 0,
    maximum: 100
  },
  data: [{
    type: "spline",
    markerSize: 0,
    dataPoints: [
      { label: "JAN", y: 10 },
      { label: "FEB", y: 63 },
      { label: "MAR", y: 54 },
      { label: "APR", y: 76 },
      { label: "MAY", y: 76 },
      { label: "JUN", y: 84 },
      { label: "JUL", y: 22 },
      { label: "AUG", y: 35 },
      { label: "SEP", y: 46 },
      { label: "OCT", y: 87 },
      { label: "NOV", y: 90 },
      { label: "DEC", y: 81 }
    ]
  }]
});


//var xVal = 0;
//var yVal = 100;
var updateInterval = 1000;
var dataLength = 50; // number of dataPoints visible at any point
var labels = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
function updateChart() {
  var boilerColor, deltaY, yVal;
  var dps = chart.options.data[0].dataPoints;
  for (var i = 0; i < dps.length; i++) {
    deltaY = Math.round(2 + Math.random() *(-2-2));
    yVal = deltaY + dps[i].y > 0 ? dps[i].y + deltaY : 0;
    boilerColor = yVal > 200 ? "#FF2500" : yVal >= 170 ? "#FF6000" : yVal < 170 ? "#6B8E23 " : null;
    
    dps[i] = {label: labels[i], y: yVal};
  }
  chart.options.data[0].dataPoints = dps; 
  chart.render();
};

updateChart(dataLength); 
setInterval(function(){ updateChart() }, updateInterval); 

function explodePie (e) {
  if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  } else {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  }
  e.chart2.render();

}

var chart2 = new CanvasJS.Chart("chartContainer2", {
  exportEnabled: true,
  animationEnabled: true,
  title:{
    text: "Total Property"
  },
  legend:{
    cursor: "pointer",
    itemclick: explodePie
  },
  data: [{
    type: "pie",
    showInLegend: true,
    toolTipContent: "{name}: <strong>{y}%</strong>",
    indexLabel: "{name} - {y}%",
    dataPoints: [
      { y: 30, name: "For Sale", exploded: true },
      { y: 65, name: "For Rent" },
      { y: 5, name: "For Lease" }   
    ]
  }]
});
chart2.render();

}

</script>


  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Records & Documents
        </li>
        <li class="breadcrumb-item active">
        <a href="legal-documents.php">Legal Documents</a></li>
      </ol>    

       <div class="row">
         <div class="col-lg-6">
            <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
           <i class="fas fa-sign-in-alt myiconcolor"></i>
             Available Property</div>
            <div id="chartContainer2" style="height: 370px; width: 450px; margin: 0px auto;"></div>
            <span class="trial"></span>
            <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <span class="small text-muted">Total no. of Property: 200</span><br>
                <span class="small text-muted">Property in Good condition: 50</span>  
              </div>
              <div class="col-sm-6">
                <span class="small text-muted">property in Bad condition: 116</span><br>
              <span class="small text-muted">Property in Repaired condition: 54</span>
              </div>
            </div>
            <hr/>
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
                              date_management_commence FROM property WHERE deleted = 0 AND availability = 0";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x=0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $property_name = $row['property_name'];
                          $property_size = $row['property_size'];
                          
                          $address = $row['address'];
                          $subject_to = subjectTo($row['subject_to']);
                          $date_commence = $row['date_management_commence'];
                          $property_condition = $row['property_condition'];
                          
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
                          echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                          echo '<td>';
                          echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                          echo '<span class="small text-muted">Property Size: </span> '.$property_size.'<br>';
                          echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';
                          echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                          echo '<span class="'.$subject_to.'">'.$subject_to.'</span><br>';
                          echo '<hr>';
                          echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                          echo '<button class="toolproperty btn btn-primary view tracking"><i class="fas fa-eye"></i> </button><br>';
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
              <div id="chartContainer" style="height: 370px;width:476px; margin: 0px auto;"></div>             
              <span class="trial"></span>
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-6">
                    <span class="small text-muted">Total no. of Property: 40</span><br>
                    <span class="small text-muted">Property in Good condition: 12</span>  
                  </div>
                  <div class="col-sm-6">
                    <span class="small text-muted">property in Bad condition: 18</span><br>
                  <span class="small text-muted">Property in Repaired condition: 10</span>
                  </div>
                </div>
                <hr>
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
                              date_management_commence FROM property WHERE deleted = 0 AND availability = 1";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         $x=0;
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $property_name = $row['property_name'];
                          $property_size = $row['property_size'];
                          
                          $address = $row['address'];
                          $subject_to = subjectTo($row['subject_to']);
                          $date_commence = $row['date_management_commence'];
                          $property_condition = $row['property_condition'];
                          
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
                          echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                          echo '<td>';
                          echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                          echo '<span class="small text-muted">Property Size: </span> '.$property_size.'<br>';
                          echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';
                          echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                          echo '<span class="Lease"> Sold </span><br>';
                          echo '<hr>';
                          echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                         echo '<button class="toolproperty btn btn-primary view tracking"><i class="fas fa-eye"></i> </button><br>';
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
      
 <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
<script src="../lib/canvasjs.min.js"></script>
<?php

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
include '../template/footer.php';

?>