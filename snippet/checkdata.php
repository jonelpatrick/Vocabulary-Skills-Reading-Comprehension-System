<?php 
include '../dbconnect/connect.php';

if(isset($_POST['user_email'])){

	 $email = $_POST['user_email'];

	 $checkdata = "SELECT id FROM account WHERE email_address = '$email' ";

	 $query = mysqli_query($mysqli,$checkdata);

	 if(mysqli_num_rows($query)>0)
	 {
	  echo "email already exist";
	 }
	 else
	 {
	  echo "email is available";
	 }
	 exit();
}
?>