<?php
include '../dbconnect/connect.php';

$year = $_GET['year'];
$net_profit = 0;

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$revenue = $row['revenue'];
    	$total_revenue += ($revenue * 12);
    	}
}

$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$liabilites = $row['liabilities'];
    	$total_liabilites += ($liabilites * 12);
    	}
}

$net_profit =  $total_revenue - $total_liabilites ;
if($total_liabilites > $total_revenue){
	$changeColor = 'changeColorRed';
}else{
	$changeColor = 'changeColorBlack';
}
?>
 <label >

  <span id="netProfitText" class="font-value <?php echo $changeColor; ?>">₱ <?php echo number_format($net_profit).'.00'; ?></span>
  <hr>
</label>