<?php  
	
	if(isset($_POST['submit'])){
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['typeofproperty'] = $_POST['typeofproperty'];
		$_SESSION['land_size_min'] = $_POST['land_size_min'];
		$_SESSION['land_size_max'] = $_POST['land_size_max'];
		$_SESSION['land_unit'] = $_POST['land_unit'];
		$_SESSION['price_min'] = $_POST['price_min'];
		$_SESSION['price_max'] = $_POST['price_max']; 
	}

	$city = $_SESSION['city'];
	$address = $_SESSION['address'];
	$typeofproperty = $_SESSION['typeofproperty'];
	$land_size_min = $_SESSION['land_size_min'];
	$land_size_max = $_SESSION['land_size_max'];
	$land_unit = $_SESSION['land_unit'];
	$price_min = $_SESSION['price_min'];
	$price_max = $_SESSION['price_max']; 


/*
	echo $city.'<br>';
	echo $address.'<br>';
	echo $typeofproperty.'<br>';
	echo $land_size_min.'<br>';
	echo $land_size_max.'<br>';
	echo $land_unit.'<br>';
	echo $price_min.'<br>';
	echo $price_max.'<br>';
*/

 include 'searchBar_filteredsearch.php';
?>
		<div class="container" style="border-bottom: 1px solid #ddd;"> 
		<br/>
			<h4 class="tittle"> Search <span>Land...</span></h4>
			<div class="">
				<ul class="clearfix demo"> 
						<?php  
							$sql="SELECT * FROM `property` WHERE city LIKE '%$city%' and address LIKE '%$address%' and property_type LIKE '%$typeofproperty%' and property_size BETWEEN '$land_size_min' and '$land_size_max' and size_unit LIKE '%$land_unit%' and price BETWEEN '$price_min' and '$price_max' and availability = 0 and deleted=0"; 
						 
							$result = mysqli_query($mysqli,$sql);
							$property_type = propertyType($row['property_type']);
							$size_unit = sizeUnit($row['size_unit']); 
							if(mysqli_num_rows($result) > 0 ){ 
								while ($row = mysqli_fetch_assoc($result)){ 
									echo '<li style="font-family: Calibri Light;">'; 
									echo '<form action="viewLand.php" method="POST">';
									$id = $row['id']; 
									echo '<div class="gallery-grid1" style="border: 0px solid #ddd;border-radius: 5px;padding: 10px;">';
									echo '<img src="images/lands/1.jpg" alt=" " class="img-responsive" style="width: 250px; height: 250px;"/>';
									echo '<br/>';
									echo '<h4 style="color: #7ac143;text-transform: UPPERCASE;">'.$row['property_name'].'</h4>';
									echo '<h5 style="text-transform: UPPERCASE;"> ADDRESS: '.$row['address'].', ' .$row['city'].'</h5>'; 
									echo '<h5 style="text-transform: UPPERCASE;">'.$property_type.'</h5>';
									echo '<h5 style="text-transform: UPPERCASE;">P '.$row['price'].'</h5>';    
									echo '<br/>';
									echo '<input name="submit" class="btn btn-primary" type="submit" value="View Land Details"/>';
									echo '</li>';

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
								}
							}else{ 
								echo "<h5><b>Sorry we cannot found a land you've searching.</b></h5>";
							}	
 							
						?>
				</ul>  
		</div> 
		<br/>
		</div>
		<?php include 'land-also-like.php'; ?>
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
				