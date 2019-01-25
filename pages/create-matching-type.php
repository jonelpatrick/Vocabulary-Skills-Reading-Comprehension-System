<?php
	include '../template/header.php';
  define("ACTIVITY_CODE", "Match18X");
  include '../cli/global-functions.php';

  $activity_code = $_SESSION['match_code'];
  if(isset($_GET['code']) || !empty($_GET['code'])){
      $activity_code = $_GET['code'];
  }

?>
 <style type="text/css">
   .widgSelectBlock{
    height: 30px;
    border-radius: 5px;
   }
 </style>

<style type="text/css" media="all">
	@import "../css/css/info.css";
	@import "../css/css/main.css";
	@import "../css/css/widgEditor.css";
</style>
<script src="../js/widgEditor.js"></script>

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="activity-matching-type.php">Activity Matching Type</a>
        </li>
        <li class="breadcrumb-item">
          <a href="create-matching-type.php">Create Matching Type</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

   		<div class="row">
        <div class="col-lg-12">
          <div class="form-group">
          <label class="text-muted small form-control">Activity Code: <?php echo $activity_code; ?></label>
          </div>  
        </div>
        
        <hr>  
      </div>

   		<div id="content">
		
  			<form action="../cli/functions.php" method="POST">
        <input type="hidden" name="action" value="create_matching_type">
        <input type="hidden" name="activity_code" value="<?php echo $activity_code; ?>">

        <div class="form-group">
          <label>Type description here for Match A</label>
  				<fieldset>  				
  					<textarea id="noise" name="noise" class="widgEditor nothing" required=""></textarea>
  				</fieldset>
        </div>  
        <div class="form-group">
        <label>Type description here for Match B</label>
          <fieldset>         
            <textarea id="noise2" name="noise2" class="widgEditor nothing" required=""></textarea>
          </fieldset>
  			</div>	
  				<fieldset class="submit">
  					<input type="submit" value="Save changes" class="btn btn-primary" />
  				</fieldset>
  			</form>
  			
  		</div>

      <div class="row" style="margin-top: 2em;">
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
                  WHERE teacher_id = '$teacher_id' 
                  AND type = 'A' 
                  AND activity_code = '$activity_code'";

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
                             
                              echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditClient('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
                              echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteClient('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
                  WHERE teacher_id = '$teacher_id' 
                  AND type = 'B'
                  AND activity_code = '$activity_code'";

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
                             
                              echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditClient('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
                              echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteClient('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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
    </div>

</div>


<script type="text/javascript">

  function showEditClient(id){    
      var id = id;            
      $('.client-body').load('../snippet/client-modal-edit.php?id=' + id,function(){           
          $('#addnewclient').modal({show:true}); 
         
      });                    
  }
  function showDeleteClient(id){    
      var id = id;            
      var table = "client";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
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