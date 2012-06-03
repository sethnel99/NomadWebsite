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
					
					if(isset($_GET['oauth_token']) && ($_GET['oauth_token'] != $_SESSION['oauth_token'])){

						$twitterObj->setToken($_GET['oauth_token']);
	
						$token = $twitterObj->getAccessToken();
						$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
						$twitterInfo= $twitterObj->get_accountVerify_credentials();
						$twitterInfo->response;

						$loginParams = array(
							'login' => array(
								'authData' => array(
									'twitter' => array(
										'id' => (string)$twitterInfo->id,
										'screen_name' => $twitterInfo->screen_name,
										'consumer_key' => $consumer_key,
										'consumer_secret' => $consumer_secret,
										'auth_token' => $token->oauth_token,
										'auth_token_secret' => $token->oauth_token_secret
									)
								)
							)
						);
						 
						$loginResponse = $parse->twitterLogin($loginParams);
						
						//save the userId
						$userId = $loginResponse['objectId'];
						$_SESSION['userId'] = $userId;
						
						//save some info for session use
						$_SESSION['parse_session_token'] = $loginResponse['sessionToken'];
						$_SESSION['screen_name'] = $twitterInfo->screen_name;
						$_SESSION['profile_image_url'] = $twitterInfo->profile_image_url;
						$_SESSION['oauth_token'] = $_GET['oauth_token'];
					}
					
					else{
						$userId = $_SESSION['userId'];
					}
						
					

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
		
					
					
					//If there are any updates on the profile, we take care of them here
					
					if(isset($_POST['truckName'])){
						
						//update all truck variables
						$params = array(
							'className' => 'Trucks',
							'objectId' => $_SESSION['truckId'],
							'object' => array(
								'Name' => $_POST['truckName']
							)
						);
						$request = $parse->update($params);
						
						
						//update all user variables
						$params = array(
							'parse_session_token' => $_SESSION['parse_session_token'],
							'objectId' => $userId,
							'object' => array(
								'email' => $_POST['email'],
								'PhoneNumber' => intval(preg_replace("/[^0-9]/", "", $_POST['phone'])),
								'twitterhandle' => $_SESSION['screen_name']
							)
						);
						
						$request = $parse->updateUser($params);
					}
					
					//if there are any updates on the menu, we take care of them here
					if(isset($_POST['menuItem'])){
						//update all menu variables
						$params = array(
							'className' => 'MenuItems',
							'objectId' => $_POST['objectId'],
							'object' => array(
								'Name' => $_POST['menuItem'],
								'Price' => floatval($_POST['price']),
								'Cost' => floatval($_POST['cost'])
							)
						);
						$request = $parse->update($params);
						
					}
						
					//if there are any new menu items, we take care of them here
					if(isset($_POST['newMenuItem'])){
						//update all menu variables
						$params = array(
							'className' => 'MenuItems',
							'object' => array(
								'Name' => $_POST['newMenuItem'],
								'Price' => floatval($_POST['newPrice']),
								'TruckID' => $_SESSION['truckId'],
								'Cost' => floatval($_POST['newCost'])
							)
						);
						$request = $parse->create($params);
					}
					
					//if there is a delete request, we handle it here
					if($_POST['delete'] == 'yes'){
						//update all menu variables
						$params = array(
							'className' => 'MenuItems',
							'objectId' => $_POST['objectId']
						);
						$request = $parse->delete($params);
					}
					
					//store the truck ID if it exists
					$userParams = array(
						'objectId' => $userId
					);
						
					$userResponse = $parse->getUser($userParams);
					if(isset($userResponse['TruckId'])){
						$_SESSION['truckId'] = (string)$userResponse['TruckId'];
					}
              	?>
            </li>
         </ul>
      </div>
   </div>
</div>

<!--<div id="logo-div"><a href="index.php"><img id="big-logo" src="images/title_logo.png"/></a></div>-->
<div class="row-fluid" id="main-div">
   <div class="span2 home-nav">

      <table class="table table-bordered">
         <tbody>
         	<tr>
            	<td><div class="nav-section">Following</div></td>
            </tr>
            <tr>
               <td><div id="nav-following" class="home-nav-item">List View</div></td>
            </tr>
            <tr>
            	<td><div class="nav-section">My Business</div></td>
            </tr>
            <tr>
               <td><div id="nav-business" class="home-nav-item">Edit Profile and Menu</div></td>
            </tr>
            <tr>
               <td><div id="nav-analytics" class="home-nav-item">Analytics</div></td>
            </tr>
         </tbody>
      </table>
      
      
   </div>
   <div id="home-div" class="span10">
   
   <div id="my-following" class="home-items">
   <h1 class="section-title">Following</h1>
   Currently not following any nomads!
   </div>
   
   <div id="my-analytics" class="home-items">
   <h1 class="section-title">Analytics</h1>
   <?php
   	echo '<iframe src="http://nomadapp.heroku.com/chart/index?uid=' . $_SESSION['userId'] . '" width="850px" height="500px"></iframe>';
	?>
   </div>
   
   <?php
	if(isset($_SESSION['truckId'])){
   echo '<div id="my-business" class="home-items business-exists">
   	<h1 class="section-title">My Business</h1>
      <div class="row-fluid my-info color-teal">
         <div class="row-fluid pic-column">';
            						
			
			$truckParams = array(
								'className' => 'Trucks',
								'objectId' => $_SESSION['truckId']
					);
					
			$truckResponse = $parse->get($truckParams);
			
			if(isset($truckResponse['Logo']['url'])){
				echo '<img src="' . $truckResponse['Logo']['url'] . '" class="menu-pic">';
			}
			else{
				echo '<img src="images/truck_icon.png" class="menu-pic">';
			}
	
         echo '</div>
         <form action="home.php" method="post">
            <div class="row-fluid info-column">
               <dl class="dl-horizontal">
                  <dt>Nomad</dt>
                  <dd class="fixed-data">';
				
                     	if(isset($truckResponse['Name'])) echo $truckResponse['Name'] . '</dd>';
                    	else echo '(none)</dd>';
                       	echo '<dd class="edit-data"><input type="text" name="truckName" class ="input-text" value="'. $truckResponse['Name'] .'" /></dd>';
                  	
                  echo '<dt>Email</dt>
                  <dd class="fixed-data">';
            
                        if(isset($userResponse['email']) && ($userResponse['email'] != '0')) echo $userResponse['email'] . '</dd>';
                        else echo '(none)</dd>';
                        echo '<dd class="edit-data"><input type="text" name="email" class ="input-text" value="'. $userResponse['email'] .'" /></dd>';
                   
                  echo '<dt>Phone Number</dt>
                  <dd class="fixed-data">';
                     
                        if(isset($userResponse['PhoneNumber'])) echo $userResponse['PhoneNumber'] . '</dd>';
                        else echo '(none)</dd>';
                        echo '<dd class="edit-data"><input type="text" name="phone" class ="input-text" value="'. $userResponse['PhoneNumber'] .'" /></dd>';
                    
                  echo '<dt>Twitter Handle</dt>
                  <dd class="fixed-data">';
                     
                        echo $_SESSION['screen_name'] . '</dd>';
						echo '<dd class="edit-data">' . $_SESSION['screen_name'] . '</dd>';
                    
               echo '</dl>
            </div>
            <input class="edit-data toggle-edit btn btn-primary" type="submit" value="Save"/>
         </form>
      </div>
      <h1 class="section-title">Menu Items</h1>';
      
			//Query for all the menu items using the TruckId
			$menuParams = array(
						'className' => 'MenuItems',
						'query' => array(
							'TruckID' => array(
								'$regex' => (string)$userResponse['TruckId']
							)
						)
					);
					
			$menuResponse = $parse->query($menuParams);
			
			//Print the first 10 results
			
			$i = 0;
			//print_r($menuResponse);
			while(isset($menuResponse['results'][$i]) && $i < 50){
				echo 	'<div class="row-fluid my-info color-green">
							<div class="row-fluid pic-column">';
				
				if(isset($menuResponse['results'][$i]['ItemPic']['url'])){
					echo '<img src="' . $menuResponse['results'][$i]['ItemPic']['url'] .'" class="menu-pic">';
				}
				else{
					echo '<img src="images/menu_holder.png" class="menu-pic">';
				}
		
				echo		'</div>
							<form action="home.php" method="post">
							<div class="row-fluid info-column">
								<dl class="dl-horizontal">
									<dt>Menu Item</dt> 
									<dd class="fixed-data">';
							
				echo $menuResponse['results'][$i]['Name'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="menuItem" class ="input-text" value="'. $menuResponse['results'][$i]['Name'] .'" /></dd>';
				
				echo 	'<dt>Production Cost</dt> 
						<dd class="fixed-data">';
				  
				echo number_format($menuResponse['results'][$i]['Cost'],2) . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="cost" class ="input-text" value="' . number_format($menuResponse['results'][$i]['Cost'],2) . '" /></dd>';
				
				echo 	'<dt>Sales Price</dt> 
						<dd class="fixed-data">';
				  
				echo number_format($menuResponse['results'][$i]['Price'],2) . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="price" class ="input-text" value="' . number_format($menuResponse['results'][$i]['Price'],2) . '" /></dd>';
				echo '</dl></div>
						<input type="text" class="hide-me" name="objectId" value="'. $menuResponse['results'][$i]['objectId'] . '" />
						<input type="text" class="hide-me save-delete" name="delete" value="no" />
					<input class="edit-data toggle-edit submit-menu btn btn-primary" type="submit" value="Save" />
					<input class="delete-item btn fixed-data" type="button" value="Delete"></form></div>';
				
				$i += 1;
			}
      
      
      echo '<div class="row-fluid my-info color-green">
         <form action="home.php" method="post">
            <div class="row-fluid info-column">
               <dl class="dl-horizontal">
                  <dt>New Menu Item</dt>
                  <dd>
                     <input type="text" name="newMenuItem" class ="input-text" value="" />
                  </dd>
						<dt>Production Cost</dt>
                  <dd>
                     <input type="text" name="newCost" class ="input-text" value="" />
                  </dd>
                  <dt>Sales Price</dt>
                  <dd>
                     <input type="text" name="newPrice" class ="input-text" value="" />
                  </dd>
               </dl>
            </div>
            <input class="toggle-edit btn" type="submit" value="Create" />
         </form>
      </div>
   </div>';
	}
	
	else{
		echo'<div id="my-business" class="home-items"><h1 class="section-title">My Business</h1><h3>Currently no existing business.</h3>
			If you would like to create a business to be displayed in Nomad\'s search engine, click the button below. 
			Registration will require approval from our team and may take 24 hours to appear on the Nomad site.
			<br /><br /><button id="make-business" class="btn btn-primary" type="button">Create Business</button></div>';
	}
	?>
   </div>
</div>
</div>
<script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="javascript/nomad-script.js"></script>
</body>
</html>
