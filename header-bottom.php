<div class="header-top"> 
				<?php
				$sql="SELECT * FROM `aboutdetails`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
						while ($row = mysqli_fetch_assoc($result)){	
						echo '<div class="w3l_header_left" style="border:0;background: #fff">'; 
						echo '<ul>';
						echo '<li><a href="index.php" style="color: #000;"><img src="images/logo/logo5.png" style="width: 60%;"/></a></li>';
						echo '</ul>';
						echo '</div>';
						echo '<div class="w3l_header_right" style="border:0;margin-top: 10px;background: #fff;padding: 0.3em 0em 0.4em 12em;">';
						echo '<ul class="top-links">';
									echo '<li><a href="index.php" style="color: #666;">Home</a></li>';
									echo '<li><a href="aboutUs.php" style="color: #666;">About Us</a></li> ';
									echo '<li><a href="property.php" style="color: #666;">Property</a></li>';
									echo '<li><a href="gallery.php" style="color: #666;">Gallery</a></li>';
									echo '<li><a href="news.php" style="color: #666;">News and Updates</a></li>';
									echo '<li><a href="contactus.php" style="color: #666;">Contact Us</a></li>';
						echo '</ul>';
						echo '</div>';
						echo '<div class="clearfix"></div>';
				}
				}else{
					echo "No data Found";
				}  
				?>  
</div>