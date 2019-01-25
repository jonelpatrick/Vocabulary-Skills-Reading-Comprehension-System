<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Section List</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>         

        <div class="row">
        	<div class="col-lg-6">
        		<div class="card mb-3">
	            <div class="card-header">
	              <i class="fas fa-info-circle"></i>
	              Section Details</div>
	            <div class="card-body">
	            	<form action="../cli/functions.php" method="POST">
	            		<input type="hidden" name="action" value="addSection">
	            		<div class="form-group">
	            			<label>Section name: </label>
	            			<input type="text" name="section_name" class="form-control" required="">
	            		</div>
	            		<div class="form-group">
	            			<label>Grade: </label>
	            			<select name="grade" class="form-control">
	            				<option value="1">Grade 1</option>
	            				<option value="2">Grade 2</option>
	            				<option value="3">Grade 3</option>
	            				<option value="4">Grade 4</option>
	            				<option value="5">Grade 5</option>
	            				<option value="6">Grade 6</option>
	            				<option value="7">Grade 7</option>
	            				<option value="8">Grade 8</option>
	            				<option value="9">Grade 9</option>
	            				<option value="10">Grade 10</option>
	            				<option value="11">Grade 11</option>
	            				<option value="12">Grade 12</option>
	            			</select>
	            		</div>
	            		<!--
	            		<div class="form-group">
	            			<label>Choose subject: </label>
	            			<select name="subject" class="form-control">
	            				<?php 
	            					$sql = "SELECT * FROM subject WHERE deleted = 0";
	            					$result = mysqli_query($mysqli,$sql);
			                        if (mysqli_num_rows($result) > 0) { 
			                        	while($row = mysqli_fetch_assoc($result)) {
			                        		$id = $row['id'];
			                        		$name = $row['name'];
			                        		$desc = $row['description'];

			                        		echo '<option value="'.$id.'">'.$name.'</option>';
			                        	}
	                       			}
	            				?>	            				
	            			</select>
	            		</div>
						-->
	            		<div class="form-group">
	            			<label>Comment: </label>
	            			<textarea name="comment" class="form-control" style="height: 100px;"></textarea>
	            		</div>
	            		<div class="form-group">
	            			<input type="submit" name="submit" value="Add Section" class="btn btn-primary">
	            		</div>
	            	</form>	             
		        </div>            
		      </div><!-- mb card-->	
        	</div><!--col-lg-6 -->
        	<div class="col-lg-6">
	          <div class="card mb-3">
	            <div class="card-header">
	              <i class="fas fa-table"></i>
	              List of section</div>

	            <div class="card-body">
	              <div class="table-responsive">
	                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                  <thead>
	                    <tr>
	                      <th>Name</th>
	                      <th>Grade</th>   
	                      <th>Comment</th>                     
	                      <th></th>
	                      <th></th>                      
	                    </tr>
	                  </thead>
	                  <tfoot>
	                    <tr>
	                      <th>Name</th>
	                      <th>Grade</th>   
	                      <th>Comment</th>                      
	                      <th></th>
	                      <th></th>
	                    </tr>
	                  </tfoot>
	                  <tbody>
	                  <?php
	                    $sql = "SELECT 
	                            section.id id,
	                            section.name name,
	                            grade,	                            
	                            comment	                            
	                            FROM section	                          	                          
	                            WHERE section.deleted = 0";

	                     $result = mysqli_query($mysqli,$sql);
	                      if (mysqli_num_rows($result) > 0) { 
	                         while($row = mysqli_fetch_assoc($result)) {
	                          $id = $row["id"];   
	                          $section = $row['name'];
	                          $grade = $row['grade'];							  
							  $comment = $row['comment']; 
							                                                

	                          echo '<tr>'; 
	                          echo '<td>'.$section.'</td>';
	                          echo '<td>Grade '.$grade.'</td>';                           
							  echo '<td>'.$comment.'</td>'; 	                                                
	                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditSection('.$id.');" > <i class="fas fa-edit"></i>'.''.'</button></td>';
	                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteSection('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
<div class="modal fade firstmodal" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Section Detail</h5>
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

  function showEditSection(id){    
      var id = id;            
      $('.modal-body').load('../snippet/section-modal.php?id=' + id,function(){           
          $('#sectionModal').modal({show:true}); 
         
      });                    
  }

  function showDeleteSection(id){    
      var id = id;            
      var table = "section";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>