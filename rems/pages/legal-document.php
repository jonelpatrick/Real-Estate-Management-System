<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
  define("UPLOAD_DIR", "../record-documents/");
  
?>

  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Records & Documents
        </li>
        <li class="breadcrumb-item active">
        <a href="legal-documents.php">Legal Documents</a></li>
      </ol>    

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-images"></i>
              Legal Documents</div>

            <div class="card-body">
              <div class="form-group">   
                <label>Attachment [e.g. Legal documents]</label>
                <div class="file_upload">
                  <form action="../snippet/upload-attachment.php" class="dropzone">
                    <div class="dz-message needsclick">
                      <strong>Drop files here or click to upload.</strong><br />
                      <span class="note needsclick">(Select or upload multiple attachment)</span>
                    </div>
                  </form>
                </div>
              </div> 
              <button class="btn btn-success" onclick='window.location.reload();'>Add Document/s</button>
              <hr/>
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

                    if(isset($_GET['id'])){
                      $property_id = $_GET['id'];

                        $sql = "SELECT 
                              id,
                              file_name,
                              upload_time,
                              property_id
                              FROM uploads WHERE deleted = 0 AND property_id = '$property_id'";
                    }else{

                      $sql = "SELECT 
                              id,
                              file_name,
                              upload_time,
                              property_id
                              FROM uploads WHERE deleted = 0";
                    }
                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {                         
                        $x = 0;
                        $y =0;
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $file_name = $row['file_name'];
                          $upload_time = $row['upload_time'];
                          $property_id = $row['property_id'];

                          if( $y == 0 ){
                            echo '<td class="horizontal-even">';
                            $y = 1;
                          }else{
                            echo '<td>';
                            $y = 0;
                          }
                         
                          $path = UPLOAD_DIR.$file_name;
                          $default = '../system-images/default-file.png';
                          echo '<button class="file-trash btn" onclick="javascript:deleteFile('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';

                          echo '<a href="'.$path.'" title="Click to download" download>';

                          if(is_image($path)){

                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                         
                          echo '<span>'.$file_name.'</span>';
                          echo '</a>';
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

            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

    </div>
</div>
 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

<script type="text/javascript">

  function deleteFile(id){
      var id = id;            
      var table = "uploads";
      var redirect = '../pages/legal-document.php';
      $('#tableId02').val(id);
      $('#dbtable02').val(table);
      $('#redirectpage02').val(redirect);
      $('#confirmationDeleteFile').modal({show:true}); 
  }

  
 transactionValidate();
  function transactionValidate(){
     var error = $('#transactResult').val();
     if(error != ""){
         if(error == "success"){
          processingSuccess();
         }else{
          processingError();
         }
     }      
  }

</script>
<?php


include '../template/footer.php';

?>
<script type="text/javascript">
  $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-records-documents").addClass("active");
});

</script>
