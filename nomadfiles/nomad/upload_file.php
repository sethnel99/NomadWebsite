<?php

include 'OAuth/parse.php';
session_start();

$parse = new parseRestClient(array(
		'appid' => 'FoX2hKFWtiUIWgt2mioFIJvwdwgy461XAS7n367S',
		'restkey' => 'JHC47SBv4QXHkyXywH86woIhW7KoEIMJeDm7Qk5c'
));
	
	
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];

	$uploadparams = array(
		'fileName' => $_FILES["file"]["name"],
		'contentType' => $_FILES["file"]["type"]
	);
						 
	$uploadResponse = $parse->uploadFile($loginParams);
  
  print_r($uploadResponse);
  
  	$associateparams = array(
		
		'className' => 'Trucks',
		'payload' => array(
			'name' => $uploadResponse['name']
					)
	);
  
  }
  
  
 
  	

	
?>




	


					



				