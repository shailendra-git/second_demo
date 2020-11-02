<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_cron extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->load->model('auth_model');

		$this->load->model('common_model');

		$this->load->model('team_model');

		$this->load->model('property_model');

		$this->load->model('new_cron_model');

		$this->load->library('session');

        $this->load->library('email');
       // $this->load->model('cron_model');

	
	

	}

	public function cron(){
		// $data =array();
          $new_data['new_record'] = $this->new_cron_model->get_payments();
           
           // echo "<pre>";
           // print_r($new_data);
          foreach ($new_data['new_record'] as $key => $value) {	
            //echo "<pre>";
                    $firstname  = $value['firstname'];
			        $email = $value['email'];
			        $amount = $value['pay_amount'];
			        $exp_date = $value['next_subcription_date'];
			        $subject = 'Your property subscription is expiring';
			        $message = 'Dear '.ucfirst($firstname).', 
			        <br/>Your property subscription of '.$amount. ' /- is expiring on '.$exp_date. '.<br/>To make payment for property subscription, click <a href="'.base_url('auth/signin').'">here</a>';
			        

					// $config['protocol'] = 'sendmail';
					// $config['mailpath'] = '/usr/sbin/sendmail';
					// $config['charset'] = 'iso-8859-1';
					// $config['wordwrap'] = TRUE;

					// $this->email->initialize($config);

					//     $this->email->to($email);
					//     $this->email->from('your@example.com');
					//     $this->email->subject('Here is your info ');
					//     $this->email->message('Hi '.$message.' Here is the info you requested.');
					//     $this->email->send();

					// echo $this->email->print_debugger();

			        $data_exp = array
							(

                                'name' => ucfirst($firstname),

								'email'=> $email,

								'subject' => $subject,

								'message' => $message,

								'expire_date' => $exp_date,
			                              
							);
// $email_body = '<!DOCTYPE html>
// <html>
// <head>
// 	<title>Expire User Plan</title>
// </head>
// <body>
// <center>
//      <h4 style="color:red;">Congratulation !</h4>'
//       .$firstname. ':' .$email.'<br/>
//       <label>From :</label>Your@gamil.com<br/>
//      <label>To : </label>'.$email.'<br/>
//      <label>Subject : </label>'.$subject.'<br/>
//      <label>Message : </label>'.$message.'<br/>
//     </center>
// </body>
// </html>';
							//echo "<pre>";
						    //print_r($data_exp);
		//$email_type = "Expire Plan";					
       $this->new_cron_model->send_mail($email,$data_exp);
     }            

	}
}