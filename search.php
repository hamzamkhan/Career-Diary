<?php
session_start();
 // if(isset($_SESSION['id_user'])) {
 //      header("Location: search.php");
 //      exit();
 //    }
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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="hover-styling.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.15/features/searchHighlight/dataTables.searchHighlight.css">


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
        table td, table tr, table th{
          background: transparent !important;
        }
        table tbody{
          color:white !important;
          font-size:18px;
        }
        .dataTables_filter{
          color:white;
        }
      </style>
</head>
<body style="color:white;background: url(backgrounds/IMG_20180419_172333.jpg); background-size: cover; background-position: center;background-attachment: fixed;">

    <!-- NAVIGATION BAR -->
  <header>
    <nav class="navbar navbar-default w3-top" style="color:white; background: rgba(13, 196, 181,0.8); font-family: Lato;border-color: rgba(255,255,255,0);">
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
          <ul class="nav navbar-nav navbar-right" style="color:white;">
          <?php
          if(isset($_SESSION['id_user'])&& empty($_SESSION['companyLogged'])) {
            ?>
            <li class="link-1"><a href="user/dashboard.php">Dashboard</a></li>
            <li class="link-1"><a href="logout.php">Logout</a></li>
          <?php
            } else if(isset($_SESSION['id_user'])&& isset($_SESSION['companyLogged'])) {
            ?>
            <li class="link-1"><a href=" company/dashboard.php"">Dashboard</a></li>
            <li class="link-1"><a href="logout.php">Logout</a></li>
      <?php } else { 
          ?>
            <li class="link-1"><a href="company.php">Company</a></li>
            <li class="link-1"><a href="register-candidates.php">User Register</a></li>
            <li class="link-1"><a href="login.php">User Login</a></li>
          <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-mid-12" >
          <div class="jumbotron text-center" style="color:white; background: rgba(255,255,255,0);">
            <h1>Search Job</h1>
            <p>Find Your Career</p>
          </div>  
        </div>
      </div> 
    </div>
  </section>

  <!-- LATEST JOB POSTS -->
  <section>
    <div class="container" style="color:white;">
    <div class="row" style="color:white;">
      <div class="col-mid-12">
        <form id="myForm" class="form-inline">
          <div class="form-group">
            <label>Experience</label>
            <select id="experience" class="form-control">
              <option value="" selected="">Select Experience (Years)</option>
              <?php
                $sql = "SELECT DISTINCT(experience) FROM job_post WHERE experience IS NOT NULL ORDER BY experience";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                  while($row = $result->fetch_assoc()) {
                    echo "<option value'".$row['experience']."'>".$row['experience']."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group"  style="color:white;">
            <label>Qualification</label>
            <select id="qualification" class="form-control">
              <option value="" selected="">Select Qualification</option>
              <?php
                $sql = "SELECT DISTINCT(qualification) FROM job_post WHERE qualification IS NOT NULL";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                  while($row = $result->fetch_assoc()) {
                    echo "<option value'".$row['qualification']."'>".$row['qualification']."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <button class="btn btn-success" style="background: rgba(13, 196, 181,0.8);">Search</button>
          <?php
          if(isset($_SESSION['id_user'])&& empty($_SESSION['companyLogged'])) {
            ?>
            <a href="user/resume.php" style="background: rgba(13, 196, 181,0.8);" class="btn btn-success">Search By Resume</a>
          <?php
            }
            ?>
          
          
      <div class="row" style="margin-top: 5%;color:white ; background:rgba(255,255,255,0); font-size: 18px;">
        <div class="table-responsive">
          <table id="myTable" class="table">
            <thead>
                <th>Job Name</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience</th>
                <th>Qualification</th>
                <th>Action</th>
              </thead>
              <tbody>

              </tbody>
          </table>
        </div>
      </div>
    </div>  
    </div>
  </section>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins ( below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script src="//bartaz.github.io/sandbox.js/jquery.highlight.js"></script>


  <script src="//cdn.datatables.net/plug-ins/1.10.15/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

  <script type="text/javascript">
    $(function() {
      var oTable = $('#myTable').DataTable({
        "autoWidth": false,
        "ajax" : {
          "url" : "refresh_job_search.php",
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