<?php
	include '../template/header.php';
  define("UPLOAD_DIR", "../stories/");
?>
<style type="text/css">
	.thumbs{
		width: 150px;
	}
	button.file-select{
		  position: absolute;
    	background: #a5e65e;
      color:#fff;
	}
  .story-title span{
    font-size: 14px;
    /* padding-top: 5em; */
    background: #c8dde88a;
    padding: 5px 20px;
    /* margin-top: 3em; */
    border-radius: 25px;
  }
</style>
  <div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Activity
        </li>
        <li class="breadcrumb-item active">
        <a href="stories-to-read.php">Stories to Read</a></li>
      </ol>    

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-book"></i>
              List of Story book</div>

            <div class="card-body">
                                       
              <hr/>
              
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
                              title,
                              category,
                              file_name,
                              uploaded_by
                              FROM activity_story WHERE deleted = 0";
                      $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {                         
                        $x = 0;
                        $y =0;
                         while($row = mysqli_fetch_assoc($result)) {

                          $id = $row['id'];
                          $file_name = $row['file_name'];
                          $category = $row['category'];
                          $uploaded_by = $row['uploaded_by'];
                          $title = $row['title'];
           
                         
                          $path = UPLOAD_DIR.$file_name;
                          $default = '../system-images/story-book.png';
                          echo '<td align="center">';
                          echo '<button class="file-select btn" onclick="readStory()" > <i class="fas fa-hand-pointer" aria-hidden="true" title="Read this story"></i> </button>';

                          echo '<a  onclick="readStory();">';
                          if(is_image($path)){

                              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs" src="'.$default.'" /><br>';
                          }
                          echo '<div class="text-center story-title">';
                          echo '<span>'.$title.'</span>';
                          echo '</div>';
                          echo '</a>';
                          echo '</td>';
                          
                          $x++;
                          if($x == 6){
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
  function deleteFile(id){
      var id = id;            
      var table = "activity_story";
      var redirect = '../pages/stories-to-read.php';
      $('#tableId02').val(id);
      $('#dbtable02').val(table);
      $('#redirectpage02').val(redirect);
      $('#confirmationDeleteFile').modal({show:true}); 
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