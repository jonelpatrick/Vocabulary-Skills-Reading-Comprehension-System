<?php
include '../dbconnect/connect.php';

$id = $_GET['id'];

$sql = "SELECT 
        section.id id,
        section.name name,
        grade,       
        comment	                            
        FROM section                
        WHERE section.deleted = 0 
        AND section.id = '$id'";

$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

      $id = $row["id"];   
      $section = $row['name'];
      $grade = $row['grade'];	  
	  $comment = $row['comment']; 
	    
	}
}

?>
<input type="hidden" name="section_id" value="<?php echo $id; ?>">
<input type="hidden" name="action" value="editSection">
<div class="form-group">
	<label>Section name: </label>
	<input type="text" name="section_name" class="form-control" required="" value="<?php echo $section; ?>">
</div>
<div class="form-group">
	<label>Grade: </label>
	<select name="grade" class="form-control">
		<option value="1" <?php if($grade == 1){echo 'selected';} ?> >Grade 1</option>
		<option value="2"  <?php if($grade == 2){echo 'selected';} ?> >Grade 2</option>
		<option value="3"  <?php if($grade == 3){echo 'selected';} ?> >Grade 3</option>
		<option value="4"  <?php if($grade == 4){echo 'selected';} ?> >Grade 4</option>
		<option value="5"  <?php if($grade == 5){echo 'selected';} ?> >Grade 5</option>
		<option value="6"  <?php if($grade == 6){echo 'selected';} ?> >Grade 6</option>
		<option value="7"  <?php if($grade == 7){echo 'selected';} ?> >Grade 7</option>
		<option value="8"  <?php if($grade == 8){echo 'selected';} ?> >Grade 8</option>
		<option value="9"  <?php if($grade == 9){echo 'selected';} ?> >Grade 9</option>
		<option value="10"  <?php if($grade == 10){echo 'selected';} ?> >Grade 10</option>
		<option value="11"  <?php if($grade == 11){echo 'selected';} ?> >Grade 11</option>
		<option value="12"  <?php if($grade == 12){echo 'selected';} ?> >Grade 12</option>
	</select>
</div>

<div class="form-group">
	<label>Comment: </label>
	<textarea name="comment" class="form-control" style="height: 100px;"><?php echo $comment; ?></textarea>
</div>