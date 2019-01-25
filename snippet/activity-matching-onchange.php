<?php 
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
$activity_code = $_GET['code'];
$teacher_id = $_SESSION['user_id'];
?>

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
                
              	if($activity_code != 'All'){
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
              	}else{
              		$sql = "SELECT 
                		id,
						description,
						type,
						match_answer,
						activity_code,
						teacher_id 
						FROM activity_matching 
						WHERE teacher_id = '$teacher_id' 
						AND type = 'A'";
              	}
               

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
                
                if($activity_code != 'All'){
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
        				}else{
        					$sql = "SELECT 
                        		id,
        						description,
        						type,
        						match_answer,
        						activity_code,
        						teacher_id 
        						FROM activity_matching 
        						WHERE teacher_id = '$teacher_id' 
        						AND type = 'B'";
        				}
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