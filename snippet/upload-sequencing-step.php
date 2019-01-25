<?php
include_once("../dbconnect/connect.php");

if(!empty($_FILES)){

	$upload_dir = "../activity.sequencing/";
	$fileName = $_FILES['file']['name'];	
 	$sequence_id = $_POST['sequence_id'];
 	

	$uploaded_file = $upload_dir.$fileName;
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){

			//insert file information into db table
			$mysql_insert = "INSERT INTO activity_sequencing_step (file_name,activity_sequence_id)
			VALUES('".$fileName."','".$sequence_id."')";
			mysqli_query($mysqli, $mysql_insert) or die("database error:". mysqli_error($mysqli));
		}
}
?>