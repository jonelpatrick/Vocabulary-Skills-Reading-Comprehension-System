<?php
	include '../template/header.php';
?>
<style type="text/css">
  #slideshow {
  margin: 0 auto;
  position: relative;
  
  padding: 10px;
 
}

#slideshow > div {
  position: absolute;
  top:10px;
  left: 10px;
  right: 10px;
  bottom: 100px;
}
#slideshow > div > img{
  width: 100%;
  height: auto;
   box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);

}
.slider-label{
  width: 100%;
}
#page-top .sticky-footer{
 display: none;
}
.rightside-dashboard{
      min-height: 600px;
    background: #e8e8e8;
    min-height: 600px;
    text-align: center;
    padding: 10%;
}
.slider-content2{
      box-shadow: 0px 0px 2px;
    background: #f1a7cc;
}
.title{
  text-transform: uppercase;
}
</style>
  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
      
      <div class="col-sm-12">
        <h2 class="text-center form-control title">Reading makes you taller and smarter</h2>
        <div class="row">
      <div class="col-md-6 slider-content2" >    
       <div id="slideshow">   
         <?php

            $sql = "SELECT title,category,file_name FROM activity_story ";
            $result = mysqli_query($mysqli,$sql);
            if (mysqli_num_rows($result) > 0) { 
               while($row = mysqli_fetch_assoc($result)) {
                  echo '<div>';
                  echo ' <img  src="../stories/'.$row['file_name'].'">';
                  echo '<div class="slider-label btn btn-secondary">'.$row['title'] .' - '.$row['category'].'</div>';
                  echo "</div>";
               
               }
             }
         ?>  
       </div>     
      </div>
      <div class="col-sm-6 " style="margin-bottom: 2em">
        <img src="../system-images/dasboard-cover.jpg">
      </div>
      </div>
    </div><!-- row -->
    </div>
</div>
<?php
	include '../template/footer.php';
?>

<script type="text/javascript">
  $("#slideshow > div:gt(0)").hide();

setInterval(function() {
  $('#slideshow > div:first')
    .fadeOut(2000)
    .next()
    .fadeIn(2000)
    .end()
    .appendTo('#slideshow');
}, 6000);
</script>