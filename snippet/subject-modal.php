<?php
include '../dbconnect/connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM subject WHERE id = '$id'";
$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 
 while($row = mysqli_fetch_assoc($result)) {

 	$id = $row['id'];
 	$name = $row['name'];
 	$desc = $row['description'];

 }
}

?>
<input type="hidden" name="subject_id" value="<?php echo $id; ?>">
<input type="hidden" name="action" value="editSubject">
<div class="form-group">
	<label>Subject name: </label>
	<input type="text" name="subject_name" class="form-control" value="<?php echo $name; ?>">
</div>
<div class="form-group">
	<label>Description: </label>
	<textarea name="description" class="form-control" style="height: 100px;"><?php echo $desc; ?></textarea>
</div>
