<?php  
session_start();
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
<?php
								echo '<div class="about">';
								echo '<div class="container">'; 
								echo '<br/>';
								echo '<h2 class="w3title">NEWS AND UPDATES</h2>';  

				$sql="SELECT * FROM `news_updates`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
						while ($row = mysqli_fetch_assoc($result)){ 
								
								echo '<div style="border-top: 1px solid #ddd;";>';
								echo '<h3 style="margin-top: 10px;color: #099a4a;">'.$row['news_title'].'</h3>';
								echo '<p style="font-size: 15px;">'.$row['news_description'].'</p>';
								echo '<i><p>Date Created: '.$row['news_created'].'</p></i>';
								echo '</div>';
								echo '<br/>'; 

				}
			}else{
								echo '<div class="about">';
								echo '<div class="container">';
								echo '<div class="col-md-6 about-left">';
								echo '<h2 class="w3title">NEWS AND UPDATES</h2>'; 
								echo '<p>No News and Updates</p>';
								echo '<br/>'; 
								echo '</div>';  
			}

								echo '</div>'; 
								echo '</div>';  
?> 
<?php require_once 'footer.php'; ?> 
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
 </body>
</html>