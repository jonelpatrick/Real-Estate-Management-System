<?php
	include '../template/header.php';
  include '../cli/global-functions.php';
?>
  <link rel="stylesheet" type="text/css" href="../css/jquery-editable-select.min.css">
  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="sub-devide-property.php">Sub Devide Property</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="row">
      	<div class="col-sm-12">
      			<div class="form-group">          
                 <label class="radio-inline">
                  Select Property:   
                </label>   
              
           <select id="selectPropertyNew" placeholder="Select Property here..." class="custom-select radio-inline" name="property_id" style="display: inline;width: 66%;" >
                  <?php
                    $sql = "SELECT 
                        		id,
                        		property_name,
                        		address 
                        		FROM `property` 
                        		WHERE availability = 1 
                        		AND deleted = 0 ";
                            
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                        
                         while($row = mysqli_fetch_assoc($result)) {
                          $name     = $row['property_name'];
                          $id       = $row['id'];
                          $address = $row['address'];
                       
                          echo '<option value="'.$id.'">'.$name.' - '.$address.'</option>';
                         }
                      }
                  ?>                    
              </select>               
              <span class="btn btn-primary" onclick="getInfo()">Select</span>             
              </div>
      	</div>
      	<div class="col-sm-12" id="subdevidedList">
      	<div class="row">
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">               
               Property Detail
            </div>

            <form method="POST" action="../cli/functions.php">
            <input type="hidden" name="action" value="sell-property">
            <input type="hidden" name="propertyId" id="propertyId">
          

              <div class="card-body" >              	              

             	<div class="form-group">
             		<label >Property Size
             		<input type="text" name="sub_property_size" class="form-control" placeholder="number only">
             		</label>
	              	<select class="custom-select radio-inline" name="sub_size_unit" style="width: 58%;display: inline;">
	                   <option value="0">Square meter</option>    
	                   <option value="1">Hectare</option>    
	                  </select>
             	</div>
             	<div class="form-group">
             		<label> Price
             		<input type="text" name="sub_price" placeholder="number only" class="form-control">
             		</label>
             	</div>
             	
              <hr>
            
              <div class="form-group">
                <input type="submit" name="submit" value="Submit and Sold" class="btn btn-primary">
              </div>
              </div><!--card body -->

            </form>

          </div>            
        </div>  


        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">               
                 List of Devided Property
            </div>

                <div class="card-body" >
                  
                </div>               
        
          </div>  
        </div>
        <!-- last -->
    		</div>
        </div><!-- col sm 12 -->
      </div>

    </div>
</div>
 <!--  session error /no -->
<input type="hidden" value="<?php echo $_SESSION['ERR']; ?>" id="transactResult">

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


<?php
	include '../template/footer.php';
?>
<script>
  function getInfo(e){
    
   // var y = $( "li:contains('Joana M Sarbosa - Avida Land REAL 102)" ).css('background-color', 'red');
    var val = $('#selectPropertyNew').val();
    var pid = $(".es-list li:contains('"+ val +"')").val();

    if(val != ""){            
       if(pid != 0 || pid != null || pid != ""){
           $.get("../snippet/sub-devide-dynamic.php?id="+pid, function (data) {
      
            $("#subdevidedList").html(data);
          });   
        }
     }   
      e.preventDefault();
      
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
  function showDeleteDevidedProp(id){
		var id = id;            
	      var table = "devided_property";
	      var redirect = '../pages/sub-devide-property.php';
	      $('#tableId').val(id);
	      $('#dbtable').val(table);
	      $('#redirectpage').val(redirect);
	      $('#confirmationDelete').modal({show:true}); 
	}
</script>