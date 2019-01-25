<?php
include '../dbconnect/connect.php';

$year = $_GET['year'];

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$revenue = $row['revenue'];
    	$total_revenue += ($revenue * 12);
    }
}
?>
 <label >
  <span id="revenueText" class="font-value">₱ <?php echo number_format($total_revenue).'.00'; ?></span>
  <hr>
</label>