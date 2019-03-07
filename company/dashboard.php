<?php
session_start();
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Job Portal</title>

    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="../hover-styling.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .navbar-brand a{
        color: white;
      }
      .nav.navbar-nav.navbar-right li a{
        color:white;
      }
    </style>
</head>
<body class="background-image" style="background: url(../backgrounds/IMG_20180419_172121.jpg); background-size:2200px; background-position: center; background-attachment: fixed;">

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default" style="background: rgba(13, 196, 181,0.8); font-family: Lato; border-color: rgba(255,255,255,0);">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="../index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="profile.php">Profile</a></li> -->
            <li class="link-1"><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="container">
  <?php if(isset($_SESSION['jobPostSuccess'])){ ?>
    <div class="row successMessage">
      <div class="alert alert-success">
        Job Post Created Successfully!    
      </div>
    </div>
  <?php unset($_SESSION['jobPostSuccess']); } ?>

  <?php if(isset($_SESSION['jobPostUpdateSuccess'])){ ?>
    <div class="row successMessage">
      <div class="alert alert-success">
        Job Post Update Successfully!    
      </div>
    </div>
  <?php unset($_SESSION['jobPostUpdateSuccess']); } ?>

  <?php if(isset($_SESSION['jobPostDeletedSuccess'])){ ?>
    <div class="row successMessage">
      <div class="alert alert-success">
        Job Post Deleted Successfully!    
      </div>
    </div>
  <?php unset($_SESSION['jobPostDeletedSuccess']); } ?>
    <div class="row">
      <h2 class="text-center" style="color:white;font-weight: bolder;margin-top:250px;">Dashboard</h2>
      <hr style=" border: 0; height: 1px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));">
      <div class="col-md-2" style="position: center;">
        <a href="create-job-post.php" style="text-align:center;display:inline-block;background: rgba(13, 196, 181,0.8);margin-left: 325px;" class="btn btn-success btn-block btn-lg">Create Job Post</a>
      </div>
      <div class="col-md-2" style="position: center;">
        <a href="view-job-post.php"  style="background: rgba(13, 196, 181,0.8);margin-left: 450px;" class="btn btn-success btn-block btn-lg">View Job Post</a>
      </div>
      <!-- <?php 
        $sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_user]' AND status='0'";
        $result = $conn->query($sql);
        if($result->num_rows>0) {
          ?>
          <div class="col-md-3">
            <a href="view-job-application.php" class="btn btn-success btn-block btn-lg">View Application<span class="badge"><?php echo $result->num_rows; ?></a>
          </div>
          <?php
        }
      ?> -->
    </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <script type="text/javascript">
     $(function(){
      $(".successMessage:visible").fadeOut(2000); //miliseconds of time
     });
   </script>
  </body>
</html>