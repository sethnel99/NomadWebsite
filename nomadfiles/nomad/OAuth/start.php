<?php

include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

echo '<a href="' . $twitterObj->getAuthorizationUrl() . '"><img src="sign-in-with-twitter-d.png" /></a>';
?>

