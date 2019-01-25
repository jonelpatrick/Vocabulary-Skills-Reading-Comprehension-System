<?php 
 include '../dbconnect/connect.php';
 session_set_cookie_params(600);
 session_start();

if($_POST['login']){

	$email = $_POST['email'];
	$password = mysql_real_escape_string($_POST['password']);
 	$academic_relation = $_POST['academic_relation'];
 	
 	//student
 	if($academic_relation == 0){
 		$sql = "SELECT 
 				student.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path 
 				FROM student 
 				INNER JOIN account 
 				ON student.account_id = account.id 
 				WHERE active = 1 
 				AND approved = 1 
 				AND email_address = '$email' 
 				AND password = '$password' 
                AND student.deleted = 0"; 

 		$_SESSION['user_type'] = 'student';

 	}else if($academic_relation == 1){ //teacher

 		$sql = "SELECT 
 				teacher.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path 
 				FROM teacher 
 				INNER JOIN account 
 				ON teacher.account_id = account.id 
 				WHERE active = 1 
 				AND approved = 1 
 				AND email_address = '$email' 
 				AND password = '$password' 
                AND teacher.deleted = 0"; 	

 		$_SESSION['user_type'] = 'teacher';	
 	}else{

 		$sql = "SELECT 
 				school_coordinator.id id,
 				firstname,
 				middlename,
 				lastname,
                image_path 
 				FROM school_coordinator 
 				INNER JOIN co_account 
 				ON school_coordinator.co_account_id = co_account.id 
 				WHERE active = 1  				
 				AND email_address = '$email' 
 				AND password = '$password'
                AND school_coordinator.deleted = 0"; 

 		$_SESSION['user_type'] = 'school-coordinator';
 	}

 	$result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
         while($row = mysqli_fetch_assoc($result)) {
         	
         	$id = $row['id'];
         	$firstname = $row['firstname'];
         	$middlename = $row['middlename'];
         	$lastname = $row['lastname'];
            $image_path = $row['image_path'];
            
            if($image_path == "" || $image_path == NULL){
                $image_path = "noimage.png";
            }
         }
    }else{
    	$_SESSION['ERR'] = "Login error. please try again!";
    	if($academic_relation == 3){
    		header('Location: ../login-coordinator.php');exit;
    	}else{
    		header('Location: ../login.php');exit;	
    	}
    	
    }
 	
}

$_SESSION['user'] = $firstname.' '.$middlename.' '.$lastname;
$_SESSION['user_id'] = $id;
$_SESSION['image_path'] = $image_path;

header('Location: ../pages/dashboard.php');
echo $id.'<br>';
echo $firstname.'<br>';
echo $middlename.'<br>';
echo $lastname.'<br>';



?>