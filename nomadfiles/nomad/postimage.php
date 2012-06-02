<?php

	include 'OAuth/parse.php';
					
	session_start();

	$parse = new parseRestClient(array(
		'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
		'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
	));
					

	$uploadparams = array(
		'filename' => 'images/cartoon_truck.jpg'
	);
						 
	$uploadResponse = $parse->twitterLogin($loginParams);
	
	$associateparams = array(
		'name' => '',
		'payload' => array(
		
					)
	);
						
					