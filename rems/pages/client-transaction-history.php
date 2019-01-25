<?php
	include '../template/header.php';
  include '../snippet/calendar.php';
  include '../cli/global-functions.php';


?>
<link href="calendar.css" type="text/css" rel="stylesheet" />
<link href="../css/calendar.css" rel="stylesheet">

  <div id="content-wrapper">

    <div class="container-fluid">
    
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Transaction History</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
<!--if customer is on the payment transaction table apply the deadline style -->
<?php
$date = '00';
$cid = $_SESSION['user_id'];
if(findCustomer($_SESSION['user_id'],$mysqli,'client_payment_transaction','client_id') > 0){

  $date = getMaxDueDate($cid,$mysqli,'client_payment_transaction','client_id');
}
//$date = '2018-08-26';
?>
<style type="text/css">
  li#li-<?php echo $date; ?>{
    background-color: red !important;
  }
</style>
       
        
     <div class="row">
        <div class="col-lg-8">
          <div class="card mb-3">
            <div class="card-header">
               <i class="far fa-credit-card"></i>
              Deadline of Payment</div>

            <div class="card-body">

               <div class="calendar-view">
               <i>Recieve payment on the schedule</i>
                <?php 

                $calendar = new Calendar();
                echo $calendar->show();
          
                ?>

              </div>
            </div>
            
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-history"></i>
              Payment History</div>
            <div class="card-body01">
               <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                 </thead>
                 <tbody>
                 <?php 
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT  
                            id,
                            date_paid,
                            due_date,
                            amount_paid
                            FROM client_payment_transaction
                            WHERE client_id = '$user_id'";

                    $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $date_paid = $row['date_paid'];
                          $due_date = $row['due_date'];
                          $amount_paid = $row['amount_paid'];

                            echo '<tr>';
                            echo '<td>'.$date_paid.'</td>';
                            echo '<td>'.$amount_paid.'</td>';
                            echo '<td>';
                            echo '<button class="toolbar-edit" style="color:#8cc63d;" onclick="showPaymentDetail('.$id.')"><i class="fa fa-info-circle"></i> View</button>';
                            echo '</td>';
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
    
</div>

<!-- modal -->
<div class="modal fade" id="viewPaymentDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Payment Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="payment-detail-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function showPaymentDetail(id){    
      var id = id;    
      var user = 'client';        
      $('.payment-detail-body').load('../snippet/payment-history-view.php?id=' + id +'&user=' + user,function(){           
          $('#viewPaymentDetail').modal({show:true});          
      });                    
  }

  
</script>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
     $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-client-transaction-history").addClass("active");
});
</script>