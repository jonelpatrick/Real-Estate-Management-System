<?php
	include '../template/header.php';
?>
<style type="text/css">
  .editable-select{
    width: 40%;
  }
</style>
  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Payment</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
    <form method="POST" action="../cli/functions.php">

      <div class="row">           
        <div class="form-group col-lg-12">
         
                 <input class="editable-select" list="customer" name="customer_id" placeholder="Select Customer here" onchange="getInfo(this)" />
                  <datalist id="customer">
                    <?php
                        $sql = "SELECT id,firstname,middlename,lastname FROM customer WHERE deleted = 0 AND status = 0";
                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) {                             
                             while($row = mysqli_fetch_assoc($result)) {
                              $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              $id  = $row['id'];
                              echo '<option value="'.$name.'">';
                             }
                          }
                      ?>           
                  </datalist>   
        </div>   
      </div>
      <div id="dynamicInfo">
        <div class="row">
            <div class="col-lg-6">
             <input type="hidden" name="action" value="payment_transaction" >
                   
              <div class="card mb-3">
                <div class="card-header">
                 Payment Details
                </div>
                <div class="card-body">
                 
                    <div class="form-group inline-layout">                                                           
                      <div id="property-cart" class="property-bought jumbotron" >
                        
                       </div>
                      <div class="form-group"> 
                        <label class="radio-inline">
                          Total Amount: 0.00
                        </label> 
                      </div>
                      <div class="form-group"> 
                        <label class="radio-inline">
                          Terms of Payment: <i>Please select a customer</i>
                        </label> 
                      </div>
                      <div class="form-group"> 
                        <label class="radio-inline">
                          Monthly Payment: <i>Please select a customer</i>
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
                            <th>Date Paid</th>                            
                            <th>Method of Payment</th>
                            <th>Amount Paid</th>                            
                            <th>Transacted</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Date Paid</th>                            
                            <th>Method of Payment</th>
                            <th>Amount Paid</th>                            
                            <th>Transacted</th>
                            <th></th>
                          </tr>
                        </tfoot>
                        <tbody>
                        
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
          </div> <!-- Dynamic Info -->

          </form>
        </div>
      </div>
       <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">
      
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
  function getInfo(val){
    //var cid = id.value;
    var cid = val.value;

    if(cid != 0){
       $.get("../snippet/payment-transaction-dynamic-select.php?id="+cid, function (data) {
  
        $("#dynamicInfo").html(data);
      });   
    }else{
     location.reload();
    }
    
  }
  
 transactionValidate();
  function transactionValidate(){
     var error = $('#transactResult').val();
     if(error != ""){
         if(error == "success"){
          processingSuccess();
         }else{
          processingError();
         }
     }      
  }
    $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-sales-property").addClass("active");
});

</script>