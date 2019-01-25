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
   
?>
  <input type="hidden" id="inputRevenue" value="<?php echo $current_revenue; ?>">
  <input type="hidden" id="inputNetProfit" value="<?php echo $current_net_profit; ?>">
  <input type="hidden" id="inputInterest" value="<?php echo $current_interest; ?>">
  <input type="hidden" id="inputLiabilities" value="<?php echo $current_liabilities; ?>">