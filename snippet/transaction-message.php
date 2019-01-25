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

<div id="confirmationDeleteQ" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtableQ">
        <input type="hidden" name="tableId" id="tableIdQ">
        <input type="hidden" name="action" id="confirmDeleteQ" value="confirmDelete">
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


<div id="confirmationDeleteActivity" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtableActivity">
        <input type="hidden" name="tableId" id="tableIdActivity">
        <input type="hidden" name="action" id="confirmDeleteActivity" value="confirmDeleteACtivitiy">
        <div class="modal-body">        
          <div class="icon-box">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </div> 
          <p>Do you really want to delete this records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="confirmationQuestion" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="dbtable" id="dbtablequestion">
        <input type="hidden" name="qcode" id="qcode">
        <input type="hidden" name="action" id="confirmDeleteQuestion" value="confirmDeleteQuestion">
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

<div id="confirmationDeleteStory" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
               
        <h4 class="modal-title">Are you sure?</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="../cli/functions.php">
        <input type="hidden" name="storytable" id="storytable">
        <input type="hidden" name="storyid" id="storyid">
        <input type="hidden" name="action" value="confirmDeleteStory">
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
