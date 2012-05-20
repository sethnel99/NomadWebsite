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
            <h1 class="section-title">Mobile Entrepreneur App</h1>
            
            <div class="row-fluid">
                <div class="value-prop"><img class="value-prop-pic" src="images/truck_page_01.png"/></div>
                <div class="value-prop">
                  <h2>Easier Tweeting</h2>
                  Communicating with customers is important. Its how customers discover and locate mobile entrepreneurs like you. Our app makes communication easier by providing quick canned messages and the ability to quickly let customers that you've arrived or are leaving. No fussing, just quick communication so you can keep your customers in the know.
                </div>
            </div>
            
            <div class="row-fluid">
                <div class="value-prop">
                  <h2>GPS Locations In Each Message</h2>
                  In an odd location? Trying to figure out how to tell your customers where you are. Don't stress, Nomad automatically embeds a link in each tweet that shows your exact location on a map. No more fumbling to find the nearest interesection or wasting valuable time on elaborate directions.
				</div>
                <div class="value-prop"><img class="value-prop-pic" src="images/truck_page_02.png"/></div>
            </div>                        

            <div class="row-fluid">
                <div class="value-prop"><img class="value-prop-pic" src="images/truck_page_03.png"/></div>
                <div class="value-prop">
                  <h2>Maps For Your Customers</h2>
                  Why <i>tell</i> your customers where you are, when you can <i>show</i> them where you are. Nomad's embedded map links work on PCs and mobile so that your customers can quickly see your exact location, whether its on the street, in a parking lot or anywhere in between. That means no more lost customers and a bigger bottom line.
                </div>
            </div>
            
            <div class="row-fluid">
                <div class="value-prop">
                  <h2>Inventory Management Made Easy</h2>
                  Do you know your best locations, your top sellers and what drives your sales? It is hard to keep track of but inventory management and data are the lifeblood of your business. With Nomad's inventory tool, you can quickly keep track of your sales by location, date and time. Nomad can then use that data to show you how your business is doing with quick reference to revenue, top sellers and more. 
                </div>
                <div class="value-prop"><img class="value-prop-pic" src="images/truck_page_04.png"/></div>
            </div>                        
	  </div>

    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
    <script type="text/javascript" src="javascript/about.js"></script>
  </body>
</html>
