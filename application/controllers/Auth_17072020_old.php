<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->load->model('auth_model');

		$this->load->model('common_model');

		$this->load->model('team_model');

		$this->load->model('property_model');

		$this->load->helper('string');

	}



	 public function addCheckRegisterEmailExists()

	{

           	$worker_id ='0';

			$email=$this->input->post('email');



			if(!$this->common_model->check_uniqueEmail($email,$worker_id))

			{

				echo '1';

			}

			else

			{	

				echo'0';

			}

	}



	public function signup()
	{
	    
	   // $image_url = base_url('/assets/images/onelanelogo.png');

		if(!empty($_POST))

		{
           
            if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 


            	

			$email=	$this->input->post('email');

			$id = $this->common_model->getUserByEmail($email);

				$user_type=	1;

				$firstname=	$this->input->post('firstname');

				$lastname=	$this->input->post('lastname');

				$company_name	=	$this->input->post('company_name');
				

				

				$mobile=	$this->input->post('mobile');

				$password=	md5($this->input->post('password'));

				$user_referral_comments=$this->input->post('user_referral_comments');


				$registerData =(

					array('user_type'=> $user_type,'firstname'=>$firstname,'lastname'=>$lastname,'company_name' =>$company_name ,'email'=>$email,'mobile'=>$mobile,'password' =>$password,'user_referral_comments' => $user_referral_comments));


				$id = $this->team_model->save($registerData);
                
				// add the unit as free trial for 30 days
				//$this->common_model->freeSubscription($id,$unit);				 

				$getUserData['usertype'] = $this->common_model->getUserData($id);

				$user = $getUserData['usertype']['user'];

			



				$data = array

				(

					'user'=>ucfirst($user),

					'email'=>$email,

					//'image_url' => $image_url,

				);

				$email_type='registration_email';

				

				$this->common_model->send_mail($email,$email_type,$data);
                


                $referred_user_id = $this->common_model->getReferredByEmail($email);
                if(!empty($referred_user_id) && $referred_user_id['user_id']>0)
                {
                $referred_id =  $referred_user_id['id'];

                $user_friend_email = $this->common_model->getUserData($referred_user_id['user_id']);
                $referred_by_user_mail = $user_friend_email['email'];
                $referred_by_user_name = $user_friend_email['firstname'];
                

                $referredUpdate =array('registration_id'=>$id);

				$this->common_model->updateReferredFriend($referred_id,$referredUpdate); 


                
                $message  = '';
		        $message .= "Your friend ".ucfirst($user)." has been registered";
		        $message .= "<br>";

			    $data_referred = array(

			        'fullname' => ucfirst($referred_by_user_name),
			        'email'=> $referred_by_user_mail,
			        'email_body' => $message,

			    );

		       $email_type='friend has register';
		      
		      // $this->common_model->send_mail($referred_friend_mail,$email_type,$data_referred);

		   }


                $this->session->set_flashdata('sign_up_msg','Your Account is Active');
				redirect(base_url('auth/thankYou'));	
		}else{ 
            $data['statusMsg'] = 'Please check on the reCAPTCHA box.'; 
        } 		

		}

		$this->load->view('signup_view',$data);



	}	



	public function registerApplicationTenannt($id)

	{

		$data =array();

		$data['tenantdata'] = $this->common_model->tenantData($id);

		$email = $data['tenantdata']['email'];

		$user_id = $data['tenantdata']['user_id'];


		//print_r($this->session->userdata()); exit;
		//echo 'test',$owner_id = $this->session->userdata('owner_id'); exit;

		// GET the owner id here

		$owner_id = $data['tenantdata']['owner_id'];
	


		if(!empty($_POST))

			{


					$user_type=	2;

					$firstname=	$this->input->post('firstname');	

					$mobile=	$this->input->post('mobile');

					$password=	md5($this->input->post('password'));

				

				

					$registerData =(

						array('user_type'=> $user_type,'parent_user_id'=>$owner_id,'firstname'=>$firstname,'mobile'=>$mobile,'password' =>$password,'email'=>$email));

					
					

					$tenantid = $this->team_model->save($registerData);

					


					$registerTenantData =(

						array('firstname'=>$firstname,'mobile'=>$mobile,'user_id'=> $tenantid));

					



				$tenant_id =$this->common_model->updateTenantdata($id,$registerTenantData);



					$getUserData['usertype'] = $this->common_model->getUserData($id);

					$user = $getUserData['usertype']['user'];

				



					$data = array

					(

						'user'=>ucfirst($firstname),

						'email'=>$email,

					);

					$email_type='registration_email';

					$this->common_model->send_mail($email,$email_type,$data);

					redirect(base_url('auth/signin'));

			}

		if ($user_id==0) 

		{

			$this->load->view('register_application_tenant_view',$data);

		}

		else

		{

			redirect(base_url('auth/error_message'));

		}

	}	



	public function error_message()

	{

		$this->load->view('error_message_view');

	}

	// Check subscription
	/*public function check_subscription($owner_id='')
	{
		
		 $is_subscribed = $this->common_model->check_subscription($owner_id); 

		 
		 if($is_subscribed)
			redirect(base_url('owner/properties'));
		else
		
			redirect(base_url('owner/subscriptions_prompt_next'));

	}*/

	public function signin()

	{
	
		if(!empty($_POST))
		{
           
			$data = array('email'=>$this->input->post('email'),'password'=>md5($this->input->post('password')),'is_active'=>1);

			$user = $this->auth_model->validateuser($data);


			if($user->num_rows() == 1)

			{

			$userData = $user->row_array();


			$userData['agent_properties'] ="";

			$userData['agent_permissions']="";

			$userData['agent_permissions_array']="";

			$userData['agent_id'] ="";




				if ($userData['user_type']==4) 

				{


						$userData['agent_id'] = $userData['id'];

						$getAgentPropertyData = $this->auth_model->getAgentProperty($userData['id']);

						$agent_property_array = array();

						if(!empty($getAgentPropertyData) && count($getAgentPropertyData)>0)

						{

							foreach($getAgentPropertyData as $agent_data)

							{


								 $agent_property_array[] = $agent_data['property_id'];

							}

						}

						$userData['agent_properties'] = implode(',',$agent_property_array);

						

						$getAgentPermission = $this->auth_model->getAgentPermission($userData['id']);

						

						$agent_permission_array = array();

						if(!empty($getAgentPermission) && count($getAgentPermission)>0)

						{



						$userData['agent_permissions'] = $getAgentPermission['permissions'];

						$userData['agent_permissions_array'] = explode(",",$getAgentPermission['permissions']);

								 	

						} 



						$userData['id'] = $userData['parent_user_id'];

					

				}

				$sessionData = array(

					'owner_id'=>$userData['id'],

					'firstname'=>$userData['firstname'],

					'email'=>$userData['email'],

					'agent_id' =>$userData['agent_id'],

					'user_type' =>$userData['user_type'],

					'agent_properties'=>$userData['agent_properties'],

					'agent_permissions'=>$userData['agent_permissions'],

					'agent_permissions_array'=>$userData['agent_permissions_array']);



				$this->load->helper('custom');
				$this->session->set_userdata($sessionData);
				
				//$this->check_subscription($this->session->userdata('owner_id'));

				//check_subscription($this->session->userdata('owner_id'));
		
				if ($this->session->userdata('user_type')==2) {

					redirect(base_url('tenant/messages')); 

				}else{

					//redirect(base_url('owner/properties'));
					redirect(base_url('owner/dashboard'));

				}

				
			}

			else

			{

				$this->session->set_flashdata('error_msg','Invalid Email/Password Or Your Account is Inactive');

				redirect(base_url('auth/signin'));

			}

		
		
		}


		$this->load->view('signin_view');

	}



	public function forgotpassword()

	{

		$this->load->view('forgotpassword_view');

	}

	public function changepassword()

	{	



		if(!empty($_POST))

		{

			$email=	$this->session->userdata('email');

			$worker_id = $this->common_model->getUserByEmail($email);

			//print_r($worker_id); exit;
	

				$password=	md5($this->input->post('password'));

				

				$registerData =(array('password' =>$password));



				$this->team_model->editTeamData($registerData,$worker_id['id']);

				 

				redirect(base_url('auth/signout'));



				

		}

      $data['activeclass']	='properties';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('change_password_view',$data);

		$this->load->view('common/footer',$data);



	}




	public function check_forgotemail_and_sendemail()

	{

		$email = $this->input->post('email');



	$user_data = $this->common_model->getUserByEmail($email);


		if(!$user_data)

		{

			$this->session->set_flashdata('error_msg',"Email not found!");

			redirect(base_url('auth/forgotpassword'));

		}
 
		else

		{	


            
			$user_details = $this->common_model->getUserData($user_data['id']);
			
			//print_r($user_details); exit;
		
        //echo $user_details['id']; exit;
			//$user = $getUserData['usertype']['user'];

			// encrypt id and generate forgot code
			$enc_user_id 	= $this->encode($user_details['id']);	
			$forgotcode		=	random_string('alnum', 16);
			$forgotcode_token		=	random_string('alnum', 10);
			


		

			//$password = date('Ymdhis');

			


			$userData = array(

								'forgotcode'=>$forgotcode,
								'forgotcode_time'=>time(),
								'forgot_token'=>$forgotcode_token,

								);


			

			$this->common_model->updateUserData($userData,$user_details['id']);

	$forgot_password_link = base_url('auth/resetnewpassword/').$enc_user_id."/".$forgotcode."/".$forgotcode_token; 

			$data = array

			(

				'user'=>ucfirst($user_details['user']),
				//'email'=>$email,
				'forgotpasslink'=>$forgot_password_link
			);

			$email_type='forget_password';

		



			$this->common_model->send_mail($email,$email_type,$data);

			$this->session->set_flashdata('success_msg',"Check Your Email Inbox, we sent an email!");

			redirect(base_url('auth/signin'));

		}	

	}

	public function signout()

	{

	

		$this->session->unset_userdata('owner_id');

		$this->session->unset_userdata('firstname');

		$this->session->unset_userdata('email');

		$this->session->sess_destroy();

		redirect(base_url('auth/signin'));

	}
    
    // Added by Rajmander functions to encode and decode the url ids
	public function encode($id) {
		$u_id=(double)$id * 525325.24;
		return rtrim(base64_encode($u_id),'=');
	}
	
	public function decode($id) {
		$u_id=base64_decode($id);
		return (double)$u_id / 525325.24; 
	}
	
	public function resetnewpassword($enc_user_id, $forgotcode,$forgotcodetoken)
	{
        if((!empty($enc_user_id) && !empty($forgotcode)) && (!empty($forgotcodetoken))) 
        {
        	//exit('452525');
            $user_id = $this->decode($enc_user_id);
           $dataExists = $this->common_model->check_forgotPasswordData($user_id,$forgotcode,$forgotcodetoken);
           if($dataExists->num_rows() == 1)
           {
              $userDetails = $dataExists->row_array();
              $forgot_create_time = $userDetails['forgotcode_time'];
              
              //$forgot_create_time = $forgot_create_time-3600;
              $diff     = time() - $forgot_create_time;
              
              // Convert time difference in minutes 
              $min     = round($diff / 60 ); 
               
              if($min> 60)
              {
                  //exit('60');
                  $this->session->set_flashdata('success_msg_forgotpass',"Password reset link  is deactivated");
                  redirect(base_url('auth/signin'));
              }
             // redirect to newpassword url
            // exit('all well');
            redirect('auth/password_reset/'.$enc_user_id);
           }
           else
           {
                $this->session->set_flashdata('success_msg_forgotpass',"Password reset link  is Invalid");
                redirect(base_url('auth/signin'));
           }
        }
        $this->session->set_flashdata('success_msg_forgotpass',"Password reset link  is Invalid");
                redirect(base_url('auth/signin'));
	    		
	}
	
	public function password_reset($enc_user_id)
	{
	    $this->load->view('reset_password_view',array('enc_user_id'=>$enc_user_id));    
	}
	
	public function reset_new_password()
	{
	    
	    $enc_user_id = $this->input->post('userid');
	  $data['password'] = md5($this->input->post('newpassword'));
	    $user_id = $this->decode($enc_user_id);
	    
	    $this->common_model->updateUserData($data,$user_id);

	    //echo $this->db->last_query(); exit;
	    if($total=$this->db->affected_rows() == 1)
	    {
	    	//echo $total; exit;
	         $this->session->set_flashdata('success_msg_forgotpass_success',"Password reset successfully");
                redirect(base_url('auth/signin'));
	    }
	}

	public function thankYou(){
      

    		$this->load->view('thankyou_signup');

	}
} 
