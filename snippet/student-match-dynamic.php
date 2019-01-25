<?php 
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

$id = $_GET['id'];

$activity_code = getActivityCode($id,'activity_matching',$mysqli);
?>
<div class="col-sm-7 ">
	<div class="text-center">
		<label class="title text-center"><b>Column A</b></label>	
	</div>			            		
	  <div class="table-responsive">
        <table class="table borderless" width="100%" cellspacing="0">
          <thead>
           
          </thead>
          <tfoot>
            
          </tfoot>
          <tbody>
          <?php
            $student_id = $_SESSION['user_id'];           
            $sql = "SELECT 
                		id,
          					description,
          					type,
          					match_answer,
          					activity_code,
          					teacher_id 
          					FROM activity_matching 
          					WHERE type = 'A' 
          					AND activity_code = '$activity_code'";

             $result = mysqli_query($mysqli,$sql);
              if (mysqli_num_rows($result) > 0) { 
              	$enum = 0;
                 while($row = mysqli_fetch_assoc($result)) {

                  $id = $row['id'];
                  $type = $row['type'];
                  $match = $row['match_answer'];
                  $code = $row['activity_code'];
                  $description = $row['description'];

                  $enum++;
                  echo '<tr>'; 	
                  echo '<td width="20%"><input type="text" id="ioptions'.$enum.'" name="'.$match.'" class="form-control answer-key" placeholder="Ans"></td>';                          					                          
                  echo '<td>'.$enum.'. '.$description.'</td>';					                          					                        
                  
                  echo '</tr>';
                 }
                 echo '<input type="hidden" id="testItem" value="'.$enum.'" />';
              }
          ?>

          </tbody>
        </table>
      </div>
</div>
<div class="col-sm-5">
	<div class="text-center">
		<label class="title text-center"><b>Column B</b></label>
	</div>
	  <div class="table-responsive">
        <table class="table borderless" width="100%" cellspacing="0">
          <thead>
           
          </thead>
          <tfoot>
            
          </tfoot>
          <tbody>
          <?php
  
            $sql = "SELECT 
            		id,
					description,
					type,
					match_answer,
					activity_code,
					teacher_id 
					FROM activity_matching 
					WHERE type = 'B' 
					AND activity_code = '$activity_code'";

             $result = mysqli_query($mysqli,$sql);
              if (mysqli_num_rows($result) > 0) { 
              	$enum = 0;
              	$xa = 0;
                 while($row = mysqli_fetch_assoc($result)) {

                  $id = $row['id'];
                  $type = $row['type'];
                  $match = $row['match_answer'];
                  $code = $row['activity_code'];
                  $description = $row['description'];
                  //match answer is id 
                  $columnB[$xa] = '<span type="text" id="'.$id.'">'.$description.'</span>';					                          
             
                  $xa++;
                 }
                 shuffle($columnB);
				 foreach ($columnB as $key => $value) {
				 	$enum++;
                  	$list_item = numToLetters($enum);				 	
				 	echo '<tr>'; 	
	                echo '<td class="matchingB"><label class="'.$list_item.'">'.$list_item.'.'.$value.'</label></td>';					                          					
	                echo '</tr>';
				 }
              }
          ?>
            
            
          </tbody>
        </table>
      </div><!-- table responsive -->	
	</div>
	<div class="btn-container">
    	<button class="btn btn-primary" onclick="calculateResult();">Submit Test</button>
	</div>
  <script type="text/javascript">

    function calculateResult(){
      var items = $('#testItem').val();
      var score = 0;
      var test_type = 'Matching';
      var activity_code = '<?php echo $activity_code; ?>';
      for(var i = 1;i <= items; i++){

         var correct = $('#ioptions'+i).attr('name');
         var type_ans = $('#ioptions'+i).val();
         var choose_ans = $("."+type_ans).children("span").attr("id");
         if(correct == choose_ans){
          score++;
         }
         
      }
     //alert(items+' ans: ' + type_ans + ' correct' + correct + ' choose_ans: '+ choose_ans);
     //alert('your score is' + score);
      $('#content-wrapper').load('../snippet/result-page.php?score=' + score+'&type='+test_type + '&itemx=' + items + '&code=' +activity_code,function(){                              
      });   
    }

  </script>