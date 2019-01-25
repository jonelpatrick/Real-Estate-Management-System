<?php 
require '../dbconnect/connect.php';
$id = $_GET['id'];	

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
	      price_bought,
	      price,
	      price_per_sqm,
	      block,
	      lot
	      FROM property 
	      WHERE id = '$id'";

	$result = mysqli_query($mysqli,$sql);
	if (mysqli_num_rows($result) > 0) { 
	 while($row = mysqli_fetch_assoc($result)) {
	 	$property_name  = $row['property_name'];
	 	$size 			= $row['property_size'];
	 	$address		= $row['address'];
	 	$city 			= $row['city'];
	 	$subject_to 	= $row['subject_to'];
	 	$date_commence 	= $row['date_management_commence'];
	 	$image_path 	= $row['image_path'];
	 	$size_unit		= $row['size_unit'];
	 	$price_bought 	= $row['price_bought'];
	 	$price_per_sqm	= $row['price_per_sqm'];
	 	$block			= $row['block'];
	 	$lot 			= $row['lot'];	
	 	$current_price	= $row['price']; 	

	 }
	}
	if($size_unit == 0){
		$size_unit = "Square meter";
	}else{
		$size_unit = "Hectare";
	}
 	if($block == 0){
 		$block = "";
 	}else{
 		$block = "Block ".$block;
 	}
 	if ($lot == 0){
 		$lot == "";
 	}else{
 		$lot == " Lot ".$lot;
 	}

	$prop_add = $block.' '.$lot.' '.$address.' '.$city;
?>
<div class="row">

<div class="col-sm-5" >
	<div>
		<?php
		 if($image_path != "no-image-land.png"){
		    echo '<img src="../uploads/'.$image_path.'" style="width: 100%; height: auto;">';
		  }else{
		    echo '<img src="../system-images/no-image-land.png" style="width: 100%; height: auto;">';
		  }
		?>
	</div>
	
</div>
<div class="col-sm-7" >
	<div class="row">
	
		<div class="col-sm-6" style="border-right: 1px solid rgba(0,0,0,0.1)">
			<div class="form-group">
				<label style="width: 100%;">Property Name:
				<span class="form-control"><?php echo $property_name; ?></span>
				</label>
			</div>
			<div class="form-group">
				<label style="margin-right: 0.5em;">Property Size:
				<span class="form-control"><?php echo $size; ?></span>
				</label>	
				<label>Size Unit:
				<span class="form-control"><?php echo $size_unit; ?></span>
				</label>			
			</div>
			<div class="form-group">
				<label style="width: 100%;">Date Commenced:
				<span class="form-control"><?php echo $date_commence; ?></span>
				</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label style="margin-right: 0.5em;">Price/sq.m:
				<span class="form-control">₱ <?php echo number_format($price_per_sqm); ?></span>
				</label>		
				<label>Price bought:
				<span class="form-control">₱ <?php echo number_format($price_bought); ?></span>
				</label>
			</div>
			<div class="form-group">
				<label style="width: 100%;">Selling Price:
				<span class="form-control">₱ <?php echo number_format($current_price); ?></span>
				</label>
			</div>
			<div class="form-group" >
				<label style="margin-right: 0.5em;width: 100%; ">Address:
					<textarea readonly="" class="form-control" style="height:100%;"><?php echo $prop_add; ?></textarea>
				</label>
			</div>
		</div>

	</div>
</div>
	
</div>
