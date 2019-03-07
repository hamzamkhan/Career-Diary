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

    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="../backgrounds/Career_Diary_Cropped.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:700,900" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="../hover-styling.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    


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
      .dataTables_filter, .dataTables_info { display: none; }
      table td, table tr, table th{
          background: transparent !important;
        }
        table tbody{
          color:white !important;
          font-size:18px;
        }
    </style>
</head>
<body class="background-image" style="background: url(../backgrounds/IMG_20180419_172429.jpg); background-size:2200px; background-position: center; background-attachment: fixed;">

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
            <li class="link-1"><a href="dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="user-profile-template.php">Profile</a></li>
            <li class="link-1"><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <div class="container">
    <div class="row">
      <h2 class="text-center" style="color:white;margin-top: 20px;">Resume</h2>
      <hr style=" border: 0; height: 1px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));">
      <div class="container-fluid" style="text-align:center;display: inline-block;margin-top: 50px;width: 100%">
        <div class="col-lg-4" style="">
          <a href="resume-upload.php" class="btn btn-lg" style="background: rgba(13, 196, 181,0.8); color: white;">Upload Resume</a>
        </div>
        <form method="post" action="add-interest.php" enctype="multipart/form-data">
          <div class="col-lg-4" style="">
            <input class="input-lg" id="interest" name="interest" type="text" placeholder="Interest" required="">
            <button class="btn btn-lg btn-success">Submit</button>
          </div>
        </form>
        
        <div class="col-lg-4" style="">
          <a href="generate-resume.php" class="btn btn-lg" style="background: rgba(13, 196, 181,0.8);color:white">Generate Resume</a>
        </div>
      </div>
      
      <?php
      $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]' AND resume IS NOT NULL";
      $result = $conn->query($sql);
      if($result->num_rows>0) {
        $row = $result->fetch_assoc();
        ?>
      <div class="col-lg-4" style="text-align:center;margin-top: 80px;width: 100%;">
        <a href="../uploads/resume/<?php echo $row['resume']; ?>" class="btn btn-lg btn-success" download="MyUploadedResume">Download Resume</a>
      </div>  

      <?php }  ?>
      
    </div>
    <div class="row" style="margin-top: 5%;color:white ; background:rgba(255,255,255,0); font-size: 18px;">
        <div class="table-responsive">
          <table id="resumeTable" class="table">
            <?php
            $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]' AND resume IS NOT NULL AND interest IS NOT NULL";
            $result = $conn->query($sql);
            if($result->num_rows>0) {
              $row = $result->fetch_assoc();
              ?>
                <thead>
                <th>Job Name</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience</th>

                <th>Action</th>
              </thead>
              <tbody>

              </tbody>

            <?php }  else{
            ?>
              <h3 class="text-center">Please upload your resume first, then refresh the page.</h3>
            <?php } ?>
          </table>
        </div>
      </div>
  </div>

  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins ( below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script src="//bartaz.github.io/sandbox.js/jquery.highlight.js"></script>


  <script src="//cdn.datatables.net/plug-ins/1.10.15/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

  <script type="text/javascript">
    $(function() {
      var oTable = $('#resumeTable').DataTable({
        "autoWidth": false,
        "ajax" : {
          "url" : "search_by_resume.php",
          "dataSrc" : "",
        "data" : function (d) {
            d.experience = $("#experience").val();
            d.qualification = $("#qualification").val();
          }
        }
      });


      oTable.on('draw',function(){ // draw means update result on every key pressed and highlight
        var body = $(oTable.table().body());

        body.unhighlight();

        body.highlight(oTable.search());

      });

      $("#myForm").on("submit", function(e) {
        e.preventDefault();
        oTable.ajax.reload( null, false);
      })
    });
  </script>
  </body>
</html>