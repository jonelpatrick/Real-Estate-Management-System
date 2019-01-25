<?php
include '../dbconnect/connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM client_payment_transaction WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
     	$method = $row['method_of_payment'];
     	$amount_paid = $row['amount_paid'];     	
     }
   }
?>

 <input type="hidden" name="transaction_id" value="<?php echo $id;?>">
 <div class="modal-body">
    <div class="form-group inline-layout">
        <label class="radio-inline">Method of Payment </label>
        <label class="radio-inline">
          <input type="radio" name="method_of_payment" value="0" <?php if($method == 0){echo 'checked';} ?> >Cash
        </label>
        <label class="radio-inline">
          <input type="radio" name="method_of_payment" value="1" <?php if($method == 1){echo 'checked';} ?> >Cheque
        </label>
    </div>
    <div class="form-group">          
    <label>Amount Paid:</label>
      <input type="text" class="form-control" name="amount_paid" value="<?php echo $amount_paid; ?>">          
    </div>     
 </div>