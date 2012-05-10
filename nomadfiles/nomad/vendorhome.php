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
					
					if(isset($_GET['oauth_token'])){

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
						//save some info for session use
						$_SESSION['parse_session_token'] = $loginResponse['sessionToken'];
						$_SESSION['logged_in'] = true;
						$_SESSION['screen_name'] = $twitterInfo->screen_name;
						$_SESSION['profile_image_url'] = $twitterInfo->profile_image_url;	
					}
					
					
					echo '<li class="active"><a href="index.php">' . $_SESSION['screen_name'] . '
						<img src="' . $_SESSION['profile_image_url'] . '" width="25px" height="25px"></a></li>';
						
					//retrieve parse userId
					if(isset($_GET['oauth_token'])){
						$userId = $loginResponse['objectId'];
						$_SESSION['userId'] = $userId;
					}
					else{
						$userId = $_SESSION['userId'];
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
								'PhoneNumber' => intval($_POST['phone'])
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
								'Price' => floatval($_POST['price'])
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
								'TruckID' => $_SESSION['truckId']
							)
						);
						$request = $parse->create($params);
						
					}
              	?>
                
                </li>
            </ul>
          </div>
        </div>
      </div>
      
      <div id="logo-div"><a href="index.php"><img id="big-logo" src="images/title_logo.png"/></a></div>
    
    <div class="row-fluid" id="main-div">
    
    	<h1 class="section-title">Vendor Info</h1>
      
      <div class="row-fluid my-info color-teal">
      	
        <div class="row-fluid pic-column">
        
        
        <?php						
			$userParams = array(
				'objectId' => $userId
			);
				
			$userResponse = $parse->getUser($userParams);
			$_SESSION['truckId'] = (string)$userResponse['TruckId'];
			
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
		?>
        
        </div>
        
        
        <form action="vendorhome.php" method="post">
        <div class="row-fluid info-column">
            <dl class="dl-horizontal">
                <dt>Truck Name</dt> 
                    <dd class="fixed-data">
                    <?php					
                     	if(isset($truckResponse['Name'])) echo $truckResponse['Name'] . '</dd>';
                    	else echo '(none)</dd>';
                       	echo '<dd class="edit-data"><input type="text" name="truckName" class ="input-text" value="'. $truckResponse['Name'] .'" /></dd>';
                  	?>
                
                <dt>Email</dt> 
                    <dd class="fixed-data">
                    <?php
                        if(isset($userResponse['email']) && ($userResponse['email'] != '0')) echo $userResponse['email'] . '</dd>';
                        else echo '(none)</dd>';
                        echo '<dd class="edit-data"><input type="text" name="email" class ="input-text" value="'. $userResponse['email'] .'" /></dd>';
                    ?>
                    
                <dt>Phone Number</dt> 
                    <dd class="fixed-data">
                    <?php
                        if(isset($userResponse['PhoneNumber'])) echo $userResponse['PhoneNumber'] . '</dd>';
                        else echo '(none)</dd>';
                        echo '<dd class="edit-data"><input type="text" name="phone" class ="input-text" value="'. $userResponse['PhoneNumber'] .'" /></dd>';
                    ?>
                    
                    
                <dt>Twitter Handle</dt> 
                    <dd class="fixed-data">
                    <?php
                        echo $_SESSION['screen_name'] . '</dd>';
                    ?>
            </dl>        
      	</div>
      
      	<input class="edit-data toggle-edit" type="submit" value="Save"/>
      	</form>
      </div>
      
      <h1 class="section-title">Menu</h1>
      

        <?php
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
			while(isset($menuResponse['results'][$i]) && $i < 10){
				echo 	'<div class="row-fluid my-info color-green">
							<div class="row-fluid pic-column">';
				
				if(isset($menuResponse['results'][$i]['ItemPic']['url'])){
					echo '<img src="' . $menuResponse['results'][$i]['ItemPic']['url'] .'" class="menu-pic">';
				}
				else{
					echo '<img src="images/menu_holder.png" class="menu-pic">';
				}
		
				echo		'</div>
							<form action="vendorhome.php" method="post">
							<div class="row-fluid info-column">
								<dl class="dl-horizontal">
									<dt>Menu Item</dt> 
									<dd class="fixed-data">';
							
				echo $menuResponse['results'][$i]['Name'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="menuItem" class ="input-text" value="'. $menuResponse['results'][$i]['Name'] .'" /></dd>';
				
				echo 	'<dt>Price</dt> 
						<dd class="fixed-data">';
				  
				echo $menuResponse['results'][$i]['Price'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="price" class ="input-text" value="' . $menuResponse['results'][$i]['Price'] . '" /></dd>';
				echo '</dl></div>
						<input type="text" class="hide-me" name="objectId" value="'. $menuResponse['results'][$i]['objectId'] . '" />
					<input class="edit-data toggle-edit" type="submit" value="Save" /></form></div>';
				
				$i += 1;
			}
      
      ?>
      
      <div class="row-fluid my-info color-green">
    	<form action="vendorhome.php" method="post">
	  		<div class="row-fluid info-column">
				<dl class="dl-horizontal">
					<dt>New Menu Item</dt>
                    <dd><input type="text" name="newMenuItem" class ="input-text" value="" /></dd>
					<dt>Price</dt> 
                    <dd><input type="text" name="newPrice" class ="input-text" value="" /></dd>
				</dl>
       		</div>
		<input class="toggle-edit" type="submit" value="Create" /></form></div>
       </div>
  
    </div>
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
  </body>
</html>
