<?php
    session_set_cookie_params(10000);
	session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location: ../login.php');
	}

?>