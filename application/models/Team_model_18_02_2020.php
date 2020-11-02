<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Team_model extends CI_Model
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

	public function save($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}

	public function saveTenant($data)
	{
		$this->db->insert('property_tenant',$data);
		return $this->db->insert_id();
	}
	public function updateCOTenantData($data,$id)
	{
		//$worker_id = $worker_id;

		//unset($data['id']);
		$this->db->where('id',$id);
		$this->db->update('onelane_co_tenant',$data);
	}
	public function deleteCotenantOrderDetails($id)
	{
		$this->db->where(array('id'=>$id));
		$this->db->delete('onelane_co_tenant');	
		// echo $this->db->last_query(); exit;			
	}
	public function deletePrivateDetails($id)
	{
		$this->db->where(array('id'=>$id));
		$this->db->delete('onelane_tenant_private_notes');	
		// echo $this->db->last_query(); exit;			
	}
	public function addCoTenantChackId($data)
	{	
		$id= $data['id'];

		if ($id ==''){

			$this->db->insert('onelane_co_tenant',$data);
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('id',$id);
		$this->db->update('onelane_co_tenant',$data);
		}
		
	}
	public function saveTenantNotesChackId($data)
	{	
		$tenant_id= $data['id'];

		if ($tenant_id ==''){

			$this->db->insert('onelane_tenant_private_notes',$data);
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('id',$tenant_id);
		$this->db->update(' onelane_tenant_private_notes',$data);
		}
		
	}
	
	public function saveTenantMessage($data)
	{
		$this->db->insert('tenant_messages',$data);
		return $this->db->insert_id();
	}
	public function saveCoTenant($data)
	{
		$this->db->insert('co_tenant',$data);
		return $this->db->insert_id();
	}
	public function savetenantdocs($data)
	{
		$this->db->insert('tenant_docs',$data);
		return $this->db->insert_id();
	}

	public function tenantData($id)
	{
		return $this->db->query("SELECT*
			FROM onelane_property_tenant
				WHERE onelane_property_tenant.id=".$id)->row_array();
	}


	public function getTeams($id = NULL)
	{

		if($id !='')
		{
			return $this->db->get_where('users',array('id'=>$id,'added_by'=>$this->owner_id))->row_array();	
		}
		$user_condition = "(user_type =3 OR user_type=4)";
		$extra_agent_condition = "";
		$extra_join = "";
		$this->db->select('users.*');
		$this->db->from('users');

		$this->db->order_by("id", "desc");
		
		if($this->session->userdata('user_type')==4)
		{

		  $user_condition = " users.user_type =3 ";
		$this->db->join('worker_property','worker_property.user_id = users.id');
		$this->db->where($user_condition);
		$this->db->where_in('worker_property.property_id', explode(",",$this->session->userdata('agent_properties')));
		}
		$this->db->where('users.parent_user_id = '.$this->owner_id);//

		// echo $user_condition;
		// fetch all team data
		
		
		
		
      // $this->db->where('wrk_cs_sts','open');
		return $this->db->get()->result_array();
	}

	public function getTenant()

	{

		return $this->db->query("SELECT  onelane_property_tenant.*,DATE_FORMAT(onelane_property_tenant.end_date,'  %M %d %Y') AS formatted_date,
		onelane_properties.address,onelane_property_units.unit,onelane_property_tenant.id as main_tenant_id
			FROM onelane_property_tenant

			INNER JOIN	onelane_properties ON
			onelane_properties.id = onelane_property_tenant.property_id

			INNER JOIN	onelane_property_units ON
			onelane_property_units.id = onelane_property_tenant.unit_id

			LEFT JOIN	onelane_users ON
			onelane_users.id = onelane_property_tenant.user_id 

			WHERE  onelane_property_tenant.owner_id = $this->owner_id order BY onelane_property_tenant.id DESC")->result_array();
	}

	public function getTenantUserId($id)
	{
		return $this->db->query("SELECT *
			FROM onelane_property_tenant 
			WHERE onelane_property_tenant.id=".$id)->row_array();

	}
	

	public function getTenantLeaseData($id)
	{
		return $this->db->query("SELECT onelane_property_tenant.*,DATE_FORMAT(onelane_property_tenant.start_date,'  %M %d %Y') AS str_date,
			DATE_FORMAT(onelane_property_tenant.end_date,'  %M %d %Y') AS str_end_date
			FROM onelane_property_tenant
			
			WHERE onelane_property_tenant.id=".$id)->row_array();

	}
	public function getTenantLeaseResultData($id)
	{
		return $this->db->query("SELECT onelane_property_tenant.*,DATE_FORMAT(onelane_property_tenant.start_date,'  %M %d %Y') AS str_date,
			DATE_FORMAT(onelane_property_tenant.end_date,'  %M %d %Y') AS str_end_date
			FROM onelane_users
			INNER JOIN onelane_property_tenant ON onelane_property_tenant.user_id = onelane_users.id
			WHERE onelane_users.id=".$id)->row_array();

	}

	public function getTenantUserMessage($id)
	{
	return $this->db->query("
	SELECT ".$this->db->dbprefix."tenant_messages.*,".$this->db->dbprefix."property_tenant.firstname AS tenant ,".$this->db->dbprefix."users.firstname AS owner ,DATE_FORMAT(onelane_tenant_messages.created_at,'  %M %d %Y') AS formatted_date 
		FROM ".$this->db->dbprefix."tenant_messages 
		INNER JOIN ".$this->db->dbprefix."property_tenant ON
		".$this->db->dbprefix."property_tenant.id = ".$this->db->dbprefix."tenant_messages.tenant_id
		INNER JOIN ".$this->db->dbprefix."users ON
		".$this->db->dbprefix."users.id = ".$this->db->dbprefix."property_tenant.owner_id
		 WHERE ".$this->db->dbprefix."tenant_messages.tenant_id =".$id." order by id DESC")->result_array();	
	}

	public function getTenantUsernotes($id)
	{
	return $this->db->query("
	SELECT ".$this->db->dbprefix."tenant_private_notes.*
		FROM ".$this->db->dbprefix."tenant_private_notes 
		 WHERE ".$this->db->dbprefix."tenant_private_notes.user_id =".$id." order by id DESC")->row_array();	
	}

	public function getCoTenant($id)
	{
	return $this->db->query("
	SELECT onelane_co_tenant.* FROM  onelane_property_tenant
	
	INNER JOIN onelane_co_tenant ON onelane_co_tenant.tenant_id = onelane_property_tenant.id
	WHERE onelane_property_tenant.id=".$id)->result_array();	
	}

	public function getCoTenantRow($id)
	{
	return $this->db->query("
	SELECT onelane_co_tenant.* FROM  onelane_property_tenant
	
	INNER JOIN onelane_co_tenant ON onelane_co_tenant.tenant_id = onelane_property_tenant.id
	WHERE onelane_property_tenant.id=".$id." order by id DESC")->row_array();	
	}


	public function gettenantId($id)
	{
	return $this->db->query("
	SELECT onelane_property_tenant.* FROM onelane_users 
	INNER JOIN onelane_property_tenant ON onelane_property_tenant.user_id = onelane_users.id
	WHERE onelane_users.id =".$id)->row_array();	
	}


	public function getTenantUserCountMessage($id)
   {
   return $this->db->query("
   SELECT count(*) as tenantdata, ".$this->db->dbprefix."tenant_messages.* 
      FROM ".$this->db->dbprefix."tenant_messages 
     
       WHERE ".$this->db->dbprefix."tenant_messages.user_id =".$id." order by id DESC")->row_array(); 
   }
 

	public function deleteServicesByWorkerId($worker_id)
	{
		$this->db->where(array('user_id'=>$worker_id));
		$this->db->delete('worker_services');	

	}
	public function deletePermissionsByWorkerId($worker_id)
	{
		$this->db->where(array('agent_id'=>$worker_id));
		$this->db->delete('agent_permissions');	

	}

	public function deletePropertyByWorkerId($worker_id)
	{
		$this->db->where(array('user_id'=>$worker_id));
		$this->db->delete('worker_property');	

	}
	public function deleteAgentPropertyByWorkerId($worker_id)
	{
		$this->db->where(array('agent_id'=>$worker_id));
		$this->db->delete('agent_property');	

	}


	public function getTeamsByService($search_by, $worker_id=0)
	{
		if($search_by == 'all')
		{
			return $this->db->get_where('users',array('user_type'=>3,'added_by'=>$this->owner_id))->result_array();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('worker_services','users.id=worker_services.user_id');

			$this->db->where('worker_services.service_id',$search_by);
			$this->db->where('users.added_by',$this->owner_id);
			return $this->db->get()->result_array();
		}

	}

	public function editTeamData($data,$worker_id)
	{
		//$worker_id = $worker_id;

		//unset($data['id']);
		$this->db->where('id',$worker_id);
		$this->db->update('users',$data);
	}

	public function updateTenantuserData($data,$user_id)
	{
		//$worker_id = $worker_id;

		//unset($data['id']);
		$this->db->where('id',$user_id);
		//$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	public function updateTenantLeaseData($data,$id)
	{
		//$worker_id = $worker_id;

		//unset($data['id']);
		$this->db->where('id',$id);
		$this->db->update('property_tenant',$data);
	}

	
	public function updateTenantInviteData($data,$id)
	{
		//$worker_id = $worker_id;

		//unset($data['id']);
		$this->db->where('user_id',$id);
		//$this->db->where('user_id',$id);
		$this->db->update('property_tenant',$data);

		
	}

	public function getSingleContact_byservices($user_id)
	{
		return $this->db->get_where('worker_services',array('user_id'=>$user_id))->result_array();
	}
	public function getSingleContact_byproperties($user_id)
	{
		return $this->db->get_where('worker_property',array('user_id'=>$user_id))->result_array();
	}
	public function getSingleContact_byAgentproperties($user_id)
	{
		return $this->db->get_where('agent_property',array('agent_id'=>$user_id))->result_array();
	}
	public function getSingleContactByAgentPermissions($agent_id)
	{
		return $this->db->get_where('agent_permissions',array('agent_id'=>$agent_id))->result_array();
	}
	public function getSingleSelectServices($user_id)
	{
		return $this->db->get_where('maintenance_request',array('id'=>$user_id))->result_array();
	}

	// public function check_owner_and_tenant($owner_id)
	// {
	// 	return $this->db->query("SELECT `firstname` FROM `onelane_users` WHERE `parent_user_id`=".$owner_id)->result_array();	
	// }
    
      public function getDeleteDatatenant($tenant_id){
    	
    	//echo $tenant_id;
    	$this->db->where('id',$tenant_id);
        $query=$this->db->get('onelane_property_tenant');
        return $query->row_array();
        //echo $this->db->last_query();
    	//exit;
    }
    public function saveTenantHistory($data)
	{
		$this->db->insert('onelane_property_tenant_history',$data);
		return $this->db->insert_id();
	}
    
    public function deleteTenantData($tenant_id)
	{
		// echo $tenant_id;
		// exit;
		$this->db->where('id',$tenant_id);
		$this->db->delete('onelane_property_tenant');	
	}
	public function getHistoryTenantData()
	{

         
        return $this->db->query("SELECT  onelane_property_tenant_history.*,DATE_FORMAT(onelane_property_tenant_history.end_date,'  %M %d %Y') AS formatted_date,
		onelane_properties.address,onelane_property_units.unit,onelane_property_tenant_history.old_tenant_id as main_old_tenant_id
			FROM onelane_property_tenant_history

			INNER JOIN	onelane_properties ON
			onelane_properties.id = onelane_property_tenant_history.property_id

			INNER JOIN	onelane_property_units ON
			onelane_property_units.id = onelane_property_tenant_history.unit_id

			LEFT JOIN	onelane_users ON
			onelane_users.id = onelane_property_tenant_history.user_id 

			WHERE  onelane_property_tenant_history.owner_id = $this->owner_id order BY onelane_property_tenant_history.id DESC")->result_array();
		 //    $this->db->select('*');
			// $this->db->from('onelane_property_tenant_history');
			// return $this->db->get()->result_array();
	}




}