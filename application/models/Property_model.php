<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Property_model extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->owner_id = $this->session->userdata('owner_id'); 

		$this->agent_properties = $this->session->userdata('agent_properties');

		$this->agent_permissions = $this->session->userdata('agent_permissions');

		$this->agent_condition = "";

		if($this->session->userdata('agent_properties')!="")

		{

			 $this->agent_condition = " AND onelane_properties.id

			 IN (".$this->session->userdata('agent_properties').") ";


		}

	}


	public function checkAgentProperty($property_id)
	{

			$agent_id = $this->session->userdata('agent_id') ? $this->session->userdata('agent_id'): '';

			//echo 'Raj',$agent_id; exit;
		if($agent_id !='')
		{
			//exit('5858');
			$property_alot = $this->db->get_where('onelane_agent_property',array('property_id'=>$property_id,'agent_id'=>$agent_id))->num_rows();

			//echo $this->db->last_query();

			if($property_alot < 1) 
			{
				return FALSE;
			}
			else
				return TRUE;
		
		}
		else
		{
			return TRUE;
		}
		
	}

	

	public function getProperties($property_id = NULL)

	{

		if($property_id != NULL)

		{
			//exit($property_id);
			/*$agent_id = $this->session->userdata('agent_id') ? $this->session->userdata('agent_id'): '';
		if($agent_id > 0)
		{
			//exit('5858');
			$property_alot = $this->db->get_where('onelane_agent_property',array('property_id'=>$property_id))->num_rows();
			if($property_alot < 1) 
			{
				return FALSE;
			}
		
		}*/
		

			return $this->db->get_where('properties',array('id'=>$property_id))->row_array();
			//echo $this->db->last_query(); exit;

		}


		$rows =  $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties  WHERE onelane_properties.owner_id = $this->owner_id ".$this->agent_condition." ")->result_array();

		

		if(count($rows)>0)

		{

			for($j=0;$j<count($rows);$j++)

			{

				$rows[$j]['unitscount'] =$this->getUnitsCountByPropertyId($rows[$j]['id']);


			}

		}

		return $rows;

		
	}		





	public function getRequestData($status='Open',$propertyid=0)

	{	

		

		return $this->db->query("

			SELECT *

			FROM ".$this->db->dbprefix."properties 

			  WHERE ".$this->db->dbprefix."properties.owner_id = $this->owner_id ".$this->agent_condition." AND ".$this->db->dbprefix."properties.status='".$status."' order BY onelane_properties.id DESC")->result_array();
		

	}



	public function getUnitsCountByPropertyId($propertyid)

	{



		return $this->db->select('count(*) AS unitscount')

                  ->get_where('onelane_property_units', array('property_id' => $propertyid))->row()->unitscount;

	}

	
	public function getUserType($id = NULL)
	{



		if($id !='')

		{

			return $this->db->get_where('users',array('id'=>$id,'added_by'=>$this->owner_id))->row_array();	

		}


		return $this->db->get_where('users',array('user_type =3 OR user_type=4 AND parent_user_id = '.$this->owner_id))->result_array();

	}





	public function getPaymentDetailByUserId()

	{

		return $this->db->query("SELECT * ,SUM(num_of_properties) AS subscribe_properties  FROM  onelane_payment_details

		WHERE next_subcription_date	 >= NOW() AND onelane_payment_details.user_id=".$this->owner_id)->row_array();

	}





	public function chackPaymentDetails()

	{

	return $this->db->query("SELECT onelane_payment_details.* ,SUM(num_of_properties) AS subscribe_properties FROM  onelane_payment_details



	INNER JOIN onelane_users ON onelane_users.id = onelane_payment_details.user_id



	WHERE next_subcription_date	 >= NOW() AND onelane_payment_details.user_id=".$this->owner_id)->row_array();

	}





	public function getPropertiesWithUnits()

	{


		return $this->db->query("SELECT pro.address,units.unit,pro.id FROM `onelane_property_units` as units inner JOIN onelane_properties as pro ON pro.id = units.property_id WHERE pro.owner_id = $this->owner_id AND units.owner_id=$this->owner_id order BY units.property_id ASC")->result_array();

	}



	public function getVacantAndUnlistedProperty()

	{

		return $this->db->query("SELECT count(*) as unitscount ,count(onelane_property_units.tenant_id) AS vacantunit, onelane_properties.id, onelane_property_units.unit,onelane_properties.address FROM onelane_property_units LEFT JOIN onelane_properties ON onelane_properties.id = onelane_property_units.property_id WHERE onelane_properties.owner_id = $this->owner_id AND onelane_property_units.tenant_id = 0 GROUP BY onelane_property_units.property_id")->result_array();

	}



	public function saveProperty($data)

	{

		$data['owner_id'] = $this->owner_id;

		$this->db->insert('properties',$data);

		$property_id = $this->db->insert_id();

		$this->db->insert('property_guide',array('property_id'=>$property_id,'owner_id'=>$this->owner_id));



	}



	public function getPropertiesUnits($property_id)

	{


		return $this->db->get_where('property_units',array('property_id'=>$property_id,'status'=>1,'owner_id'=>$this->owner_id))->result_array();
		

    }

	public function getPropertiesUnitsStatus($property_id,$status)

	{

		return $this->db->query("SELECT * FROM onelane_property_units WHERE onelane_property_units.property_id = $property_id AND onelane_property_units.status = $status AND onelane_property_units.owner_id=$this->owner_id order BY onelane_property_units.id DESC")->result_array();

	}



	public function editproperty_basicinfo($data)

	{

		$property_id	=	$data['property_id'];

		unset($data['property_id']);

		$this->db->where(array('id'=>$property_id,'owner_id'=>$this->owner_id));

		$this->db->update('properties',$data);

	}







	public function addUnitToProperty($data)
	{
		// Count the unit consumed
		$unitConsumed = $this->db->get_where('onelane_property_units',array('owner_id'=>$this->owner_id))->num_rows();

		// Check unit purchased by the owner
		$unitDetails = $this->db->get_where('onelane_subscription_status',array('user_id'=>$this->owner_id))->row_array();

		$units_purchased = $unitDetails['units_purchased'];

		$response = array();

		if($unitConsumed >= $units_purchased)
		{
			$response['rescode'] 	= 	100;
			$response['msg']		=	'Unit Consumed';
			return $response;
		}

		$unit_row = $this->db->get_where('property_units',array('property_id'=>$data['property_id'],'unit'=>$data['unit'],'owner_id'=>$this->owner_id));

		if($unit_row->num_rows() > 0)

		{

			$response['rescode'] 	= 	200;
			$response['msg']		=	'Unit Exists';
			return $response;

		}

		else

		{

			$this->db->insert('property_units',array('unit'=>$data['unit'],'property_id'=>$data['property_id'],'owner_id'=>$this->owner_id));

			//return TRUE;	
			$response['rescode'] 	= 	300;
			$response['msg']		=	'Successfully Added';
			return $response;

		}

	}

	// Added By rajmander

	public function check_familyhome_status($data)
	{
	
		return $this->db->get_where('property_units',$data)->num_rows();

	}

	public function updateUnitToProperty($data)

	{	

		

		

		$result = $this->db->query("SELECT onelane_property_units . * 

		FROM  onelane_property_units 

		WHERE onelane_property_units.property_id=".$data['property_id']." AND onelane_property_units.unit ='".$data['unit']."' AND onelane_property_units.id !='".$data['id']."'")->row_array();

			

		if(!empty($result) && $result['id']>0)

		{

			return false;

		}

		else

		{

			$this->db->where(array('id'=>$data['id']));

			$new_data['unit'] = $data['unit'];

			$new_data['status'] = $data['status'];
			$new_data['familyhome_status'] = $data['familyhome_status'];

			$this->db->update('property_units',$new_data);

			return true;

		}

	}



	public function saveFileDetails($newFilename,$type,$pro_id)

	{

		if($type == 'prop')

		{

			$this->db->insert('property_doc',array('file_name'=>$newFilename,'property_id'=>$pro_id));	

			return $this->db->insert_id();	

		}

	}



	public function deleteFileDetails($pro_id,$filename)

	{

		$this->db->where(array('property_id'=>$pro_id,'file_name'=>$filename));

		$this->db->delete('property_doc');	

		

	}



	public function saveTenantFileDetails($newFilename,$type,$id)

	{

		if($type == 'tenant')

		{

			$this->db->insert('tenant_docs',array('file_name'=>$newFilename,'tenant_id'=>$id));	

			return $this->db->insert_id();	

		}

	}



	public function deleteTenantFileDetails($id,$filename)

	{

		$this->db->where(array('tenant_id'=>$id,'file_name'=>$filename));

		$this->db->delete('tenant_docs');	

				

	}

	public function getTenantDocs($id)

	{

		return $this->db->query("SELECT * FROM onelane_tenant_docs WHERE onelane_tenant_docs.tenant_id=".$id)->result_array();

	}


	public function getgovtTenantDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_tenant_govt_docs WHERE onelane_tenant_govt_docs.tenant_id=".$id)->result_array();
	}


	public function getPropertyDocs($property_id)

	{

		return $this->db->get_where('property_doc',array('property_id'=>$property_id))->result_array();

	}

	public function getProperty()

	{

		return $this->db->query("SELECT onelane_properties.owner_id FROM onelane_properties

		INNER JOIN  onelane_users ON onelane_users.id = onelane_properties.owner_id



		WHERE onelane_properties.owner_id =".$this->owner_id)->row_array();

	}



	public function getPropertyOpen()

	{

		return $this->db->query("SELECT onelane_properties.owner_id FROM onelane_properties

		INNER JOIN  onelane_users ON onelane_users.id = onelane_properties.owner_id



		WHERE onelane_properties.owner_id=".$this->owner_id." AND  onelane_properties.status = 'Open'")->result_array();

	}



	





	public function getAllPropertyData()



	{

		return $this->db->query("SELECT * FROM onelane_properties WHERE  owner_id= ".$this->owner_id."$this->agent_condition")->result_array();

	}



	public function getPropertyWithUnitsData()

	{
		 // $this->agent_condition_custom = " AND op.id
			//  IN (".$this->session->userdata('agent_properties').")";
		$this->agent_condition_custom = "";

		if($this->session->userdata('agent_properties')!="")

		{

			 $this->agent_condition_custom = " AND op.id

			 IN (".$this->session->userdata('agent_properties').") ";


		}

		return   $this->db->query("SELECT DISTINCT op.id, op.address FROM onelane_properties op inner JOIN onelane_property_units opu ON op.id= opu.property_id WHERE op.status='Open' AND opu.owner_id=".$this->owner_id."$this->agent_condition_custom GROUP BY op.id")->result_array();
       // echo  $this->db->last_query(); exit;

	}

	public function getPropertyData()

	{

		return $this->db->query("SELECT * FROM onelane_properties WHERE status='Open' AND  owner_id=".$this->owner_id."$this->agent_condition")->result_array();
		

	}

	public function getPermissionsData($worker_id)

	{

		return $this->db->query("SELECT * FROM onelane_agent_permissions

		 WHERE onelane_agent_permissions.agent_id=".$worker_id)->row_array();

	}


	public function getPopertyGuideData($property_id)
	{

		 return $this->db->get_where('property_guide',array('property_id'=>$property_id))->row_array();

	}



	public function deletePropertyGuideData($property_id)
	{

	$this->db->where(array('property_id'=>$property_id));

		$this->db->delete('property_guide');

	}

	public function updatePropertyGuideData($data)

	{


		$property_id = $data['id'];

		$this->db->where(array('id'=>$property_id));

		$this->db->update('property_guide',$data);



	}

	public function saveFilePropertyGuideDetails($newFilename,$type,$pro_id)
	{

		if($type == 'prop')

		{

			$this->db->insert('property_guide_doc',array('file_name'=>$newFilename,'property_guide_id'=>$pro_id));	

			return $this->db->insert_id();	

		}

	}

	public function deleteFilePropertyGuideDetails($pro_id,$filename)

	{

		$this->db->where(array('property_guide_id'=>$pro_id,'file_name'=>$filename));

		$this->db->delete('property_guide_doc');	

	
	}



	public function getPropertyGuideDocs($property_id)



	{

			return $this->db->query("SELECT * FROM onelane_property_guide_doc

INNER JOIN  onelane_property_guide ON  onelane_property_guide.property_id = onelane_property_guide_doc.property_guide_id

WHERE onelane_property_guide_doc.property_guide_id=".$property_id)->result_array();

	}

	
	public function getManitenenceProperty($property_id = NULL)

	{

		if($property_id != NULL)

		{

			// fetch single property

			return $this->db->get_where('properties',array('id'=>$property_id))->row_array();

		}



		return $this->db->query("SELECT count(*) as maintenanceopen ,onelane_properties.id, onelane_maintenance_request.property_id

			 FROM onelane_maintenance_request INNER JOIN onelane_properties ON onelane_properties.id = onelane_maintenance_request.property_id WHERE onelane_properties.owner_id = $this->owner_id GROUP BY onelane_maintenance_request.property_id")->result_array();

		

	}

	public function getManitenenceOpen($id)

	{

		

		$arr = $this->db->query("SELECT count(*) as maintenanceopen

			 FROM onelane_maintenance_request INNER JOIN onelane_properties ON onelane_properties.id = onelane_maintenance_request.property_id WHERE onelane_maintenance_request.property_id=".$id." AND onelane_maintenance_request.status='Open'")->row_array();

		return $arr['maintenanceopen'];

	}

	// Added by Rajmander
	// Count Maintenance OPEN
	public function maintainence_count()
	{
		$this->db->select('count(*) as totalmaintainence');
		$this->db->from('maintenance_request');
		$this->db->where('maintenance_request.owner_id',$this->owner_id);
		$this->db->where('maintenance_request.status','Open');
		$result = $this->db->get();
		return $result->num_rows() > 0 ? $result->num_rows() : 0;  
	}
	//Count Tenants
	public function tenant_count()
	{
		$this->db->select('count(*) as totaltenant');
		$this->db->from('onelane_property_tenant');
		$this->db->where('onelane_property_tenant.owner_id',$this->owner_id);
		$result = $this->db->get();
		return $result->num_rows() > 0 ? $result->num_rows() : 0;  
	}


	public function getTenantgovtDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_tenant_govt_docs WHERE onelane_tenant_govt_docs.tenant_id=".$id)->result_array();
	}

	public function getTenantRenterDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_tenant_renter_docs WHERE onelane_tenant_renter_docs.tenant_id=".$id)->result_array();
	}



public function getTenantdocumentDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_maintenance_request_doc WHERE onelane_maintenance_request_doc.maintenance_id=".$id)->result_array();
	}

    //code 09/10/2019

    public function getWorkOrderUpdate($workorder_id)
	{	
		//echo "SELECT `onelane_users`.*,`onelane_properties`.`address`,`onelane_maintenance_request_work_order`.`title`,`onelane_maintenance_request_work_order`.`work_order_ref_id`, `onelane_property_units`.`unit`,`onelane_maintenance_work_order_update`.`created_at` FROM  `onelane_maintenance_work_order_update` INNER JOIN `onelane_maintenance_request_work_order`  ON `onelane_maintenance_work_order_update`.`workorder_id` = `onelane_maintenance_request_work_order`.id INNER JOIN `onelane_users`  ON `onelane_users`.`id` = `onelane_maintenance_request_work_order`.`service_user_id` INNER JOIN `onelane_properties`  ON `onelane_properties`.`owner_id` = `onelane_maintenance_request_work_order`.`maintenance_request_user_id` INNER JOIN `onelane_maintenance_request`  ON `onelane_maintenance_request`.`property_id` = `onelane_properties`.`id` INNER JOIN `onelane_property_units`  ON `onelane_property_units`.`id` = `onelane_maintenance_request`.`unit_id` WHERE `onelane_maintenance_work_order_update`.`workorder_id`=".$workorder_id;   exit();
	    return $this->db->query("SELECT `onelane_users`.*,`onelane_properties`.`address`,`onelane_maintenance_request_work_order`.`title`,`onelane_maintenance_request_work_order`.`work_order_ref_id`, `onelane_property_units`.`unit`,`onelane_maintenance_work_order_update`.`created_at` AS createdat FROM  `onelane_maintenance_work_order_update` INNER JOIN `onelane_maintenance_request_work_order`  ON `onelane_maintenance_work_order_update`.`workorder_id` = `onelane_maintenance_request_work_order`.id INNER JOIN `onelane_users`  ON `onelane_users`.`id` = `onelane_maintenance_request_work_order`.`service_user_id` INNER JOIN `onelane_properties`  ON `onelane_properties`.`owner_id` = `onelane_maintenance_request_work_order`.`maintenance_request_user_id` INNER JOIN `onelane_maintenance_request`  ON `onelane_maintenance_request`.`property_id` = `onelane_properties`.`id` INNER JOIN `onelane_property_units`  ON `onelane_property_units`.`id` = `onelane_maintenance_request`.`unit_id` WHERE `onelane_maintenance_work_order_update`.`workorder_id`=".$workorder_id)->result_array();
	}	
    //15/10/2019 create date
	 public function getWorkOrderInvoices($workorder_id)
	{	
		//echo "SELECT `onelane_users`.*,`onelane_properties`.`address`,`onelane_maintenance_request_work_order`.`title`,`onelane_maintenance_request_work_order`.`work_order_ref_id`, `onelane_property_units`.`unit`,`onelane_maintenance_work_order_update`.`created_at` FROM  `onelane_maintenance_work_order_update` INNER JOIN `onelane_maintenance_request_work_order`  ON `onelane_maintenance_work_order_update`.`workorder_id` = `onelane_maintenance_request_work_order`.id INNER JOIN `onelane_users`  ON `onelane_users`.`id` = `onelane_maintenance_request_work_order`.`service_user_id` INNER JOIN `onelane_properties`  ON `onelane_properties`.`owner_id` = `onelane_maintenance_request_work_order`.`maintenance_request_user_id` INNER JOIN `onelane_maintenance_request`  ON `onelane_maintenance_request`.`property_id` = `onelane_properties`.`id` INNER JOIN `onelane_property_units`  ON `onelane_property_units`.`id` = `onelane_maintenance_request`.`unit_id` WHERE `onelane_maintenance_work_order_update`.`workorder_id`=".$workorder_id;   exit();
	    return $this->db->query("SELECT `onelane_users`.*,`onelane_properties`.`address`,`onelane_maintenance_request_work_order`.`title`,`onelane_maintenance_request_work_order`.`work_order_ref_id`, `onelane_property_units`.`unit`,`onelane_maintenance_work_order_update`.`created_at` AS createdat FROM  `onelane_maintenance_work_order_update` INNER JOIN `onelane_maintenance_request_work_order`  ON `onelane_maintenance_work_order_update`.`workorder_id` = `onelane_maintenance_request_work_order`.id INNER JOIN `onelane_users`  ON `onelane_users`.`id` = `onelane_maintenance_request_work_order`.`service_user_id` INNER JOIN `onelane_properties`  ON `onelane_properties`.`owner_id` = `onelane_maintenance_request_work_order`.`maintenance_request_user_id` INNER JOIN `onelane_maintenance_request`  ON `onelane_maintenance_request`.`property_id` = `onelane_properties`.`id` INNER JOIN `onelane_property_units`  ON `onelane_property_units`.`id` = `onelane_maintenance_request`.`unit_id` WHERE `onelane_maintenance_work_order_update`.`workorder_id`=".$workorder_id)->result_array();
	}
    // 23/10/2019 create date 
	// public function getPropertyDataTenant()
	// {
	// 	return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN `onelane_property_tenant` ON onelane_properties.owner_id = `onelane_property_tenant`.`owner_id` WHERE onelane_properties.id NOT IN (SELECT `onelane_property_tenant`.`property_id` FROM `onelane_property_tenant`) AND onelane_properties.status='Open' AND  onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->result_array();

	// }

   // 01-07-2020 create code
	public function getPropertyDataTenant()
	{
	   return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN onelane_property_units ON onelane_property_units.property_id = onelane_properties.id WHERE onelane_property_units.id NOT IN (SELECT DISTINCT unit_id FROM onelane_property_tenant) AND onelane_properties.status='Open' AND onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->result_array();

	}

	public function getPropertyDataTenantSelect($property_id)
	{
		return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN `onelane_property_tenant` ON onelane_properties.owner_id = `onelane_property_tenant`.`owner_id` WHERE onelane_properties.id=".$property_id." AND onelane_properties.id NOT IN (SELECT `onelane_property_tenant`.`property_id` FROM `onelane_property_tenant`) AND onelane_properties.status='Open' AND  onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->row_array();
        // echo $this->db->last_query();
        //exit;
	}		

}