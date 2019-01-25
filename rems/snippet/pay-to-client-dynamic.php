<?php 

 include '../cli/global-functions.php';

$pid = $_GET['id'];

$sql = "SELECT
        id, 
        monthly_payment,
        payment_mode,
        price_bought,        
        property_name,
        client_id,
        property.image_path image_path
        FROM property 
        WHERE deleted = 0 
        AND id = '$pid'";
 $result = mysqli_query($mysqli,$sql);

  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
     	$property_id = $row['id'];
      $monthly_payment = $row['monthly_payment'];
      $terms_of_payment = $row['payment_mode'];
      $price = $row['price_bought'];
      $total_amount = $row['price_bought'];
      $property_name = $row['property_name'];
      $client_id = $row['client_id'];
    // 	$image_path = getPropertyImage($property_id,$mysqli);
      $image_path = $row['image_path'];

      //change into money
      $total_amount = number_format($total_amount);
      $price        = number_format($price);
      $monthly_payment = number_format($monthly_payment);
     }
  }else{
      
      $monthly_payment = 'Not applicable';
      $terms_of_payment = 'Not applicable';
      $price = 'Not applicable';
      $total_amount = 'Not applicable';
      $property_name = 'No result';
      
      $image_path = '../../property-gallery/no-image-land.png';
  }

$cid = $client_id;
?>

<div class="row">
<div class="col-lg-6">
 <input type="hidden" name="action" value="pay-to-client" >
 <input type="hidden" name="property_id" value="<?php echo $property_id; ?>"> 
 <input type="hidden" name="client_idL" value="<?php echo $client_id; ?>"> 
 

  <div class="card mb-3">
    <div class="card-header">
     Payment Details
    </div>
    <div class="card-body">
     
        <div class="form-group inline-layout">                                      
         
          <div class="property-bought jumbotron" >
          <?php if($image_path == "no-image-land.png"){ ?>
          <img src="../system-images/no-image-land.png" class="img-rounded" style="width:120px;"><br>
          <?php }else{ ?>
       
         <img src="../uploads/<?php echo $image_path; ?>" class="img-rounded" style="width:120px;"><br>
          <?php } ?>
             
			  <span style="color: #ec880c;"> <?php echo $property_name;?><br></span>
			  <span >₱ <?php echo $price; ?>.00<br></span>
           </div>
          <div class="form-group"> 
            <label class="radio-inline">
              Total Amount: <b>₱ <?php echo $total_amount; ?>.00</b>
            </label> 
          </div>
          <div class="form-group"> 
            <label class="radio-inline">
              Terms of Payment: <b><?php if($terms_of_payment == 0 ){ echo 'One time Payment';}else{echo $terms_of_payment.' years';} ?>  </b>
            </label> 
          </div>
          <div class="form-group"> 
            <label class="radio-inline">
              Monthly Payment: <b>₱ <?php echo $monthly_payment; ?>.00</b>
            </label> 
          </div>         
                      
        </div>
      </div>
    </div>
  </div>  

   <div class="col-lg-6">
      <div class="card mb-3">
        <div class="card-header">
         Enter amount of payment
        </div>
        <div class="card-body">
           <div class="form-group"> 
              <label class="radio-inline">
                Today date is: <i><?php echo date('y-m-d'); ?></i>
              </label> 
              <?php 
                if(isFirstTimePayment($cid,$pid,$mysqli) == 0){
                  echo '<label class="radio-inline downpayment">';
                  echo '<i> Down payment </i>';
                  echo '</label>';
                }
              ?>
              
              </label>
            </div>
           <div class="form-group inline-layout">
              <label class="radio-inline">Method of Payment: </label>
              <label class="radio-inline">
                <input type="radio" name="method_of_payment" value="0" checked>Cash
              </label>
              <label class="radio-inline">
                <input type="radio" name="method_of_payment" value="1">Cheque
              </label>
             </div>
            <div class="form-group"> 
              <input type="text" name="amount_paid" class="form-control" placeholder="0.00">
            </div>
            <div class="form-group"> 
              <input type="submit" name="submit" class="btn btn-primary" value="Submit Payment">
            </div>
             <hr>
             <div class="form-group">
                Check/Print your Payment History: 
                <a onclick="generateBillStatement(<?php echo $cid; ?>);" class="btn btn-warning">
                  <img style="width: 100px;" src="../system-images/icon-bill.png" />  
                </a>              
              </div>
              <hr>
        </div>
      </div>
    </div>         
</div><!--row -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Due Date</th> 
                <th>Date Paid</th>                
                <th>Method of Payment</th>
                <th>Amount Paid</th>                            
                <th>Transacted</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Due Date</th> 
                <th>Date Paid</th>                
                <th>Method of Payment</th>
                <th>Amount Paid</th>                            
                <th>Transacted</th>
                <th width="10%"></th>
              </tr>
            </tfoot>
            <tbody>
            <?php
            	 $sql = "SELECT 
                       id,
                       due_date,
                       date_paid,
                       method_of_payment,
                       amount_paid,
                       transacted_by
                       FROM client_payment_transaction 
                       WHERE client_id = '$cid' 
                       AND property_id = '$pid'";

        				 $result = mysqli_query($mysqli,$sql);

        				  if (mysqli_num_rows($result) > 0) { 
        				     while($row = mysqli_fetch_assoc($result)) {

        				     	$payment_id         = $row['id'];
        				     	$date_paid          = $row['date_paid'];				     	
        				     	$method_of_payment  = convertMethodOfPayment($row['method_of_payment']);
        				     	$amount_paid        = $row['amount_paid'];
        				     	$transacted_by      = getEmployeeName($row['transacted_by'],$mysqli);
                      $due_date           = $row['due_date'];

                      $amount_paid        = number_format($amount_paid);
                                          
        				     	echo '<tr>';
                      echo '<td>'.$due_date.'</td>'; 
        				     	echo '<td>'.$date_paid.'</td>';				     	
        				     	echo '<td>'.$method_of_payment.'</td>';
        				     	echo '<td>₱ '.$amount_paid.'</td>';
        				     	echo '<td>'.$transacted_by.'</td>';	
        				     	echo '<td><a class="btn btn-success" onclick="showEditPayment('.$payment_id.');"><i class="far fa-edit"></i></a></td>';		     	
        				     	echo '</tr>';
        				     }
        				  }
            ?>
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="editPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">EDIT Payment Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="../cli/functions.php" >
      <input type="hidden" value = "edit_client_payment_transaction" name = "action">
       <div class="payment-body">

       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>           
        </div>
      </form>   
    </div>
    </div>
  </div>

<style type="text/css">
  .downpayment{
    background: rebeccapurple;
    color: #fff;
    padding: 5px 15px;
    border-radius: 5px;
    margin-left: 2em;
  }
</style>
<script type="text/javascript">
	 function showEditPayment(id){    
      var id = id;            
      $('.payment-body').load('../snippet/client-payment-transaction-edit.php?id=' + id,function(){           
        $('#editPayment').modal({show:true});          
      });                    
  }

  function generateBillStatement(id){
    var pid = '<?php echo $pid; ?>';
    window.open('../snippet/client-payment-history-bill.php?id='+ id + '&pid=' + pid);
  }
</script>