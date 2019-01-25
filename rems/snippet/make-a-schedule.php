<?php
	include '../dbconnect/connect.php';
	include '../cli/global-functions.php';

	$id = $_GET['id'];

	$sql = "SELECT 
            maintenance_request.id mid,
            firstname,
            middlename,
            lastname,
            property_name,
            property.address paddress,
            maintenance_request.contact_number mcontact,
            city,
            request_date,
            property_access_by,
            repair_request
            FROM maintenance_request 
            INNER JOIN customer ON 
            maintenance_request.customer_id = customer.id 
            INNER JOIN property ON
            maintenance_request.property_id = property.id 
            WHERE maintenance_request.id = '$id'";

      $result = mysqli_query($mysqli,$sql);
      if (mysqli_num_rows($result) > 0) { 
        
         while($row = mysqli_fetch_assoc($result)) {

         	$name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
         	$request_date = $row['request_date'];			
    			$property_name = $row['property_name'];
    			$property_location = $row['paddress'];
    			$city = $row['city'];

         }
     }

?>

<style type="text/css">
	.form-input{
		padding-left: 1em;
	    background: #fbfafa;
	    border: none;
	    width: 65%;
	    border-bottom: 1px solid rgba(0,0,0,0.2);
	}
	.form-control{
		margin: 0 20px;
    	width: 92%;
	}
	.schedule-box{
		margin: 20px;
	    padding: 20px;
	    border-radius: 5px;
	    box-shadow: 0px 1px 2px;
	    border: 1px solid rgba(0,0,0,0.2);
	}
</style>
<br>

<input type="hidden" name="action" value="schedule_maintenance">
<input type="hidden" name="maintenance_request_id" value="<?php echo $id; ?>">

<div class="form-group inline-layout">	
	<label class="radio-inline">Request Date: </label>	
	<input type="text" class="form-input" value="<?php echo $request_date; ?>" disabled>
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Requestor Name: </label>	
	<input type="text" class="form-input" value="<?php echo $name; ?>" disabled>
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Property Name: </label>	
	<input type="text" class="form-input" value="<?php echo $property_name; ?>" disabled>
</div>
<div class="form-group inline-layout">	
	<label class="radio-inline">Property Address: </label>	
	<textarea name="property_address" readonly="" class="form-control"><?php echo $property_location; ?>, <?php echo $city; ?></textarea>
</div>
<div class="schedule-box">
 <div class="form-group inline-layout">   
    <label>Set a schedule for the maintenance:</label>
    <input class="form-control" data-date-format="yyyy-mm-dd" id="datepicker" name="schedule">
  </div> 
  <div class="form-group inline-layout">   
    <label>Person in charge:</label>
    <input class="form-control" type="text" name="person_in_charge">
  </div> 
</div>
  <script type="text/javascript">
        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        
          $('#datepicker').datepicker("setDate", new Date());
    </script>

