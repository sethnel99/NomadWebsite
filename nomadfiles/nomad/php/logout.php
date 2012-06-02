<?php

	if($_POST['logout'] == 'yes'){
		session_start();
		session_unset();
		session_destroy();
	}
	
	
?>