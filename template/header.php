<?php 
include '../dbconnect/connect.php';

require_once '../snippet/session.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VSARC</title>



    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="../vendor/bootstrap/css/bootstrap-grid.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!-- date time picker-->
     
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="../css/dropzone.css" rel="stylesheet">
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">
      <h2>VSARC</h2>
      <!-- <img class="logo-top" src="../system-images/realty-logo.png" /> -->
      </a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group" style="display: none;">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
       
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">            
            <a class="dropdown-item" href="myprofile.php">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../snippet/logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">

        <li class="nav-item active text-center avatar-content">
          <a class="nav-link" href="../pages/dashboard.php" style="padding-bottom: 0">
            <?php
              $image_path = $_SESSION['image_path'];
              if($image_path == 'noimage.png'){
                $image_path = 'noimage-white.png';
              }
            ?>
            <span><img class="avatar" src="../uploads/<?php echo $image_path; ?>" /></span>
          </a>
          <a class="nav-link" href="../pages/myprofile.php" style="padding-bottom: 0.3em; border-bottom: 1px solid rgba(255,255,255,0.1)">            
            <span><?php echo $_SESSION['user']; ?></span>
          </a>
          <a class="nav-link" href="../pages/myprofile.php" style="padding: 0.3em 0; border-bottom: 1px solid rgba(255,255,255,0.1)">            
            <span>My Profile</span>
          </a>
          <a class="nav-link" href="../snippet/logout.php" style="padding-top: 0.3em;" data-toggle="modal" data-target="#logoutModal">            
            <span>Logout</span>
          </a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="../pages/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <?php if ($_SESSION['user_type'] == 'school-coordinator'){ ?>
            
            <li class="nav-item">
              <a class="nav-link" href="../pages/teacher.php">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teacher</span></a>
           
            <li class="nav-item">
              <a class="nav-link" href="../pages/school-coordinator.php">
                <i class="fas fa-unlock-alt"></i>
                <span>School Coordinator</span></a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="../pages/section-list.php">
                 <i class="fas fa-puzzle-piece"></i>
                <span>Section List</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../pages/assign-class.php">
                <i class="fas fa-hands-helping"></i>
                <span>Classes</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../pages/subject-list.php">
                <i class="fab fa-stripe-s"></i>
                <span>Subject List</span></a>
            </li>
        <?php } ?>

        <?php if ($_SESSION['user_type'] == 'teacher'){ ?>
             <li class="nav-item">
              <a class="nav-link" href="../pages/student.php">
                <i class="fa fa-user-graduate"></i>
                <span>Student</span></a>
            </li>             
             <li class="nav-item">
              <a class="nav-link" href="../pages/class-list.php">
                <i class="far fa-list-alt"></i>
                <span>List of Class</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chart-line"></i>
                <span>Create Activity</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="activityDropdown">                
                <a class="dropdown-item" href="../pages/activity-matching-type.php">Matching Type</a>
                <a class="dropdown-item" href="../pages/activity-sequencing.php">Sequencing</a>
                <a class="dropdown-item" href="../pages/activity-summarizing.php">Summarizing</a>
                <a class="dropdown-item" href="../pages/activity-inferencing.php">Inferencing</a>
                
              </div>
            </li>
             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="quizDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chalkboard"></i>
                <span>Create Quiz</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="quizDropdown">                
                <a class="dropdown-item" href="../pages/reading-quiz.php">Reading</a>
                <a class="dropdown-item" href="../pages/vocabulary-quiz.php">Vocabulary</a>

            
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="../pages/stories-to-read.php">
                <i class="fa fa-poo"></i>
                <span>Stories to Read</span></a>
             </li>
             <!--
             <li class="nav-item">
              <a class="nav-link" href="../pages/quiz-list.php">
                <i class="fas fa-list-ol"></i>
                <span>List of Quizzes</span></a>
             </li>
            -->
             <li class="nav-item">
              <a class="nav-link" href="../pages/student-performance.php">
                <i class="fa fa-chart-pie"></i>
                <span>Student Performance</span></a>
             </li>
           
         <?php } ?>

         <?php if ($_SESSION['user_type'] == 'student'){ ?>
             <li class="nav-item">
              <a class="nav-link" href="../pages/student-my-class.php">
                <i class="fas fa-users-class"></i>
                <span>My Class</span></a>
            </li>
        
             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chart-line"></i>
                <span>My Activity</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="activityDropdown">                
                <a class="dropdown-item" href="../pages/student-activity-matching-type.php">Matching Type</a>
                <a class="dropdown-item" href="../pages/student-activity-sequencing.php">Sequencing</a>
                <a class="dropdown-item" href="../pages/student-activity-summarizing.php">Summarizing</a> 
                <a class="dropdown-item" href="../pages/student-activity-inferencing.php">Inferencing</a>
              </div>
            </li>       

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="quizDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-list-ol"></i>
                <span>My Quiz</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="quizDropdown">                                
                <a class="dropdown-item" href="../pages/student-quiz-reading.php">Reading</a> 
                <a class="dropdown-item" href="../pages/student-quiz-vocabulary.php">Vocabulary</a>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../pages/list-of-stories.php">
                <i class="fa fa-poo"></i>
                <span>Stories to Read</span></a>
             </li>
            <li class="nav-item">
              <a class="nav-link" href="../pages/myperformance.php">
                <i class="fa fa-chart-pie"></i>
                <span>My Performance</span></a>
             </li>
         <?php } ?>
         
      <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a>
          </div>
        </li>
        
       
        <li class="nav-item">
          <a class="nav-link" href="client-list.php">
            <i class="fas fa-th-list"></i>
            <span>Client List</span></a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="employee-list.php">
            <i class="fas fa-th-list"></i>
            <span>Employee List</span></a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Records & Documents</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="recordsDropdown">            
            <a class="dropdown-item" href="payment-history.php">Payment History</a>
            <a class="dropdown-item" href="property.php">Property</a>
            <a class="dropdown-item" href="legal-document.php">Legal Documents</a>            
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i>
            <span>Reports</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="reportsDropdown">            
            <a class="dropdown-item" href="financial-report.php">Financial Report</a>
            <a class="dropdown-item" href="customer-report.php">Customer Report</a>  
            <a class="dropdown-item" href="rental-report.php">Rental Report</a>     
            <a class="dropdown-item" href="maintenance-report.php">Maintenance Report</a>         
          </div>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="trackingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-trello"></i>
            <span>Tracking Sheet</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="trackingDropdown">            
            <a class="dropdown-item" href="account-balance.php">Account Balance</a>
            <a class="dropdown-item" href="property-tracking.php">Property Tracking</a>            
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="maintenance-request.php">
            <i class="fas fa-wrench"></i>
            <span>Maintenance Request</span></a>
        </li>
       -->
      </ul>
