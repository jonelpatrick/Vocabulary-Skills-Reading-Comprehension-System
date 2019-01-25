<?php 
include '../dbconnect/connect.php';

  $id = $_GET['id'];

  $sql = "SELECT 
        school_coordinator.id id,
        image_path,
        firstname,
        middlename,
        lastname,
        phone,
        birthday,
        sex,
        email_address,
        physical_address,
        active,
        co_account_id,
        password 
        FROM school_coordinator 
        INNER JOIN co_account
        ON school_coordinator.co_account_id = co_account.id
        WHERE school_coordinator.deleted = 0 AND school_coordinator.id = '$id'";

 $result = mysqli_query($mysqli,$sql);
  if (mysqli_num_rows($result) > 0) { 
     while($row = mysqli_fetch_assoc($result)) {

     	$image_path = $row['image_path'];
     	$firstname = $row['firstname'];
     	$middlename = $row['middlename'];
     	$lastname = $row['lastname'];
     	$email = $row['email_address'];
     	$address = $row['physical_address'];
     	$active = $row['active'];     	
     	$birthday = $row['birthday'];
     	$phone = $row['phone'];
     	$sex = $row['sex'];
     	$password  = $row['password'];
     	$co_account_id = $row['co_account_id'];

     	if($image_path == "" || $image_path == NULL){
     		$image_path = "noimage.png";
     	}
     }

   }

?>
 <input type="hidden" value="editCoordinatorAccount" name="action">
 <input type="hidden" name="coordinator_id" value="<?php echo $id; ?>">
 <input type="hidden" name="co_account_id" value="<?php echo $co_account_id; ?>">
    <div class="input-group mb-3" style="margin-bottom: 0 !important;">
       <div class="form-group" style="width:100%;">
          <div class="primary-img">
            <img src="../uploads/<?php echo $image_path; ?>">
          </div>
      </div>
     
    </div>
     <div class="form-group">          
      <input type="text" class="form-control"  name="firstname" value="<?php echo $firstname; ?>">
    </div>
     <div class="form-group">          
      <input type="text" class="form-control"  name="middlename" value="<?php echo $middlename; ?>" >
    </div>
     <div class="form-group">        
      <input type="text" class="form-control"  name="lastname" value="<?php echo $lastname; ?>" >
    </div>
     <div class="form-group">          
      <input type="text" class="form-control" data-date-format="yyyy-mm-dd" id="datepicker2"  name="birthday"  name="birthday" value="<?php echo $birthday; ?>" >
    </div>
     <div class="form-group inline-layout">
	    <label class="radio-inline">Sex: </label>
	    <label class="radio-inline">
	      <input type="radio" name="formRadioSex" value="0" <?php if($sex == 0){ echo 'checked';} ?>>Male
	    </label>
	    <label class="radio-inline">
	      <input type="radio" name="formRadioSex" value="1" <?php if($sex == 1){ echo 'checked';} ?>>Female
	    </label>
	</div>
    <div class="form-group">          
      <input type="text" class="form-control"  name="phone" value="<?php echo $phone; ?>">
    </div>
    <div class="form-group">          
      <textarea name="address" class="form-control" ><?php echo $address; ?></textarea>
    </div>

   
       <div class="form-group">          
        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" >          
      </div>       
      <div class="form-group">          
        <input type="text" class="form-control"  name="password" value="<?php echo $password; ?>" >
      </div>
 
 <div class="jumbotron mybox">
     <div class="form-group inline-layout">
        <label class="radio-inline">Status: </label>
        <label class="radio-inline">
          <input type="radio" name="status" value="1" <?php if($active == 1){ echo 'checked';} ?>>Active
        </label>
        <label class="radio-inline">
          <input type="radio" name="status" value="0" <?php if($active == 0){ echo 'checked';} ?>>Inactive
        </label>
    </div>   
    <hr>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script type="text/javascript">
        $('#datepicker2').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker2').datepicker("setDate", new Date());
    </script>

