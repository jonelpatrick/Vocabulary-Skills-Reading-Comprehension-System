<?php
include '../dbconnect/connect.php';
include '../cli/global-functions.php';
require_once '../snippet/session.php';

$login_user = $_SESSION['user_id'];

define("UPLOAD_DIR", "../uploads/");

$class_id = $_GET['id'];

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


//class detail
$sql = "SELECT 
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
		GROUP BY section.name ";

$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 

while($row = mysqli_fetch_assoc($result)) {

	$section = $row['secname'];
	$subject = $row['subjname'];
	$day     = $row['day'];
	$time    = $row['time_from'].' - '. $row['time_to'];			                         	
	$teacher    = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
	$id      = $row['id'];

}
}		


?>
<style type="text/css">
	.thumbs2{
		border-radius: 50%;
    	width: 100px;
	}	
</style>

	<div class="form-group text-center" style="width: 100%;">
		<label class="title">Teacher: <b><?php echo $teacher; ?></b></label><br>		
		<span class="small text-muted">Section: <?php echo $section; ?></span>
		<span class="small text-muted">Subject: <?php echo $subject; ?></span>
		<br><span class="small text-muted">Day: <?php echo $day; ?></span>
		<span class="small text-muted">Time: <?php echo $time; ?></span>
	</div>
	<hr>
	 <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            
            </thead>
            <tfoot>
             
            </tfoot>
            <tbody>
             <tr>
			     <?php
					
				//classmates
				$sql = "SELECT 
						class_list_student.id id,
						student.firstname firstname,
						student.middlename middlename,
						student.lastname lastname,
						student.image_path file,
						student.id student_id
						FROM class_list_student 
						INNER JOIN student 
						ON class_list_student.student_id = student.id
						WHERE class_id = '$class_id'";

				$result = mysqli_query($mysqli,$sql);
				if (mysqli_num_rows($result) > 0) { 

				$x = 0;
				 while($row = mysqli_fetch_assoc($result)) {

				 	$firstname = $row['firstname'];
				 	$middlename = $row['middlename'];
				 	$lastname = $row['lastname'];
				 	$file_name  = $row['file'];
				 	$name = $firstname.' '.$middlename.' '.$lastname;
				 	$id = $row['id'];
				 	$student_id = $row['student_id'];

				 	if($login_user != $student_id){
				 		
				 		if($file_name == ""){
					        $file_name = 'noimage.png';
					      }

					      $path = UPLOAD_DIR.$file_name;
					      $default = '../uploads/noimage.png';
					      echo '<td align="center">';  

					       if(is_image($path)){

				              echo '<img class="thumbs2" src="'.$path.'" /><br>'; 
				          }else{
				             echo '<img class="thumbs2" src="'.$default.'" /><br>';
				          }
				          echo '<div class="form-group" style="margin-top:1em;">';
	                      echo $name.'<br>';                                            
	                
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
				}
				?>
              
              </tr>  
          </tbody>
        </table>
      </div><!--table responsive -->
