 <?php
session_start();
if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
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
<body>

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default" style="background: rgba(13, 196, 181,0.8); font-family: Lato;">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color: white; font-family: Raleway; font-weight: 700;" href="../index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          	
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-4">
  			<div class="list-group">
  				<a href="dashboard.php" class="list-group-item">Dashboard</a>
  				<a href="user.php" class="list-group-item">Users</a>
  				<a href="company.php" class="list-group-item">Company</a>
  				<a href="job-posts.php" class="list-group-item active">Job Posts</a>
  			</div>
  		</div>
  		<div class="col-md-6">
  			<div class="col-md-6">
      <?php
        $sql = "SELECT * FROM job_post";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          echo '<h3>Job Posts : ' . $result->num_rows . '</h3>';
        }
      ?>
        <table class="table">
          <thead>
            <th>SNo</th>
            <th>Job Title</th>
            <th>Minimum Salary</th>
            <th>Maximum Salary</th>
            <th>Experience</th>
            <th>Total Users Applied</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM job_post";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $row['jobtitle']; ?></td>
                      <td><?php echo $row['minimumsalary']; ?></td>
                      <td><?php echo $row['maximumsalary']; ?></td>
                      <td><?php echo $row['experience']; ?></td>
                      <?php
                        $sql1 = "SELECT COUNT(apply_job_post.id_apply) AS totalNo FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE job_post.id_jobpost='$row[id_jobpost]'";
                        $result1 = $conn->query($sql1);
                        if($result1->num_rows > 0){
                          while($row1 = $result1->fetch_assoc()){
                          ?>   
                            <td><?php echo $row1['totalNo']; ?></td>
                          <?php
                        }
                      }                    
                      ?>
                      <td><a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Delete</a></td>
                    </tr>
                  <?php
                }
              }

            ?>
          </tbody>
        </table>
      </div>
  		</div>
  	</div>
  	
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   
  </body>
</html>