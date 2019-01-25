<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include 'global-functions.php';

 define("UPLOAD_DIR", "../uploads/");

$action = $_POST["action"];
$_SESSION['ERR']="";

switch ($action) {
   
    case 'confirmDelete':
    	confirmDelete($mysqli);
	    break; 

	case 'register' :
		register($mysqli);
		break;	

	case 'editStudentAccount' :
		editStudentAccount($mysqli);
		break;	

	case 'editTeacherAccount' :
		editTeacherAccount($mysqli);
		break;		

	case 'addCoordinatorAccount' :
		addCoordinatorAccount($mysqli);
		break;

	case 'editCoordinatorAccount' :
		editCoordinatorAccount($mysqli);
		break;	

	case 'updateProfilestudent' :
		updateProfilestudent($mysqli);
		break;	

	case 'updateProfileteacher' :
		updateProfileteacher($mysqli);
		break;	

	case 'updateProfileschool-coordinator' :
		updateProfileschoolcoordinator($mysqli);
		break;

	case 'addSubject' :
		addSubject($mysqli);
		break;

	case 'editSubject' :
		editSubject($mysqli);
		break;

	case 'addSection' :
		addSection($mysqli);
		break;

	case 'editSection' :
		editSection($mysqli);
		break;

	case 'createClass' :
		createClass($mysqli);
		break;

	case 'create_matching_type' :
		createMatchingType($mysqli);
		break;

	case 'editMatchDescription' :
		editMatchDescription($mysqli);
		break;

	case 'confirmDeleteACtivitiy':
		confirmDeleteACtivitiy($mysqli);
		break;

	case 'sequence_add_activity':
		sequenceAddActivity($mysqli);
		break;

	case 'activityAddSummary':
		activityAddSummary($mysqli);
		break;

	case 'createSummaryQuestion':
		createSummaryQuestion($mysqli);
		break;

	case 'editSequenceQuestion':
		editSequenceQuestion($mysqli);
		break;

	case 'editSummaryQuestion':
		editSummaryQuestion($mysqli);
		break;

	case 'createActivityInferencing':
		createActivityInferencing($mysqli);
		break;

	case 'editInferenceActivity':
		editInferenceActivity($mysqli);
		break;

	case 'submitTestMatching':
		submitTestMatching($mysqli);
		break;

	case 'addStudentInClass':
		addStudentInClass($mysqli);
		break;

	case 'addActivityToTakeForClass':
		addActivityToTakeForClass($mysqli);
		break;

	case 'addQuizToTakeForClass':
		addQuizToTakeForClass($mysqli);
		break;

	case 'addReadingQuiz':
		addReadingQuiz($mysqli);
		break;

	case 'editReadingQuiz':
		editReadingQuiz($mysqli);
		break;

	case 'addReadingQuizQuestion':
		addReadingQuizQuestion($mysqli);
		break;

	case 'addVocabularyQuiz':
		addVocabularyQuiz($mysqli);
		break;

	case 'editVocabularyQuiz':
		editVocabularyQuiz($mysqli);
		break;

	case 'addVocabularyQuizQuestion':
		addVocabularyQuizQuestion($mysqli);
		break;

	case 'confirmDeleteQuestion':
		confirmDeleteQuestion($mysqli);
		break;

	case 'confirmDeleteStory':
		confirmDeleteStory($mysqli);
		break;

	default:
		echo "Something went wrong";
		exit;
		break;
}

function confirmDeleteStory($mysqli){
	$id = $_POST['storyid'];
	$table = $_POST['storytable'];

	$sql = "DELETE FROM ".$table." WHERE id =".$id;
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(StoryER)";
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addVocabularyQuizQuestion($mysqli){

	$quiz_id = $_POST['quiz_id'];
	$question = addslashes($_POST['noise']);
	$correct_answer = $_POST['correct_answer'];
	$option = array(addslashes($_POST['optionA']),addslashes($_POST['optionB']),addslashes($_POST['optionC']),addslashes($_POST['optionD']));	
	$question_code = $_POST['question_code'];

	for($x = 0; $x<=3; $x++){

		if($option[$x] != ""){
		
			$sql = "INSERT INTO quiz_q_a
					(quiz_id,
					question_code,
					question,
					correct,
					options)
					VALUES
					('$quiz_id',
					'$question_code',
					'$question',
					'$correct_answer',
					'$option[$x]')";


			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(QuizTRV)";
			}
		}
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editVocabularyQuiz($mysqli){
	$subject = $_POST['subject'];
	$instruction = $_POST['instruction'];
	$quiz_id = $_POST['quiz_id'];

	$sql = "UPDATE quiz 
			SET 
			subject = '$subject',
			instruction = '$instruction'
			WHERE id = '$quiz_id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(14QEV)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addVocabularyQuiz($mysqli){
	$quiz_code = $_POST['quiz_code'];
	$teacher_id = $_POST['teacher_id'];
	$theme = $_POST['theme'];
	$instruction = addslashes($_POST['noise']);
	$subject = $_POST['subject'];//id
	/*
	echo $quiz_code.'<br>';
	echo $teacher_id.'<br>';
	echo $theme.'<br>';
	echo $instruction.'<br>';
	echo $subject.'<br>';
	*/
	$sql = "INSERT INTO quiz 
			(quiz_code,
			theme, 
			instruction,
			subject, 
			teacher_id)
			VALUES
			('$quiz_code',
			'$theme',
			'$instruction',
			'$subject',
			'$teacher_id')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(14QV)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
//reading
function addReadingQuizQuestion($mysqli){

	$quiz_id = $_POST['quiz_id'];
	$question = addslashes($_POST['noise']);
	$correct_answer = $_POST['correct_answer'];
	$option = array(addslashes($_POST['optionA']),addslashes($_POST['optionB']),addslashes($_POST['optionC']),addslashes($_POST['optionD']));	
	$question_code = $_POST['question_code'];

	for($x = 0; $x<=3; $x++){

		if($option[$x] != ""){
		
			$sql = "INSERT INTO quiz_q_a
					(quiz_id,
					question_code,
					question,
					correct,
					options)
					VALUES
					('$quiz_id',
					'$question_code',
					'$question',
					'$correct_answer',
					'$option[$x]')";


			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(QuizTR)";
			}
		}
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editReadingQuiz($mysqli){
	$subject = $_POST['subject'];
	$instruction = $_POST['instruction'];
	$quiz_id = $_POST['quiz_id'];

	$sql = "UPDATE quiz 
			SET 
			subject = '$subject',
			instruction = '$instruction'
			WHERE id = '$quiz_id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(14QE)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addReadingQuiz($mysqli){
	$quiz_code = $_POST['quiz_code'];
	$teacher_id = $_POST['teacher_id'];
	$theme = $_POST['theme'];
	$instruction = addslashes($_POST['noise']);
	$subject = $_POST['subject'];//id
	/*
	echo $quiz_code.'<br>';
	echo $teacher_id.'<br>';
	echo $theme.'<br>';
	echo $instruction.'<br>';
	echo $subject.'<br>';
	*/
	$sql = "INSERT INTO quiz 
			(quiz_code,
			theme, 
			instruction,
			subject, 
			teacher_id)
			VALUES
			('$quiz_code',
			'$theme',
			'$instruction',
			'$subject',
			'$teacher_id')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(14Q)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addQuizToTakeForClass($mysqli){
	$arr[0]     = $_POST['reading_quiz'];
	$arr[1]     = $_POST['vocabulary_quiz'];	

	$arrType[0] = 'Reading Comprehension';
	$arrType[1] = 'Vocabulary';	

	$class_id   = $_POST['class_id'];

	for($x = 0; $x<sizeof($arr); $x++){

		if(!empty($arr[$x]) || $arr[$x] == ""){
			$sql = "INSERT INTO class_quiz 
					(quiz_type,
					quiz_code,
					class_id)
					VALUES
					('$arrType[$x]',
					'$arr[$x]',
					'$class_id')";

			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(14QE)";
			}
		}
	}

	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addActivityToTakeForClass($mysqli){
	$arr[0]     = $_POST['matching_drp'];
	$arr[1]     = $_POST['sequencing_drp'];
	$arr[2]     = $_POST['summarizing_drp'];
	$arr[3]     = $_POST['inferencing_drp'];

	$arrType[0] = 'Matching Type';
	$arrType[1] = 'Sequencing';
	$arrType[2] = 'Summarizing';
	$arrType[3] = 'Inferencing';

	$class_id   = $_POST['class_id'];

	for($x = 0; $x<sizeof($arr); $x++){

		if(!empty($arr[$x]) || $arr[$x] == ""){
			$sql = "INSERT INTO class_activity 
					(activity_type,
					activity_code,
					class_id)
					VALUES
					('$arrType[$x]',
					'$arr[$x]',
					'$class_id')";

			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(14S)";
			}
		}
	}

	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addStudentInClass($mysqli){
	if(!empty($_POST['checkboxArray'])) {
		$class_id = $_POST['class_id'];

	    foreach($_POST['checkboxArray'] as $check) {
	        $sql = "INSERT INTO class_list_student
	         		(class_id,
					student_id)
	         		VALUES
	         		('$class_id',
	         		'$check')";

	        if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(14)";
			}
	    }
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editInferenceActivity($mysqli){
	$question = $_POST['question'];
	$correct_answer = $_POST['correct_answer'];
	$options = array($_POST['optionA'],$_POST['optionB'],$_POST['optionC'],$_POST['optionD']);	
	$id = $_POST['activity_id'];

	for($x = 0; $x<=3; $x++){
		$id += $x;
		if($options[$x] != ""){
		
			$sql = "UPDATE activity_inferencing 
					SET 
					question = '$question',
					correct_answer = $correct_answer,
					options = '$options[$x]'
					WHERE id = '$id'";

			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(1745LRSAB)";
			}
		}
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function createActivityInferencing($mysqli){
	
	$question = addslashes($_POST['noise']);
	$correct_answer = $_POST['correct_answer'];
	$option = array($_POST['optionA'],$_POST['optionB'],$_POST['optionC'],$_POST['optionD']);	
	$activity_code = $_POST['activity_code'];
	$teacher_id = $_SESSION['user_id'];
	$question_code = $_POST['question_code'];

	for($x = 0; $x<=3; $x++){

		if($option[$x] != ""){
		
			$sql = "INSERT INTO activity_inferencing
					(activity_code,
					question,
					question_code,
					correct,
					options,
					teacher_id)
					VALUES
					('$activity_code',
					'$question',
					'$question_code',
					'$correct_answer',
					'$option[$x]',
					'$teacher_id')";

			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(1745LRSA)";
			}
		}
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
//	header('Location: ../pages/activity-inferencing.php?action=new&code=true');
}

function editSummaryQuestion($mysqli){

	$activity_id = $_POST['activity_id'];
	$question = $_POST['question'];

	$sql = "UPDATE activity_summarizing 
			SET article = '$question'
			WHERE id = '$activity_id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1745LRS12)";
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editSequenceQuestion($mysqli){

	$activity_id = $_POST['activity_id'];
	$question = $_POST['question'];

	$sql = "UPDATE activity_sequence 
			SET question = '$question'
			WHERE id = '$activity_id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1745LRS12)";
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function createSummaryQuestion($mysqli){

	$activty_id = $_POST['activity_id'];
	$question = addslashes($_POST['noise']);
	$correct_answer = $_POST['correct_answer'];
	$option = array($_POST['optionA'],$_POST['optionB'],$_POST['optionC'],$_POST['optionD']);	
	$question_code = $_POST['question_code'];

	for($x = 0; $x<=3; $x++){

		if($option[$x] != ""){
		
			$sql = "INSERT INTO activity_summarizing_q_a
					(activity_summarizing_id,
					question_code,
					question,
					correct,
					options)
					VALUES
					('$activty_id',
					'$question_code',
					'$question',
					'$correct_answer',
					'$option[$x]')";


			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
		 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(1745LRS)";
			}
		}
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function activityAddSummary($mysqli){

	$activity_code = $_POST['activity_code'];
	$article = addslashes($_POST['noise']);
	$teacher_id = $_SESSION['user_id'];

	$sql = "INSERT INTO activity_summarizing
			(activity_code,
			article,
			teacher_id)
			VALUES
			('$activity_code',
			'$article',
			'$teacher_id')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1745LR)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function sequenceAddActivity($mysqli){

	$activity_code = $_POST['activity_code'];
	$question = addslashes($_POST['noise']);
	$teacher_id = $_SESSION['user_id'];

	$sql = "INSERT INTO activity_sequence
			(activity_code,
			question,
			teacher_id)
			VALUES
			('$activity_code',
			'$question',
			'$teacher_id')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1745L)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editMatchDescription($mysqli){

	$id = $_POST['match_id'];
	$description = $_POST['description'];

	$sql = "UPDATE activity_matching
			SET 
			description = '$description'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1785)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function createMatchingType($mysqli){

	$matchA_desc = addslashes($_POST['noise']);
	$matchB_desc = addslashes($_POST['noise2']);
	$teacher_id = $_SESSION['user_id'];
	$type = "";
	$match_answer = getMaxId('activity_matching',$mysqli);
	$description = "";
	$activity_code = $_POST['activity_code'];
	$activity_code = $_POST['activity_code'];

	for($i=0; $i<=1; $i++){
		

		if($i == 0){
			$type = 'A';
			$description = $matchA_desc;
			$match_answer += 2;
		}else{
			$type = 'B';
			$description = $matchB_desc;
			$match_answer -= 1;
		}

		$sql = "INSERT INTO activity_matching
			(description,
			type,
			match_answer,
			activity_code,
			teacher_id)
			VALUES
			('$description',
			'$type',
			'$match_answer',
			'$activity_code',
			'$teacher_id')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(1110)";
		}	

	}
	

	header('Location: ' . $_SERVER['HTTP_REFERER']);

	
	//echo getMaxId($mysqli);
}

function createClass($mysqli){
	$teacher = $_POST['teacher'];
	$section = $_POST['section'];
	$subject = $_POST['subject'];
	$time_from = $_POST['time_from'];
	$time_to = $_POST['time_to'];
	$day = $_POST['day'];
/*
	echo $teacher.'<br>';
	echo $section.'<br>';
	echo $subject.'<br>';
	echo $time_from.'<br>';
	echo $time_to.'<br>';
	echo $day.'<br>';
exit;
*/
	
	$sql = "INSERT INTO class 
		   (section_id,
		   subject_id,
		   teacher_id,
		   day,
		   time_from,
		   time_to) 
		   VALUES 
		   ('$section',
			'$subject',
			'$teacher',
			'$day',
			'$time_from',
			'$time_to'
			)";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(081CREATECLS)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function editSection($mysqli){
	$id = $_POST['section_id'];
	$section = $_POST['section_name'];
	$grade = $_POST['grade'];
	
	$comment = $_POST['comment']; 

	$sql = "UPDATE section 
			SET
			name = '$section',
			grade = '$grade',	
			comment = '$comment'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(081Upsec)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addSection($mysqli){

	$section = $_POST['section_name'];
	$grade = $_POST['grade'];	
	$comment = $_POST['comment']; 

	$sql = "INSERT INTO section 
			(name,
			grade,			
			comment)
			VALUES 
			('$section',
			'$grade',			
			'$comment')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(081Sec)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editSubject($mysqli){

	$name = $_POST['subject_name'];
	$desc = $_POST['description'];
	$id = $_POST['subject_id'];

	$sql = "UPDATE subject
			SET 
			name = '$name',
			description = '$desc'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(081Subj)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function addSubject($mysqli){

	$name = $_POST['subject_name'];
	$desc = $_POST['description'];

	$sql = "INSERT INTO subject 
			(name,
			description)
			VALUES 
			('$name',
			'$desc')";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(081Subj)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateProfileschoolcoordinator($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];
	$birthday = $_POST['birthday'];
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE school_coordinator
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(081)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE school_coordinator
				SET 
				image_path = '$name',
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0812)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11332)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateProfileteacher($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];
	$birthday = $_POST['birthday'];
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE teacher
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(081)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE teacher
				SET 
				image_path = '$name',
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0812)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11332)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateProfilestudent($mysqli){

	$id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['formRadioSex'];
	$birthday = $_POST['birthday'];
	$physical_address = $_POST['physical_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email_address'];
	$password = $_POST['inputPassword'];
	$account_id = $_POST['account_id'];
	$image_path='noimage.png';
	
	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE student
				SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {
					
         	$sql = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(081)";
			}
			   		

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(092)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE student
				SET 
				image_path = '$name',
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				sex = '$sex',
				birthday = '$birthday',
				physical_address = '$physical_address',
				phone = '$phone'
				WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {

					
         	$sql2 = "UPDATE account set 
         			email_address = '$email',
         			password = '$password' 
         			WHERE id = '$account_id'";

         	if (mysqli_query($mysqli,$sql2)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(0812)";
			}
			   
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11332)";
		}
    }//end upload image

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function editCoordinatorAccount($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$birthday = $_POST['birthday'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = $_POST['status'];
	$id = $_POST['coordinator_id'];
	$sex = $_POST['formRadioSex'];
	$co_account_id = $_POST['co_account_id'];

	editAccount($co_account_id,$email,$password,'co_account',$mysqli);

	$sql = "UPDATE school_coordinator
			SET			
			firstname = '$firstname',
			middlename = '$middlename',
			lastname = '$lastname',
			birthday = '$birthday',
			sex = '$sex',
			physical_address = '$address',
			phone = '$phone',
			active = '$status'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";	
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(3105)";exit;
	}

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editAccount($id,$email,$password,$table,$mysqli){

	$emaill = $email;
	$passwordl = $password;

	$sql = "UPDATE ".$table.
		   " SET email_address = '$emaill',
		    password = '$passwordl' 
		    WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";	
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(3105)";exit;
	}

}

function addCoordinatorAccount($mysqli){
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$birthday = $_POST['birthday'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = $_POST['status'];
	$sex = $_POST['formRadioSex'];

	$co_account_id = insertCoordinatorAccount($email,$password,$mysqli);

	$sql = "INSERT INTO school_coordinator
			(co_account_id,
			firstname,
			middlename,
			lastname,
			birthday,
			sex,
			physical_address,
			phone,
			active)
			VALUES 
			('$co_account_id',
			'$firstname',
			'$middlename',
			'$lastname',
			'$birthday',
			'$sex',
			'$address',
			'$phone',
			'$active')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";	
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(3104)";exit;
	}

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editTeacherAccount($mysqli){

	$id = $_POST['teacher_id'];
	$status = $_POST['status'];
	$approved = $_POST['approved'];

	$sql = "UPDATE teacher SET
			active = '$status',
			approved = '$approved'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";	
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(3103)";exit;
	}
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editStudentAccount($mysqli){

	$id = $_POST['student_id'];
	$status = $_POST['status'];
	$approved = $_POST['approved'];

	$sql = "UPDATE student SET
			active = '$status',
			approved = '$approved'
			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";	
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(2103)";exit;
	}
header('Location: ../pages/student.php');
}

function register($mysqli){

	if(isset($_POST['register'])){

		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$birthday = $_POST['birthday'];
		$physical_address = $_POST['physical_address'];
		$phone = $_POST['phone'];
		$academic_relation = $_POST['academic_relation'];
		$email = $_POST['email'];
		$password = $_POST['confirm_password'];
		$sex = $_POST['formRadioSex'];
		$account_id = insertAccount($email,$password,$mysqli);
		
		if($academic_relation == 0){ //student
			$sql = "INSERT INTO student
					(account_id,
					firstname,
					middlename,
					lastname,
					birthday,
					sex,
					physical_address,
					phone)
					VALUES 
					('$account_id',
					'$firstname',
					'$middlename',
					'$lastname',
					'$birthday',
					'$sex',
					'$physical_address',
					'$phone')";

		}else{ //teacher

			$sql = "INSERT INTO teacher
					(account_id,
					firstname,
					middlename,
					lastname,
					birthday,
					sex,
					physical_address,
					phone)
					VALUES 
					('$account_id',
					'$firstname',
					'$middlename',
					'$lastname',
					'$birthday',
					'$sex',
					'$physical_address',
					'$phone')";
		}

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
	 
		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(103)";exit;
		}

	}

}
function insertCoordinatorAccount($email,$password,$mysqli){
	$emaill = $email;
	$passwordl = $password;

	$sql = "INSERT INTO co_account
			(email_address,
			password)
			VALUES 
			('$emaill',
			'$passwordl')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1011)";exit;
	}

	$account_id = getLatestAccountId('co_account',$mysqli);
	return $account_id;
}

function insertAccount($email,$password,$mysqli){
	$emaill = $email;
	$passwordl = $password;

	$sql = "INSERT INTO account
			(email_address,
			password)
			VALUES 
			('$emaill',
			'$passwordl')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1010)";exit;
	}

	$account_id = getLatestAccountId('account',$mysqli);
	return $account_id;
}

function getLatestAccountId($table,$mysqli){

	$sql = 'SELECT id FROM '.$table.' ORDER BY id DESC LIMIT 0, 1';
	$result  = mysqli_query($mysqli,$sql);
	$account_id = mysqli_fetch_array($result);

	return $account_id[0];
}

function addclient($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;

	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;

	exit;
	*/

	//insert account and get account id
	 $account_id = getAccountId($username,$password,'../pages/client-list.php',$mysqli);


	//upload image
	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
		
		$_SESSION['ERR']="Image file is invalid";

	}else{			
			$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        $_SESSION['ERR']="Cant upload the image";
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO client(firstname, middlename, lastname, age, gender, physical_address, email_address, contact_number, image_path, account_id, status) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$physical_address','$email_address','$contact_number','$name','$account_id','$status')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(05)";
		}
	}//end upload image

	header('Location: ../pages/client-list.php');
}//end of function

function confirmDelete($mysqli){

	$table = $_POST["dbtable"];
	$id = $_POST["tableId"];
		
	
	$sql = "UPDATE ".$table." SET deleted = 1 WHERE id = '$id'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(06)";
	}

	echo $_SESSION['ERR'];
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function confirmDeleteQuestion($mysqli){

	$table = $_POST["dbtable"];
	$code = $_POST["qcode"];
		
	
	$sql = "DELETE FROM ".$table." WHERE question_code = '".$code."'";
	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
	 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(062)";
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function confirmDeleteACtivitiy($mysqli){

	$table = $_POST["dbtable"];
	$id = $_POST["tableId"];

	switch ($table) {

		case 'activity_matching':
			$sql = "SELECT match_answer FROM ".$table." WHERE id=".$id."";
			$result = mysqli_query($mysqli,$sql);
			if (mysqli_num_rows($result) > 0) { 

		     while($row = mysqli_fetch_assoc($result)) {
		     	$match_answer = $row['match_answer'];
		     	
		     	$sql = "DELETE FROM activity_matching WHERE id = '$id'";
		     	if (mysqli_query($mysqli,$sql)) {

		     		$sql = "DELETE FROM activity_matching WHERE id = '$match_answer'";
		     		if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(06)";
					}

					$_SESSION['ERR']="";		
				 
				} else {
					
				   $_SESSION['ERR']="Something went wrong: error(06)";
				}

		     }
		    }
			break;

		case 'activity_sequence':
			$sql  = "DELETE FROM activity_sequence WHERE id = '$id'";
			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(06)";
			}
			break;
		
		case 'activity_sequencing_step':
			$sql  = "DELETE FROM activity_sequencing_step WHERE id = '$id'";
			if (mysqli_query($mysqli,$sql)) {

				$_SESSION['ERR']="";		
			 
			} else {
				
			   $_SESSION['ERR']="Something went wrong: error(06)";
			}
			break;



		default:
			# code...
			break;
	}


		
	
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function editClient($mysqli){

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$account_id = 0;
	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;
	exit;*/

	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE client SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {
						
				$sql = "SELECT account_id FROM client WHERE id = '$id'";
				 $result = mysqli_query($mysqli,$sql);
			      if (mysqli_num_rows($result) > 0) { 

			         while($row = mysqli_fetch_assoc($result)) {

			         	$account_id = $row['account_id'];

			         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
			         	if (mysqli_query($mysqli,$sql)) {

							$_SESSION['ERR']="";		
						 
						} else {
							
						   $_SESSION['ERR']="Something went wrong: error(08)";
						}
			         }
			     }			

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(09)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE client SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status',image_path = '$name' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

			$sql = "SELECT account_id FROM client WHERE id = '$id'";
			 $result = mysqli_query($mysqli,$sql);
		      if (mysqli_num_rows($result) > 0) { 

		         while($row = mysqli_fetch_assoc($result)) {

		         	$account_id = $row['account_id'];

		         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
		         	if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(08)";
					}
		         }
		     }		
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11)";
		}
    }//end upload image

	header('Location: ../pages/client-list.php');
}

function getAccountId($username,$password,$url_link,$mysqli){
	$user = $username;
	$pass = $password;
	$url = $url_link;
	$account_id =0;

	$sql = "INSERT INTO account (username,password) VALUES ('$user','$pass')";
	if(mysqli_query($mysqli,$sql)){
		$sqlmax = "SELECT max(id) maxid FROM account";
		$result = mysqli_query($mysqli,$sqlmax);
		$row = mysqli_fetch_array($result);
		$account_id = $row["maxid"];
		
	}else{
		 $_SESSION['ERR']="Something went wrong(04)";
		 //header('Location: '.$url.'');exit;
	}

	return $account_id;
}


function addEmployee($mysqli){

	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$image_path='noimage.png';
	$position = $_POST['position'];
	$account_id = 0;

	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;

	exit;
	*/

	//insert account and get account id
	 $account_id = getAccountId($username,$password,'../pages/employee-list.php',$mysqli);


	//upload image
	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
		
		$_SESSION['ERR']="Image file is invalid";

	}else{			
			$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        $_SESSION['ERR']="Cant upload the image";
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	         $_SESSION['ERR']="Cant upload the image";
	     
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	    if($status == 'Active'){
	    	$status = 0;
	    }else{
	    	$status = 1;
	    }
	  
	 	$sql = "INSERT INTO employee(firstname, middlename, lastname, age, gender, position, physical_address, email_address, contact_number, image_path, account_id, status) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$position','$physical_address','$email_address','$contact_number','$name','$account_id','$status')";

		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
		 
		} else {
			
		   $_SESSION['ERR']="Something went wrong error(05)";
		}
	}//end upload image

	header('Location: ../pages/employee-list.php');
}//end of function


function editEmployee($mysqli){

	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST["formRadioSex"];
	$physical_address = $_POST["physicaladdress"];
	$email_address = $_POST["emailaddress"];
	$contact_number = $_POST["contactnumber"];
	$status = $_POST["status"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$position = $_POST['position'];
	$image_path='noimage.png';
	$account_id = 0;
	/*
	echo $firstname.'<br>'.
	$middlename.'<br>'.
	$lastname.'<br>'.
	$age.'<br>'.
	$gender.'<br>'.
	$physical_address.'<br>'.
	$email_address.'<br>'.
	$contact_number.'<br>'.
	$status.'<br>'.
	$username.'<br>'.
	$password;
	exit;*/

	//upload image
	if(getimagesize($_FILES['image']['tmp_name']) == FALSE){ //if no image    

		$sql = "UPDATE employee SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender', position = '$position',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

						
				$sql = "SELECT account_id FROM employee WHERE id = '$id'";
				 $result = mysqli_query($mysqli,$sql);
			      if (mysqli_num_rows($result) > 0) { 

			         while($row = mysqli_fetch_assoc($result)) {

			         	$account_id = $row['account_id'];

			         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
			         	if (mysqli_query($mysqli,$sql)) {

							$_SESSION['ERR']="";		
						 
						} else {
							
						   $_SESSION['ERR']="Something went wrong: error(08)";
						}
			         }
			     }			

		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(09)";
		}

	}else{// if there is image	
		$myFile = $_FILES["image"];

	    if ($myFile["error"] !== UPLOAD_ERR_OK) {
	        echo "<p>An error occurred.</p>";
	        exit;
	    }

	    // ensure a safe filename
	    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

	    // don't overwrite an existing file
	    $i = 0;
	    $parts = pathinfo($name);
	    while (file_exists(UPLOAD_DIR . $name)) {
	        $i++;
	        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	    }

	    // preserve file from temporary directory
	    $success = move_uploaded_file($myFile["tmp_name"],
	        UPLOAD_DIR . $name);
	    if (!$success) { 
	        echo "<p>Unable to save file.</p>";
	     //   exit;
	    }

	    // set proper permissions on the new file
	    chmod(UPLOAD_DIR . $name, 0644);
	  
		$sql = "UPDATE employee SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender', position = '$position',physical_address = '$physical_address',email_address = '$email_address',contact_number = '$contact_number',status = '$status',image_path = '$name' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {

			 $sql = "SELECT account_id FROM employee WHERE id = '$id'";
			 $result = mysqli_query($mysqli,$sql);
		      if (mysqli_num_rows($result) > 0) { 

		         while($row = mysqli_fetch_assoc($result)) {

		         	$account_id = $row['account_id'];

		         	$sql = "UPDATE account set username = '$username', password = '$password' WHERE id = '$account_id'";
		         	if (mysqli_query($mysqli,$sql)) {

						$_SESSION['ERR']="";		
					 
					} else {
						
					   $_SESSION['ERR']="Something went wrong: error(08)";
					}
		         }
		     }		
	
		} else {
			
		     $_SESSION['ERR']="Something went wrong: error(11)";
		}
    }//end upload image

	header('Location: ../pages/employee-list.php');
}



?>