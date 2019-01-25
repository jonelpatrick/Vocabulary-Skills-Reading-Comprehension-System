<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
define("UPLOAD_DIR", "../uploads/");

$orig_class_id = $_GET['id'];
$teacher_id = $_SESSION['user_id'];


$sql = "SELECT 
		    class.id id,
        section.name secname, 
        section.grade grade,
        section.comment comment,
        subject.name subjname,  
        subject.description description,       
    		day , 
    		time_from, 
    		time_to
    		FROM class
    		INNER JOIN section ON class.section_id = section.id
    		INNER JOIN subject ON class.subject_id = subject.id        
    		WHERE class.id = '$orig_class_id'";

$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 

	 while($row = mysqli_fetch_assoc($result)) {
	 	$id          = $row['id'];
	 	$section     = $row['secname'];
	 	$grade       = $row['grade'];
	 	$comment     = $row['comment'];
	 	$subject     = $row['subjname'];
	 	$description = $row['description'];
	 	$day         = $row['day'];
	 	$time_from   = $row['time_from'];
	 	$time_to     = $row['time_to'];
	 }
}

?>
<style type="text/css">
	.text-area{
		border: 1px solid rgba(0,0,0,0.1);
    	padding: 10px;
	}
	.col-bg{
		background: #f7f7f7;
	    /* margin: 0 25px; */
	    /* width: 80%; */
	    max-width: 94.5%;
	    margin-left: 15px;
	}
	.thumbs{
		width: 65px;
	}
	.thumbs2{
		width: 100px;
	}
	input[type=checkbox]{
		width: 23px;
	    height: 23px;
	    position: absolute;
	}
  .file-trash.btn{
    position: absolute;
    background: rgba(255,255,255,0.7);
  }
   .file-trash.btn:hover{
    background: #e29113b3;
   }
   .right-btn{
    font-size: 12px;
    margin-bottom: 1em;
    /* margin-left: 2em; */
    float: right;
   }
</style>
<div class="row">
	
	<div class="col-lg-6">
		<span class="small ">Section Name: <?php echo $section; ?></span><br>
		<span class="small">Grade: <?php echo $grade; ?></span><br>
	</div>
	<div class="col-lg-6">
		<span class="small"><b>Class Schedule</b></span>
		<br>
		<span class="small">Day: <?php echo $day; ?></span>
		<br>
		<span class="small">from: <?php echo $time_from; ?> </span>
		<span class="small"> to: <?php echo $time_to; ?></span>
	</div>	

	<div class="col-lg-12 col-bg" style="margin-bottom: 2em;">
		
		<span class="small">Subject Description:</span><br>
		<div class="small text-area">
			<?php echo $description; ?>
		</div>
		<span class="small">Section/Comments:</span><br>
		<div class="small text-area">
			<?php echo $comment; ?>
		</div>
	</div>

  <div class="col-lg-6">
    <span class="small">Assigned Activities-- </span> <button  class="small btn btn-secondary right-btn" onclick="showActivityToTakeModal()"><i class="fas fa-plus-circle"></i> Add New Activity to take</button>
     <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Type</th>
                <th>Code</th>                                   
                <th></th>                      
              </tr>
            </thead>
            <tfoot>
         
            </tfoot>
            <tbody>
            <?php
              $sql = "SELECT 
                      `id`, 
                      `activity_type`, 
                      `activity_code`, 
                      `class_id`, 
                      `deleted` 
                      FROM `class_activity` 
                      WHERE class_id = '$orig_class_id' 
                      AND deleted = 0 
                      GROUP BY activity_code";

              $result = mysqli_query($mysqli,$sql);
              if (mysqli_num_rows($result) > 0) { 
                 while($row = mysqli_fetch_assoc($result)) {
                  $id = $row["id"];   
                  $activity_type = $row['activity_type'];
                  $activity_code = $row['activity_code'];
                  $class_id = $row['class_id'];
                                                    

                  echo '<tr>'; 
                  echo '<td>'.$activity_type.'</td>';
                  echo '<td>'.$activity_code.'</td>';                           
             
                  echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteSection('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                  echo '</tr>';
                 }
              }
            ?>
              
             
          </tbody>
        </table>
      </div><!--table responsive -->
  </div>	
  <div class="col-lg-6">
    <span class="small">Assigned Quizzes--- </span> <button  class="small btn btn-secondary right-btn" onclick="showQuizToTakeModal()"><i class="fas fa-plus-circle"></i> Add New Quiz to take</button>
     <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Type</th>
                <th>Code</th>                                   
                <th></th>                      
              </tr>
            </thead>
            <tfoot>
             
            </tfoot>
            <tbody>
            <?php
              $sql = "SELECT 
                      `id`, 
                      `quiz_type`, 
                      `quiz_code`, 
                      `class_id`, 
                      `deleted` 
                      FROM `class_quiz` 
                      WHERE class_id = '$orig_class_id' 
                      AND deleted = 0 
                      GROUP BY quiz_code";

              $result = mysqli_query($mysqli,$sql);
              if (mysqli_num_rows($result) > 0) { 
                 while($row = mysqli_fetch_assoc($result)) {
                  $id = $row["id"];   
                  $quiz_type = $row['quiz_type'];
                  $quiz_code = $row['quiz_code'];
                  $class_id = $row['class_id'];
                                                    

                  echo '<tr>'; 
                  echo '<td>'.$quiz_type.'</td>';
                  echo '<td>'.$quiz_code.'</td>';                           
             
                  echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteSection2('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                  echo '</tr>';
                 }
              }
            ?>
              
             
          </tbody>
        </table>
      </div><!--table responsive -->
    
  </div>  

	<div class="col-lg-12">
		<hr>
		<button class="btn btn-primary" onclick="showStudentModal()">Add Student</button>
		 <div class="table-responsive" style=" margin-top: 1em;">
            <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
              <thead>
               <tr style="font-size:13px;">List of students</tr>
              </thead>
              <tfoot>
             
              </tfoot>
              <tbody>
                <tr>
                <?php       

                    $sql = "SELECT 
                          class_list_student.id id,
                          class_list_student.class_id class_id,
                          class_list_student.student_id student_id,
                          student.image_path image_path,
                          student.firstname firstname,
                          student.middlename middlename,
                          student.lastname lastname,
                          student.physical_address address
                          FROM class_list_student
                          INNER JOIN student 
                          ON class_list_student.student_id = student.id
                          WHERE class_list_student.active = 1
                          AND class_list_student.deleted = 0
                          AND class_id = '$orig_class_id'
                          AND student.deleted = 0";

                  $result = mysqli_query($mysqli,$sql);
                  if (mysqli_num_rows($result) > 0) {                         
                    $x = 0;
                    $y = 0;

                     while($row = mysqli_fetch_assoc($result)) {

                      $id = $row['id'];
                      $file_name = $row['image_path'];
                      $firstname = $row['firstname'];
                      $middlename = $row['middlename'];
                      $lastname = $row['lastname'];
                      $physical_address = $row['address'];
                      $name = $firstname.' '.$middlename.' '.$lastname;

                      if($file_name == ""){
                        $file_name = 'noimage.png';
                      }

                      $path = UPLOAD_DIR.$file_name;
                      $default = '../uploads/noimage.png';

                      echo '<td align="center">';  
                      echo '<button class="file-trash btn" onclick="javascript:deleteFile('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';       

                      if(is_image($path)){

                          echo '<img class="thumbs2" src="'.$path.'" /><br>'; 
                      }else{
                         echo '<img class="thumbs2" src="'.$default.'" /><br>';
                      }
                     
                      echo '<div class="form-group" style="margin-top:1em;">';
                      echo $name.'<br>';                      
                      echo $physical_address.'';
                
                      echo "</div>";
                      
                      echo '</td>';
                      $x++;                             
                      if($x == 4){
                        echo '</tr>';
                        echo '<tr>';
                        $x = 0;
                      }
                      
                     }
                   }
                ?>
                 </tr>                                                                               
              </tbody>
            </table>
          </div>
	</div>
</div>
<?php

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}

?>
<!-- modal -->
<div class="modal fade " id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="    max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header" style=" background: #15e4c8;">
        <h5 class="modal-title" id="myModalLabel">List of Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <input type="hidden" name="action" value="addStudentInClass">
      <input type="hidden" name="class_id" value="<?php echo $orig_class_id; ?>">
      <div class="student-body">
        <div class="modal-body">    
            <div class="table-responsive" style=" margin-top: 1em;">
            <table class="table table-borderedless table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
              <thead>
               <tr>List of students</tr>
              </thead>
              <tfoot>
             
              </tfoot>
              <tbody>
                <tr>
                <?php
                  $sql = "SELECT 
                          id,
                          image_path,
                          firstname,
                          middlename,
                          lastname,
                          physical_address
                          FROM student
                          WHERE approved = 1
                          AND active = 1
                          AND deleted = 0";

                  $result = mysqli_query($mysqli,$sql);
                  if (mysqli_num_rows($result) > 0) {                         
                    $x = 0;
                    $y = 0;
                    while($row = mysqli_fetch_assoc($result)) {

                      $id = $row['id'];
       				        $file_name = $row['image_path'];
                      $firstname = $row['firstname'];
                      $middlename = $row['middlename'];
                      $lastname = $row['lastname'];
                      $physical_address = $row['physical_address'];
                      $name = $firstname.' '.$middlename.' '.$lastname;

                      if($file_name == ""){
                        $file_name = 'noimage.png';
                      }

                      $path = UPLOAD_DIR.$file_name;
                      $default = '../uploads/noimage.png';

                      echo '<td align="center">';  

                      echo '<input type="checkbox" name="checkboxArray[]" class="student-check" value="'.$id.'">';                    
                      if(is_image($path)){

                          echo '<img class="thumbs2" src="'.$path.'" /><br>'; 
                      }else{
                         echo '<img class="thumbs2" src="'.$default.'" /><br>';
                      }
                     
                      echo '<div class="form-group" style="margin-top:1em;">';
                      echo $name.'<br>';                      
                      echo $physical_address.'';
                
                      echo "</div>";
                      
                      echo '</td>';
                      $x++;		                          
                      if($x == 4){
                        echo '</tr>';
                        echo '<tr>';
                        $x = 0;
                      }
                      
                     }
                   }
                ?>
                 </tr>                                                                               
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Add Student</button>        
        </div>

      </form>   
    </div>
    </div>
  </div>
</div>

<!-- select activity to take modal -->
<!-- modal -->
<div class="modal fade " id="activityToTakeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" background: #cce415;">
        <h5 class="modal-title" id="myModalLabel">Select a code for each Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <input type="hidden" name="action" value="addActivityToTakeForClass">      
      <input type="hidden" name="class_id" value="<?php echo $orig_class_id; ?>">  
      <div class="activity-take-body">
        <div class="modal-body">    
           <i class="text-muted small">Note: Leave the activity if you dont want to select from it.</i>
           <!-- Matching Activity -->
           <div class="form-group">
            <label>Matching Activity: </label>
            <select name="matching_drp" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        activity_code 
                        FROM `activity_matching` 
                        WHERE teacher_id = '$teacher_id' 
                        GROUP BY activity_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select activity code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['activity_code'];                    

                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>
            <!-- Sequencing Activity -->
          <div class="form-group">
            <label>Sequencing Activity: </label>
            <select name="sequencing_drp" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        activity_code 
                        FROM `activity_sequence` 
                        WHERE teacher_id = '$teacher_id' 
                        GROUP BY activity_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select activity code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['activity_code'];                    

                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>
            <!-- Summarizing Activity -->
           <div class="form-group">
            <label>Summarizing Activity: </label>
            <select name="summarizing_drp" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        activity_code 
                        FROM `activity_summarizing` 
                        WHERE teacher_id = '$teacher_id' 
                        GROUP BY activity_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select activity code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['activity_code'];                    

                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>
            <!-- Inferencing Activity -->
           <div class="form-group">
            <label>Inferencing Activity: </label>
            <select name="inferencing_drp" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        activity_code 
                        FROM `activity_inferencing` 
                        WHERE teacher_id = '$teacher_id' 
                        GROUP BY activity_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select activity code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['activity_code'];                    

                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Submit</button>        
        </div>
      </div>
      </form>   
    </div>
    </div>
  </div>


<!-- select quiz to take modal -->
<!-- modal -->
<div class="modal fade " id="quizToTakeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" background: #cce415;">
        <h5 class="modal-title" id="myModalLabel">Select a code for each Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <input type="hidden" name="action" value="addQuizToTakeForClass">      
      <input type="hidden" name="class_id" value="<?php echo $orig_class_id; ?>">  
      <div class="activity-take-body">
        <div class="modal-body">    
           <i class="text-muted small">Note: Leave the quiz box if you dont want to select from it.</i>
           <!-- Reading Activity -->
           <div class="form-group">
            <label>Reading Comprehension Quiz: </label>
            <select name="reading_quiz" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        quiz_code 
                        FROM quiz 
                        WHERE teacher_id = '$teacher_id' 
                        AND theme = 'Reading Comprehension'
                        GROUP BY quiz_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select Quiz code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['quiz_code'];                    
                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>
            <!-- Vocabulary Quiz -->
          <div class="form-group">
            <label>Vocabulary Quiz: </label>
            <select name="vocabulary_quiz" class="form-control">
              <?php 
                $sql = "SELECT 
                        id,
                        quiz_code 
                        FROM quiz 
                        WHERE teacher_id = '$teacher_id' 
                        AND theme = 'Vocabulary'
                        GROUP BY quiz_code";

                $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                  echo '<option value="0">Select Quiz code</option>';
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $code = $row['quiz_code'];                    

                    echo '<option value="'.$code.'">'.$code.'</option>';
                  }
                }
              ?>                      
            </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Submit</button>        
        </div>
      </div>
      </form>   
    </div>
    </div>
  </div>


<script type="text/javascript">

function showStudentModal(){
  	 $('#studentModal').modal({show:true}); 
}
function showQuizToTakeModal(){
     $('#quizToTakeModal').modal({show:true}); 
}
function showActivityToTakeModal(){
     $('#activityToTakeModal').modal({show:true}); 
}
function showDeleteSection(id){
      var id = id;            
      var table = "class_activity";
      var redirect = '../snippet/class-list-dynamic.php';
      $('#tableId').val(id);  
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
}
function showDeleteSection2(id){
      var id = id;            
      var table = "class_quiz";
      var redirect = '../snippet/class-list-dynamic.php';
      $('#tableIdQ').val(id);  
      $('#dbtableQ').val(table);
      
      $('#confirmationDeleteQ').modal({show:true}); 
}
 function deleteFile(id){
      var id = id;            
      var table = "class_list_student";
      var redirect = '../snippet/class-list-dynamic.php';
      $('#tableId').val(id);  
      $('#dbtable').val(table);
      $('#redirectpage').val(redirect);
      $('#confirmationDelete').modal({show:true}); 
  }

</script>