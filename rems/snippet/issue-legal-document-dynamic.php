<?php
include '../cli/global-functions.php';
define("UPLOAD_DIR", "../record-documents/");

$cname = $_GET['id'];

$id = getIdViaCustomerName($cname,$mysqli);

$balance = checkBalance($id,$mysqli);
if($balance > 0){
  $balance = '<span style="color: red;">'.$balance.'.00</span>';
}else{
  $balance = '<span >'.$balance.'.00</span>';
}

$sql = "SELECT 
    property_sold.id aid,
    property_sold.customer_id acid,
    property_sold.property_id apid,
    property.property_name bname,
    property.price bprice,
    property_sold.total_amount atotal,
    property_sold.terms_of_payment aterms,
    property_sold.monthly_payment amonthly,
    property.image_path image_path
    FROM property_sold
    INNER JOIN property 
    ON property_sold.property_id = property.id      
    WHERE property_sold.customer_id = '$id'
    AND property_sold.deleted = 0";

 $result = mysqli_query($mysqli,$sql);

  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
      $property_sold_id = $row['aid'];
      $customer_id = $row['acid'];
      $property_id = $row['apid'];
      $property_name = $row['bname'];
      $property_price = $row['bprice'];
      $total_amount = $row['atotal'];
      $terms_of_payment = $row['aterms'];
      $monthly_payment = $row['amonthly'];
      //$image_path = getPropertyImage($property_id,$mysqli);
      $image_path = $row['image_path'];
     }
  }

?>
<div class="row">

        <div class="col-lg-7">
          <div class="card mb-3">
            <div class="card-header">               
               Customer Detail
            </div>

              <div class="card-body">

                <div style="margin-top: 1em;" class="card-footer small text-muted">Property bought</div>

                <div id="cart-changeable">
                  <div id="property-cart" class="property-bought jumbotron" >
                    <?php if($image_path == "no-image-land.png"){ ?>                     
                      <img src="../system-images/no-image-land.png" class="img-rounded" style="width:120px;"><br>
                     <?php }else{?>
                     <img src="../uploads/<?php echo $image_path; ?>" class="img-rounded" style="width:120px;"><br>
                     <?php } ?>
                      <span style="color: #ec880c;"> <?php echo $property_name;?><br></span>
                      <span >Php <?php echo $property_price; ?>.00<br></span>
                  </div>

                <div class="form-group"> 
                  <label class="radio-inline">
                    Total Amount: <?php echo $total_amount; ?>
                  </label> 
                </div>
              </div>
              <div class="form-group"> 
                <label>
                  Terms of Payment: <?php echo $terms_of_payment; ?> years
                </label>
            
              </div>
               <div class="form-group"> 
                <label>
                  Remaining Balance: Php <?php echo $balance ?>
                </label>                   
              </div>
              <hr>          
                          
              </div><!--card body -->

          </div>  
          <div class="property-bought jumbotron" id="documentOnHand">
           <div style="margin-top: 1em;" class="card-footer small text-muted">Document/s on hand</div>
             <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
              <tbody>  
              <?php
                  $sql = "SELECT 
                          customer_document_on_hand.id id,
                          uploads.file_name
                          FROM customer_document_on_hand
                          INNER JOIN uploads
                          ON customer_document_on_hand.uploads_id = uploads.id
                          WHERE customer_document_on_hand.customer_id = '$id'";

                  $result = mysqli_query($mysqli,$sql);

                    if (mysqli_num_rows($result) > 0) { 
                       echo '<tr>';
                       $x = 0;
                       while($row = mysqli_fetch_assoc($result)) {
                         $x++;
                        $file_name = $row['file_name'];
                        $path = UPLOAD_DIR.$file_name;
                        $default = '../system-images/default-file.png';
                        $documents_id = $row['id'];
                        
                         echo '<td>';
                         echo '<button class="file-trash btn" onclick="removeDocuments('.$documents_id.');"> <i class="fa fa-trash" aria-hidden="true" title="Remove this document"></i> </button>';

                         if(is_image($path)){
                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                        
                        echo '</td>';   

                        if($x == 2){
                          echo '</tr>';
                          echo '<tr>';
                          $x = 0;
                        }
                       
                       }
                       
                    }
               ?>
                </tbody>
              </table>
          </div>           
        </div>  


        <div class="col-lg-5">
          <div class="card mb-3">
            <div class="card-header">               
                 List of documents
            </div>
            <div class="card-body">
          
              <button id="transferDocuments"  class="btn btn-success issue-btn"><i class="fas fa-paste"></i> Issue selected Document/s</button>
              <input type="hidden" id="customer_id" value="<?php echo $id; ?>">
                <div class="card-body">
                  <div class="table-responsive">
                   <i style="font-size: 11px;">Select multiple documents by checking the checkbox in the right</i>
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                      <tbody> 

                       <?php
                          $sql = "SELECT uploads.id upid,file_name FROM uploads WHERE deleted = 0 AND property_id = '$property_id'";
                          $result = mysqli_query($mysqli,$sql);

                            if (mysqli_num_rows($result) > 0) { 
                               while($row = mysqli_fetch_assoc($result)) {
                                $file_name = $row['file_name'];
                                $path = UPLOAD_DIR.$file_name;
                                $default = '../system-images/default-file.png';
                                $upid = $row['upid'];
                                echo '<tr>';
                                echo '<td>';

                                 if(is_image($path)){
                                      echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                                  }else{
                                     echo '<img class="thumbs" src="'.$default.'" /><br>';
                                  }
                                echo '<span>'.$file_name.'</span>';  
                                echo '</td>';
                                echo '<td width="20%">';
                                echo '<input type="checkbox" class="check_list" name="check_list[]" value="'.$upid.'" />';
                                echo '</td>';
                                echo '</tr>';
                               }
                            }
                       ?>

                      </tbody>
                    </table>
                  </div>
                </div>               
              
            </div><!-- card body -->
          </div>  
        </div>

      </div><!-- row-->

<style type="text/css">
  input[type='checkbox'] {
   width: 30px;
  height: 30px;
  }
  input[type='checkbox']:checked {
      background: #abd;
      color: red !important;
  }
  .thumbs{
    width:200px !important;
  }
  .issue-btn{
    font-size: 14px;
  }
  .table .btn{
    pointer-events: unset !important;
  }
</style>
<script type="text/javascript">

  function removeDocuments(id){
      var document_id = id;            
      var customer_id = document.getElementById('customer_id').value;
     $.ajax({
        url: "../snippet/remove-legal-document.php",
        type: "post",
        data: { document_id : document_id, customer_id : customer_id },
        success: function(data) {       
          $('#documentOnHand').html(data);
        }
    });
  }

  $('#transferDocuments').click(function() {

     var customer_id = document.getElementById('customer_id').value;
     var list = new Array();
        $( "input[name='check_list[]']:checked" ).each( function() {
                list.push( $( this ).val() );
        } );
    
     $.ajax({
        url: "../snippet/transfer-documents.php",
        type: "post",
        data: { list : list,customer_id: customer_id },
        success: function(data) {
       $( ".check_list" ).prop( "checked", false );
        $('#documentOnHand').html(data);
        }
    });

  });


</script>