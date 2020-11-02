	<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tenant extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// load form and url helpers
        $this->load->helper(array('form', 'url'));
         
        // load form_validation library
        $this->load->library('form_validation');
		$this->load->model('team_model');
		$this->load->model('tenant_model');
		$this->load->model('Request_model');
		$this->load->model('property_model');

		//echo 'tenantid',$this->session->userdata('owner_id'); exit;
		if($this->session->userdata('owner_id') == '')
			redirect(base_url('auth/signin'));
	}

	public function messages()
	{
		$user_id = $this->session->userdata('owner_id');
		$data['tenantProperty'] =$this->tenant_model->tenantProperty($user_id);
		$id = $data['tenantProperty']['id'];
		// print_r($id);
		// exit();

		$data['popuptype']='iframe';
		$data['tenantMessageData'] =$this->team_model->getTenantUserMessage($id);

		// print_r($data['tenantMessageData']);
		// exit();

		$data['activeclass']	=	'message';

		$this->load->view('common/header');
		$this->load->view('common/sidemenu',$data);
		$this->load->view('tenant_show_message',$data);
		$this->load->view('common/footer' ,$data);
	}


	public function addMessage()
	{	

		$user_id = $this->session->userdata('owner_id');
		$data['tenantProperty'] =$this->tenant_model->tenantProperty($user_id);
		$id = $data['tenantProperty']['id'];
		// print_r($id);

		$data['tenantData'] =$this->team_model->getTenantUserId($id);
		// print_r($data['tenantData']);
		// exit();

		$this->load->view('common/popup_header');
		//$this->load->view('common/sidemenu',$data);
		$this->load->view('tenant_user_message_popup',$data);
		$this->load->view('common/popup_footer',$data);
		$this->load->view('common/googlemap',$data);

	}

	public function saveTenantMessageData($id)
	{
		$owner_id = $this->session->userdata('owner_id');
		// print_r($owner_id );
		if(!empty($_POST))
		{
			$message=	trim($this->input->post('message'));
			$message_tenant = '1';
			// print_r($_POST);
			// exit();
            	
			$requestData = array(
				
				'tenant_id'         =>$id,
				'message'           =>$message,
				'message_by_tenant' =>$message_tenant
			);
			// print_r($requestData);
			// exit();

			 $this->team_model->saveTenantMessage($requestData);
			// print($id);
			// exit();

			$userdata['getParentID'] = $this->tenant_model->getTenantUserId($owner_id);
			$parent_id = $userdata['getParentID']['parent_user_id'];

			// print_r($userdata['getParentID']);
			// exit();

			$userdata['usermessage'] = $this->tenant_model->getTenantParentUserId($parent_id);
			$email=$userdata['usermessage']['email'];
			$firstname=$userdata['usermessage']['firstname'];
			$user= $this->session->userdata('firstname');

			$data = array
			(
				'admin'=>ucfirst($user),
				'email'=>$email,
				'message'=>$message
			);
			$email_type='Tenant_send_New_Message';
			// print_r($data);
			// exit();

			$this->common_model->send_mail($email,$email_type,$data);
		}
		redirect(base_url('tenant/messages'));

	}

	

	public function tenant_docs()
	{

		$user_id = $this->session->userdata('owner_id');
		$data['tenantData'] =$this->tenant_model->tenantProperty($user_id);
		$id = $data['tenantData']['id'];

	
		
		$data['tenantdocs'] = $this->getgovtImages($id);
		$data['tenantrenterdocs'] = $this->getrenterImages($id);
		$data['tenantdocumentsdocs'] = $this->getDocumentImages($id);
		// print_r($data['tenantdocumentsdocs']);
		// exit();

      	$data['activeclass']='termsanddocs';
		$this->load->view('common/header');
		$this->load->view('common/sidemenu',$data);
		$this->load->view('tenant_all_docs',$data);
		$this->load->view('common/footer',$data);

	}

	public function requests($status ='Open',$propertyid=0)
	{
		//exit('kiki');
		$owner_id = $this->session->userdata('owner_id');
		// print_r($owner_id);
		$data['tenantData'] = $this->tenant_model->getTenantProUnitData();
		$ownerData 			= $data['tenantData']['owner_id'];
		$property_id 		= $data['tenantData']['property_id'];
		$unit_id 			= $data['tenantData']['unit_id'];

		/*echo '<pre>';
		print_r($data); exit;
*/
		$data['requestdata'] = $this->tenant_model->getRequestData($property_id,$unit_id, $ownerData);

		/*print_r($data['requestdata']);
		exit();
*/
		/*$service_id = $data['requestdata']['service_id'];

		$data['propertyData'] = $this->common_model->getPropertyData($property_id);


		$data['unitData'] = $this->common_model->getUnitData($unit_id);	

		
		$data['serviceData'] = $this->common_model->getServiceData($service_id);
*/
		
		$data['services']	=	$this->common_model->getServices();


/*		$data['propertydata'] = $this->property_model->getPropertyData();
*/		


		$data['activeclass']	=	'maintenance';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('tenant_maintanance_view',$data);

		$this->load->view('common/footer',$data);

	}


	public function edit_request($maintenance_id,$property_ownerid)
	{	

		$owner_id = $this->session->userdata('owner_id');

      	$data =array();

      	if(!empty($_POST))

		{

			
			$request_text=	$this->input->post('request_text');

			$description_text=	$this->input->post('description_text');

			$service_id	 =	$this->input->post('service_id');

			// print_r($_POST);
			// exit();			
			$updatedata =(

				array('id'=> $maintenance_id,'request_text'=>$request_text,'description_text'=>$description_text,'service_id' =>$service_id));

		
			$this->Request_model->updatemaintenancedetails($updatedata);

		

			redirect(base_url('owner/edit_request/'.$maintenance_id.''));

		}



		
		$workerServicesData =$this->team_model->getSingleSelectServices($maintenance_id);
		// print_r($workerServicesData);
		// exit();
		


		$services_giving_array = array();

		if(!empty($workerServicesData) && count($workerServicesData)>0)

		{

			foreach($workerServicesData as $worker_service_data)

			{

				 $services_giving_array[] = $worker_service_data['service_id'];

			}

		}

		$data['workerservices'] = $services_giving_array;
		// print_r($data['workerservices']);
		// exit();

    	
    	$getMaintenanceData['maintenanceRequest'] = $this->Request_model->getMaintenanceData($maintenance_id);
    	


    	$data['requestbasicinfo'] = $this->Request_model->getRequestTenantinfo($maintenance_id,$property_ownerid);
    	//echo $this->db->last_query(); exit;
    	//echo '<pre>';
    	//print_r($data['requestbasicinfo']); exit;


    	$getUnitId = $data['requestbasicinfo']['unit_id'];


    	$data['getunit'] = $this->common_model->getUnitData($getUnitId);
    	//exit('122');

    	






	 	$data['userdataworkorder'] = $this->Request_model->getUserDataWorkOrder();

    	$data['getworkorders'] = $this->Request_model->getWorkOrder($maintenance_id);

    	$data['getUpdateReqest'] = $this->Request_model->getUpdateReqest($maintenance_id);

    	//print_r($data['getUpdateReqest']); exit;

    	$data['userdata'] = $this->Request_model->getOwnerRequest();

    	$data['services']=$this->common_model->getServices();

    	//show image



  		$data['requestdocs'] = $this->getRequestImages($maintenance_id);

  		//print_r($data['requestdocs']); exit;


      	$data['activeclass']='maintenance';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('maintenance_tenant_request_view',$data);

		$this->load->view('common/footer',$data);



	}

	public function get_cotenants()
	{
		
		$tenant=$this->team_model->gettenantId($this->session->userdata('owner_id'));
		$tenant_id=$tenant['id'];
		$data['cotenants'] = $this->team_model->getCoTenant($tenant_id);
      	$data['activeclass']='cotenants';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('cotenants_view',$data);

		$this->load->view('common/footer',$data);		
	}

	public function getRequestImages($id)

	{

		return $this->tenant_model->getTenantdocumentDocs($id);

	}

	public function requestUpdateForm()

	{


		$maintenance_id 	=	$this->input->post('maintenance_id');

		$update 		=	$this->input->post('update_content');
		$owner_id 		=	$this->session->userdata('owner_id');
		$column 		=	'tenant_id';



	

		$isupdate_found 	=	$this->Request_model->requestUpdateForm(array('maintenance_id'=>$maintenance_id,
			'postedby'=>$owner_id,
			'update_content'=>$update,'column'=>$column));

		



		if(!$isupdate_found)

		{

			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>'has already been taken'));

		}

		else

		{


			// mail starts
			$userdata['getParentID'] = $this->tenant_model->getTenantUserId($owner_id);
			$parent_id = $userdata['getParentID']['parent_user_id'];

			// print_r($userdata['getParentID']);
			// exit();

			$userdata['usermessage'] = $this->tenant_model->getTenantParentUserId($parent_id);
			$email=$userdata['usermessage']['email'];
			$firstname=$userdata['usermessage']['firstname'];
			$user= $this->session->userdata('firstname');

			$data = array
			(
				'admin'=>ucfirst($user),
				'email'=>$email,
				'message'=>$update
			);
			$email_type='Tenant_send_New_Message';
			// print_r($data);
			// exit();

			$this->common_model->send_mail($email,$email_type,$data);
			// mail ends

			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}

	}

	public function addRequest()

	{

			

		 $data['tenantData'] = $this->tenant_model->getTenantProUnitData();

			// print_r($data['tenantData']);
		  $id = $data['tenantData']['id'];
		 $property_id = $data['tenantData']['property_id'];

		 $unit_id = $data['tenantData']['unit_id'];

		  $firstname = $data['tenantData']['firstname'];
		  $email = $data['tenantData']['email'];
		 $ownerData = $data['tenantData']['owner_id'];
			
		

		if(!empty($_POST))

		{

			$service_id	 =	$this->input->post('service_id');

			$request	=	$this->input->post('request_text');

			$description_text=	$this->input->post('description_text');

			// print_r($_POST);

			// exit();



				

			$requestData = array(

				'property_id'=>$property_id,

				'unit_id'=>$unit_id,

				'service_id'=>$service_id,

				'description_text'=>$description_text,

				'request_text'=>$request,

				'owner_id'=>$ownerData,
				'created_tenant_id'=> $id
			);
			// print_r($requestData);

			// exit();

			$requestid = $this->tenant_model->saveTenantDta($requestData);

			// print($requestid);

			// exit();
			$refData = array(

				'ref_id'=>"00000".$requestid

			);
			
			// print_r($data['ref_id']);
			// exit();
			$this->Request_model->updateTask($requestid,$refData);
 			// 	print_r($requestid);
			// exit;

			$propertyData['propertyData'] = $this->common_model->getPropertyData($property_id);

			$address = $propertyData['propertyData']['address'];

			$unitData['unitData'] = $this->common_model->getUnitData($unit_id);

			$unitid = $unitData['unitData']['unit'];


			$serviceData['serviceData'] = $this->common_model->getServiceData($service_id);



			$servicename = $serviceData['serviceData']['name'];

			$data['adminDetails'] = $this->tenant_model->getAdminData($ownerData);
			$admin = $data['adminDetails']['firstname'];

			$data = array
			(
				'owner'=>ucfirst($firstname),

				'user'=>ucfirst($admin),

				'address'=>$address,

				'unit'=>$unitid,

				'services'=>$servicename,

				'description_text'=>$description_text,

				'request_text'=>$request,

				'ref_id'=>"00000".$requestid,
				'id'=>$id

			);

			$email_type='tenant_request_msg';
			// print_r($data);
			// exit();

			$this->common_model->send_mail($email,$email_type,$data);
		}

		redirect(base_url('tenant/requests/'));



	}


	public function getDocumentImages($id)
	{
		return $this->tenant_model->getTenantdocumentDocs($id);
	}

	public function tenant_document_doc_uploadAndDelete()
	{
		$target_dir = "upload/request_doc/";
		$request = 'FILEUPLOAD';

		if(isset($_POST['request']))
		{ 
			$request = $_POST['request'];		
		}
		// Upload file
		if($request == 'FILEUPLOAD')
		{
			$maintenance_id = $this->input->post('tenant_doc_id');
			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$maintenance_id); 
			$target_file = $target_dir .''.$newFilename;
			$msg = ""; 
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				{
			 		$userid = $this->saveTenantdocumentDetails($newFilename,$this->session->userdata('owner_id'), $maintenance_id);
					echo json_encode(array('filename'=>$newFilename,'user_id'=>$userid));
				}
				else
				{    
					$msg = "Error while uploading"; 
				} 
				echo $msg;
				exit;
		}
		// REMOVE THE FILE
		if($request == 'REMOVEFILE')
		{ 
			$id=$_POST['user_id'];
			$filename=$_POST['name'];
			$this->deleteTenantdocumentDetails($filename,$this->session->userdata('owner_id'), $maintenance_id);
			$filename = $target_dir.$_POST['name'];  
			unlink($filename); 
			exit;
		}
	}

	
	public function saveTenantdocumentDetails($newFilename,$tenant_id, $maintenance_id)
	{
		return $this->tenant_model->saveTenantdocumentDetails($newFilename,$tenant_id,$maintenance_id);
	}
	public function deleteTenantdocumentDetails($newFilename,$tenant_id, $maintenance_id)
	{
		$this->tenant_model->deleteTenantdocumentDetails($newFilename,$tenant_id, $maintenance_id);	
	}


	public function getrenterImages($id)
	{
		return $this->tenant_model->getTenantrenterDocs($id);
	}


	public function tenant_renter_doc_uploadAndDelete()
	{
		$target_dir ="upload/renter_doc/";
		$request = 'FILEUPLOAD';

		if(isset($_POST['request']))
		{ 
			$request = $_POST['request'];		
		}
		// Upload file
		if($request == 'FILEUPLOAD')
		{
			$id = $this->input->post('tenant_doc_id');
			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$id); 
			$target_file = $target_dir .''.$newFilename;
			$msg = ""; 
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				{
			 		$userid = $this->saveTenantRenterDetails($newFilename,'tenant',$id);
					echo json_encode(array('filename'=>$newFilename,'user_id'=>$userid));
				}
				else
				{    
					$msg = "Error while uploading"; 
				} 
				echo $msg;
				exit;
		}
		// REMOVE THE FILE
		if($request == 'REMOVEFILE')
		{ 
			$id=$_POST['user_id'];
			$filename=$_POST['name'];
			$this->deleteTenantRenterDetails($id,$filename);
			$filename = $target_dir.$_POST['name'];  
			unlink($filename); 
			exit;
		}
	}

	
	public function saveTenantRenterDetails($newFilename,$type,$id)
	{
		return $this->tenant_model->saveTenantRenterDetails($newFilename,$type,$id);
	}
	public function deleteTenantRenterDetails($id,$filename)
	{
		$this->tenant_model->deleteTenantRenterDetails($id,$filename);	
	}


	public function getgovtImages($id)
	{
		return $this->tenant_model->getTenantDocs($id);
	}


	public function tenant_govt_doc_uploadAndDelete()
	{
		$target_dir ="upload/govt_doc/";
		$request = 'FILEUPLOAD';

		if(isset($_POST['request']))
		{ 
			$request = $_POST['request'];		
		}
		// Upload file
		if($request == 'FILEUPLOAD')
		{
			$id = $this->input->post('tenant_doc_id');
			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$id); 
			$target_file = $target_dir .''.$newFilename;
			$msg = ""; 
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				{
			 		$userid = $this->saveTenantFileDetails($newFilename,'tenant',$id);
					echo json_encode(array('filename'=>$newFilename,'user_id'=>$userid));
				}
				else
				{    
					$msg = "Error while uploading"; 
				} 
				echo $msg;
				exit;
		}
		// REMOVE THE FILE
		if($request == 'REMOVEFILE')
		{ 
			$id=$_POST['user_id'];
			$filename=$_POST['name'];
			$this->deleteTenantFileDetails($id,$filename);
			$filename = $target_dir.$_POST['name'];  
			unlink($filename); 
			exit;
		}
	}

	
	public function saveTenantFileDetails($newFilename,$type,$id)
	{
		return $this->tenant_model->saveTenantFileDetails($newFilename,$type,$id);
	}
	public function deleteTenantFileDetails($id,$filename)
	{
		$this->tenant_model->deleteTenantFileDetails($id,$filename);	
	}


	
	 
	public function renameFile($orgName,$id)
	{
		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'prop_'.$id;
		$extArr = explode('.',$orgName);
		$ext=end($extArr);
		return $newFilename.'.'.$ext;
	}
	
	
	public function settings()
	{
		$id = $this->session->userdata('owner_id');
		// print_r($id);
		// exit();
		$data['popuptype']='iframe';
		$data['getTenantSettings'] =$this->tenant_model->getTenantSettings($id);
		// print_r($data['getTenantSettings']);
		// exit();


		$data['activeclass']	='settings';

		$this->load->view('common/header');
		$this->load->view('common/sidemenu',$data);
		$this->load->view('tenant_setting',$data);
		$this->load->view('common/footer' ,$data);
	}

	public function updateSettings()
	{
		if(!empty($_POST))
			{
				
					$id =	$this->input->post('user_id');
					$firstname=	$this->input->post('firstname');
					$mobile=	$this->input->post('mobile');
					$lastname=	$this->input->post('lastname');
					$address=	$this->input->post('address');
					$city	=	$this->input->post('city');
					$state=	$this->input->post('state');
					$zip=	$this->input->post('zip');
					
				
					// print_r($_POST);
					// print_r($id);
					// exit();
					$registerData =(
						array('firstname'=>$firstname,'lastname'=>$lastname,'mobile'=>$mobile,'address'=>$address));
					// print_r($registerData);
					// exit();
					
					 $this->team_model->updateTenantuserData($registerData,$id);
					 //echo $this->db->last_query();


					$registerDataTenant =(
						array('firstname'=>$firstname,'lastname'=>$lastname,'mobile'=>$mobile,'address'=>$address,'city'=>$city,'state'=>$state,'zip'=>$zip));
					// print_r($registerDataTenant);
					// exit();
					$this->team_model->updateTenantInviteData($registerDataTenant,$id);
					//echo $this->db->last_query(); exit;
					$this->session->set_userdata('firstname',$firstname);
					
			}
		
			redirect(base_url('tenant/settings'));
	}



	

	

	
	 
}
