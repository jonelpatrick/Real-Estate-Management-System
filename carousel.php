
<div id="demo-1" data-zs-src='["images/gallery/5.jpg", "images/gallery/4.jpg", "images/gallery/10.jpg","images/gallery/11.jpg"]' data-zs-overlay="dots">
	<div class="demo-inner-content"> 
		 <div class="header-top">  	
						<div class="w3l_header_left" style="border:0;background: none;margin-top: 20px;">
						<ul>
						<li><a href="#" style="color: #000;"><img src="images/logo/logo5.png" style="width: 100%;"/></a></li>
						</ul>
						</div>
						<div class="w3l_header_right" style="border:0;margin-top: 20px;background: none;">
						<ul class="top-links">
									<li><a href="index.php" style="color: #fff;">Home</a></li>
									<li><a href="aboutUs.php" style="color: #fff;">About Us</a></li>
									<li><a href="property.php" style="color: #fff;">Property</a></li>
									<li><a href="gallery.php" style="color: #fff;">Gallery</a></li>
									<li><a href="news.php" style="color: #fff;">News and Updates</a></li>
									<li><a href="contactus.php" style="color: #fff;">Contact Us</a></li>
						</ul>
						</div>
						<div class="clearfix"></div>
			</div>
			<!--/banner-info-->
			   <div class="baner-info" style="margin-top: -70px;padding-bottom: 50px"> 
			   			 <h3>YOUR <span>PROPERTY</span> OUR <span>PRIORITY</span></h3>
			   			 <form action="searchLand.php" method="post" > 
							<div class="price-section" style=""> 
						     <div class="container">
						     	<div class="container keywords" > 
									<div class="place-grids">
											<div class="col-md-4 col-xs-4"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-road" aria-hidden="true"></span>
														<input type="text" name="city" placeholder="City" title="City">  
												</div> 
											</div>
											<div class="col-md-4 col-xs-4 place-grid"> 
												<div class="keywords"> 
														<span class="glyphicon glyphicon-send" aria-hidden="true"></span>
														<input type="text" name="address" placeholder="Specific Address (BRGY/STREET/PRK)" title="Specific Address (BRGY/STREET/PRK)">  
												</div> 
											</div>
											<div class="col-md-4 col-xs-4 place-grid"> 
												<div class="keywords">
													<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
													<select id="country1" name="typeofproperty" onchange="change_country(this.value)" class="frm-field required"> 
														<option value="1">Residential</option>
														<option value="2">Commercial</option>  
														<option value="0">Vacant Only</option> 	
													</select> 
												</div>
											</div>  
										</div>
									</div>
									<div class="container keywords" style="padding-bottom: 10px;"> 
										<div class="place-grids">
												<div class="col-md-2 col-xs-2 place-grid"> 
														<div class="keywords"> 
																<span class="glyphicon glyphicon-object-align-top" aria-hidden="true"></span>
																<input type="text" name="land_size_min" placeholder="Land Size From" title="Minimum Land Size">  
														</div> 
												</div>
												<div class="col-md-2 col-xs-2 place-grid"> 
														<div class="keywords"> 
																<span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span>
																<input type="text" name="land_size_max" placeholder="Land Size To">  
														</div> 
												</div>
												<div class="col-md-2 col-xs-2 place-grid">
													<div class="keywords">
															<span class="glyphicon glyphicon-compressed" aria-hidden="true"> </span>
															<select id="country3" name="land_unit" onchange="change_country(this.value)" class="frm-field required" title="Maximum Land Size"> 
																<option value="0">Square meter</option>         
																<option value="1">Hectar</option> 
															</select>
													</div>
												</div> 
												<div class="col-md-2 col-xs-2 place-grid"> 
															<div class="keywords"> 
																<span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span>
																<input type="text" name="price_min" placeholder="Price Min" title="Minimum Price">  
															</div> 
												</div>
												<div class="col-md-2 col-xs-2 place-grid"> 
															<div class="keywords"> 
																<span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span>
																<input type="text" name="price_max" placeholder="Price Max"  title="Maximium Price">  
															</div> 
												</div>

												<div class="col-md-2 col-xs-4 place-grid"> 
													<input type="submit" value="Search" name="submit" style="background: #f44336"> 
												</div> 
												<div class="clearfix"></div> 
										</div> 
									</div>    
									<div class="clearfix"> </div>
							</div> 
							 <h4>The Right Broker Makes all the Difference</h4>  
						</div> 
				 		</form>
				
				</div> 	
	</div>
</div> 
