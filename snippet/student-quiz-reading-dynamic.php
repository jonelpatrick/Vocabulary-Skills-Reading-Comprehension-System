<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

if(isset($_GET['id'])){
  $quiz_id = $_GET['id'];
  $quiz_code = getQuizCode($quiz_id,'quiz',$mysqli);
  $page = 0;
  $qcode = getQuestionCodeQuiz($quiz_id,$mysqli);
  $question_code = $qcode[$page];
  $myscore = 0;  
  
 
}else if(isset($_GET['quiz_id'])){

  $quiz_id = $_GET['quiz_id'];
  $page = $_GET['page'];
  $qcode = getQuestionCodeQuiz($quiz_id,$mysqli);
  $myscore = $_GET['score'];
  $quiz_code = getQuizCode($quiz_id,'quiz',$mysqli);

  if (empty($qcode[$page])) {
  	$question_code ="";
     echo "<script> calculateResult(); </script>";
  }else{
    $question_code = $qcode[$page];
  }
}else{
  echo "Something went wrong";
}

?>
<style type="text/css">
	.option-infer{
      min-width: 275px;
    min-height: 68px;
    margin-left: 1em;
    background: #e9ece4;
    color: #000;
}
.option-infer:hover{
	background: #c2e69a;
  cursor: pointer;
}
input[type=radio]{
	width: 20px;
	height: 20px;
}

</style>
<div class="col-lg-12">
		 <div class="card mb-3">
        <div class="card-header">        
        <i class="fas fa-chalkboard-teacher"></i>
          Question
        </div>
          <input type="hidden" id="myscore" value="<?php echo $myscore; ?>">
        <div class="card-body"> 
           <div class="row">
                  <div class="col-lg-6">                  	
                  <?php
                  	
                        $sql = "SELECT 
                                id,  
                                quiz_id,                            
                                question,
                                correct,
                                options,                                
                                question_code                                                           
                                FROM quiz_q_a                         
                                WHERE quiz_id = '$quiz_id' 
                                AND question_code = '$question_code'
                                GROUP BY question_code";

                        $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) {                         
                                                  
                           while($row = mysqli_fetch_assoc($result)) {                            
                            $id = $row['id'];
                            $question  = $row['question'];
                            $question_code = $row['question_code'];                            
                            $noOfItems = countQuizNoOfItem($quiz_id,'quiz_id','quiz_q_a',$mysqli); 
                            
                              echo '<div class="form-group">';
                              echo '<div class="form-control" style="height: 400px;">'.$question.'</div>';
                              echo '</div>';
                           }
                         }
                      ?>    
                </div>
               <div class="col-lg-6">
                <!-- DataTables Example -->
                  <div class="card mb-3">
                    <div class="card-header">
                    <i class="fas fa-book"></i>
                      Choose the correct answer
                    </div>

                    <div class="card-body"> 
                      <div class="row2">                   
                       <?php
                              $sql = "SELECT                                                     
                                      correct,
                                      options,
                                      question_code,
                                      quiz_id
                                      FROM quiz_q_a                          
                                      WHERE quiz_id = '$quiz_id' 
                                      AND question_code = '$question_code'";

                              $result = mysqli_query($mysqli,$sql);
                              if (mysqli_num_rows($result) > 0) {     

                                  $x =0;

                                 while($row = mysqli_fetch_assoc($result)) {                            
                                  $correct = $row['correct'];
                                  $options  = $row['options'];
                                    $x++;
                                    echo '<div class="form-group" >';

                                   // echo '<span class="form-control option-infer" id="optionInf'.$x.'" onclick="isCorrect('.$x.');">'.$options.'</span>';
                                    echo '<input class="form-control2" type="radio" name="selectedAns" value="'.$x.'" > <span>'.$options.'</span>';
                                    echo '</div>';
                                    
                                 }
                               }
                            ?>         
                        </div>
                      <hr>
                      <div class="form-group" style="margin:1em;">
                        <button class="btn btn-primary" onclick="nextQuestion(<?php echo $quiz_id.",".($page + 1); ?>)">Next Question</button>
                        <!--
                        <input type="submit" name="submit" value="Submit Test" class="btn btn-primary"> 
                      -->
                      </div>
                    </div>            
                  </div><!-- datatable -->
              </div><!-- col-lg-6 -->
           </div>         
       	</div>
     </div>
	</div> <!--col-lg-5 -->

<script type="text/javascript">
  function isCorrect(ans){
    var correct = '<?php echo $correct; ?>';    
    var myscore = Number($('#myscore').val());

    if(ans == correct){ 
      myscore +=1;
      $('#myscore').val(myscore);
    }
    //document.write("$_SESSION['score'] "+ +" ");  
   
    $('#optionInf1').css("background-color","#e9ece4");
    $('#optionInf2').css("background-color","#e9ece4");
    $('#optionInf3').css("background-color","#e9ece4");
    $('#optionInf4').css("background-color","#e9ece4");

    $('#optionInf'+ans).css("background-color","#70d006");
    
  }


   function nextQuestion(quiz_id,page){  
    var correct = '<?php echo $correct; ?>';    
    var myscore = Number($('#myscore').val());
    var answer  = $('input[name=selectedAns]:checked').val(); 

    if(answer == correct){ 
      myscore +=1;
      $('#myscore').val(myscore);
    }

    //alert(answer + ' and correct ' + correct);
   	    
      $('#dynamicTest').load('../snippet/student-quiz-reading-dynamic.php?quiz_id=' + quiz_id +'&page='+page + '&score='+myscore,function(){                              
      });      
    
  }
  
  
   function calculateResult(){
    
      var items = '<?php echo $noOfItems; ?>';
      var score = $('#myscore').val(); 
      var test_type = 'Reading-Quiz';
      var quiz_code = '<?php echo $quiz_code; ?>';
 	//alert(items +" " + score + " "+ test_type + " " + quiz_code);	

     $('#content-wrapper').load('../snippet/result-page.php?score=' + score+'&type='+test_type + '&itemx=' + items + '&code=' + quiz_code,function(){                              
      });   
    }

</script>
	
