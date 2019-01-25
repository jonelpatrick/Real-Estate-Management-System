<?php 
include '../dbconnect/connect.php';
include '../cli/global-functions.php';

$cname = $_GET['name'];

$id =  getIdViaCustomerName($cname,$mysqli);

?>

<label>Property: </label> 
  <select class="custom-select radio-inline" name="property_id" >
      <?php
      $customer_id = $_SESSION['user_id'];
        $sql = "SELECT 
                property_name,
                city,
                property.id id,
                address,
                block,
                lot 
                FROM property_sold 
                INNER JOIN property 
                ON property_sold.property_id = property.id
                WHERE property_sold.deleted = 0 
                AND property_sold.customer_id = '$id'";

         $result = mysqli_query($mysqli,$sql);
          if (mysqli_num_rows($result) > 0) { 
             while($row = mysqli_fetch_assoc($result)) {
              $block = $row['block'];
              $lot = $row['lot'];

              if($block == 0 && $lot != 0){
                 $property = $row['property_name'].' - '.' Lot '.$lot.' '.$row['address'].' '.$row['city'];
              }else if($lot == 0 && $block != 0){
                 $property = $row['property_name'].' - '.' Block '.$block.' '.$row['address'].' '.$row['city'];
              }else if($block == 0 && $lot == 0){
                   $property = $row['property_name'].' - '.$row['address'].' '.$row['city'];
              }
              else{
                  $property = $row['property_name'].' - '.' Block '.$block.' Lot '.$lot.' '.$row['address'].' '.$row['city'];
              }
              
              $id  = $row['id'];
              echo '<option value="'.$id.'">'.$property.'</option>';

             }
          }else{

              echo '<option > No existing property </option>';	
          }
      ?>                    
  </select>