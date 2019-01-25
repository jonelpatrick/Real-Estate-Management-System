<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Issue legal Documents</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
      <div class="row">
        <div class="col-lg-8">
             <div class="form-group">          
                 <label class="radio-inline">
                  Select Customer:   
                </label>    
                 <input class="editable-select" list="customer2" name="legal_customer_id" placeholder="Select Customer here" onchange="getInfo(this)" />
                  <datalist id="customer2">
                    <?php
                          $sql = "SELECT 
                              property_sold.id pid,
                              customer_id id,
                              customer.firstname firstname,
                              customer.middlename middlename,
                              customer.lastname lastname 
                              FROM property_sold 
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id 
                              WHERE property_sold.deleted = 0";
                              
                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) {                             
                             while($row = mysqli_fetch_assoc($result)) {
                              $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              $id  = $row['id'];
                              echo '<option value="'.$name.'">';
                             }
                          }
                      ?>           
                  </datalist>   
                  <!--       
                 <select class="custom-select radio-inline" name="customer_id" style="display: inline;width: 60%;" onchange="getInfo(this)">
                      <?php
                      
                        $sql = "SELECT 
                              property_sold.id pid,
                              customer_id id,
                              customer.firstname firstname,
                              customer.middlename middlename,
                              customer.lastname lastname 
                              FROM property_sold 
                              INNER JOIN customer 
                              ON property_sold.customer_id = customer.id 
                              WHERE property_sold.deleted = 0";

                         $result = mysqli_query($mysqli,$sql);
                          if (mysqli_num_rows($result) > 0) { 
                            echo '<option value="0">Select a customer here...</option>';
                             while($row = mysqli_fetch_assoc($result)) {
                              $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              $id  = $row['id'];
                              echo '<option value="'.$id.'">'.$name.'</option>';
                             }
                          }
                      ?>                    
                  </select>   
                  -->  
              </div>
        </div>
      </div>
     <!-- change content start here -->
     <div id="dynamic-content">
      <div class="row">

        <div class="col-lg-7">
          <div class="card mb-3">
            <div class="card-header">               
               Customer Detail
            </div>

              <div class="card-body">
            
                <div style="margin-top: 1em;" class="card-footer small text-muted">Property bought</div>

                <div id="cart-changeable">
                  <div id="property-cart" class="property-bought jumbotron" >
                  
                  </div>

                <div class="form-group"> 
                  <label class="radio-inline">
                    Total Amount: 0.00
                  </label> 
                </div>
              </div>
              <div class="form-group"> 
                <label>
                  Terms of Payment: <i>Please select a customer</i>
                </label>
            
              </div>
               <div class="form-group"> 
                <label>
                  Remaining Balance: <i>Please select a customer</i>
                </label>                   
              </div>
              <hr>          
                          
              </div><!--card body -->

          </div>  
          <div class="property-bought jumbotron">
           <div style="margin-top: 1em;" class="card-footer small text-muted">Document/s on hand</div>
            
          </div>          
        </div>  

        <div class="col-lg-5">
          <div class="card mb-3">
            <div class="card-header">               
                 List of documents
            </div>
            <div class="card-body">
                
                <div class="card-body">
                  <div class="table-responsive">
                  
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <tbody>                     
                       
                    </tbody>
                    </table>
                  </div>
                </div>               
        
            </div>
          </div>  
        </div>

        </div><!-- row-->
      </div><!-- dynamic content end here-->
    </div>
</div>
<style type="text/css">
  .selected-property{
    font-size: 13px;
    background: #fff;
    width: auto;
    max-width: 100px;
    text-align: center;
  }
   .selected-property span{
    text-align: center;
    font-size: 13px;
   }
  .jumbotron{
    padding: 2em !important;
  }
  .img-rounded{
    width: 90px;
  }
  .dataTables_length label{
    display:none;
  }
  .table td,.table .btn{
      font-size: 13px;      
  }
  .table .btn{
    pointer-events: none;
  }
  .select-box{
    float: right;
    background: none;
    border: none;
    color: #007bff;
  }
 #myInput {
  background-image: url('../system-images/search.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>

<script>

 function getInfo(id){
    var cid = id.value;
    if(cid != 0){
       $.get("../snippet/issue-legal-document-dynamic.php?id="+cid, function (data) {
  
        $("#dynamic-content").html(data);
      });   
    }else{
     location.reload();
    }
    
  }


</script>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
     $(function() {
    $(".sidebar .nav-item").removeClass("active");
    $(".menu-issue-legal-documents").addClass("active");
});
</script>