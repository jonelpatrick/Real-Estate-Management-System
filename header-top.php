<div class="header-top"> 
				<?php
				$sql="SELECT * FROM `aboutdetails`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
						while ($row = mysqli_fetch_assoc($result)){	
						echo '<div class="w3l_header_left">'; 
						echo '<ul>';
						echo '<li><span class="fa fa-phone-square" aria-hidden="true"></span>'.$row['phone_number'].'</li>';
						echo '<li><span class="fa fa-map-marker" aria-hidden="true"></span>'.$row['address'].'</a></li>';
						echo '</ul>';
						echo '</div>';
						echo '<div class="w3l_header_right">';
						echo '<ul class="top-links">';
									echo '<li><a href="'.$row['fb_link'].'"><i class="fa fa-facebook"></i></a></li>';
									echo '<li><a href="'.$row['twitter_link'].'"><i class="fa fa-twitter"></i></a></li>';
									echo '<li><a href="'.$row['in_link'].'"><i class="fa fa-linkedin"></i></a></li>';
									echo '<li><a href="'.$row['gplus_link'].'"><i class="fa fa-google-plus"></i></a></li>'; 
									echo '<li><a href="mailto:'.$row['email_address'].'"><span class="fa fa-envelope" aria-hidden="true"></span> '.$row['email_address'].'</a></li>';
									echo '<li class="login-box"><a href="rems/login.php"><i class="fa fa-user"></i>Login</a></li>';
						 echo '</ul>';
						echo '</div>';
						echo '<div class="clearfix"></div>';
				}
				}else{
					echo "No data Found";
				}  
				?>  
</div>