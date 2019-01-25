<?php
include '../dbconnect/connect.php';
$val = $_GET['val'];
$id = $_GET['id'];

$sql = "UPDATE activity_sequencing_step SET step = '$val' WHERE id = '$id'";
if (mysqli_query($mysqli,$sql)) {

	$_SESSION['ERR']="";		
 	

} else {
	
   $_SESSION['ERR']="Something went wrong: error(1785)";
}


?>