<?php
				$sql="SELECT * FROM `aboutdetails`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
				while ($row = mysqli_fetch_assoc($result)){	
?>
<div class="team" id="team">
		     <div class="container">
			 <!--<h3 class="tittle">Our <span>Team </span></h3>-->
			 <!--/about-section-->
			   <div class="about-section agileits">
				<div class="col-md-7 ab-left">
				  <div class="grid">
			        <div class="h-f">
					<figure class="effect-jazz">
					<img src="images/garypaul.png" style="height: 350px"  alt="img25">
						<figcaption>
							<h4>GARY&nbsp;&nbsp;PAUL&nbsp;&nbsp;GARCIA</h4>
							<p>
							  President
							</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="h-f">
					<figure class="effect-jazz">
						<img src="images/JETRUDECENIZA.png" style="height: 350px" alt="img25">
						<figcaption>
							<h4>JETRUDE &nbsp;&nbsp;CENIZA</h4> 
							<p>
							  Vice President
							</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="clearfix"> </div>
				 </div>
			   </div>
			   <div class="col-md-5 ab-text">
			             <h4 class="tittle">About Us</h4>
						  <p><?php echo $row['short_article'] ?></p>
						   <div class="start">
						     <a href="aboutUs.php" >View More</a>
						  </div>

					</div>
					<div class="clearfix"> </div>
			 </div>
			  <!--//about-section-->
			  <!--/about-section2-->
			   <div class="about-section">
			        <div class="col-md-5 ab-text two">
			             <h4 class="tittle">OUR SERVICES</h4>
						 <p><?php echo $row['services'] ?></p>
						  <div class="start"> 
						  </div>

					</div>
						<div class="col-md-7 ab-left">
				  <div class="grid">
			        <div class="h-f">
					<figure class="effect-jazz">
					<img src="images/JOELSALONGA.png" style="height: 350px" alt="img25">
						<figcaption>
							<h4>JOEL &nbsp;&nbsp;SALONGA</h4> 
							<p>
							  Operation Manager
							</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="h-f">
					<figure class="effect-jazz">
						<img src="images/JohnyMonghit.png" style="height: 350px" alt="img25">
						<figcaption>
							<h4>Johny &nbsp;&nbsp;Monghit</h4> 
							<p>
							   Marketing Head
							</p>
						
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="clearfix"> </div>
				 </div>
			   </div>
					<div class="clearfix"> </div>
			 </div>
			  <!--//about-section2-->
			</div>
	     </div>
<?php
}
				}else{
					echo "No data Found";
				}  
				?>   