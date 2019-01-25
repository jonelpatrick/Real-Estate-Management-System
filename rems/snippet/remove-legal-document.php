<?php
	include '../dbconnect/connect.php';
	 include '../cli/global-functions.php';
 	 define("UPLOAD_DIR", "../record-documents/");

	$document_id = $_POST['document_id'];
	$customer_id =$_POST['customer_id'];

	$sql = "DELETE FROM customer_document_on_hand 
			WHERE id = '$document_id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong error(05)";
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
                 echo '<button class="file-trash btn" onclick="removeDocuments('.$documents_id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';

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
  </div>  

  <script type="text/javascript">
  	
  function removeDocuments(id){
      var document_id = id;            
      var customer_id = document.getElementById('customer_id').value;
     $.ajax({
        url: "../snippet/remove-legal-document.php",
        type: "post",
        data: { document_id : document_id, customer_id : customer_id },
        success: function(data) {       
          $('#documentOnHand').html(data);
        }
    });
  }
  </script>   