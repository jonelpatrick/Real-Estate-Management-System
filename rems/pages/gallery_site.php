<?php
	include '../template/header.php';
   define("UPLOAD_DIR_GAL", "../gallery/");
?>

  <div id="content-wrapper">

<div id="loader" style="display: none;"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
  <h2>Tada!</h2>
  <p>Some text in my newly loaded page..</p>

</div>

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Events Galleries</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="btn-container">  
        <button class="btn btn-primary" data-toggle="modal" data-target="#addnewclient">Add New Image</button>
       
      </div>
 
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Galleries</div>

            <div class="table-responsive">
                <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                   <tr></tr>
                  </thead>
                  <tfoot>
                 
                  </tfoot>
                  <tbody>
                    <tr>
                    <?php
                      $sql = "SELECT 
                              id,
                              title,
                              description,
                              img
                              FROM gallery";
                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {                         
                        $x = 0;
                        $y =0;
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $title = $row['title'];
                          $description = $row['description'];
                          $img = $row['img'];

                          if( $y == 0 ){
                            echo '<td class="horizontal-even">';
                            $y = 1;
                          }else{
                            echo '<td>';
                            $y = 0;
                          }
                          
                          $path = UPLOAD_DIR_GAL.$img; 
                          $default = '../system-images/default-file.png';
                          echo '<button class="file-trash btn" onclick="javascript:deleteFile('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';
                           
                          if(is_image($path)){

                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                         
                          echo '<span>'.$title.'</span>';
                          echo '<br/>';
                          echo '<span>'.$description.'</span>'; 
                          echo '</td>';
                          
                          $x++;
                          if($x == 6){
                            echo '</tr>';
                            echo '<tr>';
                            $x = 0;
                          }
                          
                         }
                       }
                    ?>
                     </tr>                                                                               
                  </tbody>
                </table>
              </div>

            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="addnewclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">New Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="client-body">
        <div class="modal-body">
    
          <form method="POST" action="../cli/web-functions.php" id="myform" enctype="multipart/form-data">
            <input type="hidden" value="addgallery" name="action"> 
            <div class="input-group mb-3" style="margin-bottom: 0 !important;">
               <div class="form-group" style="width:100%;">
                  <label>Upload Image</label>
                  <div class="input-group addborder">
                      <span class="input-group-btn">
                          <span class="btn btn-default btn-file">
                              Browse… <input type="file" id="imgInp" name="image">
                          </span>
                      </span>
                      <input type="text" class="form-control" readonly>
                  </div>
                  <img id='img-upload'/>
              </div>
             
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" id="formeventname" placeholder="Event Name" name="eventname">
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" id="formdescription" placeholder="Event Description" name="eventdescription">
            </div>      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button  type="submit" class="btn btn-primary">Save changes</button>           
        </div>
      </form>   
    </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  function deleteFile(id){
      var id = id;            
      var table = "gallery";
      var redirect = '../pages/gallery_site.php';
      $('#tableId02').val(id);
      $('#dbtable02').val(table);
      $('#redirectpage02').val(redirect);
      $('#confirmationDeleteFile').modal({show:true}); 
  }
 

</script>
<?php
function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}
?>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
    $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-website-details").addClass("active");
});
</script>