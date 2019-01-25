<?php 
	include '../dbconnect/connect.php';

	function getName($id,$table,$mysqli){
		$name = "";
		$sql = "SELECT firstname,middlename,lastname FROM ".$table." WHERE id = ".$id;

		$result = mysqli_query($mysqli,$sql);
		if (mysqli_num_rows($result) > 0) { 
		 while($row = mysqli_fetch_assoc($result)) {
		 	$name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
		 }
		}
		return $name;
	}

	function getActivityPerformance($student_id,$activity,$mysqli){
		$performance = 0;
		$num_row = 0;

		$sql = "SELECT 				
				score,
				No_of_items
				FROM student_score 
				WHERE student_id = '$student_id'
				AND deleted = 0 
				AND test_type = '$activity'";
		

		$result = mysqli_query($mysqli,$sql);
		if (mysqli_num_rows($result) > 0) { 
		 while($row = mysqli_fetch_assoc($result)) {

		 	$num_row++;

		 	$score = $row['score'];
		 	$items = $row['No_of_items'];

		 	$performance += ($score / $items) * 100;
		 	
		 }
		 return Round($performance / $num_row);	
		}  else{
			return 0;	
		}  	
		    
		
	}

	function getQuizPerformance($student_id,$quiz,$mysqli){
		$performance = 0;
		$num_row = 0;

		$sql = "SELECT 				
				score,
				No_of_items
				FROM student_score 
				WHERE student_id = '$student_id'
				AND deleted = 0 
				AND test_type = '$quiz'";
		

		$result = mysqli_query($mysqli,$sql);
		if (mysqli_num_rows($result) > 0) { 
		 while($row = mysqli_fetch_assoc($result)) {

		 	$num_row++;

		 	$score = $row['score'];
		 	$items = $row['No_of_items'];

		 	$performance += ($score / $items) * 100;
		 	
		 }
		 return Round($performance / $num_row);	
		}  else{
			return 0;	
		}  	
		    
		
	}

	function getIdViaCode($code,$table,$mysqli){
		$id = "";
		$sql = "SELECT id FROM ".$table." WHERE activity_code ='".$code."'";
		$result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 
     		
	         while($row = mysqli_fetch_assoc($result)) {
	        	$id = $row['id']; 	
	         }
	     }
	
	return $id;
	}
	function getIdViaCodeQuiz($code,$table,$mysqli){
		$id = "";
		$sql = "SELECT id FROM ".$table." WHERE quiz_code ='".$code."'";
		$result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 
     		
	         while($row = mysqli_fetch_assoc($result)) {
	        	$id = $row['id']; 	
	         }
	     }
	
	return $id;
	}

	function getQuestionCode($Acode,$mysqli){

		$qcode = [];
		$sql = "SELECT question_code FROM activity_inferencing
				WHERE activity_code = '$Acode' 
				GROUP BY question_code 
				ORDER BY id asc";

		 $result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 
     		$x = 0;
	         while($row = mysqli_fetch_assoc($result)) {
	         	$qcode[$x] = $row['question_code'];
	         	$x++;
	         }
	     }
	    
	return $qcode;
	}

	function getQuestionCodeQuiz($quiz_id,$mysqli){

		$qcode = [];
		$sql = "SELECT question_code FROM quiz_q_a
				WHERE quiz_id = '$quiz_id' 
				GROUP BY question_code 
				ORDER BY id asc";

		 $result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 
     		$x = 0;
	         while($row = mysqli_fetch_assoc($result)) {
	         	$qcode[$x] = $row['question_code'];
	         	$x++;
	         }
	     }
	    
	return $qcode;
	}

	function getScore($id,$code,$mysqli){

		$sql = "SELECT score FROM student_score
				WHERE student_id =".$id." 
				AND test_code = '".$code."'";

		 $result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 

	         while($row = mysqli_fetch_assoc($result)) {

	         	$final_score = $row['score'];
	         }
		}else{
			$final_score = 0;
		}
		return $final_score;
	}

	function checkTestTaken($id,$code,$mysqli){
		$bool = false;
		$sql = "SELECT * FROM student_score
				WHERE student_id =".$id." 
				AND test_code = '".$code."'";

		 $result = mysqli_query($mysqli,$sql);

     	if (mysqli_num_rows($result) > 0) { 

     		$bool = true;
		}else{
			$bool = false;
		}
		
		return $bool;
	}

	function getMaxId($table,$mysqli){
		$id =0;		
		$sql = "SELECT id 
				FROM ".$table."
				ORDER BY id 
				DESC limit 1";

		 $result = mysqli_query($mysqli,$sql);
     	 if (mysqli_num_rows($result) > 0) { 
         while($row = mysqli_fetch_assoc($result)) {
         	$id = $row['id'];
         }
     }

	return $id;
	}

	function countActivityNoOfItem($id,$where,$table,$mysqli){
		$count = 0;
		$sql = "SELECT count(id) counted FROM ".$table." WHERE ".$where." = ".$id;

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count = $row['counted'];
	         }
	     }
	     
		return $count;
	}
	function countActivityNoOfItem3($code,$where,$table,$mysqli){

		$sql = "SELECT count(id) counted FROM ".$table." WHERE ".$where." = '".$code."'";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count = $row['counted'];
	         }
	     }
	      
		return $count;
	}
	function countActivityNoOfItem2($id,$where,$table,$mysqli){

		$sql = "SELECT count(id) counted FROM ".$table." WHERE ".$where." = ".$id." GROUP BY question_code";

		 $result = mysqli_query($mysqli,$sql);
		 $counts = 0;
     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$counts++;
	         }
	     }
	     
	   
		return mysqli_num_rows($result);
	}

	function countActivityNoOfItem4($id,$where,$table,$mysqli){
		$count = 0;
		$sql = "SELECT question_code FROM ".$table." WHERE ".$where." = ".$id." GROUP BY question_code";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count++;
	         }
	     }
	     
		return $count;
	}
	function countQuizNoOfItem($id,$where,$table,$mysqli){
		$count = 0;
		$sql = "SELECT question_code FROM ".$table." WHERE ".$where." = ".$id." GROUP BY question_code";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count++;
	         }
	     }
	     
		return $count;
	}

	function countActivityNoOfItem5($code,$where,$table,$mysqli){

		$sql = "SELECT count(id) counted FROM ".$table." WHERE ".$where." = '".$code."' GROUP BY question_code";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
     	 	$count = 0;
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count++;
	         }
	     }
	      
		return $count;
	}

	function countOptionInference($id,$activity_code,$mysqli){

		$sql = "SELECT count(id) counted 
				FROM activity_inferencing 
				WHERE activity_code = '$activity_code' 
				GROUP BY question_code";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count = $row['counted'];
	         }
	     }
		return $count;
	}

	function countQuestionOption($id,$question_code,$mysqli){

		$sql = "SELECT count(id) counted 
				FROM activity_summarizing_q_a 
				WHERE activity_summarizing_id = '$id' 
				AND question_code = '$question_code'";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count = $row['counted'];
	         }
	     }
		return $count;
	}
	function countQuestionOption2($id,$question_code,$mysqli){

		$sql = "SELECT count(id) counted 
				FROM quiz_q_a 
				WHERE quiz_id = '$id' 
				AND question_code = '$question_code'";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$count = $row['counted'];
	         }
	     }
		return $count;
	}

	function numberToLetter($num){
		$letter = "";
		switch ($num) {
			case 1:
				$letter = 'A';
				break;
			case 2:
				$letter = 'B';
				break;
			case 3:
				$letter = 'C';
				break;
			case 4:
				$letter = 'D';
				break;
			
			default:
				$letter = 'Undefine';
				break;
		}

		return $letter;
	}

	function getActivityCode($id,$table,$mysqli){

		$sql = "SELECT activity_code 
				FROM ".$table."
				WHERE id = '$id'";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$code = $row['activity_code'];
	         }
	     }
		return $code;
	}
	function getQuizCode($id,$table,$mysqli){

		$sql = "SELECT quiz_code 
				FROM ".$table."
				WHERE id = '$id'";

		 $result = mysqli_query($mysqli,$sql);

     	 if (mysqli_num_rows($result) > 0) { 
	         while($row = mysqli_fetch_assoc($result)) {
	         	$code = $row['quiz_code'];
	         }
	     }
		return $code;
	}
	function numToLetters($num) {

    // accepts 1 - 36
    switch($num) {
        case "1"  : $rand_value = "a"; break;
        case "2"  : $rand_value = "b"; break;
        case "3"  : $rand_value = "c"; break;
        case "4"  : $rand_value = "d"; break;
        case "5"  : $rand_value = "e"; break;
        case "6"  : $rand_value = "f"; break;
        case "7"  : $rand_value = "g"; break;
        case "8"  : $rand_value = "h"; break;
        case "9"  : $rand_value = "i"; break;
        case "10" : $rand_value = "j"; break;
        case "11" : $rand_value = "k"; break;
        case "12" : $rand_value = "l"; break;
        case "13" : $rand_value = "m"; break;
        case "14" : $rand_value = "n"; break;
        case "15" : $rand_value = "o"; break;
        case "16" : $rand_value = "p"; break;
        case "17" : $rand_value = "q"; break;
        case "18" : $rand_value = "r"; break;
        case "19" : $rand_value = "s"; break;
        case "20" : $rand_value = "t"; break;
        case "21" : $rand_value = "u"; break;
        case "22" : $rand_value = "v"; break;
        case "23" : $rand_value = "w"; break;
        case "24" : $rand_value = "x"; break;
        case "25" : $rand_value = "y"; break;
        case "26" : $rand_value = "z"; break;
        case "27" : $rand_value = "0"; break;
        case "28" : $rand_value = "1"; break;
        case "29" : $rand_value = "2"; break;
        case "30" : $rand_value = "3"; break;
        case "31" : $rand_value = "4"; break;
        case "32" : $rand_value = "5"; break;
        case "33" : $rand_value = "6"; break;
        case "34" : $rand_value = "7"; break;
        case "35" : $rand_value = "8"; break;
        case "36" : $rand_value = "9"; break;
    }
    return $rand_value;
}

function lettersToNum($let) {

    // accepts 1 - 36
    switch($let) {
        case "a"  : $rand_value = "1"; break;
        case "b"  : $rand_value = "2"; break;
        case "c"  : $rand_value = "3"; break;
        case "d"  : $rand_value = "4"; break;
        case "e"  : $rand_value = "5"; break;
        case "f"  : $rand_value = "6"; break;
        case "g"  : $rand_value = "7"; break;
        case "h"  : $rand_value = "8"; break;
        case "i"  : $rand_value = "9"; break;
        case "j" : $rand_value = "10"; break;
        case "k" : $rand_value = "11"; break;
        case "l" : $rand_value = "12"; break;
        case "m" : $rand_value = "13"; break;
        case "n" : $rand_value = "14"; break;
        case "o" : $rand_value = "15"; break;
        case "p" : $rand_value = "16"; break;
        case "q" : $rand_value = "17"; break;
        case "r" : $rand_value = "18"; break;
        case "s" : $rand_value = "19"; break;
        case "t" : $rand_value = "20"; break;
        case "u" : $rand_value = "21"; break;
        case "v" : $rand_value = "22"; break;
        case "w" : $rand_value = "23"; break;
        case "x" : $rand_value = "24"; break;
        case "y" : $rand_value = "25"; break;
        case "z" : $rand_value = "26"; break;
        
    }
    return $rand_value;
}
?>
