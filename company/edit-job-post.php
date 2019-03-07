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


    <link rel="icon" type="image/png" href="../backgrounds/Career_Diary_Cropped.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="../hover-styling.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'#description'});</script>

    <!-- Bootstrap -->
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
      .nav.nav-pills.nav-stacked li a:hover{
        background-color:rgba(13, 196, 181,0.8);
      }
    </style>
</head>
<body class="background-image" style="background: url(../backgrounds/IMG_20180418_003229.jpg); background-size:2200px; background-position: center; background-attachment: fixed;">

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
          <a class="navbar-brand link-1" style="color: white; font-family: Raleway; font-weight: 700;" href="../index.php">Career Diary</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

    <div class="content-wrapper" style="margin-left: 0px;color:white;">

          <section id="candidates" class="content-header">
            <div class="container">
              <div class="row">
                <div class="col-md-3">
                  <div class="box box-solid">
                    <div class="box-body no-padding">
                      <ul class="nav nav-pills nav-stacked">                        
                        <li class="active"><a style="background-color: rgba(13, 196, 181,0.8);" href="view-job-post.php">Job Post</a></li>
                        <li><a style="color:white;" href="create-job-post.php">Create Job Post</a></li>
                        <li><a style="color:white;" href="../logout.php">Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 bg-white padding-2" style="margin-left: 160px;text-align:  center;">
                  <form method="post" action = "editpost.php">
                  <?php
                    $sql="SELECT * FROM job_post WHERE id_jobpost ='$_GET[id]' AND id_company='$_SESSION[id_user]'"; 
                      $result=$conn->query($sql);
                      if($result->num_rows>0){
                        while($row=$result->fetch_assoc())
                        {
                  ?>
                    <div class="form-group">
                      <label for="jobtitle">Job Title</label>
                      <input type="text" class="form-control" id="jobtitle" name="jobtitle" value="<?php echo $row['jobtitle']; ?>" placeholder="Job Title" required="">
                    </div>
                    <div class="form-group">
                      <label for="description">Job Description</label>
                      <textarea class="form-control" id="description" name="description" placeholder="Job Description" required=""><?php echo stripcslashes($row['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="minimumsalary">Minimum Salary</label>
                      <input type="text" class="form-control" id="minimumsalary" value="<?php echo $row['minimumsalary']; ?>"  name="minimumsalary" placeholder="Minimum Salary" required="">
                    </div>
                    <div class="form-group">
                      <label for="maximumsalary">Maximum Salary</label>
                      <input type="text" class="form-control" id="maximumsalary" value="<?php echo $row['maximumsalary']; ?>" name="maximumsalary" placeholder="Maximum Salary" required="">
                    </div>
                    <div class="form-group">
                      <label for="experience">Experience Required</label>
                      <input type="text" class="form-control" id="experience" value="<?php echo $row['experience']; ?>" name="experience" placeholder="Experience" required="">
                    </div>
                    <div class="form-group">
                      <label for="qualification">Qualification Required</label>
                      <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $row['qualification']; ?>" placeholder="Qualfication" required="">
                    </div>
                    <input type="hidden" name="target_id" value="<?php echo $_GET['id']; ?>">
                    <div class="text-center">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                    <?php
                      }
                    } else {
                      header("Location: dashboard.php");
                      exit();
                    }
                    ?>
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
  </body>
</html>