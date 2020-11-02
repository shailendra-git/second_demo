<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller 
{

 	public function __construct() 
	{ 
	parent::__construct(); 
	$this->load->library('session');
    $this->load->library('email');
    $this->load->model('cron_model');
    $this->load->model('financial_model');

  }
  public function index()
  {
   
  $date = strtotime("+1 days");
                     
 	$payments =  $this->cron_model->get_days_payments($date);
  
  // print_r($payments);
  // exit();

  $combineUnits = array();

    foreach($payments as $userpay)
    {

       //$combineUnits[$userpay['id']] = array('user_id'=>$userpay['user_id']);
       $user_id = $userpay['user_id'];
       $property_expiring = $userpay['property_expiring'];
    
    
      // print_r($user_id);
      // exit;
      
     $activeProperty['activeProperty'] = $this->cron_model->getActiveProperty($user_id);
    // print_r($activeProperty);
    // exit();
     $active_property_data= $activeProperty['activeProperty']['active_property'];
     
      

      $data['paidProperty']=$this->cron_model->getPaidPropertyData($user_id);

      $PaidProperty = $data['paidProperty']['subscribe_properties'];
      $email= $data['paidProperty']['email'];
      $firstname= $data['paidProperty']['firstname'];
      $lastname= $data['paidProperty']['lastname'];
    // print_r($email);
    // exit();

      // print_r( $PaidProperty);
      // exit();
      //       echo "<br>";
      //       echo $property_expiring;
      //       echo "<br>";
      // echo $PaidProperty;
      // echo "<br>";
      // echo $active_property_data;
      // echo "<br>";
      $usubscribeProperty = ($PaidProperty + $property_expiring )  -$active_property_data ;

      // print_r($usubscribeProperty);
      // echo "<br>";
       if ($usubscribeProperty >0)

      {
        $data = array

      (
        

        'email'=>$email,

        'firstname'=>ucfirst($firstname),

        'lastname'=>ucfirst($lastname),

        'property'=>$usubscribeProperty,
        'url'=>base_url()
       

      );

      $email_type='property_renaval';



      // print_r($data);

      // exit();



      $this->common_model->send_mail($email,$email_type,$data);
      

      }
      
    }
  }

  public function tenantInvitation()
  {
   
  
                     
  $tenantInvitation =  $this->cron_model->tenantInvitation();
  
  // print_r($tenantInvitation);
  // exit();

    foreach($tenantInvitation as $count)
    {

       //$combineUnits[$userpay['id']] = array('user_id'=>$userpay['user_id']);
        $tenant_id = $count['id'];
       $firstname = $count['firstname'];
       $email=$count['email'];
       $getPropertyId = $count['property_id'];
       $getUnitId=$count['unit_id'];



      // print_r($tenant_id );
      // print_r($getUnitId );
    

      $propertyData['propertyData'] = $this->common_model->getPropertyData($getPropertyId);
      $address = $propertyData['propertyData']['address'];
      

      $unitData['unitData'] = $this->common_model->getUnitData($getUnitId);
      
      $unitid = $unitData['unitData']['unit'];
      // print_r($unitid);
      // exit();
      // print_r($unit);
      // exit;
        $user= $this->session->userdata('firstname');
        $data = array

      (
        'PROPEERTY'=>$address,

        'firstname'=>ucfirst($firstname),

        'UNIT'=>$unitid,

        'user'=>ucfirst($user),
        'url'=>base_url('auth/registerApplicationTenannt/'.$tenant_id.'')
      );

      $email_type='cron_tenant_invitation';



      // print_r($data);

      // exit();

      $this->common_model->send_mail($email,$email_type,$data);
       
    }
 
  }

   public function monthly_cron_data(){


        $auto_cron = $this->financial_model->monthly_cron_fetch_data();
        $createdate        =  date('Y-m-d H:i:s');
        // print_r($auto_cron);
        // exit;
     
        foreach ($auto_cron as  $value) {
           
           // print_r($value);
           // exit;

         $cron_recurring = $this->financial_model->saveCronData(

                array('transaction_id'=>$value['id'],

                  'p_amount'=>$value['due_amount'],

                  'p_date' => $createdate,

                  'p_memo'=>$value['memo'],

                  'p_payment_type'=>'recurring',

                  'del_status'=>'yes',

                  'recurring_type'=>$value['recurring_frequency'],

                  'day_date_type' => $value['monthly_and_weekly'],

                  'createdate'=>$createdate
            ));


        }

      }

      public function weekly_cron_data(){


         // $createdate        =  date('Y-m-d H:i:s');
         //  $cro = $this->financial_model->saveDemoWeekly(array('runtime'=>$createdate,'type'=>'weekly'));
         //  exit;
 
        $auto_cron = $this->financial_model->weekly_cron_fetch_data();
        $createdate   =  date('Y-m-d H:i:s');
        // exit;
    
        foreach ($auto_cron as $value) {
           
          $cron_recurring = $this->financial_model->saveCronData(

                array('transaction_id'=>$value['id'],

                  'p_amount'=>$value['due_amount'],

                  'p_date' => $createdate,

                  'p_memo'=>$value['memo'],

                  'p_payment_type'=>'recurring',

                  'del_status'=>'yes',

                  'recurring_type'=>$value['recurring_frequency'],

                  'day_date_type' => $value['monthly_and_weekly'],

                  'createdate'=>$createdate
            ));
      
         // redirect(base_url('financial/transaction'));
        }

    }

}