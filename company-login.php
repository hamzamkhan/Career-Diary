<?php
  session_start();
  if(isset($_SESSION['id_user'])) {
    header("Location: index.php");
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
    <link rel="icon" type="image/png" href="backgrounds/Career_Diary_Cropped.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="hover-styling.css">
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
<body style="background: url(backgrounds/IMG_20180415_095235.jpg); background-size:1700px; background-position: center; background-attachment: fixed; ">

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
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="index.php"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION['id_user'])) {
            ?>
            <li class="link-1"><a href="company/dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="logout.php">Logout</a></li>
          <?php
          } else { 
          ?>
            
            
            <li class="link-1"><a href="company-register.php">Register</a></li>
          <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 well" style="background-color: rgba(255,255,255,0);border-color: rgba(255,255,255,0); color: white;margin-top: 150px">
        <h1 class="text-center" style="color:white;font-weight: bold;margin-bottom: 10px;">Company Login</h1>
          <form method="post" action="checkcompanylogin.php">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input style="height: 45px;" id="email" type="text" id="email" name ="email" class="form-control input-md" name="email" placeholder="Email" required="">
            </div>
            <div class="input-group" style="margin-top: 20px">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input style="height: 45px;" id="password" type="password" id="password" name="password" class="form-control input-md" name="password" placeholder="Password" required="">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success" style="background: rgba(13, 196, 181,0.8);margin-top: 15px;">Submit</button>  
            </div>
            <?php
              if(isset($_SESSION['registerCompleted'])) {
                ?>
            <div class="successMessage">
              <p class="text-center">You Have Registered Successfully! Your Account Is Pending Approval By Admin.</p>
            </div>
            <?php
              unset($_SESSION['registerCompleted']); }
            ?>  
            <?php
              if(isset($_SESSION['loginError'])) {
                ?>
            <div>
              <p class="text-center">Invalid Email/Password! Try Again</p>
            </div>
            <?php
              unset($_SESSION['loginError']); }
            ?>
            <?php
              if(isset($_SESSION['companyLoginError'])) {
                ?>
            <div>
              <p class="text-center"><?php echo $_SESSION['companyLoginError']; ?></p>
            </div>
            <?php
              unset($_SESSION['companyLoginError']); }
            ?>
            
          </form>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
    $(function(){
      $(".successMessage:visible").fadeOut(2000); //miliseconds of time
     });
  </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>