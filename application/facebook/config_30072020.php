<?php
require_once 'inc/facebook.php';
//include_once("inc/facebook.php"); 
//include facebook SDK
######### Facebook API Configuration ##########
$appId = '293835288495683'; //Facebook App ID
$appSecret = '1588fb1ee3788c7eb3634fe3feba94b3'; // Facebook App Secret
$homeurl = 'http://test.local.wiseit.com/auth/facebook_login_url';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  version    => 'v7.0'
));
$fbuser = $facebook->getUser();
?>