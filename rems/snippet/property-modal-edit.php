<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';

define("UPLOAD_DIR", "../uploads/");

 $link_id = $_GET['id'];
 $sql = "SELECT 
        
        `client_id`, 
        `property_relation`,
        `date_management_commence`, 
        `property_name`,
        block,
        lot,
        `address`, 
        `city`,
        `postal_code`, 
        `property_size`, 
        `subject_to`,
        price_per_sqm,
        `price`,
         size_unit,
        `payment_mode`, 
        `monthly_payment`,
        `property_type`,
        `caretaker`, 
        `additional_info`,
         firstname,
         middlename,
         lastname,
         property_condition,
         price_bought,
         property.image_path image_path
        FROM `property` 
        INNER JOIN client ON
        property.client_id = client.id WHERE property.deleted = 0 AND property.id = '$link_id'";

    $result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    

        while($row = mysqli_fetch_assoc($result)) {

        	$client_id = $row['client_id'];
        	$property_relation = $row['property_relation'];
        	$date_commence = $row['date_management_commence'];
        	$property_name = $row['property_name'];
        	$address = $row['address'];
        	$city = $row['city'];
        	$postal_code = $row['postal_code'];
        	$property_size = $row['property_size'];
        	$subject_to = $row['subject_to'];
        	$price = $row['price'];
        	$size_unit = $row['size_unit'];
        	$payment_mode = $row['payment_mode'];
        	$monthly_payment = $row['monthly_payment'];
        	$property_type = $row['property_type'];
        	$caretaker = $row['caretaker'];
        	$additional_info = $row['additional_info'];
        	$condition = $row['property_condition'];
          $price_bought = $row['price_bought'];
          $image_path = $row['image_path'];
          $block = $row['block'];
          $lot = $row['lot'];
          $price_per_sqm = $row['price_per_sqm'];
        	
        }
    }
   

?>
<form method="POST" action="../cli/functions.php" enctype="multipart/form-data">

 	<div class="modal-body">

 	 <div class="row">       
        <div class="col-lg-6">
         
         <input type="hidden" name="property_id" value="<?php echo $link_id; ?>">
         <input type="hidden" name="action" value="updateproperty" >
          
          <div class="card mb-3">
            <div class="card-header">
             Property Information
            </div>
            <div class="card-body">            
            <div class="form-group inline-layout">  
<!--
             <input class="editable-select" list="client" name="client_id" placeholder="Select Client here" onchange="getInfo(this)" />
                <datalist id="client">
                  <?php
                      $sql = "SELECT id,firstname,middlename,lastname FROM client WHERE deleted = 0 AND status = 0";
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
               -->
              <label class="radio-inline attach-property-label">Select Client: </label> 

              <select class="custom-select radio-inline" name="client_id" style="display: inline;">
                  <?php
                    $sql = "SELECT id,firstname,middlename,lastname FROM client WHERE deleted = 0 AND status = 0";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $id  = $row['id'];

                          if($client_id == $id){
                          	echo '<option value="'.$id.'" selected>'.$name.'</option>';
                          }else{
                          	echo '<option value="'.$id.'">'.$name.'</option>';
                          }
                          
                         }
                      }
                  ?>                    
              </select>
           
            </div>
              <div class="form-group">
                <label >Relation to the property: </label><br>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="radioRelationProperty" value="0" <?php if($property_relation == 0){ echo "checked"; } ?> > Owner
                </label>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="radioRelationProperty" value="1" <?php if($property_relation == 1){ echo "checked"; } ?> > Board Member
                </label>
                 <label class="form-control" style="border: none;">
                  <input type="radio" name="radioRelationProperty" value="2" <?php if($property_relation == 2){ echo "checked"; } ?> > Developer
                </label>

              </div>
              <div class="form-group">   
                <label>Date Management to Commence:</label>
                <input class="form-control" data-date-format="yyyy-mm-dd" id="datepicker2" name="dateManagement" value="<?php echo $date_commence;?>">
              </div> 
              <div class="form-group">   
                <label>Property Name:</label>
                <input class="form-control" type="text" name="property_name" value="<?php echo $property_name; ?>">
              </div> 
              <!--upload property iamge -->
                <div class="form-group" style="width:100%;">
                  <?php 
                   //check if image is default
                  if($image_path == 'no-image-land.png'){
                    echo '<img id="img-upload" style="height: 300px;" src="../system-images/'.$image_path.'" />';
                  }else{
                    echo '<img id="img-upload" style="height: 300px;" src="../uploads/'.$image_path.'" />';
                  }
                  ?>                                      
                    <div class="input-group addborder">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp" name="image">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>                    
                </div>                 
                <!--upload property iamge -->

                 <!-- if subdevided lot-->
               <i class="text-muted small">Fill up if subdevided lot</i>
              <div class="form-group jumbotron" style="text-align: center;">

                <label>Block: 
                  <input type="text" name="propBlock" class="form-control" placeholder="value numeric" value="<?php echo $block; ?>">
                </label>
                <label>Lot: 
                  <input type="text" name="propLot" class="form-control" placeholder="value numeric" value="<?php echo $lot; ?>">
                </label>
                </div>
                
              <div class="form-group">   
                <label>Address:[Purok,Street,Brgy,]</label>
                <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
              </div> 
              <div class="form-group">   
                <label>City</label>
                <input class="form-control" type="text" name="city" value="<?php echo $city; ?>">
              </div> 
              <div class="form-group">   
                <label>Postal Code:</label>
                <input class="form-control" type="text" name="postal_code" value="<?php echo $postal_code; ?>">
              </div> 
              <div class="form-group">   
                <label>Property Size:</label><br>
                <input id="propertySize" class="form-control radio-inline" type="Number" name="property_size" style="width: 40%;display: inline;" value="<?php echo $property_size; ?>">
                 <select id="sizeUnit" class="custom-select radio-inline" name="size_unit" style="width: 58%;display: inline;">
                 <option value="0" <?php if($size_unit == 0){ echo 'selected';} ?> >Square meter</option>    
                 <option value="1" <?php if($size_unit == 1){ echo 'selected';} ?> >Hectare</option>    
              </select>
              </div> 
              <div class="form-group">
                <label >Subject to: </label><br>
                <label class="form-control" style="border: none;">
                  <input id="forSale" type="radio" name="subject_to" value="0" <?php if($subject_to == 0){ echo 'checked';} ?> > For Sale
                </label>               

              </div>
              <div class="borderme">
                <div class="form-group" id="sale">   
                 <label>Price per Sq.m. </label>
                  <input id="pricePerSqm" class="form-control radio-inline" type="Number" name="price_per_sqm" style="display: inline;width:30%;" placeholder=" 0.00" onkeyup="javascript:calculateBoughtPrice()" value="<?php echo $price_per_sqm; ?>"><br>                           
                  <label>Price bought</label>
                  <input id="input_price_bought" class="form-control radio-inline" type="text" name="price_bought" style="display: inline;width:30%;" value="<?php echo $price_bought; ?>" readonly>
                  <br>
                  <label class="radio-inline" style="margin-top: 1em;">Terms of payment </label>
                  <select onchange="calculate(this.value);" class="custom-select radio-inline" name="payment_mode" style="display: inline;width:50%;">
                    <option value="0" <?php if($monthly_payment == 0){ echo "selected";} ?> >One time payment</option>           
                    <option value="1" <?php if($payment_mode == 1){ echo "selected";} ?> >1 year</option>           
                    <option value="2" <?php if($payment_mode == 2){ echo "selected";} ?> >2 years</option>           
                    <option value="3" <?php if($payment_mode == 3){ echo "selected";} ?> >3 years</option>           
                    <option value="4" <?php if($payment_mode == 4){ echo "selected";} ?> >4 years</option>           
                    <option value="5" <?php if($payment_mode == 5){ echo "selected";} ?> >5 years</option>           
                    <option value="6" <?php if($payment_mode == 6){ echo "selected";} ?> >6 years</option>           
                    <option value="7" <?php if($payment_mode == 7){ echo "selected";} ?> >7 years</option>           
                    <option value="8" <?php if($payment_mode == 8){ echo "selected";} ?> >8 years</option>           
                    <option value="9" <?php if($payment_mode == 9){ echo "selected";} ?> >9 years</option>           
                    <option value="10" <?php if($payment_mode == 10){ echo "selected";} ?> >10 years</option>           
                  </select>
                </div> 
                <div class="form-group" id="rent">                                 
                  <label>Monthly Payment</label>
                  <input id="input_monthly_payment" class="form-control radio-inline" type="text" name="monthly_payment" style="display: inline;width:30%;" value="<?php echo $monthly_payment; ?>">
                </div>
                <div class="form-group" id="rent">                                 
                  <label>Retail Price </label>
                  <input class="form-control radio-inline" type="text" name="price" style="display: inline;width:30%;" value="<?php echo $price; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">
             Additional information
            </div>
            <div class="card-body">
            <input type="hidden" name="condition" value="0">
            <!--
               <div class="form-group">
                <label >Property Condition: </label><br>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="condition" value="0" <?php if($condition == 0){ echo "checked";} ?> > Good
                </label>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="condition"  value="1" <?php if($condition == 1){ echo "checked";} ?> > Bad
                </label>
                 <label class="form-control" style="border: none;">
                  <input type="radio" name="condition"  value="2" <?php if($condition == 2){ echo "checked";} ?> > Repaired
                </label>

              </div>
            -->

              <div class="form-group">
                <label >Property Type: </label><br>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="property_type" value="0" <?php if($property_type == 0){ echo "checked";} ?>> Vacant Land
                </label>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="property_type"  value="1" <?php if($property_type == 1){ echo "checked";} ?> > Residential Property
                </label>
                 <label class="form-control" style="border: none;">
                  <input type="radio" name="property_type"  value="2" <?php if($property_type == 2){ echo "checked";} ?> > Commercial Property
                </label>

              </div>
              <input type="hidden" name="caretaker" value="0">
              <!--
              <div class="form-group">
                <label>Is there an onsite caretaker or any direct employee?: </label><br>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="caretaker" value="0" <?php if($caretaker == 0){ echo "checked";} ?> > Yes
                </label>
                <label class="form-control" style="border: none;">
                  <input type="radio" name="caretaker"  value="1" <?php if($caretaker == 1){ echo "checked";} ?> > No
                </label>                 
              </div>
              -->
               <div class="form-group">
                <label>Additional information/comments: </label><br>
                <textarea class="form-control" name="additional_info" rows="10"><?php echo $additional_info; ?></textarea>
              </div>
          

             
            </div>
          </div>
        </div>
      </div><!--row -->
  
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	  <button  type="submit" class="btn btn-primary">Save changes</button>           
	</div>
</form> 

<script type="text/javascript">23
	 $('#datepicker2').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
  $('#datepicker2').datepicker("setDate", new Date());

  function calculate(val){
   var total = parseInt(document.getElementById("input_price_bought").value);
   var terms = 12 * (parseInt(val));
   var result = total / terms ;
    
   $('#input_monthly_payment').val(result);
}
 function calculateBoughtPrice(){
    
    var size        = Number($('#propertySize').val());
    var unit        = Number($('#sizeUnit').val());
    var pricePerSqm = Number($('#pricePerSqm').val());
    var result = 0;
   
    if(unit == 1){
      size *= 1000;
    }

    result = size * pricePerSqm;
    $("#input_price_bought").val(result);

}

</script>
