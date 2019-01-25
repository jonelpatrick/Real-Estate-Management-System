<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
?>
<style type="text/css">
  .even{
    background: #e9ecef;
  }
  
 .accountList .col-lg-6 span{
    background: #7c3b88;
    color: #fff;
    padding: 2px 5px;
    border-radius: 15px;
    
  }
  .balance01{
    color: #000 !important;
  }
  #DEBtxtBalance,#CREtxtBalance{
    font-size: 30px;
    color: #fff;
    background: #000;
    padding: 3px 8px;
    border-radius: 4px;
  }
  th,tr,td{
    font-size: 13px;
  }
</style>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Account Balance</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
    <form method="POST" action="../cli/functions.php">

      <div class="row">           
        <div class="form-group col-lg-12">
         
        </div>   
      </div>
      <div id="dynamicInfo">
        <div class="row">
            <div class="col-lg-6">                                  
              <div class="card mb-3">
                <div class="card-header">
                <i class="fa fa-wallet"></i>
                 Asset
                </div>
                <div class="card-body accountList">
                  <div class="row">
                    <div class="col-lg-6">                      
                      <label class="small text-muted">No. of Customer:  </label> <span id="DEBtxtaccount"></span><br>
                      <label class="small text-muted">Exp. Total Asset:  </label> <span id="DEBtxtasset"></span><br>
                      <label class="small text-muted">Total Paid by customer:  </label> <span id="DEBtxtpaid"></span><br>
                    </div>
                    <div class="col-lg-6">
                      <label class="small text-muted balance01">Amount Recievable: </label><br>
                      <span id="DEBtxtBalance"></span>
                      <hr>
                    </div>
                  </div>                  
                  <hr>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Customer Name</th>
                            <th>Property</th>
                            <th>Payment</th>
                            <th>Paid</th>
                            <th>Balance</th>                            
                          </tr>
                        </thead>
                        <tfoot>
                        
                        </tfoot>
                        <tbody>
                          <?php

                            $sql = "SELECT
                                    property_sold.customer_id id, 
                                    firstname,
                                    middlename,
                                    lastname,
                                    total_amount,
                                    property_sold.property_id pid,
                                    property.property_name pname
                                    FROM property_sold
                                    INNER JOIN Customer 
                                    ON property_sold.customer_id = customer.id 
                                    INNER JOIN property
                                    ON property_sold.property_id = property.id
                                    WHERE property_sold.deleted = 0";

                            $result = mysqli_query($mysqli,$sql);
                            if (mysqli_num_rows($result) > 0) { 

                              $cell_even = 0;
                              $noOfAccount = 0;
                              $expAsset = 0;
                              $sumAccountsPaid = 0;
                              $sumBalance = 0;

                               while($row = mysqli_fetch_assoc($result)) {

                                  $name         = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                                  $total_amount = $row['total_amount'];
                                  $id           = $row['id'];
                                  $pid          = $row['pid'];
                                  $pname        = $row['pname'];
                                  $paid         = getTotalPaid2($id,$pid,'customer',$mysqli);
                                  $balance      = getRemainingAmount($total_amount,$id,'customer',$mysqli); 

                                  if($balance > 0 ){
                                    if($cell_even == 1){
                                      echo '<tr class="even">';
                                      $cell_even = 0;
                                    }else{
                                      echo '<tr>';  
                                      $cell_even++;
                                    }   
                                    echo '<td>'.$name.'</td>';
                                    echo '<td>'.$pname.'</td>';
                                    echo '<td>₱ '.number_format($total_amount).'</td>';
                                    echo '<td>₱ '.number_format($paid).'</td>';
                                    echo '<td>₱ '.number_format($balance).'</td>';
                                    echo '</tr>';
                                    $sumBalance      += $balance;
                                    $sumAccountsPaid += $paid;
                                    $expAsset        += $total_amount;
                                    $noOfAccount++;
                                  }

                                 
                               }
                            }
                          ?>
                        </tbody>
                      </table>
                      <!-- hidden for header debit -->
                      <input type="hidden" id="DEBnoOfAccount" value="<?php echo $noOfAccount; ?>">
                      <input type="hidden" id="DEBexpAsset" value="₱ <?php echo number_format($expAsset); ?>">
                      <input type="hidden" id="DEBsumAccountsPaid" value="₱ <?php echo number_format($sumAccountsPaid); ?>">
                      <input type="hidden" id="DEBsumBalance" value="₱ <?php echo number_format($sumBalance); ?>">
                      <!-- hidden for header debit -->
                  </div>                    
                </div>
              </div>
            </div>  

               <div class="col-lg-6">
                  <div class="card mb-3">
                    <div class="card-header ">
                    <i class="fa fa-credit-card"></i>
                     Liabilities
                    </div>
                    <div class="card-body accountList">
                     <div class="row">
                        <div class="col-lg-6">                      
                          <label class="small text-muted">No. of Client:  </label> <span id="CREtxtaccount"></span><br>
                          <label class="small text-muted">Total Payable:  </label> <span id="CREtxtasset"></span><br>
                          <label class="small text-muted">Total Paid to client:  </label> <span id="CREtxtpaid"></span><br>
                        </div>
                        <div class="col-lg-6">
                          <label class="small text-muted balance01">Amount Payable: </label><br>
                          <span id="CREtxtBalance"></span>
                          <hr>
                        </div>
                      </div>                  
                      <hr>
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>Client Name</th>
                                <th>Property</th>
                                <th>Payment</th>
                                <th>Paid</th>
                                <th>Balance</th>                            
                              </tr>
                            </thead>
                            <tfoot>
                             
                            </tfoot>
                            <tbody>
                               <?php

                                  $sql = "SELECT
                                          property.client_id id, 
                                          firstname,
                                          middlename,
                                          lastname,
                                          price_bought,
                                          property.id pid,
                                          property_name
                                          FROM property
                                          INNER JOIN client
                                          ON property.client_id = client.id
                                          WHERE property.deleted = 0";

                                  $result = mysqli_query($mysqli,$sql);
                                  if (mysqli_num_rows($result) > 0) { 

                                    $cell_even       = 0;
                                    $noOfAccount     = 0;
                                    $expAsset        = 0;
                                    $sumAccountsPaid = 0;
                                    $sumBalance      = 0;

                                     while($row = mysqli_fetch_assoc($result)) {

                                        $name         = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                                        $total_amount = $row['price_bought'];
                                        $id           = $row['id'];
                                        $pid          = $row['pid'];
                                        $pname        = $row['property_name'];
                                        $paid         = getTotalPaid2($id,$pid,'client',$mysqli);
                                        $balance      = getRemainingAmount($total_amount,$id,'client',$mysqli); 

                                        if($balance > 0 ){
                                          if($cell_even == 1){
                                            echo '<tr class="even">';
                                            $cell_even = 0;
                                          }else{
                                            echo '<tr>';  
                                            $cell_even++;
                                          }                                              
                                          echo '<td>'.$name.'</td>';
                                          echo '<td>'.$pname.'</td>';
                                          echo '<td>₱ '.number_format($total_amount).'</td>';
                                          echo '<td>₱ '.number_format($paid).'</td>';
                                          echo '<td>₱ '.number_format($balance).'</td>';
                                          echo '</tr>';
                                          $sumBalance      += $balance;
                                          $sumAccountsPaid += $paid;
                                          $expAsset        += $total_amount;
                                          $noOfAccount++;
                                        }
                                     }
                                  }
                                ?>
                            </tbody>
                          </table>
                            <!-- hidden for header debit -->
                            <input type="hidden" id="CREnoOfAccount" value="<?php echo $noOfAccount; ?>">
                            <input type="hidden" id="CREexpAsset" value="₱ <?php echo number_format($expAsset); ?>">
                            <input type="hidden" id="CREsumAccountsPaid" value="₱ <?php echo number_format($sumAccountsPaid); ?>">
                            <input type="hidden" id="CREsumBalance" value="₱ <?php echo number_format($sumBalance); ?>">
                            <!-- hidden for header debit -->
                      </div>  
                    </div>
                  </div>
                </div>   
                <!-- Property List -->
                <div class="col-sm-12">
                  <div class="row">
                  <?php 
                     define("UPLOAD_DIR", "../record-documents/");
                     ?>
                      <div class="col-lg-6">
                        <!-- DataTables Example -->
                        <div class="card mb-3">
                          <div class="card-header">
                          <i class="fas fa-outdent myiconcolor"></i>
                           Property Sold</div>                           
                          <div class="card-body">
                           
                             <div class="table-responsive">
                              <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                 <tr></tr>
                                </thead>
                                <tfoot>
                               
                                </tfoot>
                                <tbody class="table-body">
                                  <?php 
                                    $sql = "SELECT 
                                            property_sold.id id,
                                            property.property_name property_name,
                                            property.property_size property_size,                              
                                            property.address address,
                                            property.city city,
                                            property.property_condition property_condition,
                                            property.subject_to subject_to,
                                            property.date_management_commence date_management_commence,
                                            property.image_path image_path,
                                            size_unit,
                                            block,
                                            lot,
                                            customer.firstname fname,
                                            customer.middlename mname,
                                            customer.lastname lname
                                            FROM property_sold
                                            INNER JOIN property 
                                            ON property_sold.property_id = property.id
                                            INNER JOIN customer 
                                            ON property_sold.customer_id = customer.id
                                            WHERE property_sold.deleted = 0";

                                    $result = mysqli_query($mysqli,$sql);
                                    if (mysqli_num_rows($result) > 0) { 
                                       $x=0;
                                       while($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $property_name = $row['property_name'];
                                        $property_size = $row['property_size'];
                                         $block = $row['block'];
                                        $lot = $row['lot'];    
                                        $name = $row['fname'].' '.$row['mname'].' '.$row['lname'];                    
                                        
                                        if($block == 0 && $lot != 0){
                                          $address = ' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                                        }else if($lot == 0 && $block != 0){
                                           $address = ' Block '.$block.' '.$row['address'].' '.$row['city'];
                                        }else if($block == 0 && $lot == 0){
                                           $address = $row['address'].' '.$row['city'];  
                                        }
                                        else{
                                            $address = ' Block '.$block.' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                                        }
                                        $subject_to = subjectTo($row['subject_to']);
                                        $date_commence = $row['date_management_commence'];
                                        $property_condition = $row['property_condition'];
                                        $image_path = $row['image_path'];

                                        $size_unit = $row['size_unit'];

                                        if($size_unit == 0){
                                          $size_unit = 'square meter';
                                        }else{
                                          $size_unit = 'Hectare';
                                        }
                                        
                                        if($x == 0){
                                          echo '<tr style="width: 100%;">';
                                          $x = 1;
                                        }else{
                                          echo '<tr style="width: 100%;" class="odd-bg">';
                                          $x = 0;
                                        }  
                                        if($property_condition == 0){
                                          $property_condition = "Good Condition";
                                        }else if($property_condition == 1){
                                          $property_condition = "Bad Condition";                            
                                        }else{
                                          $property_condition = "Repaired Condition";                            
                                        }

                                        echo '<td>';   
                                        if($image_path == 'no-image-land.png'){
                                           echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                                        } else{
                                           echo '<img src="../uploads/'.$image_path.'" style="width: 100px; height: 100px;"></td> ';
                                        }              
                                       
                                        echo '<td>';
                                        echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                                        echo '<span class="small text-muted">Property Size: </span> '.$property_size.' '.$size_unit.'<br>';
                                        echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';
                                        //echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                                        echo '<span class="Lease" style="margin-right:1em;"> Sold </span>  to '.$name.'<br>';
                                        echo '<hr>';
                                        echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                                       
                                        echo '</td>';

                                        echo "</tr>";
                                       }
                                     }
                                  ?>
                                                                                                            
                                </tbody>
                              </table>
                            </div>

                          </div>
                         
                        </div>
                       </div>

                      <div class="col-lg-6">
                          <!-- DataTables Example -->
                        <div class="card mb-3">
                          <div class="card-header">
                         <i class="fas fa-sign-in-alt myiconcolor"></i>
                           Remaining Property</div>            
                          <div class="card-body">
                         
                            <div class="table-responsive">
                              <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                 <tr></tr>
                                </thead>
                                <tfoot>
                               
                                </tfoot>
                                <tbody class="table-body">
                                  <?php 
                                    $sql = "SELECT 
                                            id,
                                            property_name,
                                            property_size,                              
                                            address,
                                            city,
                                            property_condition,
                                            subject_to,
                                            date_management_commence,
                                            image_path,
                                            size_unit,
                                            block,
                                            lot
                                            FROM property 
                                            WHERE deleted = 0 AND availability = 0";

                                    $result = mysqli_query($mysqli,$sql);
                                    if (mysqli_num_rows($result) > 0) { 
                                       $x=0;
                                       while($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $property_name = $row['property_name'];
                                        $property_size = $row['property_size'];
                                         $block = $row['block'];
                                        $lot = $row['lot'];                        
                                        
                                        if($block == 0 && $lot != 0){
                                          $address = ' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                                        }else if($lot == 0 && $block != 0){
                                           $address = ' Block '.$block.' '.$row['address'].' '.$row['city'];
                                        }else if($block == 0 && $lot == 0){
                                           $address = $row['address'].' '.$row['city'];  
                                        }
                                        else{
                                            $address = ' Block '.$block.' Lot '.$lot.' '.$row['address'].' '.$row['city'];
                                        }
                                        $subject_to = subjectTo($row['subject_to']);
                                        $date_commence = $row['date_management_commence'];
                                        $property_condition = $row['property_condition'];
                                        $image_path = $row['image_path'];

                                        $size_unit = $row['size_unit'];

                                        if($size_unit == 0){
                                          $size_unit = 'square meter';
                                        }else{
                                          $size_unit = 'Hectare';
                                        }
                                        
                                        
                                        if($x == 0){
                                          echo '<tr style="width: 100%;">';
                                          $x = 1;
                                        }else{
                                          echo '<tr style="width: 100%;" class="odd-bg">';
                                          $x = 0;
                                        }  
                                        if($property_condition == 0){
                                          $property_condition = "Good Condition";
                                        }else if($property_condition == 1){
                                          $property_condition = "Bad Condition";                            
                                        }else{
                                          $property_condition = "Repaired Condition";                            
                                        }

                                        echo '<td>';   
                                        if($image_path == "no-image-land.png"){
                                           echo '<img src="../system-images/no-image-land.png" style="width: 100px; height: 100px;"></td> ';
                                        }else{
                                           echo '<img src="../uploads/'.$image_path.'" style="width: 100px; height: 100px;"></td> ';
                                        }
                                       
                                        echo '<td>';
                                        echo '<span class="small text-muted">Property Name: </span> '.$property_name.'<br>';
                                        echo '<span class="small text-muted">Property Size: </span> '.$property_size.' '.$size_unit.'<br>';
                                        echo '<span class="small text-muted">Property Location: </span> '.$address.'<br>';
                                       // echo '<span class="small text-muted">Property Condition: </span> '.$property_condition.'<br>';
                                        echo '<span class="'.$subject_to.'">'.$subject_to.'</span><br>';
                                        echo '<hr>';
                                        echo '<span class="small text-muted">Date Commence: </span> '.$date_commence;
                                     
                                        echo '</td>';

                                        echo "</tr>";
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
                </div> <!--property list col-sm-12 -->     
            </div><!--row -->
       
          </div> <!-- Dynamic Info -->

          </form>
        </div>
      </div>

<?php

function subjectTo($var){

   $var = $var;

    switch ($var) {

      case 0:
        $var = "Available";
        break;

      case 1:
        $var = "For Rent";
        break;

      case 2:
        $var = "For Lease";
        break;  

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}

	include '../template/footer.php';
?>
 <script type="text/javascript">
    $(document).ready(function() {
      
      //Debit
      var DEBnoOfAccount = $('#DEBnoOfAccount').val();
      var DEBexpAsset = $('#DEBexpAsset').val();
      var DEBsumAccountsPaid = $('#DEBsumAccountsPaid').val();
      var DEBsumBalance = $('#DEBsumBalance').val();

      $('#DEBtxtaccount').text(DEBnoOfAccount);
      $('#DEBtxtasset').text(DEBexpAsset +'.00');
      $('#DEBtxtpaid').text(DEBsumAccountsPaid +'.00');
      $('#DEBtxtBalance').text(DEBsumBalance +'.00');

      //credit

      var CREnoOfAccount = $('#CREnoOfAccount').val();
      var CREexpAsset = $('#CREexpAsset').val();
      var CREsumAccountsPaid = $('#CREsumAccountsPaid').val();
      var CREsumBalance = $('#CREsumBalance').val();

      $('#CREtxtaccount').text(CREnoOfAccount);
      $('#CREtxtasset').text(CREexpAsset +'.00');
      $('#CREtxtpaid').text(CREsumAccountsPaid +'.00');
      $('#CREtxtBalance').text(CREsumBalance +'.00');

    });
     $(function() {
        $(".sidebar .nav-item").removeClass("active");
        $(".menu-tracking-sheet").addClass("active");
    });
 </script> 