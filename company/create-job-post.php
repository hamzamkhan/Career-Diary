<?php
  session_start();
  if(empty($_SESSION['id_user'])) {
      header("Location: user/dashboard.php");
      exit();
    }
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

    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'#description'});</script>


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
      .nav.nav-pills.nav-stacked li a:hover{
        background-color:rgba(13, 196, 181,0.8);
      }
    </style>
</head>
<body class="background-image" style="background: url(../backgrounds/IMG_20180419_171614.jpg); background-size:1550px; background-position: center; background-attachment: fixed;">

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default" style="background: rgba(13, 196, 181,0.8); font-family: Lato; border-color:rgb(13, 196, 181);">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="../index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse- 1">
          <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION['id_user'])) {
            ?>
          <?php
          } else { 
          ?>
            <li class="link-1"><a href="company.php">Company</a></li>
            <li class="link-1"><a href="register.php">Register</a></li>
            <li class="link-1"><a href="login.php">Login</a></li>
          <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="content-wrapper" style="margin-left: 0px;">

    <section  class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3" >
            <div class="box" >
              <div class="box-body no-padding"  >
                <ul class="nav nav-pills nav-stacked">
                  <li><a style="color:white;" href="view-job-post.php">Job Post</a></li>
                  <li  class="active"><a style="background-color: rgba(13, 196, 181,0.8);" href="create-job-post.php">Create Job Post</a></li>
                  <li><a style="color:white;" href="../logout.php">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2 style="color:white;">Create Job Post</h2>
            <div class="row">
              <form method="post" action="addpost.php">
                <div class="col-md-12 latest-job">
                  <div class="form-group">
                    <input class="form-control input-lg" type="text" id="jobtitle" name="jobtitle" placeholder="Job Title">
                 </div>
                  <div class="form-group">
                    <label style="color:white;">Description</label>
                    <textarea class="form-control input-lg" id="description" name="description" placeholder="Job Description"></textarea>                  
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control  input-lg" id="minimumsalary" min="1000" autocomplete="off" name="minimumsalary" placeholder="Minimum Salary" required="">
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control  input-lg" id="maximumsalary" name="maximumsalary" placeholder="Maximum Salary" required="">
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control  input-lg" id="experience" autocomplete="off" name="experience" placeholder="Experience (in Years) Required" required="">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control  input-lg" id="qualification" name="qualification" placeholder="Qualification Required" required="">
                  </div>                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-success">Create</button>
                  </div>
                  <?php
                  if(isset($_SESSION['registerError'])) {
                  ?>
                  <div>
                    <p class="text-center">Email Already Exists! Choose A Different Email</p>
                  </div>
                  <?php
                  unset($_SESSION['registerError']); }
                  ?>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>