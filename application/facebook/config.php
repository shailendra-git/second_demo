<?php
require_once 'inc/facebook.php';
//include_once("inc/facebook.php"); 
//include facebook SDK
######### Facebook API Configuration ##########
$appId = '334193920567731'; //Facebook App ID
$appSecret = '36bcc8cf7928db5b0c06166e4ef51bdc'; // Facebook App Secret
$homeurl = 'https://app.onelane.com.au/auth/facebook_login_url';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  version    => 'v7.0'
));
$fbuser = $facebook->getUser();
?>