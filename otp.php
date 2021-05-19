<?php
//post
$url="https://www.sms4india.com/api/v1/sendCampaign";
$message = urlencode("message-text");// urlencode your message
$curl = curl_init();

$apikey='L2K1UA5W4GZWASH3KGUQCXLR2N72MO74';
$secret='Z9KQX0PPRK050V14';
$usertype='stage';
$phone='9150466362';
$senderid='SMSIND';
$message=urlencode('HI TESTING!!');

curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
//curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=[povided-api-key]&secret=[provided-secret-key]&usetype=[stage or prod]&phone=[to-mobile]&senderid=[active-sender-id]&message=[$message]");// post data

curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey='$apikey'&secret='$secret'&usetype='$usertype'&phone='$phone'&senderid='$senderid'&message='$message'");

// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>