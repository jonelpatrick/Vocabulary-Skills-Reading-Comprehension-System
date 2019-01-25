<?php
include_once("../dbconnect/connect.php");
session_start();

if(!empty($_FILES)){

	$upload_dir = "../stories/";
	$fileName = $_FILES['file']['name'];
	$story_id = $_POST['story_id']; 	 	

	$uploaded_file = $upload_dir.$fileName;
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){

			//insert file information into db table
			$mysql_insert = "INSERT INTO activity_story_pages (activity_story_id,file_name)
			VALUES('".$story_id."','".$fileName."')";
			mysqli_query($mysqli, $mysql_insert) or die("database error:". mysqli_error($mysqli));
		}
}
?>