<?php
	include '../template/header.php';

  if(isset($_GET['year'])){
    $current_year = $_GET['year'];
  }else{
    $current_year = date("Y");  
  }
  
  $year = array(2015,2016,2017,2018,2019,2020,2021,2022,2023,2024);

$current_revenue = 0 ;
$current_interest = 0;
$current_liabilities = 0;
$current_net_profit = 0;


//interest
$sql = "SELECT price_bought,price FROM property WHERE deleted = 0 and date_management_commence LIKE '".$current_year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_interest = 0;
$num = 0;
if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

      $bought = $row['price_bought'];
      $price = $row['price'];
      $num += ($price - $bought);
      $total_interest += $num/12;
      }
}
$current_interest = round($total_interest);

//liabilities
$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$current_year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

      $liabilites = $row['liabilities'];
      $total_liabilites += ($liabilites * 12);
      }
}
$current_liabilities = $total_liabilites;

//net profit

$net_profit = 0;

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$current_year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

      $revenue = $row['revenue'];
      $total_revenue += ($revenue * 12);
      }
}

$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$current_year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

      $liabilites = $row['liabilities'];
      $total_liabilites += ($liabilites * 12);
      }
}

$net_profit =  $total_revenue - $total_liabilites ;

$current_net_profit = $net_profit;
if($total_liabilites > $total_revenue){
  $changeColor = 'changeColorRed';
}else{
  $changeColor = 'changeColorBlack';
}
//revenue

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$current_year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

      $revenue = $row['revenue'];
      $total_revenue += ($revenue * 12);
      }
}
$current_revenue = $total_revenue;


//initialize value of graph
  $revenue     = $current_revenue;
  $netProfit   = $current_net_profit;
  $interest    = $current_interest;
  $liabilities = $current_liabilities;

?>
<style type="text/css">
  .report-header{
    margin-bottom: 3em;
    text-align: center;
  }
  .inline{
   display: inline-block;
  }
  .card-header{
    background: #0077c0;
    color: #fff;
  }
  tr,td,th{
    font-size: 14px;
  }
  .font-value{
    font-family: inherit;
    font-size: 30px;
  }
  .form-group{
    text-align: center;
  }
  .changeColorRed{
    color: red;
  }
  .changeColorBlack{
    color: black;
  }
  .bgdevider{
    height: 20px;
    margin-bottom: 1em;
    background: #f3ae47f2;
    margin-left: 1em;    
    max-width: 97%;
  }
  .sub-header{
    padding-top: 1em;
    background: #e0e9ef;
    margin-bottom: 1em;
    padding-left: 1em;
  }
  .trial{
    background: #fff;
    /* z-index: 2; */
    margin-top: -9px;
  }
</style>
<script>
window.onload = function () {

var value1 = Number(<?php echo $revenue; ?>);
var value2 = Number(<?php echo $netProfit; ?>);
var value3 = Number(<?php echo $interest; ?>);
var value4 = Number(<?php echo $liabilities; ?>);

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Annual Bar Graph Report"
  },
  axisY: {
    title: ""
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "white",
    legendText: "Realtime Graph Financial",
    dataPoints: [      
      { y: value1, label: "REVENUE" },
      { y: value2,  label: "NET PROFIT" },
      { y: value3,  label: "INTEREST" },
      { y: value4,  label: "LIABILITIES" }
      
    ]
  }]
});
chart.render();

function dataPointChanged() {

  var value1 = Number(document.getElementById('inputRevenue').value);//revenue
  var value2 = Number(document.getElementById('inputNetProfit').value);//net profit
  var value3 = Number(document.getElementById('inputInterest').value);//interest
  var value4 = Number(document.getElementById('inputLiabilities').value);//liabilities
      
  chart.options.data[0].dataPoints[0].y = value1;   // revenue
  chart.options.data[0].dataPoints[1].y = value2;  //net profit
  chart.options.data[0].dataPoints[2].y = value3;   // interest
  chart.options.data[0].dataPoints[3].y = value4;   // liabilities
  chart.render();
}

//dynamic call of value
function checkNewValue(){    
     var current_year = '<?php echo $current_year; ?>';     
    $('#dynamicValue').load('../snippet/report-dynamic-chart.php?year=' + current_year,function(){                            
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
          <a href="financial-report.php">Financial Report</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
       <!--hidden value -->
       <div id="dynamicValue">
        <input type="hidden" id="inputRevenue" value="">
        <input type="hidden" id="inputNetProfit" value="">
        <input type="hidden" id="inputInterest" value="">
        <input type="hidden" id="inputLiabilities" value="">
      </div>
      <!--hidden value -->
      
      <div class="row">
        <div class="col-sm-12">
           <div class="report-header">
            <h3 style="color: #0077c0;">ANNUAL FINANCIAL REPORT</h3>
            <img src="../system-images/realty-logo.png" style="width: 300px;">
          </div>
         <div class="sub-header">
          <div class="inline">
            <p class="text-muted medium">Filters data yearly</p>  
          </div>
           <div class="inline" style="margin-left: 20px;">
              <select class="form-control" id="selectYear" onchange="selectYearDate()">
              <?php
                foreach ($year as $key => $value) {
                  if($current_year == $value){
                    echo '<option value="'.$value.'" selected>'.$value.'</option>';
                  }else{
                    echo '<option value="'.$value.'">'.$value.'</option>';
                  }
                  
                }
              ?>                
              </select>
           </div>
          </div>
          <div class="row" style="margin: 0 auto;">
            <div id="chartContainer" style="height: 450px; width: 100%;"></div>
          </div>
         
          <div class="row" >
           <div class="trial">
            
          </div>
            <div class="col-sm-12 bgdevider">
              
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
                <div class="card mb-3">
                    <div class="card-header text-center">
                      
                      REVENUE</div>

                    <div class="card-body">
                       <div class="form-group">
                          <div id="revenue">                          
                            <label >
                              <span  class="font-value" id="revenueText"></span>
                              <hr>
                            </label>
                          </div>
                        </div>
                    
                    </div>
                    
                  </div>  
            </div>
            <div class="col-sm-3">
                  <div class="card mb-3">
                    <div class="card-header text-center">
                      
                      NET PROFIT</div>

                    <div class="card-body">
                      <div class="form-group">
                          <div id="netProfit">                          
                            <label >
                              <span  class="font-value" id="netProfitText"></span>
                              <hr>
                            </label>
                          </div>
                        </div>
                    
                    </div>
                    
                  </div>  
            </div>
            <div class="col-sm-3">
                  <div class="card mb-3">
                    <div class="card-header text-center">
                      
                      INTEREST</div>

                    <div class="card-body">
                     <div class="form-group">
                          <div id="interest">                          
                            <label >
                              <span  class="font-value" id="interestText"></span>
                              <hr>
                            </label>
                          </div>
                        </div>
                    
                    
                    </div>
                    
                  </div>  
            </div>
            <div class="col-sm-3">
                  <div class="card mb-3">
                    <div class="card-header text-center">
                      
                      LIABILITIES</div>

                    <div class="card-body">
                     <div class="form-group">
                          <div id="liabilities">                          
                            <label >
                              <span  class="font-value" id="liabilitiesText"></span>
                              <hr>
                            </label>
                          </div>
                        </div>
                    
                    </div>
                    
                  </div>  
            </div>
          </div>   

          <hr>
          <div class="text-center">
            <p  class="text-muted small">The information displayed is only for the year of <?php echo $current_year; ?></p>
          </div>
          <hr>  

          <!-- TAble --> 
          <div id="tableMetric" class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>METRIC</th>
                      <th>REPORT YEAR (YEAR)</th>
                      <th>PREVIOUS YEAR</th>
                      <th>CHANGE [DIFF]</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>REVENUE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>NET PROFIT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>INTEREST</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>LIABILITIES</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  
                  </tbody>
                </table>
              </div>

        </div>
         
      </div>
    </div>
</div>


<script type="text/javascript">

setInterval(function(){changeRevenue()}, 1000);
setInterval(function(){changeNetProfit()}, 1000);
setInterval(function(){changeInterest()}, 1000);
setInterval(function(){changeLiabilities()}, 1000);
setInterval(function(){changeTableValue()}, 1000);

function selectYearDate(){
  var year = $('#selectYear').val();
  window.location = 'financial-report.php?year=' + year;
}
function changeRevenue(){
  var current_year = '<?php echo $current_year; ?>';
   $('#revenue').load('../snippet/revenue-dynamic.php?year='+ current_year,function(){           
         
    });
}
function changeNetProfit(){
  var current_year = '<?php echo $current_year; ?>';
   $('#netProfit').load('../snippet/net-profit-dynamic.php?year='+ current_year,function(){           
         
    });
}
function changeInterest(){
  var current_year = '<?php echo $current_year; ?>';
   $('#interest').load('../snippet/interest-dynamic.php?year='+ current_year,function(){           
         
    });
}
function changeLiabilities(){
  var current_year = '<?php echo $current_year; ?>';
   $('#liabilities').load('../snippet/liabilities-dynamic.php?year='+ current_year,function(){           
         
    });
}
function changeTableValue(){

  var current_year = '<?php echo $current_year; ?>';
  /*
  var liabilities = $('#liabilitiesText').text();
  var interest = $('#interestText').text();
  var netProfit = $('#netProfitText').text();
  var revenue = $('#revenueText').text();
*/
  //alert(liabilities + ' ' + interest + ' ' + netProfit + ' ' + revenue + ' ');
   $('#tableMetric').load('../snippet/financial-report-table.php?year='+ current_year,function(){           
         
    });
}

function showEditCustomer(id){    
      var id = id;            
      $('.customer-body').load('../snippet/customer-modal-edit.php?id=' + id,function(){           
          $('#addnewcustomer').modal({show:true}); 
         
      });                    
}


  function showDeleteCustomer(id){    
      var id = id;            
      var table = "customer";
      var redirect = '../pages/customer-list.php';
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
   $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-reports").addClass("active");
});
  
</script>