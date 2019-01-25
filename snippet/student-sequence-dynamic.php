<?php 
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

$id = $_GET['id'];

$activity_code = getActivityCode($id,'activity_sequence',$mysqli);

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

   
?>
<div class="col-lg-12">
		 <div class="card mb-3">
        <div class="card-header">
        <i class="fas fa-chalkboard-teacher"></i>
          Instruction
        </div>

         <?php
                  $sql = "SELECT 
                          id,                              
                          question,
                          teacher_id	                              
                          FROM activity_sequence 
                          WHERE activity_code = '$activity_code'";

                  $result = mysqli_query($mysqli,$sql);
                  if (mysqli_num_rows($result) > 0) {                         
                   	                        
                     while($row = mysqli_fetch_assoc($result)) {	                          
                     	$id = $row['id'];
                     	$question  = $row['question'];

                        echo '<div class="form-group">';
                        echo '	<div style="padding-left: 2em;padding-top:1em;">'.$question.'</div>';
                        echo '</div>';
                     }
                   }
                ?>

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
            <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
              <thead>
               <tr></tr>
              </thead>
              <tfoot>
             
              </tfoot>
              <tbody>
                <tr>
                <?php
                  $sql = "SELECT 
                          id,                              
                          file_name,
                          activity_sequence_id,
                          step
                          FROM activity_sequencing_step
                          WHERE activity_sequence_id = '$id'";

                  $result = mysqli_query($mysqli,$sql);
                  if (mysqli_num_rows($result) > 0) {                         
                   $x = 0;
                    $y = 0;
                    $w = 0;

                    while($row = mysqli_fetch_assoc($result)) {

                      $step_id = $row['id'];
                      $file_name = $row['file_name'];
                      $activity_id = $row['activity_sequence_id'];                          
                      $stepdb = $row['step'];
       				         $w++;	
                      $noOfItems = countActivityNoOfItem($id,'activity_sequence_id','activity_sequencing_step',$mysqli);
                     
                      $path = UPLOAD_DIR.$file_name;
                      $default = '../system-images/no-image-step.png';

                      echo '<td align="center">';
                      echo '<span class="sequence-label" style="display:none;">'.$w.'</span>';

                     
                      if(is_image($path)){

                          echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                      }else{
                         echo '<img class="thumbs" src="'.$default.'" /><br>';
                      }
                      echo '<div class="form-group" style="margin-top:1em;">';
                      $z = 0;
                      echo '<select class="form-control selectStepX" id="selectStep'.$w.'" name="'.$stepdb.'">';
                      
                      foreach($steps as $key=>$step){		                          
                      	echo '<option value="'.$z.'">'.$step.'</span>';		
                                             
                        if($z == $noOfItems){
                          break;
                        }
                        $z++;
					            }
                      echo '</select>';
                      echo "</div>";
                      
                      echo '</td>';
                      $x++;		                          
                      if($x == 3){
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
          <hr>
          <div class="form-group" style="margin:1em;">
          	<input type="submit" onclick="calculateResult()" name="submit" value="Submit Test" class="btn btn-primary">	
          </div>
        </div>            
      </div><!-- datatable -->
  </div><!-- col-lg-7 -->
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
  <script type="text/javascript">

    function calculateResult(){
      var items = '<?php echo $noOfItems; ?>';
      var score = 0;
      var test_type = 'Sequencing';
      var activity_code = '<?php echo $activity_code; ?>';

      for(var i = 1;i <= items; i++){

         var correct = $('#selectStep'+i).attr('name');
         var selected_ans = $('#selectStep'+i).val();         
         if(correct == selected_ans){
          score++;
         }
         
      }
   //   alert('your score is: '+score);
 
     $('#content-wrapper').load('../snippet/result-page.php?score=' + score+'&type='+test_type + '&itemx=' + items + '&code=' +activity_code,function(){                              
      });   
    }

    $(".selectStepX").change(function(){
      var val = $(this).val();
      if(val == 0){
        $(this).parent().siblings(".sequence-label").css("display","none");   
      } else{
         $(this).parent().siblings(".sequence-label").css("display","block");   
        $(this).parent().siblings(".sequence-label").text(val);       
      }     
      
    // alert($(this).attr("id"));
    });


  </script>
