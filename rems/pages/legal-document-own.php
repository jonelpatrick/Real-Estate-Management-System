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
                
              </div> 
              <i style="font-size: 13px;">click the document to download</i>
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
                    $customer_id = $_SESSION['user_id'];

                      $sql = "SELECT 
                              customer_document_on_hand.id cdhid,
                              uploads.file_name file_name,
                              uploads.upload_time upload_time,
                              uploads.property_id cdhproperty_id
                              FROM customer_document_on_hand 
                              INNER JOIN uploads
                              ON customer_document_on_hand.uploads_id = uploads.id
                              WHERE customer_document_on_hand.deleted = 0
                              AND customer_document_on_hand.customer_id = '$customer_id'";
                    
                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {                         
                        $x = 0;
                        $y =0;
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['cdhid'];
                          $file_name = $row['file_name'];
                          $upload_time = $row['upload_time'];
                          $property_id = $row['cdhproperty_id'];

                          if( $y == 0 ){
                            echo '<td class="horizontal-even">';
                            $y = 1;
                          }else{
                            echo '<td>';
                            $y = 0;
                          }
                         
                          $path = UPLOAD_DIR.$file_name;
                          $default = '../system-images/default-file.png';
                         // echo '<button class="file-trash btn" onclick="javascript:deleteFile('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';

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

<?php


include '../template/footer.php';

?>
<script type="text/javascript">
   $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-legal-document-own").addClass("active");
});
</script>