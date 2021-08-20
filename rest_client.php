<?php

// $host 	  = '192.168.1.101:3306';
// $db 	  = 'sms';
// $user 	  = 'sms';
// $password = 'multindo123';

// $mysqli = new mysqli($host,$user,$password,$db);
// $link = mysql_connect($host, $user, $password);


function curl($url) {
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);      
    return $output;
}

$curl = curl("http://192.168.1.101/api/otepe/");

// mengubah JSON menjadi array
$data = json_decode($curl, TRUE);

// var_dump($data);


json_encode($data);


// ----------------------------------------------
// ----------------------------------------------
/*
$path_to_fcm = "http://192.168.1.101/api/otepe/";
$server_key = "";

// $ip_user_client = getHostByName(getHostName());

$headers = array(
    'Content-Type: application/json'
);

$payload = json_encode($fields);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $path_to_fcm);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$result = curl_exec($ch);
if ($result === FALSE) {
    die('Curl failed: ' . curl_error($ch));
}


curl_close($ch);



header('Content-Type: application/json');
echo $result;
// var_dump($result);
*/