<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tenant_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->owner_id = $this->session->userdata('owner_id');
		$this->agent_condition = "";
		
		if($this->session->userdata('agent_properties')!="")
		{

			 $this->agent_condition = " AND onelane_properties.id
			 IN (".$this->session->userdata('agent_properties').") ";

		}

	}
	

	public function getTenantUserId($id)
	{

		return $this->db->query("SELECT *
			FROM onelane_users 
			WHERE onelane_users.id=".$id)->row_array();

	}

	public function tenantProperty($id)
	{
		return $this->db->query("SELECT * FROM onelane_property_tenant WHERE onelane_property_tenant.user_id =".$id)->row_array();
	}

	public function getTenantParentUserId($parent_id)
	{

		return $this->db->query("SELECT *
			FROM onelane_users 
			WHERE onelane_users.id=".$parent_id)->row_array();

	}

	public function saveTenantFileDetails($newFilename,$type,$id)
	{
		if($type == 'tenant')
		{
			$this->db->insert('tenant_govt_docs',array('file_name'=>$newFilename,'tenant_id'=>$id));	
			return $this->db->insert_id();	
		}
	}

	public function deleteTenantFileDetails($id,$filename)
	{
		$this->db->where(array('tenant_id'=>$id,'file_name'=>$filename));
		$this->db->delete('tenant_govt_docs');	
		// echo $this->db->last_query(); exit;			
	}
	public function getTenantDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_tenant_govt_docs WHERE onelane_tenant_govt_docs.tenant_id=".$id)->result_array();
	}

	public function saveTenantRenterDetails($newFilename,$type,$id)
	{
		if($type == 'tenant')
		{
			$this->db->insert('tenant_renter_docs',array('file_name'=>$newFilename,'tenant_id'=>$id));	
			return $this->db->insert_id();	
		}
	}

	public function deleteTenantRenterDetails($id,$filename)
	{
		$this->db->where(array('tenant_id'=>$id,'file_name'=>$filename));
		$this->db->delete('tenant_renter_docs');	
		// echo $this->db->last_query(); exit;			
	}
	public function getTenantRenterDocs($id)
	{
		return $this->db->query("SELECT * FROM onelane_tenant_renter_docs WHERE onelane_tenant_renter_docs.tenant_id=".$id)->result_array();
	}

	public function saveTenantdocumentDetails($newFilename,$tenant_id,$maintenance_id)
	{
		
			$this->db->insert('maintenance_request_doc',array('file_name'=>$newFilename,'tenant_id'=>$tenant_id,'maintenance_id'=>$maintenance_id));	
			return $this->db->insert_id();	
		
	}

	public function deleteTenantdocumentDetails($newFilename,$tenant_id,$maintenance_id)
	{
		$this->db->where(array('tenant_id'=>$tenant_id,'maintenance_id'=>$maintenance_id,'file_name'=>$newFilename));
		$this->db->delete('onelane_maintenance_request_doc');	
		//echo $this->db->last_query(); exit;			
	}
	public function getTenantdocumentDocs($id)
	{
		/*return $this->db->query("SELECT * FROM onelane_maintenance_request_doc WHERE onelane_maintenance_request_doc.maintenance_id=".$id." AND onelane_maintenance_request_doc.tenant_id =".$owner_id)->result_array();*/
		return $this->db->query("SELECT ".$this->db->dbprefix."maintenance_request_doc . * 
		FROM  ".$this->db->dbprefix."maintenance_request_doc 
		WHERE ".$this->db->dbprefix."maintenance_request_doc.maintenance_id=" .$id)->result_array();
	}

	public function getTenantSettings($id)
	{
		return $this->db->query("SELECT *, onelane_property_tenant.address  FROM onelane_property_tenant 
		INNER JOIN  onelane_users ON  onelane_users.id =  onelane_property_tenant.user_id
		WHERE onelane_users.id=".$id)->row_array();
	}

	public function getTenantProUnitData()
	{

		return $this->db->query("SELECT * FROM onelane_property_tenant
		WHERE onelane_property_tenant.user_id=$this->owner_id ")->row_array();

	}
	public function getAdminData($ownerData)
	{

		return $this->db->query("SELECT * FROM onelane_users
		WHERE onelane_users.id=".$ownerData)->row_array();

	}
	public function saveTenantDta($data = array())
	{
		if(!empty($data))
		{
			$data['owner_id'] = $this->owner_id;
			$this->db->insert('maintenance_request',$data);
			return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;	
		}
		return FALSE;
	}
	public function getRequestData($property_id,$unit_id,$ownerData)
	{	
	 /*return $this->db->query("SELECT * FROM onelane_maintenance_request WHERE onelane_maintenance_request.property_id=".$property_id." AND onelane_maintenance_request.unit_id=".$unit_id." AND onelane_maintenance_request.owner_id=".$ownerData)->row_array();
	 *///echo $this->db->last_query(); exit;
	 $property_where = " ";
		if($property_id >0)
		{

			$property_where = " AND ".$this->db->dbprefix."maintenance_request.property_id='".$property_id."'";
		}
		return $this->db->query("
			SELECT
			DATE_FORMAT(onelane_maintenance_request.created_at,'  %M %D %Y') AS formatted_date, 
			".$this->db->dbprefix."maintenance_request.request_text,
			".$this->db->dbprefix."maintenance_request.description_text,
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

			 WHERE ".$this->db->dbprefix."properties.owner_id = $ownerData AND onelane_maintenance_request.unit_id = $unit_id".$property_where." order BY onelane_maintenance_request.id DESC ")->result_array();

		//echo $this->db->last_query(); exit;
	}	
}