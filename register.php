
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VSARC  - Register</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

       <!-- date time picker-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
        
           <form method="POST" action="cli/functions.php">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
              <label id="registerMessage" style="color:red;"></label>              
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" name="firstname" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                    <label for="firstName">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="middleName" name="middlename" class="form-control" placeholder="Middle name" required="required">
                    <label for="middleName">Middle name</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus">
                    <label for="lastName">Last name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone number" required="required">
                    <label for="phone">Phone Number</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    
                    <input type="text" class="form-control" data-date-format="yyyy-MM-dd" id="datepicker2" name="birthday" >
                    <label for="datepicker">Birthday</label>
                  </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group inline-layout">  
                        <label class="radio-inline">Academic Relation: </label> <br>

                        <label class="radio-inline" style="margin-right: 20px;">
                          <input type="radio" name="academic_relation" value="0" checked> Student
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="academic_relation" value="1"> Teacher
                        </label>
                    </div>
                </div>
              </div>
            </div>
            <hr>
             <div class="form-group inline-layout">
                <label class="radio-inline">Sex: </label>
                <label class="radio-inline">
                  <input type="radio" name="formRadioSex" value="0" checked> Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="formRadioSex" value="1"> Female
                </label>
            </div>
              <hr>
            <div class="form-group">
              <div class="form-label-group">
                <textarea id="physicalAddress" name="physical_address" class="form-control" placeholder="Physical Address" required=""></textarea>
                
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" onkeyup="checkemail();" required="required">
                <label for="inputEmail">Email address</label>
                <span id="email_status" style="font-size:12px;margin-left: 1em;"></span>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" name="register" id="submitRegister" class="btn btn-primary btn-block" value="Register">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>
            <!--<a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
          </div>
        </div>
      </div>
    </div>



    <!-- Bootstrap core JavaScript-->
 
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
       
    <!-- date picker -->

  <script>
    //check for email used
    function checkemail(){
     var email=document.getElementById( "inputEmail" ).value;
      
     if(email){

      $.ajax({
      type: 'post',
      url: 'snippet/checkdata.php',
      data: {
       user_email:email,
      },
      success: function (response) {
       $( '#email_status' ).html(response);
         if(response=="email is available") {
           $(':input[type="submit"]').prop('disabled', false);
          return true;  
         }else{
          $(':input[type="submit"]').prop('disabled', true);
          return false; 
         }
      }
      });
     }else{
      $( '#email_status' ).html("");
       $(':input[type="submit"]').prop('disabled', true);
      return false;
     }
  }


  $("form").submit(function(){
    var pass = $('#inputPassword').val();
    var confirm = $('#confirmPassword').val();
    if(pass != confirm){
      $("#registerMessage").text("Password & Confirm Password is not the same!");
      return false;
    }

  });

  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });

  } );
  </script>

  </body>

</html>
