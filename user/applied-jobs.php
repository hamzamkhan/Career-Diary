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
    <title>Career Diary</title>


    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="../backgrounds/Career_Diary_Cropped.png">
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
<body style="background: url(../backgrounds/IMG_20180419_172151.jpg); background-size: cover; background-position: center;background-attachment: fixed;">

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default navbar-fixed-top" style="background: rgba(13, 196, 181,0.8); font-family: Lato;border-color: rgba(255,255,255,0);">
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
            <li class="link-1"><a href="resume.php">Resume</a></li>
            <li class="link-1"><a href="dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="user-profile-template.php">Profile</a></li>
            <li class="link-1"><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="container">

    <!-- Other Dashboard Functions -->
    <div class="row" style="margin-top: 100px;">
      <div class="col-mid-12">
        <div class="table responsive">
          <h2 class="text-center" style="color:white; font-weight: bold;">Applied Jobs</h2>
            <table class="table" style="background-color: rgba(255,255,255,0);color: white;margin-top: 30px;font-size: 17px;">
              <thead>
                <th>Job Name</th>
                <th>Description</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience</th>
                <th>Qualification</th>
                <th>Created At</th>
              </thead>
              <tbody>
                <?php
                  $sql = "SELECT * FROM job_post INNER JOIN apply_job_post on job_post.id_jobpost=apply_job_post.id_jobpost WHERE apply_job_post.id_user='$_SESSION[id_user]'";
                  $result = $conn->query($sql);
                  if($result->num_rows>0){
                    while($row = $result->fetch_assoc())
                    {
                    
                     ?>
                      <tr>
                        <td><?php echo $row['jobtitle'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['minimumsalary'];?></td>
                        <td><?php echo $row['maximumsalary'];?></td>
                        <td><?php echo $row['experience'];?></td>
                        <td><?php echo $row['qualification'];?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['createdat']));?></td>
                      
                      </tr>
                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
    <!-- Search and Apply To Job Post -->
    <div class="row">
      <div class="col-mid-12">
        
      </div>
      
    </div>
    
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>