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
          <a href="client-list.php">Messages</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>     

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-envelope"></i>
              Messages</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fullname</th>
                      <th>Email Address</th> 
                      <th>Message</th>
                      <th>Date</th> 
                      <th></th> 
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                    $sql = "SELECT id,fullname, email, comments, datecreated FROM contacts";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {   
                          echo '<tr>'; 
                          echo '<td>'.$row['id'].'</td>';
                          echo '<td>'.$row['fullname'].'</td>'; 
                          echo '<td>'.$row['email'].'</td>'; 
                         if (strlen($row['comments']) <=50) {
                                echo '<td>'.$row['comments'].', '.$row['comments'].'</td>';
                                }else{
                                  echo '<td>'.substr($row['comments'], 0, 50) . '...' .'</td>';
                                }
                          echo '<td>'.$row['datecreated'].'</td>';  
                          echo '<td style="width:15px;"><button class="toolbar-delete" name="id" onclick="showviewMessages('.$row['id'].');" ><i class="fa fa-envelope-open" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
           <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
          </div>

    </div>
</div>
 
<!-- modal --> 
<div class="modal fade f" id="viewMessages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> 
    <div id="mymessage" class="modal-content" style="overflow: auto;">

    </div> 
  </div>
</div> 

 
 
<script type="text/javascript"> 

   function showviewMessages(id){    
      var id = id;            
      $('#mymessage').load('../snippet/viewMessageModal.php?id=' + id,function(){           
          $('#viewMessages').modal({show:true}); 
         
      });                    
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
