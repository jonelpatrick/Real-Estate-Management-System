
<?php 


if(isset($_POST['submit'])){
	$_SESSION['id2'] = $_POST['id'];
	$_SESSION['city2'] = $_POST['city'];
	$_SESSION['property_name2'] = $_POST['property_name'];	
	$_SESSION['address2'] = $_POST['address'];	
	$_SESSION['typeofproperty2'] = $_POST['typeofproperty'];
	$_SESSION['land_size2'] = $_POST['land_size']; 
	$_SESSION['price2'] = $_POST['price'];
	$_SESSION['postal2'] = $_POST['postal'];
	$_SESSION['addInfo2'] = $_POST['addInfo']; 

}

	echo $id2 = $_SESSION['id2'];
	$city = $_SESSION['city2'];
	$property_name = $_SESSION['property_name2'];
	$address = $_SESSION['address2'];
	$typeofproperty = $_SESSION['typeofproperty2'];
	$land_size = $_SESSION['land_size2']; 
	$price = $_SESSION['price2'];
	$postal = $_SESSION['postal2'];
	$addInfo = $_SESSION['addInfo2'];

/*
	echo $id2 . "<br/>";
	echo $city . "<br/>";
	echo $property_name . "<br/>";
	echo $address . "<br/>";
	echo $typeofproperty . "<br/>";
	echo $land_size . "<br/>";
	echo $price . "<br/>";
	echo $postal . "<br/>";
	echo $addInfo . "<br/>"; 
*/
	
include 'searchBar_filteredsearch.php';
?> 
<style type="text/css">
	#slideShowDev li{
		display: none;
	}
	#slideShowDev .first-child-me {
   		display: block !important;
	}
</style>

		<div class="container" style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;"> 
			<div class="col-md-4 col-xs-4 place-grid"> 
			<br/>   
					<ul class="clearfix demo " id="slideShowDev"> 
							<?php 
								$property_type = propertyType($row['property_type']);
								$size_unit = sizeUnit($row['size_unit']); 
							  echo '<h4 class="tittle" style="color: #7ac143;">'.$property_name.'</span></h4>';
								
								$sql2 = "SELECT 
								id,
								image_path							
								FROM property_gallery
								WHERE property_id = '$id2' 
								AND deleted = 0
								UNION
								SELECT 
								id,
								image_path								
								FROM property
								where id = $id2";
								$result2 = mysqli_query($mysqli,$sql2);
								$aw = 0;
							  if(mysqli_num_rows($result2) > 0 ){ 
							  	while ($row = mysqli_fetch_assoc($result2)){ 
							 		$image_path = $row['image_path']; 
							 		
							 		if($aw == 0){
							 			echo '<li class="first-child-me">';
							 		}else{
							 			echo '<li>';
							 		}							 
							 		$aw++;
									echo '<div class="gallery-grid1">';
									if (file_exists('rems/uploads/'.$image_path)) { 
										$path = 'rems/uploads/'.$image_path;	
										echo '<img src="'.$path.'" alt=" " class="img-responsive" style="width: 250px; height: 250px;"/>';
									}else if(file_exists('property-gallery/'.$image_path)){
										$path2 = 'property-gallery/'.$image_path;
										echo '<img src="'.$path2.'" alt=" " class="img-responsive" style="width: 250px; height: 250px;"/>';
									}
									echo '<div class="p-mask">';
									
								    
									echo '</div>';
									echo '</div>';
									echo '</li>';  
							 		
							 		/*
									 if($image_path != "no-image-land.png"){ 
									 	echo '<div class="mySlides">';
			                            echo '<img src="rems/uploads/'.$image_path.'" class="img-responsive" style="width: 100%;height: 250px;">';
			                             echo '</div>';
			                          }else{
			                            echo '<img src="rems/system-images/no-image-land.png">';
			                          }
			                          */
			                       
			                    }
			                   }
							 echo '<span style="margin-left: 90px;"><a href="">Click image to view other images</a></span>';	 
							  echo '<div class="gallery-grid1">';
							  echo '<br/>';
							  echo '<p style="font-size: 20px;font-family: Calibri Light;font-weight: Light;">Land Size: '.$land_size.'<i> '.$size_unit.'</i></p>';
							  echo '<p style="font-size: 20px;font-family: Calibri Light;font-weight: Light;">Property Type: '.$property_type.'</p>';
							  echo '<p style="font-size: 20px;font-family: Calibri Light;font-weight: Light;">Address: '.$address.', ' .$city .' ' .$postal .'</p>';
							  echo '<p style="font-size: 20px;font-family: Calibri Light;font-weight: Light;">Price: P '.$price.'</p>';
							  echo '<br/>';
							  echo '<p style="font-size: 20px;font-family: Calibri Light;font-weight: Light;">'.$addInfo.'</p>';
							  echo '</div>';
							  echo "<br/>";
							?>
					</ul>   
			</div>
			<div class="col-md-7">   
				<br/>  
				<h4 class="tittle" style="color: #444;">ASK ABOUT THE PROPERTY</h4>
				<div class="reservation"> 

					<div class="keywords" style="padding-bottom: 10px;"> 
						<div class="place-grids">
						<form action="add_reference.php" method="POST">  
						<?php
						 	  $sql2 = "SELECT 
                              id
                              FROM reference_number ORDER BY id DESC LIMIT 1";
                      		  $result2 = mysqli_query($mysqli,$sql2);   
                      		  if(mysqli_num_rows($result2) > 0 ){ 
	                       		while($row = mysqli_fetch_assoc($result2)) {  
			                          $id = $row['id']+1;    

			                          echo "<input type='hidden' name='pid' value='".$id2."' />";
			                          echo "<input type='hidden' name='ref_num' value='".$id."' />";
		                          	  echo '<h3>Reference Number:R-'.$id.'</h3><h4>Save/Copy this reference number for your future inquery.</h4>';
		                         	}
	                         	}else{
	                         	  $id = "1";
	                         	  echo "<input type='hidden' name='pid' value='".$id2."' />";
		                          echo "<input type='hidden' name='ref_num' value='".$id."' />";
	                          	  echo '<h3>Reference Number:R-'.$id.'</h3><h4>Save/Copy this reference number for your future inquery.</h4>';
	                         	}  
	                         	?>
												<br/>
											<div class="col-md-6 col-xs-4"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
														<input type="text" name="firstname" placeholder="First Name" required=" " title="First Name">  
												</div> 
											</div>
											<div class="col-md-6 col-xs-4 place-grid"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
														<input type="text" name="surname" placeholder="Surname" required=" " title="Surname">  
												</div> 
											</div>  
											<div class="col-md-6 col-xs-4"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
														<input type="text" name="contact" placeholder="Contact Number" required=" " title="Contact Number">  
												</div> 
											</div>
											<div class="col-md-6 col-xs-4 place-grid"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
														<input type="text" name="email" placeholder="Email Address" required=" " title="Email Address">  
												</div> 
											</div>   
											<input type="hidden" name="date_created" value="<?php echo date('Y-m-d'); ?>">
													<input type="submit" value="MAKE AN APOINTMENT" style="width: 100%;">  
											<div class="clearfix"></div>
						</form>
						</div>
					</div>
					
				</div>   
			<br/>
		</div>  
		</div> 
	<?php include 'land-also-like.php'; ?>	
</div>  
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

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
