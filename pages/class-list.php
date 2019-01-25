<?php
	include '../template/header.php';
	include '../cli/global-functions.php';

	$teacher_id = $_SESSION['user_id'];
	
?>
<style type="text/css">
	.answer-key{
		height: 25px;
	}
</style>
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="teacher-list-of-class.php">List of my class</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>       		

   		<div class="row">
   			<div class="col-sm-5">
   				<!-- DataTables Example -->
		          <div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-table"></i>
		             List of Class
		          </div>

		            <div class="card-body">
		              <div class="table-responsive">
		               <i class="small text-muted">*Please select from the table</i>
		                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                  <thead>
		                    <tr>		                      
		                      <th>Section</th>
		                      <th>Subject</th>
		                      <th>Day</th>
		                      <th>Time</th>		 
		                      <th></th>                    
		                    </tr>
		                  </thead>
		                  <tfoot>
		                    
		                  </tfoot>
		                  <tbody>
		                  <?php
		                                       
		                    $sql = "SELECT 
		                    		class.id id,
				                    section.name secname, 
				                    subject.name subjname, 
									day , 
									time_from, 
									time_to
									FROM class
									INNER JOIN section ON class.section_id = section.id
									INNER JOIN subject ON class.subject_id = subject.id
									WHERE teacher_id ='$teacher_id'
									AND class.deleted = 0";

		                     $result = mysqli_query($mysqli,$sql);
		                      if (mysqli_num_rows($result) > 0) { 

		                         while($row  = mysqli_fetch_assoc($result)) {

		                          $section   = $row['secname'];
		                          $subject   = $row['subjname'];
		                          $day       = $row['day'];
		                          $time_from = $row['time_from'];
		                          $time_to   = $row['time_to'];
		                          $id        = $row['id'];

		                          echo '<tr>'; 		                          
		                          echo '<td>'.$section.'</td>';
		                          echo '<td>'.$subject.'</td>';
		                          echo '<td>'.$day.'</td>';
		                          echo '<td>'.$time_from.' - '.$time_to.'</td>';		                                                
                            	  echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectClass('.$id.');" > <i class="fas fa-mouse-pointer"></i>'.''.'</button></td>';    		                      
		                         
		                          echo '</tr>';
		                         }
		                      }
		                  ?>
		                    
		                   
		                  </tbody>
		                </table>
		              </div>
		            </div>
		          
		          </div>	
   			</div>
   			<div class="col-sm-7">
   				<div class="card mb-3">
		            <div class="card-header">
		              <i class="fas fa-fw fa-tachometer-alt"></i>
		              Class Detail
		            </div>
		          	
		            <div class="card-body">		            		            

		            	<div class="row" id="dynamicClass">
			         		<i class="text-center text-muted small">Please select a class</i>
			            </div><!-- dynamic test -->
			      
		            	</div><!--row -->
		            </div>
		        </div>
   			</div>
   			
   		</div><!-- row -->
       

    </div>
</div>

<script type="text/javascript">

  function selectClass(id){    
      var id = id;            
      $('#dynamicClass').load('../snippet/class-list-dynamic.php?id=' + id,function(){                              
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
	include '../snippet/transaction-message.php';
	include '../template/footer.php';
?>
<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTable2').DataTable();
} );
</script>