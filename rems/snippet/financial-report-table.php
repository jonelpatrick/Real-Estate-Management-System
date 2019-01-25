<?php
include '../dbconnect/connect.php';
$year = $_GET['year'];

$current_revenue = 0 ;
$current_interest = 0;
$current_liabilities = 0;
$current_net_profit = 0;


//interest
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
$current_interest = round($total_interest);

//liabilities
$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$year."%' GROUP BY client_id";

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

$current_net_profit = $net_profit;
if($total_liabilites > $total_revenue){
	$changeColor = 'changeColorRed';
}else{
	$changeColor = 'changeColorBlack';
}
//revenue

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$revenue = $row['revenue'];
    	$total_revenue += ($revenue * 12);
    	}
}
$current_revenue = $total_revenue;

//------------------------------------------- previous year --------------------------------//
$prev_year = $year - 1;
$prev_revenue = 0 ;
$prev_interest = 0;
$prev_liabilities = 0;
$prev_net_profit = 0;


//interest
$sql = "SELECT price_bought,price FROM property WHERE deleted = 0 and date_management_commence LIKE '".$prev_year."%' GROUP BY client_id";

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
$prev_interest = round($total_interest);

//liabilities
$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$prev_year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$liabilites = $row['liabilities'];
    	$total_liabilites += ($liabilites * 12);
    	}
}
$prev_liabilities = $total_liabilites;

//net profit

$net_profit = 0;

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$prev_year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$revenue = $row['revenue'];
    	$total_revenue += ($revenue * 12);
    	}
}

$sql = "SELECT sum(monthly_payment) liabilities FROM property WHERE deleted = 0 and date_management_commence LIKE '".$prev_year."%' GROUP BY client_id";

$result = mysqli_query($mysqli,$sql);
$total_liabilites = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$liabilites = $row['liabilities'];
    	$total_liabilites += ($liabilites * 12);
    	}
}

$net_profit =  $total_revenue - $total_liabilites ;

$prev_net_profit = $net_profit;
if($total_liabilites > $total_revenue){
	$changeColor2 = 'changeColorRed';
}else{
	$changeColor2 = 'changeColorBlack';
}
//revenue

$sql = "SELECT sum(monthly_payment) revenue FROM property_sold WHERE deleted = 0 and date_added LIKE '".$prev_year."%' GROUP BY customer_id";

$result = mysqli_query($mysqli,$sql);
$total_revenue = 0;
if (mysqli_num_rows($result) > 0) {	                                    
    while($row = mysqli_fetch_assoc($result)) {

    	$revenue = $row['revenue'];
    	$total_revenue += ($revenue * 12);
    	}
}
$prev_revenue = $total_revenue;

//------------------------------------------- Change diff--------------------------------//
$diff_revenue = 0 ;
$diff_interest = 0;
$diff_liabilities = 0;
$diff_net_profit = 0;

$diff_revenue = $current_revenue - $prev_revenue;
$diff_interest = $current_interest - $prev_interest;
$diff_liabilities = $current_liabilities - $prev_liabilities;
$diff_net_profit = $current_net_profit - $prev_net_profit;

if($diff_net_profit < 0){
	$changeColor3 = 'changeColorRed';
}else{
	$changeColor3 = 'changeColorBlack';
}
?>
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
          <td>₱ <?php echo number_format($current_revenue).'.00'; ?></td>
           <td>₱ <?php echo number_format($prev_revenue).'.00'; ?></td>
          <td>₱ <?php echo number_format($diff_revenue).'.00'; ?></td>
        </tr>
        <tr style="background: #e0e9ef;">
          <td>NET PROFIT</td>
          <td class="<?php echo $changeColor; ?>">₱ <?php echo number_format($current_net_profit).'.00'; ?></td>
          <td class="<?php echo $changeColor2; ?>">₱ <?php echo number_format($prev_net_profit).'.00'; ?></td>
          <td class="<?php echo $changeColor3; ?>">₱ <?php echo number_format($diff_net_profit).'.00'; ?></td>
        </tr>
        <tr>
          <td>INTEREST</td>
          <td>₱ <?php echo number_format($current_interest).'.00'; ?></td>
          <td>₱ <?php echo number_format($prev_interest).'.00'; ?></td>
          <td>₱ <?php echo number_format($diff_interest).'.00'; ?></td>
        </tr>
        <tr style="background: #e0e9ef;">
          <td>LIABILITIES</td>
          <td>₱ <?php echo number_format($current_liabilities).'.00'; ?></td>
          <td>₱ <?php echo number_format($prev_liabilities).'.00'; ?></td>
          <td>₱ <?php echo number_format($diff_liabilities).'.00'; ?></td>
        </tr>
      
      </tbody>
    </table>