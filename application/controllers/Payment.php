<?php defined('BASEPATH') OR exit('No direct script access allowed');







class Payment extends CI_Controller

{



	public function __construct()



	{



		parent::__construct();



		$this->load->library('session'); 



        $this->load->helper('form'); 



		$this->load->model('auth_model');



		$this->load->model('team_model');



		$this->load->model('property_model');



		$this->load->model('Request_model');



		if($this->session->userdata('owner_id') == '')



			redirect(base_url('auth/signin'));



	}







	public function index()



	{






	}

	public function makePayment()



	{

		

		$data['prodata'] =  $this->property_model->getProperty();

		$data['paycount'] =  $this->property_model->getPaymentDetailByUserId();


		$data['activeclass']	=	'properties';

// echo "<pre>";
// print_r($data);
// exit;



		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('pay_now',$data);



		$this->load->view('common/footer',$data);



		$this->load->view('common/googlemap',$data);



	}

	public function processToPay()



	{

	

		$pay_per_property = $this->input->post('pay_per_property');

		$discount = $this->input->post('discount');

		$num_of_properties	= $this->input->post('num_of_properties');

		$total = $pay_per_property *  $num_of_properties- $discount;

		$data['prodata'] =  $this->property_model->getProperty();

		$data['paycount'] =  $this->property_model->getPaymentDetailByUserId();

		






		$data['activeclass']	=	'properties';





		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('pay_payment',$data);



		$this->load->view('common/footer',$data);



		$this->load->view('common/googlemap',$data);



	}

	public function paymentSuccess()



	{

	
		if(!empty($_POST))
		{



			$num_of_properties	=	$this->input->post('num_of_properties');

			$pay_per_property=$this->input->post('pay_per_property');

			$discount =$this->input->post('discount');

			$pay_amount = $this->input->post('pay_amount');



			$stripeToken				=	$this->input->post('stripeToken');



			$stripeTokenType		=	$this->input->post('stripeTokenType');



			$stripe_email				=	$this->input->post('stripeEmail');



			$next_subcription_date = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );

			





			



			$paymentDetails =array('num_of_properties'=>$num_of_properties,

							'pay_per_property'=>$pay_per_property,

							'discount'=>$discount,

							'pay_amount'=>$pay_amount,

							'stripe_token'=>$stripeToken,

							'stripe_token_type'=>$stripeTokenType,

							'stripe_email'=>$stripe_email,

							'next_subcription_date'=>$next_subcription_date,

							'user_id' => $this->session->userdata('owner_id') );



		


			



		 	$id =$this->common_model->savePaymentDetailsData($paymentDetails);

		 	$firstname = $this->session->userdata('firstname');
		 	 $userid = $this->session->userdata('owner_id');
			$getUserData['usertype'] = $this->common_model->getUserData($userid);
			 $email = $getUserData['usertype']['email']; 


			$data = array

			(
				'user'=> ucfirst($firstname)
				
			);



			$this->common_model->send_mail($email,"payment_success",$data);


			


			redirect(base_url('payment/thankYou'));

		}

	}

	public function thankYou()

	{

		$data['activeclass']	=	'properties';





		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('thankyou',$data);



		$this->load->view('common/footer',$data);



		$this->load->view('common/googlemap',$data);



	}



	public function history()

	{

		$data['activeclass']	=	'properties';

		

		$data['paymentHistory'] = $this->Request_model->paymentHistory();

	

		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('payment_history',$data);



		$this->load->view('common/footer',$data);



		$this->load->view('common/googlemap',$data);

	}

	// Plan Renew billing
	public function plan_rebill()
	{
		if(!empty($_POST))
		{
			$data['purchaseunit'] = $this->input->post('unitalot');
			$data['totalamount'] = $this->input->post('pay_amount');
			$data['unit_price'] = $this->input->post('unit_price');
			$data['base_price'] = $this->input->post('base_price');
			$data['activeclass'] = '';

				$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('renew_plan_billing',$data);

		$this->load->view('common/footer',$data);
		}
	}	

	/* Added by Rajmander */
	public function proceed_pay()
	{
		/*echo '<pre>';
		print_r($_POST); exit; */
		$stripeToken				=	$this->input->post('stripeToken');
		$stripeTokenType			=	$this->input->post('stripeTokenType');
		$stripe_email				=	$this->input->post('stripeEmail');
		$unit_price				=	$this->input->post('perunitcost');
		$base_price				=	$this->input->post('baseprice');
		$purchaseunit				=	$this->input->post('purchaseunit');

			$next_subcription_date = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
			$pay_amount = $this->input->post('totalamount');


			$paymentDetails =array(
							'unit_price'=>$unit_price,

							'base_price'=>$base_price,
							'pay_amount'=>$pay_amount,
							'stripe_token'=>$stripeToken,

							'stripe_token_type'=>$stripeTokenType,

							'stripe_email'=>$stripe_email,

							'next_subcription_date'=>$next_subcription_date,

							'user_id' => $this->session->userdata('owner_id') );

			$id =$this->common_model->savePaymentDetailsData($paymentDetails);
			$update_plan_status = array('plan_type'=>2,'enddate'=>$next_subcription_date,'units_purchased'=>$purchaseunit,'total_amount'=>$pay_amount);
			$this->common_model->update_plan_status($this->session->userdata('owner_id'),$update_plan_status);

		 	$firstname = $this->session->userdata('firstname');
		 	 $userid = $this->session->userdata('owner_id');
			$getUserData['usertype'] = $this->common_model->getUserData($userid);
			 $email = $getUserData['usertype']['email']; 


			$data = array

			(
				'user'=> ucfirst($firstname)
				
			);



			//$this->common_model->send_mail($email,"payment_success",$data);
			redirect(base_url('payment/thankYou'));
	}

		public function purchase_unit()
	{
		$data['activeclass'] = '';
			$data['plan_details'] = $this->common_model->getPlanDetails($this->session->userdata('owner_id'));

		$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('purchase_unit_view',$data);

		$this->load->view('common/footer',$data);
	}

	public function pay_per_unit()
	{
		if(!empty($_POST))
		{
			$data['purchaseunit'] = $this->input->post('purchaseunit');
			$data['totalamount'] = $this->input->post('totalamount');
			$data['perunitcost'] = $this->input->post('perunitcost');
			$data['baseprice'] = $this->input->post('baseprice');
			$data['activeclass'] = '';

				$this->load->view('common/header');



		$this->load->view('common/sidemenu',$data);



		$this->load->view('pay_per_unit_view',$data);

		$this->load->view('common/footer',$data);
		}
	}

	public function paynow_per_unit()
	{
		$units = $this->common_model->check_units_purchased($this->session->userdata('owner_id'));
		$units_available = $units['units_purchased'];
		$units_paid = $units['total_amount'];
		$current_amount = $this->input->post('totalamount');
		$baseprice = $this->input->post('baseprice');
		$total_amount = $current_amount+$units_paid;

		$purchased_unit = $this->input->post('purchaseunit');
		$total_units = $units_available+$purchased_unit;

		$data = array('total_amount'=>$total_amount,'units_purchased'=>$total_units,'plan_type'=>2);
		$stripeToken				=	$this->input->post('stripeToken');
		$stripeTokenType			=	$this->input->post('stripeTokenType');
		$stripe_email				=	$this->input->post('stripeEmail');
		$perunitcost				=	$this->input->post('perunitcost');

		// check if user already payed
		$user_details_exists=$this->common_model->is_payment_details_avilable($this->session->userdata('owner_id')); 
		$base_price = $user_details_exists == 0 ? $baseprice : '';

		$payment_details = array('user_id'=>$this->session->userdata('owner_id'),'pay_amount'=>$current_amount,'stripe_token'=>$stripeToken,'stripe_token_type'=>$stripeTokenType,'stripe_email'=>$stripe_email,'base_price'=>$base_price,'next_subcription_date'=>$units['enddate'],'unit_price'=>$perunitcost); 

		$this->common_model->update_plan_status($this->session->userdata('owner_id'),$data);
		$this->common_model->savePaymentDetailsData($payment_details);

				 	$firstname = $this->session->userdata('firstname');
		 	 $userid = $this->session->userdata('owner_id');
			$getUserData['usertype'] = $this->common_model->getUserData($userid);
			 $email = $getUserData['usertype']['email']; 


			$data = array

			(
				'user'=> ucfirst($firstname)
				
			);



			$this->common_model->send_mail($email,"payment_success",$data);


			


			redirect(base_url('payment/thankYou'));
	}

}