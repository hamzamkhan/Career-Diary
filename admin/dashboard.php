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
          	<!-- <li><a href="dashboard.php">Dashboard</a></li> -->
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
  				<a href="dashboard.php" class="list-group-item active">Dashboard</a>
  				<a href="user.php" class="list-group-item">Users</a>
  				<a href="company.php" class="list-group-item">Company</a>
  				<a href="job-posts.php" class="list-group-item">Job Posts</a>
  			</div>
  		</div>
  		<div class="col-md-6">
      <h3>Company Accounts</h3>
      <?php
        $sql = "SELECT * FROM company WHERE active = '2'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          echo '<h3>Total Pending Accounts: ' . $result->num_rows . '</h3>';
        }
      ?>
        <table class="table">
          <thead>
            <th>SNo</th>
            <th>Company Name</th>
            <th>Head Office</th>
            <th>Contact Number</th>
            <th>Website</th>
            <th>Email</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM company WHERE active = '2'";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $row['companyname']; ?></td>
                      <td><?php echo $row['headofficecity']; ?></td>
                      <td><?php echo $row['contactno']; ?></td>
                      <td><?php echo $row['website']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><a href="reject-company.php?id=<?php echo $row['id_company']; ?>">Reject</a> <a href="approve-company.php?id=<?php echo $row['id_company']; ?>">Approve</a></td>
                    </tr>
                  <?php
                }
              }

            ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
      <h3>User Accounts</h3>
      <?php
        $sql = "SELECT * FROM users WHERE active = '0'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          echo '<h3>Total Pending Accounts: ' . $result->num_rows . '</h3>';
        }
      ?>
        <table class="table">
          <thead>
            <th>SNo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>City</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM users WHERE active = '0'";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $row['firstname'] .' '. $row['lastname'] ; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['contactno']; ?></td>
                      <td><?php echo $row['city']; ?></td>
                      
                      <td><a href="reject-user.php?id=<?php echo $row['id_user']; ?>">Reject</a> <a href="approve-user.php?id=<?php echo $row['id_user']; ?>">Approve</a></td>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   
  </body>
</html>