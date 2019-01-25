<?php
	include '../template/header.php';

  $id = $_SESSION['user_id'];
  $user_type = $_SESSION['user_type'];
  
  switch ($user_type) {

    case 'school-coordinator':
      
      $sql = "SELECT 
        school_coordinator.id id,
        co_account_id,
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
            $account_id = $row['co_account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
         }
      }
      break;

    case 'teacher':
      
       $sql = "SELECT 
              teacher.id id,
              account_id,
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
            $account_id = $row['account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
           }

         }

      break;

    case 'student':
      
      $sql = "SELECT 
              student.id id,
              account_id,
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
              FROM student 
              INNER JOIN account
              ON student.account_id = account.id
              WHERE student.deleted = 0 AND student.id = '$id'";

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
            $account_id = $row['account_id'];

            if($image_path == "" || $image_path == NULL){
              $image_path = "noimage.png";
            }
           }

         }

      break;

    default:
      echo 'Something went wrong';
      break;
  }
?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">My Profile</a>
        </li>
        <li class="breadcrumb-item active">Settings</li>
      </ol>    
     <form method="POST" action="../cli/functions.php" enctype="multipart/form-data">
      <input type="hidden" name="action" value="updateProfile<?php echo  $user_type; ?>">
      <input type="hidden" name="user_id" value="<?php echo $id; ?>">
      <input type="hidden" name="account_id" value="<?php echo  $account_id; ?>">
      <div class="row">
         <label id="profileMessage" style="color:red;"></label> 
        <div class="col-lg-8 offset-2">
         <div class="btn-container">  
            <input type="submit" class="btn btn-primary" value="Update Profile" />
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-6">
               <div class="input-group mb-3" >
                 <div class="form-group" style="width:100%;">
                    <img id='img-upload' style="height: 300px;" src="../uploads/<?php echo $image_path; ?>" />
                    
                    <div class="input-group addborder">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp" name="image">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    
                </div>             
              </div>
            </div> 
            <div class="col-lg-6">
               <div class="form-group">   
                  <label>Firstname :</label>
                  <input class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div> 
                <div class="form-group">   
                  <label>Middlename :</label>
                  <input class="form-control" name="middlename" value="<?php echo $middlename; ?>">
                </div> 
                <div class="form-group">   
                  <label>Lastname :</label>
                  <input class="form-control" name="lastname" value="<?php echo $firstname; ?>">
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
            </div>
        </div>
          <div class="form-group">   
            <label>Birthday</label>
            <input class="form-control" data-date-format="yyyy-mm-dd" id="datepicker" name="birthday">
          </div>  
         <div class="form-group">   
            <label>Physical Address :</label>
            <textarea class="form-control" name="physical_address"><?php echo $address; ?></textarea>
          </div> 
          <div class="form-group">           
            <label>Phone Number :</label>
            <input class="form-control" name="phone" value="<?php echo $phone; ?>">  
          </div> 

         
           <div class="jumbotron">
              <div class="form-group">   
                <label>Email Address :</label>
                <input class="form-control" name="email_address" value="<?php echo $email; ?>">
              </div>      
              <div class="form-group">  
               <label>Password :</label>        
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="<?php echo $password; ?>" >
              </div>
              <div class="form-group">          
               <label>Confirm Password :</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php echo $password; ?>">
              </div>
           </div>
        </div>
        
    </div><!-- row -->
  </form>
</div>
<script type="text/javascript">
 
</script>

<?php
	include '../template/footer.php';
?>