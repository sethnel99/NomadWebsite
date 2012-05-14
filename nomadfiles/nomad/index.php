<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nomad</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!--Meta tags for facebook share -->
    <meta property="og:title" content="Nomad" />
    <meta property="og:description" content="Upping the Convenience of Food Trucks." />
    <meta property="og:image" content="http://174.129.199.73/logo.png" />

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/nomad-styles.css">
    
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
	    $twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
	    echo '<li class="active" id="twitter-login"><a href="' . $twitterObj->getAuthorizationUrl() . '"><img src="images/sign-in-with-twitter-d.png"></a></li>';
	  ?>
	</ul>
      </div>
    </div>
  </div>
  
  <div id="logo-div"><a href="index.php"><img id="big-logo" src="images/title_logo.png"/></a></div>
  
  
  <div class="row-fluid" id="main-div">
  

     
     
    <div class="row-fluid">
      <h1 class="headline">Run a mobile business?</h1>
      <div style="margin-left:750px;"><h4>We can help.</h4></div>
    </div>
    
    <div class="row-fluid info-box box1 color-teal">
      <h1 style="margin-bottom:10px;">Who we are</h1>
      <div class="slide-paragraph">
	A group of seven dedicated engineers, deep thinkers, and enthusiasts
	dedicated to maximizing the effectiveness with which you run your mobile or small business... Nomad-der what!
	<br>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	<img class="stick-person" src="images/person.png"/>
	
      </div>
    </div>
    
    <div class="row-fluid info-box box2 color-green">
      <h1 style="margin-bottom:10px;">Who we work with</h1>
      <div class="slide-paragraph">
	
	<div class="float-left" style="width: 75%;">
	  Whether you're just starting a business out of your parents' garage, or you run a fleet of fritter food trucks,
	  we want to work with you!
	  
	  <br><br>
	  The Nomad platform can help:
	  <br><br>
	  
	  <ul style="margin-left: 60px;">
	    <li>Food truck operators</li>
	    <li>Festival and farmer's market vendors</li>
	    <li>Tow trucks and locksmiths</li>
	    <li>Plumbers and home repair specialists</li>
	    <li>Home cleaning services</li>
	    <li>Notaries</li>
	    <li><b>And so much more...</b></li>
	  </ul>
	
	</div>
	
	<div class="pull-right">
	  <img src="images/truck_icon.png">
	</div>
	
      </div>
    </div>
    
    <div class="row-fluid info-box box3 color-purple">
      <h1 style="margin-bottom:10px;">How we can help</h1>
      <div class="slide-paragraph">
	<div class="float-left" style="width: 75%;">
	  Nomad lets you communicate with your customers, advertise deals, manage logistics, and take payments all in one place.
	  
	  <br><br>
	  <h3>Commuication</h3>

	  <ul style="margin-left: 60px;">
	    <li>Send tweets, maintain a profile, and update statuses from one platform</li>
	    <li>Advertise available items/services, accurate location, and wait time</li>
	    <li>Send push notifications to subscribed users</li>
	  </ul>
	
	  <br>
	  <h3>Analytics</h3>
	  
	  <ul style="margin-left: 60px;">
	    <li>Automatically generate a daily report summarizing your sales</li>
	    <li>See where, when, and what your peak sales happened</li>
	    <li>Track your stock and minimize waste with our sales predictor</li>
	  </ul>
	  
	  <br>
	  <h3>Payments</h3>
	  
	  <ul style="margin-left: 60px;">
	    <li>Bring in more customers by offering fast and easy credit card payments</li>
	    <li>Eliminate the hassle of clunky, old cash registers!</li>
	  </ul>
	</div>
	
	<div class="pull-right">
	  <img src="images/compass_icon.png">
	</div>
	
      </div>
    </div>
  </div>
    
    
    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
  </body>
</html>
