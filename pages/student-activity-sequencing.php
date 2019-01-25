<?php
   include '../template/header.php';
   include '../cli/global-functions.php';
   define("UPLOAD_DIR", "../activity.sequencing/");
   
   $steps = array(	"Select step",
   					"First", 
   					"Second", 
   					"Third",
   					"Fourth",
   					"Fifth",
   					"Sixth",
   					"Seventh",
   					"Eight",
   					"Nineth",
   					"Tenth",
   					"Eleventh",
   					"Twelve",
   					"Thirteenth",
   					"Last"); 

   	$student_id = $_SESSION['user_id'];
?>
<style type="text/css">
	.thumbs{
		width: 150px;
	}
	button.file-trash{
		position: absolute;
    	background: #f9190e;
	}
	.code{
		border: 1px solid rgba(0,0,0,0.1);
	    padding: 5px 20px;
	    border-radius: 5px;
	    color: #b1aeae;
	}
	.sequence-label{
		position: absolute;
	    background: #e514fd;
	    padding: 10px 20px;
	    border-radius: 50%;
	    color: #fff;
	    font-weight: 800;	
	}
</style>
  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           My Activity </a>
        </li>
        <li class="breadcrumb-item active">
        	<a href="student-activity-sequencing.php">Activity Sequence</a>
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
		                      <th width="5%">Score</th>
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
                                  AND activity_type = 'Sequencing' 
                                  GROUP BY activity_code";


		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row = mysqli_fetch_assoc($result)) {
		                                                    		                         
		                          $code = $row['activity_code'];
		                          $id = getIdViaCode($code,'activity_sequence',$mysqli);		                          
		                          
		                          $noOfItems = countActivityNoOfItem($id,'activity_sequence_id','activity_sequencing_step',$mysqli);
		                          $isTaken = checkTestTaken($student_id,$code,$mysqli);
		                          $score = getScore($student_id,$code,$mysqli);
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
   			</div><!--col-lg-4 -->
   		<div class="col-lg-8" id="dynamicTest">	
	      	<div class="col-lg-12">
	      		 <div class="card mb-3">
		            <div class="card-header">
		            <i class="fas fa-chalkboard-teacher"></i>
		              Instruction
		            </div>

		            

		            <div class="card-body"> 

		           	</div>
		         </div>
	      	</div> <!--col-lg-5 -->

	      	<div class="col-lg-12">
	       		<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		            <i class="fas fa-images"></i>
		              Arrange the image in order base on the instruction given
		            </div>

		            <div class="card-body">                                           
		              <div class="table-responsive">
		              
		              </div>
		              <hr>
		              <div class="form-group" style="margin:1em;">
			          	<input type="submit" name="submit" value="Submit Test" class="btn btn-primary">	
			          </div>
		            </div>            
		          </div><!-- datatable -->
	          </div><!-- col-lg-7 -->
	        	          
      		</div>
        </div>  <!--row -->
    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="storyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" background: #15e4c8;">
        <h5 class="modal-title" id="myModalLabel">Book Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <div class="student-body">
        <div class="modal-body">
    
        <p> This will show all inner pages of the book</p>
        <p> Read here</p>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
        </div>

      </form>   
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function selectTest(id){    
      var id = id;            
      $('#dynamicTest').load('../snippet/student-sequence-dynamic.php?id=' + id,function(){                              
      });                    
  }
  function readStory(id){
  	 $('#storyModal').modal({show:true}); 
  }
  function deleteFile(id){
      var id = id;            
      var table = "activity_story";
      var redirect = '../pages/stories-to-read.php';
      $('#tableId02').val(id);
      $('#dbtable02').val(table);
      $('#redirectpage02').val(redirect);
      $('#confirmationDeleteFile').modal({show:true}); 
  }

</script>
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

include '../template/footer.php';

?>