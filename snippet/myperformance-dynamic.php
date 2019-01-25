<?php 
include '../dbconnect/connect.php';
require_once '../snippet/session.php';
include '../cli/global-functions.php';

//$student_id = $_SESSION['user_id'];
$student_id = $_GET['student_id'];
$type = $_GET['type']; 
?>

 <table class="table table-bordered" id="dataTable05" width="100%" cellspacing="0">
  <thead>
    <tr>		                      		                      
      <th width="120px">Date </th>
      <th>Code</th>
      <th>Score</th>		                     
      <th>Item</th>		                     
    </tr>
  </thead>
  <tfoot>
    
  </tfoot>
  <tbody>

<?php 
$sql = "SELECT 
		date_taken,
		test_code,
		score,
		No_of_items
		FROM student_score 
		WHERE student_id = '$student_id'
		AND deleted = 0 
		AND test_type = '$type'";
		

$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) { 
 while($row = mysqli_fetch_assoc($result)) {
 	$date_taken = $row['date_taken'];
 	$code = $row['test_code'];
 	$score = $row['score'];
 	$items = $row['No_of_items'];

 	 echo '<tr>'; 		                          	                         	 
 	 echo '<td>'.$date_taken.'</td>';
 	 echo '<td>'.$code.'</td>';
 	 echo '<td>'.$score.'</td>';
 	 echo '<td>'.$items.'</td>';
		
     echo '</tr>';

 }
}    	
          
  ?>
    
   
  </tbody>
</table>