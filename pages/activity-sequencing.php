<?php
	include '../template/header.php';
  include '../cli/global-functions.php';

  define("ACTIVITY_CODE", "SeqN18Y");
  $_SESSION['sequence_code'] = ACTIVITY_CODE.getMaxId('activity_sequence',$mysqli);
  $activity_code = $_SESSION['sequence_code'];
  $teacher_id = $_SESSION['user_id'];
?>
 <style type="text/css">
   .widgSelectBlock{
    height: 30px;
    border-radius: 5px;
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
          <a href="activity-sequencing.php">Activity Sequencing</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>  

      <div class="row">
        <div class="col-lg-12">
          <div id="content">
          <form action="../cli/functions.php" method="post">
          <input type="hidden" name="action" value="sequence_add_activity">
          <input type="hidden" name="activity_code" value="<?php echo $activity_code; ?>">

          <div class="form-group">
            <label>Type article/Question here</label>
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
              List of Question</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">activity_code</th>
                      <th>Question</th>
                      <th width="10%">No. of Step</th>                     
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>activity_code</th>
                      <th>Question</th>
                      <th>No. of Step</th>                     
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php                    

                    $sql = "SELECT 
                            id,
                            activity_code,
                            question,
                            teacher_id
                            FROM activity_sequence
                            WHERE teacher_id = '$teacher_id'";                           

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $code = $row['activity_code'];
                          $question = $row['question'];
                          $teacher_id =$row['teacher_id'];
                          $table = 'activity_sequencing_step';
                          $item = countActivityNoOfItem($id,'activity_sequence_id',$table,$mysqli);

                          echo '<tr>'; 
                          echo '<td>'.$code.'</td>';
                          echo '<td>'.$question.'</td>';
                          echo '<td>'.$item.'</td>';
                           echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditModal('.$id.');" > <i class="far fa-edit"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showQuestion('.$id.');" > <i class="fas fa-eye"></i>'.''.'</button></td>';
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

    <div id="sequenceModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        
          <div class="modal-header">
            <h5 class="modal-title">Modify Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         <form action="../cli/functions.php" method="POST">         
          <input type="hidden" name="action" value="editSequenceQuestion">
          <div class="sequence-body">
            
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
    window.location = 'activity-sequencing-step.php?id=' + id;
  }
  function showDeleteActivity(id){    
      var id = id;            
      var table = "activity_sequence";
      $('#tableIdActivity').val(id);
      $('#dbtableActivity').val(table);
      $('#confirmationDeleteActivity').modal({show:true}); 
     
  }
   function showEditModal(id){    
      var id = id;            
      $('.sequence-body').load('../snippet/activity-sequence-modal.php?id=' + id,function(){           
          $('#sequenceModal').modal({show:true});          
     });                    
  }

 
</script>
<?php
	include '../template/footer.php';
?>