<?php
require_once 'core/database/connect.php';
require_once 'core/database/db-class.php';
session_start();
  
                        if (isset($_POST['submitLand'])) {
                        $db = new database($pdo);
                        $land_name = $_POST['land_name'];
                        $land_address = $_POST['land_address'];
                        $land_area = $_POST['land_area'];
                        $land_description = $_POST['land_description']; 
                        $land_status = $_POST['status'];  
                             
                        
                           // Example of accessing data for a newly uploaded file
                            $fileName = $_FILES["uploadedfile"]["name"]; 
                            $fileTmpLoc = $_FILES["uploadedfile"]["tmp_name"];
                            // Path and file name
                            $pathAndName = "images/Lands/".$fileName;
                            // Run the move_uploaded_file() function here
                            $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
                            // Evaluate the value returned from the function if needed
                            if ($moveResult == true) {

                            } else {

                            } 
                            $sql="INSERT INTO `tbl_land`(`id`, `land_name`,`land_price`, `land_address`, `land_status`, `land_area`, `description`, `img`) values ('','$land_name','3000','$land_address','$land_status','$land_area','$land_description','$pathAndName')";
							$rows = $db->select($sql);  
                            echo "";
                            header("location: adminInfo/land.php"); 
                        }
						
						?>