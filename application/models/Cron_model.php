<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cron_model extends CI_Model
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
  
  public function get_days_payments()
  {
    return $this->db->query("SELECT user_id,SUM(num_of_properties) as property_expiring  FROM  onelane_payment_details
    WHERE next_subcription_date = CURDATE() group by user_id")->result_array();
  }

  public function tenantInvitation()
  {
   return $this->db->query("SELECT * FROM onelane_property_tenant 
    WHERE onelane_property_tenant.id AND onelane_property_tenant.user_id=0")->result_array();
  }


  public function getActiveProperty($getUserId)

  { 
    return $this->db->query("SELECT count(*) AS active_property FROM  onelane_properties 
    WHERE onelane_properties.status='Open' AND  onelane_properties.owner_id =".$getUserId)->row_array();
  }
  // public function getuserData($getUserId)

  // { 
  //   return $this->db->query("SELECT * FROM   onelane_users 
  //   WHERE    onelane_users.id =".$getUserId)->row_array();
  // }


  public function getPaidPropertyData($getUserId)
  {
    
    return $this->db->query("SELECT * ,SUM(num_of_properties) AS subscribe_properties  FROM  onelane_payment_details
      INNER JOIN onelane_users ON onelane_users.id = onelane_payment_details.user_id
    WHERE next_subcription_date  > DATE_FORMAT(NOW(),'%Y-%m-%d') AND onelane_payment_details.user_id=".$getUserId)->row_array();
  }

}