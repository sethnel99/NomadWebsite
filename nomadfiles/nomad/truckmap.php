<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/nomad-styles.css">
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js">
    </script>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQCVlC23PlWcyrqtJcNNADz8BAVwVuxB4&sensor=true">
    </script>
    <script type="text/javascript">
	
      function initialize() {
			var myIcon = new google.maps.MarkerImage('images/truck_marker.png', new google.maps.Size(100,143), new google.maps.Point(0,0), new google.maps.Point(25, 71.5), new google.maps.Size(50,71.5));
			var greenIcon = new google.maps.MarkerImage('images/truck_marker_green.png', new google.maps.Size(231,329), new google.maps.Point(0,0), new google.maps.Point(25, 71.5), new google.maps.Size(50,71.5));
			var myCoord;
		
			//if the query string is set
        	if((getQuerystring('lat') != 0) && (getQuerystring('lng') != 0)){
				lat = getQuerystring('lat');
				lng = getQuerystring('lng');
				myCoord = new google.maps.LatLng(lat,lng);
			 
			 	var mapOptions = {
       			center: myCoord,
        		 	zoom: 14,
         		mapTypeId: google.maps.MapTypeId.ROADMAP
    			};
        
				var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
		
				new google.maps.Marker({
					position: myCoord,
					map: map,
					icon: greenIcon
				});
			
		  //if no query string
        } else {
				myCoord = new google.maps.LatLng(41.881576,-87.633134);
			  	var mapOptions = {
					center: myCoord,
					zoom: 14,
					mapTypeId: google.maps.MapTypeId.ROADMAP
    			};
        
				var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
		}

		$.getJSON("trucklocations.php", function(data){
			$.each(data, function(key, val){
				myCoord = new google.maps.LatLng(parseFloat(val['lat']),parseFloat(val['lng']));
						
				new google.maps.Marker({
					position: myCoord,
					map: map,
					icon: myIcon,
					title: val['name']
				});
			});
		});
		
      }
		
    </script>
    <script type="text/javascript" src="javascript/analytics.js"></script>
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
<div>
       <h1> </h1>
    </div>
<div id="map-canvas"></div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
<script type="text/javascript" src="javascript/nomad-script.js"></script> 
<script type="text/javascript" src="javascript/about.js"></script>
</body>
</html>