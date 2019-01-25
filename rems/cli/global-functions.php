<?php 
include '../dbconnect/connect.php';

function getOrigPropertyCurrentSize($pid,$mysqli){
  
  $sql = "SELECT id,orig_property_current_size FROM devided_property WHERE property_id = '$pid' AND deleted = 0 ";
  $result = mysqli_query($mysqli,$sql);
  $num = 0;
  if (mysqli_num_rows($result) > 0) { 
  
     while($row = mysqli_fetch_assoc($result)) {
      
      $num = $row['orig_property_current_size'];
      $id = $row['id'];    
     }

  }else{
    $num = 0;
  }

  return $num;
}

function getIdViaCustomerName($cname,$mysqli){

  $sql = "SELECT id,firstname,middlename,lastname FROM customer ";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
  
     while($row = mysqli_fetch_assoc($result)) {
      
      $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
      $id = $row['id'];
      if($cname == $name){

        break 1;
      }      

     }

  }

  return $id;

}

function getIdViaClientName($cname,$mysqli){

  $sql = "SELECT id,firstname,middlename,lastname FROM client ";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
  
     while($row = mysqli_fetch_assoc($result)) {
      
      $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
      $id = $row['id'];
      if($cname == $name){
        
        break 1;
      }      

     }

  }

  return $id;

}

function isFirstTimePayment($cid,$pid,$mysqli){
  $bool = 0;

  $sql = "SELECT * FROM client_payment_transaction WHERE client_id = '$cid' AND property_id = '$pid'";
  $result = mysqli_query($mysqli,$sql);  
  if (mysqli_num_rows($result) > 0) {      
    $bool = 1;
  }else{

    $bool = 0;
  }

  return $bool;
}

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}


function getPropertyImage($id,$mysqli){

  $sql = "SELECT image_path FROM property_gallery WHERE property_id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  $image_path = "";
  if (mysqli_num_rows($result) > 0) { 
  
     while($row = mysqli_fetch_assoc($result)) {
      $image_path = $row['image_path'];
      if($image_path == 0 || $image_path == null || $image_path == ""){
        $image_path = 'no-image-land.png';
      }
      break 1;

     }

  }

  return $image_path;
}

function convertCondition($condition){
	$var = "";
	 switch ($condition) {
      case 0:
        $var = '<span class="btn btn-success">Good</span>';
        break;

      case 1:
        $var = '<span class="btn btn-warning">Bad</span>';
        break;

      case 2:
        $var = '<span class="btn btn-repaired">Repaired</span>';
        break;  

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}

function convertAvailability($avail){
	$var = "";
	 switch ($avail) {
      case 0:
        $var = '<span class="monthly"> Available</span>';
        break;

      case 1:
        $var = '<span class="price"> Sold</span>';
        break;

      default:
        $var = "Something went wrong";
        break;
    }
    
    return $var;
}

function convertMethodOfPayment($method){
  $var = "";
   switch ($method) {
      case 0:
        $var = 'Cash';
        break;

      case 1:
        $var = 'Cheque';
        break;

      default:
        $var = "Something went wrong";
        break;
    }
    
    return $var;
}

function getEmployeeName($id,$mysqli){
  $name = "";
  $sql = "SELECT firstname,middlename,lastname FROM employee WHERE id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
  
     while($row = mysqli_fetch_assoc($result)) {
        $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];      

     }
  }
  return $name;
}

function getCustomer($id,$mysqli){
  $customer="";
  $sql = "SELECT firstname,middlename,lastname FROM customer WHERE id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];      

     }
  }
  return $name;
}

function getClient($id,$mysqli){
  $client = "";
  $sql = "SELECT firstname,middlename,lastname FROM client WHERE id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];      

     }
  }
  return $name;
}

function getTotal($id,$mysqli){
  
  $sql = "SELECT total_amount FROM property_sold WHERE customer_id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $total = $row['total_amount'];      

     }
  }
  return $total;
}

function getPropertyPrice($id,$pid,$mysqli){
  
  $sql = "SELECT price FROM property WHERE client_id = '$id' AND id = '$pid'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $total = $row['price'];      

     }
  }
  return $total;
}

function getTerms($id,$mysqli){
  
  $sql = "SELECT terms_of_payment FROM property_sold WHERE customer_id = '$id'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $terms = $row['terms_of_payment'];      

     }
  }
  return $terms.' years';
}

function getPaymentMode($id,$pid,$mysqli){
  
  $sql = "SELECT payment_mode FROM property WHERE client_id = '$id' AND id = '$pid'";
  $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

        $mode = $row['payment_mode'];      

     }
  }
  switch ($mode) {

    case 0:
      $mode = 'One Time Payment';
      return $mode;
      break;
    
    default:
      return $mode.' years';
      break;
  }
 
}

function getFirstDueDate(){
  $date_now = date('Y-m-d');
  //$date = DATE_ADD($date_now, INTERVAL 1 MONTH);
  $date = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('-', '-', $date_now)))) . PHP_EOL;

  return $date;
}

function getNextDueDate($prev_due_date,$cid,$mysqli,$table){

  $customer = findCustomer($cid,$mysqli,'payment_transaction','customer_id');

  if($customer > 0){

    $date_now = $prev_due_date;
    //$date = DATE_ADD($date_now, INTERVAL 1 MONTH);
    $date = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('-', '-', $date_now)))) . PHP_EOL;
  }else{
    
    $date = getPropertySoldDueDate($cid,$mysqli);  
  }
  return $date;
}

function getNextDueDate2($prev_due_date,$cid,$mysqli,$table){

  $client = findCustomer($cid,$mysqli,'client_payment_transaction','client_id');

  if($client > 0){

    $date_now = $prev_due_date;
    //$date = DATE_ADD($date_now, INTERVAL 1 MONTH);
    $date = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('-', '-', $date_now)))) . PHP_EOL;
  }else{
    
    $date = getPropertyDueDate($cid,$mysqli);  
  }
  return $date;
}

function getPrevDueDate($cid,$mysqli){
   $date = ""; 
  $sql  = "SELECT due_date FROM payment_transaction WHERE customer_id = '$cid' ORDER by due_date DESC";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $date = $row['due_date'];
        break(1);
     }
  }
return $date;
}

function getPrevDueDate2($cid,$pid,$mysqli){
   $date = ""; 
  $sql  = "SELECT due_date FROM client_payment_transaction WHERE client_id = '$cid' AND property_id='$pid' ORDER by due_date DESC";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $date = $row['due_date'];
        break(1);
     }
  }
return $date;
}

function getRemainingAmount($total,$id,$user,$mysqli){
  $balance  = 0;
  if($user == 'customer'){
    $sql = "SELECT amount_paid FROM payment_transaction WHERE customer_id = '$id'";

  }else if ($user == 'client'){
    $sql = "SELECT amount_paid FROM client_payment_transaction WHERE client_id = '$id'";
  } 

  $result = mysqli_query($mysqli,$sql);

  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $amount = $row['amount_paid'];
        $balance += $amount;
     }
  }
  $balance = $total - $balance;
  return $balance;
}

function getTotalPaid2($id,$pid,$user,$mysqli){
  $paid  = 0;

  if($user == 'customer'){
    $sql = "SELECT amount_paid FROM payment_transaction WHERE customer_id = '$id'";

  }else if ($user == 'client'){
    $sql = "SELECT amount_paid FROM client_payment_transaction WHERE client_id = '$id' AND property_id = '$pid'";
  } 

  $result = mysqli_query($mysqli,$sql);

  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $amount = $row['amount_paid'];
        $paid += $amount;
     }
  }
  
  return $paid;
}

function findCustomer($cid,$mysqli,$table,$user){
   $id = 0;
   $sql  = "SELECT id FROM ".$table." WHERE ".$user." = '$cid' ";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        break(1);
     }
  }
  return $id;
}

function getPropertySoldDueDate($cid,$mysqli){
   
   $sql  = "SELECT first_due_date FROM property_sold WHERE customer_id = '$cid' ";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $date = $row['first_due_date'];       
     }
  }
  return $date;
}

function getPropertyDueDate($cid,$mysqli){
   
   $sql  = "SELECT date_management_commence FROM property WHERE client_id = '$cid' ";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $date = $row['date_management_commence'];  
        $duedate = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('-', '-', $date)))) . PHP_EOL;     
     }
  }
  return $duedate;
}

function getMaxDueDate($cid,$mysqli,$table,$user){
  $due_date = "";
   $sql  = "SELECT max(due_date) due_date FROM ".$table." WHERE ".$user." = '$cid'";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
        $due_date = $row['due_date'];        
     }
  }
  return $due_date;
}

function checkBalance($cid,$mysqli){
  $total_amount = getTotal($cid,$mysqli);
  $total_paid = getTotalPaid($cid,$mysqli);
  $result = $total_amount - $total_paid;
  
  return $result;
}

function getTotalPaid($cid,$mysqli){
   $amount = 0;
   $sql  = "SELECT amount_paid FROM payment_transaction WHERE customer_id = '$cid'";
   $result = mysqli_query($mysqli,$sql);
  
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

       $amount += $row['amount_paid'];
     }
  }
  return $amount;

}

?>