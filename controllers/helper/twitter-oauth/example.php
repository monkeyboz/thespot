<?php
//bot.php
$url = "https://api.twitter.com/1/statuses/update.json";
$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);

// howmany parameter to post
curl_setopt($ch, CURLOPT_POST, 1);

// the parameter 'username' with its value 'johndoe'
curl_setopt($ch, CURLOPT_POSTFIELDS,"username=johndoe");

$result= curl_exec ($ch);
curl_close ($ch); 
print $result;

?>