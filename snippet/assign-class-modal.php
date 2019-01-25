<?php
include '../dbconnect/connect.php';

$id = $_GET['id'];

  $sql = "SELECT 
         class.id id,
         section.name section,
         subject.name subj,
         teacher.firstname fname,
         teacher.middlename mname,
         teacher.lastname lname,
         class.status statu,
         teacher.id tid,
         section.id secid,
         subject.id subjid 
         FROM class 
         INNER JOIN section 
         ON class.section_id = section.id 
         INNER JOIN subject 
         ON class.subject_id = subject.id 
         INNER JOIN teacher 
         ON class.teacher_id = teacher.id 
         WHERE class.deleted = 0 AND 
         class.id = '$id'";                   

 $result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

      $name = $row['fname'].' '.$row['mname'].' '.$row['lname'];
      $section = $row['section'];
      $subject = $row['subj'];
      $id = $row["id"]; 
      $status = $row['statu'];   
      $section_id = $row['secid'];      
      $teacher_id = $row['tid'];
      $subject_id = $row['subjid'];

     }
  }
?>
  <div style="margin-left: 1em;">
      <div class="form-group inline-layout" style="margin-top: 1em;">  
        <label class="radio-inline attach-property-label">Select Teacher: </label> 
        <select class="custom-select radio-inline" name="teacher" style="display: inline;width:80%;">
            <?php
              $sql = "SELECT id,firstname,middlename,lastname FROM teacher WHERE deleted = 0 AND active = 1";
               $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                   while($row = mysqli_fetch_assoc($result)) {
                    $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                    $id  = $row['id'];

                    $selected = "";
                    if($teacher_id == $id){
                    	$selected = 'selected';
                    }
                    echo '<option value="'.$id.'" '.$selected.' >'.$name.'</option>';
                   }
                }
            ?>                    
        </select>
      </div>
    </div>
     <div style="margin-left: 1em;">
      <div class="form-group inline-layout">  
        <label class="radio-inline attach-property-label" style="background: #a465d2;color:#fff;">Select Section: </label> 
        <select class="custom-select radio-inline" name="section" style="display: inline;width:80%;">
            <?php
              $sql = "SELECT id,name,comment FROM section WHERE deleted = 0 ";
               $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) { 
                   while($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $id  = $row['id'];
                    $comment = $row['comment'];

                    $selected = "";
                    if($section_id == $id){
                    	$selected = 'selected';
                    }

                    echo '<option value="'.$id.'" '.$selected.' >'.$name.' - '.$comment.'</option>';
                   }
                }
            ?>                    
        </select>
      </div>
    </div>
    <div style="margin-left: 1em;">
      <div class="form-group inline-layout">  
        <label class="radio-inline " >Subject: </label>   
            <select class="custom-select radio-inline" name="section" style="display: inline;width:80%;">
	            <?php
	              $sql = "SELECT id,name,description FROM subject WHERE deleted = 0 ";
	               $result = mysqli_query($mysqli,$sql);
	                if (mysqli_num_rows($result) > 0) { 
	                   while($row = mysqli_fetch_assoc($result)) {
	                    $name = $row['name'];
	                    $id  = $row['id'];
	                    $desc = $row['description'];

	                    $selected = "";
	                    if($subject_id == $id){
	                    	$selected = 'selected';
	                    }
	                    echo '<option value="'.$id.'" '.$selected.'>'.$name.' - '.$desc.'</option>';
	                   }
	                }
	            ?>                    
	        </select>      
      </div>
    </div>
    <div style="margin-left: 1em;">
      <div class="form-group inline-layout"> 
        <label class="radio-inline " >Time [24H Format]:<br> hh:mm:s </label>
        <label class="small" style="width: 30%;">
          From: <input type="text" name="time_from" placeholder="ex. 16:00:00" class="form-control">
        </label> 
        <label class="small" style="width: 30%;">
          To: <input type="text" name="time_to" placeholder="ex. 08:00:00"  class="form-control">
        </label>  <br><hr>
        <label class="radio-inline " >Day </label> 
        <label class="small">
          <input type="checkbox" name="day" checked=""> Everyday            
        </label>
      </div>
    </div>