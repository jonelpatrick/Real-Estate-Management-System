<?php
	include '../template/header.php';
  
                      $sql = "SELECT address, cell_number, phone_number,fb_link, twitter_link, in_link, gplus_link, email_address, short_article, full_article, services FROM aboutdetails WHERE id = 1";
                      $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) { 
                           while($row = mysqli_fetch_assoc($result)) {
                            $address = $row['address'];
                            $cell_number = $row['cell_number'];
                            $phone_number = $row['phone_number'];
                            $fb_link = $row['fb_link'];
                            $twitter_link = $row['twitter_link'];
                            $in_link = $row['in_link'];
                            $gplus_link = $row['gplus_link'];
                            $email_address = $row['email_address'];
                            $short_article = $row['short_article'];
                            $full_article = $row['full_article'];
                            $services = $row['services'];
                         }
                      }
?>     

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Attach a property</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol> 
      <div class="row">       
        <div class="col-lg-6">
         <form action="../cli/functions.php" method="POST">
         <input type="hidden" name="action" value="aboutus" >
          <button class="btn btn-primary" type="submit" style="margin-bottom: 1em;">Update Details</button>          
          <div class="card mb-3">
            <div class="card-header">
             Contact Information
            </div>
            <div class="card-body"> 
              <div class="form-group">   
                <label>Address</label>
                <input type="hidden" name="id" />
                <input class="form-control" type="text" name="address" value="<?php echo $address ?>">
              </div> 
              <div class="form-group">   
                <label>Cellphone Number</label>
                <input class="form-control" type="text" name="cell_number" value="<?php echo $cell_number ?>">
              </div> 
              <div class="form-group">   
                <label>Phone Number</label>
                <input class="form-control" type="text" name="phone_number" value="<?php echo $phone_number ?>">
              </div> 
              <div class="form-group">   
                <label>Facebook Link</label>
                <input class="form-control" type="text" name="fb_link" value="<?php echo $fb_link ?>">
              </div> 
              <div class="form-group">   
                <label>Twitter Link</label>
                <input class="form-control" type="text" name="twitter_link" value="<?php echo $twitter_link ?>">
              </div> 
              <div class="form-group">   
                <label>In Link</label>
                <input class="form-control" type="text" name="in_link" value="<?php echo $in_link ?>">
              </div> 
              <div class="form-group">   
                <label>Google Pus Link</label>
                <input class="form-control" type="text" name="gplus_link" value="<?php echo $gplus_link ?>">
              </div>
              <div class="form-group">   
                <label>Email Address</label>
                <input class="form-control" type="text" name="email_address" value="<?php echo $email_address ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" style="margin-top: 3.2em;">
          <div class="card mb-3">
            <div class="card-header">
             About Us Information
            </div>
            <div class="card-body"> 
              <div class="form-group">
                <label>Short Article</label><br>
                <textarea class="form-control" name="short_article"><?php echo $short_article ?></textarea>
              </div>
              <div class="form-group">
                <label>Full Article</label><br>
                <textarea class="form-control" name="full_article"><?php echo $full_article ?></textarea>
              </div>
              <div class="form-group">
                <label>Services</label><br>
                <textarea class="form-control" name="services"><?php echo $services ?></textarea>
              </div>
          </form>
<!--upload image --> 
             
            </div>
          </div>
        </div>
      </div><!--row -->
      
      </div>
      
    </div>
</div>

<!-- Modal 
<div id="modalClientList" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->
<script type="text/javascript">
 $('input:radio[name="subjectTo"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'For Sale') {
           alert("For sale");
        }else if($(this).is(':checked') && $(this).val() == 'For Rent'){
          alert("For rent");
        }else if($(this).is(':checked') && $(this).val() == 'For Lease'){
           alert("For lease");
        }
    });


</script>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
   $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-website-details").addClass("active");
});
</script>