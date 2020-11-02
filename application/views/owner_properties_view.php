<style type="text/css">
  
   @media only screen and (max-width: 767px){
    .btn-sm{margin: 14px 0px 14px 0px !important;}
   }
     @media only screen and (max-width: 420px){
     .btn_cls_ml{margin-right:4px !important  ;}
     .action-top{padding: 0px !important;}
     .cls_h5{font-size: 15px !important ;line-height: 23px !important; font-weight: bold !important}
   }
</style>

<div class="contnet-area">

	<div class="p-4">

	<div class="action-top d-flex justify-content-between">



		  <div class="filter pull-left">

        <div class="dropdown">

    

          <button class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">



            All Properties

          </button>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php 

              if (isset($propertydata))

              foreach($propertydata as $value)



              {?>

                 <a class="dropdown-item" href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info')?>"><?php echo substr( $value['address'],0,30)?></a>

             <?php }?>

          </div>

        </div>

         	<div class="switch ">

	         	<form action = "check.php" method = "post">

	           		<label class="cls_opn">

	             

		             	<span class="closed_right">Archived</span>



		             	  <input type="checkbox" onchange="maintainceRequest();" id="statusChacked" <?php if($status==1 ){?> checked <?php }?> >

		             	<span class="lever"></span>

		          		<span class="open_left">Active</span>

	          		</label>

	          	</form>	

	         

         

         </div>

       </div>

	   <div>

		
	

             

                <span style="color: red; font-size: 16px; margin-right: 40px;" class="btn_cls_ml">

				      

              	     <?php 	



			 			

                             $this->db->select('count(*) as propertyCount,');

                             $this->db->from('onelane_properties');

                             $this->db->where('onelane_properties.owner_id',$property['owner_id']);

                             $this->db->where('onelane_properties.status ','Open');

                             $permissions = $this->db->get()->result_array();



                             if(!empty($permissions))

                             {

                         

                                 foreach ($permissions as $permission) 

                                 {

                                    $j= $permission['propertyCount'];

                                   

                                  }

                              }



                               $s= $j-$paymentDetails['subscribe_properties'];



                      if ($this->session->userdata('user_type')==4) 



                      {

                      

                       } 

                       else

                        { 



              				if ($s== 0) 

              				{ 

              					?> 





              					 <?php



              					      $startdate = $paymentDetails['next_subcription_date'];



                              $expire = strtotime($startdate);

                              $today = strtotime("today midnight");

                              

                              if($today >= $expire) 

                              { ?>





                              

                                <?php 

                              }

                              else

                              {?>



                              <?php

                              }

                              ?>

                              <?php

              				}

              				else

              				{

                        if ($s>=0) {

                              

                          

                        





                  			 ?>

                                



							             <?php

			 		                    $startdate = $paymentDetails['next_subcription_date'];



                              $expire = strtotime($startdate);

                              $today = strtotime("today midnight");

                              

                              if($today >= $expire) 

                              {

                                 $this->db->select('count(*) as propertyCount');

                                 $this->db->from('onelane_properties');

                                 $this->db->where('onelane_properties.owner_id',$property['owner_id']);

                                 $this->db->where('onelane_properties.status ','Open');

                                 $permissions = $this->db->get()->result_array();

                                 // print_r($permissions);

                                 // exit();

                                 if(!empty($permissions))

                                 {

                             

                                     foreach ($permissions as $permission) 

                                     {

                                        $j= $permission['propertyCount'];

                                      
                                       

                                      }

                                  }

                             	$s =$j;

                                if ($s>=0) {

                                 // echo $s; 

                                }

                              	

                              }


                              else

                              {



                                ?>

                               

                                <?php

                                 $this->db->select('count(*) as propertyCount');

                                 $this->db->from('onelane_properties');

                                 $this->db->where('onelane_properties.owner_id',$property['owner_id']);

                                  $this->db->where('onelane_properties.status ','Open');

                                 $permissions = $this->db->get()->result_array();

                                 if(!empty($permissions))

                                 {

                             

                                     foreach ($permissions as $permission) 

                                     {

                                        $j= $permission['propertyCount'];

                                       

                                      }

                                  }



                                   $s= $j-$paymentDetails['subscribe_properties'];

                                  if ($s>=0) {

                                 // echo $s; 

                                }

                                   ?>

                             

                             		<?php 

                                } 

                                ?>

                              


									       

      								  </a>  </span>

                                      <?php 

      				            }

      								}

                  }

				      

				  ?>

				  	

			

			

		<?php

		 if ($this->session->userdata('user_type')!='4') {?>

		 <a class="simple-ajax-popup-align-top btn btn-raised btn-primary" href="/owner/addProperty" class="btn2 new_req_btn pull-right">



		  Add Property

		  </a>

		<?php }?>

		

	</div>



	</div>

		

	<div id="property_hide">


		<?php if(!empty($prodata))

    	{

    		foreach($prodata as $property){

    	?>

		<div class="card col-md-12" style="margin-bottom:5px">

			<div class="card-body">

				<div class="row">

					<div class="col-md-3">

						<div>

							
							<h5 class="property_heading_m_top cls_h5"><?php echo ucfirst($property['address'])?></h5>

						</div>

						<div><a href="<?php echo base_url('owner/property_basicinfo/'.$property['id'].'/basic-info')?>" class="btn btn-outline-primary btn-sm btn-block">Basic Info</a></div>

						<div><a href="<?php echo base_url('owner/property_basicinfo_unit/').$property['id'];?>/units" class="btn btn-outline-primary btn-sm btn-block">Unit(<?php

                                 $this->db->select('count(*) as tenantdata');

                                 $this->db->from('property_units');

                                 $this->db->where('property_units.property_id',$property['id']);

                                 $permissions = $this->db->get()->result_array();

                                 if(!empty($permissions)){

                                 $comma = '';

                                 foreach ($permissions as $permission) {

                                    echo $comma.''.$permission['tenantdata'];

                                    $comma = ',';

                              }

                              }

                              ?>)</a></div>

						<div><a href="<?php echo base_url('owner/editproperty_guide/').$property['id'];?>" class="btn btn-outline-primary btn-sm btn-block">Guide</a></div>

					</div>



					<div class="col-md-8 sm-3">

						<div class="d-flex flex-wrap">

							

							<div class="col-md-3 prop-block">

								<div><h6 class="property_heading_m_top">Vacant & Unlisted</h6></div>

								

								<div><h1 class="count-font">

									 <?php        
                                 $this->db->select('count(*) as tenantdatavacant');

                                 $this->db->from('onelane_property_tenant');

                                 $this->db->where('onelane_property_tenant.property_id',$property['id']);
                                 

                                 $permissionsvacant = $this->db->get()->result_array();

                                 if(!empty($permissionsvacant)){

                                      $commavacant = '';

                                     foreach ($permissionsvacant as $permissionvacant) {

                                         $commavacant = $permissionvacant['tenantdatavacant'];

                                        //$commavacant = ',';

                                  }

                                  }
                                  

                                 $this->db->select('count(*) as tenantdata');

                                 $this->db->from('property_units');

                                 $this->db->where('property_units.property_id',$property['id']);

                                 $permissions = $this->db->get()->result_array();

                                 if(!empty($permissions)){

                                 $comma = '';

                                 foreach ($permissions as $permission) {

                                     $comma  = $permission['tenantdata'];

                                  //  $comma = ',';

                              }

                              }

                            $tenantvacantdata = $comma - $commavacant;
                            echo $tenantvacantdata;
                              ?>







								</h1></div>

								<a href="<?php echo base_url('owner/property_basicinfo_unit/').$property['id'];?>/units" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>

							</div>

							<div class="col-md-3 prop-block">

								<div><h6>Leads</h6></div>

								<div class="font-color"  style="font-size:32px;">-</div>

								<button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button>

							

							</div>

							<div class="col-md-3 prop-block">

								<div><h6>Rental Applications</h6></div>

								<div><h1 class=""><i class="material-icons count-font font-color">check</i></h1></div>

								<button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button>

								

							</div>

							<div class="col-md-3 prop-block">

								<div><h6>Open Maintenance</h6></div>

								

								<div><h1 class="count-font"><?php

                                 $this->db->select('count(*) as tenantdata');

                                 $this->db->from('maintenance_request');

                                 $this->db->where('maintenance_request.property_id',$property['id']);

                                 $this->db->where('maintenance_request.status',$property['status']);

                                  
                                 $permissions = $this->db->get()->result_array();

                                 if(!empty($permissions)){

                                 $comma = '';

                                 foreach ($permissions as $permission) {

                                    echo $comma.''.$permission['tenantdata'];

                                    $comma = ',';

                              }

                              }

                              ?></h1></div>

								<a href="<?php echo base_url('owner/requests/open/').$property['id'];?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>

							</div>



						</div>

					</div>

				</div>

			</div>

		</div>

		<?php } }?>



	</div>

	</div>

</div>



<script>

function maintainceRequest()

{

  if($('#statusChacked').is(':checked'))

  {  

    document.location.href="<?php echo base_url('owner/properties/open')?>/<?php echo $property_id;?>";

  }

  else 

  {



    document.location.href="<?php echo base_url('owner/properties/close')?>/<?php echo $property_id;?>";

  }

}

</script>

