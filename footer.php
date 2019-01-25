<?php
				$sql="SELECT * FROM `aboutdetails`";  
				$result = mysqli_query($mysqli,$sql);
				if(mysqli_num_rows($result) > 0 ){ 
				while ($row = mysqli_fetch_assoc($result)){
?>
<div class="contact-w3ls" id="contact">
		<div class="container">

		<!-- 	<h2>Sign up for our <span>Newsletter</span></h2>
			<p class="para">Get the freshest property listing, latest news and top real estate tips delivered straight to your inbox.</p>
			<div class="footer-contact">
				<form action="subscriberSend.php" method="post">
					<input type="text" name="emailaddress" placeholder="Enter your email to update" required=" ">
					<input type="submit" value="Subscribe">
				</form>
			</div> -->

			
			<div class="footer-grids w3-agileits">
				<div class="col-md-2 footer-grid">
				<ul>
						
						<li><a href="index.php">Home</a></li>
						<li><a href="aboutUs.php">About Us</a></li> 
						<li><a href="property.php">Property</a></li>
						<li><a href="gallery.php">Gallery</a></li> 
						<li><a href="news.php">News and Updates</a></li> 
						<li><a href="contactus.php">Contact Us</a></li>
					</ul>
				</div>
				<div class="col-md-4 footer-grid">
					<p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><?php echo $row['address']; ?></p>
					<p><a href="mailto:contact@example.com"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $row['email_address']; ?></a></p>
					<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo $row['phone_number']; ?></p>
				
					
				</div> 
				<div class="col-md-5 footer-grid">
					<div class="footer-grid" style="color: #999;"> 
					<div style="color: #eee;">WWW.DFMPVSINC.COM</div> 
					<?php echo $row['short_article'] ?>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<h3 class="text-center follow">Follow <span>Us</span></h3>
				<ul class="social-icons1 agileinfo">
					<li><a href="<?php echo $row['fb_link']?>"><i class="fa fa-facebook"></i></a></li>
					<li><a href="<?php echo $row['twitter_link']?>"><i class="fa fa-twitter"></i></a></li>
					<li><a href="<?php echo $row['in_link']?>"><i class="fa fa-linkedin"></i></a></li> 
					<li><a href="<?php echo $row['gplus_link']?>"><i class="fa fa-google-plus"></i></a></li>
				</ul>	
				<div class="w3agile_footer_copy">
				    <p>© 2018 Davao First Millenium Property Ventures Services, INC. All rights reserved.</p>
			</div>
     </div> 
</div>
<?php
		}
		}
			
?>