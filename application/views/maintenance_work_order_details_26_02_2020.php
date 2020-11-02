
<header class="md-paper md-paper--2 md-toolbar md-toolbar--fixed bgg"><h4 class="md-title md-title--toolbar"> <a class="btn btn-raised btn-primary" href="<?php echo base_url('owner/edit_request/').$requestbasicinfo['id'];?>"><i class="md-icon material-icons md-text--inherit">fast_rewind</i></a>  &nbsp; WORK ORDER

  <button onclick="window.print();" type="button" class="btn btn-raised btn-primary" style="float: right;">

 <div class="md-ink-container"></div><i class="md-icon material-icons md-text--inherit">print</i></button>



</h4><div class="md-cell--right md-toolbar--action-right"></div></header>

<div class="">

   <div class="container-fluid">

      

      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">

            <div class=" white work-orders-and-participants bgg">

                <table>

                      <tr>

                        <th>Status</th>

                        <td>

                          

                         <form id="workOrderStatusForm">

                              <input type="hidden" id="id" name="id" value="<?php echo $workorderinfo['id']?>">

                              

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-5 card_align">

                              <div class="filter  open_close_mobile_view" >

                                 <div class="switch">

                                    <label class="c_p_btn" style="margin-bottom: 0px">

                                    <span class="closed_right">Closed</span>

                                  <input type="checkbox" id="status"  name="status"  value="<?php echo $requestbasicinfo['status'];?>" <?php if ($workorderinfo['status']== 'Open') {?> checked="" <?php

                                  

                                  } ?>>

                                    

                                    <span class="lever lever_size"></span>

                                    <span class="open_left">Open</span>

                                    </label>

                                 </div>

                              </div>

                            </div>

                          </form>

                       </td>

                      </tr>

                      <tr>

                        <th>Ref No</th>

                        <td>REF-<?php echo $workorderinfo['work_order_ref_id']?></td>

                      </tr>

                      <tr>

                        <th>Created At</th>

                        <td><?php echo $workorderinfo['formatted_date']?></td>

                      </tr>

                      <tr>

                        <th>Last Updated</th>

                        <td><?php echo $workorderinfo['formatted_date']?></td>

                      </tr>

                      <tr>

                        <th>Job Address</th>

                        <td> <?php echo $getfinalworkorderaddress['address']; ?>, Unit <?php echo $getfinalworkorderaddress['unit_id']; ?>, Las Vegas, NV 89119</td>

                      </tr>

                    </table>

            </div>

            <div class="col s12 card-body bgg">

              

               

             

               <h4 class="card-body card_align">

               INVOICES

               

               </h4>

               <p class="card-body card_align" style="font-size: 16px;">Submit an invoice to request payment only after work is complete.</p>

               <h5>

                

                <a class="simple-ajax-popup-align-top btn btn-raised btn-primary" href="/owner/getInvoiceById/<?php echo $workorderinfo['id'];?>" class="btn2 new_req_btn pull-right">



               SUBMIT INVOICE

               </a>
             
               <?php 
                    
                    foreach ($getworkorderinvoicedetails as $workorderinvoice) { 

                ?><hr>

               <p>$<?php echo $workorderinvoice['amount']?> Due ON <?php echo $workorderinvoice['formatted_date'] ?></p><br>

                <p><b>INVOICED</b></p><br>
                

                <p><a class="btn btn-raised btn-primary" href="<?php echo base_url('owner/downloadInvoice/').$workorderinvoice['id'];?>">Download</a></p>



              <?php 

                } ?>

                </h5>

              

              <h5 class="title card-body">

               </h5>

            </div>

            <div class="col s12 card-body bgg">

              <h4>

                SERVICE PROFESSIONAL

              </h4>

               <h5 class="title card-body card_align">

                 <p class="padd card_align"><?php echo $getworkorderdetails['contact_name']; ?></p>

                 <p  class="padd card_align"><?php echo $getworkorderdetails['company_name']; ?></p>

                 <p  class="padd card_align"><?php echo $getworkorderdetails['mobile']; ?></p>

                 <p  class="padd card_align"><?php echo $getworkorderdetails['email']; ?></p>

                  

               </h5>

                 <h4>

               MANAGED BY

               

              </h4>

              <h5 class="title">

                  <p class="card-body card_align"><?php echo $userdataworkorder['user_id']?><br>

                    <?php echo $userdataworkorder['mobile']?>

                </p>

              </h5>

               

               

               <h4>

                SCHEDULING CONTACT

                <a class="simple-ajax-popup-align-top" href="/owner/getWorkOrderSchedulById/<?php echo $workorderinfo['id'];?>" class="btn2 new_req_btn pull-right">



                  <i class="material-icons btn btn-raised btn-primary edit-icon">edit</i>

                </a>

              </h4>

              <h5 class="title card-body card_align">

                <?php 

                  foreach ($getworkorderschedul as $getworkorder)

                  { 

                    if ($getworkorder['service_worker']=='') {

                      ?>



                     <p class="padd card_align"><?php echo $getworkorder['custom_client']?>

                      <br>

                          <u><?php echo $getworkorder['cus_phone'] ?></u>

                        </p>

                    <?php

                    } 

                    else

                     { ?>

                        <p class="padd card_align"><?php echo $getworkorder['service_worker']?><br> <u><?php echo $getworkorder['mobile']?></u></p>

                        

                    <?php

                    }}

                    ?>

                    



                <br>



              </h5>

              <h4>

               BILL TO CONTACT

                <i class="material-icons btn btn-raised btn-primary edit-icon" data-toggle="modal" data-target="#billModal">edit</i>

              </h4>

              <h5 class="title">

                  <p class="card-body card_align"><?php echo $userdataworkorder['user_id']?><br>

                    <?php echo $userdataworkorder['mobile']?>

                </p>

              </h5>

               <!---->            

            </div>

        </div>

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">

            <div class="col s12 card-body bgg">

              <h4>

                WORK ORDER

  

                <i class="material-icons btn btn-raised btn-primary edit-icon" data-toggle="modal" data-target="#instructionsModal">edit</i>

                

                

              </h4>

               <h5 class="title line_h_work">

                  <?php echo $workorderinfo['title']; ?>

                  

               </h5>

               

               <h4 style="margin-top: 30px">INSTRUCTIONS</h4>

               <div class="description line_h_work">

                 

                  <?php echo $workorderinfo['maintenance_instructions']; ?>

                  

               </div>

                    

            </div>

             <div class="col s12 card-body bgg">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">UPDATES</h5>

                 

                </div>

                <div class="modal-body">

                 <div class="row">

                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">

                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">

                        <div class=" col-md-12">

                          <div class="">

                            

                            <form id="addUpdateForm">

                              <input type="hidden" id="workorder_id" name="workorder_id" value="<?php echo $workorderinfo['id']?>">
                              <input type="hidden" id="workorder_email" name="workorder_email" value="<?php echo $getworkorderdetails['email']?>">
                              <input type="hidden" id="title" name="title" value="<?php echo $getworkorderdetails['title']?>">
                              <input type="hidden" id="contact_name" name="contact_name" value="<?php echo $getworkorderdetails['contact_name']?>">
                              <input type="hidden" id="work_order_ref_id" name="work_order_ref_id" value="<?php echo $getworkorderdetails['work_order_ref_id']?>">

                              <div class="form-group bmd-form-group">

                              <input type="text" name="update_content" class="form-control" id="update_content"  placeholder="Enter Your Update Here..." required="">

                              <span style='color:red' id="updateerr"></span>

                              </div>

                              <div class="form-group">

                              <button type="submit" class="btn btn-primary btn-raised edit-icon">Add Update</button>

                              </div>

                            </form>

                          </div>

                        </div>

                      </div>

                    </div>

                 </div>

                </div>

                <div>

                  <?php

                    if(!empty($getupdateworkorders))



                    foreach ($getupdateworkorders as $getupdateworkorder) {

                  ?>

                  <div class="row">

                    <div class="col-md-12">

                      <div class="row">

                        <div class="col-md-2">

                          <div class="order-user"> <?php echo $userdataworkorder['flname']?></div>

                         

                        </div> 

                        <div class="col-md-2">

                          <?php echo $userdataworkorder['user_id']?>

                          <br>

                          <?php echo $userdataworkorder['formatted_date'] ?>

                        </div> 

                        <div class="col-md-8">

                          

                         <p class="content_breack"> <?php echo $getupdateworkorder['update_content']; ?></p>

                        </div>                        

                      </div>

                    </div>

                  </div>

                  <?php } ?>

                 

                </div>

                     

            </div>

            <div class="card col-md-12 mt-3 bgg">

              <div>

                <h4>MAINTENANCE REQUEST PHOTOS</h4>

                <?php

                 if(!empty($requestdocs))

                 {

                  foreach ($requestdocs as $requestdoc) { 

                       $filename = explode('.',$requestdoc['file_name']);

                 

                       ?>

                    <div id="<?php echo $filename[0]?>"  >

                       <div style="float: left; margin: 10px; margin-left: 0px;">

                          <img  src="<?php echo base_url('upload/request_doc/').$requestdoc['file_name']?>" class="img-thumbnail size_image">

                       </div>

                    </div>

                <?php }

                }

                ?>

              </div>

            </div>

            <div class="bgg"> 

              <div id="maintenance_request_hide">

                <h4 class="mb-3">MAINTENANCE WORK ORDER PHOTOS</h4>

                

              <div id="showImages" class="card col-md-12 mt-3">

                <div>

                         <?php

                  if(!empty($workorderdocs))

                  {

                    foreach ($workorderdocs as $requestdoc) { 

                       $filename = explode('.',$requestdoc['file_name']);

                 

                       ?>

                    <div id="<?php echo $filename[0]?>"  >

                       <div style="float: left; margin: 10px; margin-left: 0px;">

                          <img  src="<?php echo base_url('upload/workorder_doc/').$requestdoc['file_name']?>" class="img-thumbnail size_image">

                          <div>

                             <center>
                              <?php
                              //echo $requestdoc['owner_id'];
                                if($requestdoc['owner_id'] == 0){
                                  ?>
                                  <div><b>Uploaded By </b>
                                    <br>Workorder</div>
                                  <?php
                                 }else{
                                  ?>
                                  <div><b>Uploaded By </b>
                                     <br>Owner</div>
                                  <?php
                                 }

                              ?>
                              <br>
                                <button class='workorderremdoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $requestdoc['id']?>" rem-file="<?php echo $requestdoc['file_name']?>" >

                                   Remove

                                </button>

                             </center>

                          </div>

                       </div>

                    </div>

                  <?php }

                    }

                  ?>

                </div>

              </div>

              <div style="margin-top: 20px;">

                <form action="<?php echo base_url('owner/work_order_doc_uploadAndDelete');?>" class="dropzone dz-clickable" id=""> 

                  <input type="hidden" name="workorder_id" value=" <?php echo $workorderinfo['id']; ?>">   

                  <div class="dz-default dz-message"><span><i class="material-icons">cloud_upload</i> Drag Files or Click Here to Upload</span></div>

                </form>

              </div>

            </div>

          </div>

        </div>





          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >

           

            <div style="color: red;"><?php echo $this->session->flashdata('errmsg')?></div>

            

          <div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">EDIT INSTRUCTIONS</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                  </button>

                </div>

                <div class="modal-body">

                 <div class="row">

                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">

                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">

                        <div class="card col-md-12">

                          <div class="card-body">

                            <form action="<?php echo base_url('owner/workOrderDetails/').$workorderinfo['id'];?>" method="POST">

                              <input type="hidden" name="id" value="<?php echo $workorderinfo['id']; ?>">

                              <div class="form-group ">

                                <label for="address " class="bmd-label-floating">Title  *</label>

                                <input type="address" name="title" class="form-control" id="address" required="" minlength="20"  value="<?php echo $workorderinfo['title']; ?>">

                              </div>

                              <div class="form-group ">

                                <label for="address " class="bmd-label-floating">Instructions  *</label>

                                <input type="address" name="maintenance_instructions" class="form-control" id="address" required="" minlength="20" value="<?php echo $workorderinfo['maintenance_instructions']; ?>">

                              </div>

                              <div class="form-group">

                                <button type="submit" class="btn btn-primary btn-raised mt-3">Update</button>

                               <button class="btn btn-default" style="margin-bottom: -10px;" data-dismiss="modal">Cancel</button>

                              </div>

                            </form>

                          </div>

                        </div>

                      </div>

                    </div>

                 </div>

                </div>

              </div>

            </div>

          </div>

          <div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">CHANGE BILL-TO CONTACT</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                  </button>

                </div>

                <div class="modal-body">

                 <div class="row">

                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">

                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">

                        <div class="card col-md-12">

                          <div class="card-body">

                            <form action="<?php echo base_url('owner/workorderinstruction/').$workorderinfo['id'];?>" method="POST">

                               <input type="hidden" name="id" value="<?php echo $workorderinfo['id']; ?>">

                              <div class="row bottom">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

                                   <div class="form-group bmd-form-group is-filled">

                                      <label for="address" class="bmd-label-floating">Bill To Contact *</label>

                                      <div class="select-wrapper">

                                         <select class="form-control" id="exampleFormControlSelect1" name="maintenance_request_user_id" required="">

                                          

                                            <?php 

                                      foreach ($userdata as $userdatas)

                                             {?>



                                         <option  value="<?php echo $userdatas['id']?>"><?php echo $userdatas['user_id']?></option>

                                         <?php }

                                            ?>

                                        

                                          </select>

                                         <span class="caret">▼</span>

                                      </div>

                                   </div>

                                </div>

                             </div>  

                              <div class="form-group">

                                <button type="submit" class="btn btn-primary btn-raised mt-3">Update</button>

                                <button class="btn btn-default" style="margin-bottom: -10px;" data-dismiss="modal">Cancel</button>

                                

                              </div>

                            </form>

                            

                          </div>

                        </div>

                      </div>

                    </div>

                 </div>

                </div>

              </div>

            </div>

          </div>

         </div>

      </div>

   </div>

</div>

<?php



function get_time_ago( $time )

{

    $time_difference = time() - $time;



    if( $time_difference < 1 ) { return ' 1 second ago'; }

    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',

                30 * 24 * 60 * 60       =>  'month',

                24 * 60 * 60            =>  'day',

                60 * 60                 =>  'hour',

                60                      =>  'minute',

                60                      =>  'second',

                1                       =>  'second'

    );



    foreach( $condition as $secs => $str )

    {

        $d = $time_difference / $secs;



        if( $d >= 1 )

        {

            $t = round( $d );

            return ' ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';

        }

    }

}

?>

<script>

function myFunction() {

  window.print();

}

</script>



