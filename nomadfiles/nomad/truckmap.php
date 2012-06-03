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
			
			$('#map-canvas').css('height',$(window).height() - 40);
			var myIcon = new google.maps.MarkerImage('images/truck_marker.png', new google.maps.Size(100,143), new google.maps.Point(0,0), new google.maps.Point(25, 71.5), new google.maps.Size(50,71.5));
			var greenIcon = new google.maps.MarkerImage('images/truck_marker_blue.png', new google.maps.Size(231,329), new google.maps.Point(0,0), new google.maps.Point(25, 71.5), new google.maps.Size(50,71.5));
			var homeIcon = new google.maps.MarkerImage('images/my_marker.png', new google.maps.Size(230,328), new google.maps.Point(0,0), new google.maps.Point(25, 71.5), new google.maps.Size(50,71.5));

			var truckCoord;
			var myLocation;
		
			//if the query string is set
        	if((getQuerystring('lat') != 0) && (getQuerystring('lng') != 0)){
				lat = getQuerystring('lat');
				lng = getQuerystring('lng');
				truckCoord = new google.maps.LatLng(lat,lng);
			 
			 	var mapOptions = {
       			center: truckCoord,
        		 	zoom: 14,
         		mapTypeId: google.maps.MapTypeId.ROADMAP
    			};
        
				var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
		
				new google.maps.Marker({
					position: truckCoord,
					map: map,
					icon: greenIcon
				});
			
		  //if no query string
        } else {
			  
			  var mapOptions = {
					center: new google.maps.LatLng(41.881,-87.633),
					zoom: 14,
					mapTypeId: google.maps.MapTypeId.ROADMAP
    			};
			  
			   var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
				
			  	navigator.geolocation.getCurrentPosition(function(position) {
					myLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
					map.setCenter(myLocation);

					new google.maps.Marker({
					position: myLocation,
					map: map,
					icon: homeIcon,
					title: 'Me!'
					});	
				 }, function() {
					alert("failure");
				 });
				
        
				
		}
		

		$.getJSON("trucklocations.php", function(data){
			$.each(data, function(key, val){
				truckCoord = new google.maps.LatLng(parseFloat(val['lat']),parseFloat(val['lng']));
								
				new google.maps.Marker({
					position: truckCoord,
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

    <body onload="initialize()" style="padding-top: 0px;">
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
<div> </div>
<div id="map-canvas" style="position: absolute; top: 40px; right: 0;"></div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
<script type="text/javascript" src="javascript/nomad-script.js"></script> 
<script type="text/javascript" src="javascript/about.js"></script>
</body>
</html>