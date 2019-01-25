<?php
	include '../template/header.php';
	include '../cli/global-functions.php';

	$student_id = $_SESSION['user_id'];
?>
<style type="text/css">
	.answer-key{
		height: 25px;
	}
</style>
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
   			<div class="col-sm-4">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		             Select Activity to take
		          </div>

		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>	
		                      <th>Section</th>	                      
		                      <th>Subject</th>	                      
		                      <th>Activity Code</th>
		                      <th>No Of Items</th>
		                      <th>Score</th>
		                      <th></th>		                     
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                    $student_id = $_SESSION['user_id'];		                   

		                     $sql = "SELECT 
                                  class_list_student.id id,
                                  activity_code,
                                  activity_type,
                                  section.name secname,
                                  subject.name subjname
                                  FROM `class_activity` 
                                  INNER JOIN class_list_student 
                                  ON class_activity.class_id = class_list_student.class_id 
                                  INNER JOIN class
                                  ON class_activity.class_id = class.id
                                  INNER JOIN section 
                                  ON class.section_id = section.id
                                  INNER JOIN subject 
                                  ON class.subject_id = subject.id
                                  WHERE class_list_student.student_id = '$student_id'
                                  AND activity_type = 'Matching Type' 
                                  GROUP BY activity_code";

		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                          
		                          $type = $row['activity_type'];		                          
		                          $code = $row['activity_code'];
		                          $id = getIdViaCode($code,'activity_matching',$mysqli);

		                          $noOfItems = (countActivityNoOfItem3($code,'activity_code','activity_matching',$mysqli))/2;
		                          $score = getScore($student_id,$code,$mysqli);
		                          $isTaken = checkTestTaken($student_id,$code,$mysqli);
		                          $section = $row['secname'];
                              	  $subject = $row['subjname'];

		                          echo '<tr>'; 		                          
		                          echo '<td>'.$section.'</td>';
		                          echo '<td>'.$subject.'</td>';
		                          echo '<td>'.$code.'</td>';
		                          echo '<td>'.$noOfItems.'</td>';
		                          echo '<td>'.$score.'</td>';
		                         
		                         if(!$isTaken){     
	                                  if($noOfItems != 0){
	                                    echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectTest('.$id.');" > <i class="fas fa-hand-pointer"></i>'.''.'</button></td>';

	                                  }else{
	                                    echo '<td style="width:15px;color:red;"> <i class="fas fa-times-circle"></i>'.''.'</td>';
	                                  }                         
	                                 
	                              }else{
	                                
	                                echo '<td style="width:15px;"><i class="fas fa-check" style="color:green"></i></td>';
	                              }
		                        
		                         
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
   			<div class="col-sm-8">
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-fw fa-tachometer-alt"></i>
		              Take the Activity
		            </div>
		          	
		            <div class="card-body">
		            
		            	<div class="form-group text-center">
		            		<label class="title">Matching Type Test</label><br>
		            		<i class="small text-muted">Put your answer in the left side box of column A</i>
		            	</div>
		            	<hr>
		            	

		            	<div class="row" id="dynamicTest">
			         
			            </div><!-- dynamic test -->
			      
		            	</div><!--row -->
		            </div>
		        </div>
   			</div>
   			
   		</div><!-- row -->
       

    </div>
</div>

<script type="text/javascript">

  function selectTest(id){    
      var id = id;            
      $('#dynamicTest').load('../snippet/student-match-dynamic.php?id=' + id,function(){                              
      });                    
  }
  function showDeleteClient(id){    
      var id = id;            
      var table = "";
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