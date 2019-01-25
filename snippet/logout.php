<?php
	session_start();
	session_destroy();
	$type = $_SESSION['user_type'];
	if($type == 'school-coordinator'){
		header('Location: ../login-coordinator.php');
	}else{
		header('Location: ../login.php');	
	}
	
?>