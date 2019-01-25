<br/> 
<br/>
<?php
				$sql="SELECT * FROM `aboutdetails`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
						while ($row = mysqli_fetch_assoc($result)){
								echo '<div class="about">';
								echo '<div class="container">';
								echo '<div class="col-md-6 about-left">';
								echo '<h2 class="w3title">About Us</h2>'; 
								echo '<p>'.$row['full_article'].'</p>';
								echo '<br/>';
								echo '<h2 class="w3title">Services</h2>'; 
								echo '<p>'.$row['services'].'</p>';
								echo '</div>';
								echo '<div class="col-md-6 col-xs-4">';
								echo '<br/>';
								echo '<img src="images/logo/company-logo.png" class="img-responsive" alt=" ">';
								echo '</div>';
								echo '</div>';
								echo '</div>';

								echo '<div class="about">';
								echo '<div class="container">'; 
								echo '<center>';
								echo '<h2 class="w3title" style="text-align: center;">Organizational Chart</h2>'; 
								echo '<img src="images/orgchart.png" class="img-responsive" alt=" ">'; 
								echo '</center>';
								echo '</div>';  
								echo '</div>'; 

				}
			}else{
				echo "No data Found";
			}
?> 
<br/>
	<div class="about">
		<div class="container">   
				<!-- <img src="images/1.jpg" style="width:100%;"> -->
		</div>  
		 
 
	</div>
<br/>