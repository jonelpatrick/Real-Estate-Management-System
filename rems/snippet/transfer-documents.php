<?php
include '../dbconnect/connect.php';
define("UPLOAD_DIR", "../record-documents/");
include '../cli/global-functions.php';
session_start();

$postData = $_POST;
$date_transferred = date('y-m-d');
$customer_id = $postData['customer_id'];
$transferred_by = $_SESSION['user_id'];

if(isset($postData['list'])){
  

foreach ($postData['list'] as $key => $value) {
	$sql = "INSERT INTO customer_document_on_hand
			(uploads_id,
			customer_id,
			date_transferred,
			transferred_by)
			VALUES 
			('$value',
			'$customer_id',
			'$date_transferred',
			'$transferred_by')";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(0811)";
	}
}


?>
<div style="margin-top: 1em;" class="card-footer small text-muted">Document/s on hand</div>
     <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
      <tbody>  
      <?php
          $sql = "SELECT 
                          customer_document_on_hand.id id,
                          uploads.file_name
                          FROM customer_document_on_hand
                          INNER JOIN uploads
                          ON customer_document_on_hand.uploads_id = uploads.id
                          WHERE customer_document_on_hand.customer_id = '$customer_id'";

                  $result = mysqli_query($mysqli,$sql);

                    if (mysqli_num_rows($result) > 0) { 
                       echo '<tr>';
                       $x = 0;
                       while($row = mysqli_fetch_assoc($result)) {
                         $x++;
                        $file_name = $row['file_name'];
                        $path = UPLOAD_DIR.$file_name;
                        $default = '../system-images/default-file.png';
                        $documents_id = $row['id'];
                        
                        echo '<td>';
                         echo '<button class="file-trash btn" onclick="removeDocuments('.$documents_id.');"> <i class="fa fa-trash" aria-hidden="true" title="Remove this document"></i> </button>';

                         if(is_image($path)){
                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                        
                        echo '</td>';   

                        if($x == 2){
                          echo '</tr>';
                          echo '<tr>';
                          $x = 0;
                        }
                       
                       }
                       
                    }
       ?>
        </tbody>
      </table>

      <?php 
}else{
  header("Refresh:0");
}
 ?>