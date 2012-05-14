<?php

	//connect to the database
	mysql_connect("localhost","root","nuwebm11") or die(myql_error());
	mysql_select_db("nomad") or die(mysql_error());

		//escape input to prevent sql-injections
	foreach(array_keys($_POST) as $key)
	{
		$cleanPOST[$key] = mysql_real_escape_string($_POST[$key]);
	}
	
	$email = $cleanPOST['email'];
	
	
	$result = mysql_query("SELECT * FROM emails WHERE email='$email'") or die(mysql_error());
		if(mysql_num_rows($result) == 0){ //email isn't in the database yet
				mysql_query("INSERT INTO emails(email) VALUES('$email')") or die(mysql_error());
				echo 'Thanks! Your email address has been added to our database!';

		}
		else{ //email is already in our database
			echo "This email address was already in our database!";
		}
	
?>
