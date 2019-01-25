<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $activity_code = getActivityCode($id,'activity_inferencing',$mysqli);
  $page = 0;
  $qcode = getQuestionCode($activity_code,$mysqli);
  $question_code = $qcode[$page];
  $myscore = 0;

}else if(isset($_GET['code'])){

  $activity_code = $_GET['code'];
  $page = $_GET['page'];
  $qcode = getQuestionCode($activity_code,$mysqli);
  $myscore = $_GET['score'];

  if (empty($qcode[$page])) {
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
                                question,
                                correct,
                                options,
                                teacher_id,
                                question_code,
                                activity_code                               
                                FROM activity_inferencing                          
                                WHERE activity_code = '$activity_code' 
                                AND question_code = '$question_code'
                                GROUP BY question_code";

                        $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) {                         
                                                  
                           while($row = mysqli_fetch_assoc($result)) {                            
                            $id = $row['id'];
                            $question  = $row['question'];
                            $question_code = $row['question_code'];
                            $code = $row['activity_code'];
                            $noOfItems = countActivityNoOfItem5($code,'activity_code','activity_inferencing',$mysqli); 
                            
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
                      <div class="row">                   
                       <?php
                              $sql = "SELECT                                                     
                                      correct,
                                      options,
                                      question_code,
                                      activity_code
                                      FROM activity_inferencing                          
                                      WHERE activity_code = '$activity_code'
                                      AND question_code = '$question_code'";

                              $result = mysqli_query($mysqli,$sql);
                              if (mysqli_num_rows($result) > 0) {     

                                  $x =0;

                                 while($row = mysqli_fetch_assoc($result)) {                            
                                  $correct = $row['correct'];
                                  $options  = $row['options'];
                                    $x++;
                                    echo '<div class="form-group"  style="margin-right: 1em;">';

                                    echo '<span class="form-control option-infer" id="optionInf'.$x.'" onclick="isCorrect('.$x.');">'.$options.'</span>';
                                    echo '</div>';
                                 }
                               }
                            ?>         
                        </div>
                      <hr>
                      <div class="form-group" style="margin:1em;">
                        <button class="btn btn-primary" onclick="nextQuestion(<?php echo "'".$activity_code."'".",".($page + 1); ?>)">Next Question</button>
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


   function nextQuestion(code,page){    
    var score = $('#myscore').val();      
      $('#dynamicTest').load('../snippet/student-inference-dynamic.php?code=' + code +'&page='+page + '&score='+score,function(){                              
      });                    
  }
  
  
   function calculateResult(){
    
      var items = '<?php echo $noOfItems; ?>';
      var score = $('#myscore').val(); 
      var test_type = 'Inferencing';
      var activity_code = '<?php echo $activity_code; ?>';

 
     $('#content-wrapper').load('../snippet/result-page.php?score=' + score+'&type='+test_type + '&itemx=' + items + '&code=' +activity_code,function(){                              
      });   
    }

</script>
	
