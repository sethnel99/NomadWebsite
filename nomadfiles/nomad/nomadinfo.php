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
            <li class="active">
               <?php
					include 'OAuth/EpiCurl.php';
					include 'OAuth/EpiOAuth.php';
					include 'OAuth/EpiTwitter.php';
					include 'OAuth/secret.php';
					include 'OAuth/parse.php';
					
					session_start();
					
					$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
					$parse = new parseRestClient(array(
						'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
						'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
					));
					 
					 
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
            </li>
         </ul>
      </div>
   </div>
</div>

<!--<div id="logo-div"><a href="index.php"><img id="big-logo" src="images/title_logo.png"/></a></div>-->
<div class="row-fluid" id="main-div">

   <div id="home-div" class="span10" style="padding-left: 100px;">
   
   <?php

   echo '<h1 class="section-title">Nomad Info</h1>
      <div class="row-fluid my-info color-teal">
         <div class="row-fluid picture-column">';
            						
			
			$truckParams = array(
								'className' => 'Trucks',
								'objectId' => (string)$_GET['nomad']
								);
					
					
			$truckResponse = $parse->get($truckParams);
			
			$userParams = array('objectId' => $truckResponse['UserObjectID']);
					
					
			$userResponse = $parse->getUser($userParams);
			
			
			if(isset($truckResponse['Logo']['url'])){
				echo '<img src="' . $truckResponse['Logo']['url'] . '" class="menu-pic">';
			}
			else{
				echo '<img src="images/truck_icon.png" class="menu-pic">';
			}
	
         echo '</div>
            <div class="row-fluid info-column">
               <dl class="dl-horizontal">
                  <dt>Nomad</dt>
                  <dd>';
				
                     	if(isset($truckResponse['Name'])) echo $truckResponse['Name'] . '</dd>';
                    	else echo '(none)</dd>';

                  	
                  echo '<dt>Email</dt>
                  <dd>';
            
                        if(isset($userResponse['email']) && ($userResponse['email'] != '0')) echo $userResponse['email'] . '</dd>';
                        else echo '(none)</dd>';

                   
                  echo '<dt>Phone Number</dt>
                  <dd>';
                     
                        if(isset($userResponse['PhoneNumber'])) echo $userResponse['PhoneNumber'] . '</dd>';
                        else echo '(none)</dd>';

                    
                  echo '<dt>Twitter Handle</dt>
                  <dd>';
                     	if(isset($userResponse['twitterhandle'])) echo $userResponse['twitterhandle'] . '</dd>';
                        else echo '(none)</dd>';
 
                    
               echo '</dl>
            </div>
      </div>
		
      <h1 class="section-title">Menu Items</h1>';
      
			//Query for all the menu items using the TruckId
			$menuParams = array(
						'className' => 'MenuItems',
						'query' => array(
							'TruckID' => array(
								'$regex' => (string)$_GET['nomad']
							)
						)
					);
					
			$menuResponse = $parse->query($menuParams);
			
			//Print the first 50 results
			
			$i = 0;
			//print_r($menuResponse);
			while(isset($menuResponse['results'][$i]) && $i < 50){
				echo 	'<div class="row-fluid my-info color-green">
							<div class="row-fluid picture-column">';
				
				if(isset($menuResponse['results'][$i]['ItemPic']['url'])){
					echo '<img src="' . $menuResponse['results'][$i]['ItemPic']['url'] .'" class="menu-pic">';
				}
				else{
					echo '<img src="images/menu_holder.png" class="menu-pic">';
				}
		
				echo		'</div>
							<div class="row-fluid info-column">
								<dl class="dl-horizontal">
									<dt>Menu Item</dt> <dd>';
							
				echo $menuResponse['results'][$i]['Name'] . '</dd>';
				
				echo 	'<dt>Price</dt> <dd>';
				  
				echo number_format($menuResponse['results'][$i]['Price'],2) . '</dd>';
		
				echo '</dl></div></div>';
				
				$i += 1;
			}
      
      
      //echo '</div>';
	
	?>
   </div>
</div>
</div>
<script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="javascript/nomad-script.js"></script>
</body>
</html>
