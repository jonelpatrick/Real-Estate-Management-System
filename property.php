<?php 
require_once 'core/database/connect2.php';
?> 
<!DOCTYPE html>
<html>
<?php require_once 'head.php'; ?>
<body> 
<div class="top-main" id="home">
<?php require_once 'header-top.php'; ?> 
<?php require_once 'header-bottom.php'; ?> 
</div>
<style type="text/css">
	.demono li{
		width: 25%;
    	float: left;
	}
</style>
<?php require_once 'searchBar_filteredsearch.php'; ?>
	<div class="container" style="border-bottom: 1px solid #ddd;"> 
		<br/>
			<h4 class="tittle"> List of all <span>Properties</span></h4>
			<div class="">
				<ul class="clearfix demono"> 
						<?php 
							$sql="SELECT * FROM `property` WHERE deleted = 0 and availability = 0";   
							$result = mysqli_query($mysqli,$sql);
							$property_type = propertyType($row['property_type']);
							$size_unit = sizeUnit($row['size_unit']); 
							
							if(mysqli_num_rows($result) > 0 ){ 
								while ($row = mysqli_fetch_assoc($result)){ 
									echo '<li style="font-family: Calibri Light;">'; 
									echo '<form action="viewLand.php" method="POST">';
									$id = $row['id']; 
									$image_path = $row['image_path'];
									echo '<div class="gallery-grid1" style="border: 0px solid #ddd;border-radius: 5px;padding: 10px;">';
									 if($image_path != "no-image-land.png"){
			                            echo '<img src="rems/uploads/'.$image_path.'" style="width: 200px; height: 190px;">';
			                          }else{
			                            echo '<img src="rems/system-images/no-image-land.png" style="width: 200px; height: 190px;">';
			                          }
									echo '<br/>';
									echo '<h4 style="color: #7ac143;text-transform: UPPERCASE;">'.$row['property_name'].'</h4>';
									echo '<h5 style="text-transform: UPPERCASE;">'.$row['address'].'</h5>'; 
									echo '<h5 style="text-transform: UPPERCASE;">'.$row['city'] .' ' .$row['postal_code'].'</h5>';
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
<?php require_once 'footer.php'; ?> 
<a href="#home" id="toTop" class="scroll" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a> 
</body>
</html>

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
