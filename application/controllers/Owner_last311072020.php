<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Owner extends CI_Controller

{
	public function __construct()

	{

		parent::__construct();
 
		$this->load->library('session'); 

        $this->load->helper('form'); 
        $this->load->helper('custom');

		$this->load->model('auth_model');
		$this->load->model('Common_model');
		$this->load->model('team_model');

		$this->load->model('property_model');

		$this->load->model('Request_model');
			

		if($this->session->userdata('owner_id') == '')
			redirect(base_url('auth/signin'));

	}



	public function index()

	{
  
		

	}

	// Dashboard
	public function dashboard()

	{

		$subscription_status = check_subscription($this->session->userdata('owner_id'));
		if($subscription_status=='subscriptions_next')
		{
			redirect(base_url('owner/subscriptions_next'));
		}
		
		$owner_id = $this->session->userdata('owner_id');

				$data['activeclass']	=	'dashboard';

		 $data['maintainence_count'] = $this->property_model->maintainence_count();
		 $data['tenant_count'] = $this->property_model->tenant_count();
		 
		
		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);


		$this->load->view('dashboard_view',$data);
		

		$this->load->view('common/footer',$data);

	}

	public function properties($status='Open',$propertyid=0)

	{

		$subscription_status = check_subscription($this->session->userdata('owner_id'));
		if($subscription_status=='subscriptions_next')
		{
			redirect(base_url('owner/subscriptions_next'));
		}
		
		$owner_id = $this->session->userdata('owner_id');



		 
		 

		$data['status'] = 1;

		$data['property_id'] =$propertyid;

		$status = ucfirst($status);

		
		if($status =="Close")
		{	
			$data['status'] =0;
			
		}

		
		$units = $this->property_model->getPropertiesWithUnits();
	

		$combineUnits = array();
		foreach($units as $unit)
		{

			$combineUnits[$unit['id']][] = array('unit'=>$unit['unit'],'address'=>$unit['address']);

		}
		
		$data['properties'] = $this->property_model->getProperties($status);


		$data['prodata'] = $this->property_model->getRequestData($status);
		
		for($i=0;$i<count($data['properties']);$i++)
		{
			 $data['properties'][$i]['maintaince_count'] = $this->property_model->getManitenenceOpen($data['properties'][$i]['id']);

		}


		$data['propertydata'] = $this->property_model->getAllPropertyData();

		$data['popuptype']='iframe';

		$data['combineUnits'] 	=	$combineUnits;

		$data['activeclass']	=	'properties';

		$data['paymentDetails'] = $this->property_model->chackPaymentDetails();


		$data['property'] =  $this->property_model->getProperty();

		//echo $this->db->last_query(); exit;
		//print_r($data['property']); exit;

		$data['propertyOpen'] =  $this->property_model->getPropertyOpen();
		
		


		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);


		$this->load->view('owner_properties_view',$data);
		

		$this->load->view('common/footer',$data);

		
	}

	public function subscriptions_next()
	{
		$data['activeclass']	=	'';
		// get the plan detalils
		$data['plan_details'] = $this->common_model->getPlanDetails($this->session->userdata('owner_id'));
		$data['units'] = $unit_purchased=$this->common_model->check_units_purchased($this->session->userdata('owner_id'));

		$units_consumed = $this->common_model->units_consumed($this->session->userdata('owner_id'));

		//echo $unit_purchased['units_purchased']; exit;
		$available_units = ($unit_purchased['units_purchased'])-$units_consumed['unit_consumed']; 

		$units_can_purchase = 1;
		// all unit consumed
		if($units_consumed['unit_consumed']>1)
		{
			$units_can_purchase = $units_consumed['unit_consumed'];
		}
		$data['units_can_purchase'] = $units_can_purchase;
		$data['units_initial_purchase'] = $unit_purchased['units_purchased'];

		$this->load->view('common/header');
		$this->load->view('common/sidemenu',$data);
		$this->load->view('subscription_next_view');
		$this->load->view('common/footer',$data);
	}



	public function subscriptions_prompt_next()
	{
		if(!empty($_POST))
		{
			$trialunit_amount = $this->input->post('trialunitamount');
			$trialunit 		  = $this->input->post('trialunit');
			$perunitprice 		  = $this->input->post('perunitprice');
			$baseprice 		  = $this->input->post('baseprice');
			$this->common_model->freeSubscription($this->session->userdata('owner_id'),$trialunit,$trialunit_amount,$perunitprice,$baseprice);
			redirect(base_url('owner/properties'));

		}
		$data['activeclass']	=	'';
		// get the plan detalils
		$data['plan_details'] = $this->common_model->getPlanDetails();
		//$data['units'] = $this->common_model->check_units_purchased($this->session->userdata('owner_id'));
		$this->load->view('common/header');
		//$this->load->view('common/sidemenu',$data);
		$this->load->view('subscription_free_view',$data);
		$this->load->view('common/footer',$data);
	}



	public function addProperty()

	{	



    	$data['userdata'] =  $this->Request_model->getOwnerRequest();

    	 $data['lat']= $this->config->item('latitude');

		 $data['lng']= $this->config->item('longitude');





		$this->load->view('common/popup_header',$data);

		

		$this->load->view('add_property_popup',$data);

		$this->load->view('common/popup_footer',$data);
		$this->load->view('common/googlemap',$data);

	}


	// units for new tenant add

	public function getPropertyUnit()

	{

		$property_id  =	$this->input->post('property_id');

			
			$combineUnits = array();

			$propertyUnits = $this->property_model->getPropertiesUnits($property_id);
			

			if(!empty($propertyUnits) && count($propertyUnits)>0)

			{

				

					foreach($propertyUnits as $unit)

					{
						//echo $unit['id']; 
						 $query= $this->db->get_where('onelane_property_tenant',array('property_id'=>$property_id,'unit_id'=>$unit['id'],'owner_id'=>$this->session->userdata('owner_id')));

						// echo $this->db->last_query(); 
						 if(!$query->num_rows())
						 {
						 	//$units = $query->row_array();
						 //	echo $query->num_rows(),'raj',$unit['unit'];
						 	$combineUnits[$unit['id']] = $unit['unit'];

						 }
						 

					}

			}

			echo json_encode($combineUnits);

	}


	public function getPropertyUnits()

	{
          
		$property_id  =	$this->input->post('property_id');

			
			$combineUnits = array();

			$propertyUnits = $this->property_model->getPropertiesUnits($property_id);
			

			if(!empty($propertyUnits) && count($propertyUnits)>0)

			{

				

					foreach($propertyUnits as $unit)

					{

						$combineUnits[$unit['id']] = $unit['unit'];

					}

			}

			echo json_encode($combineUnits);

	}

	

	



	public function getImages($property_id)

	{

		return $this->property_model->getPropertyDocs($property_id);

	}



	public function property_basicinfo($property_id = NULL,$current_tab='')

	{

		$is_agent_property = $this->property_model->checkAgentProperty($property_id);
		if(!$is_agent_property)
		{

			//exit('888');
			redirect(base_url('owner/properties'));
		}
		$data['activeclass']	=	'properties';
		
		if(!empty($_POST))

		{

			$address				=	$this->input->post('address');

			$lat				=	$this->input->post('lat');

			$lng				=	$this->input->post('lng');

			$timezone				=	$this->input->post('timezone');

			$maintenance_threshold	=	$this->input->post('maintenance_threshold');

			$notes					=	$this->input->post('notes');

			$propertymanager_name	=	$this->input->post('propertymanager_name');

			$propertymanager_email	=	$this->input->post('propertymanager_email');

			$propertymanager_phone	=	$this->input->post('propertymanager_phone');

			

			$units = $this->property_model->saveProperty(

			array('address'=>$address,

				'lat'=>$lat,

				'lng'=>$lng,

				'timezone'=>$timezone,

				'maintenance_threshold' => $maintenance_threshold,

				'notes'=>$notes,

			'propertymanager_name'=>$propertymanager_name,

			'propertymanager_email'=>$propertymanager_email,

			'propertymanager_phone'=>$propertymanager_phone));

		

			redirect(base_url('owner/properties'));

		}



		
		// check for agent user 
		//$agent_id = $this->session->userdata('agent_id') ? $this->session->userdata('agent_id'): '';
		/*if($agent_id > 0)
		{
			$propertyData 	= $this->property_model->getProperties($agent_id);	
		}
		else
		{
			$propertyData 	= $this->property_model->getProperties($property_id);	
		}*/

		$propertyData 	= $this->property_model->getProperties($property_id);	
		$data['propertyAllData'] = $this->property_model->getAllPropertyData();

		
		

		$propertyUnits  = $this->property_model->getPropertiesUnits($property_id);

		

		$units = $this->property_model->getPropertiesWithUnits();

		$combineUnits = array();



		foreach($units as $unit)

		{

			$combineUnits[$unit['id']][] = array('unit'=>$unit['unit'],'address'=>$unit['address']);

		}

		$data['combineUnits'] 	=	$combineUnits;

		$data['propertyData'] 	=	$propertyData;

		 $data['lat']= $data['propertyData']['lat'];

		 $data['lng'] = $data['propertyData']['lng'];

		 $data['address'] = $data['propertyData']['address'];



	

		$data['propertyUnits']	=	$propertyUnits;

		$data['current_tab']	=	$current_tab;



		$data['propertydocs'] = $this->getImages($property_id);

        $data['uri'] = $this->uri->segment(3);



		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('owner_property_basicinfo_view',$data);

		$this->load->view('common/footer',$data);


	}

	public function property_basicinfo_unit($property_id = NULL,$current_tab='',$status=1)
	{
		$owner_id = $this->session->userdata('owner_id');

		$data['status'] = 1;

		$data['property_id'] =$property_id;

		$status = ucfirst($status);

		
		if($status == 0)
		{	
			$data['status'] =0;
		
		}

		$data['activeclass']	= 'properties';
		

		$propertyData 	= $this->property_model->getProperties($property_id);


		$data['propertyAllData'] = $this->property_model->getAllPropertyData();

		
		$propertyUnits  = $this->property_model->getPropertiesUnitsStatus($property_id,$status);

		
		$units = $this->property_model->getPropertiesWithUnits();

		$combineUnits = array();


		foreach($units as $unit)

		{

			$combineUnits[$unit['id']][] = array('unit'=>$unit['unit'],'address'=>$unit['address']);

		}

		$data['combineUnits'] 	=	$combineUnits;

		$data['propertyData'] 	=	$propertyData;

		$data['propertyUnits']	=	$propertyUnits;

		$data['current_tab']	=	$current_tab;



		$data['propertydocs'] = $this->getImages($property_id);



		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('owner_property_basicinfo_unit_view',$data);

		$this->load->view('common/footer',$data);


	}


	public function editproperty_basicinfo()
	{


		if(!empty($_POST))
		{
		$property_id 				=	$this->input->post('property_id');

		$address 					=	$this->input->post('address');
     
		$lat 					    =	$this->input->post('lat');

		$lng 					    =	$this->input->post('lng');

		$timezone					=	$this->input->post('timezone');

		$maintenance_threshold	    =	$this->input->post('maintenance_threshold');

		$notes 						=	$this->input->post('notes');

		$propertymanager_name		=	$this->input->post('propertymanager_name');

		$propertymanager_email		=	$this->input->post('propertymanager_email');

		$propertymanager_phone		=	$this->input->post('propertymanager_phone');

		


		$this->property_model->editproperty_basicinfo(array('address'=>$address,

			'lat'=>$lat,

			'lng'=>$lng,

			'timezone'=>$timezone, 

			'maintenance_threshold'=>$maintenance_threshold, 

			'notes'=>$notes,

		'property_id'=>$property_id,

		'propertymanager_name'=>$propertymanager_name,

		'propertymanager_email'=>$propertymanager_email,

		'propertymanager_phone'=>$propertymanager_phone));

		redirect('owner/property_basicinfo/'.$property_id.'/basic-info');

		}

	}



	public function addUnitToProperty()
	{


		//echo strlen(trim($unit)); exit;

		$property_id 	=	$this->input->post('property_id');

		$unit 			=	trim($this->input->post('unit'));

		$isunit_found 	=	$this->property_model->addUnitToProperty(array('property_id'=>$property_id,

			'unit'=>$unit));

     
		/*if(!$isunit_found)

		{

			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>'Unit Already Exist!')); exit;

		}

		else

		{

			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}*/
		if($isunit_found['rescode'] == 100)
		{
			$purchase_link = "<a href='".base_url('payment/purchase_unit')."'>Units Consumed, Purchase more! Click Here</a>";
			echo json_encode(array('code'=>'UNITCONSUMED','msg'=>$purchase_link)); exit;	
		}

		elseif($isunit_found['rescode'] == 200)
		{
			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>'Unit Already Exist!')); exit;	
		}
		
		elseif($isunit_found['rescode'] == 300)
		{
			echo json_encode(array('code'=>'NOTEXISTS','msg'=>'')); exit;	
		}
	}

				
	public function updateUnitToProperty()

	{

		$property_id 	=	$this->input->post('property_id');


		$unit 			=	trim($this->input->post('unit'));

		$status 	=     $this->input->post('status');

		$id 			=	$this->input->post('id');
		$familyhome_status 			=	$this->input->post('familyhome_status');

		

		$isunit_found 	=	$this->property_model->updateUnitToProperty(array('property_id'=>$property_id,'status'=>$status,'id'=>$id,

			'unit'=>$unit,'familyhome_status'=>$familyhome_status));

		

		if(!$isunit_found)

		{

			echo json_encode(array('code'=>'0','msg'=>'Unit Already Exist!'));

		}

		else

		{

			echo json_encode(array('code'=>'1','msg'=>' Unit  Updated Successfully!'));	

		}

	}



	public function property_doc_uploadAndDelete()

	{

		$target_dir = "upload/property_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

	

		if($request == 'FILEUPLOAD')

		{

			$pro_id = $this->input->post('property_doc_id');

			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$pro_id); 

			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$proid = $this->saveFileDetails($newFilename,'prop',$pro_id);

					echo json_encode(array('filename'=>$newFilename,'proid'=>$proid));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;

		}

		

		if($request == 'REMOVEFILE')

		{ 

			$property_id=$_POST['property_id'];

			$filename=$_POST['name'];

			$this->deleteFileDetails($property_id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}

	}



	

	public function tenant_doc_uploadAndDelete()
	{

		$target_dir = "upload/tenant_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

	
		if($request == 'FILEUPLOAD')

		{

			$id = $this->input->post('tenant_doc_id');

			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$id); 

			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$userid = $this->saveTenantFileDetails($newFilename,'tenant',$id);

					echo json_encode(array('filename'=>$newFilename,'tenant_id'=>$userid));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 


				echo $msg;

				exit;

		}


		if($request == 'REMOVEFILE')

		{ 

			$id=$_POST['tenant_id'];

			$filename=$_POST['name'];

			$this->deleteTenantFileDetails($id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}


	}


	public function saveTenantFileDetails($newFilename,$type,$id)

	{

		return $this->property_model->saveTenantFileDetails($newFilename,$type,$id);

	}

	public function deleteTenantFileDetails($id,$filename)

	{

		$this->property_model->deleteTenantFileDetails($id,$filename);	

	}


	public function renameFile($orgName,$id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'prop_'.$id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return $newFilename.'.'.$ext;

	}



	public function saveFileDetails($newFilename,$type,$pro_id)

	{

		return $this->property_model->saveFileDetails($newFilename,$type,$pro_id);

	}

	public function deleteFileDetails($pro_id,$filename)

	{

		$this->property_model->deleteFileDetails($pro_id,$filename);	

	}


	public function editproperty_guide($property_id)

	{

		

      $data =array();

      $propertyData 	= $this->property_model->getProperties($property_id);
      $data['propertyAllData'] = $this->property_model->getAllPropertyData();
      $data['propertyGuide'] = $this->property_model->getPopertyGuideData($property_id);

    

  		

  		if(!empty($_POST))

		{

			$watergarbage =	$this->input->post('watergarbage');

			$gaselectricity	=	$this->input->post('gaselectricity');

			$keys					=	$this->input->post('keys');

			$hoacommunity	=	$this->input->post('hoacommunity');

			$mail	=	$this->input->post('mail');

			$internettv	=	$this->input->post('internettv');

			$miscnotes	=	$this->input->post('miscnotes');



			

		

			$update_data = array(

				'watergarbage'=>$watergarbage,

				'gaselectricity'=>$gaselectricity,

				'keys'=>$keys,

				'hoacommunity'=>$hoacommunity,

				'mail'=>$mail,

				'internettv'=>$internettv,

				'miscnotes'=>$miscnotes,

				'id' =>$property_id,

				'owner_id' => $this->session->userdata('owner_id'));

			




			$this->property_model->updatePropertyGuideData($update_data);


		}

		$data['propertyData'] 	=	$propertyData;

		

		$data['propertyGuide'] = $this->property_model->getPopertyGuideData($property_id);


  		$data['propertyguidedocs'] = $this->getPropertyGuideImages($property_id);

  		




      $data['activeclass']	='properties';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('owner_property_guide_view',$data);

		$this->load->view('common/footer',$data);



	}
	public function property_guide_doc_uploadAndDelete()

	{

		$target_dir = "upload/property_guide_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

		

		if($request == 'FILEUPLOAD')

		{

			$pro_id = $this->input->post('property_guide_doc_id');

			$newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$pro_id); 

			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$proid = $this->saveFilePropertyGuideDetails($newFilename,'prop',$pro_id);

					echo json_encode(array('file_name'=>$newFilename,'id'=>$pro_id));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;

		}

		

		if($request == 'REMOVEFILE')

		{ 

			$pro_id=$_POST['id'];

			$filename=$_POST['name'];

			$this->deleteFilePropertyGuideDocs($pro_id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}

	}







	public function saveFilePropertyGuideDetails($newFilename,$type,$pro_id)

	{

		return $this->property_model->saveFilePropertyGuideDetails($newFilename,$type,$pro_id);

	}



	public function deleteFilePropertyGuideDocs($pro_id,$filename)

	{

		echo $this->property_model->deleteFilePropertyGuideDetails($pro_id,$filename);	

	}



	public function getPropertyGuideImages($property_id)

	{

		return $this->property_model->getPropertyGuideDocs($property_id);

	}





	public function requests($status='Open',$propertyid=0)

	{

		$owner_id = $this->session->userdata('owner_id');

		$data['status'] = 1;

		$data['property_id'] =$propertyid;



		$status = ucfirst($status);

		if($status !="Open")

		{	

			$data['status'] =0;

		}	

		$requestloop = $this->Request_model->getRequestData($status,$propertyid);
		
		 $data['requestdata']=$requestloop;
			

		$data['services']=$this->common_model->getServices();

		

		$data['propertydata'] = $this->property_model->getPropertyWithUnitsData();


		$data['activeclass']	=	'maintenance';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('maintanance_view',$data);

		$this->load->view('common/footer',$data);

	}



	public function tenants($status ='Open',$propertyid=0)

	{

		$owner_id = $this->session->userdata('owner_id');

		$data['status'] = 1;

		$data['property_id'] =$propertyid;

			$data['popuptype']='iframe';

		$status = ucfirst($status);

		if($status !="Open")

		{	

			$data['status'] =0;

		}

		$data['requestdata'] = $this->Request_model->getRequestData($status,$propertyid);

		

		$data['services']=$this->common_model->getServices();

		$data['propertydata'] = $this->property_model->getPropertyData();

		$data['activeclass']	=	'tenants';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('tenants_view',$data);

		$this->load->view('common/footer',$data);

	}



	public function addRequest()

	{

		$owner_id = $this->session->userdata('owner_id');



		if(!empty($_POST))

		{

			$property_id  =	$this->input->post('property_id');

			$unit_id	=	$this->input->post('unit_id');

			$service_id	 =	$this->input->post('service_id');

			$request	=	$this->input->post('request_text');

			$description_text=	$this->input->post('description_text');

			


				

			$requestData = array('property_id'=>$property_id,

			

				'unit_id'=>$unit_id,

				'service_id'=>$service_id,

				'description_text'=>$description_text,

				'request_text'=>$request,

				'owner_id'=>$owner_id

			);



			




			$requestid = $this->Request_model->saveTask($requestData);

			

			$data['ref_id'] = "00000".$requestid;
		
			$this->Request_model->updateTask($requestid,$data);
 			
		}

		redirect(base_url('owner/requests/'));



	}

	

	public function edit_request($id)

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

				array('id'=> $id,'request_text'=>$request_text,'description_text'=>$description_text,'service_id' =>$service_id));

		
			$this->Request_model->updatemaintenancedetails($updatedata);

		

			redirect(base_url('owner/edit_request/'.$id.''));

		}



		
		$workerServicesData =$this->team_model->getSingleSelectServices($id);
		// echo "<pre>";
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
	
    	
    	$getMaintenanceData['maintenanceRequest'] = $this->Request_model->getMaintenanceData($id);
  


    	$data['requestbasicinfo'] = $this->Request_model->getRequestinfo($id);
      

    	$getUnitId = $data['requestbasicinfo']['unit_id'];

    	

    	$data['getunit'] = $this->common_model->getUnitData($getUnitId);

    	






	 	$data['userdataworkorder'] = $this->Request_model->getUserDataWorkOrder();
          


    	$data['getworkorders'] = $this->Request_model->getWorkOrder($id);
 //    	 echo "<pre>";
	// print_r($data['getworkorders']);
	// 	exit();

    	$data['getUpdateReqest'] = $this->Request_model->getUpdateReqest($id);

    	$data['userdata'] = $this->Request_model->getOwnerRequest();

    	$data['services']=$this->common_model->getServices();

    	//show image



  		$data['requestdocs'] = $this->getRequestImages($id);

  		


      	$data['activeclass']='maintenance';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);

		$this->load->view('maintenance_owner_request_view',$data);

		$this->load->view('common/footer',$data);



	}

	public function maintenance_request_printer($id)

	{	

		$owner_id = $this->session->userdata('owner_id');

      	$data =array();

      	if(!empty($_POST))

		{

			$id=	$this->input->post('id');

			$request_text=	$this->input->post('request_text');

			$description_text=	$this->input->post('description_text');

			$service_id	 			=	$this->input->post('service_id');

	

			$updatedata =(

				array('id'=> $id,'request_text'=>$request_text,'description_text'=>$description_text,'service_id' =>$service_id));

	
			$this->Request_model->updatemaintenancedetails($updatedata);

		

			redirect(base_url('owner/maintenance_request_printer/'.$id.''));

		}



		$workerServicesData = $this->team_model->getSingleContact_byservices($id);

		

		$services_giving_array = array();

		if(!empty($workerServicesData) && count($workerServicesData)>0)

		{



			foreach($workerServicesData as $worker_service_data)

			{



				 $services_giving_array[] = $worker_service_data['service_id'];

			}

		}

		$data['workerservices'] = $services_giving_array;

		

    	$data['requestbasicinfo'] = $this->Request_model->getRequestinfo($id);


	 	$data['userdataworkorder'] = $this->Request_model->getUserDataWorkOrder();

    	$data['getworkorders'] = $this->Request_model->getWorkOrder($id);

    	$data['getUpdateReqest'] = $this->Request_model->getUpdateReqest($id);

    	$data['userdata'] = $this->Request_model->getOwnerRequest();

    	$data['services']=$this->common_model->getServices();

    	


  		$data['requestdocs'] = $this->getRequestImages($id);

  		$getUnitId = $data['requestbasicinfo']['unit_id'];

    	

    	$data['getunit'] = $this->common_model->getUnitData($getUnitId);
  		

		

      	$data['activeclass']='maintenance';

		$this->load->view('common/header');

		
		$this->load->view('maintenance_owner_request_printer',$data);

		$this->load->view('common/footer',$data);



	}



	public function request_doc_uploadAndDelete()

	{

		$target_dir = "upload/request_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}


		if($request == 'FILEUPLOAD')

		{

			$request_id = $this->input->post('request_doc_id');

			$newFilename = $this->requestRenameFile(basename($_FILES["file"]["name"]),$request_id);

			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$requestid = $this->saveFileRequestDetails($newFilename,'request',$request_id);

			 		

					echo json_encode(array('file_name'=>$newFilename,'id'=>$requestid));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;

		}



		if($request == 'REMOVEFILE')

		{ 

			$request_id=$_POST['id'];

			$filename=$_POST['name'];

			$this->deleteFileRequestDetails($request_id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}

	}



	public function saveFileRequestDetails($newFilename,$type,$request_id)

	{

		return $this->Request_model->saveFileRequestDetails($newFilename,$type,$request_id);

	}



	public function deleteFileRequestDetails($request_id,$filename)

	{

		echo $this->Request_model->deleteFileRequestDetails($request_id,$filename);	

	}



	public function getRequestImages($id)

	{

		return $this->Request_model->getRequestDocs($id);

	}





	public function getRequestShowWorkOrderImage($id)

	{

		return $this->Request_model->getRequestShowWorkOrderImage($id);

	}



	public function requestRenameFile($orgName,$request_id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'request_'.$request_id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return trim(str_replace(' ','',$newFilename)).'.'.$ext;

	}



	public function getRequestById($id)

	{	



		$data['requestworkorder'] = $this->Request_model->getRequestWorkOrder($id);

	

    	$data['requestworkorder']['property_id'];
    	

    	
    	$requestServicesUserData = $this->Request_model->getPropertyServiceUsers($data['requestworkorder']['property_id']);



    	$requestOwnerData = $this->Request_model->getOwnerRequest();

    	

    


	

		$data['userdata'] = $requestOwnerData;

		$data['servicesuserdata'] = $requestServicesUserData;





		$this->load->view('common/popup_header',$data);


		$this->load->view('maintanance_work_order_popup',$data);

		$this->load->view('common/popup_footer',$data);



	}



	 public function popupworkOrderform($id)

	 {

	 	$maintenance_id = $this->input->post('id');

		if(!empty($_POST))

		{

			$maintenance_type =$this->input->post('maintenance_type');

			$id = $this->input->post('service_user_id');

			$title	 		=	$this->input->post('title');

			$main_ins=$this->input->post('maintenance_instructions');

			$uesr_id=$this->input->post('maintenance_request_user_id');
            
				

			$requestData = array(	

				'maintenance_request_user_id'=> $uesr_id,

				'maintenance_type'=>$maintenance_type,

				'service_user_id' =>$id,	

				'title'			=>$title,

				'maintenance_instructions'=>$main_ins,

				'maintenance_id'=> $maintenance_id,

			);



			


			$workorderid = $this->Request_model->requestWorkOrderSaveData($requestData);
            
            $url_work_order_details = base_url('maintenance/work_order_view/'.$workorderid.'');

			$data['work_order_ref_id'] ="WORK00".$workorderid;


			$this->Request_model->updateWorkOrder($workorderid,$data);

			$workOred= $data['work_order_ref_id'];


			$getMaintenanceData['maintenanceRequest'] = $this->common_model->getMaintenanceData($maintenance_id);

			$getPropertyId = $getMaintenanceData['maintenanceRequest']['property_id'];

			$getUnitId = $getMaintenanceData['maintenanceRequest']['unit_id'];

			$getServiceId = $getMaintenanceData['maintenanceRequest']['service_id'];



			$propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);

			$address = $propertyData['propertyData']['address'];

			$managerName = $propertyData['propertyData']['propertymanager_name'];

			if ($managerName=='') 

			{

				$managerName = $this->session->userdata('firstname');

			}

			$managerEmail = $propertyData['propertyData']['propertymanager_email'];

			if ( $managerEmail=='') {

				$managerEmail = $this->session->userdata('email');

			}

			

			$managerPhone = $propertyData['propertyData']['propertymanager_phone'];



			$unitData['unitData'] = $this->common_model->getUnitData($getUnitId);

			

			$unitid = $unitData['unitData']['unit'];





			$serviceData['serviceData'] = $this->common_model->getServiceData($getServiceId);



			$servicename = $serviceData['serviceData']['name'];

		
			

			$getUserData['usertype'] = $this->common_model->getUserData($id);

			

			$user = $getUserData['usertype']['contact_name'];

			$email= $getUserData['usertype']['email'];

		

			$firstname = $this->session->userdata('firstname');
            

			$data = array

			(

				'admin'=> ucfirst($firstname),

				'contact_name'=>ucfirst($user),

				'email'=>$email,

				'maintenance_type'=>$maintenance_type,

				'title'			=>$title,

				'maintenance_instructions'=>$main_ins,

				'address'=>$address,

				'services'=>$servicename,

				'unit'=>$unitid,

				'manager_name'=>ucfirst($managerName),

				'manager_email'=>$managerEmail,

				'manager_phone'=>$managerPhone,

				'work'=>$workOred,

				'click_here' => $url_work_order_details

			);

			$email_type='new_work_order_email';



			



			$this->common_model->send_mail($email,$email_type,$data);

		}

		redirect(base_url('owner/edit_request/'.$maintenance_id.''));

	 }



	public function workOrderDetails($id)

	{



		$owner_id = $this->session->userdata('owner_id');

      	$data =array();

      	if(!empty($_POST))

		{

			$id=	$this->input->post('id');

			$title=	$this->input->post('title');

			$instruction=	$this->input->post('maintenance_instructions');

	
               
			$updatedata =(

				array('title'=>$title,'maintenance_instructions'=>$instruction,'id'=> $id,));

		

			$this->Request_model->updateWorkOrderdetails($updatedata);

		

			redirect(base_url('owner/workOrderDetails/'.$id.''));

		}

    	$data['requestbasicinfo'] = $this->Request_model->getWorkOrderAddressUnit($id);

    	$data['requestbasicinfo']['property_id'];

    	

    	

    	$requestServicesUserData = $this->Request_model->getFinalWorkOrderAddress($data['requestbasicinfo']['property_id']);


    	$data['getworkorders'] = $this->Request_model->getWorkOrder($id);



    	$data['getfinalworkorderaddress'] = $requestServicesUserData;

    	

    	$data['workorderinfo'] = $this->Request_model->getWorkOrderInfo($id);
 
	 	$data['getupdateworkorders'] = $this->Request_model->getUpdateWorkOrder($id);

    	$data['getworkorderdetails'] = $this->Request_model->getworkorderDetails($id);

    	$data['getworkorderschedul'] = $this->Request_model->getWorkOrderSchedule($id);

    	$data['getworkorderinvoicedetails'] = $this->Request_model->getWorkOrderInvoiceDetails($id);

    	$data['popuptype']='iframe';

    	$userDataWorkOrder = $this->Request_model->getUserDataWorkOrder();
     
    	$data['userdataworkorder'] = $userDataWorkOrder;

    	$data['userdata'] = $this->Request_model->getOwnerRequest();

  		$data['requestdocs']=$this->getRequestShowWorkOrderImage($id);

  		$data['workorderdocs'] = $this->getWorkOrderImages($id);
 

      	$data['activeclass']='maintenance';

		$this->load->view('common/header');

		
		$this->load->view('maintenance_work_order_details',$data);

		$this->load->view('common/footer',$data);



	}

	public function downloadInvoice($id)

	{

		$data['downloadinvoice'] = $this->Request_model->downloadInvoice($id);

		

		if(!empty($data['downloadinvoice']['file_name'])){

		    $fileName = basename($data['downloadinvoice']['file_name']);

		    $filePath = $_SERVER['DOCUMENT_ROOT'].'/upload/workorder_Invoice_doc/'.$fileName;

		 

		    if(!empty($fileName) && file_exists($filePath)){

		      

		        header("Cache-Control: public");

		        header("Content-Description: File Transfer");

		        header("Content-Disposition: attachment; filename=$fileName");

		         header('Content-Type: application/octet-stream');

		        header("Content-Transfer-Encoding: binary");

		        


		        readfile($filePath);

		        exit;

		    }else{

		        echo 'The file does not exist.';

		    }

		}

		redirect(base_url('owner/workOrderDetails/'.$id.''));

	}

	public function workorderinstruction($id)

	{

		if(!empty($_POST))

		{

			$id=	$this->input->post('id');

			

			$user_request=	$this->input->post('maintenance_request_user_id');

		

		$updatedata =(

			array('maintenance_request_user_id'=>$user_request,'id'=> $id,));

		

		$this->Request_model->updateWorkOrderdetails($updatedata);

		

			redirect(base_url('owner/workOrderDetails/'.$id.''));

		}

	}

	public function maintenanceRequestManagedBy($id)

	{

		if(!empty($_POST))

		{

			$id=	$this->input->post('id');

			

			$user_request=	$this->input->post('maintenance_request_user_id');

		

		$updatedata =(

			array('maintenance_request_user_id'=>$user_request,'id'=> $id,));

		

		$this->Request_model->updateWorkOrderdetails($updatedata);

		

			redirect(base_url('owner/edit_request/'.$id.''));

		}

	}

	public function workOrderInvice($id)

	{

		if(!empty($_POST))

		{

			$id=	$this->input->post('id');

			

			$user_request=	$this->input->post('maintenance_request_user_id');

		
		$updatedata =(

			array('maintenance_request_user_id'=>$user_request,'id'=> $id,));

	

		$this->Request_model->updateWorkOrderdetails($updatedata);

		

			redirect(base_url('owner/workOrderDetails/'.$id.''));

		}

	}

	public function work_order_doc_uploadAndDelete()

	{

		$target_dir = "upload/workorder_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

		

		if($request == 'FILEUPLOAD')

		{

			$workorder_id = $this->input->post('workorder_id');



			$newFilename = $this->workOrderRenameFile(basename($_FILES["file"]["name"]),$workorder_id);

			
			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$requestid = $this->saveFileWorkOrderDetails($newFilename,'workorder',$workorder_id);

			 		

					echo json_encode(array('file_name'=>$newFilename,'id'=>$requestid));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;

		}

		

		if($request == 'REMOVEFILE')

		{ 

			$workorder_id=$_POST['id'];

			$filename=$_POST['name'];

			$this->deleteFileWorkOrderDetails($workorder_id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}

	}

	public function workOrderRenameFile($orgName,$workorder_id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'request_'.$workorder_id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return trim(str_replace(' ','',$newFilename)).'.'.$ext;

	}



	public function saveFileWorkOrderDetails($newFilename,$type,$workorder_id)

	{

		return $this->Request_model->saveFileWorkOrderDetails($newFilename,$type,$workorder_id);

	}



	public function deleteFileWorkOrderDetails($workorder_id,$filename)

	{

		echo $this->Request_model->deleteFileWorkOrderDetails($workorder_id,$filename);	

	}

	public function getWorkOrderImages($id)

	{

		return $this->Request_model->getWorkOrderDocs($id);

	}



	public function addUpdateToWorkOrder()

	{



		 $workorder_id 	    =	$this->input->post('workorder_id');
	     $update 		    =	$this->input->post('update_content');


		//$email 		        =	$this->input->post('workorder_email');
		//$contact_name       =	$this->input->post('contact_name');
        //$work_order_ref_id  =	$this->input->post('work_order_ref_id');

        
	
		$isupdate_found 	=	$this->Request_model->addUpdateToWorkOrder(array('workorder_id'=>$workorder_id,

			'update_content'=>$update));

        
        $data['WorkOrderUpdate'] = $this->property_model->getWorkOrderUpdate($workorder_id);
        // echo "<pre>";
        // print_r($data['WorkOrderUpdate']);
        // exit;
        //$email = '';


        foreach ($data['WorkOrderUpdate'] as $key => $value) {
        	$email = $value['email'];
        	$contact_name = $value['contact_name'];
        	$title = $value['title'];
        	$work_order_ref_id = $value['work_order_ref_id'];
            $address = $value['address'];
            $unit = $value['unit'];
            $createdat = $value['createdat'];
        }
        $url_work_order = base_url('maintenance/work_order_view/'.$workorder_id.'');
        

        $createtime = date("d M Y h:i a",strtotime($createdat));



        //print_r($contact_name);
        //exit;
        $user= $this->session->userdata('firstname');
        //print_r($user);
        //exit;
		if(!$isupdate_found)

		{
             

			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>'has already been taken'));

		}

		else

		{
   

            //$property_id=$this->input->post('property_id');
			// $unit_id=$this->input->post('unit_id');
			// $owner_id=$this->input->post('owner_id');
			// $result = $this->db->get_where('onelane_property_tenant',array('property_id'=>$property_id,'unit_id'=>$unit_id,'owner_id'=>$owner_id))->row_array();
			// $tenant_id = $result['user_id'];

			//$userDetails = $this->db->get_where('onelane_users',array('id'=>$tenant_id))->row_array();
			//$email=$userDetails['email'];
			//$user= $this->session->userdata('firstname');
            
			$data = array
			(
				'admin'=>ucfirst($user),
				'email'=>$email,
				'contact_name'=>$contact_name,
				'title' => $title,
				'work_order_ref_id'=>$work_order_ref_id,
				'address' => $address,
				'unit' => $unit,
				'createdate' => $createtime,
				'message'=>$update,
				'click_here' => $url_work_order
			);
			$email_type='work_order_email_update';

			// print_r($data);
			// exit;
		    $this->common_model->send_mail($email,$email_type,$data);
            

			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}

	}

	public function requestUpdateForm()

	{

		$maintenance_id 	=	$this->input->post('maintenance_id');

		$update 		=	$this->input->post('update_content');
		$owner_id 		=	$this->session->userdata('owner_id');
		$column 		=	'owner_id';



	

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
		/*	$userdata['getParentID'] = $this->tenant_model->getTenantUserId($owner_id);
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

			$this->common_model->send_mail($email,$email_type,$data);*/
			// mail ends.
			$property_id=$this->input->post('property_id');
			$unit_id=$this->input->post('unit_id');
			$owner_id=$this->input->post('owner_id');
			$result = $this->db->get_where('onelane_property_tenant',array('property_id'=>$property_id,'unit_id'=>$unit_id,'owner_id'=>$owner_id))->row_array();
			$tenant_id = $result['user_id'];

			$userDetails = $this->db->get_where('onelane_users',array('id'=>$tenant_id))->row_array();
			$email=$userDetails['email'];
			$user= $this->session->userdata('firstname');

			$data = array
			(
				'admin'=>ucfirst($user),
				'email'=>$email,
				'message'=>$update
			);
			$email_type='New_message';
			$this->common_model->send_mail($email,$email_type,$data);


			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}

	}

	public function maintenance()

	{

		$maintenance_id 	=	2;



		$workOrderDataByIdData = $this->common_model->workOrderDataById($maintenance_id);

		

		foreach($workOrderDataByIdData as $row)

		{



			 $email= $row['email'];

			 $status= $row['status'];

			 $maintenance_type=$row['maintenance_type'];

			

			 $title = $row['title'];

			 $maintenance_instructions=$row['maintenance_instructions'];

			 $work_order_id = $row['work_order_ref_id'];

			 $user = $row['contact_name'];

			 $getPropertyId =  $row['property_id'];

			 $getUnitId = $row['unit_id'];

			 $getServiceId= $row['service_id'];



			 $propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);

			$address = $propertyData['propertyData']['address'];

			$managerName = $propertyData['propertyData']['propertymanager_name'];

			if ($managerName=='') 

			{

				$managerName = $this->session->userdata('firstname');

			}

			$managerEmail = $propertyData['propertyData']['propertymanager_email'];

			if ( $managerEmail=='') {

				$managerEmail = $this->session->userdata('email');

			}

			

			$managerPhone = $propertyData['propertyData']['propertymanager_phone'];

		



		$unitData['unitData'] = $this->common_model->getUnitData($getUnitId);

			

			$unitid = $unitData['unitData']['unit'];	

		


			$serviceData['serviceData'] = $this->common_model->getServiceData($getServiceId);



			$servicename = $serviceData['serviceData']['name'];

			




			$data = array

			(

				'admin'=>$this->session->userdata('firstname'),

				'contact_name'=>$user,

				'maintenance_type'=>$maintenance_type,

				'email'=>$email,

				'title'	=>$title,

				'maintenance_instructions'=>$maintenance_instructions,

				'address'=>$address,

				'services'=>$servicename,

				'unit'=>$unitid,

				'manager_name'=>$managerName,

				'manager_email'=>$managerEmail,

				'manager_phone'=>$managerPhone,

				'work'=>$work_order_id,

				'status'=>$status

			);

			$email_type='work_order_preticular_user';





			$this->common_model->send_mail($email,$email_type,$data);

		}

		

	}



	public function addAsignStatus()

	{

		$maintenance_id 	=	$this->input->post('id');

			
			 $status 		=	$this->input->post('status');
		$updatedata =(

			array('id'=>$maintenance_id,'status'=>$status));

		$isupdate_found['updatestatus'] =$this->Request_model->addAssignStatus($updatedata);


		
		if ($status=='Close') 

		{	

		$workorder =$this->Request_model->allWorkOrderStatus(array(

		'status'=>$status));

		}

			$workOrderDataByIdData = $this->common_model->workOrderDataById($maintenance_id);
			foreach($workOrderDataByIdData as $row)

			{
				 $email= $row['email'];

				 $maintenance_type=$row['maintenance_type'];


				 $title = $row['title'];

				 $maintenance_instructions=$row['maintenance_instructions'];

				 $work_order_id = $row['work_order_ref_id'];

				 $user = $row['contact_name'];

				 $getPropertyId =  $row['property_id'];

				 $getUnitId = $row['unit_id'];

				 $getServiceId= $row['service_id'];

				 $propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);

				$address = $propertyData['propertyData']['address'];

				$managerName = $propertyData['propertyData']['propertymanager_name'];

				if ($managerName=='') 

				{

					$managerName = $this->session->userdata('firstname');

				}

				$managerEmail = $propertyData['propertyData']['propertymanager_email'];

				if ( $managerEmail=='') {

					$managerEmail = $this->session->userdata('email');

				}

				

				$managerPhone = $propertyData['propertyData']['propertymanager_phone'];

			


				$unitData['unitData'] = $this->common_model->getUnitData($getUnitId);

				

				$unitid = $unitData['unitData']['unit'];	

				$serviceData['serviceData'] = $this->common_model->getServiceData($getServiceId);



				$servicename = $serviceData['serviceData']['name'];




				$firstname =$this->session->userdata('firstname');

				$data = array

				(

					'admin'=> ucfirst($firstname),

					'contact_name'=>ucfirst($user),

					'maintenance_type'=>$maintenance_type,

					'email'=>$email,

					'title'	=>$title,

					'maintenance_instructions'=>$maintenance_instructions,

					'address'=>$address,

					'services'=>$servicename,

					'unit'=>$unitid,

					'manager_name'=>ucfirst($managerName),

					'manager_email'=>$managerEmail,

					'manager_phone'=>$managerPhone,

					'work'=>$work_order_id,

					'status'=>$status

				);

				$email_type='work_order_perticular_user';





		



				$this->common_model->send_mail($email,$email_type,$data);



			}

		if(!$isupdate_found)

		{

			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>''));

		}

		else

		{

			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}



				

	}



	public function workOrderStatus()

	{

		$workerid 	=	$this->input->post('id');

		$status =	$this->input->post('status');




		$worker_id = $this->Request_model->workOrderStatus(array('id'=>$workerid,

			'status'=>$status));

		



		$getWorkerData['workerusertype'] = $this->common_model->getworkerUserData($workerid);

		


			$id = $getWorkerData['workerusertype']['service_user_id'];

			$maintenance_id = $getWorkerData['workerusertype']['maintenance_id'];

			$workOrder= $getWorkerData['workerusertype']['work_order_ref_id'];

			$maintenance_type = $getWorkerData['workerusertype']['maintenance_type'];

			$title = $getWorkerData['workerusertype']['title'];

			$maintenance_instructions = $getWorkerData['workerusertype']['maintenance_instructions'];





	$getMaintenanceData['maintenanceRequest'] = $this->common_model->getMaintenanceData($maintenance_id);



			$getPropertyId = $getMaintenanceData['maintenanceRequest']['property_id'];

			$getUnitId = $getMaintenanceData['maintenanceRequest']['unit_id'];

			$getServiceId = $getMaintenanceData['maintenanceRequest']['service_id'];



			$propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);

			$address = $propertyData['propertyData']['address'];

			$managerName = $propertyData['propertyData']['propertymanager_name'];

			if ($managerName=='') 

			{

				$managerName = $this->session->userdata('firstname');

			}

			$managerEmail = $propertyData['propertyData']['propertymanager_email'];

			if ( $managerEmail=='') {

				$managerEmail = $this->session->userdata('email');

			}

			

			$managerPhone = $propertyData['propertyData']['propertymanager_phone'];



			$unitData['unitData'] = $this->common_model->getUnitData($getUnitId);

			

			$unitid = $unitData['unitData']['unit'];





			$serviceData['serviceData'] = $this->common_model->getServiceData($getServiceId);



			$servicename = $serviceData['serviceData']['name'];

			
			

			$getUserData['usertype'] = $this->common_model->getUserData($id);

			
			$user = $getUserData['usertype']['contact_name'];

			$email= $getUserData['usertype']['email'];

		

				$firstname	= $this->session->userdata('firstname');

			$data = array

			(

				'admin'=>ucfirst($firstname),

				'user'=>ucfirst($user),

				'maintenance_type'=>$maintenance_type,

				'email'=>$email,

				'title'			=>$title,

				'maintenance_instructions'=>$maintenance_instructions,

				'address'=>$address,

				'services'=>$servicename,

				'unit'=>$unitid,

				'manager_name'=>ucfirst($managerName),

				'manager_email'=>$managerEmail,

				'manager_phone'=>$managerPhone,

				'work_order_id'=>$workOrder,

				'status'=>$status

			);

			$email_type='work_order_close';






			$this->common_model->send_mail($email,$email_type,$data);	

	}





	



	public function getInvoiceById($id)

	{	



		$data['requestworkorder'] = $this->Request_model->getRequestWorkOrderId($id);



		

		$data['workorderinfo'] = $this->Request_model->getWorkOrderInfo($id);

		 
    	



    	$requestServicesUserData = $this->Request_model->getPropertyServiceUsers($data['requestworkorder']['property_id']);





    	$requestOwnerData = $this->Request_model->getOwnerRequest();

    	

    	


	

		$data['userdata'] = $requestOwnerData;

		$data['servicesuserdata'] = $requestServicesUserData;





		$this->load->view('common/popup_header',$data);

		

		$this->load->view('maintanance_work_order_invoice_popup',$data);

		$this->load->view('common/popup_footer',$data);



	}





	public function getWorkOrderSchedulById($id)

	{	


		$data['requestworkorder'] = $this->Request_model->getRequestWorkOrderId($id);



	

		$data['workorderinfo'] = $this->Request_model->getWorkOrderInfo($id);




    	$requestServicesUserData = $this->Request_model->getPropertyServiceUsers($data['requestworkorder']['property_id']);





    	$requestOwnerData = $this->Request_model->getOwnerRequest();

    	

    


	

		$data['userdata'] = $requestOwnerData;

		$data['servicesuserdata'] = $requestServicesUserData;

		



		$this->load->view('common/popup_header',$data);

	

		$this->load->view('maintanance_work_order_scheduling_popup',$data);

		$this->load->view('common/popup_footer',$data);



	}



	public function uploadWorkOrderInvoice()

	{
		$owner_id 		=	$this->session->userdata('owner_id');

		if(!empty($_POST))

		{

			$workorder_id=	$this->input->post('workorder_id');

			$amount=	$this->input->post('amount');	

			$due_date=	$this->input->post('due_date');

			$payable_to=	$this->input->post('payable_to');

			$memo=	$this->input->post('memo');

			$filename=	$this->input->post('file_name');

		

		$updatedata =(

			array('workorder_id'=>$workorder_id,'amount'=>$amount,'due_date'=>$due_date,'payable_to'=>$payable_to,'memo'=>$memo,'file_name'=> $filename,));


		$invoice_id =$this->Request_model->saveWorkOrderInvoice($updatedata);
        
        $data['WorkOrderUpdateInvoices'] = $this->property_model->getWorkOrderInvoices($workorder_id);

        foreach ($data['WorkOrderUpdateInvoices'] as $key => $value) {
        	$parent_user_id    = $value['parent_user_id'];
        	$work_order_ref_id = $value['work_order_ref_id'];
        	$address           = $value['address'];
            $unit           = $value['unit'];
        }
	    $getUserinfo = $this->Request_model->getUserDataForEmail($parent_user_id);
	  
	    foreach ($getUserinfo as $key => $value) {
	         
	         $email = $value['email'];
	         $user  = $value['firstname'];
	    }

	    $data = array
			(
				'admin'=>ucfirst($user),
				'work_order_ref_id'=>$work_order_ref_id,
				'email'=>$email,
				'amount'=>$amount,
				'address'=>$address,
				'unit'   => $unit,
			);
			$email_type='work_order_invoices_payment';
		    $this->common_model->send_mail($email,$email_type,$data);
		//exit;	

			redirect(base_url('owner/workOrderDetails/'.$workorder_id.''));

		}

	}

	public function uploadWorkOrderschedul()

	{


		if(!empty($_POST))

		{

		

			$workorder_id=	$this->input->post('workorder_id');

			$sch_type=	$this->input->post('sch_type');	

			$owner_id=	$this->input->post('owner_id');

			$cus_fname=	$this->input->post('cus_fname');

			$cus_lname=	$this->input->post('cus_lname');

			$cus_phone=$this->input->post('cus_phone');



		

		$updatedata =(

			array('workorder_id'=>$workorder_id,'sch_type'=>$sch_type,'owner_id'=>$owner_id,'cus_fname'=>$cus_fname,'cus_lname'=>$cus_lname,'cus_phone'=> $cus_phone));




		$invoice_id =$this->Request_model->saveWorkOrderScheduling($updatedata);

			

			redirect(base_url('owner/workOrderDetails/'.$workorder_id.''));

		}

	}



	public function workOrderImageRequest()

	{
		//exit('13333');
		$workorder_id = $this->input->post('filename');

		$target_dir = "upload/workorder_Invoice_doc/";

			$newFilename = $this->workOrderInvoiceRenameFile(basename($_FILES["file"]["name"]),$workorder_id); 

			$target_file = $target_dir.''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		

					echo json_encode(array('filename'=>$newFilename,'id'=>$workorder_id));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;	

	}



	public function workOrderInvoiceUploadAndDelete()

	{

		$target_dir = "upload/workorder_Invoice_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

	}



	public function workOrderInvoiceRenameFile($orgName,$workorder_id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'request_'.$workorder_id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return trim(date('Ymdhis')).'.'.$ext;

	}

	public function saveFileWorkOrderInvoiceDetails($newFilename,$type,$workorder_id)

	{

		return $this->Request_model->saveFileWorkOrderInvoiceDetails($newFilename,$type,$workorder_id);

	}

		public function check_familyhome_status()

	{

		$property_id 	=	$this->input->post('property_id');


		

		

		$family_home_unitfound 	=	$this->property_model->check_familyhome_status(array('property_id'=>$property_id,'familyhome_status'=>1,'owner_id'=>$this->session->userdata('owner_id')));

		

		if($family_home_unitfound > 0 )

		{
			echo json_encode(array('code'=>'100'));	


		}

		else

		{

			echo json_encode(array('code'=>'101'));

		}

	}

    public function profile()
	{
        $user_id = $this->session->userdata('owner_id');  
       //  echo $user_id;                    
		$data['userprofile'] = $this->auth_model->userProfile($user_id);
   	    
   	    $data['activeclass']='profile';

		$this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);
		
		$this->load->view('profile',$data);

		$this->load->view('common/footer',$data);
	}

	public function getReferredByUser(){

	    $this->load->view('common/header');

		$this->load->view('common/sidemenu',$data);
		
		$this->load->view('user_referred');

		$this->load->view('common/footer',$data);
	}	

	public function getReferred(){
     //$data = array();
	  if(!empty($_POST))
	  {
		$groupdata['name']  = $this->input->post('firstname');
		$groupdata['email']  = $this->input->post('firstemail');
	  }

	   //print_r(count($data));
			     $user_id = $this->session->userdata('owner_id'); 
	              $ownername = $this->common_model->userProfile($user_id);


	   $email_arr = array();
        for($i=0; $i<3; $i++){
          if($groupdata['name'][$i] != '' && $groupdata['email'][$i] != '' && !in_array($groupdata['email'][$i],$email_arr)) {
        	echo $i;
        	echo "<br>";

          	$name = $groupdata['name'][$i];
         	$email = $groupdata['email'][$i];
            $insert_arr = array(
           	    'user_id' => $user_id,
		        'name' =>  $name,
		        'email' =>  $email,
		        'createdate' => date('Y-m-d H:i:s')
            );

		    $alldata =  $this->common_model->getUserReferred($insert_arr);
 


		        $message  = '';
		        $message .= "Your friend ".ucfirst($ownername['firstname'])." has referred you to use <b>".base_url()."</b>";
		        $message .= "<br>";
		        $message .= "<br>";
		        $message .= "<button style='background-color:#009688; color:#ffffff;'><a href='".base_url()."'  style='color:#ffffff; text-decoration: none;'>Click Here To Signup</a></button>";
			    $data = array(

			        'fullname' => ucfirst($name),
			        'email'=> $email,
			        'email_body' => $message,

			    );

		       $email_type='referred';

		       $this->common_model->send_reference_mail($email,$email_type,$data);
		       $email_arr[] =$groupdata['email'][$i];
           
           }

	    }
	   exit;
        $this->session->set_flashdata('referred','Thanks for Referrin Your Frie'); 
   
         //redirect to home page 
        redirect(base_url('owner/dashboard'));
	}	

	 public function userListDownload($user_type = 1){
    	
    	$userData = $this->common_model->downloadAllUserCSV($user_type);

    	header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=User_".time().".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $headings = "Id,User Type,Parent User Id,Is Active,Firstname,Lastname,Contact Name,Company Name,Email,Password,Forgotcode,Forgotcode Time,Forgot Token,Address,Lat,Lng,mobile,Notes,User Referral Comments,Added By,Referred BY";
            echo $headings;
            echo "\r\n";
            foreach ($userData as $key => $value) {
             
              $email = $value['email'];
              $referredfnd = $this->common_model->downloadReferred($email);
              $user_id =  $referredfnd['user_id'];
              $referred_by = $this->common_model->downloadReferredFriendName($user_id);
              $wonername = $referred_by['firstname'];    

              echo '"'.$value['id'].'"';
              echo ",";
              echo '"'.$value['user_type'].'"';
              echo ",";
              echo '"'.$value['parent_user_id'].'"';
              echo ",";
              echo '"'.$value['is_active'].'"';
              echo ",";
              echo '"'.$value['firstname'].'"';
              echo ",";
              echo '"'.$value['lastname'].'"';
              echo ",";
              echo '"'.$value['contact_name'].'"';
              echo ",";
              echo '"'.$value['company_name'].'"';
              echo ",";
              echo '"'.$value['email'].'"';
              echo ",";
              echo '"'.$value['password'].'"';
              echo ",";
              echo '"'.$value['forgotcode'].'"';
              echo ",";
              echo '"'.$value['forgotcode_time'].'"';
              echo ",";
              echo '"'.$value['forgot_token'].'"';
              echo ",";
              echo '"'.$value['address'].'"';
              echo ",";
              echo '"'.$value['lat'].'"';
              echo ",";
              echo '"'.$value['lng'].'"';
              echo ",";
              echo '"'.$value['mobile'].'"';
              echo ",";
              echo '"'.$value['notes'].'"';
              echo ",";
              echo '"'.$value['user_referral_comments'].'"';
              echo ",";
              echo '"'.$value['added_by'].'"';
              echo ",";
              echo '"'.$wonername.'"';
              echo "\r\n";
            }
           exit;
 
    }
	



}