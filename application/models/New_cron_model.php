<?php defined('BASEPATH') OR exit('No direct script access allowed');
class New_cron_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    
  }
  public function validateuser_cron(){
    
    return $this->db->get_where('onelane_payment_details')->row_array();
  }
  public function get_payments(){
 
    return  $this->db->query("SELECT ou.firstname, ou.email, opd.next_subcription_date,opd.pay_amount FROM onelane_payment_details opd INNER JOIN onelane_users ou ON  opd.user_id =  ou.id WHERE DATEDIFF(`next_subcription_date` , NOW( )) < 10")->result_array();
  }

  // public function get_owner_id($owner_id){
  //   //echo $owner_id;
  //   return $this->db->query("SELECT * FROM  `onelane_users` WHERE id ='$owner_id' AND `user_type`=1")->result_array();
  // }

  public function send_mail($email,$data) { 

 //print_r($data);
         $from_email = "your@example.com"; 

         $to_email = $email; 

        // $email_result= $this->getEmailData($email_type);
        //$body_email = $email_type;

         $this->load->library('email'); 

         $this->email->from($from_email, 'Your Name'); 

         $this->email->to($to_email);

         $this->email->subject($data['subject']); 

    //      foreach($data as $key => $value)
    // { 
    //   print_r($value);
$email_body = '<!DOCTYPE html>
<html>
<head>
</head>
<body>'
      .$data['name']. ' &lt;' .$data['email'].'&gt;<br/>
     <label>From :</label>Your@gamil.com<br/>
     <label>To : </label>'.$data['email'].'<br/>
     <label>Subject : </label>'.$data['subject'].'<br/>
     <label>Message : </label>'.$data['message'].'<br/><br />
    <h4>Thanks Onelane</h4>
</body>
</html>';
 // <label>Expire Date : </label>'.$data['expire_date'].'<br/>
 // <!-- <a href="../auth/signin">Back</a> --> 
       //print_r($value);
     // $body_email = str_replace("{".$key."}",$value,$body_email);
  //  }
         $this->email->message($email_body); 
          print_r($email_body);
        //exit;
      // echo $body_email;
      // exit();
      } 

  }