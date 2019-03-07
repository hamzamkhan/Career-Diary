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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Career Diary</title>
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="icon" type="image/png" href="../backgrounds/Career_Diary_Cropped.png">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="../hover-styling.css">
    <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     
    <style type="text/css">
               .btn-social {
            color: white;
            opacity: 0.8;
        }

            .btn-social:hover {
                color: white;
                opacity: 1;
                text-decoration: none;
            }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
        .navbar-brand a{
            color: white;
        }
        .nav.navbar-nav.navbar-right li a{
            color:white;
        }
    </style>
</head>
<body>
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
              <li class="link-1"><a href="dashboard.php">Dashboard</a></li>
              <li class="link-1"><a href="profile.php">Update Profile</a></li>
              <li class="link-1"><a href="../search.php">Search</a></li>
              <li class="link-1"><a href="../logout.php">Logout</a></li>
            <?php
              }   
            else { 
            ?>
              <li class="link-1"><a href="../register-candidates.php">Sign Up</a></li>
              <li class="link-1"><a href="login.php">Login</a></li>
            <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
    <!-- NAVBAR CODE END -->


    <div class="container">
    	<?php
  
	    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0) 
	    {
	      while($row = $result->fetch_assoc()) 
	      {
	  	?>
        <section style="padding-bottom: 50px; padding-top: 50px;margin-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <?php
                    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]' AND image IS NOT NULL";
                    $result = $conn->query($sql);
                    if($result->num_rows>0) {
                        $row = $result->fetch_assoc();
                        ?>
                        <img  style="width:130px;height:130px;margin-right: 15px;" src="../uploads/profile pictures/<?php echo $row['image']; ?>" alt="Attachment Image">
                    <?php } else { ?>
                        <img  style="width:130px;height:130px;margin-right: 15px;" src="../backgrounds/Blank-profile.png" alt="Attachment Image">
                    <?php } ?>
                    <br>
                    <br>
                    <label>Name</label>
                    <p><?php echo $row['firstname']. ' ' . $row['lastname']; ?></p>
                    
                    
                    <label>Email</label>
                    <p><?php echo $row['email'];?></p>

                    <label>Age</label>
                    <p><?php echo $row['age'];?></p>

                    <label>Skills</label>
                    <p><?php echo $row['skills'];?></p>

                    <label>Lives in</label>
                    <p><?php echo $row['city']. ', '. $row['state'] ;?></p>
                    <br>
                    
                    <br /><br/>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <h2>Bio : </h2>
                        <h4></h4>
                        <p>
                            <?php echo $row['aboutme'];?>
                        </p>
                    </div>
                    <div>
                    <?php
                    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]' AND fblink IS NOT NULL";
                    $result = $conn->query($sql);
                    if($result->num_rows>0) {
                    	$row=$result->fetch_assoc();
                    	?>
                        <a href="<?php echo $row['fblink'] ;?>" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                        <?php } ?>
                        <!-- <a href="#" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i>&nbsp; Google</a> -->
                        <!-- <a href="#" class="btn btn-social btn-twitter">
                            <i class="fa fa-twitter"></i>&nbsp; Twitter </a> -->
                    <?php
                    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]' AND llink IS NOT NULL";
                    $result = $conn->query($sql);
                    if($result->num_rows>0) {
                    	$row=$result->fetch_assoc();
                    	?>
                        <a href="<?php echo $row['llink']; ?>" class="btn btn-social btn-linkedin">
                            <i class="fa fa-linkedin"></i>&nbsp; Linkedin </a>
                        <?php } ?>
                    </div>
                    <!-- <div class="form-group col-md-8">
                        <h3>Change YOur Password</h3>
                        <br />
                        <label>Enter Old Password</label>
                        <input type="password" class="form-control">
                        <label>Enter New Password</label>
                        <input type="password" class="form-control">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" />
                        <br>
                        <a href="#" class="btn btn-warning">Change Password</a>
                    </div> -->
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
        <?php 
	      }
	    }
	    ?> 
    </div>
    <!-- CONATINER END -->

    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
