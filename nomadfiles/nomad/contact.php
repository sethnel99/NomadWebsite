<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nomad</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/nomad-styles.css">
  	 <script type="text/javascript" src="javascript/analytics.js"></script> 
  </head>

  <body>
  
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            
            <ul class="nav" id="twitter-sign-in" style="float:right;">
	  <?php
	    include 'OAuth/EpiCurl.php';
	    include 'OAuth/EpiOAuth.php';
	    include 'OAuth/EpiTwitter.php';
	    include 'OAuth/secret.php';
		
		session_start();
		
		if(isset($_SESSION['screen_name'])){
						echo '<li class="active"><a href="home.php">' . $_SESSION['screen_name'] . ' Home <img src="' . $_SESSION['profile_image_url'] . '" width="25px" height="25px"></a></li>';
						echo '<li class="dropdown"><a href="home.php" class="dropdown-toggle" data-toggle="dropdown">';
						echo '<img src="images/downarrow.png" width="15px" height="20px">';
						echo '<b class="dropdown-menu"></b></a><ul class="dropdown-menu"><li><div id="log-out">Log out</div></li></ul>';
		}
		
		else{
	    $twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
	    echo '<li class="active" id="twitter-login"><a href="' . $twitterObj->getAuthorizationUrl() . '"><img src="images/sign-in-with-twitter-d.png"></a></li>';
		}
	  ?>
            </ul>
          </div>
        </div>
      </div>
      
      <!--<div id="logo-div"><a href="index.php"><img id="big-logo" src="images/title_logo.png"/></a></div>-->
    
    <div class="row-fluid" id="main-div" style="text-align: center;">
      <h1 class="section-title">Contact Us</h1>
      nuwebm1@gmail.com
 
    </div>
    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
  </body>
</html>
