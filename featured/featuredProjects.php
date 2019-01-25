<!-- Recently Added -->
<?php  
 	$sql="SELECT * FROM `property` WHERE deleted=0 and availability = 0";  
	$result = mysqli_query($mysqli,$sql);
?>
<div class="featured-section">
  <div class="container">
		<h4 class="tittle"> New <span>Listings</span></h4>
			<div class="content-bottom-in" > 
					<ul id="flexiselDemo1"> 
					<?php 
					while ($row = mysqli_fetch_assoc($result)){		 
						$property_type = propertyType($row['property_type']);
						$size_unit = sizeUnit($row['size_unit']);
						echo '<li>';
						echo '<div class="project-fur">';
									echo '<form action="viewLand.php" method="POST">'; 
									 $image_path = $row['image_path']; 
									 if($image_path != "no-image-land.png"){
			                            echo '<img src="rems/uploads/'.$image_path.'"" class="img-responsive" style="height: 250px;">';
			                          }else{
			                            echo '<img src="rems/system-images/no-image-land.png" style="height: 250px;">';
			                          }
									echo '<div class="fur">';
									echo '<div class="fur1">';
		                            echo '<h5><span class="fur-money">P '.$row['price'].'</span></h5>';
		                            echo '<h6 class="fur-name"><a href="#" data-toggle="modal" data-target="#myModal1">'.$row['property_name'].'</a></h6>';
		                            if (strlen($row['address']) <=35) {
		                           	echo '<span>'.$row['address'].', '.$row['city'].'</span>';
		                           	}else{
		                           		echo '<span>'.substr($row['address'], 0, 35) . '...' .'</span>';
		                           	} 
                               		echo '</div>';
                               		echo '</div>';
			                        echo '<div class="fur2">';  
										echo '<div class="rent-icons" style="margin-top: -1em;">';
										echo '<h6 class="area">'.$row['property_size'].' '.'<i>'.$size_unit.'</i></h6>';
										echo '<div class="r-icons">';
										echo '<ul class="icons-right"  style="margin-bottom: 50px;">';
										echo '<li><input name="submit" class="btn btn-primary" type="submit" value="View Land Details"/></li>';
										echo "<br/>";
										echo '</ul>';
										echo '</div>';
										echo '</div>';
									echo '</div>';
									echo "<br/>";
									echo '<div class="clearfix"></div>';

									echo '<input type="hidden" name="id" value="'.$row['id'].'"/>'; 
									echo '<input type="hidden" name="property_name" value="'.$row['property_name'].'"/>'; 
									echo '<input type="hidden" name="address" value="'.$row['address'].'"/>'; 
									echo '<input type="hidden" name="typeofproperty" value="'.$row['subject_to'].'"/>';
									echo '<input type="hidden" name="land_size" value="'.$row['property_size'].'"/>'; 
									echo '<input type="hidden" name="size_unit" value="'.$row['size_unit'].'"/>'; 
									echo '<input type="hidden" name="price" value="'.$row['price'].'"/>';
									echo '<input type="hidden" name="city" value="'.$row['city'].'"/>'; 
									echo '<input type="hidden" name="postal" value="'.$row['postal_code'].'"/>'; 
									echo '<input type="hidden" name="addInfo" value="'.$row['additional_info'].'"/>';   
									echo '</form>'; 						
						echo '</div>';
						echo '</li> ';  
					} 
					?>
					<br/>
					</ul>		
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