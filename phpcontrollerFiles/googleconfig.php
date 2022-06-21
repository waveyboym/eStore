<?php
/*client id: 589220589873-gqhhu9k1k9ji9ttsdschgcuejs5jv2kk.apps.googleusercontent.com
client secret: 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*/

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('589220589873-gqhhu9k1k9ji9ttsdschgcuejs5jv2kk.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/eStore/');
 
//
$google_client->addScope('email');

$google_client->addScope('profile');
 
//start session on web page