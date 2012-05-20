<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nomad</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
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
            <h1 class="section-title">Consumer App</h1>
            
            <div class="row-fluid">
                <div class="value-prop"><img class="value-prop-pic" src="images/customer_page_01.png"/></div>
                <div class="value-prop">
                  <h2>Find Mobile Vendor Near You</h2>
                  Nomad lets you know when your favorite mobile venders are near by and helps you discover new mobile vendors in your area. In List View, Nomad shows you every vendor near you in order to distance. In Map View, you can easily see where each mobile vendor is located relative to you. Ditch the confusion of following multiple twitter feeds and get clear information quickly and easily.
                </div>
            </div>
            
            <div class="row-fluid">
                <div class="value-prop">
                  <h2>Better Information</h2>
				  Need more information before you walk 0.3 miles to that new mobile business near you? Nomad provides deeper information about each mobile vendor to help you make a decision before you leave. On the detail page for each mobile vendor, we show the company logo, phone number, latest tweet and provide product list (menu) and schedule so that you have all the information you need before you take your first step.
                  <img class="value-prop-pic" src="images/customer_page_03.png"/>
				</div>
                <div class="value-prop"><img class="value-prop-pic" src="images/customer_page_02.png"/></div>
            </div>                        
	  </div>

    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
    <script type="text/javascript" src="javascript/about.js"></script>
  </body>
</html>
