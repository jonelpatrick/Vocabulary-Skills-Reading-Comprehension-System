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
          <a href="student-my-class.php">My Class</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>       		

   		<div class="row">
   			<div class="col-sm-6">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		             List of classes
		          </div>

		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>		                      
		                      <th>Section</th>
		                      <th>Subject</th>
		                      <th>Day</th>
		                      <th>Time</th>		                     
		                      <th>Teacher</th>	
		                      <th></th>
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                                     
		                    $sql = "SELECT class_id FROM class_list_student 
		                    		WHERE student_id = '$student_id'";

		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                          	$class_id = $row['class_id'];

		                          	$sql2 = "SELECT 
		                          			class.id id,
		                          			section.name secname,
		                          			subject.name subjname,
		                          			day,
		                          			time_from,
		                          			time_to,
		                          			teacher.firstname firstname,
		                          			teacher.middlename middlename,
		                          			teacher.lastname lastname 
		                          			FROM class 
		                          			INNER JOIN section 
		                          			ON class.section_id = section.id 
		                          			INNER JOIN subject 
		                          			ON class.subject_id = subject.id 
		                          			INNER JOIN teacher 
		                          			ON class.teacher_id = teacher.id 
		                          			WHERE class.id = '$class_id'
		                          			GROUP BY section.name";

		                          	$result2 = mysqli_query($mysqli,$sql2);
			                      	if (mysqli_num_rows($result2) > 0) { 

			                         while($row2 = mysqli_fetch_assoc($result2)) {
			                         	$section = $row2['secname'];
			                         	$subject = $row2['subjname'];
			                         	$day     = $row2['day'];
			                         	$time    = $row2['time_from'].' - '. $row2['time_to'];			                         	
			                         	$name    = $row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'];
			                         	$id      = $row2['id'];

			                         	  echo '<tr>'; 		                          
				                          echo '<td>'.$section.'</td>';
				                          echo '<td>'.$subject.'</td>';
				                          echo '<td>'.$day.'</td>';		                                                 
				                          echo '<td>'.$time.'</td>';
				                          echo '<td>'.$name.'</td>';	
				                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectClass('.$id.');" > <i class="fas fa-hand-pointer"></i>'.''.'</button></td>';	
				                          echo '</tr>';
			                         }
			                        }		

		                        
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
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-fw fa-tachometer-alt"></i>
		              My Classmates
		            </div>
		          	
		            <div class="card-body">
		            	<div class="row" id="dynamicClass">

			            </div><!-- dynamic test -->
			      
		            	</div><!--row -->
		            </div>
		        </div>
   			</div>
   			
   		</div><!-- row -->
       

    </div>
</div>

<script type="text/javascript">

  function selectClass(id){    
      var id = id;            
      $('#dynamicClass').load('../snippet/student-my-class-dynamic.php?id=' + id,function(){                              
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