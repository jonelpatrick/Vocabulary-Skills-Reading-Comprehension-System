<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VSARC - Coordinator Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style type="text/css">
      .col-lg-7 img{
        width:100%;
        margin-top: 15%;
      }
      .col-lg-5{
          border-left: 1px solid rgba(0,0,0,0.1);
      }
      p{
        color:#fff;
        text-align: center;
         padding: 20px;
        font-size: 13px;
      }
      div.card-header{
          background: #a85801;
          color: #fff;
      }
    </style>
  </head>

  <body class="">

    <div class="container" >
      <div class="row">
        <div class="col-lg-7">
            <img src="system-images/laptop-1019763_1920.jpg" />
        </div>
    <div class="col-lg-5" >
      <h1 style="margin-top: 10%;">Vocabulary Skills & <br> Reading Comprehension </h1>
         <div class="card card-login mx-auto mt-5">
          <div class="card-header">School Coordinator Login</div>
          <div class="card-body">
            <?php
               session_set_cookie_params(600);
               session_start();
               
              if(isset($_SESSION['ERR'])){
                echo '<label style="color:red;">'.$_SESSION['ERR'].'</label>';       
                $_SESSION['ERR'] = '';        
              }
              
            ?>
            <form method="POST" action="snippet/login.php">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="required" autofocus="autofocus">
                  <label for="inputEmail">Email address</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="form-group inline-layout">                    
                  <label class="radio-inline" style="margin-right: 20px;">
                    <input type="radio" name="academic_relation" value="3" checked> School Coordinator
                  </label>

              </div>
              <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
            </form>
            <div class="text-center">
              
              <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
            </div>
          </div>
        </div>
    </div>

    </div><!-- row-->
    </div>
    <div class="bg-dark">
      <p>Vocabulary skills & Reading Comprehension skills of Grade 11 Students Copyright 2018</p>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
