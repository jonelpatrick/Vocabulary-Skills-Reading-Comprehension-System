<?php
	include '../template/header.php';
  define("UPLOAD_DIR", "../stories/");

  $teacher_id = $_SESSION['user_id'];
?>
<link rel="stylesheet" href="../dist/css/lightbox.min.css">
<style type="text/css">
	.thumbs{
		width: 150px;
	}
	button.file-trash{
		position: absolute;
    	background: #f9190e;
	}
  .lb-outerContainer,.lb-container,.lb-image{
    width: 800px !important;
    height: auto !important;
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
            <i class="fas fa-images"></i>
              Details of Story</div>

            <div class="card-body">
             <div class="row">
             	<div class="col-lg-12" style="box-shadow: 0px 0px 2px;">
             	 		            

                     <hr/>
               <i class="fas fa-book"></i>
                  
              <span>List of Story book</span>
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
                        
                          echo '<a  class="example-image-link" href="'.$path.'" data-lightbox="example-set'.$id.'" data-title="Click anywhere outside the image or the X to the right to close.">';
                          if(is_image($path)){

                              echo '<img class="thumbs example-image" src="'.$path.'" /><br>'; 
                          }else{
                             echo '<img class="thumbs example-image" src="'.$default.'" /><br>';
                          }

                          $sql2 = "SELECT * FROM activity_story_pages WHERE activity_story_id = '$id'";
                          $result2 = mysqli_query($mysqli,$sql2);
                          if (mysqli_num_rows($result2) > 0) {  
                                                                              
                            while($row2 = mysqli_fetch_assoc($result2)) {
                              $path2 = UPLOAD_DIR.$row2['file_name'];

                             echo '<div style="display:none;">';
                              echo '<a  class="example-image-link" href="'.$path2.'" data-lightbox="example-set'.$id.'" data-title="Click anywhere outside the image or the X to the right to close.">';

                              if(is_image($path2)){
                                 echo '<img class="thumbs example-image" src="'.$path2.'" />'; 
                              }else{                                 
                                 
                                 echo '<img class="thumbs example-image" src="../stories/default.jpg" />'; 
                              }
                              
                              echo "</a>";
                              echo "</div>";
                            }
                          }

                          echo '<span>'.$title.'</span>';
                          echo '</a>';
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

    </div>
</div>

    </div>
    </div>
  </div>
</div>
  <script src="../dist/js/lightbox-plus-jquery.min.js"></script>
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

  function changeStoryList(val){
    var id = val;
    //alert(val);
    if(id != 0){
       $('#listOfInnerPages').load('../snippet/inner-pages-dynamic.php?id=' + id,function(){               
      });
    }
   
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