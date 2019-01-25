<?php
	include '../template/header.php';
	include '../cli/global-functions.php';
	define("ACTIVITY_CODE", "Match18X");
	//unset($_SESSION['match_code']);
	$_SESSION['match_code'] = ACTIVITY_CODE.getMaxId('activity_matching',$mysqli);
	$teacher_id = $_SESSION['user_id'];
?>
 

<style type="text/css" media="all">
	@import "../css/css/info.css";
	@import "../css/css/main.css";
	@import "../css/css/widgEditor.css";
</style>
<style type="text/css">
	.form-control2 a,.form-control2 button{
		float: left;
    	margin-left: 2em;
    	margin-bottom: 1em;
	}
</style>
<script src="../js/widgEditor.js"></script>

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="activity-matching-type.php">Activity Matching Type</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
   		<div class="row">
   			
   			<div class="col-lg-12" style="margin-bottom: 2em;">
	   			<div class="form-group inline-layout">
	   				<label class="radio-inline" style="float: left;margin-top: 1em;margin-right: 1em;">Select Activity Code :</label>  
	   				<select id="codeselector" onchange="changeCode(this.value);" class="radio-inline form-control" style="width:40%; float: left;">
	   					<?php 
	   						$sql = "SELECT 
		                    		DISTINCT activity_code									
									FROM activity_matching 
									WHERE teacher_id = '$teacher_id'";

		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 
		                      	echo '<option value="All">All</option>';
		                         while($row = mysqli_fetch_assoc($result)) {
		                         	echo '<option value="'.$row['activity_code'].'">'.$row['activity_code'].'</option>';
		                         }
		                      }
	   					?>	   				
	   				</select>
	   			</div>	   			   				
   			</div>

   			<div class="col-lg-12">
   			<hr>
   				<div class="form-group" style="margin-top: 1em;">
	   				<div class="form-control2">
	   				<!-- when this btton is click create code -->
	   					<a href="../pages/create-matching-type.php" class="btn btn-primary "> New Matching Activity</a>
	   					<button id="btnExistingCode" class="btn btn-success" style="display: none;" onclick="createExisting();"> Modify Existing Activity</button>
	   				</div>
	   			</div>
   			</div>

   		</div>

   		<div class="row" id="matchingTable">
   			<div class="col-sm-6">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		              Match A</div>

		            <div class="card-body">
		              <div class="table-responsive">
		                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>
		                      <th>ID</th>
		                      <th>Activity Code</th>
		                      <th>Description</th>
		                      <th>Match ID</th>
		                      <th></th>
		                       <th></th>
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    <tr>
		                      <th>ID</th>
		                      <th>Activity Code</th>
		                      <th>Description</th>
		                      <th>Match ID</th>
		                      <th></th>
		                       <th></th>
		                    </tr>
		                  </tfoot>
		                  <tbody>
		                  <?php
		                    $teacher_id = $_SESSION['user_id'];

		                    $sql = "SELECT 
		                    		id,
									description,
									type,
									match_answer,
									activity_code,
									teacher_id 
									FROM activity_matching 
									WHERE teacher_id = '$teacher_id' AND type = 'A'";

		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                          $id = $row['id'];
		                          $type = $row['type'];
		                          $match = $row['match_answer'];
		                          $code = $row['activity_code'];
		                          $description = $row['description'];

		                          echo '<tr>'; 
		                          echo '<td>'.$id.'</td>';
		                          echo '<td>'.$code.'</td>';
		                          echo '<td>'.$description.'</td>';
		                          echo '<td>'.$match.'</td>';
		                         
		                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditModal('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
		                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteActivity('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
   			<div class="col-sm-6">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		              Match B</div>

		            <div class="card-body">
		              <div class="table-responsive">
		                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
		                  <thead>
		                     <tr>
		                      <th>ID</th>
		                      <th>Activity Code</th>
		                      <th>Description</th>
		                      <th>Match</th>
		                      <th></th>
		                       <th></th>
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    <tr>
		                      <th>ID</th>
		                      <th>Activity Code</th>
		                      <th>Description</th>
		                      <th>Match</th>
		                      <th></th>
		                       <th></th>
		                    </tr>
		                  </tfoot>
		                  <tbody>
		                  <?php
		                    $teacher_id = $_SESSION['user_id'];

		                    $sql = "SELECT 
		                    		id,
									description,
									type,
									match_answer,
									activity_code,
									teacher_id 
									FROM activity_matching 
									WHERE teacher_id = '$teacher_id' AND type = 'B'";

		                       $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                          $id = $row['id'];
		                          $type = $row['type'];
		                          $match = $row['match_answer'];
		                          $code = $row['activity_code'];
		                          $description = $row['description'];

		                          echo '<tr>'; 
		                          echo '<td>'.$id.'</td>';
		                          echo '<td>'.$code.'</td>';
		                          echo '<td>'.$description.'</td>';
		                          echo '<td>'.$match.'</td>';
		                         
		                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditModal('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
		                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteActivity('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
   		</div><!-- row -->
       
		<div id="matchModal" class="modal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    
		    
		      <div class="modal-header">
		        <h5 class="modal-title">Modify Match Description</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		     <form action="../cli/functions.php" method="POST">
		     <input type="hidden" name="action" value="editMatchDescription">
		      <div class="match-body">
		        
		      </div>
		      <div class="modal-footer">
		        <input type="submit" name="submit" class="btn btn-primary" value="Save changes" />
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </form>
		    </div>
		  </div>
		</div>

    </div>
</div>

<script type="text/javascript">

 function showEditModal(id){    
      var id = id;            
      $('.match-body').load('../snippet/activity-match-modal.php?id=' + id,function(){           
          $('#matchModal').modal({show:true});          
     });                    
  }

function createExisting(){
	var code = $('#codeselector').val();
	//alert(code);
	window.location = "create-matching-type.php?code=" + code;
}
  function showEditClient(id){    
      var id = id;            
      $('.client-body').load('../snippet/client-modal-edit.php?id=' + id,function(){           
          $('#addnewclient').modal({show:true}); 
         
      });                    
  }
  function showDeleteActivity(id){    
      var id = id;            
      var table = "activity_matching";
      $('#tableIdActivity').val(id);
      $('#dbtableActivity').val(table);
      $('#confirmationDeleteActivity').modal({show:true}); 
     
  }
 function changeCode(val){
 	var code = val;            
      $('#matchingTable').load('../snippet/activity-matching-onchange.php?code=' + code,function(){   
      	$('#btnExistingCode').css("display","block");                           
      });     
 }
 
</script>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTable2').DataTable();
} );
</script>