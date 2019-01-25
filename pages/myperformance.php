<?php
	include '../template/header.php';
	include '../cli/global-functions.php';

	if(isset($_GET['id'])){
		$student_id = $_GET['id'];		
	}else{
		$student_id = $_SESSION['user_id'];	
	}	
	$readingPHP = getQuizPerformance($student_id,'Reading-Quiz',$mysqli);
	$vocabularyPHP = getQuizPerformance($student_id,'Vocabulary-Quiz',$mysqli);
?>
<style type="text/css">
	.answer-key{
		height: 25px;
	}
	.header-box{
		background: #c8d8fc;
    	padding: 10px 5px;
	}
	#myProgress {
	  width: 100%;
	  background-color: #ddd;
	  border-radius: 8px;
	}
	#myBar {									  
	  height: 30px;
	  
	  text-align: center;
	  line-height: 30px;
	  color: white;
	  border-radius: 8px;
	}
	.perf1{
		width: 15%;
		display: inline-block;
	}
	.perf2{
		width: 100% !important;
		display: inline-block;
	}
	.header-perf{
		background: #aed9fd;
    	padding-top: 1em;
	}
	/*#ff4209*/
</style>
<!--activity -->
<script>
window.onload = function () {

var matching = $('#inputMatching').val();
var sequencing = $('#inputSequencing').val();
var summarizing = $('#inputSummarizing').val();
var inferencing = $('#inputInferencing').val();
//activity
var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Activity Performance"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: matching, name: "Matching", exploded: true },
			{ y: sequencing, name: "Sequencing" },
			{ y: summarizing, name: "Summarizing" },
			{ y: inferencing, name: "Inferencing" }
			
		]
	}]
});
chart.render();

//quiz

var reading = Number(<?php echo $readingPHP; ?>);
var vocabulary = Number(<?php echo $vocabularyPHP; ?>);

var chart2 = new CanvasJS.Chart("chartContainer2", {

	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Quiz Performance"
	},
	axisY: {
		title: ""
		
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "blue",
		indexLabel: "{y}%",
		percentFormatString: "#0.##",
		toolTipContent: "{y}%",
		legendText: "Student quiz result performance",
		dataPoints: [      
			{ y: reading, label: "Reading Comprehension" },
			{ y: vocabulary,  label: "Vocabulary" }			
		]
	}]
});
chart2.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>



<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="myperformance.php">My Performance</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>  
      <?php 
      	if(isset($_GET['id'])){
      ?>
      	<div class="row">
      		<div class="col-sm-12 text-center header-perf">
      			<?php 
      				$name = getName($student_id,'student',$mysqli);
      				$section = $_GET['section'];
      				echo '<h2>'.$name.'</h2>';
      				echo "<p>Section: ".$section."</p>";
      			?>
      		</div>
      	</div>
      	<hr>
      <?php 
        }
      ?>
      	<div class="row">  

      		<!-- chart -->
      		
	      		<div class="col-sm-6">
	      			<div id="chartContainer" style="height: 350px; max-width: 1000px; margin: 0px auto;"></div>  
	      		</div>
		      	<div class="col-sm-6">
	      			<div id="chartContainer2" style="height: 350px; max-width: 1000px; margin: 0px auto;"></div>  
	      		</div>		 
	      	
	      	<!-- chart -->	
	      	<div class="col-sm-12">
	      		<div class="header-box">
	      			<h5>Activity Performance</h5>
	      		</div>
	      	</div>
   	
   			<div class="col-sm-6">
   				<!-- DataTables Example -->		        
		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable05" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>		                      		                      
		                      <th width="50px">Skill</th>
		                      <th>Performance</th>
		                      <th></th>		                     
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                  	$skill[0] = 'Matching';
		                  	$skill[1] = 'Sequencing';
		                  	$skill[2] = 'Summarizing';
		                  	$skill[3] = 'Inferencing';

		                  	$overall = 0;
		                  	$overallActivityPerf = 0;		                  	
		                    for($x = 0; $x<4; $x++){

		                    	$performance = getActivityPerformance($student_id,$skill[$x],$mysqli);

		                    	 echo '<tr>'; 		                          	                         	 
	                         	 echo '<td>'.$skill[$x].'</td>';
	                         	 echo '<td>';
	                         
	                         	 echo '<div class="perf2" id="myProgress">';

	                         	 if($performance >= 51){
	                         	 	$bgcolor = '#6fad0c';
	                         	 }else{
	                         	 	$bgcolor = '#ff4209';
	                         	 }
	                         	 echo '<input type="hidden" id="input'.$skill[$x].'" value="'.$performance.'">';
	                         	 echo '<div id="myBar" style="background-color:'.$bgcolor.';width: '.$performance.'%"> '.$performance.'% </div>';
	                         	 echo '</div>';
	                         	 echo '</td>';

		                         echo '<td style="width:15px;"><button class="btn btn-default" onclick="getActivityHistory('.$x.');"><i class="fas fa-history" style="color:green;"></i></button></td>';		
		                         echo '</tr>';

		                         $overall += $performance;
		                    }

		                    $overallActivityPerf = $overall / 4;
		                          
		                  ?>
		                    

		                   
		                  </tbody>
		                </table>
		                
		                <div class="total-performance fosrm-group">
		                Overall Activity Performance: 
		                	<?php
		                	if($overallActivityPerf >= 51){
		                		$bgOverallColor = '#6fad0c';
		                	}else{
		                		$bgOverallColor = '#ff4209';
		                	}
		                	?>
		                		<div id="myProgress" >
								  <div id="myBar" style="background-color:<?php echo $bgOverallColor; ?> ;width: <?php echo $overallActivityPerf; ?>%"><?php echo $overallActivityPerf; ?>% </div>
								</div>
		                	
		                </div>
		                 
		              </div>
		            </div>
		        	
   			</div>
   			
   			<div class="col-sm-6" style="margin-top: 2.8em;">
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-vials"></i>
		              Breakdown Results
		            </div>
		          	
		            <div class="card-body">
		            
		            	<div class="form-group text-center">
		            		<i class="small text-muted" id="activityHeader">Click history button to view your record</i>	
		            	</div>
		            	<hr>
		            	

		            	<div class="row" id="activityBreakdown">
			         
			            </div><!-- dynamic test -->
			      
		            	</div><!--row -->
		            </div>
		        </div>
		    <div class="col-sm-12">
	      		<div class="header-box">
	      			<h5>Quiz Performance</h5>
	      		</div>
	      	</div>
   	
   			<div class="col-sm-6">
   				<!-- DataTables Example -->		        
		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable05" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>		                      		                      
		                      <th width="50px">Skill</th>
		                      <th>Performance</th>
		                      <th></th>		                     
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                  	$skill[0] = 'Reading-Quiz';
		                  	$skill[1] = 'Vocabulary-Quiz';	

		                  	$cat[0] = 'Reading';	                  
		                  	$cat[1] = 'Vocabulary';
		                 	
		                 	$overall = 0;
		                  	$overallQuizPerf = 0;	
		                    for($x = 0; $x<2; $x++){

		                    	$performance = getQuizPerformance($student_id,$skill[$x],$mysqli);
		                    	 echo '<tr>'; 		                          	                         	 
	                         	 echo '<td>'.$skill[$x].'</td>';
	                         	  echo '<td>';

	                         	 echo '<div class="perf2" id="myProgress">';

	                         	 if($performance >= 51){
	                         	 	$bgcolor = '#6fad0c';
	                         	 }else{
	                         	 	$bgcolor = '#ff4209';
	                         	 }
	                         	 echo '<input type="hidden" id="input'.$cat[$x].'" value="'.$performance.'">';
	                         	 echo '<div id="myBar" style="background-color:'.$bgcolor.';width: '.$performance.'%"> '.$performance.'% </div>';
	                         	 echo '</div>';
	                         	 echo '</td>';

		                         echo '<td style="width:15px;"><button class="btn btn-default" onclick="getQuizHistory('.$x.');"><i class="fas fa-history" style="color:green;"></i></button></td>';		
		                         echo '</tr>';
		                         $overall += $performance;

		                    }
		                         $overallQuizPerf = $overall / 4;	   
		                  ?>
		                    
		                   
		                  </tbody>
		                </table>
		              </div>
		               <div class="total-performance fosrm-group">
		                Overall Quiz Performance: 
		                	<?php
		                	if($overallQuizPerf >= 51){
		                		$bgOverallColor = '#6fad0c';
		                	}else{
		                		$bgOverallColor = '#ff4209';
		                	}
		                	?>
		                		<div id="myProgress" >
								  <div id="myBar" style="background-color:<?php echo $bgOverallColor; ?> ;width: <?php echo $overallQuizPerf; ?>%"><?php echo $overallQuizPerf; ?>% </div>
								</div>
		                	
		                </div>
		            </div>

		        	
   			</div>
   			<div class="col-sm-6" style="margin-top: 2.8em;">
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-vials"></i>
		              Breakdown Results
		            </div>
		          	
		            <div class="card-body">
		            
		            	<div class="form-group text-center">		            		
		            		<i class="small text-muted" id="quizHeader">Click history button to view your record</i>	
		            	</div>
		            	<hr>
		            	

		            	<div class="row" id="quizBreakdown">
			         
			            </div><!-- dynamic test -->
			      
		            	</div><!--row -->
		            </div>
		        </div>
   			</div><!-- row -->
   			
   		</div><!-- container -->
       

    </div>
</div>
<script type="text/javascript" src="../js/canvasjs.min.js"></script>

<script type="text/javascript">
	function getActivityHistory(skill){
		var student_id = <?php echo $student_id; ?>;
		switch(skill){
			case 0:
				$('#activityHeader').text('Activity Matching History');
				var type = 'Matching';
				 $('#activityBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});    
				break;
			case 1:
				$('#activityHeader').text('Activity Sequencing History');
				var type = 'Sequencing';
				 $('#activityBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});
				break;
			case 2:
				$('#activityHeader').text('Activity Summarizing History');
				var type = 'Summarizing';
				 $('#activityBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});
				break;
			case 3:
				$('#activityHeader').text('Activity Inferencing History');
				var type = 'Inferencing';
				 $('#activityBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});
				break;
			default:
				$('#activityHeader').text('No Results');
				break;
		}
	}

	function getQuizHistory(skill){
		var student_id = <?php echo $student_id; ?>;
		switch(skill){
			case 0:
				$('#quizHeader').text('Quiz Reading Comprehension');
				var type = 'Reading-Quiz';
				 $('#quizBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});
				break;
			case 1:
				$('#quizHeader').text('Quiz Vocabulary');
				var type = 'Vocabulary-Quiz';
				 $('#quizBreakdown').load('../snippet/myperformance-dynamic.php?type=' + type +'&student_id=' + student_id,function(){                              
      			});
				break;		
			default:
				$('#quizHeader').text('No Results');
				break;
		}
	}

  function selectTest(id){    
      var id = id;            
      $('#dynamicTest').load('../snippet/student-match-dynamic.php?id=' + id,function(){                              
      });                    
  }
  function showDeleteClient(id){    
      var id = id;            
      var table = "";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>
<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTable2').DataTable();
} );
</script>