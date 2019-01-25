<style type="text/css">
	.primary-image{
		position: absolute;
	    margin-top: -2em;
	    background: #61a3dc;
	    padding: 5px;
	    border-radius: 5px;
	}
	.primary-image .fa-check{
		
	    color: #fff;
	}
	.file-trash.btn{
		margin-top: -2.5em;
	}
</style>
<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
define("UPLOAD_DIR_PROPIMAGE", "../../property-gallery/"); 
define("UPLOAD_DIR", "../uploads/");

$pid  = $_GET['id'];
$image_path = "";
$sql = "SELECT 
		id,
		image_path
		FROM property_gallery
		WHERE property_id = '$pid' 
		AND deleted = 0
		UNION
		SELECT 
		id,
		image_path
		FROM property
		where id = $pid";
//echo $sql;
$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) {
echo '<div class="row">';
 while($row = mysqli_fetch_assoc($result)) {
 	$id = $row['id'];
 	$image_path = $row['image_path'];
 	
 	echo '<div class= "col-sm-3" style="margin-bottom: 1em;">';

	if (file_exists(UPLOAD_DIR_PROPIMAGE.$image_path)) { 	
	 	
	 	echo '<img src="'.UPLOAD_DIR_PROPIMAGE.$image_path.'" class="img-rounded" style="width:120px;height: 120px;"><br>';
	 	echo '<button class="file-trash btn" onclick="removeImages('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Remove this document"></i> </button>';

	 	
	}else if(file_exists(UPLOAD_DIR.$image_path)){

			echo '<img src="'.UPLOAD_DIR.$image_path.'" class="img-rounded" style="width:120px;height: 120px;"><br>';
			echo '<span class="primary-image"><i class="fas fa-check"></i></span>';

	}else if(file_exists('../system-images/'.$image_path)){

			echo '<img src="../system-images/'.$image_path.'" class="img-rounded" style="width:120px;height: 120px;"><br>';
			echo '<span class="primary-image"><i class="fas fa-check"></i></span>';
	}
	echo '</div>';

 }
 echo '</div>';
}else{

}

?>

<script type="text/javascript">

	 function removeImages(id){
      var image_id = id;                  
     $.ajax({
        url: "../snippet/remove-image-gallery.php",
        type: "post",
        data: { image_id : image_id },
        success: function(data) {       
          $('#propertyGallery').html(data);
        }
    });
  }
</script>