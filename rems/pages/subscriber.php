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
          <a href="client-list.php">Subscriber List</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>     

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of subscriber</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Email Address</th> 
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>  
                       <th></th> 
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT id,emailaddress FROM subscriber";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {  
                          echo '<tr>'; 
                          echo '<td>'.$row['id'].'</td>';
                          echo '<td>'.$row['emailaddress'].'</td>'; 
                         
                           echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteClient('.$row['id'].');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

    </div>
</div>

 
<script type="text/javascript">

  function showEditClient(id){    
      var id = id;            
      $('.client-body').load('../snippet/client-modal-edit.php?id=' + id,function(){           
          $('#addnewclient').modal({show:true}); 
         
      });                    
  }
  function showDeleteClient(id){    
      var id = id;            
      var table = "client";
      var redirect = '../pages/client-list.php';
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }
$(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-website-details").addClass("active");
});
 
</script>
<?php
	include '../template/footer.php';
?>