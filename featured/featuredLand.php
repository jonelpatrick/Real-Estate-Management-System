	<!-- 2nd Carousel -->
	<?php 
	$sql="SELECT * FROM `property` WHERE subject_to=1";  
	$result = mysqli_query($mysqli,$sql);
	?>
		<div class="col-md-6 plat">
		<div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="2000" data-pause="hover">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel1" data-slide-to="0"></li>
				<li data-target="#myCarousel1" data-slide-to="1"></li>
				<li data-target="#myCarousel1" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->	
			<div class="carousel-inner" role="listbox">
			<?php
			if(mysqli_num_rows($result) > 0 ){ 
				$property_type = propertyType($row['property_type']);
				$size_unit = sizeUnit($row['size_unit']);
				$x=0;
				while ($row = mysqli_fetch_assoc($result)){			
					if($x==0){ 
					echo '<div class="item active">'; 
					$x=1;
					}else{ 
					echo '<div class="item">';
					} 
				?> 
				<div class="serv-w3ls1"> 
							<img src="images/Lands/1.jpg" alt="w3ls" class="img-responsive">
						    <span class="four"><?php echo $property_type ?></span>
							<div class="rent-bottom">
									<input type="hidden" value="<?php echo $row['id']; ?>">
									<h4><?php echo $row['property_name']; ?></h4>
									<h5>Php <?php echo $row['price']; ?></h5>
									<p><?php echo $row['additional_info']; ?><p>
									<div class="rent-icons">
									  <h6 class="area"><?php echo $row['property_size'].' '.'<i>'.$size_unit.'</i>'?></h6>
									  <div class="r-icons">
										   <ul class="icons-right">
															<li><button class="btn btn-primary" type="submit">Visit Land</button> </li>
															 
											</ul>
									  </div>
									  <div class="clearfix"></div>
									</div>
							</div> 
				</div>	
				</div>
			<?php }} ?>
			
			</div>
		</div> 
	</div>

<?php 
function propertyType($type){
  $type = $type;

    switch ($type) {

      case 0:
        $type = "Vacant Land";
        break;

      case 1:
        $type = "Residential Land";
        break;

      case 2:
        $type = "Commercial Land";
        break;  

      default:
        $type = "Something went wrong";
        break;
    }

    return $type;

}

function sizeUnit($var){
   $var = $var;

    switch ($var) {

      case 0:
        $var = "Square meter";
        break;

      case 1:
        $var = "Hectare";
        break;

      default:
        $var = "Something went wrong";
        break;
    }

    return $var;
}
?>
	