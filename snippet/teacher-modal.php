<?php 
include '../dbconnect/connect.php';

  $id = $_GET['id'];

  $sql = "SELECT 
        teacher.id id,
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
        approved,
        password 
        FROM teacher
        INNER JOIN account
        ON teacher.account_id = account.id
        WHERE teacher.deleted = 0 AND teacher.id = '$id'";

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
     	$approved = $row['approved'];
     	$birthday = $row['birthday'];
     	$phone = $row['phone'];
     	$password  = $row['password'];
      $sex = $row['sex'];

     	if($image_path == "" || $image_path == NULL){
     		$image_path = "noimage.png";
     	}
     }

   }

?>
 <input type="hidden" value="editTeacherAccount" name="action">
 <input type="hidden" name="teacher_id" value="<?php echo $id; ?>">
    <div class="input-group mb-3" style="margin-bottom: 0 !important;">
       <div class="form-group" style="width:100%;">
          <div class="primary-img">
            <img src="../uploads/<?php echo $image_path; ?>">
          </div>
      </div>
     
    </div>
     <div class="form-group">          
      <input type="text" class="form-control"  name="firstname" value="<?php echo $firstname; ?>" disabled>
    </div>
     <div class="form-group">          
      <input type="text" class="form-control"  name="middlename" value="<?php echo $middlename; ?>" disabled>
    </div>
     <div class="form-group">        
      <input type="text" class="form-control"  name="lastname" value="<?php echo $lastname; ?>" disabled>
    </div>
     <div class="form-group">          
      <input type="text" class="form-control"  name="birthday" value="<?php echo $birthday; ?>" disabled>
    </div>
     <div class="form-group inline-layout">
        <label class="radio-inline">Sex: </label>
        <label class="radio-inline">
          <input type="radio" name="formRadioSex" disabled value="0" <?php if($sex == 0){ echo 'checked';} ?>>Male
        </label>
        <label class="radio-inline">
          <input type="radio" name="formRadioSex" disabled value="1" <?php if($sex == 1){ echo 'checked';} ?>>Female
        </label>
    </div>
    <div class="form-group">          
      <input type="text" class="form-control"  name="phone" value="<?php echo $phone; ?>" disabled>
    </div>
    <div class="form-group">          
      <textarea name="address" class="form-control" readonly=""><?php echo $address; ?></textarea>
    </div>

   
       <div class="form-group">          
        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" disabled="">          
      </div>       
      <div class="form-group">          
        <input type="text" class="form-control"  name="password" value="<?php echo $password; ?>" disabled="">
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
    <div class="form-group inline-layout">
        <label class="radio-inline">Registration approval: </label>
        <label class="radio-inline">
          <input type="radio" name="approved" value="0" <?php if($approved == 0){ echo 'checked';} ?>>Not Approve
        </label>
        <label class="radio-inline">
          <input type="radio" name="approved" value="1" <?php if($approved == 1){ echo 'checked';} ?>>Approve
        </label>
    </div>
    <hr>

</div>

