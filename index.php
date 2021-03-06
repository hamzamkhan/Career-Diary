  <?php
  session_start();
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
      <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700" rel="stylesheet"> 
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" int
      egrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- <style type="text/css">
        .navbar-default{
          
          background: purple;
          text-decoration-color: white;

        }
      </style> -->
      <style type="text/css">
        .navbar-brand a{
          color: white;
        }
        .nav.navbar-nav.navbar-right li a{
          color:white;
        }
        #image {
          float: left;
          border-radius : 50%;
        }
        .hideme
        {
            opacity:0;
        }
      </style>

  </head>
  <body >

      <!-- NAVIGATION BAR -->
  <section class="parallax-five">
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
            if(isset($_SESSION['id_user'])&& empty($_SESSION['companyLogged'])) {
              ?>
              <li class="link-1"><a href="user/dashboard.php">Dashboard</a></li>
              <li class="link-1"><a href="logout.php">Logout</a></li>
            <?php
              } else if(isset($_SESSION['id_user'])&& isset($_SESSION['companyLogged'])) {
              ?>
              <li class="link-1"><a href=" company/view-job-post.php"">Dashboard</a></li>
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
          <div class="col-mid-12">
            <div class="jumbotron text-center" style="background-color: rgba(255,255,255,0);color:white; font-family: Raleway; font-weight: 900;">
              <img src="backgrounds/Career_Diary_Logo Copy.png" style="width: 520px;height: 200px;">
              <p>Find Your Career</p>
              <!-- <p><a class="btn btn-primary btn-lg" href="register.php" role="button">Register</a></p> -->
              <?php
              if(isset($_SESSION['id_user'])&& empty($_SESSION['companyLogged'])||empty($_SESSION['id_user'])&& empty($_SESSION['companyLogged'])){
              ?>
              <p><a class="btn btn-primary btn-lg" style="background: rgba(13,196,181,0.8); color:rgb(234, 234, 225)" href="search.php" role="button">Search Job</a></p>
              <?php } ?> 
            </div>  
          </div>
        </div> 
      </div>
    </section>

    <!-- LATEST JOB POSTS -->
    <section>
      <div class="container" style="color: white;">
        <div class="row">
          <h2 class="text-center" style="font-weight: bold;margin-bottom: 30px;">Latest Job Posts</h2>
          <?php
          $sql = "SELECT * FROM job_post ORDER BY Rand() Limit 4";
          $result = $conn->query($sql);
          if($result->num_rows>0){
            while($row = $result->fetch_assoc())
            {
              $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows>0){
                while($row1 = $result1->fetch_assoc())
                {
             ?>
            <div class="attachment-block clearfix" style="margin-top: 10px;">
              
              <div class="attachment-pushed">
                <h3 class="attachment-heading"><a  style="color: white;" href="apply-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a></h3>
                <div class="attachment-text">
                  <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?></strong></div>
                </div>
              </div>
            </div>
            <hr style=" border: 0; height: 1px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));">
          <?php
              }
            }
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- COMPANIES LIST -->
    <!-- <section>
      <div class="container">
        <div class="row">
          <h2 class="text-center" style="color:white;">Companies List</h2>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>

        </div>
      </div>
    </section>

 -->
  </section>
  <section>
    <div class="container-fluid parallax-six">
      
      <div class="container">
        <h2 style="color:white;">About Us</h2>
        <hr style=" border: 0; height: 1px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));">
        <div class="container-fluid">
          <img id="image" src="backgrounds/12640298_1063676980350283_7668807776803456012_o.jpg" style="width:170px;height:170px;margin-right:15px;">
          <h2 class="hideme" style="font-family: Oxygen, sans-serif;color:white;font-weight: bold;">Fizza Abid</h2><div class="hideme" style="color: white;">Fizza Abid is an undergraduate student of FAST-NUCES, currently enrolled in 6th Semester of Bachelor in Computer Science.</div>
        </div>
        <div class="container-fluid" style="margin-top: 20px;">
          <img id="image" src="backgrounds/1523896616140.jpg" style="width:170px;height:170px;margin-right:15px;">
          <h2 class="hideme" style="font-family: Oxygen, sans-serif;color:white;font-weight: bold;">Anum Mirza</h2><div class="hideme" style="color: white;">Anum Mirza is an undergraduate student of FAST-NUCES, currently enrolled in 6th Semester of Bachelor in Computer Science.</div>
        </div>
        <div class="container-fluid" style="margin-top: 20px;">
          <img id="image" src="backgrounds/15042170_2304073276398897_6453203710358034963_o.jpg" style="width:170px;height:170px;margin-right:15px;">
          <h2 class="hideme" style="font-family: Oxygen, sans-serif;color:white;font-weight: bold;">Hamza Mustafa Khan</h2><div class="hideme" style="color: white;">Hamza Mustafa Khan is an undergraduate student of FAST-NUCES, currently enrolled in 6th Semester of Bachelor in Computer Science.</div>
        </div>
      </div>
    </div>
  </section>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

     <script type="text/javascript">
      $(function(){
        var maxHeight =0;
        $(".fixHeight").each(function(){
        maxHeight=($(this).height() > maxHeight ? $(this.height()) : maxHeight);
        });
      
      $(".fixHeight").height(maxHeight);
      });
     </script>

     <script type="text/javascript">
       $(document).ready(function() {
          $(window).scroll( function(){
              $('.hideme').each( function(i){
                  var bottom_of_object = $(this).position().top + $(this).outerHeight();
                  var bottom_of_window = $(window).scrollTop() + $(window).height();
                  if( bottom_of_window > bottom_of_object ){
                      $(this).animate({'opacity':'1'},4500);
                  }
              }); 
          });
      });
     </script>
    </body>
  </html>