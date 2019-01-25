<form action="addContact.php" method="post">

<div class="price-section" style="margin-top: -3em; background: #fff;">
     <div class="container">
         <div class="col-md-6 price" style="margin-top: -1em; background: #fff;">
				<h3><span>Contact Us</span></h3>
				<div class="reservation">
					<div class="section_room">
						<div class="keywords"> 
								<label>Full Name:</label>
								<input type="text" name="fullname"  required=" " class="form-control">  
						</div>
					</div>
					<div class="section_room" style="margin-top: 2px;">
						<div class="keywords"> 
								<label>Email Address:</label>
								<input type="email" name="email" required=" " class="form-control">  
						</div>
						<div class="section_room" style="margin-top: 2px;">
							<div class="keywords">  
									<label>Comments, Questions and Suggestion</label>
									<textarea name="comments" class="form-control" rows="10" class="form-control"></textarea>  
							</div>
						</div> 
						<br/>
						<input type="hidden" name="datecreated" value="<?php echo date('Y-m-d'); ?>">
						<div class="keywords"> 
								<input type="submit" value="Submit"> 
						</div>
					</div>
				</div>	 
			<div class="clearfix"> </div>
		</div>

		<div class="col-md-6 plat">    
			<img src="images/map.png" style="height: 500px;" alt="w3ls" class="img-responsive">  
		</div> 
	</div>
</div>
</form>