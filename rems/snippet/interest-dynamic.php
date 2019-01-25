<?php
include '../dbconnect/connect.php';

$year = $_GET['year'];

$sql = "SELECT price_bought,price FROM property WHERE deleted = 0 and date_management_commence LIKE '".$year."%' GROUP BY client_id";

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

?>
 <label >
   <span  class="font-value" id="interestText">₱ <?php echo number_format(round($total_interest)).'.00'; ?></span>
  <hr>
</label>