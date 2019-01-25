<?php
   include '../template/header.php';
   include '../cli/global-functions.php';   
    $student_id = $_SESSION['user_id'];
?>
<style type="text/css">
	
	.option-tab{
		margin-left: 2em;
	}
	label.radio-inline{
		color:#495057;
	}
</style>
  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           My Quiz </a>
        </li>
        <li class="breadcrumb-item active">
        	<a href="student-quiz-reading.php">Reading Quiz</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    

      <div class="row">
      	<div class="col-sm-4">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		              Select Quiz to take
		          </div>

		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>		                      
		                      <th>Section</th>
		                      <th>Subject</th>
		                      <th>Quiz Code</th>
		                      <th>No Of Items</th>
		                      <th>Score</th>
		                      <th></th>		                     
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                  
		                    $score = 0;

		                    $sql = "SELECT 
		                            class_list_student.id id,
		                            quiz_code,
		                            quiz_type,
									section.name secname,
									subject.name subjname
		                            FROM class_quiz
		                            INNER JOIN class_list_student 
		                            ON class_quiz.class_id = class_list_student.class_id 
									INNER JOIN class
									ON class_quiz.class_id = class.id
									INNER JOIN section 
									ON class.section_id = section.id
									INNER JOIN subject 
									ON class.subject_id = subject.id
		                            WHERE class_list_student.student_id = '$student_id'
		                            AND quiz_type = 'Reading Comprehension' 
		                            GROUP BY quiz_code";		                   


		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                           	                        
		                          $code = $row['quiz_code'];
                              	  $id = getIdViaCodeQuiz($code,'quiz',$mysqli);
		                          
	                              $noOfItems = countQuizNoOfItem($id,'quiz_id','quiz_q_a',$mysqli); 
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
		                         		echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectQuiz('.$id.');" > <i class="fas fa-hand-pointer"></i>'.''.'</button></td>';

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
   			</div><!--col-lg-4 -->
   		<div class="col-lg-8">	
   			<div class="row" id="dynamicTest">
        	 <div class="col-lg-12">
             <div class="card mb-3">
                <div class="card-header">        
                <i class="fas fa-chalkboard-teacher"></i>
                  Question/ Take your quiz here
                </div>
                  
                <div class="card-body"> 
                   <div class="row">
                      
                   </div>         
                </div>
             </div>
          </div> <!--col-lg-5 -->

	          </div> <!--row -->       
      		</div>
        </div>  <!--row -->
    </div>
</div>


<script type="text/javascript">

  function deleteFile(id){
      var id = id;            
      var table = "activity_story";
      var redirect = '../pages/stories-to-read.php';
      $('#tableId02').val(id);
      $('#dbtable02').val(table);
      $('#redirectpage02').val(redirect);
      $('#confirmationDeleteFile').modal({show:true}); 
  }

  function selectQuiz(id){    
      var id = id;            
      $('#dynamicTest').load('../snippet/student-quiz-reading-dynamic.php?id=' + id,function(){                              
      });                    
  }


</script>
<?php

include '../template/footer.php';

?>