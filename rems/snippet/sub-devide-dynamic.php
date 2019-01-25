<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

$selectdPid = $_GET['id'];

$sql = "SELECT * FROM property WHERE id = '$selectdPid'";
$size2 = 0;
$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 
 while($row = mysqli_fetch_assoc($result)) {
 	$property_name = $row['property_name'];
 	$address = $row['address'];
 	$size = $row['property_size'];
 	$unit = $row['size_unit'];
 	$unit2 = $row['size_unit'];

 	if($unit == 0){
 		$unit = "Square meter";
 	}else{
 		$unit = "Hectare";
 	}
 }
}


?>
<div class="row">
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">               
               Property Detail
            </div>

            <form method="POST" action="../cli/functions.php">
            <input type="hidden" name="action" value="addDevidedProperty">	
          	<input type="hidden" name="property_id" value="<?php echo $selectdPid; ?>">
         	<input type="hidden" name="orig_size_unit" value="<?php echo $unit2; ?>">
         	
              <div class="card-body" > 
               <div class="form-group">
               		<label class="text-muted Medium"> Property name: <?php echo $property_name; ?></label>
               		<label class="text-muted Medium"> Address: <?php echo $address; ?></label><br>
               		<?php 
               		if(getOrigPropertyCurrentSize($selectdPid,$mysqli) != 0){

               			$size2 = getOrigPropertyCurrentSize($selectdPid,$mysqli);
               			echo '<label class="text-muted Medium"> Property Size: '. $size2.' '.$unit.'</label><br>';
               			echo '<input type="hidden" name="orig_size" value="'.$size2.' ">';
               		}else{
               			
               			echo '<label class="text-muted Medium"> Property Size: '. $size.' '.$unit.'</label><br>';
               			echo '<input type="hidden" name="orig_size" value="'.$size.' ">';
               		}
               	?>
               </div>             	              

             	<div class="form-group">
             		<label >Property Size
             		<input type="text" name="sub_property_size" class="form-control" placeholder="number only">
             		</label>
	              	<select class="custom-select radio-inline" name="sub_size_unit" style="width: 58%;display: inline;">
	                   <option value="0">Square meter</option>    
	                   <option value="1">Hectare</option>    
	                  </select>
             	</div>
             	<div class="form-group">
             		<label> Price
             		<input type="text" name="sub_price" placeholder="number only" class="form-control">
             		</label>
             	</div>
             	
              <hr>
            
              <div class="form-group">
                <input type="submit" name="submit" value="Submit and Sold" class="btn btn-primary">
              </div>
              </div><!--card body -->

            </form>

          </div>            
        </div>  


        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">               
                 List of Devided Property
            </div>

                <div class="card-body" >
                  	<div class="table-responsive">
                  <input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search for property..." title="Type in a name">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    	<thead>
		                    <tr>
		                      <th>Property</th>
		                      <th>Address</th>
		                      <th>Size</th>		                      
		                      <th>Price</th>		                     
		                      <th></th>
		                    </tr>
		                  </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT 
                        		devided_property.id id,
                                property_id,
                                devided_property.property_size ssize,
                                devided_property.property_price sprice,
                                property.property_name property_name,
                                address,
                                devided_property.size_unit size_unit                            
                                FROM devided_property 
                                INNER JOIN property
                                ON devided_property.property_id = property.id
                                WHERE devided_property.deleted= 0
                                AND property_id = '$selectdPid'";

                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) { 
                             while($row = mysqli_fetch_assoc($result)) {
                              $subdevided_id            = $row['id'];
                              $property_id           	= $row['property_id'];                              
                              $subdevide_size 			= $row['ssize'];
                              $subdevide_price 			= $row['sprice'];
                              $subdevide_property_name  = $row['property_name'];
                              $address 					= $row['address'];
                              $size_unit 				= $row['size_unit'];


							 	if($size_unit == 0){
							 		$size_unit = "Square meter";
							 	}else{
							 		$size_unit = "Hectare";
							 	}

                              echo '<tr>';
                              echo '<td>'.$subdevide_property_name.'</td>';
                              echo '<td>'.$address.'</td>';
                              echo '<td>'.$subdevide_size.' '.$size_unit.'</td>';
                              echo '<td>'.$subdevide_price.'</td>';
                              echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteDevidedProp('.$subdevided_id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                              echo '</tr>';
                             }
                          }
                      ?>
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>               
        
          </div>  
        </div>
        <!-- last -->
    		</div>



