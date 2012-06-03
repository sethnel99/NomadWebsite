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
  

     
     
    <div class="row-fluid">
      <h1 class="headline">Run a mobile business?</h1>
      <div style="margin-left:850px;"><h4>We can help.</h4></div>
    </div>
    
    <div class="row-fluid info-box box1 color-teal">
      <h1 style="margin-bottom:10px;">Who we are</h1>
      <div class="slide-paragraph">
	A group of seven engineers, deep thinkers, and enthusiasts
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
	<div class="float-left" style="width: 75%; line-height:11px;">
   <dl>
   <dt><h3>Easier Tweeting</h3></dt>
   <dd>Communicating with customers is important. It's how customers discover and locate mobile entrepreneurs like you. Our app makes communication easier by providing quick pre-formatted, customizable messages and the ability to quickly let customers know that you've arrived or are leaving. No fussing, just quick communication so you can keep your customers in the know.</dd>
   
  <br><dt><h3>GPS Location in Each Message</h3></dt>
  <dd>In an odd location? Trying to figure out how to tell your customers where you are. Don't stress, Nomad automatically embeds a link in each tweet that shows your exact location on a map. No more fumbling to find the nearest interesection or wasting valuable time on elaborate directions.</dd>
   
   <br><dt><h3>Inventory Management Made Easy</h3></dt>
   <dd>Do you know your best locations, your top sellers and what drives your sales? It is hard to keep track of, but inventory management and data are the lifeblood of your business. With Nomad's inventory tool, you can quickly keep track of your sales by location, date and time. Nomad can then use that data to show you how your business is doing with quick reference to revenue, top sellers and more.</dd>
   </dl>
	  <!--Nomad lets you communicate with your customers, advertise deals, manage logistics, and take payments all in one place.
	  
	  <br><br>
	  <h3>Communication</h3>

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
	  </ul>-->
	</div>
	
	<div class="pull-right">
	  <img src="images/compass_icon.png">
	</div>
	
      </div>
    </div>
  </div>
    
    
    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
  </body>
</html>
