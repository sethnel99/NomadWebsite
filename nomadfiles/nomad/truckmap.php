<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/nomad-styles.css">
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQCVlC23PlWcyrqtJcNNADz8BAVwVuxB4&sensor=true">
    </script>
    
    
    <script type="text/javascript">
      function initialize() {
        var lat = 41.881576;
        if(getQuerystring('lat') != 0){
          lat = getQuerystring('lat');
        }
        
        var lng = -87.633133;
        if(getQuerystring('lng') != 0){
          lng = getQuerystring('lng');
        }
        
        var myCoord = new google.maps.LatLng(lat, lng);
        
        var mapOptions = {
          center: myCoord,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
        
        var markerOptions = {
          position: myCoord,
          map: map
        }
        new google.maps.Marker(markerOptions);
      }
    </script>
    
  </head>
  
  
  <body onload="initialize()">
    
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
      
      
      <div>
        <h1>
          
        </h1>
      </div>
      

    <div id="map_canvas"></div>

    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
    <script type="text/javascript" src="javascript/about.js"></script>
  </body>
</html>