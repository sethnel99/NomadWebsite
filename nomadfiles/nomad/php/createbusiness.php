<?php 

			session_start();
			include '../OAuth/EpiCurl.php';
			include '../OAuth/EpiOAuth.php';
			include '../OAuth/EpiTwitter.php';
			include '../OAuth/secret.php';
			include '../OAuth/parse.php';
			
		
			$parse = new parseRestClient(array(
				'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
				'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
			));
			//create a truck object that reflects the user ID
			$params = array(
				'className' => 'Trucks',
				'object' => array(
					'UserObjectID' => $_SESSION['userId']
				)
			);
			$decode_request = $parse->create($params);
			
			//update the user object to reflect the ID of the truck
			$params = array(
				'parse_session_token' => $_SESSION['parse_session_token'],
				'objectId' => $_SESSION['userId'],
				'object' => array(
				'TruckId' => (string)$decode_request['objectId']
				)
			);
							
			$decode_request = $parse->updateUser($params);
			
?>