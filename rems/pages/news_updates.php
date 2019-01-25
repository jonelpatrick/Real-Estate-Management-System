<?php
	include '../template/header.php';
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
          <a href="client-list.php">News and Updates</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>     
        <div class="btn-container">  
          <button class="btn btn-primary" data-toggle="modal" data-target="#addnews">Add News and Updates</button>
         
        </div>
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of News and Updates</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>News Title</th> 
                      <th>News Description</th> 
                      <th>Date Created</th> 
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>News Title</th> 
                      <th>News Description</th> 
                      <th>Date Created</th> 
                      <th></th> 
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT id,news_title, news_description, news_created FROM news_updates";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {  
                          echo '<tr>'; 

                          echo '<td>'.$row['id'].'</td>';
                          echo '<td>'.$row['news_title'].'</td>';
                          echo '<td>'.$row['news_description'].'</td>'; 
                          echo '<td>'.$row['news_created'].'</td>';

                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditClient('.$row['id'].');" ><i class="fa fa-edit" aria-hidden="true"></i>'.''.'</button></td>';
                           echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteClient('.$row['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button></td>';

                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div> 
          </div>

    </div>
</div>
<!-- modal -->
<div class="modal fade firstmodal" id="addnews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">News and Updates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="client-body">
        <div class="modal-body"> 
          <form method="POST" action="../cli/web-functions.php" id="addnews" enctype="multipart/form-data">
            <input type="hidden" value="addnews" name="action"> 
            <div class="input-group mb-3" style="margin-bottom: 0 !important;"> 
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" placeholder="News Title" name="news_title" required=" "> 
            </div>
             <div class="form-group">          
              <input type="text" class="form-control" placeholder="News Description" name="news_description" required=" ">
            </div>    
            <div class="form-group">          
              <input type="hidden" class="form-control" name="news_created" value="<?php echo date('M d, Y'); ?>">
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

  function showEditClient(id){    
      var id = id;            
      $('.client-body').load('../snippet/news_edit_modal.php?id=' + id,function(){           
          $('#addnews').modal({show:true}); 
         
      });                    
  }
  function showDeleteClient(id){    
      var id = id;            
      var table = "news_updates";
      var redirect = '../pages/news_updates.php';
      $('#webDeleteId').val(id);
      $('#webDeleteTable').val(table);
      $('#webRedirect').val(redirect);
      $('#confirmDeleteEvents').modal({show:true}); 
     
  }

 
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