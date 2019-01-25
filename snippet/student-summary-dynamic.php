<?php 
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

$id = $_GET['id'];

$activity_code = getActivityCode($id,'activity_summarizing',$mysqli);
?>

<div class="col-lg-12">
	 <div class="card mb-3">
    <div class="card-header">
    <i class="fas fa-chalkboard-teacher"></i>
      Read Article
    </div>

     <?php
              $sql = "SELECT 
                      id,                              
                      article,
                      teacher_id,
                      activity_code	                              
                      FROM activity_summarizing 
                      WHERE deleted = 0 
                      AND activity_code = '$activity_code'";

              $result = mysqli_query($mysqli,$sql);
              if (mysqli_num_rows($result) > 0) {                         
               	                        
                 while($row = mysqli_fetch_assoc($result)) {	                          
                   	$id = $row['id'];
                   	$article  = $row['article'];
                    $noOfItems = countActivityNoOfItem4($id,'activity_summarizing_id','activity_summarizing_q_a',$mysqli);   

                    echo '<div class="form-group">';
                    echo '<div style="padding-left:2em;padding-top:1em;">'.$article.'</div>';
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
    <i class="fas fa-book"></i>
      Take the test here
    </div>
     <div class="card-body"> 
 	<?php
          $sql = "SELECT 
                  id,                              
                  question_code,
                  question,
                  correct,
                  options
                  FROM activity_summarizing_q_a 
                  WHERE activity_summarizing_id = '$id' 
                  GROUP BY question_code";

          $result = mysqli_query($mysqli,$sql);
          if (mysqli_num_rows($result) > 0) {                         
           	  
              $enum = 0;                      
             while($row = mysqli_fetch_assoc($result)) {	 

             	$id = $row['id'];
             	$question_code  = $row['question_code'];
              $question = $row['question'];
              $correct = $row['correct'];              
              $enum ++;

              echo ' <div class="form-group">';
              echo '<label class="bot-text">'.$enum.'. '.$question.'</label>';
              echo '<input type="hidden" id="questionSum'.$enum.'" value="'.$correct.'">';
              echo '</div>';

               $sql2 = "SELECT 
                    id,                                                    
                    correct,
                    options
                    FROM activity_summarizing_q_a 
                    WHERE question_code = '$question_code'";

              $result2 = mysqli_query($mysqli,$sql2);
              if (mysqli_num_rows($result2) > 0) {  
                  $opt = 0;
                  while($row2 = mysqli_fetch_assoc($result2)) {   
                    $opt++;
                    $optionVal = numToLetters($opt);
                    $options = $row2['options'];
                    echo '<div class="form-group option-tab">';
                    echo '<label class="radio-inline">';
                    echo '<input type="radio" name="option_answer'.$enum.'" value="'.$optionVal.'" >'.$options;
                    echo '</label>';
                    echo '</div>';
                  }
              }
           
            }
          }
        ?>
     
      <hr>
      <div class="form-group" style="margin:1em;">
      	<input type="submit" name="submit" value="Submit Test" class="btn btn-primary" onclick="calculateResult()">	
      </div>
    </div>            
  </div><!-- datatable -->
</div><!-- col-lg-7 -->

<script type="text/javascript">
  
    function calculateResult(){
      var items = '<?php echo $noOfItems; ?>';
      var score = 0;
      var test_type = 'Summarizing';
      var activity_code = '<?php echo $activity_code; ?>';

      for(var i = 1;i <= items; i++){

         var correct = $('#questionSum'+i).val();
         var selected_ans = $('input[name=option_answer'+ i +']:checked').val(); 
         var answer = lettersToNum(selected_ans);
         if(correct == answer){
          score++;
         }        
         
      }
      //alert('your score is: '+score);
 
    $('#content-wrapper').load('../snippet/result-page.php?score=' + score+'&type='+test_type + '&itemx=' + items + '&code=' +activity_code,function(){                              
      });   
    }

    function lettersToNum(let){

      var trans = '';

      switch(let){

        case 'a':
          trans = 1;
          break;

        case 'b':
          trans = 2;
          break;

        case 'c':
          trans = 3;
          break;

        case 'd':
          trans = 4;
          break;

        default:
          break;
      }

      return trans;
    }
</script>