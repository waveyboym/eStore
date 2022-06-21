<?php

//Include Google Configuration File
include('googleconfig.php');
include "signupController.php";
include "loginController.php";
session_start();

if(!isset($_SESSION['access_token'])) header("Location: ../index.php");

$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
if(!isset($token['error'])){
    //Set the access token used for requests
    $google_client->setAccessToken($token['access_token']);
    //Store "access_token" value in $_SESSION variable for future use.
    $_SESSION['access_token'] = $token['access_token'];
    //Create Object of Google Service OAuth 2 class
    $google_service = new Google_Service_Oauth2($google_client);
    
    //Get user profile data from google
    $data = $google_service->userinfo->get();
    //Below you can find Get profile data and store into $_SESSION variable
    if(!empty($data['given_name'])) $_SESSION["LoggedUserid"] = $data['given_name'];
    if(!empty($data['email']))  $_SESSION["user_email_address"] = $data['email'];

    $newSignUp = new googleSignUp($_SESSION["LoggedUserid"], $_SESSION["user_email_address"]);   
    if(!$newSignUp->runSignUp()){
        $newLogin = new googleLogin($_SESSION["LoggedUserid"], $_SESSION["user_email_address"]);
    }
    $_SESSION["googleLogged"] = true;
    header("Location: ../index.php");
}

header("Location: ../index.php?there%20was%20an%20error%20from%20google");