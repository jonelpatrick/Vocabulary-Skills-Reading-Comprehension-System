<?php
	 include '../template/header.php';   
   include '../cli/global-functions.php';
   $teacher_id = $_SESSION['user_id'];
   

   define("ACTIVITY_CODE", "INFLP");
   define("QUESTION_CODE", "QIN4X");
   $question_code = QUESTION_CODE.getMaxId('activity_inferencing',$mysqli);
   $activity_code = "";
   $teacher_id = $_SESSION['user_id'];
   if(isset($_GET['action']) || !empty($_GET['action'])){  

    if(isset($_GET['code']) || $_GET['code'] != ""){
      $activity_code = $_GET['code'];
    }

   }else{
    
       $activity_code = "";

   }

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
   .toolbar-inf{
        display: -webkit-inline-box;
        display: inline-box;
        margin-bottom: 1em;
   }
   .act-span{
    margin-right: 2em;
   }
   <?php if( $activity_code != "" ){ ?>
   #infForm{
    display: block !important;
   }
   #toolbarInf{
    display: none !important;
   }
   <?php }else{ ?>
   #code-content{
    display: none;
   }
   <?php } ?>
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
          <a href="activity-inferencing.php">Activity Inferencing</a>
        </li>
    
        <li class="breadcrumb-item active">Overview</li>
      </ol>  

      <div class="row">
        <div class="col-lg-12">
          <div id="content">     
             
          <div id="toolbarInf" class="toolbar-inf">
            <label class="text-muted medium radio-inline">Please select Action:</label>
            <button class="btn btn-success radio-inline" onclick="newActivity(<?php echo "'".ACTIVITY_CODE.getMaxId('activity_inferencing',$mysqli)."'"; ?>);"> New Activity</button>
            <label style="margin:0 15px;"> OR </label>
              <select id="codeselector" onchange="changeCode(this.value);" class="radio-inline form-control" style="width:40%; ">
              <?php 
                $sql = "SELECT 
                        DISTINCT activity_code                  
                        FROM activity_inferencing
                        WHERE teacher_id = '$teacher_id'";

                 $result = mysqli_query($mysqli,$sql);
                  if (mysqli_num_rows($result) > 0) { 
                     echo '<option value="nocode">Select existing...</option>';
                     while($row = mysqli_fetch_assoc($result)) {
                       echo '<option value="'.$row['activity_code'].'">'.$row['activity_code'].'</option>';
                     }
                  }
              ?>            
            </select>
          </div>

          <div id="code-content" >
            <?php  
              echo '<hr style="margin-bottom: 1em;">';
              echo '<div class="form-group">';               
              echo '<span class="text-muted medium act-span" >Activity Code: '.$activity_code.'</span>';
              echo '<button class="btn btn-warning" onclick="cancelAction()"><i class="fas fa-ban"></i> cancel</button>';
              echo '</div>';
              echo "<hr>";
            ?>
          </div>

          <form id="infForm" action="../cli/functions.php" method="post" style="display: none">
          <input type="hidden" name="action" value="createActivityInferencing">          
          <input type="hidden" name="activity_code" value="<?php echo $activity_code; ?>">
          <input type="hidden" name="question_code" value="<?php echo $question_code; ?>">
          <div class="form-group">
            <div class="option-content">
            	<label> Create Q & A </label>	
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
                      <th>Activity Code</th>
                      <th>Q Code</th>
                      <th>Question</th>
                      <th>Correct</th>                     
                      <th>No of Option</th>
                   	  <th></th>
                   	  <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>Activity Code</th>
                      <th>Q Code</th>
                      <th>Question</th>
                      <th>Correct</th>                     
                      <th>No of Option</th>
                   	  <th></th>
                   	  <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    
                    $sql = "SELECT 
                            id,
              							activity_code,
                            question_code,
              							question,
              							correct							
                            FROM activity_inferencing 
                            WHERE teacher_id = '$teacher_id'                           
                            GROUP BY question_code ";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];                          
                          $activity_code = $row['activity_code'];
                          $question = $row['question'];
                          $question_code = $row['question_code'];
                          $no_of_option = countOptionInference($id,$activity_code,$mysqli);
                          $answer = numberToLetter($row['correct']);

                          echo '<tr>'; 
                          echo '<td>'.$activity_code.'</td>';
                          echo '<td>'.$question_code.'</td>';
                          echo '<td>'.$question.'</td>';
                          echo '<td>'.$answer.'</td>';
            						  echo '<td>'.$no_of_option.'</td>';  
            						  echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditActivity('.$id.');" > <i class="fa fa-edit"></i>'.''.'</button></td>';

                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteActivity('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
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

  <div id="inferenceModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" style=" max-width: 800px;">
        <div class="modal-content">
        
        
          <div class="modal-header">
            <h5 class="modal-title">Modify Inference Question Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         <form action="../cli/functions.php" method="POST">
         <input type="hidden" name="action" value="editInferenceActivity">
          <div class="inference-body">
            
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

function newActivity(code){
  
  window.location = '../pages/activity-inferencing.php?action=new&code='+ code; 

}
function changeCode(val){
  
  window.location = '../pages/activity-inferencing.php?action=existing&code='+val; 
}


 function showEditActivity(id){    
             
      $('.inference-body').load('../snippet/activity-inferencing-modal.php?id=' + id,function(){           
         $('#inferenceModal').modal({show:true});          
      });                    
      
  }  
  function cancelAction(){
     window.location = '../pages/activity-inferencing.php'; 
  }

  function showDeleteActivity(id){    
      var id = id;            
      var table = "student";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>