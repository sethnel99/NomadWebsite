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

      
      <div class="row-fluid" id="main-div">
            <h1 class="section-title">Meet the Team</h1>
            
            <div class="row-fluid">
                <div class="my-bio">
                  <h2>Rahim Daya</h2>
                  A graduate of the University of Waterloo and former Groupon developer, Rahim saves people money by day, solves crime by night.  
                </div>
                <div class="my-bio"><img class="team-pic" src="images/rahim.png"/></div>
                <div class="my-bio">
                  <h2>Josh Eddy</h2>
                  A Northwestern Kellogg MBA with a BS in Computer Science from the University of Virginia, Josh has been
                  programming since the 1900's. Now, he mostly spends his time producing lipdubs and playing drums.
                </div>
                <div class="my-bio"><img class="team-pic" src="images/josh.png"/></div>
            </div>
            
            <div class="row-fluid">
                <div class="my-bio">
                  <h2>Ross Epstein</h2>
                  When he's not competitively eating or playing rugby, Ross is building the latest iPhone features for Nomad. 
                </div>
                <div class="my-bio"><img class="team-pic" src="images/ross.png"/></div>
                <div class="my-bio">
                  <h2>Seth Nelson</h2>
                  He wires racecars and builds Android apps in his sleep.
                  Sometimes we wonder if Seth is hiding little green antennae under those beautiful locks.
                </div>
                <div class="my-bio"><img class="team-pic" src="images/seth.png"/></div>
            </div>
            
            <div class="row-fluid">
                <div class="my-bio">
                  <h2>Pauli Ponis</h2>
                  A nuclear reactor designer and alleged mob boss, Pauli spends his free time bending
                  the Adobe suites to his will.
                </div>
                <div class="my-bio"><img class="team-pic" src="images/pauli.png"/></div>
                <div class="my-bio">
                  <h2>Felipe Saavedra</h2>
                  Hailing from Santiago, Chile, Felipe speaks softly and carries a big stick.
                  He's also an actuarial wizard and father to a newborn girl.
                </div>
                
                <div class="my-bio"><img class="team-pic" src="images/felipe.png"/></div>
            </div>
            
            <div class="row-fluid">
                <div class="my-bio">
                  <h2>Taiyo Sogawa</h2>
                  Sustaining off a mixture of free samples and good vibes, Taiyo is usually either
                  working on building the Nomad website or researching network vulnerabilities.
                </div>
                <div class="my-bio"><img class="team-pic" src="images/taiyo.png"/></div>
                <div class="my-bio">
                  <h2>Todd Warren</h2>
                  Our beloved mentor and dashing glasses model, Todd Warren is a seasoned Microsoft
                  veteran who now splits his time as an investor in Divergent Ventures and as a trustee at Asheshi University in Accra, Ghana.
                </div>
                <div class="my-bio"><img class="team-pic" src="images/todd.png"/></div>
            </div>
            
      </div>

    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
    <script type="text/javascript" src="javascript/about.js"></script>
  </body>
</html>
