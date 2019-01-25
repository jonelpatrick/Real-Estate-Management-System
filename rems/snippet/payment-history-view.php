<?php
 include '../cli/global-functions.php';
 include '../snippet/session.php';

 $id = $_GET['id'];
 $user = $_GET['user'];
 $user_id = $_SESSION['user_id'];
 if($user == 'client'){

 	 $sql = "SELECT 
 	 			client_payment_transaction.date_paid date_paid,
				client_payment_transaction.amount_paid amount_paid,
				client_payment_transaction.method_of_payment method,
				property.payment_mode terms,
				property.price_bought total,
				property.date_management_commence date_added,
				client.firstname cfname,
				client.middlename cmname,
				client.lastname clname,
				property.monthly_payment month,
				client_payment_transaction.due_date due
				FROM client_payment_transaction 
				INNER JOIN property
				ON client_payment_transaction.property_id = property.id 
				INNER JOIN client 
				ON client_payment_transaction.client_id = client.id
				WHERE client_payment_transaction.id = $id";

 }else{


 $sql = "SELECT payment_transaction.date_paid date_paid,
				payment_transaction.amount_paid amount_paid,
				payment_transaction.method_of_payment method,
				property_sold.terms_of_payment terms,
				property_sold.total_amount total,
				property_sold.date_added date_added,
				customer.firstname cfname,
				customer.middlename cmname,
				customer.lastname clname,
				property_sold.monthly_payment month,
				payment_transaction.due_date due
				FROM payment_transaction 
				INNER JOIN property_sold 
				ON payment_transaction.property_sold_id = property_sold.id 
				INNER JOIN customer 
				ON payment_transaction.customer_id = customer.id
				WHERE payment_transaction.id = $id";
}
	
		$result = mysqli_query($mysqli,$sql);
		$x = 0;
		while($row = mysqli_fetch_array($result)){

			$date_paid = $row['date_paid'];		
			$amount_paid = $row['amount_paid'].'.00';
			$method = convertMethodOfPayment($row['method']);
			$terms = $row['terms'];
			$total = $row['total'];
			$date_added = $row['date_added'];
			$monthly_payment = $row['month'];
			$due_date = $row['due'];
			$remaining = getRemainingAmount($total,$user_id,$user,$mysqli);
		}
?>

<br>
<div class="form-group inline-layout">	
	<label class="radio-inline">Due Date: <input type="text" class="form-input" value="<?php echo $due_date; ?>" disabled></label>	
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Monthly Payment: <input type="text" class="form-input" value="<?php echo $monthly_payment; ?>" disabled></label>	
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Date Paid: <input type="text" class="form-input" value="<?php echo $date_paid; ?>" disabled></label>	
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Amount Paid: <input type="text" class="form-input" value="<?php echo $amount_paid; ?>" disabled></label>	
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Method of Payment: <input type="text" class="form-input" value="<?php echo $method; ?>" disabled></label>	
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Balance Amount: <input type="text" class="form-input" value="<?php echo $remaining; ?>" disabled></label>	
</div>
<style type="text/css">
	.form-input{
		padding-left: 1em;
	    background: #fbfafa;
	    border: none;
	    border-bottom: 1px solid rgba(0,0,0,0.2);
	}
</style>