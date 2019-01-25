<?php
	include '../template/header.php';
?>
  <link rel="stylesheet" type="text/css" href="../css/jquery-editable-select.min.css">
  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Pay to client</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
    <form method="POST" action="../cli/functions.php">

      <div class="row">           
        <div class="form-group col-lg-12">
        
         
           <select id="paytoclientSelect" placeholder="Select a client here..." class="custom-select radio-inline" name="client_id" style="display: inline;width: 50%;" >
                  <?php
                    $sql = "SELECT 
                            property.id pid,
                            client.id id,
                            client.firstname firstname,
                            client.middlename middlename,
                            client.lastname lastname,
                            property.property_name  
                            FROM property 
                            INNER JOIN client 
                            ON property.client_id = client.id 
                            WHERE property.deleted =0";
                            
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                        
                         while($row = mysqli_fetch_assoc($result)) {
                          $name     = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $id       = $row['id'];
                          $pid      = $row['pid'];
                          $property = $row['property_name'];
                          echo '<option value="'.$pid.'">'.$name.' - '.$property.'</option>';
                         }
                      }
                  ?>                    
              </select> 
         
              <span class="btn btn-primary" onclick="getInfo()">Select</span>
        </div>   
      </div>
      <div id="dynamicInfo">
        <div class="row">
            <div class="col-lg-6">
             <input type="hidden" name="action" value="pay-to-client" >
                   
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
                          Terms of Payment: <i>Please select a client</i>
                        </label> 
                      </div>
                      <div class="form-group"> 
                        <label class="radio-inline">
                          Monthly Payment: <i>Please select a client</i>
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


  function getInfo(e){
    
   // var y = $( "li:contains('Joana M Sarbosa - Avida Land REAL 102)" ).css('background-color', 'red');
    var val = $('#paytoclientSelect').val();
    var pid = $(".es-list li:contains('"+ val +"')").val();
    if(val != ""){            
       if(pid != 0 || pid != null || pid != ""){
           $.get("../snippet/pay-to-client-dynamic.php?id="+pid, function (data) {
      
            $("#dynamicInfo").html(data);
          });   
        }
     }   
      e.preventDefault();
      
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
    $(".menu-pay-to-client").addClass("active");
});

</script>