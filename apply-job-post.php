<?php
session_start();

// if(empty($_SESSION['id_user'])) {
//   $_SESSION['callFrom'] = "apply-job-post.php?id=".$_GET[id];
//   header("Location: login.php");
//   exit();
// } 
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Career Diary</title>

    <link rel="icon" type="image/png" href="backgrounds/Career_Diary_Cropped.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="hover-styling.css">
    <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700" rel="stylesheet"> 
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
    <nav class="navbar navbar-default navbar-fixed-top" style="background: rgba(13, 196, 181,0.8); font-family: Lato; border-color: rgba(255,255,255,0);position: fixed;width: 100%;top:0;">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right" >
            <?php
            if(isset($_SESSION['id_user'])) {
              ?>
              <li class="link-1"><a href="user/dashboard.php">Dashboard</a></li>
              <li class="link-1"><a href="search.php">Search</a></li>
              <li class="link-1"><a href="logout.php">Logout</a></li>
            <?php
              }   
            else { 
            ?>
              <li class="link-1"><a href="register-candidates.php">User Sign Up</a></li>
              <li class="link-1"><a href="login.php">User Login</a></li>
            <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

 <div class="content-wrapper" style="margin-top: 100px;">

  <?php
  
    $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
  ?>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">          
          <div class="col-md-9 bg-white padding-2">
            <div class="pull-left">
              <h2><b><?php echo $row['jobtitle']; ?></b></h2>
            </div>
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
            <hr>
            <div>
              <p><span class="margin-right-10"> <?php echo $row['city']; ?></span> <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></p>              
            </div>
            <div>
              <?php echo stripcslashes($row['description']); ?>
            </div>
           
            <div>
              <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-success btn-flat margin-top-50" style="margin-top: 10px;">Apply</a>
            </div>
           
          </div>
        </div> 
      </div>
    </section>   
    <?php 
      }
    }
    ?> 
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>