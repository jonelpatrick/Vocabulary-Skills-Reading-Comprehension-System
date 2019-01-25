<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Subject</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>         

        <div class="row">
        	<div class="col-lg-6">
        		<div class="card mb-3">
	            <div class="card-header">
	              <i class="fas fa-info-circle"></i>
	              Subject Details</div>
	            <div class="card-body">
	            	<form action="../cli/functions.php" method="POST">
	            		<input type="hidden" name="action" value="addSubject">
	            		<div class="form-group">
	            			<label>Subject name: </label>
	            			<input type="text" name="subject_name" class="form-control" required="">
	            		</div>
	            		<div class="form-group">
	            			<label>Description: </label>
	            			<textarea name="description" class="form-control" style="height: 100px;"></textarea>
	            		</div>
	            		<div class="form-group">
	            			<input type="submit" name="submit" value="Add Subject" class="btn btn-primary">
	            		</div>
	            	</form>	             
		        </div>            
		      </div><!-- mb card-->	
        	</div><!--col-lg-6 -->
        	<div class="col-lg-6">
	          <div class="card mb-3">
	            <div class="card-header">
	              <i class="fas fa-table"></i>
	              List of subject</div>

	            <div class="card-body">
	              <div class="table-responsive">
	                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                  <thead>
	                    <tr>
	                      <th>Name</th>
	                      <th>Description</th>                      
	                      <th></th>
	                      <th></th>                      
	                    </tr>
	                  </thead>
	                  <tfoot>
	                    <tr>
	                      <th>Name</th>
	                      <th>Description</th>                      
	                      <th></th>
	                      <th></th>
	                    </tr>
	                  </tfoot>
	                  <tbody>
	                  <?php
	                    $sql = "SELECT 
	                            id,
	                            name,
	                            description                            
	                            FROM subject
	                            WHERE deleted = 0";

	                     $result = mysqli_query($mysqli,$sql);
	                      if (mysqli_num_rows($result) > 0) { 
	                         while($row = mysqli_fetch_assoc($result)) {
	                          $name = $row['name'];
	                          $description = $row['description'];
	                          $id = $row["id"];                          

	                          echo '<tr>'; 
	                          echo '<td>'.$name.'</td>';
	                          echo '<td>'.$description.'</td>';                           
	                                                
	                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditSubject('.$id.');" > <i class="fas fa-edit"></i>'.''.'</button></td>';
	                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteSubject('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
	                          echo '</tr>';
	                         }
	                      }
	                  ?>
	                    
	                   
		              </tbody>
		            </table>
		          </div>
		        </div>            
		      </div><!-- mb card-->
		    </div><!--col-lg-6 -->
		</div><!-- row -->
    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Subject Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" >      
        <div class="modal-body">
                      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button  type="submit" class="btn btn-primary">Save changes</button>           
        </div>

      </form>   
    </div>
    </div>
  </div>


<?php 
  include '../snippet/transaction-message.php';
?>
<style type="text/css">
  input[type=checkbox]{
      width: 30px;
      height: 30px;
  }
</style>
<script type="text/javascript">

  function showEditSubject(id){    
      var id = id;            
      $('.modal-body').load('../snippet/subject-modal.php?id=' + id,function(){           
          $('#subjectModal').modal({show:true}); 
         
      });                    
  }

  function showDeleteSubject(id){    
      var id = id;            
      var table = "subject";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>