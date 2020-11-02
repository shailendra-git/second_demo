<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Google extends CI_Controller

{

	 public function __construct()

	 {

		
	 	 parent::__construct();
	 	 $this->load->library('session'); 
	// 	// $this->load->library('session');

	// 	// $this->load->model('auth_model');

	// 	// $this->load->model('common_model');

	// 	// $this->load->model('team_model');
		

	// 	// $this->load->model('property_model');


	 }

   public function log(){
   	echo "1111";
   }

	public function google_login()

	{
		session_start();
		require_once  APPPATH. 'google_src/Google_Client.php';
		require_once  APPPATH. 'google_src/contrib/Google_Oauth2Service.php';

		//$this->load->library('google'); 
	//	echo "1111";
      //   exit;

  //       $Google_Client =  base_url('google_src/Google_Client.php');
	 //    $Google_Oauth2Service = base_url('google_src/contrib/Google_Oauth2Service.php');
		// // //echo $Google_Client;
		// // require_once base_url('google_src/Google_Client.php');
  // //      require_once base_url('google_src/contrib/Google_Oauth2Service.php');

  $googleappid = $this->config->item('googleappid');
 $googleappsecret = $this->config->item('googleappsecret');
 $redirectURL = $this->config->item('redirectURL');

$googleClient = new Google_Client();
$googleClient->setApplicationName('Login to CodeCastra.com');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($googleClient);
//print_r($google_oauthV2);
 //  echo $_SESSION['token'] = $client->getAccessToken();
 // echo $_SESSION['token'];
 // echo "hell";
//googleClient
//echo "222"
 // echo  $googleClient->authenticate($_GET['code']);
 echo   $googleClient->getAccessToken();
 echo "hh";
  //exit;
// print_r($google_oauthV2);
// print_r($_GET);
// print_r($_POST);
// print_r($google_oauthV2['get']);
// exit;
echo $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

  if (isset($_GET['code'])) {
  $googleClient->authenticate($_GET['code']);
  $_SESSION['token'] = $googleClient->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}
// else{
// 	echo "2222";
// }
if (isset($_SESSION['token'])) {
 $googleClient->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $googleClient->revokeToken();
}

if ($googleClient->getAccessToken()) {
  $user = $google_oauthV2->userinfo->get();

  print_r($user);
  // exit;
}
// if (isset($_GET['code'])) {
//   $client->authenticate($_GET['code']);
//   $_SESSION['token'] = $client->getAccessToken();
//   $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//   header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
//   return;
// }
// if (isset($_SESSION['token'])) {
//  $client->setAccessToken($_SESSION['token']);
// }

// if (isset($_REQUEST['logout'])) {
//   unset($_SESSION['token']);
//   $client->revokeToken();
// }

// if ($client->getAccessToken()) {
//   $user = $oauth2->userinfo->get();

//   print_r($user);
//   exit;
// }

}


} 
