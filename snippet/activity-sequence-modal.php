<?php 
include '../dbconnect/connect.php';
$id = $_GET['id'];

$sql = "SELECT 
		id,
		activity_code,
		question,	
		teacher_id
		FROM activity_sequence
		WHERE id = '$id'";

  $result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 

     while($row = mysqli_fetch_assoc($result)) {     	
     	$activity_code = $row['activity_code'];
     	$question = $row['question'];     	
     	$teacher_id = $row['teacher_id'];
     }
   }
?>
<input type="hidden" name="activity_id" value="<?php echo $id; ?>">
<div class="container" style="margin-top: 2em;">
	<div class="form-group">
		<label class="form-control text-muted small" style="background: #eaeaea;">Activity Code: <?php echo $activity_code; ?></label>	
	</div>
	<div class="form-group">
		<textarea class="form-control" style="height: 400px;" name="question"><?php echo $question; ?></textarea>
	</div>

</div>

