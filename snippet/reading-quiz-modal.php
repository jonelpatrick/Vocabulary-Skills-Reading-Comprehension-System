<?php
include '../dbconnect/connect.php';
include '../cli/global-functions.php';

$id = $_GET['id'];

 $sql = "SELECT 
        id,
		quiz_code,
		theme,
		instruction,
		subject,
		teacher_id,
		deleted
        FROM quiz
        WHERE deleted = 0 
        AND id = '$id'";

  $result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $code = $row['quiz_code'];
      $theme = $row['theme'];
      $instruction = $row['instruction'];
      $subject = $row['subject'];
      }
   }

?>
<input type="hidden" name="quiz_id" value="<?php echo $id; ?>">
<div class="container">
	<div class="form-group">
	  	<label > Theme/Title: 
	  		<input type="text" class="form-control" name="theme" value="Reading Comprehension" readonly="">
	  	</label>
	</div>
	<div class="form-group">
	  	<label > Quiz code: 
	  		<input type="text" class="form-control" name="code" value="<?php echo $code; ?>" readonly="">
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

                     	if($subject == $id){
                     		echo '<option value="'.$id.'" selected>'.$name.'</option>';
                     	}else{
                     		echo '<option value="'.$id.'">'.$name.'</option>';	
                     	}
                     	
                     }
                    }
      			?>
      		</select>
      	</label>
      </div>
      <div class="form-group">
      	<i class="text-muted small">Note: please dont remove the html tag if not needed.</i>
      	<textarea class="form-control" name="instruction" style="height: 200px;"><?php echo $instruction; ?></textarea>
      	
      </div>
</div>