 <?php  
  include '../dbconnect/connect.php';
  define("UPLOAD_DIR", "../stories/");

  $id = $_GET['id'];
 ?>
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
              activity_story_id,              
              file_name
              FROM activity_story_pages
              WHERE activity_story_id = '$id'";

      $result = mysqli_query($mysqli,$sql);
      if (mysqli_num_rows($result) > 0) {                         
        $x = 0;
        $y =0;
         while($row = mysqli_fetch_assoc($result)) {

          $id         = $row['id'];
          $file_name  = $row['file_name'];
          $story_id   = $row['activity_story_id'];
          
          $path    = UPLOAD_DIR.$file_name;
          $default = '../system-images/story-book.png';
          echo '<td align="center">';
          echo '<button class="file-trash btn" onclick="javascript:deleteFile2('.$id.');"> <i class="fa fa-trash" aria-hidden="true" title="Delete this file"></i> </button>';

          echo '<a  onclick="readStory();">';
          if(is_image($path)){

              echo '<img class="thumbs" src="'.$path.'" /><br>'; 
          }else{
             
             //echo '<iframe class="thumbs"  id="myiframe" src="'.$path.'">';
             echo '<embed src="'.$path.'" class="thumbs" type="application/pdf">';
          }
          
          echo '</a>';
          echo '</td>'; 
          
          $x++;
          if($x == 3){
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
?>
<script type="text/javascript">
    function deleteFile2(id){
      var id = id;            
      var table = "activity_story_pages";
      
      $('#storyid').val(id);
      $('#storytable').val(table);      
      $('#confirmationDeleteStory').modal({show:true}); 
  }

</script>