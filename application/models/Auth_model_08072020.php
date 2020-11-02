<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		

	}

	public function validateuser($data)

	{

		return $this->db->get_where('users',$data);

		

	}
	

	public function getAgentProperty($agent_id)

	{

		return $this->db->query("SELECT onelane_agent_property.agent_id,onelane_agent_property.property_id FROM onelane_agent_property  INNER JOIN onelane_users ON onelane_users.id= onelane_agent_property.agent_id WHERE onelane_users.user_type=4 AND onelane_users.id =".$agent_id

		)->result_array();

	

	}



	public function getAgentPermission($agent_id)

	{

		return $this->db->query("SELECT onelane_agent_permissions.agent_id,onelane_agent_permissions.permissions FROM onelane_agent_permissions  INNER JOIN onelane_users ON onelane_users.id= onelane_agent_permissions.agent_id WHERE onelane_users.user_type=4 AND onelane_users.id =".$agent_id

		)->row_array();
	

	}

	public function updateuser()

	{



	}



	public function deleteuser()

	{



	}



	public function getuser($userid = NULL)

	{

		

		if($userid !== NULL)

		{



		}

	}

}