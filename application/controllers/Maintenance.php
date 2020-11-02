<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()

	{

		parent::__construct();
 
		//$this->load->library('session'); 

        $this->load->helper('form'); 
        $this->load->helper('custom');

		$this->load->model('auth_model');
		$this->load->model('Common_model');
		$this->load->model('team_model');

		$this->load->model('property_model');

		$this->load->model('Request_model');
			

		// if($this->session->userdata('owner_id') == '')
		// 	redirect(base_url('auth/signin'));

	}


	public function index()
	{
		//$this->load->view('welcome_message');
		
    }

	public function work_order_view($id){
		//$owner_id = $this->session->userdata('owner_id');

      	$data =array();
      	

      	if(!empty($_POST))

		{

			$id=	$this->input->post('id');


			$title=	$this->input->post('title');

			$instruction=	$this->input->post('maintenance_instructions');

	        
               
			$updatedata =(

				array('title'=>$title,'maintenance_instructions'=>$instruction,'id'=> $id));

		

			$this->Request_model->updateWorkOrderdetails($updatedata);

		

			redirect(base_url('maintenance/work_order_view/'.$id.''));

		}

    	$data['requestbasicinfo'] = $this->Request_model->getWorkOrderAddressUnit($id);
    

    	$data['requestbasicinfo']['property_id'];
        
    	

    	

    	$requestServicesUserData = $this->Request_model->getFinalWorkOrderAddress($data['requestbasicinfo']['property_id']);

    	
        



    	$data['getworkorders'] = $this->Request_model->getWorkOrder($id);

       
    	$data['getfinalworkorderaddress'] = $requestServicesUserData;

    	

    	$data['workorderinfo'] = $this->Request_model->getWorkOrderInfo($id);
        // print_r($data['workorderinfo']);
        // exit; 
        
	       if($data['workorderinfo']['status'] == 'Close'){
	        	redirect(base_url('auth/signin'));
	        }
         



	 	$data['getupdateworkorders'] = $this->Request_model->getUpdateWorkOrder($id);

    	$data['getworkorderdetails'] = $this->Request_model->getworkorderDetails($id);
           
        $owner_id = $data['workorderinfo']['maintenance_request_user_id'];



    
    	//$data['getworkorderschedul'] = $this->Request_model->getWorkOrderSchedule($id);

     


    	$data['getworkorderinvoicedetails'] = $this->Request_model->getWorkOrderInvoiceDetails($id);

    	$data['popuptype']='iframe';
         


    	$userDataWorkOrder = $this->Request_model->getUserDataWorkOrder_user($owner_id);

 

    	$data['userdataworkorder'] = $userDataWorkOrder;


    	$data['userdata'] = $this->Request_model->getOwnerRequest_User($owner_id);
       
        

  		$data['requestdocs']=$this->getRequestShowWorkOrderImage($id);
        // print_r($data['requestdocs']);
        // exit;
  		$data['workorderdocs'] = $this->getWorkOrderImages($id);
 


      	$data['activeclass']='maintenance';

		$this->load->view('common/header');

		
		$this->load->view('maintenance_work_order_details_view',$data);

		$this->load->view('common/footer',$data);
	}

	public function getRequestShowWorkOrderImage($id)

	{

		return $this->Request_model->getRequestShowWorkOrderImage($id);

	}

	public function getWorkOrderImages($id)

	{

		return $this->Request_model->getWorkOrderDocs($id);

	}

	public function workOrderRenameFile($orgName,$workorder_id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'request_'.$workorder_id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return trim(str_replace(' ','',$newFilename)).'.'.$ext;

	}


	public function work_order_doc_uploadAndDelete()

	{

		$target_dir = "upload/workorder_doc/";

		$request = 'FILEUPLOAD';



		if(isset($_POST['request']))

		{ 

			$request = $_POST['request'];		

		}

		

		if($request == 'FILEUPLOAD')

		{

			$workorder_id = $this->input->post('workorder_id');
            


			$newFilename = $this->workOrderRenameFile(basename($_FILES["file"]["name"]),$workorder_id);

			
			$target_file = $target_dir .''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		$requestid = $this->saveFileWorkOrderDetails_User($newFilename,'workorder',$workorder_id);

			 		

					echo json_encode(array('file_name'=>$newFilename,'id'=>$requestid));

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

			$workorder_id=$_POST['id'];

			$filename=$_POST['name'];

			$this->deleteFileWorkOrderDetails($workorder_id,$filename);

			$filename = $target_dir.$_POST['name'];  

			unlink($filename); 

			exit;

		}

	}

	public function saveFileWorkOrderDetails_User($newFilename,$type,$workorder_id)

	{

		return $this->Request_model->saveFileWorkOrderDetails_User($newFilename,$type,$workorder_id);

	}

	
	public function deleteFileWorkOrderDetails($workorder_id,$filename)

	{

		echo $this->Request_model->deleteFileWorkOrderDetails($workorder_id,$filename);	

	}

	// public function UpdateWorkOrder_View($id){
        
	// }

	public function addUpdateToWorkOrder()

	{
		$workorder_id 	    =	$this->input->post('workorder_id');
	    $update 		    =	$this->input->post('update_content');
	
		$isupdate_found 	=	$this->Request_model->addUpdateToWorkOrder(array('workorder_id'=>$workorder_id,

			'update_content'=>$update));
       
		if(!$isupdate_found)

		{
             

			echo json_encode(array('code'=>'ALREADYEXISTS','msg'=>'has already been taken'));

		}

		else

		{
   


			echo json_encode(array('code'=>'NOTEXISTS','msg'=>''));	

		}

	}



	public function getInvoiceById($id)

	{	
		

		$data['requestworkorder'] = $this->Request_model->getRequestWorkOrderId($id);
       


		

		$data['workorderinfo'] = $this->Request_model->getWorkOrderInfo($id);



    	$requestServicesUserData = $this->Request_model->getPropertyServiceUsers($data['requestworkorder']['property_id']);


		$data['servicesuserdata'] = $requestServicesUserData;

		$this->load->view('common/popup_header',$data);

		

		$this->load->view('maintanance_work_order_invoice_popup_view',$data);

		$this->load->view('common/popup_footer',$data);



	}

    
    public function uploadWorkOrderInvoice()

	{
      	

		if(!empty($_POST))

		{

		

			$workorder_id=	$this->input->post('workorder_id');

			$amount=	$this->input->post('amount');	

			$due_date=	$this->input->post('due_date');

			$payable_to=	$this->input->post('payable_to');

			$memo=	$this->input->post('memo');

			$filename=	$this->input->post('file_name');

	

		$updatedata =(

			array('workorder_id'=>$workorder_id,'amount'=>$amount,'due_date'=>$due_date,'payable_to'=>$payable_to,'memo'=>$memo,'file_name'=> $filename,));

		



		$invoice_id =$this->Request_model->saveWorkOrderInvoice($updatedata);

			redirect(base_url('maintenance/work_order_view/'.$workorder_id.''));

		}


	}

public function workOrderImageRequest()

	{

		$workorder_id = $this->input->post('filename');
        // echo $workorder_id;
        // exit;
		$target_dir = "upload/workorder_Invoice_doc/";

			$newFilename = $this->workOrderInvoiceRenameFile(basename($_FILES["file"]["name"]),$workorder_id); 

			$target_file = $target_dir.''.$newFilename;

			$msg = ""; 

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

				{

			 		

					echo json_encode(array('filename'=>$newFilename,'id'=>$workorder_id));

				}

				else

				{    

					$msg = "Error while uploading"; 

				} 

				echo $msg;

				exit;	

	}
  
    
    public function workOrderInvoiceRenameFile($orgName,$workorder_id)

	{

		$newFilename = sha1(mt_rand(1, 9999) . uniqid()) . time().'request_'.$workorder_id;

		$extArr = explode('.',$orgName);

		$ext=end($extArr);

		return trim(date('Ymdhis')).'.'.$ext;

	}
    

}
