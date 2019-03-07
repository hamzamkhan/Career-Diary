 <?php
  session_start();
  if(empty($_SESSION['id_user'])) {
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
    <link rel="stylesheet" type="text/css" href="../hover-styling.css">
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
<body style="background: url(../backgrounds/IMG_20180504_183731.jpg);background-attachment: fixed; background-position: center;background-size: 1600px;">

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
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="../index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse- 1">
          <ul class="nav navbar-nav navbar-right" style="color:white;">
            <li class="link-1"><a href="dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="user-profile-template.php">Profile</a></li>
            <li class="link-1"><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <section class="content-header">
    <div class="container">
      <div class="row latest-job" style="margin-top: 50px;margin-bottom: 20px;background-color: rgba(255,255,255,0); margin-top: 10%;border-color: rgba(255,255,255,0); color:white;">
        <h1 class="text-center" style="margin-bottom: 20px;">Profile</h1>
          <form method="post" action = "updateprofile.php" enctype="multipart/form-data">
            <div class="col-md-6 latest-job">
            <?php

            $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
              while($row = $result->fetch_assoc()) {
            ?>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name" value = "<?php echo $row['firstname']; ?>" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="lname" name="lname" value = "<?php echo $row['lastname']; ?>" placeholder="Last Name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control input-lg" id="email" value = "<?php echo $row['email']; ?>" placeholder="Email"  readonly>
              </div>
              <div class="form-group">
                <textarea id="address" name="address" class="form-control" rows="5" placeholder="Address"><?php echo $row['address']; ?></textarea>
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="city" name="city" value = "<?php echo $row['city']; ?>" placeholder="City">
              </div>
              <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" value = "<?php echo $row['state']; ?>" placeholder="State">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="contactno" name="contactno" placeholder="Contact Number" value = "<?php echo $row['contactno']; ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="qualification" name="qualification" placeholder="Qualification" value = "<?php echo $row['qualification']; ?>" required="">
              </div>
              <div>
                <button type="submit" class="btn btn-success" style="background: rgba(13, 196, 181,0.8);">Update</button>
              </div>
              <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="form-group">
                <label style="color:white;"><?php echo $_SESSION['uploadError']; ?></label>
              </div>
              <?php unset($_SESSION['uploadError']); } ?>
            </div>
            <div class="col-md-6 latest-job">
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="stream" name="stream" placeholder="Stream" value = "<?php echo $row['stream']; ?>">
              </div>
              <div class="form-group">
                <input type="date" class="form-control input-lg" id="passingyear" name="passingyear" placeholder="Passing Year" required="" value = "<?php echo $row['passingyear']; ?>">
              </div>
              <div class="form-group">
                <input type="date" class="form-control input-lg" id="dob" name="dob" placeholder="Date Of Birth" min="1960-01-01" max="2018-04-30" required="" value = "<?php echo $row['dob']; ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="age" name="age" placeholder="Age" required="" value = "<?php echo $row['age']; ?>" readonly> 
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="designation" name="designation" placeholder="Designation">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="fblink" name="fblink" placeholder="Facebook Profle" value = "<?php echo $row['fblink']; ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control input-lg" id="llink" name="llink" placeholder="LinkedIn Profile" value = "<?php echo $row['llink']; ?>">
              </div>
              <div class="form-group">
                <input type="file" name="image" class="btn btn-flat btn-default" required> 
                <label>Select Profile Picture</label>
              </div>
            <?php
                }
              }
            ?>
          </form>
        </div>
      </div>
      
    </div>
  </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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