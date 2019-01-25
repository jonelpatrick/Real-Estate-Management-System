<?php
define("UPLOAD_DIR_GAL", "rems/gallery/"); 

$sql = "SELECT 
      id,
      title,
      description,
      img
      FROM gallery";
$result = mysqli_query($mysqli,$sql); 
?>                     
<div class="gallery agile" id="gallery" style="background: #fff;border-top: 1px solid #eee">
		<div class="container">
			<h3 class="tittle" style="margin-top: -0.6em;text-align: center"> Our <span>Gallery</span></h3>
			<div class="agile_gallery_grids w3-agile" style="margin-top: 0.5em;">
				<ul class="clearfix demo">
				<?php 
				 if (mysqli_num_rows($result) > 0) { 
                      	while($row = mysqli_fetch_assoc($result)) { 
                          $id = $row['id'];
                          $title = $row['title'];
                          $description = $row['description'];
                          $img = $row['img'];

                          $path = UPLOAD_DIR_GAL.$img; 
                          $default = '../system-images/default-file.png';   
							 echo '<li>';
							 echo '<div class="gallery-grid1">';
							 echo '<img src="'.$path.'" alt=" " class="img-responsive" style="width: 250px; height: 250px;"/>';
								echo '<div class="p-mask">';
									echo '<h4>'.$title.'</h4>';
								    echo '<p>'.$description.'</p>';
								echo '</div>';
							echo '</div>';
						echo '</li>';  
						} 
	                  }else{
	                  	echo "No image found!";
	                  }
				?>
				</ul>
			</div>
		</div>
	</div>