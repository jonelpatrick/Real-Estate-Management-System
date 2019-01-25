<!-- Modal -->
<div class="modal fade" id="messageSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" max-width: 250px;margin-top: 10%">
    <div class="modal-content">
      <div class="modal-header btn btn-success">  

        <h6 class="modal-title" id="myModalLabel">Message Success</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
      </div>
      <div class="modal-body center-block">      
          <p class="text-center">Transaction is Successful.</p>
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="messageError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" max-width: 250px;margin-top: 10%">
    <div class="modal-content">
      <div class="modal-header btn-danger">  

        <h6 class="modal-title" id="myModalLabel">Message Error</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
      </div>
      <div class="modal-body center-block">      
          <p class="text-center"> <?php echo $_SESSION["ERR"]; ?></p>
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="confirmationDelete" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtable">
        <input type="hidden" name="tableId" id="tableId">
        <input type="hidden" name="redirectpage" id="redirectpage">
        <input type="hidden" name="action" id="confirmDelete" value="confirmDelete">
        <div class="modal-body">        
          <div class="icon-box">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </div>           
          <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="confirmationDeleteFile" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtable02">
        <input type="hidden" name="tableId" id="tableId02">
        <input type="hidden" name="redirectpage" id="redirectpage02">
        <input type="hidden" name="action" id="confirmDelete02" value="confirmDelete">
        <div class="modal-body">        
          <div class="icon-box">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </div>           
          <p>Do you really want to delete this file? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="confirmSwitch" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtableSW">
        <input type="hidden" name="tableId" id="tableIdSW">        
        <input type="hidden" name="action" value="switchToAvailable">
        <div class="modal-body">        
          <div class="icon-box">
            <i class="fas fa-toggle-on"></i>
          </div>           
          <p style="text-align: center;">Do you really want to Switch this property to Available? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm Switch</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="confirmDeleteEvents" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/web-functions.php">
        <input type="hidden" name="dbtable" id="webDeleteTable">
        <input type="hidden" name="tableId" id="webDeleteId">
        <input type="hidden" name="redirectpage" id="webRedirect">  
        <input type="hidden" name="action" id="confirmDeleteEvents" value="confirmDeleteEvents">
        <div class="modal-body">        
          <div class="icon-box">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </div>           
          <p>Do you really want to delete this Event? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


