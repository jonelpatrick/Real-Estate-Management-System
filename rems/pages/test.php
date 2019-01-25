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
       FROM  `property` 
       WHERE availability = 1 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $sold = $row['sold'];
       }
   }
   
?>
<input type="text" id="inputRemaining" value="<?php echo $remaining; ?>">
<input type="text" id="inputSold" value="<?php echo $sold; ?>">