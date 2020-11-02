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
	
		if(!empty($_POST))

		{

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
                
				

				$getUserData['usertype'] = $this->common_model->getUserData($id);

				$user = $getUserData['usertype']['user'];

			



				$data = array

				(

					'user'=>ucfirst($user),

					'email'=>$email,

				);

				$email_type='registration_email';

				

				$this->common_model->send_mail($email,$email_type,$data);

				redirect(base_url('auth/signin'));			

		}

		$this->load->view('signup_view');



	}	



	public function registerApplicationTenannt($id)

	{

		$data =array();

		$data['tenantdata'] = $this->common_model->tenantData($id);

		$email = $data['tenantdata']['email'];

		$user_id = $data['tenantdata']['user_id'];



		$owner_id = $this->session->userdata('owner_id');

	


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

						'user'=>ucfirst($user),

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




				$this->session->set_userdata($sessionData);
				

		
				if ($this->session->userdata('user_type')==2) {

					redirect(base_url('tenant/messages'));

				}else{

					redirect(base_url('owner/properties'));

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

	

				$password=	md5($this->input->post('password'));

				

				$registerData =(array('password' =>$password));



				$this->team_model->editTeamData($registerData,$worker_id);

				 

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



		$id = $this->common_model->getUserByEmail($email);


		if(!$id)

		{

			$this->session->set_flashdata('error_msg',"Email not found!");

			redirect(base_url('auth/forgotpassword'));

		}

		else

		{	



			$getUserData['usertype'] = $this->common_model->getUserData($id);
		
      
			$user = $getUserData['usertype']['user'];

		

			$password = date('Ymdhis');

			


			$userData = array(

								'password'=>md5($password)

								);


			

			$this->common_model->updateUserData($userData,$id);



			$data = array

			(

				'user'=>ucfirst($user),

				'email'=>$email,

				'password'=>$password

			);

			$email_type='forget_password';

		



			$this->common_model->send_mail($email,$email_type,$data);

			$this->session->set_flashdata('success_msg',"Check Your Email Inbox, we sent an email!");

			redirect(base_url('auth/forgotpassword'));

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

} 
