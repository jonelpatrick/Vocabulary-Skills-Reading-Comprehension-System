<?php
include_once("../dbconnect/connect.php");
session_start();

if(!empty($_FILES)){

	$upload_dir = "../stories/";
	$fileName = $_FILES['file']['name'];
	$title_of_story = $_POST['title_of_story'];
 	$category = $_POST['category'];
 	$uploaded_by = $_SESSION['user_id'];

	$uploaded_file = $upload_dir.$fileName;
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){

			//insert file information into db table
			$mysql_insert = "INSERT INTO activity_story (title,category,file_name,uploaded_by)
			VALUES('".$title_of_story."','".$category."','".$fileName."','".$uploaded_by."')";
			mysqli_query($mysqli, $mysql_insert) or die("database error:". mysqli_error($mysqli));
		}
}
?>