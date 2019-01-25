<?php
   include '../template/header.php';
   define("UPLOAD_DIR", "../activity.sequencing/");
   

   $steps = array(	"Select step",
   					"First", 
   					"Second", 
   					"Third",
   					"Fourth",
   					"Fifth",
   					"Sixth",
   					"Seventh",
   					"Eight",
   					"Nineth",
   					"Tenth",
   					"Eleventh",
   					"Twelve",
   					"Thirteenth",
   					"Last"); 

   $activity_id = $_GET['id'];
  
?>
<style type="text/css">
	.thumbs{
		width: 150px;
	}
	button.file-trash{
		position: absolute;
    	background: #f9190e;
	}
	.code{
		border: 1px solid rgba(0,0,0,0.1);
	    padding: 5px 20px;
	    border-radius: 5px;
	    color: #b1aeae;
	}
  select.form-control{
    width: 80%;
  }
</style>
  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="activity-sequencing.php"> Activity Sequencing </a>
        </li>
        <li class="breadcrumb-item active">
        	<a href="activity-sequencing-step.php?id=<?php echo $activity_id; ?>">Sequencing Step</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>    
      <div id="everyselect"></div>
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-images"></i>
              Sequencing Detail</div>

            <div class="card-body">
             <div class="row">
             	
             	<div class="col-lg-12">
             	             
             	   <div class="form-group">   
	                <label>Attachment [e.g. images for sequnece steps]</label>
	                <div class="file_upload">
	                  <form action="../snippet/upload-sequencing-step.php" class="dropzone">
	                   <input type="hidden" name="sequence_id" value="<?php echo $activity_id ; ?>">
	                    <div class="dz-message needsclick">
	                      <strong>Drop files here or click to upload.</strong><br />
	                      <span class="note needsclick">(Select multiple file to upload)</span>
	                    </div>
	                  </form>
	                </div>
	              </div> 
	              <button class="btn btn-success" onclick='window.location.reload();'>Add image/step</button>
             	</div>
             </div>
              
              
              <hr/>
               <i class="fas fa-book"></i>
              <span>List of images[please select the unique step each images]</span>
              <div class="table-responsive">
                <table class="table table-bordered table-property legal-docu" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                   <tr></tr>
                  </thead>
                  <tfoot>
                 
                  </tfoot>
                  <tbody>
                    <tr>
                    <?php
                      $sql = "SELECT 
                              id,                              
                              file_name,
                              activity_sequence_id,
                              step
                              FROM activity_sequencing_step
                              WHERE activity_sequence_id = $activity_id";

                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {                         
                       
                        $y =0;
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $file_name = $row['file_name'];
                          $activity_id = $row['activity_sequence_id'];                          
                          $stepdb = $row['step'];
           
                         
                          $path = UPLOAD_DIR.$file_name;
                          $default = '../system-images/no-image-step.png';

                          echo '<td align="center">';
                          echo '<button class="file-trash btn" onclick="javascript:showDeleteActivity('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';

                         
                          if(is_image($path)){

                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                          echo '<div class="form-group" style="margin-top:1em;">';
                          echo '<select class="form-control" onchange="updateSequenceStep(this.value,'.$id.')">';
                          $x = 0;
                          foreach($steps as $key=>$step){
                          	if($x == $stepdb){
                          		echo '<option value="'.$x.'" selected="selected">'.$step.'</span>';
                          	}else{
                          		echo '<option value="'.$x.'">'.$step.'</span>';	
                          	}
							
            							$x++;
            						  }
                          echo '</select>';
                          echo "</div>";
                          
                          echo '</td>';
                          
                          $x++;
                          if($x == 5){
                            echo '</tr>';
                            echo '<tr>';
                            $x = 0;
                          }
                          
                         }
                       }
                    ?>
                     </tr>                                                                               
                  </tbody>
                </table>
              </div>

            </div>
            
          </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="storyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" background: #15e4c8;">
        <h5 class="modal-title" id="myModalLabel">Book Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <div class="student-body">
        <div class="modal-body">
    
        <p> This will show all inner pages of the book</p>
        <p> Read here</p>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
        </div>

      </form>   
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function readStory(id){
  	 $('#storyModal').modal({show:true}); 
  }
  function showDeleteActivity(id){    
      var id = id;            
      var table = "activity_sequencing_step";
      $('#tableIdActivity').val(id);
      $('#dbtableActivity').val(table);
      $('#confirmationDeleteActivity').modal({show:true}); 
     
  }

  function updateSequenceStep(val,id){
             
      $('#everyselect').load('../api/every-select-api.php?val=' + val + '&id='+id,function(){                     
         
      });      
      
  }

</script>
<?php

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}

include '../template/footer.php';

?>