<?php
error_reporting(E_ALL); 
ini_set( 'display_errors','1');

// Insert your keys/tokens
$consumerKey = '8Z4Nxv1iPoUigPOuVFR5nw';
$consumerSecret = 'SR70mxoQpQVTUgWF7tyHkvJqI4JzUQgWjZDJJKPB4U';
$oAuthToken = '28132702-guOe7hTbTKBReGFaqfT8vSMNVxSElQbGDcfSkBE';
$oAuthSecret = 'cSdomhhVbpQTa1NK5hLaMsvkU19ocYCeW1eaflRs9U';

// Full path to twitteroauth.php (change oauth to your own path)
require_once(getcwd().'/twitteroauth.php');

// create new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

// Your Message
$message = "This is a test message.";
echo $message;

// Send tweet 
$tweet->post('statuses/update', array('status' => "$message"));

echo '<pre>'.print_r($tweet, true).'</pre>';
?>