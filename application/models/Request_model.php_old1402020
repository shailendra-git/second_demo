<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Request_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//echo '========',$this->owner_id = $this->session->userdata('owner_id'); exit;
		$this->owner_id = $this->session->userdata('owner_id');
		$this->agent_condition = "";
		
		if($this->session->userdata('agent_properties')!="")
		{

			 $this->agent_condition = " AND onelane_properties.id
			 IN (".$this->session->userdata('agent_properties').") ";
		}
 
		
	}

	public function paymentHistory()
	{
		return $this->db->query("SELECT *,DATE_FORMAT(".$this->db->dbprefix."payment_details.created_at,'  %M %d %Y') AS start_date,DATE_FORMAT(".$this->db->dbprefix."payment_details.next_subcription_date,'  %M %d %Y') AS end_date  FROM onelane_payment_details
		WHERE onelane_payment_details.user_id=".$this->owner_id)->result_array();
		
	}


	public function saveTask($data = array())
	{
		if(!empty($data))
		{
			$data['owner_id'] = $this->owner_id;
			$this->db->insert('maintenance_request',$data);
			return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;	
		}
		return FALSE;
	}
	

	public function updateTask($requestid,$data)
	{
	
		$this->db->where(array('id'=>$requestid));
		$this->db->update('maintenance_request',$data);
	    
	}

	public function updateWorkOrder($workorderid,$data)
	{
	
		$this->db->where(array('id'=>$workorderid));
		$this->db->update('maintenance_request_work_order',$data);
	    
	}
	public function getRequestData($status,$propertyid=0)
	{	
		$property_where = " ";
		if($propertyid >0)
		{

			$property_where = " AND ".$this->db->dbprefix."maintenance_request.property_id='".$propertyid."'";
		}
		return $this->db->query("
			SELECT
			DATE_FORMAT(onelane_maintenance_request.created_at,'  %M %D %Y') AS formatted_date, 
			".$this->db->dbprefix."maintenance_request.request_text,
			".$this->db->dbprefix."maintenance_request.id,
			".$this->db->dbprefix."maintenance_request.unit_id,
			onelane_property_units.unit,
			".$this->db->dbprefix."maintenance_request.ref_id,
			".$this->db->dbprefix."maintenance_request.property_id,
			".$this->db->dbprefix."maintenance_request.owner_id,
			".$this->db->dbprefix."maintenance_request.service_id,
			".$this->db->dbprefix."maintenance_request.status,
			".$this->db->dbprefix."properties.address,
			".$this->db->dbprefix."users.firstname,
			".$this->db->dbprefix."users.lastname,".$this->db->dbprefix."services.name,
			".$this->db->dbprefix."maintenance_request.created_at
			FROM ".$this->db->dbprefix."maintenance_request 




			JOIN ".$this->db->dbprefix."properties ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.Id

			JOIN onelane_property_units ON onelane_property_units.id = onelane_maintenance_request.unit_id

			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request.owner_id = ".$this->db->dbprefix."users.id

			JOIN ".$this->db->dbprefix."services ON ".$this->db->dbprefix."maintenance_request.service_id = ".$this->db->dbprefix."services.id 

			 WHERE ".$this->db->dbprefix."properties.owner_id = $this->owner_id ".$this->agent_condition." AND ".$this->db->dbprefix."maintenance_request.status='".$status."'". $property_where." order BY onelane_maintenance_request.id DESC ")->result_array();
		
	}
	
	public function getRequestinfo($id)
	{	
		return $this->db->query("
			SELECT ".$this->db->dbprefix."maintenance_request.request_text,
			".$this->db->dbprefix."maintenance_request.description_text,
			".$this->db->dbprefix."maintenance_request.id,
			".$this->db->dbprefix."maintenance_request.unit_id,
			".$this->db->dbprefix."maintenance_request.ref_id,
			".$this->db->dbprefix."maintenance_request.property_id,
			".$this->db->dbprefix."maintenance_request.owner_id,
			".$this->db->dbprefix."maintenance_request.service_id,
			".$this->db->dbprefix."maintenance_request.status,
			".$this->db->dbprefix."properties.address,
			".$this->db->dbprefix."users.firstname,
			".$this->db->dbprefix."users.lastname,
			".$this->db->dbprefix."services.name,

			".$this->db->dbprefix."maintenance_request.created_at,DATE_FORMAT(".$this->db->dbprefix."maintenance_request.created_at,'  %M %d %Y') AS formatted_date 
			FROM ".$this->db->dbprefix."maintenance_request 
			JOIN ".$this->db->dbprefix."properties ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.Id
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request.owner_id = ".$this->db->dbprefix."users.id
			JOIN ".$this->db->dbprefix."services ON ".$this->db->dbprefix."maintenance_request.service_id = ".$this->db->dbprefix."services.id  WHERE ".$this->db->dbprefix."properties.owner_id = $this->owner_id AND ".$this->db->dbprefix."maintenance_request.id =".$id)->row_array();
		
	}

	public function getRequestTenantinfo($id,$owner_id)
	{	
		return $this->db->query("
			SELECT ".$this->db->dbprefix."maintenance_request.request_text,
			".$this->db->dbprefix."maintenance_request.description_text,
			".$this->db->dbprefix."maintenance_request.id,
			".$this->db->dbprefix."maintenance_request.unit_id,
			".$this->db->dbprefix."maintenance_request.ref_id,
			".$this->db->dbprefix."maintenance_request.property_id,
			".$this->db->dbprefix."maintenance_request.owner_id,
			".$this->db->dbprefix."maintenance_request.service_id,
			".$this->db->dbprefix."maintenance_request.status,
			".$this->db->dbprefix."properties.address,
			".$this->db->dbprefix."users.firstname,
			".$this->db->dbprefix."users.lastname,
			".$this->db->dbprefix."services.name,

			".$this->db->dbprefix."maintenance_request.created_at,DATE_FORMAT(".$this->db->dbprefix."maintenance_request.created_at,'  %M %d %Y') AS formatted_date 
			FROM ".$this->db->dbprefix."maintenance_request 
			JOIN ".$this->db->dbprefix."properties ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.Id
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request.owner_id = ".$this->db->dbprefix."users.id
			JOIN ".$this->db->dbprefix."services ON ".$this->db->dbprefix."maintenance_request.service_id = ".$this->db->dbprefix."services.id  WHERE ".$this->db->dbprefix."properties.owner_id = $owner_id AND ".$this->db->dbprefix."maintenance_request.id =".$id)->row_array();
		
	}

	public function getUnitData($unit_id)
	{
		return $this->db->query("SELECT * FROM onelane_property_units  WHERE onelane_property_units.id=".$unit_id)->row_array();
	}

	public function saveFileRequestDetails($newFilename,$type,$request_id)
	{
		if($type == 'request')
		{
			
			$this->db->insert('maintenance_request_doc',array('file_name'=>$newFilename,'maintenance_id'=>$request_id,'owner_id'=>$this->owner_id));	
			return $this->db->insert_id();	
		}
	}
	

	public function deleteFileRequestDetails($request_id,$filename)
	{
		$this->db->where(array('id'=>$request_id,'file_name'=>$filename));
		$this->db->delete('maintenance_request_doc');	
		// echo $this->db->last_query(); exit;			
	}

	public function getRequestDocs($id)
	{	
		return $this->db->query("SELECT ".$this->db->dbprefix."maintenance_request_doc . * 
		FROM  ".$this->db->dbprefix."maintenance_request_doc 
		WHERE ".$this->db->dbprefix."maintenance_request_doc.maintenance_id=" .$id)->result_array();
	}

	public function getRequestShowWorkOrderImage($id)
	{	
		

		return $this->db->query("SELECT ".$this->db->dbprefix."maintenance_request_doc . * 
		FROM  ".$this->db->dbprefix."maintenance_request_doc 
		INNER JOIN ".$this->db->dbprefix."maintenance_request_work_order ON ".$this->db->dbprefix."maintenance_request_work_order.maintenance_id = ".$this->db->dbprefix."maintenance_request_doc.maintenance_id
		  	WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->result_array();
	}


  public function getPropertyServiceUsers($property_id)
  {
  		return $this->db->query("SELECT CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS service_worker,".$this->db->dbprefix."users.contact_name, ".$this->db->dbprefix."users.company_name, ".$this->db->dbprefix."users.id, ".$this->db->dbprefix."users.email FROM  ".$this->db->dbprefix."users
			INNER JOIN ".$this->db->dbprefix."worker_property ON ".$this->db->dbprefix."worker_property.user_id = ".$this->db->dbprefix."users.id
			WHERE ".$this->db->dbprefix."worker_property.property_id =".$property_id)->result_array();

  }
  

	public function getRequestWorkOrder($id)
	{
			return $this->db->query("
			SELECT ".$this->db->dbprefix."maintenance_request.*
			FROM ".$this->db->dbprefix."maintenance_request 
			JOIN ".$this->db->dbprefix."properties ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.Id
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request.owner_id = ".$this->db->dbprefix."users.id
		  	WHERE ".$this->db->dbprefix."properties.owner_id = $this->owner_id AND ".$this->db->dbprefix."maintenance_request.id =".$id)->row_array();

	}

	public function getRequestWorkOrderId($id)
	{
			return $this->db->query("
			SELECT ".$this->db->dbprefix."maintenance_request.*
			FROM ".$this->db->dbprefix."maintenance_request 
			
			INNER JOIN ".$this->db->dbprefix."maintenance_request_work_order ON ".$this->db->dbprefix."maintenance_request_work_order.maintenance_id = ".$this->db->dbprefix."maintenance_request.id
		  	WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->row_array();

	}

	public function getOwnerRequest()
	{
		
		return $this->db->query("SELECT CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS user_id, ".$this->db->dbprefix."users.id,".$this->db->dbprefix."users.mobile FROM  ".$this->db->dbprefix."users
			WHERE ".$this->db->dbprefix."users.id = $this->owner_id")->result_array();
	}
	public function getUserDataWorkOrder()
	{
		
		return $this->db->query("SELECT CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS user_id, UPPER( CONCAT( SUBSTRING( firstname, 1, 1 ) , SUBSTRING( lastname, 1, 1 ) ) ) AS flname, 
 ".$this->db->dbprefix."users.id,".$this->db->dbprefix."users.mobile,".$this->db->dbprefix."users.created_at,DATE_FORMAT(".$this->db->dbprefix."users.created_at,'%M%d %Y') AS formatted_date FROM  ".$this->db->dbprefix."users
			WHERE ".$this->db->dbprefix."users.id = $this->owner_id")->row_array();
	}
	
	
	
	
	public function requestWorkOrderSaveData($data)
	{
		if(!empty($data))
		{
			$this->db->insert('maintenance_request_work_order',$data);
			return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;	
		}
		return FALSE;
	}

	public function getWorkOrder($id)
	{
	return $this->db->query("
	SELECT ".$this->db->dbprefix."maintenance_request_work_order.work_order_ref_id,
	".$this->db->dbprefix."maintenance_request_work_order.title,
	".$this->db->dbprefix."maintenance_request_work_order.status,
	".$this->db->dbprefix."maintenance_request_work_order.maintenance_id,
	".$this->db->dbprefix."maintenance_request_work_order.service_user_id,
			".$this->db->dbprefix."maintenance_request_work_order.id,
			".$this->db->dbprefix."users.contact_name,
			".$this->db->dbprefix."users.company_name,
			".$this->db->dbprefix."users.mobile,
			".$this->db->dbprefix."users.email
			FROM ".$this->db->dbprefix."maintenance_request_work_order 
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request_work_order.service_user_id = ".$this->db->dbprefix."users.id
		  	WHERE ".$this->db->dbprefix."maintenance_request_work_order.maintenance_id =".$id." order by id DESC")->result_array();	
	}

	public function getworkorderDetails($id)
	{
	return $this->db->query("
	SELECT ".$this->db->dbprefix."maintenance_request_work_order.work_order_ref_id,
	".$this->db->dbprefix."maintenance_request_work_order.title,
	".$this->db->dbprefix."maintenance_request_work_order.maintenance_id,
	".$this->db->dbprefix."maintenance_request_work_order.service_user_id,
			".$this->db->dbprefix."maintenance_request_work_order.id,
			".$this->db->dbprefix."users.contact_name,
			".$this->db->dbprefix."users.company_name,
			".$this->db->dbprefix."users.mobile,
			".$this->db->dbprefix."users.email
			FROM ".$this->db->dbprefix."maintenance_request_work_order 
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request_work_order.service_user_id = ".$this->db->dbprefix."users.id
		  	WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->row_array();	
	}

	public function getWorkOrderInfo($id)
	{	
		return $this->db->query("
			SELECT * ,DATE_FORMAT(".$this->db->dbprefix."maintenance_request_work_order.created_at,'%M %d %Y') AS formatted_date 
			FROM ".$this->db->dbprefix."maintenance_request_work_order   
			WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->row_array();
		
	}
	public function saveFileWorkOrderDetails($newFilename,$type,$workorder_id)
	{
		if($type == 'workorder')
		{
			
			$this->db->insert('maintenance_work_order_doc',array('file_name'=>$newFilename,'workorder_id'=>$workorder_id,'owner_id'=>$this->owner_id));	
			return $this->db->insert_id();	
		}
	}
	public function deleteFileWorkOrderDetails($workorder_id,$filename)
	{
		$this->db->where(array('id'=>$workorder_id,'file_name'=>$filename));
		$this->db->delete('maintenance_work_order_doc');	
		// echo $this->db->last_query(); exit;			
	}
	public function getWorkOrderDocs($id)
	{	
		return $this->db->query("SELECT ".$this->db->dbprefix."maintenance_work_order_doc . * 
		FROM  ".$this->db->dbprefix."maintenance_work_order_doc 
		WHERE ".$this->db->dbprefix."maintenance_work_order_doc.workorder_id=" .$id)->result_array();
	}
	public function getWorkOrderImage($id)
	{	
		return $this->db->query("SELECT ".$this->db->dbprefix."maintenance_work_order_doc . * 
		FROM  ".$this->db->dbprefix."maintenance_work_order_doc 
		INNER JOIN ".$this->db->dbprefix."maintenance_request_work_order ON ".$this->db->dbprefix."maintenance_request_work_order.id = ".$this->db->dbprefix."maintenance_work_order_doc.workorder_id
		  	WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->result_array();
	}

	public function updateWorkOrderdetails($data)
	{
		 $id	=	$data['id'];
		$this->db->where(array('id'=>$id));
		$this->db->update('maintenance_request_work_order',$data);
	}

	public function updatemaintenancedetails($data)
	{
		 $id=$data['id'];
		$this->db->where(array('id'=>$id));
		$this->db->update('maintenance_request',$data);
	}

	public function addUpdateToWorkOrder($data)
	{    
		$update_row = $this->db->get_where('maintenance_work_order_update',array('workorder_id'=>$data['workorder_id'],'update_content'=>$data['update_content']));
		if($update_row->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
				$this->db->insert('maintenance_work_order_update',array('update_content'=>$data['update_content'],'workorder_id'=>$data['workorder_id']));
			return TRUE;	
		}
	}

	public function getUpdateWorkOrder($id)
	{
	return $this->db->query("
	SELECT * 
		FROM ".$this->db->dbprefix."maintenance_work_order_update 
		 WHERE ".$this->db->dbprefix."maintenance_work_order_update.workorder_id =".$id." ORDER BY id DESC")->result_array();	
	}

	public function requestUpdateForm($data)
	{
		$update_row = $this->db->get_where('maintenance_request_update',array('maintenance_id'=>$data['maintenance_id'],'update_content'=>$data['update_content']));
		if($update_row->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			$posted_column = $data['column'] == 'owner_id' ? 'owner_id' : 'tenant_id';
			$insertdata[$posted_column] = $data['postedby'];
			$insertdata['update_content'] = $data['update_content'];
			$insertdata['maintenance_id'] = $data['maintenance_id'];

				/*$this->db->insert('maintenance_request_update',array('update_content'=>$data['update_content'],'maintenance_id'=>$data['maintenance_id'],$posted_column));*/
				$this->db->insert('maintenance_request_update',$insertdata);
			return TRUE;	
		}
	}

	public function getSingleContact_byservices($id)
	{	
		return $this->db->query("
			SELECT 
			
			".$this->db->dbprefix."maintenance_request.service_id,
			".$this->db->dbprefix."maintenance_request.created_at,DATE_FORMAT(".$this->db->dbprefix."maintenance_request.created_at,'  %M %d %Y') AS formatted_date 
			FROM ".$this->db->dbprefix."maintenance_request 
			JOIN ".$this->db->dbprefix."properties ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.Id
			JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."maintenance_request.owner_id = ".$this->db->dbprefix."users.id
			JOIN ".$this->db->dbprefix."services ON ".$this->db->dbprefix."maintenance_request.service_id = ".$this->db->dbprefix."services.id  WHERE ".$this->db->dbprefix."properties.owner_id = $this->owner_id AND ".$this->db->dbprefix."maintenance_request.id =".$id)->row_array();
		
	}


	public function getUpdateReqest($id)
	{

	return $this->db->query("
	SELECT * 
		FROM ".$this->db->dbprefix."maintenance_request_update 
		 WHERE ".$this->db->dbprefix."maintenance_request_update.maintenance_id =".$id." order by id DESC")->result_array();	
	}

	public function getUserData($id)
	{
		return $this->db->query("SELECT*
			 FROM onelane_users WHERE onelane_users.id=".$id)->row_array();
		
	}


	public function addAssignStatus($data)
	{
		$update_row = $this->db->get_where('maintenance_request',array('id'=>$data['id'],'status'=>$data['status']));
		if($update_row->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			$this->db->where(array('id'=>$data['id']));
			$new_data['status'] = $data['status'];
			$this->db->update('maintenance_request',$new_data);
			return TRUE;	
		}
		$update_row = $this->db->get_where('maintenance_request',array('id'=>$data['id'],'status'=>$data['status']));
			
			$this->db->update('maintenance_request',$data);
	}
	public function allWorkOrderStatus($data)
	{
		$update_row = $this->db->get_where('maintenance_request_work_order',array('status'=>$data['status']));
			
			$this->db->update('maintenance_request_work_order',$data);
			
	}


	public function workOrderStatus($data)
	{
		$update_row = $this->db->get_where('maintenance_request_work_order',array('id'=>$data['id'],'status'=>$data['status']));
		if($update_row->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			$this->db->where(array('id'=>$data['id']));
			$new_data['status'] = $data['status'];
			$this->db->update('maintenance_request_work_order',$new_data);
			return TRUE;	
		}
	}


	

	public function getWorkOrderAddressUnit($id)
	{	
		return $this->db->query("
			SELECT *
			FROM ".$this->db->dbprefix."maintenance_request_work_order
			JOIN  ".$this->db->dbprefix."maintenance_request ON ".$this->db->dbprefix."maintenance_request_work_order.maintenance_id = ".$this->db->dbprefix."maintenance_request.id
		 WHERE ".$this->db->dbprefix."maintenance_request_work_order.id =".$id)->row_array();	
	}

	public function getFinalWorkOrderAddress($property_id)
  {
  		return $this->db->query("SELECT ".$this->db->dbprefix."properties.address,".$this->db->dbprefix."maintenance_request.unit_id FROM  ".$this->db->dbprefix."properties
			INNER JOIN ".$this->db->dbprefix."maintenance_request ON ".$this->db->dbprefix."maintenance_request.property_id = ".$this->db->dbprefix."properties.id
			WHERE ".$this->db->dbprefix."maintenance_request.property_id =".$property_id)->row_array();

  }
 public function getMaintenanceData($id)
	{
		return $this->db->query("SELECT*
			FROM onelane_maintenance_request
				WHERE onelane_maintenance_request.id=".$id)->row_array();
	}
	public function saveWorkOrderInvoice($data)
	{
        
		if(!empty($data))
		{
			$this->db->insert('work_order_invoice',$data);
			return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;	
		}
		return FALSE;
	}

	public function saveWorkOrderScheduling($data)
	{
		if(!empty($data))
		{
			$this->db->insert('work_order_scheduling',$data);
			return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;	
		}
		return FALSE;
	}

	public function getWorkOrderInvoiceDetails($id)
	{	
		return $this->db->query("
			SELECT * ,DATE_FORMAT(".$this->db->dbprefix."work_order_invoice.due_date,'%M %D %Y') AS formatted_date 
			FROM ".$this->db->dbprefix."work_order_invoice   
			WHERE ".$this->db->dbprefix."work_order_invoice.workorder_id =".$id)->result_array();
		
	}
	public function downloadInvoice($id)
	{	

		return $this->db->query("
			SELECT *  
			FROM ".$this->db->dbprefix."work_order_invoice   
			WHERE ".$this->db->dbprefix."work_order_invoice.id =".$id)->row_array();
		
	}
	public function getWorkOrderSchedule($id)
	{	
		
		return $this->db->query("
			SELECT    CONCAT(".$this->db->dbprefix."work_order_scheduling.cus_fname,' ',".$this->db->dbprefix."work_order_scheduling.cus_lname) AS custom_client , CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS service_worker,".$this->db->dbprefix."users.mobile,".$this->db->dbprefix."work_order_scheduling.owner_id, ".$this->db->dbprefix."work_order_scheduling.id,".$this->db->dbprefix."work_order_scheduling.cus_phone
			FROM ".$this->db->dbprefix."work_order_scheduling
			LEFT JOIN ".$this->db->dbprefix."users ON ".$this->db->dbprefix."users.id = ".$this->db->dbprefix."work_order_scheduling.owner_id
			WHERE ".$this->db->dbprefix."work_order_scheduling.workorder_id =".$id)->result_array();
	}

//12-10-2019 create function 
	public function getUserDataWorkOrder_User($owner_id)
		{
			
			return $this->db->query("SELECT CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS user_id, UPPER( CONCAT( SUBSTRING( firstname, 1, 1 ) , SUBSTRING( lastname, 1, 1 ) ) ) AS flname, 
	 ".$this->db->dbprefix."users.id,".$this->db->dbprefix."users.mobile,".$this->db->dbprefix."users.created_at,DATE_FORMAT(".$this->db->dbprefix."users.created_at,'%M%d %Y') AS formatted_date FROM  ".$this->db->dbprefix."users
				WHERE ".$this->db->dbprefix."users.id = ".$owner_id)->row_array();
		}
			
	public function getOwnerRequest_User($owner_id)
	{
		
		return $this->db->query("SELECT CONCAT(".$this->db->dbprefix."users.firstname,' ',".$this->db->dbprefix."users.lastname) AS user_id, ".$this->db->dbprefix."users.id,".$this->db->dbprefix."users.mobile FROM  ".$this->db->dbprefix."users
			WHERE ".$this->db->dbprefix."users.id = ".$owner_id)->result_array();
	}	
    
    public function saveFileWorkOrderDetails_User($newFilename,$type,$workorder_id)
	{
		if($type == 'workorder')
		{
			
			$this->db->insert('maintenance_work_order_doc',array('file_name'=>$newFilename,'workorder_id'=>$workorder_id,'owner_id'=>0));	
			return $this->db->insert_id();	
		}
	}
 //15-10-2019 create date
    public function getUserDataForEmail($parent_user_id)
	{   
		return $this->db->query("
			SELECT *  
			FROM ".$this->db->dbprefix."users   
			WHERE ".$this->db->dbprefix."users.id =".$parent_user_id)->result_array();
	}

 
}