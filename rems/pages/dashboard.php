<?php
	include '../template/header.php';


?>
<style type="text/css">
  #slideshow {
  margin: 0 auto;
  position: relative;
  
  padding: 10px;
 
}

#slideshow > div {
  position: absolute;
  top:10px;
  left: 10px;
  right: 10px;
  bottom: 10px;
}
#slideshow > div > img{
  width: 100%;
  height: 400px;
   box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
}
.slider-label{
  width: 100%;
}
</style>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
      
     <div id="slideshow">
     <?php

        $sql = "SELECT property_name,price,image_path,address FROM property WHERE image_path !='no-image-land.png'";
        $result = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($result) > 0) { 
           while($row = mysqli_fetch_assoc($result)) {
              echo '<div>';
              echo ' <img  src="../uploads/'.$row['image_path'].'">';
              echo '<div class="slider-label btn btn-primary">'.$row['property_name'] .' - '.$row['address'] .' Price : Php ' .$row['price'].'.00</div>';
              echo "</div>";
             
            
            
           }
         }
     ?>
       
      </div>
      </div>
    </div>
</div>
<?php
	include '../template/footer.php';
?>

<script type="text/javascript">
  $("#slideshow > div:gt(0)").hide();

setInterval(function() {
  $('#slideshow > div:first')
    .fadeOut(2000)
    .next()
    .fadeIn(2000)
    .end()
    .appendTo('#slideshow');
}, 6000);

$(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-dashboard").addClass("active");
});
</script>