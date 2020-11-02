<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Financial_model extends CI_Model
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

	public function getFinancialData($where)
	{

	  return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`, DATE_FORMAT(`onelane_transaction_data`.`start_date`,'%b %d %Y') AS `start_date`,`onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			 INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
			 INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
             INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id` ".$where."   ORDER BY id DESC")->result_array();

	}

    public function getFinancialPropertyData($property_id)
	{

	  $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`, DATE_FORMAT(`onelane_transaction_data`.`start_date`,'%b %d %Y') AS `start_date`,`onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			 INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
			 INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
             INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id` WHERE `onelane_transaction_data`.`property_all_id` =".$property_id. " ORDER BY id DESC")->result_array();
        
	}

	public function getFinancialRecurringData($where)
	{

	  return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`start_date`,'%b %d %Y') AS `date`,`onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			 INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
			 INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
             INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id` WHERE onelane_transaction_data.owner_id=".$this->owner_id." AND onelane_transaction_data.payment_type = 2 ".$where." ORDER BY `onelane_transaction_data`.id DESC")->result_array();

	}

	// public function getSelectListData($status = ''){

 //        $where ="";
	// 	if(!empty($status)) {
	// 			$where = "WHERE `onelane_transaction_data`.`status`='".$status ."'";
	// 	}     
 //        return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`  FROM `onelane_transaction_data` 
	// 		   INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
 //               INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id`".$where)->result_array();

	// }

	public function saveTransactionData($data)
	{
               $this->db->insert('transaction_data',$data);
        return $this->db->insert_id();
	}

	public function saveTenantTransactionData($data)
	{
		
        $this->db->insert('transaction_data',$data);
         $transaction_last_id =  $this->db->insert_id();

         $this->db->set('createdate', 'NOW()', FALSE);
		 $recurring_insert = array(
             
                  'transaction_id'=>$transaction_last_id,

                   'p_amount'=>$data['due_amount'],

                    'p_date'  =>$data['end_date'],

                    'p_memo' =>$data['memo'],

                    'p_payment_type' => 'recurring',

                    'recurring_type' => $data['recurring_frequency'],

                    'day_date_type' => $data['monthly_and_weekly'],

		 );
        
        $this->db->insert('onelane_amount_data',$recurring_insert);
        // exit;
	}

	public function saveCronData($data)
	{
        $this->db->insert('onelane_amount_data',$data);
	}
    
    public function saveTransactionPaidData($data)
	{
         $this->db->insert('onelane_amount_data',$data);
        //return $this->db->insert_id();
	}

	// public function saveTenantTransactionPaidData($data)
	// {
 //         $this->db->insert('onelane_amount_data',$data);
 //        //return $this->db->insert_id();
	// }
    
    public function allDataPaidAmount($id)
    {
	            $this->db->select("*,DATE_FORMAT(`onelane_amount_data`.`p_date`,'%b %d %Y') AS `p_date`");
	            $this->db->from('onelane_amount_data');
                $this->db->join('onelane_transaction_data', 'onelane_transaction_data.id = onelane_amount_data.transaction_id');
                $this->db->where('onelane_amount_data.transaction_id',$id);
                $this->db->order_by('onelane_amount_data.p_id', 'DESC');
            $query =  $this->db->get();
      return  $query->result();
       // echo $this->db->last_query();
       // exit;
    }

	public function getAllTenantData($propertyid)
	{
        
        return $this->db->query("SELECT `onelane_property_tenant`.`id`, `onelane_property_tenant`.`firstname` FROM `onelane_property_tenant` INNER JOIN `onelane_transaction_data` ON `onelane_transaction_data`.`property_all_id` = `onelane_property_tenant`.`property_id` AND `onelane_transaction_data`.`unit_id` = `onelane_property_tenant`.`unit_id` WHERE `onelane_property_tenant`.`property_id`=".$propertyid)->result_array();
        //echo $this->db->last_query();
	}

	public function getUnitData($unit_id){

		return $this->db->query("SELECT * FROM `onelane_property_units` WHERE `id`=".$unit_id)->row_array();
  //       $this->db->SELECT(*);
		// $this->db->where('id', $unit_id);
  //       $query = $this->db->get('onelane_property_units');
  //       // $this->db->last_query();
  //       // exit;
  //       return $query->result();

	}

	public function getTransactionCategory(){

		return $this->db->query("SELECT * FROM `onelane_transaction_category`")->result_array();

	}

	public function updateCategoryData($transaction_id,$cat){

		$this->db->where('id', $transaction_id);
        $this->db->update('onelane_transaction_data', $cat);
        // echo $this->db->last_query();
        // exit;

	}

	public function updateTransactionData($transaction_id,$paidData){
           
        $this->db->where('id', $transaction_id);
        $this->db->update('onelane_transaction_data', $paidData);
	}

	public function updateTransactionStatusData($transaction_id,$statusData){
           
        $this->db->where('id', $transaction_id);
        $this->db->update('onelane_transaction_data', $statusData);
	}

	public function transaction_view_data($tra_id){

		return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`,`onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			   INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
               INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
               INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id` WHERE `onelane_transaction_data`.`id`=".$tra_id)->row_array();

	}
    
 //    public function getCategoryData($category_id = ''){

 //        $where ="";
	// 	if(!empty($category_id)) {
	// 			$where = "WHERE `onelane_transaction_data`.`category_id`='".$category_id ."'";
	// 	}     
 //        return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`  FROM `onelane_transaction_data` 
	// 		   INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
 //               INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id`".$where)->result_array();

	// }
    
    public function getSearchTransactionDateData($condition = ''){
       
		return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`,DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `due_date`, DATE_FORMAT(`onelane_transaction_data`.`paid_date`,'%b %d %Y') AS `paid_date` , DATE_FORMAT(`onelane_transaction_data`.`start_date`,'%b %d %Y') AS `start_date`,DATE_FORMAT(`onelane_transaction_data`.`end_date`,'%b %d %Y') AS `end_date`, `onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			   INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
               INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
               INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id`  ".$condition)->result_array();
       // echo $this->db->last_query();
    }

    public function getSearchRecurringDateData($condition = ''){
       
		return $this->db->query("SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`category_show_name`,DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date`, DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `due_date`, DATE_FORMAT(`onelane_transaction_data`.`paid_date`,'%b %d %Y') AS `paid_date` , DATE_FORMAT(`onelane_transaction_data`.`start_date`,'%b %d %Y') AS `start_date`,DATE_FORMAT(`onelane_transaction_data`.`end_date`,'%b %d %Y') AS `end_date`, `onelane_property_units`.`unit`  FROM `onelane_transaction_data` 
			   INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id`
               INNER JOIN	`onelane_property_units` ON `onelane_property_units`.`id` = `onelane_transaction_data`.`unit_id`
               INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`category_id`  ".$condition)->result_array();
       // echo $this->db->last_query();
    }


    public function monthly_cron_fetch_data(){
          
        return $this->db->query("SELECT * FROM `onelane_transaction_data` WHERE  payment_type=2 AND `start_date` <= NOW() AND `end_date` >= NOW() AND `recurring_frequency` = 'monthly' AND monthly_and_weekly = DATE_FORMAT(NOW(),'%d')")->result_array();
           // echo $this->db->last_query();
           // exit;
    }

    public function weekly_cron_fetch_data(){

    	return $this->db->query("SELECT * FROM `onelane_transaction_data` WHERE  `payment_type`=2 AND `start_date` <= NOW() AND `end_date` >= NOW() AND `recurring_frequency`='weekly'  AND monthly_and_weekly = LOWER(DAYNAME(NOW()))")->result_array();
    }

    public function getTransactionDocs($transaction_id)
	{

		return $this->db->get_where('onelane_transaction_doc',array('transaction_id'=>$transaction_id))->result_array();

	}

	public function saveFileDetails($newFilename,$type,$tra_id)
	{

		if($type == 'tradoc')
		{

			$this->db->insert('onelane_transaction_doc',array('file_name'=>$newFilename,'transaction_id'=>$tra_id));	
			return $this->db->insert_id();	

		}

	}
    
    public function deleteFileTraDetails($doc_id,$filename)
	{

		$this->db->where(array('id'=>$doc_id,'file_name'=>$filename));
		$this->db->delete('onelane_transaction_doc');	
	
	}

	public function getDataPaidAmount($id){

	 $this->db->select("*");
	            $this->db->from('onelane_amount_data');
                $this->db->where('p_id',$id);
      $query =  $this->db->get();
	  return $query->result();

	}

	public function updatePaidData($id,$updateData){

		$this->db->where('p_id', $id);
        $this->db->update('onelane_amount_data', $updateData);
        // echo  $this->db->last_query();
        //    exit;

	}

	public function updatePaidDeleteData($id,$updateDelete){

		$this->db->where('p_id', $id);
        $this->db->update('onelane_amount_data', $updateDelete);
        // echo  $this->db->last_query();
        //    exit;

	}	

	public function totalPaidAmount($transaction_id){
      
        $this->db->select('sum(p_amount) AS sum');
        $this->db->from('onelane_amount_data');
        $this->db->where('transaction_id',$transaction_id);
        $this->db->where('del_status','yes');
        $query=$this->db->get();
        return $query->result();
	}
    

	public function getMonthData($s_date,$e_date,$status = '',$cat_id = 0,$propertyid = 0){
  
	    $where[] = 'owner_id='.$this->owner_id;
        
        if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "`property_all_id`='".$propertyid ."'"; 
         }
        if(!empty($status) && trim($status) != '') {
  
                  $where[] = "status`='".$status ."'";  
        }
        if(!empty($cat_id) && trim($cat_id) > 0) {
        
                  $where[] = "`category_id`='".$cat_id ."'"; 
        }
        if(!empty($s_date) && trim($s_date) != '') {
        
                  $where[] = "`paid_date`>='".$s_date ."'";  
        }
        if(!empty($e_date) && trim($e_date) != '') {
        
                 $where[] = "`paid_date`<='".$e_date ."'";  
        }
      
            $condition = '';
            if(count($where) > 0){
              $condition = " Where ".implode(' AND ', $where);
              //exit;
            }

	
		 // $this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
		return   $this->db->query("SELECT sum(`onelane_amount_data`.`p_amount`) as sumOfAmount FROM `onelane_transaction_data` INNER JOIN `onelane_amount_data` ON `onelane_amount_data`.`transaction_id` = `onelane_transaction_data`.`id`" .$condition)->row_array();
		 //$this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
        // echo $this->db->last_query();
        // echo "<br>";
        // exit;
	}


	public function getRecurringMonthData($s_date,$e_date,$status = '',$cat_id = 0,$propertyid = 0){
  
	    $where[] = ' onelane_amount_data.del_status ="yes" AND onelane_transaction_data.owner_id='.$this->owner_id;
        
        if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "onelane_transaction_data.`property_all_id`='".$propertyid ."'"; 
         }
        if(!empty($status) && trim($status) != '') {
  
                  $where[] = "onelane_transaction_data.`status`='".$status ."'";  
        }
        if(!empty($cat_id) && trim($cat_id) > 0) {
        
                  $where[] = "onelane_transaction_data.`category_id`='".$cat_id ."'"; 
        }
        if(!empty($s_date) && trim($s_date) != '') {
        
                  $where[] = "onelane_amount_data.`p_date`>='".$s_date ."'";  
        }
        if(!empty($e_date) && trim($e_date) != '') {
        
                 $where[] = "onelane_amount_data.`p_date`<='".$e_date ."'";  
        }
      
            $condition = '';
            if(count($where) > 0){
              $condition = " Where ".implode(' AND ', $where);
              //exit;
            }

	
		 // $this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
		return   $this->db->query("SELECT sum(`onelane_amount_data`.`p_amount`) as sumOfRecurringAmount FROM `onelane_transaction_data` INNER JOIN `onelane_amount_data` ON `onelane_amount_data`.`transaction_id` = `onelane_transaction_data`.`id` " .$condition)->row_array();
		 //$this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
        // echo $this->db->last_query();
        // echo "<br>";
        // exit;
	}
	
public function getIncomeExpenseTotal($s_date,$e_date,$status = '',$cat_id = 2,$propertyid = 0){
  
	    $where[] = ' onelane_amount_data.del_status ="yes" AND onelane_transaction_data.owner_id='.$this->owner_id;
        
        if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "onelane_transaction_data.`property_all_id`='".$propertyid ."'"; 
         }
        if(!empty($status) && trim($status) != '') {
  
                  $where[] = "onelane_transaction_data.`status`='".$status ."'";  
        }
        if(!empty($cat_id) && trim($cat_id) > 0) {
        
                  $where[] = "onelane_transaction_data.`category_id`!='".$cat_id ."'"; 
        }
        if(!empty($s_date) && trim($s_date) != '') {
        
                  $where[] = "onelane_amount_data.`p_date`>='".$s_date ."'";  
        }
        if(!empty($e_date) && trim($e_date) != '') {
        
                 $where[] = "onelane_amount_data.`p_date`<='".$e_date ."'";  
        }
      
            $condition = '';
            if(count($where) > 0){
              $condition = " Where ".implode(' AND ', $where);
              //exit;
            }

	
		 // $this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
		return   $this->db->query("SELECT sum(`onelane_amount_data`.`p_amount`) as sumOfRecurringTotalAmount FROM `onelane_transaction_data` INNER JOIN `onelane_amount_data` ON `onelane_amount_data`.`transaction_id` = `onelane_transaction_data`.`id` " .$condition)->row_array();
		 //$this->db->query("SELECT sum(`paid_amount`) as sumOfAmount FROM `onelane_transaction_data` " .$condition)->row_array();
        // echo $this->db->last_query();
        // echo "<br>";
        // exit;
	}


	public function getMonthExport($s_date,$e_date,$status = '',$cat_id = 0,$propertyid = 0){
  

		 
		 $where[] = 'onelane_amount_data.del_status ="yes" AND onelane_transaction_data.owner_id='.$this->owner_id;
        

        if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "onelane_transaction_data.`property_all_id`='".$propertyid ."'"; 
        }
        if(!empty($status) && trim($status) != '') {
  
            $where[] = "onelane_transaction_data.status='".$status ."'";  
        }
        if(!empty($cat_id) && trim($cat_id) > 0) {
        
                  $where[] = "onelane_transaction_data.`category_id`='".$cat_id ."'"; 
        }
        if(!empty($s_date) && trim($s_date) != '') {
        
                  $where[] = "onelane_amount_data.`p_date`>='".$s_date ."'";  
        }
        if(!empty($e_date) && trim($e_date) != '') {
        
                 $where[] = "onelane_amount_data.`p_date`<='".$e_date ."'";  
        }
          
        $condition = '';
        if(count($where) > 0){
          $condition = " Where ".implode(' AND ', $where);
        //  exit;
        }

	    	
		//return  $this->db->query("SELECT sum(`paid_amount`) as sumOfAmount,sum(`amount`) as sumTotalAmount FROM `onelane_transaction_data` " .$condition)->row_array();
        return  $this->db->query("SELECT sum(`onelane_amount_data`.`p_amount`) as sumOfRecurringAmount FROM `onelane_transaction_data` INNER JOIN `onelane_amount_data` ON `onelane_amount_data`.`transaction_id` = `onelane_transaction_data`.`id` " .$condition)->row_array();
        
         //  echo $this->db->last_query();
         // exit;
	}

	// public function getLeaseLedger($s_date,$e_date,$property_id = 0){
  

	// 	// $property = '';	
	//  //    if(!empty($property_id) && $property_id > 0){
	//  //       $property = " AND property_all_id=".$property_id;
	//  //    }
 //        $where = ' AND onelane_transaction_data.owner_id='.$this->owner_id;
 //         if(!empty($property_id) && trim($property_id) > 0) {
        
 //                  $where .= " AND `onelane_transaction_data`.`property_all_id`='".$property_id ."'"; 
 //         }
	    	
	// 	return $this->db->query("SELECT sum(`paid_amount`) as sumOfAmount,sum(`amount`) as sumTotalAmount FROM `onelane_transaction_data`  WHERE  `paid_date` >= '".$s_date."' AND `paid_date` <= '".$e_date."'" .$where )->row_array();
 //         // echo $this->db->last_query();
 //         // exit;
	// }
    

    public function getLeaseLedger($s_date,$e_date,$property_id = 0){
  


        $where = ' AND onelane_transaction_data.owner_id='.$this->owner_id;
         if(!empty($property_id) && trim($property_id) > 0) {
        
                  $where .= "  AND `onelane_transaction_data`.`property_all_id`='".$property_id ."'"; 
         }
	    	
		return $this->db->query("SELECT sum(onelane_amount_data.p_amount) as sumOfAmount  FROM `onelane_transaction_data` INNER JOIN onelane_amount_data ON onelane_amount_data.transaction_id = onelane_transaction_data.id WHERE  onelane_amount_data.del_status ='yes' AND onelane_amount_data.p_date >= '".$s_date."' AND onelane_amount_data.p_date <= '".$e_date."'" .$where )->row_array();
         // echo $this->db->last_query();
         // exit;
	}
    
 //    public function getIncomeExpenseTotal($s_date,$e_date,$property_id = 0){
  


 //        $where = ' AND onelane_transaction_data.owner_id='.$this->owner_id;
 //         if(!empty($property_id) && trim($property_id) > 0) {
        
 //                  $where .= "  AND `onelane_transaction_data`.`property_all_id`='".$property_id ."'"; 
 //         }
	    	
	// 	return $this->db->query("SELECT sum(onelane_amount_data.p_amount) as sumOfAmount  FROM `onelane_transaction_data` INNER JOIN onelane_amount_data ON onelane_amount_data.transaction_id = onelane_transaction_data.id WHERE  onelane_amount_data.del_status ='yes' AND onelane_amount_data.category_id != 2 AND onelane_amount_data.p_date >= '".$s_date."' AND onelane_amount_data.p_date <= '".$e_date."'" .$where )->row_array();
 //         // echo $this->db->last_query();
 //         // exit;
	// }

    public function getPropertyDataTenant($property_id)
	{
		return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN `onelane_property_tenant` ON onelane_properties.owner_id = `onelane_property_tenant`.`owner_id` WHERE onelane_properties.id != ".$property_id." AND onelane_properties.id NOT IN (SELECT `onelane_property_tenant`.`property_id` FROM `onelane_property_tenant`) AND onelane_properties.status='Open' AND  onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->result_array();

	}
    
    public function getOwnerId(){
    	return $this->db->query("SELECT `id` FROM `onelane_users` WHERE `user_type` = 1")->result_array();
    }
    
	public function leaseSummaryDueDate($condition)
	{
		return  $this->db->query("SELECT `onelane_property_tenant`.*,`onelane_transaction_data`.`money_type`,`onelane_transaction_data`.`due_amount`, `onelane_transaction_data`.`recurring_frequency`, `onelane_transaction_data`.`end_date` AS `recurring_date`, `onelane_properties`.`address` as `property_address` FROM `onelane_property_tenant` 
			INNER JOIN `onelane_transaction_data` ON `onelane_transaction_data`.`tenant_id` = `onelane_property_tenant`.`id`
            INNER JOIN `onelane_properties` ON `onelane_properties`.`id` = `onelane_property_tenant`.`property_id`".$condition." ORDER BY id ASC")->result_array();
         // echo $this->db->last_query();
         // exit;
	}

	public function vacantPropertiesData()
	{
		return  $this->db->query("SELECT  * FROM  `onelane_properties` Where owner_id='".$this->owner_id."' AND `id` NOT IN  (SELECT `property_id` FROM `onelane_property_tenant`)")->result_array();
         // echo $this->db->last_query();
         // exit;
	}

	public function getPropertyData()
	{
		return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN `onelane_property_tenant` ON onelane_properties.owner_id = `onelane_property_tenant`.`owner_id` WHERE  onelane_properties.status='Open' AND  onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->result_array();

	}


	public function getPropertyDataTenantSelect($property_id)
	{
		return $this->db->query("SELECT onelane_properties.id,onelane_properties.address FROM onelane_properties INNER JOIN `onelane_property_tenant` ON onelane_properties.owner_id = `onelane_property_tenant`.`owner_id` WHERE onelane_properties.id=".$property_id." AND  onelane_properties.status='Open' AND  onelane_properties.owner_id=".$this->owner_id."$this->agent_condition GROUP BY onelane_properties.address ORDER BY onelane_properties.address ASC")->row_array();
        // echo $this->db->last_query();
        //exit;
	}
	
	public function getPropertiesUnits($property_id)

	{


	 return $this->db->get_where('property_units',array('property_id'=>$property_id,'status'=>1,'owner_id'=>$this->owner_id))->result_array();
		//$this->db->last_query();
		///exit;

    }

    public function cron_test_data(){

    	return $this->db->query("")->row_array();;
    }			
	

}

// SELECT `onelane_transaction_data`.* ,`onelane_properties`.`address`, `onelane_transaction_category`.`transaction_category_name`, `onelane_property_tenant`.`firstname`,DATE_FORMAT(`onelane_transaction_data`.`due_date`,'%b %d %Y') AS `date` FROM `onelane_transaction_data` INNER join `onelane_properties` ON `onelane_transaction_data`.`property_all_id` = `onelane_properties`.`id` INNER join `onelane_transaction_category` ON `onelane_transaction_category`.`id` =`onelane_transaction_data`.`service_id` INNER join `onelane_property_tenant` ON `onelane_property_tenant`.`id` =`onelane_transaction_data`.`tenant_id`