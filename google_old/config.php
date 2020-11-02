<?php

//session_start();
##### DB Configuration #####
//include_once '../../application/config/config.php';
$servername = "localhost";
$username = "root";
$password = "";
$db = "instamojo";

##### Google App Configuration #####
// $googleappid = "91669543729-sgrjprq8a89gb6s3rcak35do5p1dcsuu.apps.googleusercontent.com"; 
// $googleappsecret = "f7Ug3wirqAz3IdBM14mqG_vp"; 
// // $redirectURL = "http://localhost:81/LoginwithGoogle/authenticate.php"; 
// $redirectURL = "https://app.onelane.com.au/owner/dashboard"; 

// ##### Create connection #####
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ##### Required Library #####
// include_once 'src/Google/Google_Client.php';
// include_once 'src/Google/contrib/Google_Oauth2Service.php';

// $googleClient = new Google_Client();
// $googleClient->setApplicationName('Login to CodeCastra.com');
// $googleClient->setClientId($googleappid);
// $googleClient->setClientSecret($googleappsecret);
// $googleClient->setRedirectUri($redirectURL);

// $google_oauthV2 = new Google_Oauth2Service($googleClient);



?>