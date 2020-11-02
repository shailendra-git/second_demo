<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Common_model extends CI_Model



{



	public function __construct()



	{







	}







	public function getServices($id = NULL)



	{



		if($id != NULL)



		{







		}



		return $this->db->get('services')->result_array();



	}







	public function getProperty($id = NULL)



	{



		if($id != NULL)



		{







		}



		return $this->db->get('properties')->result_array();



	}







	















	public function check_uniqueEmail($email,$user_id=0)



	{



		$this->db->where('email',$email);



		if($user_id>0)



		{



			$this->db->where('id !=',$user_id);	



		}



		$rowData = $this->db->get('users');



		return $rowData->num_rows() > 0 ? FALSE : TRUE;



	}



	public function check_emailExists($email)



	{



		$this->db->where('email',$email);



		$rowData = $this->db->get('users');



		return $rowData->num_rows() > 0 ? TRUE : FALSE;



	}



	public function registerUserSave($data)



	{



		$this->db->insert('users',$data);



		return $this->db->insert_id();



	}



	











	public function updateUserData($data,$id)



	{



		$this->db->where('id',$id);



		$this->db->update('users',$data);



	}











	







	function is_email_available($email)  



	  {  



	       $this->db->where('email', $email);  



	       $query = $this->db->get("users");  



	       if($query->num_rows() > 0)  



	       {  



	            return true;  



	       }  



	       else  



	       {  



	            return false;  



	       }  



	  }







	public function getUserByEmail($email)

	{



		$this->db->where('email',$email);



		$rowarr = $this->db->get('users');







		if($rowarr->num_rows()>0) 
		{
		   return  $rowarr->row_array();
		}
		else
		{
		    return FALSE;
		}



	}







	public function getUserData($id)



	{
		return $this->db->query("SELECT*, CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS user,".$this->db->dbprefix."users.password

			 FROM onelane_users WHERE onelane_users.id=".$id)->row_array();

	}

	public function tenantData($id)
	{

		return $this->db->query("SELECT*
			 FROM onelane_property_tenant WHERE onelane_property_tenant.id=".$id)->row_array();

	}

	public function updateTenantdata($id,$tenantid)
	{
		$this->db->where(array('id'=>$id));
		$this->db->update('onelane_property_tenant',$tenantid);

	}

	public function getworkerUserData($worker_id)
	{

		return $this->db->query("SELECT onelane_maintenance_request_work_order.*

			 FROM onelane_maintenance_request_work_order WHERE onelane_maintenance_request_work_order.id=".$worker_id)->row_array();

	}



	public function getworkerUserPerticularData($maintenance_id)
	{

		return $this->db->query("SELECT onelane_maintenance_request_work_order.*

			 FROM onelane_maintenance_request_work_order WHERE onelane_maintenance_request_work_order.id=".$maintenance_id)->row_array();

	}

	public function workOrderDataById($maintenance_id)
	{
		return $this->db->query("SELECT *

			 FROM onelane_maintenance_request_work_order
			 INNER JOIN onelane_maintenance_request ON  onelane_maintenance_request.id = onelane_maintenance_request_work_order.maintenance_id

			 INNER JOIN onelane_users ON  onelane_users.id = onelane_maintenance_request_work_order.service_user_id


			  WHERE onelane_maintenance_request_work_order.status='Open' AND onelane_maintenance_request_work_order.maintenance_id=".$maintenance_id)->result_array();



		



		



	}



	 public function workOrderDataById_copy($maintain_id)



	{



		return $this->db->query("SELECT *



			 FROM onelane_maintenance_request_work_order



			 



			  WHERE onelane_maintenance_request_work_order.maintenance_id=".$maintain_id)->result_array();



		



		



	}



	public function workOrderDetailsById($workOrder_id)



	{



		return $this->db->query("SELECT* 



			FROM onelane_maintenance_request_work_order WHERE onelane_maintenance_request_work_order.id=".$workOrder_id)->result_array();



	}



	public function getMaintenanceData($maintenance_id)



	{



		return $this->db->query("SELECT*



			FROM onelane_maintenance_request



				WHERE onelane_maintenance_request.id=".$maintenance_id)->row_array();



	}



	public function getPropertyData($getPropertyId)



	{



		return $this->db->query("SELECT*



			FROM onelane_properties



				WHERE onelane_properties.id=".$getPropertyId)->row_array();



	}



	public function getUnitData($getUnitId)



	{

		// print_r($getUnitId);

		// exit();

		return $this->db->query("SELECT *



			FROM onelane_property_units



				WHERE  onelane_property_units.id =".$getUnitId)->row_array();



	}



	public function getServiceData($getServiceId)



	{



		return $this->db->query("SELECT*



			FROM onelane_services



				WHERE onelane_services.id=".$getServiceId)->row_array();



	}



















	 public function getEmailData($email_type)



	{



		return $this->db->query("SELECT onelane_emails.*



			 FROM onelane_emails WHERE onelane_emails.email_type='".$email_type."'")->row_array();


	}



	public function send_mail($email,$email_type,$data,$email_subject='') { 


         $from_email = "hello@onelane.com.au"; 



         $to_email = $email; 
         //$to_email = ""; 


         $email_result= $this->getEmailData($email_type);
         //  echo $email;
         // exit;


       	$body_email = $email_result['email_body'];

        

         $this->load->library('email'); 
         $this->email->initialize(array("mailtype"=>"html"));


         $this->email->from($from_email, 'Onelane'); 



         $this->email->to($to_email);
		//$this->email->mailtype("html");

        if($email_subject == ''){
              $this->email->subject($email_result['email_subject']); 
        }else{
             $this->email->subject($email_subject); 
        }
        



         foreach($data as $key => $value)
		{
            

			$body_email = str_replace("{".$key."}",$value,$body_email);

		}
		// echo $email_subject;
		// exit;

        $this->email->message($body_email); 

        $this->email->send();

      } 


    public function savePaymentDetailsData($data)
	{

		$this->db->insert('payment_details',$data);



		return $this->db->insert_id();
	}
	
	public function check_forgotPasswordData($user_id,$forgotcode,$forgotcodetoken)
	{
	   return $detailsData = $this->db->get_where('users',array('id'=>$user_id,'forgotcode'=>$forgotcode,'forgot_token'=>$forgotcodetoken));
	    
	}

	// check subscription 
	public function check_subscription($owner_id)
	{
		$subs_status = [];
		$userDetails = $this->db->get_where('onelane_subscription_status',array('user_id'=>$owner_id));
		//echo $this->db->last_query();  exit;
		if($userDetails->num_rows()==1)
		{
			$userData = $userDetails->row_array();
			$endDate = strtotime($userData['enddate']);
			// compare dates
			$todayDate = strtotime(date('Y-m-d'));
			if($todayDate > $endDate)
			{
				//exit('greater');
				//return FALSE;
				$subs_status['error'] = 'enddate';
			}
			else
			{
				//exit('ok');
				//return TRUE;
				$subs_status['error'] = 'success';
			}
		}
		else
		{
			$subs_status['error'] = 'notavailable';
		}

		return $subs_status;
	}
	// check units available if plan is valid
	public function check_units_purchased($owner_id)
	{
		$userDetails = $this->db->get_where('onelane_subscription_status',array('user_id'=>$owner_id))->row_array();
		return $userDetails;
	}

	public function getPlanDetails()
	{
		return $this->db->get('onelane_plan')->row_array();
	}

	public function freeSubscription($id,$units,$amount,$perunitprice,$baseprice)
	{
		$data['enddate'] 			= date('Y-m-d', strtotime("+30 days"));
		$data['startdate']			= date('Y-m-d');
		$data['plan_type']			= 1;
		$data['user_id']			= $id;
		$data['units_purchased']	= $units;
		$data['total_amount']		= $amount;
		$data['unit_price']			= $perunitprice;
		$data['base_price']			= $baseprice;

		$this->db->insert('onelane_subscription_status',$data);
	}

	public function update_plan_status($id,$data)
	{	
		$this->db->where('user_id',$id);
		$this->db->update('onelane_subscription_status',$data);
	}

	public function is_payment_details_avilable($user_id)
	{
		return $this->db->get_where('payment_details',array('user_id'=>$user_id))->num_rows();	
	}

	public function units_consumed($user_id)
	{
		return $this->db->query('SELECT COUNT(unit) as unit_consumed FROM `onelane_property_units` WHERE `owner_id` ='.$user_id)->row_array();
	}

	public function userProfile($user_id){

       return $this->db->query('SELECT * FROM `onelane_users` WHERE `id`='.$user_id)->row_array();

	}

	public function getUserReferred($data){
         
		$this->db->insert('onelane_referred_user',$data);

		return $this->db->insert_id();

    }
    
    public function getReferredByEmail($email)
	{

		$this->db->where('email',$email);
		$rowarr = $this->db->get('onelane_referred_user');
		if($rowarr->num_rows()>0) 
		{
		   return  $rowarr->row_array();
		}
		else
		{
		    return FALSE;
		}
	}
    
    public function updateReferredFriend($referred_id,$referredUpdate)
	{
		$this->db->where(array('id'=>$referred_id));
		$this->db->update('onelane_referred_user',$referredUpdate);

	}

	public function downloadAllUserCSV($user_type)
	{

	  if(!empty($user_type)){

		 $this->db->where('user_type',$user_type);
		 $this->db->order_by("id", "desc");
         $query=$this->db->get('users');

      }

 
        return $query->result_array();
	}

    public function downloadReferred($email)
	{
       
          $this->db->where('email',$email);
	      $query=$this->db->get('onelane_referred_user');

        return $query->row_array();
	}

	public function downloadReferredFriendName($user_id)
	{
         
			$this->db->where('id',$user_id);
	        $query=$this->db->get('users');
   
        return $query->row_array();
	}



}