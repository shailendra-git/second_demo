<?php 
session_start();

## include required files
/*******************************/
// require_once '../../config/settings.php';
// require_once '../../model/users.php';
// require_once '../../model/email.php';
// require_once '../../model/posts.php';
// require_once '../../includes/phpmailer/class.phpmailer.php';
require_once '../google_src/Google_Client.php';
require_once '../google_src/contrib/Google_Oauth2Service.php';
/*******************************/

## Create Objects
/*******************************/
$client = new Google_Client();
$oauth2 = new Google_Oauth2Service($client);
// $userObj 	= new Model_Users();
// $emailObj = new Model_Email();
// $mail     = new PHPMailer(true);
// $postsObj = new Model_Posts();
/*******************************/

## 
/*******************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}
if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();

print_r($user);
exit("hello");

//  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
//  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $content = $user;
  $email= $content['email'];
  $fname= mysql_escape_string(preg_replace('/[^A-Za-z0-9\-]/', '',$content['given_name']));
  $lname= mysql_escape_string(preg_replace('/[^A-Za-z0-9\-]/', '',$content['family_name']));
  
   $user_exists = $userObj->CheckUserByEmail($email);
   if(count($user_exists)<1)
      {
		   $salt=genenrate_salt();
		   $psd=$userObj->generaterandompassword(15);
		   $newpassword = genenrate_password($salt,$psd);
		   
	       $insertArray= array();	
		   $insertArray['password'] 		 =  $newpassword;
		   $insertArray['salt'] 			 =  $salt;
		   $insertArray['fbUID'] 			=  '';
		   $insertArray['email'] 			=  $email;
		   $insertArray['regDate']		  =  date("Y-m-d H:i:s");
		   $insertArray['status']		   =  2;
		   $insertArray['userType']		 =  '3';
		 
		   $userId = $userObj->addUserByValue($insertArray); 
		  
		   
	       $userprofileArray = array ();
    	   $userprofileArray['userId'] 		= $userId;
		   $userprofileArray['regDate']	   = date ('d-m-Y');
		   $userprofileArray['status'] 		= '2';
		   $userprofileArray['email']  		 = $email;
		   $userprofileArray['fname']     	 = $fname;
		   $userprofileArray['lname']      	 = $lname;
     	   $userprofileArray['userType']	  =  '3';


           $username  = trim(strtolower(str_replace(" ","",$fname))) . '_' . trim(strtolower(str_replace(" ","",$lname)));
		   $username1 =  trim(strtolower(str_replace(" ","",$fname))) . '' . trim(strtolower(str_replace(" ","",$lname)));
		   $username2 =  trim(strtolower(str_replace(" ","",$fname))) . '-' . trim(strtolower(str_replace(" ","",$lname)));
		   $username = str_replace('"',"",$username);
		   $username = str_replace("'","",$username);
		   $username1 = str_replace('"',"",$username1);
		   $username1 = str_replace("'","",$username1);
		   $username2 = str_replace('"',"",$username2);
		   $username2 = str_replace("'","",$username2);
 
           $usernameexist = $usersObj->checkUserNameExists($username);
		   $usernameexist1 = $usersObj->checkUserNameExists($username1);
		   $usernameexist2 = $usersObj->checkUserNameExists($username2);

		   if (count ($usernameexist) < 1)
		    {
			   $userprofileArray['username'] = $username;
			} 
		   elseif (count ($usernameexist1) < 1)
		    {
				$userprofileArray['username'] = $username1;
			}
		   elseif (count ($usernameexist2) < 1) 
		    {
				$userprofileArray['username'] = $username2;
			}
		  else
		   {
			    $username = trim(strtolower(str_replace(" ","",$fname))) . '' . trim(strtolower(str_replace(" ","",$lname))) . '' . $userprofileId;
				$userprofileArray['username'] = $username;
		   	}
		   	$userprofileId = $usersObj->addUserProfileByValue($userprofileArray);
		   	
		   	//$usersObj->editUserProfileValueById ($userNameDetail,$userprofileId);
            
            $usersObj->editUserNameByUserId($userprofileArray['username'],$userprofileId);

            /*********************************************************************************/
                $userlink = SITE_URL."/".$userprofileArray['username']; 
                $postactivity['post_activity']  = ucfirst($fname).' '.ucfirst($lname). ' has registered on SportsPlaya'; 
                $postactivity['userId']         = 	$userprofileId;
                $postactivity['userType']       =  	'3';
                $postactivity['post_action_id'] =  	$userprofileId;
                $postactivity['postType']       =  	'new_register';
                $postactivity['status']         =   2;
                $postactivity['date']           =   date('Y-m-d H:i:s');
                $postactivity['modified_date']  =   date('Y-m-d H:i:s');
                $postsObj->addPostsByValue($postactivity);
            /*********************************************************************************/


			/************ Add User Details In Account Settings & Set Value Table Start *************/
			## Who Can See My Stuffs
			$settingId = '1';
			$stuffArray = array();
			$stuffArray['userId'] 	 = $userprofileId;
			$stuffArray['settingId'] = $settingId;
			$usersObj->addAccountSetValues($stuffArray);

			## Who Can Contact Me
			$settingId = '2';
			$friendArray = array();
			$friendArray['userId']   = $userprofileId;
			$stuffArray['settingId'] = $settingId;
			$usersObj->addAccountSetValues($friendArray);
			
			/*** Email COde Start *////
			
						$emailArray = $emailObj->getEmailById(4);
						$to = $email;
						$toname = $fname.' '.$lname;		
						$fromname = $emailArray['fName'];
						$from = $emailArray['fEmail'];
						
						$subject = $emailArray['emailSub'];
						$subject = str_replace('[SITENAME]', SITENAME, $subject);
						$message = $emailArray['emailContent'];
						
						$message = str_replace('[NAME]', ucfirst(return_post_value(trim($fname))).' '.ucfirst(return_post_value(trim($lname))), $message);
						$message = str_replace('[EMAIL]',  $email, $message);
						$message = str_replace('[USERNAME]', ucfirst(return_post_value(trim($fname))).' '.ucfirst(return_post_value(trim($lname))), $message);
						$message = str_replace('[SITEURL]', SITE_URL, $message);
						$message = str_replace('[SITENAME]', SITENAME, $message);
						
						$template_msg	= str_replace('[MESSAGE]',$message , $message);
						$template_msg 	= str_replace('[LOGO]','<img src="'.SITE_URL.'/siteAssets/images/logo.png">', $template_msg);
						$template_msg 	= str_replace('[PASSWORD]', $psd	, $template_msg);
						$template_msg 	= str_replace('[SITELINK]',SITE_URL , $template_msg);
						$template_msg 	= str_replace('[SUBJECT]',$subject , $template_msg);
						$template_msg	= str_replace('[SITEROOT]',SITE_URL , $template_msg);					
						
						/*echo $subject."<br/>"; 
						echo $from."<br/>"; 
						echo $fromname."<br/>"; 
						echo $to."<br/>"; 
						echo $toname."<br/>";
						echo "<pre>"; print_r($template_msg); exit();*/
						
						try {
						$mail->AddAddress($to, $toname);
						$mail->SetFrom($from, $fromname);
						$mail->addBCC("Phillipb@aapt.net.au","Phillip Bellifemine");
                		$mail->addBCC("phillip@sportsplaya.com","Phillip Bellifemine");
						$mail->Subject = $subject;
						$mail->Body = $template_msg; 
						$mail->Send();
						} 
						catch (phpmailerException $e) {
						$_SESSION['msg']= $e->errorMessage(); //Pretty error messages from PHPMailer
						} catch (Exception $e) {
						$_SESSION['msg']= $e->getMessage(); //Boring error messages from anything else!
						}
						/*** Email COde End *////
						
		   
                  header('location:'.SITE_URL.'/users/userType/?id='.base64_encode($userId));
				  exit();
	  }
  else{
		    $_SESSION['stagUserId']   = $user_exists['userId'];
	  	    $_SESSION['email']  	    = $user_exists['email'];									
	        $_SESSION['userType']  	 = $user_exists['userType'];
	        $_SESSION['advance_search']    = $userArray['advance_search'];


                  header("Location:".SITE_URL."/");
					exit();
	  }
    


  $_SESSION['token'] = $client->getAccessToken();
} 
else {
	  $authUrl = $client->createAuthUrl();
}

if(isset($authUrl)) {?>
	<script>
	window.location ="<?php echo $authUrl;?>";
	</script>
<?php
//    echo $content = "<a class='login' href='$authUrl'>Login</a>";
  } 
 ?>