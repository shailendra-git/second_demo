<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Financial extends CI_Controller
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

  		$this->load->model('financial_model');
  			

  		if($this->session->userdata('owner_id') == '')
  			redirect(base_url('auth/signin'));

    }

    public function transaction($propertyid=0){

        // print_r($propertyid);
        // exit;
        $owner_id = $this->session->userdata('owner_id');

    		// $data['status'] = 1;
          $newdata = array( 
             'financial_id'  => $propertyid , 
          );  

          $this->session->set_userdata($newdata);
    	    //$data['property_id'] =$propertyid;

         $where = ' where onelane_transaction_data.owner_id='.$owner_id;
         if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where .= " AND `onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
         }
        //echo "".$data['property_id'];


    		// $status = ucfirst($status);

    		// if($status !="Open")

    		// {	

    		// 	$data['status'] =0;

    		// }	
        $propertydatatenat = $this->financial_model->getPropertyData();
        
        $data['propertydatatenat'] = $propertydatatenat;
      //   $propertydatatenat = $this->financial_model->getPropertyData();
        
      // $data['propertydatatenat'] = $propertydatatenat;
         
    		$data['propertydata'] = $this->property_model->getPropertyWithUnitsData();
        $data['propertyAllData'] = $this->property_model->getAllPropertyData();    
        $data['getFinancialData'] = $this->financial_model->getFinancialData($where);
        
        // if($data['getFinancialData']['paid_amount'] == 0.00){
        //     //$status  = 'complete';
        //     $statusData = [
  
        //         'status' => 'complete',

        //     ];
        // $updateStatusData = $this->financial_model->updateTransactionStatusData($transaction_id,$statusData);
        // }
        // print_r($data['getFinancialData']);
        // exit;


        //    $combineUnits = array();

        // $propertyUnits = $this->financial_model->getPropertiesUnits($propertyid);
        // print_r($propertyUnits);
        

        // if(!empty($propertyUnits) && count($propertyUnits)>0)

        // {
        //  $combineUnits =$propertyUnits;
            

        // }
        // echo "<pre>";
        // print_r($combineUnits);
        // exit;
        $paymentdata[] = array();
        foreach ($data['getFinancialData'] as $key => $value) {
           $transaction_id = $value['id'];
        
           $data['getFinancialData'][$key]['paymentdata']  = $this->financial_model->allDataPaidAmount($transaction_id);
        }
        $data['transaction_category']=$this->financial_model->getTransactionCategory();
        
    		$data['popuptype']= 'iframe';

    		$data['activeclass']	=	'financial';
        $data['active']  = 'active';
        $data['financial_id'] = $propertyid;

    		$this->load->view('common/header');

    		$this->load->view('common/sidemenu',$data);

    		$this->load->view('transaction_view',$data);

    		$this->load->view('common/footer',$data);

    }
    
    // public function transaction_list_data($status)
    // {      

    //   	$statusData  = array('success'=>'false','data'=>'');

    //  		$statusResult = $this->financial_model->getSelectListData($status);
      
    //  		if(!empty($statusResult))
    //  		{
    //  			$statusData['data'] 	= $statusResult;
    //  			$statusData['success'] 	= 'true';	
    //  		}
    //  		else
    //  		{	
    //  			$statusData['data'] 	= '';
    //  			$statusData['success'] 	= 'false';	
    //  		}
    //     //exit("hdh");
    //  		echo json_encode($statusData);
    // }

    public function one_time_popup(){

       // echo $this->session->userdata('financial_id');
        //exit;
        $property_id = $this->session->userdata('financial_id');

      
      	$data['userdata'] =  $this->Request_model->getOwnerRequest();

        $data['propertyAllData'] = $this->property_model->getAllPropertyData();
        // echo "<pre>";
        // print_r($data['propertyAllData']);

        $propertydatatenat = $this->financial_model->getPropertyData($property_id);
        
        $data['propertydatatenat'] = $propertydatatenat;
        
        $data['lat']= $this->config->item('latitude');

        $data['lng']= $this->config->item('longitude');

        $data['transaction_category']=$this->financial_model->getTransactionCategory();
        
        $data['tenantData']   = $this->team_model->getTenant();


        $combineUnits = array();

        $propertyUnits = $this->financial_model->getPropertiesUnits($property_id);
        //print_r($propertyUnits);
        

        if(!empty($propertyUnits) && count($propertyUnits)>0)

        {
         $combineUnits =$propertyUnits;
            
        }
        // echo "<pre>";
        // print_r($combineUnits);
        //exit;
        // echo "<pre>";
        // print_r($data['tenantData']);

        $getalltenants = array();

        foreach ($data['propertyAllData'] as $key => $value) {
                $property_id = $value['id'];
                $getTenantWithUnit = $this->financial_model->getAllTenantData($property_id);
                // echo "<pre>";
                // print_r($getTenantWithUnit);
                // $getalltenants = array();
            foreach ($getTenantWithUnit as $key => $tenantWithUnit) {
                // print_r($tenantWithUnit['id']);
              $getalltenants[$tenantWithUnit['id']]  = array('id'=>$tenantWithUnit['id'],'firstname'=>$tenantWithUnit['firstname']) ;
              
          }
        }
     
       // exit;
        $data['combineUnits'] = $combineUnits;
        $data['getalltenant'] = $getalltenants;
        //$data['combineUnit'] = $combineUnits;

  		  $this->load->view('common/popup_header',$data);

      	$this->load->view('one_time_transaction_popup',$data);

      	$this->load->view('common/popup_footer',$data);
  		  //$this->load->view('common/googlemap',$data);
    }

    public function one_time_data_save(){
        
        $owner_id = $this->session->userdata('owner_id');
        if(!empty($_POST))
    		{   
            $payment_type      =  1;
    		    $property			     =	$this->input->post('property_id');
            $unit_id			     =	$this->input->post('unit_id');
            $money             =  $this->input->post('money'); 
            //$group_name        =  $this->input->post('tenant');
            $category			     =	$this->input->post('category');
            $due_date			     =	$this->input->post('due_date');
            $paid_date			   =	$this->input->post('paid_date'); 
            $total_amount			 =	$this->input->post('total_amount'); 
            $paid_amount       =  $this->input->post('paid_amount'); 
            $remaning_amount   =  $total_amount - $paid_amount;
            $memo              =  $this->input->post('memo'); 
            $payment_source    =  $this->input->post('payment');
            
            $check_status = '';
            if($total_amount != $paid_amount) {
              $check_status = 'incomplete';
            }else{
              $check_status = 'complete';
            }

            $group_name = '';
            if($payment_source == 'tenants'){
                $group_name =  $this->input->post('tenant');
            }
            if($payment_source == 'team'){
                $group_name =  $this->input->post('team');
            }
            if($payment_source == 'other'){
                $group_name =  $this->input->post('other');
            }
            $createdate = date('Y-m-d H:i:s');
            $updateddate = date('Y-m-d H:i:s');
        //exit;
            // $tenantdata  = $this->financial_model->getAllTenantData($property);
          
         $transaction_last_id = $this->financial_model->saveTransactionData(

                  array('payment_type'=>$payment_type,

                    'property_all_id'=>$property,

                    'owner_id' => $owner_id,

                    'unit_id' => $unit_id,

                    'category_id'=>$category,

                    'money_type'=>$money,

                    'payment_source'=>$payment_source,

                    'group_name'=>$group_name,

                    'due_date'=>$due_date,

                    'paid_date'=>$paid_date,

                    'amount'=>$total_amount,

                    'paid_amount'=>$remaning_amount,

                    'memo' =>$memo,

                    'status' => $check_status,

                    'created_at' => $createdate,

                    'updated_at' => $updateddate
                    )
          );
         //echo $transaction;
         $transaction = $this->financial_model->saveTransactionPaidData(

                  array('transaction_id'=>$transaction_last_id,

                    'p_amount'=>$paid_amount,
                    'p_date'  =>$paid_date,
                    'p_memo' =>$memo,
                    'p_payment_type' => 'offline_payment',
                    'createdate' =>$createdate

                  )
          );
         //exit;
              
          redirect(base_url('financial/transaction'));
        }
         
    }
     
    public function recurring($propertyid=0){

        
        $owner_id = $this->session->userdata('owner_id');

        $newdata = array( 
             'financial_id'  => $propertyid , 
          );  

        $this->session->set_userdata($newdata);

       $where = '';
         if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where = " AND `onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
         }


        $data['property_id'] =$propertyid;

        $propertydatatenat = $this->financial_model->getPropertyData();
        
        $data['propertydatatenat'] = $propertydatatenat;

        $data['propertydata'] = $this->property_model->getPropertyWithUnitsData();
            
        $data['getFinancialData'] = $this->financial_model->getFinancialRecurringData($where);

        // print_r($data['getFinancialData']);
        // exit;
        $paymentdata = [];
        foreach ($data['getFinancialData'] as $key => $value) {
           $transaction_id = $value['id'];
           $data['getFinancialData'][$key]['paymentdata']  = $this->financial_model->allDataPaidAmount($transaction_id);
        }
        $data['transaction_category']=$this->financial_model->getTransactionCategory();
        
        $data['popuptype']= 'iframe';

        $data['activeclass']  = 'financial';
        $data['active']  = 'active';

        $this->load->view('common/header');

        $this->load->view('common/sidemenu',$data);

        $this->load->view('recurring_view',$data);

        $this->load->view('common/footer',$data);

    }



    public function recurring_popup(){

       $property_id = $this->session->userdata('financial_id');


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
               // echo $query->num_rows(),'raj',$unit['unit'];
                $combineUnits[$unit['id']] = $unit;

               } 
            }
        }

        $data['userdata'] =  $this->Request_model->getOwnerRequest();

        $data['propertyAllData'] = $this->property_model->getAllPropertyData();

        $propertydatatenat = $this->financial_model->getPropertyData();
        
        $data['propertydatatenat'] = $propertydatatenat;
        // echo "<pre>";
        // print_r($data['propertydatatenat']);
        // //exit;

        $data['lat']= $this->config->item('latitude');

        $data['lng']= $this->config->item('longitude');

        $data['transaction_category']=$this->financial_model->getTransactionCategory();
        
        $data['tenantData']   = $this->team_model->getTenant();

         $combineUnits = array();

        $propertyUnits = $this->financial_model->getPropertiesUnits($property_id);
        //print_r($propertyUnits);
        

        if(!empty($propertyUnits) && count($propertyUnits)>0)

        {
         $combineUnits =$propertyUnits;
            

        }
        $getalltenants = '';
        foreach ($data['propertyAllData'] as $key => $value) {
                 $property_id = $value['id'];

                $getTenantWithUnit = $this->financial_model->getAllTenantData($property_id);
                // echo "<pre>";
                // print_r($getTenantWithUnit);
                // $getalltenants = array();
            foreach ($getTenantWithUnit as $key => $tenantWithUnit) {
                // print_r($tenantWithUnit['id']);
              $getalltenants[$tenantWithUnit['id']]  = array('id'=>$tenantWithUnit['id'],'firstname'=>$tenantWithUnit['firstname']) ;
              
          }
        }
        // echo "<pre>";
        // print_r($getalltenants);
        $data['getalltenant'] = $getalltenants;
        $data['combineUnits'] = $combineUnits;


        $this->load->view('common/popup_header',$data);

        $this->load->view('recurring_popup_view',$data);

        $this->load->view('common/popup_footer',$data);

    }

    public function recurring_data_save()
    {
      $owner_id = $this->session->userdata('owner_id');
      $monthly_and_weekly = '';
      if(!empty($_POST))
        {
           $payment_type          =  2;
           $property              =  $this->input->post('property_id');
           $unit                  =  $this->input->post('unit_id');
           $money                 =  $this->input->post('money');
           $payment_source        =  $this->input->post('payment');
           $group_name = '';
            if($payment_source == 'tenants'){
                $group_name        =  $this->input->post('tenant');
            }
            if($payment_source == 'team'){
                $group_name        =  $this->input->post('team');
            }
            if($payment_source == 'other'){
                $group_name        =  $this->input->post('other');
            }
           $category              =  $this->input->post('category');
           $recurring_frequency   =  $this->input->post('select_month_weekly');
           if($recurring_frequency === 'monthly'){
              $monthly_and_weekly      =  $this->input->post('monthly_date');
            }else{
              $monthly_and_weekly      =  $this->input->post('weekly_date');
           }
           $start_date            =  $this->input->post('start_date'); 
           $end_date              =  $this->input->post('end_date'); 
           $due_amount            =  $this->input->post('due_amount'); 
           $auto_check = '';  
           if($this->input->post('auto_check') == 'yes'){
              $auto_check = 'yes';
           }else{
              $auto_check = 'no';
           }
           $memo                  =  $this->input->post('memo'); 
           $createdate            =  date('Y-m-d H:i:s');
           $updateddate           =  date('Y-m-d H:i:s');

         //exit;
           $transaction_last_id = $this->financial_model->saveTransactionData(

                array('payment_type'=>$payment_type,

                  'property_all_id'=>$property,

                  'owner_id' => $owner_id,

                  'unit_id' => $unit,

                  'money_type'=>$money,

                  'payment_source'=>$payment_source,

                  'group_name'=>$group_name,

                  'category_id'=>$category,

                  'recurring_frequency'=>$recurring_frequency,

                  'monthly_and_weekly'=>$monthly_and_weekly,

                  'start_date'=>$start_date,

                  'end_date'=>$end_date,

                  'due_amount'=>$due_amount,

                  'auto_mark_paid_due_amount'=>$auto_check,

                  'memo' =>$memo,

                  'created_at' => $createdate,

                  'updated_at' => $updateddate)
            );
            $transaction = $this->financial_model->saveTransactionPaidData(

                  array('transaction_id'=>$transaction_last_id,

                    'p_amount'=>$due_amount,
                    'p_date'  =>$end_date,
                    'p_memo' =>$memo,
                    'p_payment_type' => 'recurring',
                    'recurring_type' => $recurring_frequency,
                    'day_date_type' => $monthly_and_weekly,
                    'createdate' =>$createdate,

                  )
          );
      
          redirect(base_url('financial/recurring'));
        }
    }

    public function transaction_view($transaction_id){
      
      $owner_id = $this->session->userdata('owner_id');

      $data['popuptype']= 'iframe';

      $data['paidData'] = $this->financial_model->allDataPaidAmount($transaction_id);
          
      $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);
    
      $data['transactiondocs'] = $this->getImages($transaction_id);

      // print_r($data['transactiondocs']);
      // exit;

      $data['activeclass']  = 'financial';

      $this->load->view('common/header');

      $this->load->view('common/sidemenu',$data);

      $this->load->view('transaction_view_data',$data);

      $this->load->view('common/footer',$data); 
      
    }


    public function updateCategoryViewData($tra_id){
       
       //echo $tra_id;
       //exit;
      if(!empty($_POST))
        {
          $category_id   =  $this->input->post('category');
          
          $cat = [
            'category_id' => $category_id,
           ];

          $updateCategoryData = $this->financial_model->updateCategoryData($tra_id,$cat);

          redirect(base_url('financial/transaction_view/'.$tra_id));

      }
 
      $data['userdata'] =  $this->Request_model->getOwnerRequest();

      $data['transaction_category']=$this->financial_model->getTransactionCategory();

        $this->load->view('common/popup_header',$data);

        $this->load->view('category_change_view',$data);

        $this->load->view('common/popup_footer',$data);

      
    }


    public function confirmPaymentViewData(){
       
      $data['userdata'] =  $this->Request_model->getOwnerRequest();

     // $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);

        $this->load->view('common/popup_header',$data);

        $this->load->view('confirm_payment_view',$data);

        $this->load->view('common/popup_footer',$data);

      
    }
      
    public function paymentOfflineViewData($transaction_id){

       //echo $transaction_id;
       // exit;
          if(!empty($_POST))
          {
              $payment_type      =  $this->input->post('payment');
              $remaning_amount   =  $this->input->post('remaning_amount');
              $due_amount        =  $this->input->post('due_amount');
              $paid_date         =  $this->input->post('paid_date');
              $p_memo            =  $this->input->post('p_memo');
              $createdate        =  date('Y-m-d H:i:s');

              $update_amount  = $remaning_amount - $due_amount;
           // exit; 

              $paidData = [
  
                'paid_amount' => $update_amount,

               ];

              $updateAmountData = $this->financial_model->updateTransactionData($transaction_id,$paidData);
              
              $transaction = $this->financial_model->saveTransactionPaidData(

                  array('transaction_id'=>$transaction_id,

                    'p_amount'=>$due_amount,
                    'p_payment_type'=> $payment_type,
                    'p_memo'      => $p_memo,
                    'p_date'   => $paid_date,
                    'createdate' =>$createdate,

                  )
              );
              $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);
              
              if($data['transaction_data']['paid_amount'] == 0.00){
               $statusData = [
                    'status' => 'complete',
                ];
               $updateStatusData = $this->financial_model->updateTransactionStatusData($transaction_id,$statusData);
              }
              redirect(base_url('financial/transaction_view/'.$transaction_id));

          }

          $data['userdata'] =  $this->Request_model->getOwnerRequest();
          $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);
         
 

            $this->load->view('common/popup_header',$data);

            $this->load->view('offline_payment_view',$data);

            $this->load->view('common/popup_footer',$data);
          
    }


    public function paymentOfflineEditData($p_id){
           
          $data['userdata'] =  $this->Request_model->getOwnerRequest();

          $data['paidEditData'] = $this->financial_model->getDataPaidAmount($p_id);
          foreach ($data['paidEditData'] as $key => $value) {
              $transaction_id = $value->transaction_id;
          }
          $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);
          //print_r($data['transaction_data']);

          //echo $paid_id;
          if(!empty($_POST))
          {
              $p_amount    =  $this->input->post('edit_amount');
              $p_date      =  $this->input->post('edit_date');
              $p_memo      =  $this->input->post('edit_memo');
        
              
              $updateData = array(
                    'p_amount' => $p_amount,
                    'p_memo'  => $p_memo,
                    'p_date'  => $p_date,
                  );

            $update_paid = $this->financial_model->updatePaidData($p_id,$updateData);

            $totalpaidamount = $this->financial_model->totalPaidAmount($transaction_id);
          // $totalpaidamount[0]->sum;
          
            
            $amount = $data['transaction_data']['amount'];
            $paid_amount = $amount - $totalpaidamount[0]->sum;
            //print_r($paid_amount);
             $paidData = [
    
                  'paid_amount' => $paid_amount,

              ];

            $updateAmountData = $this->financial_model->updateTransactionData($transaction_id,$paidData);
            //print_r($data['transaction_data']);
             
             $data['transaction_status_data'] = $this->financial_model->transaction_view_data($transaction_id);
              
              if($data['transaction_status_data']['paid_amount'] > 0.00){
                   $statusData = [
                        'status' => 'incomplete',
                    ];
              }else{
                   $statusData = [
                          'status' => 'complete',
                      ];
              }
               $updateStatusData = $this->financial_model->updateTransactionStatusData($transaction_id,$statusData);
              
              redirect(base_url('financial/transaction_view/'.$transaction_id));
          }

         // $data['transaction_data'] = $this->financial_model->transaction_view_data($transaction_id);

    
            $this->load->view('common/popup_header',$data);

            $this->load->view('offline_payment_edit',$data);

            $this->load->view('common/popup_footer',$data);



          
    }

    public function paymentOfflineDeleteData($p_id){
          //echo $p_id;
          $data['userdata'] =  $this->Request_model->getOwnerRequest();

          $data['paidEditData'] = $this->financial_model->getDataPaidAmount($p_id);

            $this->load->view('common/popup_header',$data);

            $this->load->view('offline_payment_delete',$data);

            $this->load->view('common/popup_footer',$data);
          
    }

    public function offlineUpdateDeleteData($p_id){
        // echo $p_id;
        // exit;
        // $data['userdata'] =  $this->Request_model->getOwnerRequest();

        // $data['paidEditData'] = $this->financial_model->getDataPaidAmount($p_id);
        // exit;
        if(!empty($_POST)){
          $tra_id = $this->input->post('transaction');
        
     
          $updateDelete = array(
                    'del_status'=> 'no',
          );

          $update_paid = $this->financial_model->updatePaidDeleteData($p_id,$updateDelete);

           $totalpaidamount = $this->financial_model->totalPaidAmount($tra_id);
           // print_r($totalpaidamount);
           // exit;
           $data['transaction_data'] = $this->financial_model->transaction_view_data($tra_id);
           $amount = $data['transaction_data']['amount'];
           
           $paid_amount = $amount - $totalpaidamount[0]->sum;
          // print_r($paid_amount);
          // exit;
          $paidData = [
    
            'paid_amount' => $paid_amount,

          ];

          $updateAmountData = $this->financial_model->updateTransactionData($tra_id,$paidData);
          
           $data['transaction_status_data'] = $this->financial_model->transaction_view_data($tra_id);
              
              if($data['transaction_status_data']['paid_amount'] > 0.00){
                   $statusData = [
                        'status' => 'incomplete',
                    ];
              }else{
                   $statusData = [
                          'status' => 'complete',
                      ];
              }
               $updateStatusData = $this->financial_model->updateTransactionStatusData($tra_id,$statusData);
              
          redirect(base_url('financial/transaction_view/'.$tra_id));
        }
      
    }

    public function search_by_tra_date_list(){
        
      $owner_id = $this->session->userdata('owner_id'); 
      $propertyid = $this->session->userdata('financial_id');
        
      if(!empty($_POST))
      {

        $start_date =  $this->input->post('start_date'); 
        $end_date =  $this->input->post('end_date'); 
  
        $status = $this->input->post('status');
        $category_id = $this->input->post('category_id');

      }


        $where[] = 'onelane_transaction_data.owner_id='.$owner_id;
  
        if(!empty($status) && trim($status) != '') {
  
            $where[] = "`onelane_transaction_data`.`status`='".$status ."'";  
          }
          if(!empty($category_id) && trim($category_id) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`category_id`='".$category_id ."'"; 
          }
          if(!empty($start_date) && trim($start_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`>='".$start_date ." 00:00:00'";  
          }
          if(!empty($end_date) && trim($end_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`<='".$end_date ." 23:59:59'";  
          }
          if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
         }
            // print_r($where);
            // exit;
            $condition = '';
            if(count($where) > 0){
              $condition = " Where ".implode(' AND ', $where);
            }
  
          $searchData = array('success' => 'false','data' => '');
          $search_list = $this->financial_model->getSearchTransactionDateData($condition);
          // print_r($search_list);
          // exit;

          $paymentdata = [];
          foreach ($search_list as $key => $value) {
             $transaction_id = $value['id'];
             $search_list[$key]['paymentdata']  = $this->financial_model->allDataPaidAmount($transaction_id);
          }
          //print_r($search_list);
          if(!empty($search_list)){
             $searchData['data'] = $search_list;
             $searchData['success'] = 'true';
          }else{
             $searchData['data'] =  '';
             $searchData['success'] = 'false';
          }

          echo json_encode($searchData);
    }
 
    public function transactionExportCSV(){ 
         // file name 
      $owner_id = $this->session->userdata('owner_id');
      $propertyid = $this->session->userdata('financial_id');

        if(!empty($_POST))
        {

          $start_date =  $this->input->post('exp_start_date'); 
          $end_date =  $this->input->post('exp_end_date'); 
    
          $status = $this->input->post('exp_status');
          $category_id = $this->input->post('exp_category');

        }

        $where[] = 'onelane_transaction_data.owner_id='.$owner_id;

  
        if(!empty($status) && trim($status) != '') {
  
                  $where[] = "`onelane_transaction_data`.`status`='".$status ."'";  
          }
          if(!empty($category_id) && trim($category_id) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`category_id`='".$category_id ."'"; 
          }
          if(!empty($start_date) && trim($start_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`>='".$start_date ." 00:00:00'";  
          }
          if(!empty($end_date) && trim($end_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`<='".$end_date ." 23:59:59'";  
          }
          if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
          }
          
          $condition = '';
          if(count($where) > 0){
            $condition = " Where ".implode(' AND ', $where);
          }
        //   //$searchData = array('success' => 'false','data' => '');
           $search_list = $this->financial_model->getSearchTransactionDateData($condition);
          
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=transaction_data.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            $headings = "Id,Address,Date,Category Show Name,Money Type,Payment Source,Group Name,Due Date,Paid Date,Amount,Paid Amount,Memo,Status,Payment Type,Recurring Frequency,Monthly And Weekly,Start Date,End Date,Due Amount,Auto Checkbox";
            //$headings = "id";
            //lastname,billing_address,country,state,city, zip,transcation_type,book_date";
            echo $headings;
            echo "\r\n";
            foreach ($search_list as $key => $value) {
              //print_r($value);
              echo '"'.$value['id'].'"';
              echo ",";
              echo '"'.$value['address'].'"';
              echo ",";
              echo '"'.$value['due_date'].'"';
              echo ",";
              echo '"'.$value['category_show_name'].'"';
              echo ",";
              echo '"'.$value['money_type'].'"';
              echo ",";
              echo '"'.$value['payment_source'].'"';
              echo ",";
              echo '"'.$value['group_name'].'"';
              echo ",";
              echo '"'.$value['due_date'].'"';
              echo ",";
              echo '"'.$value['paid_date'].'"';
              echo ",";
              echo '"'.$value['amount'].'"';
              echo ",";
              echo '"'.$value['paid_amount'].'"';
              echo ",";
              echo '"'.$value['memo'].'"';
              echo ",";
              echo '"'.$value['status'].'"';
              echo ",";
              echo '"'.$value['payment_type'].'"';
              echo ",";
              echo '"'.$value['recurring_frequency'].'"';
              echo ",";
              echo '"'.$value['monthly_and_weekly'].'"';
              echo ",";
              echo '"'.$value['start_date'].'"';
              echo ",";
              echo '"'.$value['end_date'].'"';
              echo ",";
              echo '"'.$value['due_amount'].'"';
              echo ",";
              echo '"'.$value['auto_mark_paid_due_amount'].'"';
              echo "\r\n";

            }
           exit;
      }

    
    public function search_by_recurring_date_list(){
      $owner_id = $this->session->userdata('owner_id');
      $propertyid = $this->session->userdata('financial_id');
        
      if(!empty($_POST))
      {

        $start_date =  $this->input->post('start_date'); 
        $end_date =  $this->input->post('end_date'); 
  
        $status = $this->input->post('status');
        $category_id = $this->input->post('category_id');

      }
        $payment_type = 2;
        $where[] = 'onelane_transaction_data.owner_id='.$owner_id;
  
        if(!empty($status) && trim($status) != '') {
  
            $where[] = "`onelane_transaction_data`.`status`='".$status ."'";  
          }
          if(!empty($category_id) && trim($category_id) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`category_id`='".$category_id ."'"; 
          }
          if(!empty($start_date) && trim($start_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`>='".$start_date ." 00:00:00'";  
          }
          if(!empty($end_date) && trim($end_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`<='".$end_date ." 23:59:59'";  
          }
          if(!empty($payment_type) && trim($payment_type) == 2) {
        
                  $where[] = "`onelane_transaction_data`.`payment_type` = 2";  
          }
          if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
          }
          //`onelane_transaction_data`.`payment_type` = 2
            // print_r($where);
            // exit;
            $condition = '';
            if(count($where) > 0){
              $condition = " Where ".implode(' AND ', $where);
            }
  
          $searchData = array('success' => 'false','data' => '');
          $search_list = $this->financial_model->getSearchRecurringDateData($condition);
          // print_r($search_list);
          // exit;

          $paymentdata[] = array();
          foreach ($search_list as $key => $value) {
             $transaction_id = $value['id'];
             $search_list[$key]['paymentdata']  = $this->financial_model->allDataPaidAmount($transaction_id);
          }
          //print_r($search_list);
          if(!empty($search_list)){
             $searchData['data'] = $search_list;
             $searchData['success'] = 'true';
          }else{
             $searchData['data'] =  '';
             $searchData['success'] = 'false';
          }

          echo json_encode($searchData);
    }


      public function recurringExportCSV(){ 
        $owner_id = $this->session->userdata('owner_id');
        $propertyid = $this->session->userdata('financial_id');
         // file name 
        if(!empty($_POST))
        {

          $start_date =  $this->input->post('exp_start_date'); 
          $end_date =  $this->input->post('exp_end_date'); 
    
          $status = $this->input->post('exp_status');
          $category_id = $this->input->post('exp_category');

        }
        $payment_type = 2;
         $where[] = 'onelane_transaction_data.owner_id='.$owner_id;
  
        if(!empty($status) && trim($status) != '') {
  
                  $where[] = "`onelane_transaction_data`.`status`='".$status ."'";  
          }
          if(!empty($category_id) && trim($category_id) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`category_id`='".$category_id ."'"; 
          }
          if(!empty($start_date) && trim($start_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`>='".$start_date ." 00:00:00'";  
          }
          if(!empty($end_date) && trim($end_date) != '') {
        
                  $where[] = "`onelane_transaction_data`.`due_date`<='".$end_date ." 23:59:59'";  
          }
          if(!empty($payment_type) && trim($payment_type) == 2) {
        
                  $where[] = "`onelane_transaction_data`.`payment_type` = 2";  
          }
          if(!empty($propertyid) && trim($propertyid) > 0) {
        
                  $where[] = "`onelane_transaction_data`.`property_all_id`='".$propertyid ."'"; 
          }

          
          $condition = '';
          if(count($where) > 0){
            $condition = " Where ".implode(' AND ', $where);
          }
        //   //$searchData = array('success' => 'false','data' => '');
           $search_list = $this->financial_model->getSearchRecurringDateData($condition);
          
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=transaction_data.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            $headings = "Id,Address,Date,Category Show Name,Money Type,Payment Source,Group Name,Due Date,Paid Date,Amount,Paid Amount,Memo,Status,Payment Type,Recurring Frequency,Monthly And Weekly,Start Date,End Date,Due Amount,Auto Checkbox";
            //$headings = "id";
            //lastname,billing_address,country,state,city, zip,transcation_type,book_date";
            echo $headings;
            echo "\r\n";
            foreach ($search_list as $key => $value) {
              //print_r($value);
              echo '"'.$value['id'].'"';
              echo ",";
              echo '"'.$value['address'].'"';
              echo ",";
              echo '"'.$value['due_date'].'"';
              echo ",";
              echo '"'.$value['category_show_name'].'"';
              echo ",";
              echo '"'.$value['money_type'].'"';
              echo ",";
              echo '"'.$value['payment_source'].'"';
              echo ",";
              echo '"'.$value['group_name'].'"';
              echo ",";
              echo '"'.$value['due_date'].'"';
              echo ",";
              echo '"'.$value['paid_date'].'"';
              echo ",";
              echo '"'.$value['amount'].'"';
              echo ",";
              echo '"'.$value['paid_amount'].'"';
              echo ",";
              echo '"'.$value['memo'].'"';
              echo ",";
              echo '"'.$value['status'].'"';
              echo ",";
              echo '"'.$value['payment_type'].'"';
              echo ",";
              echo '"'.$value['recurring_frequency'].'"';
              echo ",";
              echo '"'.$value['monthly_and_weekly'].'"';
              echo ",";
              echo '"'.$value['start_date'].'"';
              echo ",";
              echo '"'.$value['end_date'].'"';
              echo ",";
              echo '"'.$value['due_amount'].'"';
              echo ",";
              echo '"'.$value['auto_mark_paid_due_amount'].'"';
              echo "\r\n";
              
            }
           exit;
        }  
   
      public function monthly_cron_data(){

        $auto_cron = $this->financial_model->monthly_cron_fetch_data();
        $createdate        =  date('Y-m-d H:i:s');
        // echo "<pre>";
        // print_r($auto_cron);
        // exit;
        
        foreach ($auto_cron as $key => $value) {
           
         $cron_recurring = $this->financial_model->saveCronData(

                array('transaction_id'=>$value['id'],

                  'p_amount'=>$value['due_amount'],

                  'p_date' => $createdate,

                  'p_memo'=>$value['memo'],

                  'p_payment_type'=>'recurring',

                  'del_status'=>'yes',

                  'recurring_type'=>$value['recurring_frequency'],

                  'createdate'=>$createdate
            ));
      
          redirect(base_url('financial/transaction'));
        }

      }

      public function weekly_cron_data(){

        $auto_cron = $this->financial_model->weekly_cron_fetch_data();
        $createdate   =  date('Y-m-d H:i:s');
        // print_r($auto_cron[0]['due_amount']);
        // exit;
    
          foreach ($auto_cron as $key => $value) {
           
              $cron_recurring = $this->financial_model->saveCronData(

                array('transaction_id'=>$value['id'],

                  'p_amount'=>$value['due_amount'],

                  'p_date' => $createdate,

                  'p_memo'=>$value['memo'],

                  'p_payment_type'=>'recurring',

                  'del_status'=>'yes',

                  'recurring_type'=>$value['recurring_frequency'],

                  'createdate'=>$createdate
            ));
      
          redirect(base_url('financial/transaction'));
        }

      }


    public function getImages($transaction_id)

    {

      return $this->financial_model->getTransactionDocs($transaction_id);

    }
    
    public function transaction_doc_uploadAndDelete()
    {

      $target_dir = "upload/transaction_doc/";

      $request = 'FILEUPLOAD';



      if(isset($_POST['request']))

      { 

        $request = $_POST['request'];   

      }


      if($request == 'FILEUPLOAD')

      {

        $tra_id = $this->input->post('transaction_doc_id');

        $newFilename = $this->renameFile(basename($_FILES["file"]["name"]),$tra_id); 

        $target_file = $target_dir .''.$newFilename;

        $msg = ""; 

          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

          {

            $traid = $this->saveFileDetails($newFilename,'tradoc',$tra_id);

            echo json_encode(array('filename'=>$newFilename,'traid'=>$traid));

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

        $tra_doc_id=$_POST['doc_id'];

        $filename=$_POST['name'];

        $this->deleteFileTransactionDetails($tra_doc_id,$filename);

        $filename = $target_dir.$_POST['name'];  

        unlink($filename); 

        exit;

      }

    }
  
    public function renameFile($orgName,$id)

    {

      $newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'prop_'.$id;

      $extArr = explode('.',$orgName);

      $ext=end($extArr);

      return $newFilename.'.'.$ext;

    }

    public function saveFileDetails($newFilename,$type,$tra_id)

    {

      return $this->financial_model->saveFileDetails($newFilename,$type,$tra_id);

    }
    public function deleteFileTransactionDetails($doc_id,$filename)

    {

      return $this->financial_model->deleteFileTraDetails($doc_id,$filename);  

    }

    public function IncomeExpenseData($propertyid = 0)
    {
      
      //$propertyid = $this->session->userdata('financial_id');
      $status = '';
      if(!empty($_POST))
        {

           $s_date =  $this->input->post('s_date'); 
           $e_date =  $this->input->post('e_date');
           if(trim($this->input->post('select_tra_list')) != '')
           {
            $status = $this->input->post('select_tra_list');
           }

           $start_date = $s_date;
           $end_date =$e_date;

           
             $i = date("Ym", strtotime($s_date));
            while($i <= date("Ym", strtotime($e_date))){
               // echo $i."\n";
               $months['months'][] = date("Y-m-01", strtotime($i."01"));
               $months['month_names'][] = date("M'y",strtotime($i."01"));
            

                if(substr($i, 4, 2) == "12")
                    $i = (date("Y", strtotime($i."01")) + 1)."01";
                else
                    $i++;
            }
              //exit;
          }else{
        

            $months['months'][] = date("Y-m-01",strtotime("-2 Months"));
            $start_date = date("Y-m-01",strtotime("-2 Months"));
            $months['month_names'][] = date("M'y",strtotime("-2 Months"));
            $months['months'][] = date("Y-m-01",strtotime("-1 Months"));
            $months['month_names'][] = date("M'y",strtotime("-1 Months"));
            $months['months'][] = date("Y-m-01",strtotime("0 Months"));
            $months['month_names'][] = date("M'y",strtotime("0 Months"));
            $end_date  = date("Y-m-t",strtotime("0 Months"));
//            print_r($months);
        }
      $owner_id = $this->session->userdata('owner_id');
      

      $data['userdata'] =  $this->Request_model->getOwnerRequest();
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;


      $data['propertydata'] = $this->property_model->getPropertyWithUnitsData();
       
      $propertydatatenat = $this->financial_model->getPropertyData();
        
      $data['propertydatatenat'] = $propertydatatenat;
         
      $data['transaction_category']=$this->financial_model->getTransactionCategory();
      

      $data['activeclass']  = 'financial';
      $data['active']  = 'active';
      $data['months_data'] = $months;
      $data['status'] = $status;
      $data['financial_id'] = $propertyid;


      $this->load->view('common/header');

      $this->load->view('common/sidemenu',$data);

      $this->load->view('income_expense_view',$data);

      $this->load->view('common/footer',$data); 


    }

    public function incomeAndExpense($propertyid = 0)
    {
      // echo $propertyid;
      // exit;
      $status = '';
      if(!empty($_POST))
        {

          $start_date =  $this->input->post('income_start_date'); 
          $end_date =  $this->input->post('income_end_date'); 
          $status = $this->input->post('income_status');
        
         if(trim($this->input->post('income_status')) != '')
           {
            $status = $this->input->post('income_status');
           }

           
            $i = date("Ym", strtotime($start_date));
            while($i <= date("Ym", strtotime($end_date))){
               // echo $i."\n";
               $months['months'][] = date("Y-m-01", strtotime($i."01"));
               $months['month_names'][] = date("M'y",strtotime($i."01"));
            

                if(substr($i, 4, 2) == "12")
                    $i = (date("Y", strtotime($i."01")) + 1)."01";
                else
                    $i++;
            }
        }
        else{
        
            $months['months'][] = date("Y-m-01",strtotime("-2 Months"));
            $start_date = date("Y-m-01",strtotime("-2 Months"));
            $months['month_names'][] = date("M'y",strtotime("-2 Months"));
            $months['months'][] = date("Y-m-01",strtotime("-1 Months"));
            $months['month_names'][] = date("M'y",strtotime("-1 Months"));
            $months['months'][] = date("Y-m-01",strtotime("0 Months"));
            $months['month_names'][] = date("M'y",strtotime("0 Months"));
            $end_date = date("Y-m-t",strtotime("0 Months"));
        }
       // exit;
        $transaction_category = $this->financial_model->getTransactionCategory();
        $months_data = $months;
        $file_name = 'Onelane_financial_'.$start_date.'_to_'.$end_date.'.csv';
       // print_r($getExportMonth);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$file_name);
        header("Pragma: no-cache");
        header("Expires: 0");
            //$headings = array();
        echo "CATEGORY";
        echo ",";
        foreach ($months_data['month_names'] as  $headings) {
            echo  $headings;
            echo ",";
        }
          echo "\r\n";
           
        foreach ($transaction_category as $category) {
        if($category['transaction_category_name'] != 'security-deposit'){
          //print_r($category);
          echo $category['category_show_name'];
          echo ",";
          foreach ($months_data['months'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status,$category['id'],$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '"'.$getExportMonth['sumOfRecurringAmount'].'"';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
        echo "\r\n";
       }
    }
    echo "\r\n";

      echo "Total";
      echo ",";
      foreach ($months_data['months'] as $value) {
          $start_date = $value;
          $end_date = date("Y-m-t",strtotime($start_date));
          $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status,0,$propertyid);
          
          if(!empty($getExportMonth['sumOfRecurringAmount'])){
         
           echo '"'.$getExportMonth['sumOfRecurringAmount'].'"';
           echo ",";

           }else{
         
            echo '-';
            echo ",";
          
          }
      }
    echo "\r\n";
    echo "\r\n";
    echo "\r\n";

      echo "ACCOUNTS PAYABLE";
      echo ",";
      foreach ($months_data['month_names'] as  $headings) {
          echo  $headings;
          echo ",";
      }
          echo "\r\n";
           
      foreach ($transaction_category as $category) {
        if($category['transaction_category_name'] === 'security-deposit'){
          //print_r($category);
          echo $category['category_show_name'];
          echo ",";
          foreach ($months_data['months'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status,$category['id'],$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '"'.$getExportMonth['sumOfRecurringAmount'].'"';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               } 
             }
          echo "\r\n";
        }
      }
       exit;         
    }

    public function leaseLedgerData($propertyid=0)
    {  

        // $newdata = array( 
        //      'financial_id'  => $propertyid , 
        //   );  

        //   $this->session->set_userdata($newdata);
      
       // $data['userdata'] =  $this->Request_model->getOwnerRequest();
       $start_date = date("Y-m-01",strtotime("-12 Months"));
       $end_date  = date("Y-m-t",strtotime("+3 Months"));


          $i = date("Ym", strtotime($start_date));
            while($i <= date("Ym", strtotime($end_date))){
               // echo $i."\n";
             // echo "<pre>";
              $months['months'][] = date("Y-m-01", strtotime($i."01"));
              $months['month_names'][] = date("Y\nM",strtotime($i."01"));
            

                if(substr($i, 4, 2) == "12")
                    $i = (date("Y", strtotime($i."01")) + 1)."01";
                else
                    $i++;
            }
      $month['month'] = array_reverse($months['months']);
      $month['monthnames'] = array_reverse($months['month_names']);
                //print_r($month);
                //exit;
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;
      //$data['propertyid'] = $propertyid;
      $due_arr = array('Prior Balance','Requested','Scheduled','Paid','Balance');
      
      $propertydatatenat = $this->financial_model->getPropertyData();
        
      $data['propertydatatenat'] = $propertydatatenat;

      $data['propertydata'] = $this->property_model->getPropertyWithUnitsData();

      //$data['transaction_category']=$this->financial_model->getTransactionCategory();
      
      $data['financial_id'] = $propertyid;
      $data['activeclass']  = 'financial';
      $data['active']  = 'active';
      $data['months_data'] = $month;
      $data['due_arr'] = $due_arr;


      $this->load->view('common/header');

      $this->load->view('common/sidemenu',$data);

      $this->load->view('lease_ledger_view',$data);

      $this->load->view('common/footer',$data); 
    }

    public function leaseLedgerExport($propertyid=0)
    {
      // echo $propertyid;
      // exit;
      // if(!empty($_POST))
      //   {

      //    $propertyid =  $this->input->post('income_property'); 
      //   }

      // $owner_id = $this->session->userdata('owner_id');
      // $data['userdata'] =  $this->Request_model->getOwnerRequest();
      $start_date = date("Y-m-01",strtotime("-12 Months"));
      $start_month_year = date("M'y",strtotime("-12 Months"));
      $end_date  = date("Y-m-t",strtotime("+3 Months"));
      $end_month_year  = date("M'y",strtotime("+3 Months"));

          $i = date("Ym", strtotime($start_date));
            while($i <= date("Ym", strtotime($end_date))){
               // echo $i."\n";
             // echo "<pre>";
              $months['months'][] = date("Y-m-01", strtotime($i."01"));
              $months['month_names'][] = date("Y'M",strtotime($i."01"));
            

                if(substr($i, 4, 2) == "12")
                    $i = (date("Y", strtotime($i."01")) + 1)."01";
                else
                    $i++;
            }
      $month['month'] = array_reverse($months['months']);
      $month['monthnames'] = array_reverse($months['month_names']);
                //print_r($month);
                //exit;

      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;

      $due_arr = array('Prior Balance','Requested','Scheduled','Paid','Balance');
        
        $months_data = $month;
        $file_name = 'Onelane_financial_'.$end_month_year.'_to_'.$start_month_year.'.csv';
       // print_r($getExportMonth);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$file_name);
        header("Pragma: no-cache");
        header("Expires: 0");
            $headings = array();
        echo "Due Date";
        echo ",";
        foreach ($months_data['monthnames'] as  $headings) {
            echo  $headings;
            echo ",";
        }
         echo "\r\n";
           
        // foreach ($transaction_category as $category) {
        foreach($due_arr as $value){
          //print_r($category);
          if($value == 'Prior Balance'){
          echo $value;
          echo ",";
          foreach ($months_data['month'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status='',$category = 0,$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '-';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
          // }
        echo "\r\n";
       }
       if($value == 'Requested'){
          echo $value;
          echo ",";
          foreach ($months_data['month'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status='',$category = 0,$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '-';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
          // }
        echo "\r\n";
       }
       if($value == 'Scheduled'){
          echo $value;
          echo ",";
          foreach ($months_data['month'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status='',$category = 0,$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '-';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
          // }
        echo "\r\n";
       }
       if($value == 'Paid'){
          echo $value;
          echo ",";
          foreach ($months_data['month'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status='',$category = 0,$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '"'.$getExportMonth['sumOfRecurringAmount'].'"';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
          // }
        echo "\r\n";
       }
       if($value == 'Balance'){
          echo $value;
          echo ",";
          foreach ($months_data['month'] as $value) {
            $start_date = $value;
            $end_date = date("Y-m-t",strtotime($start_date));
            $getExportMonth = $this->financial_model->getMonthExport($start_date,$end_date,$status='',$category = 0,$propertyid);
              if(!empty($getExportMonth['sumOfRecurringAmount'])){
             
               echo '"'.$getExportMonth['sumOfRecurringAmount'].'"';
               echo ",";
      
               }else{
             
                echo '-';
                echo ",";
              
               }
               
             }
          // }
        echo "\r\n";
       }
    }
    exit;
  }

 public function financial_property_basicinfo($property_id = NULL,$current_tab='')
  {

    $data['financial_id'] = $property_id;

    $propertyData   = $this->property_model->getProperties($property_id); 
    $data['propertyAllData'] = $this->property_model->getAllPropertyData();


    $data['getFinancialData'] = $this->financial_model->getFinancialPropertyData($property_id);
    // print_r($data['getFinancialData']);
    // exit;
        // print_r($data['getFinancialData']);
        // exit;
      $paymentdata = [];
        foreach ($data['getFinancialData'] as $key => $value) {
           $transaction_id = $value['id'];
           $data['getFinancialData'][$key]['paymentdata']  = $this->financial_model->allDataPaidAmount($transaction_id);
        }
      $data['transaction_category']=$this->financial_model->getTransactionCategory();
        

    $data['propertyData']   = $propertyData;

    $data['current_tab']  = $current_tab;

    $data['popuptype']= 'iframe';
    $data['activeclass']  = 'financial';
    $data['active']  = 'active';

    $this->load->view('common/header');

    $this->load->view('common/sidemenu',$data);

    $this->load->view('financial_property_basicinfo_view',$data);

    $this->load->view('common/footer',$data);
  }


public function getPropertyUnitAll()

  {  
    //echo "hello";

    // $property_id  = $this->session->userdata('financial_id');
     $property_id  =  $this->input->post('property_id');


      
      $combineUnits = array();

      $propertyUnits = $this->financial_model->getPropertiesUnits($property_id);
     // print_r($propertyUnits);
      

      if(!empty($propertyUnits) && count($propertyUnits)>0)

      {
       $combineUnits =$propertyUnits;
          

      }

     echo json_encode($combineUnits);
     // echo $combineUnits;

  }

  public function weekly_summary(){
      
     $owner_id = $this->session->userdata('owner_id'); 
     $get_owner_id = $this->financial_model->getOwnerId();
     // print_r($owner_id);
     // exit;
     foreach ($get_owner_id as $key => $value) {
      // echo   $id = $value['id'];
       //echo "<br>";
         $start_date = date("Y-m-d");
         $end_date = date("Y-m-d" , strtotime("+7 day"));

          $where[] = 'onelane_transaction_data.owner_id='.$owner_id;
      
              if(!empty($start_date) && trim($start_date) != '') {
            
                      $where[] = "`onelane_property_tenant`.`end_date`>='".$start_date ." 00:00:00'";  
              }
              if(!empty($end_date) && trim($end_date) != '') {
            
                      $where[] = "`onelane_property_tenant`.`end_date`<='".$end_date ." 23:59:59'";  
              }
              if(!empty($id) && trim($id) != '') {
            
                      $where[] = "`onelane_property_tenant`.`owner_id`=".$id;  
              }
              
               $condition = '';
                if(count($where) > 0){
                  $condition = " Where ".implode(' AND ', $where);
                }
      
    
    $leaseduedatas = $this->financial_model->leaseSummaryDueDate($condition);

    $vacantPropertiesDatas = $this->financial_model->vacantPropertiesData();
    //print_r($vacantPropertiesData);
    $data['date_show']    =  date("l, F d, Y", strtotime($start_date));
    //date_format($start_date,"W, F d,Y");
    $data['leaseduedata']  = $leaseduedatas;
    $data['vacantproperties'] = $vacantPropertiesDatas;
    
    $message = '';
     
    $message .= '<table border="1" cellpadding="5px" style=" margin: 10px 10px;">'; 
    $message .= '<tr><h3>Your Weekly Summary</h3></tr>';
    $message .= '<tr>For '.$data['date_show'].'</tr>';
    $message .= '<tr><h3>For Your Attention</h3></tr>';
    $message .= '<tr><td colspan="3"><b>Upcoming Expiring Leases</b></td></tr>';
    $message .= '<tr>
      <th>Due Date</th>
      <th>Weekly Rent</th>
    </tr>';
    if(!empty($data['leaseduedata'])){
          foreach ($data['leaseduedata'] as $key => $value) {
    $message .=  '<tr>
        <td>'.$value['end_date'].'</td>
        <td>'.$value['monthly_rent'].'</td>
      </tr>';
     }
    }else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }
    $message .= '</table>';
    $message .= '</br>';


    $message .= '<table border="1" cellpadding="5px" style=" margin: 10px 10px;">'; 
    $message .= '<tr><td colspan="3"><b>Late Payments</b></td></tr>';
    $message .= '<tr><td colspan="3"><b>Money owed to you</b></td></tr>';
    $message .= '<tr><td colspan="3">Below is a subset of the oustanding past-due payments. Please log into your account to view all payments.</td></tr>';
    $message .= '<tr>
      <th>Money Type</th>
      <th>Address</th>
      <th>Due Amount</th>
    </tr>';
    if(!empty($data['leaseduedata'])){
          foreach ($data['leaseduedata'] as $key => $value) {
            if($value['money_type'] == 'credit'){
    $message .=  '<tr>
        <td>'.$value['money_type'].'</td>
        <td>'.$value['property_address'].'</td>
         <td>'.$value['due_amount'].'</td>
      </tr>';
     }
     else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }
    }
    }else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }
    $message .= '<tr><td colspan="3"></br></td></tr>';
    $message .= '<tr><td colspan="3"><b>Money you owe</b></td></tr>';
     $message .= '<tr>
      <th>Money Type</th>
      <th>address</th>
      <th>Due Amount</th>
    </tr>';
    if(!empty($data['leaseduedata'])){
          foreach ($data['leaseduedata'] as $key => $value) {
            if($value['money_type'] == 'debit'){
    $message .=  '<tr>
        <td>'.$value['money_type'].'</td>
        <td>'.$value['property_address'].'</td>
         <td>'.$value['due_amount'].'</td>
      </tr>';
     }
     else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }
    }
    }else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }
    $message .= '</table>';
    $message .= '</br>';

    $message .= '<table border="1" cellpadding="5px" style=" margin: 10px 10px;">'; 
    $message .= '<tr><td colspan="4"><b>Recurring Payments Ending Soon</b></td></tr>';
    $message .= '<tr>
      <th>Recurring</th>
      <th>Address</th>
      <th>Due Amount</th>
      <th>Due Date</th>
    </tr>';
    if(!empty($data['leaseduedata'])){
          foreach ($data['leaseduedata'] as $key => $value) {
            if($value['recurring_frequency'] == 'weekly'){
    $message .=  '<tr>
        <td>'.$value['recurring_frequency'].'</td>
        <td>'.$value['property_address'].'</td>
        <td>'.$value['due_amount'].'</td>
        <td>'.$value['recurring_date'].'</td>
      </tr>';
     }
     else{
    $message .=  '<tr><td colspan="4"><b>All clear</b></td></tr>';
    }
    }
    }else{
    $message .=  '<tr><td colspan="4"><b>All clear</b></td></tr>';
    }

    $message .= '</table>';
    $message .= '</br>';

    $message .= '<table border="1" cellpadding="5px" style=" margin: 10px 10px;">'; 
    $message .= '<tr><td colspan="3"><b>Vacant Properties</b></td></tr>';
    $message .= '<tr>
      <th>Package</th>
      <th>Address</th>
      <th>Advertising</th>
    </tr>';
    if(!empty($data['vacantproperties'])){
          foreach ($data['vacantproperties'] as $key => $value) {
    $message .=  '<tr>
        <td>Smart</td>
        <td>'.$value['address'].'</td>
        <td>OFF</td>
      </tr>';
     }
    }else{
    $message .=  '<tr><td colspan="3"><b>All clear</b></td></tr>';
    }

    $message .= '</table>';

    print_r($message);
    echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
  }
    //$this->load->view('weekly-summary' ,$data);
  }


}