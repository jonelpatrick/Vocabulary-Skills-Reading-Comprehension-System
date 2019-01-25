<?php
include '../dbconnect/connect.php';
require_once '../snippet/session.php';

$score = $_GET['score'];
$type = $_GET['type'];
$items = $_GET['itemx'];
$code = $_GET['code'];

//initialize and save data
$date_taken = date("Y-m-d");
$student_id = $_SESSION['user_id'];

$sql = "INSERT INTO student_score
		(student_id,
		test_type,
		test_code,
		No_of_items,
		score,
		date_taken)
		VALUES
		('$student_id',
		'$type',
		'$code',
		'$items',
		'$score',
		'$date_taken')";

	if (mysqli_query($mysqli,$sql)) {

		$_SESSION['ERR']="";		
 
	} else {
		
	   $_SESSION['ERR']="Something went wrong: error(1745LRSAB)";
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-8 offset-lg-2" style="margin-top:6%;">
				
			</div>
			<div class="result">
				<div class="row">
					<div class="col-lg-6">
						<div class="final-icon" style="    text-align: center;">
							<img src="../system-images/final-score.png" style="width:278px">
						</div>		
					</div>
					<div class="col-lg-6 score-desc">
						<label> Test Type : <span class="test-type"><?php echo $type; ?></span></label><br>		
						<label> your score is :</label><br>	
						<hr>	
						<label class="myscore"><?php echo $score. ' / '. $items; ?></label>
						<hr>
						<button class="btn btn-success" onClick="window.location.reload()">Continue</button>
					</div>
				</div>
				
				
			</div>	
		</div>
		
	</div>
	
</div>
<style type="text/css">
	.result{
		width: 80%;
		margin: 0 auto;

	}
	.score-desc label{
		font-size: 30px;
		font-weight: 700;
	}
	.myscore{
		font-size: 50px !important;
    	color: #a110ea;
	}
	.test-type{
		color: red;
	}
</style>