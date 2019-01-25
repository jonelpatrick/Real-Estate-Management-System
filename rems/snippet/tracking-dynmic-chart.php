<?php
include '../dbconnect/connect.php';

$sql = "SELECT COUNT( * ) available
      FROM  `property` 
      WHERE availability = 0 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $remaining = $row['available'];
       }
   }
	
	 $sql = "SELECT COUNT( * ) sold
       FROM  `property_sold` 
       WHERE deleted = 0 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $sold = $row['sold'];
       }
   }
   
?>
<input type="hidden" id="inputRemaining" value="<?php echo $remaining; ?>">
<input type="hidden" id="inputSold" value="<?php echo $sold; ?>">