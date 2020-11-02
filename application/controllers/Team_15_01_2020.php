<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Team extends CI_Controller



{



	public function __construct()



	{



		parent::__construct();







        $this->load->helper(array('form', 'url'));



         







        $this->load->library('form_validation');







		$this->load->model('team_model');



		$this->load->model('Request_model');



		$this->load->model('property_model');







		



		if($this->session->userdata('owner_id') == '')



			redirect(base_url('auth/signin'));



	}







	public function addServicePro()



	{	



		$data['services']=$this->common_model->getServices();



		$data['propertydata'] = $this->property_model->getPropertyData();



    	$data['lat']= $this->config->item('latitude');



		$data['lng']= $this->config->item('longitude');





		$this->load->view('common/popup_header');



		$this->load->view('add_service_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);

	}



	public function addTenant()



	{	







		$data['services']=$this->common_model->getServices();



		$propertydata = $this->property_model->getPropertyData();
				
		$data['propertydata'] = $propertydata;

		$propertydatatenat = $this->property_model->getPropertyDataTenant();
        
        $data['propertydatatenat'] = $propertydatatenat;


    	$data['lat']= $this->config->item('latitude');



		$data['lng']= $this->config->item('longitude');


		$this->load->view('common/popup_header');


		$this->load->view('add_tenants_popup',$data);


		$this->load->view('common/popup_footer',$data);


	}


	public function saveTenantData()
	{



		$owner_id = $this->session->userdata('owner_id');



		if(!empty($_POST))



		{



			$property_id  =	$this->input->post('property_id');



			$unit_id	=	$this->input->post('unit_id');



			$firstname	 =	$this->input->post('firstname');



			$mobile	=	$this->input->post('mobile');



			$email=	$this->input->post('email');



			$Co_applicant_name_1	 =	$this->input->post('co_applicant_name1');



			$Co_applicant_mobile_1	=	$this->input->post('co_applicant_mobile1');



			$Co_applicant_email_1=	$this->input->post('co_applicant_email1');



			$Co_applicant_name_2	 =	$this->input->post('co_applicant_name2');



			$Co_applicant_mobile_2	=	$this->input->post('co_applicant_mobile2');



			$Co_applicant_email_2 =	$this->input->post('co_applicant_email2');



			$start_date  =	$this->input->post('start_date');



			$end_date	=	$this->input->post('end_date');



			$after_lease_end=	$this->input->post('after_lease_end');



			$monthly_rent	 =	$this->input->post('monthly_rent');



			$due_on=	$this->input->post('due_on');



			$security_deposit=	$this->input->post('security_deposit');



			$late_fees_start_on=	$this->input->post('late_fees_start_on');



			$late_fee_type=	$this->input->post('late_fee_type');



			$late_fee_amount=	$this->input->post('late_fee_amount');



			$initial_amount=	$this->input->post('initial_amount');



			$daily_amount=	$this->input->post('daily_amount');











				



			$requestData = array(



				'owner_id'=>$owner_id,



				'user_id'=>0,



				'property_id'=>$property_id,



				'unit_id'=>$unit_id,



				'firstname'=>$firstname,



				'mobile'=>$mobile,



				'email'=>$email,



				'start_date'=>$start_date,



				'end_date'=>$end_date,



				'after_lease_end'=>$after_lease_end,



				'monthly_rent'=>$monthly_rent,



				'due_on'=>$due_on,



				'security_deposit'=>$security_deposit,



				'late_fees_start_on'=>$late_fees_start_on,



				'late_fee_type'=>$late_fee_type,



				'late_fee_amount'=>$late_fee_amount,



				'initial_amount'=>$initial_amount,



				'daily_amount'=>$daily_amount	



			);



			$tenant_id = $this->team_model->saveTenant($requestData);





			if ($Co_applicant_name_2 =='') 



				{



					if ($Co_applicant_name_1 =='') 



					{







					}



					else



					{



						$coTenantData = array(



						'tenant_id'=>$tenant_id,



						'co_applicant_name'=>$Co_applicant_name_1,



						'co_applicant_mobile'=>$Co_applicant_mobile_1,



						'co_applicant_email'=>$Co_applicant_email_1



						);





					 $this->team_model->saveCoTenant($coTenantData);





					}		



				}



				else



				{



					$coTenantData = array(



						'tenant_id'=>$tenant_id,



						'co_applicant_name'=>$Co_applicant_name_1,



						'co_applicant_mobile'=>$Co_applicant_mobile_1,



						'co_applicant_email'=>$Co_applicant_email_1



						);







					 $this->team_model->saveCoTenant($coTenantData);



					



					$addTenantData = array(



						



						'tenant_id'=>$tenant_id,



						'co_applicant_name'=>$Co_applicant_name_2,



						'co_applicant_mobile'=>$Co_applicant_mobile_2,



						'co_applicant_email'=>$Co_applicant_email_2



						);









					 $this->team_model->saveCoTenant($addTenantData);



				



				}







			$tenantData['tenantData'] = $this->team_model->tenantData($tenant_id);





			$TENANT_NAME =  $tenantData['tenantData']['firstname'];



			$getPropertyId = $tenantData['tenantData']['property_id'];



			$getUnitId = $tenantData['tenantData']['unit_id'];









			$propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);



			$address = $propertyData['propertyData']['address'];







			$unitData['unitData'] = $this->common_model->getUnitData($getUnitId);



			



			$unitid = $unitData['unitData']['unit'];



			$firstname =$this->session->userdata('firstname');



			$data = array



			(	



				'user'=>ucfirst($firstname),



				'TENANT_NAME'=>ucfirst($TENANT_NAME),



				'PROPEERTY'=>$address,



				'UNIT'=>$unitid,





				'url'=>base_url('auth/registerApplicationTenannt/'.$tenant_id.'')



			);





			$email_type='tenant_application_invitation';



		





			$this->common_model->send_mail($email,$email_type,$data);



			



			



		}



		redirect(base_url('team/tenants'));







	}



	public function saveTenantMessageData($id)



	{





		if(!empty($_POST))



		{



			$message=	$this->input->post('message');



			$requestData = array(



				



				'tenant_id'=>$id,



				'message'=>$message



				



			);





			 $this->team_model->saveTenantMessage($requestData);



			$userdata['usermessage'] = $this->team_model->getTenantUserId($id);





			$email=$userdata['usermessage']['email'];



			$firstname =$this->session->userdata('firstname');



			$data = array



			(



				'admin'=>ucfirst($firstname),



				'email'=>$email,



				'message'=>$message



			);



			$email_type='New_message';





			$this->common_model->send_mail($email,$email_type,$data);



		}



		redirect(base_url('team/tenants'));







	}





	public function getTenantnotesById($id)



	{	



		$data['tenantData'] =$this->team_model->getTenantUserId($id);





		$data['tenantMessageNotesData'] =$this->team_model->getTenantUsernotes($id);



		$this->load->view('common/popup_header');





		$this->load->view('tenant_Private_notes_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	public function saveTenantnoteData($tenant_id)



	{



		if(!empty($_POST))



		{



			$id =	$this->input->post('id');



			$message =	$this->input->post('message');





			$requestData = array(



				'id'=>$id,



				'user_id'=>$tenant_id,



				'message'=>$message		



			);





			 $this->team_model->saveTenantNotesChackId($requestData);



		}



		redirect(base_url('team/tenants'));







	}



	public function registerTenantByApplication($tenant_id)



	{



		redirect(base_url('team/tenants'));



	}





	public function tenantUplodeById($id)



	{	



		$data['tenantData'] =$this->team_model->getTenantUserId($id);







		$data['tenantdocs'] = $this->getImages($id);



		$this->load->view('common/popup_header',$data);



		$this->load->view('tenant_uplode_popup',$data);



		$this->load->view('common/popup_footer',$data);







	}


	public function mainTenantUplodeById($id)



	{	



		$data['tenantData'] =$this->team_model->getTenantUserId($id);







		//$data['tenantdocs'] = $this->getMainTenantImages($id);


		$data['tenantdocs'] = $this->getgovtImages($id);
		$data['tenantrenterdocs'] = $this->getrenterImages($id);
		$data['tenantdocumentsdocs'] = $this->getDocumentImages($id);
        
        //print_r($data['tenantrenterdocs']);
        // print_r($data['tenantdocumentsdocs']);
        // exit;

		/*$this->load->view('common/popup_header',$data);



		$this->load->view('maintenant_uplode_popup',$data);



		$this->load->view('common/popup_footer',$data);*/


		$data['activeclass']='tenants';
		$this->load->view('common/header');
		$this->load->view('common/sidemenu',$data);
		$this->load->view('tenant_all_docs_ownerview',$data);
		$this->load->view('common/footer',$data);

	}


	public function getgovtImages($id)
	{
		return $this->property_model->getgovtTenantDocs($id);
	}

		public function getrenterImages($id)
	{
		return $this->property_model->getTenantrenterDocs($id);
	}

	public function getDocumentImages($id)
	{
		return $this->property_model->getTenantdocumentDocs($id);
	}


	public function getImages($id)



	{



		return $this->property_model->getTenantDocs($id);



	}

	/*public function getMainTenantImages($id)
	{
		return $this->property_model->getMainTenantDocs($id);		
	}
*/
	// FUNCIONS TO GET THE 3 TYPES OF IMAGES






	public function uploadTenantDoc($id)



	{





		if(!empty($_POST))



		{



			

		$filename=	$this->input->post('file_name');



		$updatedata =(



			array('user_id'=>$id,'file_name'=> $filename,));





		$invoice_id =$this->team_model->savetenantdocs($updatedata);



			



			redirect(base_url('team/tenants/'));



		}



	}







	public function addPropertyUser()



	{	



		



		$data['propertydata'] = $this->property_model->getPropertyData();



		$this->load->view('common/popup_header');



		$this->load->view('add_property_user_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	public function savePropertyUser()



	{



		$owner_id = $this->session->userdata('owner_id');



		if(!empty($_POST))



		{



			$firstname		 =	$this->input->post('firstname');



			$email			 =	$this->input->post('email');



			$permissions	 =	$this->input->post('permissions');



			$space_separated =  implode(",", $permissions); 



			$properties		 =	$this->input->post('property');



			$userType		 =	4;





			if(!$this->common_model->check_uniqueEmail($email,''))



			{



				$this->session->set_flashdata('errmsg',"Email already exists");



				



	            	redirect(base_url('team/getTeams'));



			}				



			$password = date('Ymdhis');



			$teamData = array('firstname'=>$firstname



					,'email'=>$email,



					'user_type'=>$userType,'added_by'=>$owner_id,'parent_user_id'=>$owner_id,'password'=>md5($password));



			$id = $this->team_model->save($teamData); 





        	$data = array('agent_id' =>$id,'permissions'=>$space_separated);



        	$this->db->insert('agent_permissions',$data);







        	$propertydata = array();



        		foreach($properties as  $val) 



        		{







        			 $data = array('agent_id' =>$id,'property_id'=>$val );



        			$this->db->insert('agent_property',$data);



        			



			



        		}



        	

			 



			$getUserData['usertype'] = $this->common_model->getUserData($id);



			$user = $getUserData['usertype']['user'];



			$firstname = $this->session->userdata('firstname');







			$data = array



			(



				'admin'=>ucfirst($firstname),



				'user'=>ucfirst($user),



				'email'=>$email,



				'password'=>$password,



				'url'=>base_url()



			);



			$email_type='agent_user_registration';



			$this->common_model->send_mail($email,$email_type,$data);



			redirect(base_url('team/getTeams'));



		}

	}



	public function editPropertyUser($worker_id)



	{	



		$data['workerData'] =$this->team_model->getTeams($worker_id);



		







		$workerPropertyData = $this->team_model->getSingleContact_byAgentproperties($worker_id);







		$property_giving_array = array();



		if(!empty($workerPropertyData) && count($workerPropertyData)>0)



		{







			foreach($workerPropertyData as $worker_property_data)



			{







				 $property_giving_array[] = $worker_property_data['property_id'];



			}



		}



		$data['workerproperty'] = $property_giving_array;







		$data['propertydata'] = $this->property_model->getPropertyData();







		 $data['permissionsData'] = $this->property_model->getPermissionsData($worker_id);



		



		



		$data['permissions']= $data['permissionsData']['permissions'];







		$data['selected_permissions'] =explode(",", $data['permissions']); 





		$this->load->view('common/popup_header');



		$this->load->view('edit_property_user_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	



	public function updatePropertyUser()



	{



		$owner_id = $this->session->userdata('owner_id');



		$data =array();



		if(!empty($_POST))



		{ 



			$worker_id = $this->input->post('id');



			







			$email=	$this->input->post('email');







			if(!$this->common_model->check_uniqueEmail($email,$worker_id))



			{



				$data = $this->session->set_flashdata('errmsg',"Email already exists");



				



				redirect(base_url('team/getTeams'));



				



			}







			$active=0;



			



			if($this->input->post('is_active')==1) {



				$active=1;



			}





			



			$permissions	=	$this->input->post('permissions');



			$space_separated = implode(",", $permissions); 



			$properties		=	$this->input->post('property');





			$teamData = array(



					'is_active'=>$active);



		







	 		$this->team_model->editTeamData($teamData,$worker_id); 



 			







        	$tempArr = array();



			 	$this->team_model->deletePermissionsByWorkerId($worker_id);



        		



        			$data = array('agent_id' =>$worker_id,'permissions'=>$space_separated );



        			$this->db->insert('agent_permissions',$data);



        		



        			





        



        		$tempArr = array();



			 	$this->team_model->deleteAgentPropertyByWorkerId($worker_id);



        		foreach($properties as  $val)



        		{



        			$data = array('agent_id'=>$worker_id,'property_id'=>$val);



        			$this->db->insert('agent_property',$data);





        		}	



        	



			 



			redirect(base_url('team/getTeams'));



		}



	}











	



	public function saveTeam()



	{



		$owner_id = $this->session->userdata('owner_id');



		if(!empty($_POST))



		{



			$contactname	=	$this->input->post('contactname');



			$companyname	=	$this->input->post('companyname');



			$address		=	$this->input->post('address');



			$lat			=	$this->input->post('lat');



			$lng			=	$this->input->post('lng');



			$email			=	$this->input->post('email');



			$mobile			=	$this->input->post('mobile');



			$categories		=	$this->input->post('category');



			$properties		=	$this->input->post('property');



			$notes			=	$this->input->post('notes');



			$userType		=	3;



			







			if(!$this->common_model->check_uniqueEmail($email,''))



			{



				$this->session->set_flashdata('errmsg',"Email already exists");



				



	            	redirect(base_url('team/getTeams'));



			}				







			$teamData = array('contact_name'=>$contactname,'company_name'=>$companyname,



					'address'=>$address,'email'=>$email,



					'lat'=>$lat,'lng'=>$lng,



					'mobile'=>$mobile,'notes'=>$notes,



					'user_type'=>$userType,'parent_user_id'=>$owner_id,'added_by'=>$owner_id);



		







			$workerid = $this->team_model->save($teamData); 





			 $data = array();



        		foreach($categories as  $val) 



        		{







        			$data = array('user_id' =>$workerid,'service_id'=>$val );



        			$this->db->insert('worker_services',$data);





			



        		}



        	$propertydata = array();



        		foreach($properties as  $val) 



        		{







        			$data = array('user_id' =>$workerid,'property_id'=>$val );



        			$this->db->insert('worker_property',$data);



        	



			



        		}



        	



			 



			redirect(base_url('team/getTeams'));



		}



	}







	



    public function addCheckEmailExists()



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



		







	public function getTeams()



	{



		$search_by = '';







		if(!empty($_POST))



		{



			$search_by = $this->input->post('searchFilter');



		}



			$data['popuptype']='iframe';



		$data['services']=$this->common_model->getServices();





		$data['propertydata'] = $this->property_model->getPropertyData();



		if($search_by !='' && $search_by != 'all')



		{







			$data['teamsDataByFilter'] = $this->team_model->getTeamsByService($search_by);





		}

		else



		$data['teamsData']		=	$this->team_model->getTeams();



		$data['activeclass']	=	'teams';



		$data['search_by']	=	$search_by;







		$data['combineUnits']   = 	array();



		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('team_list_view',$data);



		$this->load->view('common/footer' ,$data);



	} 







	public function getTeamById($worker_id)

	{



		$data['workerData'] =$this->team_model->getTeams($worker_id);



		 $data['lat']= $data['workerData']['lat'];



		 $data['lng'] = $data['workerData']['lng'];



		 $data['address'] = $data['workerData']['address'];





		$workerServicesData = $this->team_model->getSingleContact_byservices($worker_id);



		$workerPropertyData = $this->team_model->getSingleContact_byproperties($worker_id);

	

		



		$services_giving_array = array();



		if(!empty($workerServicesData) && count($workerServicesData)>0)



		{







			foreach($workerServicesData as $worker_service_data)



			{







				 $services_giving_array[] = $worker_service_data['service_id'];



			}



		}



		$property_giving_array = array();



		if(!empty($workerPropertyData) && count($workerPropertyData)>0)



		{







			foreach($workerPropertyData as $worker_property_data)



			{







				 $property_giving_array[] = $worker_property_data['property_id'];



			}



		}











		



		$data['workerproperty'] = $property_giving_array;







		$data['workerservices'] = $services_giving_array;



		

		

		$data['getservices']=$this->common_model->getServices();



		$data['propertydata'] = $this->property_model->getPropertyData();





		$data['services'] = $workerServicesData;



		



		$this->load->view('common/popup_header',$data);



		//$this->load->view('common/sidemenu',$data);



		$this->load->view('edit_team_list_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	public function tenants()
	{


		$search_by = '';







		if(!empty($_POST))



		{



			$search_by = $this->input->post('searchFilter');



		}



			$data['popuptype']='iframe';



		$data['services']=$this->common_model->getServices();



		$data['propertydata'] = $this->property_model->getPropertyData();







		



		if($search_by !='' && $search_by != 'all')



		{







			$data['teamsDataByFilter'] = $this->team_model->getTeamsByService($search_by);



		}



		



		else





		$data['tenantData']		=	$this->team_model->getTenant();







		



		$data['activeclass']	=	'tenants';



		$data['search_by']	=	$search_by;







		$data['combineUnits']   = 	array();



		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('tenants_view',$data);



		$this->load->view('common/footer' ,$data);



	} 







	public function editTenantById($id)



	{	











		$data['tenantdata'] =$this->team_model->getTenantUserId($id);









		$data['tenantMessageData'] =$this->team_model->getTenantUserMessage($id);



		







		$this->load->view('common/popup_header');





		$this->load->view('edit_tenant_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}







	public function updateTenannt($id)



	{



		$data =array();



		$data['tenantdata'] = $this->common_model->tenantData($id);



		



		$user_id= $data['tenantdata']['user_id'];





          // echo "<pre>";

          //           print_r($data);

          //          exit;

                



		if(!empty($_POST))



			{



				



					$user_type=	2;



					$firstname=	$this->input->post('firstname');



					$mobile=	$this->input->post('mobile');

                  







					$registerData =(



						array('firstname'=>$firstname,'mobile'=>$mobile));

                    





					$tenant_id = $this->team_model->updateTenantInviteData($registerData,$id);

                    



                 





					if ($user_id>0) {



						

						$tenantid = $this->team_model->updateTenantuserData($registerData,$user_id);

                    

					}







					



			}



		



			redirect(base_url('team/tenants'));



		



	}











	public function getTenantMessageById($id)
	{	


		$data['tenantData'] =$this->team_model->getTenantUserId($id);

        //$data['parentData'] = $this->team_model->check_owner_and_tenant();
		
		$data['tenantMessageData'] =$this->team_model->getTenantUserMessage($id);
        
     	//echo '<pre>';
     	//print_r($data['tenantMessageData']);
     
		$this->load->view('common/popup_header');



		$this->load->view('tenant_message_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);











	}





	public function getCOTenantById($id)



	{	







		$data['tenantData'] =$this->team_model->getTenantUserId($id);











		$data['coTenantData'] =$this->team_model->getCoTenant($id);







		$data['coTenantDataRow'] =$this->team_model->getCoTenantRow($id);



		$tenantid = $data['coTenantDataRow']['id'];







		if($tenantid =='')



		{







			redirect(base_url('team/addCoTenantBlank/'.$id.''));



			



					



		}







		



		$this->load->view('common/popup_header');





		$this->load->view('tenant_cotenant_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	public function updateCO_TenantData()



	{



		$owner_id = $this->session->userdata('owner_id');







		if(!empty($_POST))



		{



			$id= $this->input->post('id_1');







				



			$id_2= $this->input->post('id_2');



			$tenant_id= $this->input->post('tenant_id');







			$Co_applicant_name_1 =	$this->input->post('co_applicant_name_1');



			$Co_applicant_mobile_1	=	$this->input->post('co_applicant_mobile_1');



			$Co_applicant_email_1=	$this->input->post('co_applicant_email_1');



			$Co_applicant_name_2 =	$this->input->post('co_applicant_name_2');



			$Co_applicant_mobile_2	=	$this->input->post('co_applicant_mobile_2');



			$Co_applicant_email_2 =	$this->input->post('co_applicant_email_2');











				if ($Co_applicant_name_2 =='') 



				{







					if ($Co_applicant_name_1 =='') {







						redirect(base_url('team/tenants'));



					}



					else



					{



						$coTenantData = array(



							'id'=>$id,



							'tenant_id'=>$tenant_id,



							'co_applicant_name'=>$Co_applicant_name_1,



							'co_applicant_mobile'=>$Co_applicant_mobile_1,



							'co_applicant_email'=>$Co_applicant_email_1



							);



				







						$testingdata= $this->team_model->addCoTenantChackId($coTenantData);





					}



				}



				else



				{



					if ($Co_applicant_name_1 =='') 



					{



						$addTenantData = array(



					'id'=>$id_2,



					'tenant_id'=>$tenant_id,



					'co_applicant_name'=>$Co_applicant_name_2,



					'co_applicant_mobile'=>$Co_applicant_mobile_2,



					'co_applicant_email'=>$Co_applicant_email_2



					);









					$this->team_model->addCoTenantChackId($addTenantData);







					}



					else



					{	



















					$coTenantData = array(



						'id'=>$id,



						'tenant_id'=>$tenant_id,



						'co_applicant_name'=>$Co_applicant_name_1,



						'co_applicant_mobile'=>$Co_applicant_mobile_1,



						'co_applicant_email'=>$Co_applicant_email_1



						);









					$testingdata=$this->team_model->addCoTenantChackId($coTenantData);









					$addTenantData = array(



					'id'=>$id_2,



					'tenant_id'=>$tenant_id,



					'co_applicant_name'=>$Co_applicant_name_2,



					'co_applicant_mobile'=>$Co_applicant_mobile_2,



					'co_applicant_email'=>$Co_applicant_email_2



					);









					$this->team_model->addCoTenantChackId($addTenantData);



					}



				}



		}



		redirect(base_url('team/tenants'));



	}



	public function deleteCotenantData()



	{



			$id=$_POST['id'];



			$this->deleteCotenantOrderDetails($id);



			



	}



	public function deletePrivateNotesData($id)



	{





			$this->deleteprivateDetails($id);



			



	}



	public function deleteprivateDetails($id)



	{



		echo $this->team_model->deletePrivateDetails($id);	



		redirect(base_url('team/tenants'));



	}







	public function deleteCotenantOrderDetails($id)



	{



		echo $this->team_model->deleteCotenantOrderDetails($id);	



	}



	public function addCoTenantBlank($id)



	{		

		$data['tenantData'] =$this->team_model->getTenantUserId($id);


		$this->load->view('common/popup_header');



		$this->load->view('add_cotenants_balnk_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);







	}



	



	public function saveTenantBlankData($id)



	{



		$owner_id = $this->session->userdata('owner_id');











		if(!empty($_POST))



		{



			



		



			$Co_applicant_name_1 =	$this->input->post('co_applicant_name1');



			$Co_applicant_mobile_1	=	$this->input->post('co_applicant_mobile1');



			$Co_applicant_email_1=	$this->input->post('co_applicant_email1');



			$Co_applicant_name_2 =	$this->input->post('co_applicant_name2');



			$Co_applicant_mobile_2	=	$this->input->post('co_applicant_mobile2');



			$Co_applicant_email_2 =	$this->input->post('co_applicant_email2');



			



			if ($Co_applicant_name_2 =='') 



				{



					$coTenantData = array(



					'tenant_id'=>$id,



					'co_applicant_name'=>$Co_applicant_name_1,



					'co_applicant_mobile'=>$Co_applicant_mobile_1,



					'co_applicant_email'=>$Co_applicant_email_1



					);





					$cotenant = $this->team_model->saveCoTenant($coTenantData);





				}else



				{



					$coTenantData = array(



						'tenant_id'=>$id,



						'co_applicant_name'=>$Co_applicant_name_1,



						'co_applicant_mobile'=>$Co_applicant_mobile_1,



						'co_applicant_email'=>$Co_applicant_email_1



						);







						$cotenant = $this->team_model->saveCoTenant($coTenantData);





					$addTenantData = array(



						



						'tenant_id'=>$id,



						'co_applicant_name'=>$Co_applicant_name_2,



						'co_applicant_mobile'=>$Co_applicant_mobile_2,



						'co_applicant_email'=>$Co_applicant_email_2



						);









						$teste = $this->team_model->saveCoTenant($addTenantData);



				}



		}



		redirect(base_url('team/tenants'));







	}



	



	public function getLeaseTermsById($id)



	{	



		$data['tenantData'] =$this->team_model->getTenantUserId($id);



		$data['leasedata'] =$this->team_model->getTenantLeaseData($id);





		$this->load->view('common/popup_header');



		$this->load->view('tenant_lease_terms_popup',$data);



		$this->load->view('common/popup_footer',$data);



		$this->load->view('common/googlemap',$data);

	}







		public function updateLeaseTermsData()



	{



		$owner_id = $this->session->userdata('owner_id');







		if(!empty($_POST))



		{



		



			$id =	$this->input->post('id');



			$start_date  =	$this->input->post('start_date');



			$end_date	=	$this->input->post('end_date');



			$after_lease_end=	$this->input->post('after_lease_end');



			$monthly_rent	 =	$this->input->post('monthly_rent');



			$due_on=	$this->input->post('due_on');



			$security_deposit=	$this->input->post('security_deposit');



			$late_fees_start_on=	$this->input->post('late_fees_start_on');



			$late_fee_type=	$this->input->post('late_fee_type');





			if ($late_fee_type =='one') {







				$late_fee_amount=	$this->input->post('late_fee_amount');



			}else{



				$initial_amount=	$this->input->post('initial_amount');



			$daily_amount=	$this->input->post('daily_amount');



			}







				



			$requestData = array(



				'id'=> $id,



			



				'start_date'=>$start_date,



				'end_date'=>$end_date,



				'after_lease_end'=>$after_lease_end,



				'monthly_rent'=>$monthly_rent,



				'due_on'=>$due_on,



				'security_deposit'=>$security_deposit,



				'late_fees_start_on'=>$late_fees_start_on,



				'late_fee_type'=>$late_fee_type,



				'late_fee_amount'=>$late_fee_amount,



				'initial_amount'=>$initial_amount,



				'daily_amount'=>$daily_amount



			);





			$tenantid = $this->team_model->updateTenantLeaseData($requestData,$id);













		}



		redirect(base_url('team/tenants'));







	}



















	public function get_workerData()



	{



		$worker_id 				=	$this->input->post('worker_id'); 



		$workerData 			=	$this->team_model->getTeams($worker_id);



		$workerServicesData 	=	$this->team_model->getSingleContact_byservices($worker_id);





		$workerData['services'] = $workerServicesData;



		echo json_encode($workerData); exit;



	}







	public function checkEmailExists()



	{



           $worker_id = $this->input->post('id');



			 $email=	$this->input->post('email');







			if(!$this->common_model->check_uniqueEmail($email,$worker_id))



			{



				echo '1';



			}



			else



			{	



				echo'0';



			}



	}







	public function editTeamData()



	{



		$data =array();



		



		if(!empty($_POST))



		{ 



			$worker_id = $this->input->post('id');



			







			$email=	$this->input->post('email');







			if(!$this->common_model->check_uniqueEmail($email,$worker_id))



			{



				$data = $this->session->set_flashdata('errmsg',"Email already exists");



				



				redirect(base_url('team/getTeams'));



				



			}



			$contactname	=	$this->input->post('contact_name');



			$companyname	=	$this->input->post('company_name');



			$address		=	$this->input->post('address');	



			$lat			=	$this->input->post('lat');



			$lng			=	$this->input->post('lng');		



			$mobile			=	$this->input->post('mobile');



			$categories		=	$this->input->post('category');



			$properties		=	$this->input->post('property');



			$notes			=	$this->input->post('notes');



			$userType		=	3;





			



			$teamData = array('contact_name'=>$contactname,'company_name'=>$companyname,



					'address'=>$address,'email'=>$email,



					'lat'=>$lat,'lng'=>$lng,



					'mobile'=>$mobile,'notes'=>$notes



					);









			$this->team_model->editTeamData($teamData,$worker_id);







			$tempArr = array();



			 	$this->team_model->deleteServicesByWorkerId($worker_id);



        		foreach($categories as  $val)



        		{



        			$data = array('user_id'=>$worker_id,'service_id'=>$val);



        			$this->db->insert('worker_services',$data);





        		}	



        



        		$tempArr = array();



			 	$this->team_model->deletePropertyByWorkerId($worker_id);



        		foreach($properties as  $val)



        		{



        			$data = array('user_id'=>$worker_id,'property_id'=>$val);



        			$this->db->insert('worker_property',$data);





        		}	



      



			 



		}



		redirect(base_url('team/getTeams'));



	}



}



