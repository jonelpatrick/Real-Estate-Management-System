<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="customer-report.php">Customer Report</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
      Coming Soon...

    </div>
</div>

<script type="text/javascript">

  function showEditCustomer(id){    
      var id = id;            
      $('.customer-body').load('../snippet/customer-modal-edit.php?id=' + id,function(){           
          $('#addnewcustomer').modal({show:true}); 
         
      });                    
  }
  function showDeleteCustomer(id){    
      var id = id;            
      var table = "customer";
      var redirect = '../pages/customer-list.php';
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
     
  }
 $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-customer-report").addClass("active");
});
 
</script>
<?php
	include '../template/footer.php';
?>