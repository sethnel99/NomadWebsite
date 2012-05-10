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

  				<li class="active"> User!</li>
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
			include 'OAuth/parse.php';
						
			$parse = new parseRestClient(array(
				'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
				'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
			));
					
			$userId = 'A5pACN1qDB';
					
			$userParams = array(
				'objectId' => $userId
			);
				
			$request = $parse->getUser($userParams);
			$userResponse = json_decode($request, true);
			
			echo '<img src="' . $userResponse['userPic']['url'] . '" class="menu-pic">';
		?>
        
        </div>
        
        <div class="row-fluid info-column">
        
        <dl class="dl-horizontal">
        <dt>Company</dt> 
        	<dd class="fixed-data">
            	<?php
					
					$truckParams = array(
						'className' => 'Trucks',
						'query' => array(
							'UserObjectID' => array(
								'$regex' => $userId
							)
							
						)
					);
					
					$request = $parse->query($truckParams);
					$truckResponse = json_decode($request, true);
					
					echo $userResponse['truckName'] . '</dd>';
					echo '<dd class="edit-data"><input type="text" name="company" class ="input-text" id="company" value="'. $userResponse['truckName'] .'"></dd>';
	  			?>
     
            
        <dt>Email</dt> 
        	<dd class="fixed-data">
            <?php
				echo $userResponse['email'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="email" class ="input-text" id="email" value="'. $userResponse['email'] .'"></dd>';
			?>
            
        <dt>Phone Number</dt> 
        	<dd class="fixed-data">
            <?php
				echo $userResponse['PhoneNumber'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="phone" class ="input-text" id="phone" value="'. $userResponse['PhoneNumber'] .'"></dd>';
			?>
            
            
        <dt>Twitter Handle</dt> 
        	<dd class="fixed-data">
            <?php
				echo $truckResponse['results'][0]['TwitterHandle'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="twitter" class ="input-text" id="twitter" value="' . $truckResponse['results'][0]['TwitterHandle'] . '"></dd>';
			?>
           
            
        <dt>Password</dt> 
        	<dd class="fixed-data">**********</dd> 
            <dd class="edit-data"><input type="text" name="password" class ="input-text" id="password"></dd>
        </dl>
                
      </div>
      
      </div>
      
      <h1 class="section-title">Menu</h1>
      
      <div class="row-fluid my-info color-green">
      	
        <div class="row-fluid pic-column">
        <?php
			$menuParams = array(
					'className' => 'MenuItems',
					'query' => array(
						'TruckID' => array(
							'$regex' => $userId
						)
					)
				);
				
			 $request = $parse->query($menuParams);
			 $menuResponse = json_decode($request, true);
			 
			 echo '<img src="' . $menuResponse['results'][0]['ItemPic']['url'] .'" class="menu-pic">';
		?>
        
        </div>
        
        <div class="row-fluid info-column">
        
        
        <dl class="dl-horizontal">
        
        <dt>Menu Item</dt> 
        	<dd class="fixed-data">
            
            <?php
						
				echo $menuResponse['results'][0]['Name'] . '</dd>';
				echo '<dd class="edit-data"><input type="text" name="menuItem" class ="input-text" value="'. $menuResponse['results'][0]['Name'] .'"></dd>';
	  		?>
                
            
        <dt>Price</dt> 
        	<dd class="fixed-data">
              
            <?php 
			echo $menuResponse['results'][0]['Price'] . '</dd>';
            echo '<dd class="edit-data"><input type="text" name="price" class ="input-text" value="' . $menuResponse['results'][0]['Price'] . '"></dd>';
			?>
            
        </dl>
        
        </div>
                
      </div>
      
      
    </div>
    
    <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="javascript/nomad-script.js"></script> 
  </body>
</html>
