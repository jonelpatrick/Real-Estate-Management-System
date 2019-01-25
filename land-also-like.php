<style type="text/css">
	.demono li{
		width: 25%;
    	float: left;
	}
</style>
<div class="container" style="border:0;"> 
			<br/><br/>
			<h4 class="tittle"> Land you may also like</h4>
			<div class="agile_gallery_grids w3-agile" >
				<ul class="clearfix demono" > 
						<?php  
							$sql="SELECT * FROM `property` WHERE city LIKE '%$city%' and  deleted = 0 and availability = 0";  
							$result = mysqli_query($mysqli,$sql);
							$property_type = propertyType($row['property_type']);
							$size_unit = sizeUnit($row['size_unit']);
							if(mysqli_num_rows($result) > 0 ){   
								while ($row = mysqli_fetch_assoc($result)){  
									echo '<li style="font-family: Calibri Light;">'; 
									echo '<div class="gallery-gridno" style="border: 0px solid #ddd;border-radius: 5px;padding: 10px;">';
									$image_path = $row['image_path']; 
									 if($image_path != "no-image-land.png"){
			                            echo '<img src="rems/uploads/'.$image_path.'" style="width: 200px; height: 190px;cursor: context-menu">';
			                          }else{
			                            echo '<img src="rems/system-images/no-image-land.png" style="width: 200px; height: 190px;cursor: context-menu>';
			                          }
									echo '<br/>';
									echo '<h4 style="color: #7ac143;text-transform: UPPERCASE;">'.$row['property_name'].'</h4>';
									 if (strlen($row['address']) <=23) {
		                           		echo '<h5 style="text-transform: UPPERCASE;">'.$row['address'].', ' .$row['city'].'</h5>'; 
									}else{
		                           		echo '<h5 style="text-transform: UPPERCASE;">'.substr($row['address'], 0, 23) . '...' .'</h5>';
		                           	}
									echo '<h5 style="text-transform: UPPERCASE;">'.$property_type.'</h5>';
									echo '<h5 style="text-transform: UPPERCASE;">P '.$row['price'].'</h5>';  
									echo '<form action="viewLand.php" method="POST">'; 
									echo '<input type="hidden" name="id" value="'.$row['id'].'"/>';
									echo '<input type="hidden" name="city" value="'.$row['city'].'"/>';
									echo '<input type="hidden" name="address" value="'.$row['address'].'"/>';
									echo '<input type="hidden" name="property_name" value="'.$row['property_name'].'"/>';
									echo '<input type="hidden" name="typeofproperty" value="'.$row['property_type'].'"/>';
									echo '<input type="hidden" name="price" value="'.$row['price'].'"/>';
									echo '<input type="hidden" name="land_size" value="'.$row['property_size'].'"/>';
									echo '<input type="hidden" name="postal" value="'.$row['postal_code'].'"/>';
									echo '<input type="hidden" name="addInfo" value="'.$row['additional_info'].'"/>';
									echo '<br/>';
									echo '<input name="submit" class="btn btn-primary" type="submit" value="View Land Details"/>';
									echo "</form>";
									echo '</div>';
									echo '</li>';
									    
									
								}
								
							}else{ 
								echo "<h5><b>Sorry we cannot found a land you've searching.</b></h5>";
							}	
 
						?> 
				</ul> 
			</div> 
		</div>