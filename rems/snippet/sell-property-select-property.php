  <?php
  include '../cli/global-functions.php';

   $id = $_GET['id'];
   $sql = "SELECT id,property_name,price,property_condition,image_path FROM property WHERE id= '$id'";
     $result = mysqli_query($mysqli,$sql);
      if (mysqli_num_rows($result) > 0) { 
         while($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $name = $row['property_name'];                              
          $price = $row['price'];          
          //$image_path = getPropertyImage($id,$mysqli);
          $image_path = $row['image_path'];
      }
  }
  ?>
    <div id="property-cart" class="property-bought jumbotron" >
                               
	  <div class="selected-property">  

	  	  <a class="delete-icon" onclick="removeProp();"><i class="fa fa-trash" aria-hidden="true" title="Remove"></i></a>
	  	   <?php if($image_path == "no-image-land.png"){ ?>
	  	  	<img src="../system-images/no-image-land.png" class="img-rounded"><br>
	  	  <?php }else{ ?>
	  	  	<img src="../uploads/<?php echo $image_path; ?>" class="img-rounded"><br>
	  	  <?php } ?>
		  
		  <span style="color: #ec880c;"> <?php echo $name;?><br></span>
		  <span > ₱ <?php echo number_format($price); ?><br></span>
	  </div>
	</div>
	  <div class="form-group"> 
	    <label class="radio-inline">
	      Total Amount:<span id="totalAmount2" class="total-amount"> ₱ <?php echo number_format($price); ?></span>
	    </label> 
	  </div>
    <input type="hidden" name="total_amount" id="totalAmount" value="<?php echo $price; ?>">
  <style type="text/css">
  	a.delete-icon{
		color: red;
		background: none;
		border: none;
		float: right;	
	}
	a.delete-icon i{
		color: red;
	}
  </style>