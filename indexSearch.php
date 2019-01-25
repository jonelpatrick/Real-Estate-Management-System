 <div class="price-section" style="margin-top:-3em;background: #eee;">
     <div class="container">
          <div class="container keywords" > 
			<div class="place-grids">
				<form action="searchLand.php" method="post"> 
					<div class="col-md-4 col-xs-4"> 
						<div class="keywords"> 
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
								<input type="text" name="city" placeholder="City" required=" ">  
						</div> 
					</div>
					<div class="col-md-4 col-xs-4 place-grid"> 
						<div class="keywords"> 
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
								<input type="text" name="address" placeholder="Specific Address (BRGY/STREET/PRK)" required=" ">  
						</div> 
					</div>
					<div class="col-md-4 col-xs-4 place-grid"> 
						<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						<select id="country1" name="typeofproperty" onchange="change_country(this.value)" class="frm-field required"> 
							<option value="1">Residential</option>
							<option value="2">Commercial</option>  
							<option value="0">Vacant Only</option> 	
						</select> 
					</div>  
			</div>
		</div>
		<div class="container keywords" style="padding-bottom: 10px;"> 
			<div class="place-grids">
					<div class="col-md-2 col-xs-4 place-grid"> 
							<div class="keywords">
								<span class="fa fa-bed" aria-hidden="true"> </span> 
									<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
									<input type="text" name="land_size_min" placeholder="Land Size From" required=" ">  
							</div> 
					</div>
					<div class="col-md-2 col-xs-4 place-grid"> 
							<div class="keywords">
								<span class="fa fa-bed" aria-hidden="true"> </span> 
									<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
									<input type="text" name="land_size_max" placeholder="Land Size To" required=" ">  
							</div> 
					</div>
					<div class="col-md-2 col-xs-4 place-grid">
						<div class="keywords">
								<span class="fa fa-wheelchair-alt" aria-hidden="true"> </span>
								<select id="country3" name="land_unit" onchange="change_country(this.value)" class="frm-field required"> 
									<option value="0">Square meter</option>         
									<option value="1">Hectar</option> 
								</select>
							</div>
					</div> 
					<div class="col-md-2 col-xs-4 place-grid"> 
								<div class="keywords"> 
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
								<input type="text" name="price_min" placeholder="Price Min" required=" ">  
								</div> 
					</div>
					<div class="col-md-2 col-xs-4 place-grid"> 
								<div class="keywords"> 
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
								<input type="text" name="price_max" placeholder="Price Max" required=" ">  
								</div> 
					</div>

					<div class="col-md-2 col-xs-4 place-grid"> 
						<input type="submit" value="Search"> 
					</div> 
					<div class="clearfix"></div>
				</form>
			</div>
		</div>  
	<div class="clearfix"> </div>
	</div>
</div> 
