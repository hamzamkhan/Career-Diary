 <?php
  session_start();
  if(isset($_SESSION['id_user']) && empty($_SESSION['companyLogged'])) {
      header("Location: user/dashboard.php");
      exit();
    } else if(isset($_SESSION['id_user']) && isset($_SESSION['companyLogged'])) {
      header("Location: company/dashboard.php");
      exit();
    }
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

    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="backgrounds/Career_Diary_Cropped.png">
    <link rel="stylesheet" type="text/css" href="hover-styling.css">
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
      .latest-job {
       line-height: 150%;
      }

      .latest-job > h1 {
       font-size: 60px;
      }

    </style>
  
</head>
<body style="background: url(backgrounds/IMG_20180419_172048.jpg);background-size: 1550px;background-attachment: fixed;">

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default navbar-fixed-top" style="color:white; background: rgba(13, 196, 181,0.8); font-family: Lato;border-color: rgba(255,255,255,0);">
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse- 1">
          <ul class="nav navbar-nav navbar-right" style="color:white;">
            <li class="link-1"><a href="login.php">User Login</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <section class="content-header">
    <div class="container">
      <div class="row latest-job" style="margin-top: 50px;margin-bottom: 20px;background-color: rgba(255,255,255,0); margin-top: 10%;border-color: rgba(255,255,255,0); color:white; ">
        <h1 class="text-center" style="margin-bottom: 20px;">Sign Up</h1>
          <form method="post" action = "adduser.php" enctype="multipart/form-data">
            <div class="col-md-6 latest-job">
              <div class="form-group">
                <input class="form-control input-lg" id="fname" name="fname" type="text" placeholder="First Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="lname" name="lname" type="text" placeholder="Last Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="email" name="email" type="text" placeholder="Email *" required>
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" id="aboutme" name="aboutme" type="text" rows="4" placeholder="About Yourself *" required></textarea>
              </div>
              <div class="form-group">
                <label>Date of birth</label>
                <input class="form-control input-lg" id="dob" min="1960-01-01" max="2018-04-30" name="dob" type="date" placeholder="Date Of Birth">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="age" name="age" type="text" placeholder="Age" readonly>
              </div>
              <div class="form-group">
                <label>Year Of Graduation</label>
                <input class="form-control input-lg" id="passingyear" name="passingyear" type="date" placeholder="Passing Year">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="qualification" name="qualification" type="text" placeholder="Highest Qualification">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="stream" name="stream" type="text" placeholder="Stream">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="fblink" name="fblink" type="text" placeholder="Facebook Profile">
              </div>
              
            
              <div class="form-group checkbox">
                <label><input type="checkbox">I accept the terms & conditions</label>
              </div>
              <div class="form-group">
                <button class="btn btn-flat btn-success">Register</button>
              </div>
              <?php
              if(isset($_SESSION['registerError'])) {
                ?>
                <div class="form-group">
                  <label style="color:red;">Email Already Exists! Choose A Different Email</label>
                </div>
              <?php
              unset($_SESSION['registerError']); }
              ?>

              <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="form-group">
                <label style="color:red;"><?php echo $_SESSION['uploadError']; ?></label>
              </div>
              <?php unset($_SESSION['uploadError']); } ?>
              
              
             </div> 
             <div class="col-md-6 latest-job">
              <div class="form-group">
                <input class="form-control input-lg" id="password" name="password" autocomplete="off" type="password" placeholder="Password *" required>
              </div>
              <!-- <div class="form-group">
                <input class="form-control input-lg" id="cpassword" name="cpassword" type="text" placeholder="Confirm Password *" required>
              </div> -->
              <div class="form-group">
                <input class="form-control input-lg" id="contactno" name="contactno" type="text" placeholder="Phone Number">
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" id="address" name="address" rows="4" placeholder="Address"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="city" name="city" type="text" placeholder="City">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="state" name="state" type="text" placeholder="State">
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" id="skills" name="skills" rows="4" placeholder="Enter Your Skills"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="designation" name="designation" type="text" placeholder="Designation">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="interest" name="interest" type="text" placeholder="Field Of Interest" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="llink" name="llink" type="text" placeholder="LinkedIn Profle">
              </div>
              <div class="form-group">
                <input type="file" name="resume" class="btn btn-flat btn-danger" required> 
                <label>Attach Resume</label>
              </div>
              
             </div>
          </form>
        </div>
      </div>
      
    </div>
  </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <script src="../js/adminlte.min.js"></script>

   <script type="text/javascript">
     $('#dob').on('change', function() {
      var today = new Date();
      var birthDate = new Date($(this).val());
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();


      if(m<0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }

      $('#age').val(age); 
     });
   </script>
  </body>
</html>