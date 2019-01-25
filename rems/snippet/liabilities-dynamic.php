<?php
include '../dbconnect/connect.php';

$year = $_GET['year'];

$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$liabilites = $row['liabilities'];
    	$total_liabilites += ($liabilites * 12);
    	}
}
?>
 <label >
   <span  class="font-value" id="liabilitiesText">₱ <?php echo number_format($total_liabilites).'.00'; ?></span>
  <hr>
</label>