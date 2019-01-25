<?php 
include '../dbconnect/connect.php';
include '../cli/global-functions.php';
$id = $_GET['id'];

$activity_code = getActivityCode($id,'activity_inferencing',$mysqli);

$sql = "SELECT 
		id,
		activity_code,
		question,
		correct,
		options,
		teacher_id
		FROM activity_inferencing 
		WHERE activity_code = '$activity_code'";

  $result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 
  	$opt = 0;
     while($row = mysqli_fetch_assoc($result)) {     	
     	$activity_code = $row['activity_code'];
     	$question = $row['question'];
     	$correct = $row['correct'];
     	$options[$opt] = $row['options'];
     	$teacher_id = $row['teacher_id'];

     	$opt++;
     }
   }
?>
<input type="hidden" name="activity_id" value="<?php echo $id; ?>">
<div class="container" style="margin-top: 2em;">
	<div class="form-group">
		<label class="form-control text-muted small" style="background: #eaeaea;">Activity Code: <?php echo $activity_code; ?></label>	
	</div>
	<div class="form-group">
		<i style="color:red;">*Do not remove the html tags -> just edit the text only</i>
		<textarea class="form-control" style="height: 250px;" name="question"><?php echo $question; ?></textarea>
	</div>
	  <div class="row">          
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option A </label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="1" <?php if($correct == 1){ echo 'checked';} ?>> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionA"><?php echo $options[0]; ?></textarea>
          		</div>
          	</div>
          
                
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option B</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="2" <?php if($correct == 2){ echo 'checked';} ?>> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionB"><?php echo $options[1]; ?></textarea>
          		</div>
          	</div>
                
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option C</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="3" <?php if($correct == 3){ echo 'checked';} ?>> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionC"><?php echo $options[2]; ?></textarea>
          		</div>
          	</div>
                  
          	<div class="col-lg-3">
          		<div class="form-group">
          			<label class="optin">Option D</label>
          			<label class="radio-inline">
			          <input type="radio" name="correct_answer"  value="4" <?php if($correct == 4){ echo 'checked';} ?>> Correct Answer
			        </label>
          			<textarea class="form-control" placeholder="Enter option here" name="optionD"><?php echo $options[3]; ?></textarea>
          		</div>
          	</div>
          </div>
</div>

