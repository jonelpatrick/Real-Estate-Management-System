<div class="gallery">  
<form action="searchLand.php" method="post"> 
	<div class="container" style="border-top:1px solid #eee; border-bottom: 1px solid #eee;">
	<br/>
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
																<input type="text" name="land_size_min" placeholder="Land Size From"  title="Minimum Land Size">  
														</div> 
												</div>
												<div class="col-md-2 col-xs-2 place-grid"> 
														<div class="keywords"> 
																<span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span>
																<input type="text" name="land_size_max" placeholder="Land Size To" >  
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
																<input type="text" name="price_min" placeholder="Price Min"   title="Minimum Price">  
															</div> 
												</div>
												<div class="col-md-2 col-xs-2 place-grid"> 
															<div class="keywords"> 
																<span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span>
																<input type="text" name="price_max" placeholder="Price Max"  title="Maximium Price">  
															</div> 
												</div>

												<div class="col-md-2 col-xs-4 place-grid"> 
													<input type="submit" value="Search"> 
												</div> 
												<div class="clearfix"></div> 
										</div> 
									</div>    
									<div class="clearfix"> </div>
							</div> 
</form>
</div> 