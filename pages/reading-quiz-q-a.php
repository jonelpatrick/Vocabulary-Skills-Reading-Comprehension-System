<?php
	 include '../template/header.php';
   include '../cli/global-functions.php';

   define("QUESTION_CODE", "QuizQues8i");
   $question_code = QUESTION_CODE.getMaxId('quiz_q_a',$mysqli);
   $quiz_id = $_GET['id'];
?>
 <style type="text/css">
   .widgSelectBlock{
    height: 30px;
    border-radius: 5px;
   }
   .option-content{
   	    padding: 10px;
    background: #e1eaea;
    margin-bottom: 1em;
   }
   fieldset.submit{
   	margin-bottom: 1em;
   }
   label.optin{
   	margin-right: 1em;
   }
 </style>

<style type="text/css" media="all">
  @import "../css/css/info.css";
  @import "../css/css/main.css";
  @import "../css/css/widgEditor.css";
</style>
<script src="../js/widgEditor.js"></script>
  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           <a href="reading-quiz.php">Create Reading Comprehension Quiz </a>
        </li>
        <li class="breadcrumb-item">
          <a href='reading-quiz-q-a.php?id=<?php echo $quiz_id; ?>'>Create Q & A</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>  

      <div class="row">
        <div class="col-lg-12">
          <div id="content">
          <form action="../cli/functions.php" method="post">
          <input type="hidden" name="action" value="addReadingQuizQuestion">
          <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
          <input type="hidden" name="question_code" value="<?php echo $question_code; ?>">
          <div class="form-group">
            <div class="option-content">
            	<label>Type the Question here</label>	
            </div>            
            <fieldset>          
              <textarea id="noise" name="noise" class="widgEditor nothing" required=""></textarea>
            </fieldset>
          </div>  
          <hr>
          <div class="row">
          	<div class="col-lg-12">
          	  <div class="option-content">
	          	<span>Option Content - click radio button if its the correct answer</span>
	          </div>		
          	</div>
          	
          </div>
          
          <div class="row">          
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option A </label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="1"> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionA"></textarea>
          		</div>
          	</div>
          
                
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option B</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="2"> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionB"></textarea>
          		</div>
          	</div>
                
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option C</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="3"> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionC"></textarea>
          		</div>
          	</div>
                  
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option D</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="4"> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionD"></textarea>
          		</div>
          	</div>
          </div>
        
            <fieldset class="submit" style="margin-bottom: 2em;">
              <input type="submit" value="Save changes" class="btn btn-primary" />
            </fieldset>
          </form><!--form -->
          </div>
        </div>
      </div><!-- row -->
      <div class="row">
       <div class="col-lg-12">
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Question</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Question</th>
                      <th>No of Option</th>
                      <th>Correct Answer</th>                     
                      <th></th>
                   
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>Code</th>
                      <th>Question</th>
                      <th>No of Option</th>
                      <th>Correct Answer</th>                     
                      <th></th>
                   
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    
                    $sql = "SELECT 
                            id,
                            quiz_id,
                            question_code, 
                            question,
                            correct,
                            options
                            FROM quiz_q_a
                            WHERE quiz_id = '$quiz_id'                            
                            GROUP BY question_code";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $quiz_id = $row['quiz_id'];
                          $question_code = $row['question_code'];
                          $question = $row['question'];
                          $no_of_option = countQuestionOption2($quiz_id,$question_code,$mysqli);
                          $answer = numberToLetter($row['correct']);

                          echo '<tr>'; 
                          echo '<td>'.$question_code.'</td>';
                          echo '<td>'.$question.'</td>';
                          echo '<td>'.$no_of_option.'</td>';
                          echo '<td>'.$answer.'</td>';
                                                
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteQuestion('."'".$question_code."'".');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
           
          </div>
          </div>
        </div><!-- row -->
    </div>
</div>


<?php 
  include '../snippet/transaction-message.php';
?>
<style type="text/css">
  input[type=checkbox]{
      width: 30px;
      height: 30px;
  }
</style>
<script type="text/javascript">

  function showQuestion(id){    
    window.location = 'activity-create-question-summarizing.php?id=' + id;
  }
  function showDeleteQuestion(code){    
      var code = code;            
      var table = "quiz_q_a";
      $('#qcode').val(code);
      $('#dbtablequestion').val(table);
      $('#confirmationQuestion').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>