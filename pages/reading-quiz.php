<?php
  include '../template/header.php';
  include '../cli/global-functions.php';

  define("QUIZ_CODE", "Quiz8G");
  
  $quiz_code = QUIZ_CODE.getMaxId('quiz',$mysqli);

  $teacher_id = $_SESSION['user_id'];
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
        <li class="breadcrumb-item active">Overview</li>
      </ol>  

      <div class="row">
        <div class="col-lg-12">
          <div id="content">
          <form action="../cli/functions.php" method="post">          
          <input type="hidden" name="action" value="addReadingQuiz">
          <input type="hidden" name="quiz_code" value="<?php echo $quiz_code; ?>">
          <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">

          <div class="form-group">
          	<label > Theme/Title: 
          		<input type="text" class="form-control" name="theme" value="Reading Comprehension" readonly="">
          	</label>
          </div>

           <div class="form-group">
          	<label > Select Subject 
          		<select name="subject" class="form-control" required="">
          			<?php
          				$sql = "SELECT 
          						id,
          						name
          						FROM subject
          						WHERE deleted = 0";
          				$result = mysqli_query($mysqli,$sql);
                     	if (mysqli_num_rows($result) > 0) { 
                     		echo '<option value="0">Select a subject here</option>';
                         while($row = mysqli_fetch_assoc($result)) {
                         	$id   = $row['id'];
                         	$name = $row['name'];
                         	echo '<option value="'.$id.'">'.$name.'</option>';
                         }
                        }
          			?>
          		</select>
          	</label>
          </div>

          <div class="form-group ">
            <div class="option-content">
             <label>Instruction/Description</label>
            </div>
            <fieldset>          
              <textarea id="noise" name="noise" class="widgEditor nothing" required=""></textarea>
            </fieldset>
          </div>  
        
            <fieldset class="submit" style="margin-bottom: 2em;">
              <input type="submit" value="Save changes" class="btn btn-primary" />
            </fieldset>

          </form>
          </div>
        </div>
      </div><!-- row -->
      <div class="row">
       <div class="col-lg-12">
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Quizzes</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>quiz_code</th>
                      <th>theme</th>
                      <th>subject</th>                     
                      <th>Instruction</th>
                      <th># of Item</th>
                      <th></th>
                      <th></th>
                       <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>Code</th>
                      <th>Theme</th>
                      <th>Subject</th>                     
                      <th>Instruction</th>
                      <th># of Item</th>
                      <th></th>
                      <th></th>
                       <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    
                    $sql = "SELECT 
                            quiz.id id,
							quiz_code,
							theme,
							instruction,
							subject.name subject,
							quiz.teacher_id teacher_id,
							quiz.deleted deleted
                            FROM quiz 
                            INNER JOIN subject
                            ON quiz.subject = subject.id
                            WHERE quiz.deleted = 0 
                            AND theme = 'Reading Comprehension'
                            AND quiz.teacher_id = '$teacher_id'";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $code = $row['quiz_code'];
                          $theme = $row['theme'];
                          $instruction = $row['instruction'];
                          $subject = $row['subject'];

                          $table = "quiz_q_a";
                          $no_of_question = countActivityNoOfItem2($id,'quiz_id',$table,$mysqli);

                          echo '<tr>'; 
                          echo '<td>'.$code.'</td>';
                          echo '<td>'.$theme.'</td>';
                          echo '<td>'.$subject.'</td>';
                          echo '<td>'.$instruction.'</td>';
                          echo '<td>'.$no_of_question.'</td>';
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditModal('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showQuestion('.$id.');" > <i class="fas fa-eye"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteStudent('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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

 <div id="quizModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        
          <div class="modal-header">
            <h5 class="modal-title">Quiz Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         <form action="../cli/functions.php" method="POST">         
          <input type="hidden" name="action" value="editReadingQuiz">
          <div class="quiz-body">
            
          </div>
          <div class="modal-footer">
            <input type="submit" name="submit" class="btn btn-primary" value="Save changes" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
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
    window.location = 'reading-quiz-q-a.php?id=' + id;
  }

  function showDeleteStudent(id){    
      var id = id;            
      var table = "student";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }
  function showEditModal(id){    
      var id = id;            
      $('.quiz-body').load('../snippet/reading-quiz-modal.php?id=' + id,function(){           
          $('#quizModal').modal({show:true});          
     });                    
  }

 
</script>
<?php
	include '../template/footer.php';
?>