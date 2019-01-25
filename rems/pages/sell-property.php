<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Sell Property</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="row">

        <div class="col-lg-7">
          <div class="card mb-3">
            <div class="card-header">               
               Buyer Detail
            </div>

            <form method="POST" action="../cli/functions.php">
            <input type="hidden" name="action" value="sell-property">
            <input type="hidden" name="propertyId" id="propertyId">
          

              <div class="card-body">
               <div class="form-group">          
                 <label class="radio-inline">
                  Select Customer:   
                </label>   
                <!--         
                 <select id="searchSelectCustomer" class="custom-select radio-inline" name="customer_id" style="display: inline;width: 60%;">
                      <?php
                        $sql = "SELECT id,firstname,middlename,lastname FROM customer WHERE deleted = 0 AND status = 0";
                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) { 
                            echo '<option value="0">Select a customer here...</option>';
                             while($row = mysqli_fetch_assoc($result)) {
                              $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              $id  = $row['id'];
                              echo '<option value="'.$id.'">'.$name.'</option>';
                             }
                          }
                      ?>                    
                  </select> 
                -->
                  <input class="editable-select" list="customer" name="customer_id" placeholder="Select Customer here" />
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
             
                <div style="margin-top: 1em;" class="card-footer small text-muted">Property [cart]</div>

                <div id="cart-changeable">
                  <div id="property-cart" class="property-bought jumbotron" >
                  
                  </div>

                <div class="form-group"> 
                  <label class="radio-inline">
                    Total Amount: 0.00
                  </label> 
                </div>
              </div>
              <div class="form-group"> 
                <label>
                  Terms of Payment: 
                </label>
                <select  onchange="calculate(this.value);" class="custom-select radio-inline" name="terms_of_payment" style="display: inline;width: 60%;">
                   <option value="1">1 year</option>              
                   <option value="2">2 years</option> 
                   <option value="3">3 years</option>
                   <option value="4">4 years</option>
                   <option value="5">5 years</option>
                   <option value="6">6 years</option>
                   <option value="7">7 years</option>
                   <option value="8">8 years</option>
                   
                </select>     
              </div>
               <div class="form-group"> 
                <label>
                  Monthly Payment: <span id="monthlyPayment">0.00</span>
                </label>   
                <input type="hidden" name="monthly_payment" id="monthlyPayment2">          
              </div>
              <hr>
              <!--
              <div class="form-group">
                Check/Print your Billing Statement: 
                <a href="">
                  <img style="width: 100px;" src="../system-images/icon-bill.png" />  
                </a>              
              </div>
              <hr>
              -->
              
              <div class="form-group">
                <input type="submit" name="submit" value="Submit and Sold" class="btn btn-primary">
              </div>
              </div><!--card body -->

            </form>

          </div>            
        </div>  


        <div class="col-lg-5">
          <div class="card mb-3">
            <div class="card-header">               
                 List of available property
            </div>
            <div class="card-body">

     <!-- DataTables Example -->
                
                <div class="card-body">
                  <div class="table-responsive">
                  <input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search for property..." title="Type in a name">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <tbody>
                      <?php
                        $sql = "SELECT id,
                                property_name,
                                price,
                                property_condition,
                                image_path,
                                property_size,
                                size_unit,
                                block,
                                lot
                                FROM property 
                                WHERE availability=0 
                                AND deleted= 0";

                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) { 
                             while($row = mysqli_fetch_assoc($result)) {
                              $id             = $row['id'];
                              $name           = $row['property_name'];                              
                              $price          = $row['price'];
                              $condition      = convertCondition($row['property_condition']);
                            //  $image_path = getPropertyImage($id,$mysqli);
                              $image_path     = $row['image_path'];
                              $property_size  = $row['property_size'];
                              $size_unit      = $row['size_unit'];
                              $block          = $row['block'];
                              $lot            = $row['lot'];

                              $price          = number_format($price);

                              if($size_unit == 0){
                                $size_unit = 'Square meter';
                              }else{
                                $size_unit = 'hectare';
                              }

                              echo '<tr onclick="javascript:addToCart('.$id.');">';
                              echo '<td style="display:none;">'.$name.'</td>'; 
                              echo '<td style="width:100px;height:100px;">';
                          
                              if($image_path == "no-image-land.png"){
                              echo '<img style="width:100px;height:100px;" src="../system-images/'.$image_path.'"></td>';
                             }else{
                              echo '<img style="width:100px;height:100px;" src="../uploads/'.$image_path.'" style="width: 150px; height: 140px;">';
                             }
                             echo '<td>';
                             echo '<button class="select-box"><i class="fas fa-hand-pointer"></i></button>';
                             echo ''.$name.
                                 '<br>Price: ₱ '.$price.
                                 '<br>Size: ';
                             echo $property_size.' '.$size_unit.'';
                              if($block == 0 && $lot != 0){
                                echo '<br>'.' Lot: '.$lot;
                              }else if($lot == 0 && $block != 0){
                                 echo '<br> Block: '.$block.'';
                              }else if($block == 0 && $lot == 0){
                                 
                              }
                              else{
                                  echo '<br> Block: '.$block.' Lot: '.$lot;
                              }
                             
                             echo '</td>';                              
                             echo '</tr>';
                             }
                          }
                      ?>
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>               
        
            </div>
          </div>  
        </div>
        
      </div>

    </div>
</div>
 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

<style type="text/css">
  .selected-property{
    font-size: 13px;
    background: #fff;
    width: auto;
    max-width: 100px;
    text-align: center;
  }
   .selected-property span{
    text-align: center;
    font-size: 13px;
   }
  .jumbotron{
    padding: 2em !important;
  }
  .img-rounded{
    width: 90px;
  }
  .dataTables_length label{
    display:none;
  }
  .table td,.table .btn{
      font-size: 13px;      
  }
  .table .btn{
    pointer-events: none;
  }
  .select-box{
    float: right;
    background: none;
    border: none;
    color: #007bff;
  }
 #myInput {
  background-image: url('../system-images/search.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>


<?php
	include '../template/footer.php';
?>
<script>


function calculate(val){

  var total = parseInt($('#totalAmount').val());  
   
  var terms = 12 * (parseInt(val));
  var result = total / terms ;
   var finalResult = (Math.round(result)).toLocaleString('en')     
  $('#monthlyPayment').text('₱ '+finalResult);
  $('#monthlyPayment2').val(finalResult);
   
}

function addToCart(id){
  var id = id;
  $('#propertyId').val(id);

  $.get("../snippet/sell-property-select-property.php?id="+id, function (data) {
//    alert(data); // <-- add this code
      $("#cart-changeable").html(data);
  });
                    
}
function removeProp(e){
  $('.total-amount').text(' 0.00');
  $('#property-cart div').hide();
    
}

function myFunction(){
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
/* editable search*/


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