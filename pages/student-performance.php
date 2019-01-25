<!-- Note: this page is for teacher showing all performance of his/her students-- >
<?php
	include '../template/header.php';
	include '../cli/global-functions.php';
	define("UPLOAD_DIR", "../uploads/");

	$teacher_id = $_SESSION['user_id'];
?>
<style type="text/css">
	.answer-key{
		height: 25px;
	}
	.thumbs2{
	
		height: 124px;
    	border-radius: 50%;
	    border: 3px solid #3d87e2;
	}
	.sticky-footer{
		display: none !important;
	}
	.table td{
		border:none;
	}
	#myProgress {
	  width: 100%;
	  background-color: #ddd;
	  border-radius: 8px;
	  text-align: left;
	  margin-bottom: 0.1em;
	}
	#myBar {									  
	      height: 20px;
    text-align: center;
    line-height: 20px;
	  color: white;
	  border-radius: 8px;
	}
	.perf1{
		width: 15%;
		display: inline-block;
	}
	.perf2{
		width: 100% !important;
		display: inline-block;
	}
	.table td{
		width: 20%;
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
   			
   			<div class="col-sm-12">
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-fw fa-tachometer-alt"></i>
		              My Students
		            </div>
		          	
		            <div class="card-body">
		            
		            		 <div class="table-responsive">
				               
				                <table class="table table-borderless"  width="100%" >
				                
				                  <tbody>
		            		<?php 
		            			 $sql = "SELECT 
		            			 		a.id id,
		            			 		a.student_id sid, 
            			 				b.firstname firstname,
            			 				b.middlename middlename, 
            			 				b.lastname lastname, 
            			 				b.image_path image_path, 
            			 				d.name section
										FROM class_list_student a
										INNER JOIN student b ON a.student_id = b.id
										INNER JOIN class c ON a.class_id = c.id
										INNER JOIN section d ON c.section_id = d.id
										WHERE c.teacher_id = '$teacher_id' 
										AND b.deleted = 0";

			                    $result = mysqli_query($mysqli,$sql);
			                    $x = 0;
			                    if (mysqli_num_rows($result) > 0) { 
			                    	echo '<tr>';
			                        while($row = mysqli_fetch_assoc($result)) {

			                        	if($row['image_path'] == ""){
			                        		$file = UPLOAD_DIR.'noimage.png';
			                        	}else{
			                        		$file = UPLOAD_DIR.$row['image_path'];	
			                        	}
			                        	
			                        	$name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
			                        	$section = $row['section'];
			                        	$id = $row['id']; 
			                        	$student_id = $row['sid'];

			                        	$arr[0] = 'Reading-Quiz';
			                        	$arr[1] = 'Vocabulary-Quiz';
			                        	$arr[2] = 'Summarizing';
			                        	$arr[3] = 'Sequencing';
			                        	$arr[4] = 'Matching';
			                        	$arr[5] = 'Inferencing';

			                        	$readingPHP = getQuizPerformance($student_id,'Reading-Quiz',$mysqli);
										$performance = getQuizPerformance($student_id,'Vocabulary-Quiz',$mysqli);


			                        	echo '<td align="center">';
			                        	echo '<a href="myperformance.php?id='.$student_id.'&section='.$section.'" target="_blank" title="click to view full report">';
			                        	echo '<img src="'.$file.'" class="thumbs2" >';
			                        	echo '<div>';
			                        	echo '<span class="text-muted small">'.$name.'</span><br>';
			                        	echo '<span class="text-muted small">Section: '.$section.'</span>';
			                        	echo '</div>';
			                        	echo '</a>';
			                        	
			                        	for($sawr = 0; $sawr < 6; $sawr++ ){

			                        		$performance = getActivityPerformance($student_id,$arr[$sawr],$mysqli);
				                        	 echo '<div class="perf2" id="myProgress" title="'.$arr[$sawr].'">';
				                         	 if($performance >= 51){
				                         	 	$bgcolor = '#6fad0c';
				                         	 }else{
				                         	 	$bgcolor = '#ff4209';
				                         	 }
				                         	 echo '<input type="hidden"  value="'.$performance.'">';
				                         	 echo '<div id="myBar" style="background-color:'.$bgcolor.';width: '.$performance.'%"> '.$performance.'% </div>';
				                         	 echo '</div>';

			                        	}
			            
			                        	echo '</td>';

			                        	if($x > 3){

			                        		echo '</tr>';
			                        		echo '<tr>';
			                        		$x=0;
			                        	}
			                        	$x++;

			                        }
			                    }
			                    echo '</tr>';
		            		?>

		            		    </tbody>
				                </table>
				              </div>

			        
			      
		            </div>
		        </div>
		    </div>
   		</div>
   			
   	</div><!-- row -->       

</div>

<?php
	include '../template/footer.php';
?>
