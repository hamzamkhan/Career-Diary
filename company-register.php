<?php
  session_start();
  if(isset($_SESSION['id_user'])) {
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
    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    
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
<body style="background: url(backgrounds/IMG_20180415_095235.jpg); background-size:1700px; background-position: center;background-attachment: fixed; ">

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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="color:white;">
          <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION['id_user'])) {
            ?>
            <li class="link-1"><a href="company/dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="logout.php">Logout</a></li>
          <?php
          } else { 
          ?>
            
            <li class="link-1"><a href="company-login.php">Login</a></li>
          <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="content-wrapper" style="margin-left: 0px;">
   <section class="content-header">
      <div class="container">
        <div class="row latest-job" style="margin-top: 50px;margin-bottom: 20px;background-color: rgba(255,255,255,0); margin-top: 10%;border-color: rgba(255,255,255,0); color:white;">
          <h1 class="text-center" style="margin-bottom : 20px;">Company Sign Up</h1>
            <form method="post" action = "addcompany.php" enctype="multipart/form-data">
              <div class="col-md-6 latest-job">
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="companyname" placeholder="Company Name" required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="website" placeholder="Website" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="companytype" name="companytype" placeholder="Company Type" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="headofficecity" name="headofficecity" placeholder="Head Office City" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control input-lg" rows="4" type="text" name="aboutme" placeholder="Brief info about your company"></textarea>
                </div>

                <div class="form-group checkbox">
                  <label><input type="checkbox" required>I accept the terms & conditions</label>
                </div>
                <div class="form-group">
                  <button class="btn btn-flat btn-success">Register</button>
                </div>
                <?php
                if(isset($_SESSION['registerError'])) {
                  ?>
                  <div>
                      <p class="text-center" style="color:red;">Email Already Exists! Choose A Different Email</p>
                  </div>
                <?php
                 unset($_SESSION['registerError']); }
                ?>
              </div>
              <div class="col-md-6 latest-job">
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="password" placeholder="Password" required>
                </div>
                <!-- <div class="form-group">
                  <input class="form-control input-lg" type="text" name="cpassword" placeholder="Confirm Password">
                </div> -->
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="contactno" name="contactno" placeholder="Contact Number" minlength="10" maxlength="10" autocomplete="off" onkeypress="return validatePhone(event);" required>
                </div>
                <div class="form-group">
                <select class="form-control input-lg" id="country" name="country" required>
                <option selected="" value="">Select Country</option>
                <?php
                  $sql="SELECT * FROM countries";
                  $result=$conn->query($sql);
                  if($result->num_rows>0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                </select>
              </div>
              <div id="stateDiv" class="form-group" style="display: none;">
                <select class="form-control input-lg" id="state" name="state" required>
                  <option value="" selected="">Select State</option>
                </select>
              </div>
              <div id="cityDiv" class="form-group" style="display: none;">
                <select class="form-control input-lg" id="city" name="city" required="">
                  <option value="" selected="">Select City</option>
                </select>
              </div>
              </div>    
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <script type="text/javascript">
     function validatePhone(event) {

      //event.keycode will return unicode for characters and numbers like a,b,c,5,etc.
      //event.which will return key for mouse events and other events like ctrl alt etc.
      var key = window.event ? event.keyCode : event.which;

      if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9 )  {
        //8 means backspace
        //46 means delete
        //37 means left arrow
        //39 means right arrow
        return true;
      } else if(key < 48 || key > 57) {
        return false;
        //48-57 is 0-9 numbers on your keyboard
      } else return true;
     }
   </script>

   <script> //appearance/disappearance of state option
     $("#country").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#state").find('option:not(:first)').remove();
      if(id!='') {
        $.post("state.php",{id: id}).done(function(data){
          $("#state").append(data);
        });
        $('#stateDiv').show();
      } else {
        $('#stateDiv').hide();
        $('#cityDiv').hide();
      }
     });
   </script>

   <script> //appearance/disappearance of city option
     $("#state").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#city").find('option:not(:first)').remove();
      if(id!='') {
        $.post("city.php",{id: id}).done(function(data){
          $("#city").append(data);
        });
        $('#cityDiv').show();
      } else {
        $('#cityDiv').hide();
      }
     });
   </script>

  </body>
</html>