<?php

	include 'OAuth/parse.php';
	session_start();
	
	$parse = new parseRestClient(array(
		'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
		'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
	));
	
	$locationParams = array(
						'className' => 'Trucks',
						'query' => array(
							'Location' => array(
								'$exists' => true
							),
							'Approved' => array(
								'$in' => array(true)
							)
						)
					);
					
	$locationResponse = $parse->query($locationParams);
	$results = $locationResponse['results'];
	$arr = array();


	
	foreach($results as $truck){
		
		$userResponse = $parse->getUser( array(
			'objectId' => $truck['UserObjectID']
		));
		
			
		array_push($arr, array(
			'name' => $truck['Name'],
			'lat' => $truck['Location']['latitude'],
			'lng' => $truck['Location']['longitude'],
			'tid' => $truck['objectId'],
			'phone' => $userResponse['PhoneNumber'],
			'twitter' => $userResponse['twitterhandle']
			));
		
	}
	
	$return = json_encode($arr);
	echo $return;

?>