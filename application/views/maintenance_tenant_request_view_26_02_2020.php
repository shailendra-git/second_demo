<div class="contnet-area">







   <div class="container container_padding">







      <h3 style="margin: 20px;"><a class="btn btn-raised btn-primary" href="<?php echo base_url('tenant/requests/')?>">Back to all requests</a></h3>







      <div class="row">















         <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 border_col">







          <div class="row">







             <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">







            <h1 class="category">







               <?php echo $requestbasicinfo['name']; ?>







            </h1>







            







          </div>







           <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 ">







              <form id="asignStatusForm">







              <input type="hidden" id="id" name="id" value="<?php echo $requestbasicinfo['id']?>">







           







              <div class="filter pull-right open_close_mobile_view" >







                 <div class="switch">







                    <label class="c_p_btn">







                   







                







                  













                    </label>







                 </div>







              </div>







            </form>







          </div>







          <div class="address" style="margin-left: 15px;">







               <?php echo $requestbasicinfo['address']; ?>, Unit  <?php echo $getunit['unit']; ?>







            </div>







          </div>







            <div class="col s12" >







               <h5 class="title" style="margin-top:20px;">







                   <strong  class="headline_font"><?php echo $requestbasicinfo['request_text']; ?></strong>











                







                  







                  </a>







               </h5>















               







               







               <p class="info">















                  Created by <?php echo $requestbasicinfo['firstname'];?> <?php echo $requestbasicinfo['lastname'];?> at <?php echo $requestbasicinfo['formatted_date']; ?>, REF<?php echo $requestbasicinfo['ref_id'];?>







               </p>







               <div class="description" style="margin-top:10px;">







                 







                  <?php echo $requestbasicinfo['description_text']; ?>







               </div>







         







            </div>















            <div class="card col-md-12 mt-3">







              <div id="showImages">







                       <?php







                if(!empty($requestdocs))







                {







                  foreach ($requestdocs as $requestdoc) { 







                     $filename = explode('.',$requestdoc['file_name']);







               







                     ?>







                  <div id="<?php echo $filename[0]?>"  >







                     <div style="float: left; margin: 10px; margin-left: 0px;">







                        <img  src="<?php echo base_url('upload/request_doc/').$requestdoc['file_name']?>" class="img-thumbnail size_image">
                        <span><?php echo $requestdoc['owner_id'] > 0 ? '<strong>Post by </strong> Owner' : '<strong>Post by </strong> Tenant'?></span>







                        <div>







                           <center>







                             <?php







                              if ($requestbasicinfo['status'] == 'Open') { ?>













                            <?php } ?>







                           </center>







                        </div>







                     </div>







                  </div>







                <?php }







                  }







                ?>







              </div>







            </div>







            <?php







            if ($requestbasicinfo['status'] == 'Open') { ?>







                <div id="maintenance_request_hide">







                  <div class="card col-md-12 mt-3">







                     <div class="card-body ">







                     <h6 class="mb-3">Private Property Documents</h6>







                     <p class="text-small text-secondary my-3">Documents uploaded here are only visible to you and property members who can access the Property tab.







                     </p>







                     







                    <form action="<?php echo base_url('tenant/tenant_document_doc_uploadAndDelete');?>" class="dropzone dz-clickable" id=""> 







                     <input type="hidden" name="tenant_doc_id" value=" <?php echo $requestbasicinfo['id']; ?>">   







                     <div class="dz-default dz-message"><span><i class="material-icons">cloud_upload</i> Drag Files or Click Here to Upload</span></div>







                    </form>







                    </div>







                  </div>







                </div>







              <?php







              }







            ?>







          







          <div class="col s12">







                <div class="modal-header">







                  <h5 class="modal-title" id="exampleModalLabel">UPDATES</h5>







                </div>







               







                 <div class="row">







                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">







                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">







                       







                            







                            <form id="requestTenantUpdateForm">







                              <input type="hidden" id="maintenance_id" name="maintenance_id" value="<?php echo $requestbasicinfo['id']; ?>">


                              <input type="hidden" id="owner_id" name="owner_id" value="<?php echo $requestbasicinfo['owner_id']; ?>">





                              <div class="form-group bmd-form-group">







                              <input type="text" name="update_content" class="form-control" id="update_content" placeholder="Enter Your Update Here..." required="">







                              <span style="color:red" id="updateerr"></span>







                              </div>







                              <div class="form-group">







                              <button type="submit" class="btn btn-primary btn-raised edit-icon">Add Update</button>







                              </div>







                            </form>







                         







                      </div>







                    </div>







                 </div>







            







                 <div>







                  <?php







                    if(!empty($getUpdateReqest))















                    foreach ($getUpdateReqest as $getupdaterequest) {







                  ?>

                  
                    <?php echo $getupdaterequest['update_content']?><br>
                   Posted On <?php echo date('F d Y',strtotime($getupdaterequest['created_at'])); echo ' at '.date('h:i A',strtotime($getupdaterequest['created_at']));
                   echo  '<br>',$getupdaterequest['owner_id'] > 0 ? '<strong>Posted By</strong> Owner':'<strong>Posted By</strong> Tenant';
                   ?>

                      <hr>

                    





                  












                    







                  <?php } ?>







                 







                </div>







  






          </div>







    







         </div>







         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 border_col">







            <div class=" white work-orders-and-participants">







               <div id="ember2033" class="row ember-view">







                  <div class="col s12 m7">







                     <h3 class="work_order">Work Orders</h3>







                      <div>





















                     













                      







                      </div>







                     







                  </div>







                 







                    







                      







                  












                            







      







               </div>







                <div>







                  







                 







               















                </div>







               







            </div>







             <div>







          <?php







          foreach ($getworkorders as $getworkorder) {







           if ($getworkorder['status'] =='Open') {







            







          ?>







          <div class="card col-md-12 mt-3  work_order_edit">







            <div id="showImages">







              <div id="415303b0a1d4963ff362af6e1a05892d71c5d4771554474954request_1">







                <div>







                  <div class="card-body ">







                    <h6 class="mb-3" style="font-weight: 500;">REF<?php echo $getworkorder['work_order_ref_id'];?><span class="pull-right"><?php echo $getworkorder['status'];?></span> </h6>







                   







                    <p class="text-small text-secondary my-3"><a style="color:#009688;">







                      <?php echo $getworkorder['title'];?>                        </a>







                    </p>







                    <div class="managed-by participant">







                      <div class="info">







                        <div class="name content_colo">







                          <?php echo $getworkorder['contact_name'];?>







                          <?php echo $getworkorder['company_name'];?>  







                        </div>







                        <a href="tel:(958) 431-6586" class="phone-number" style="color:#009688;margin-top: 10px; line-height: 2.0;    font-size: 15px;">







                        <?php echo $getworkorder['mobile'];?>   







                        </a>







                        </div>







                        <p>Not Scheduled</p>







                      </div>







                    </div>







                    <div>







                      <center>














                       







                      </center>







                    </div>







                  </div>







                </div>







              </div>







            </div>







          <?php } } ?>







          </div> 







          <div id="hide_workOrder" style="display: none;">







          <?php







          foreach ($getworkorders as $getworkorder) {







           if ($getworkorder['status'] =='Close') {







            







          ?>







          <div class="card col-md-12 mt-3">







            <div id="showImages">







              <div id="415303b0a1d4963ff362af6e1a05892d71c5d4771554474954request_1">







                <div>







                  <div class="card-body ">







                    <h6 class="mb-3" style="font-weight: 500;">REF<?php echo $getworkorder['work_order_ref_id'];?><span class="pull-right"><?php echo $getworkorder['status'];?></span> </h6>







                   







                    <p class="text-small text-secondary my-3"><a class="simple-ajax-popup-align-top" href="/team/getTeamById/95" style="color:#009688;">







                      <?php echo $getworkorder['title'];?>                        </a>







                    </p>







                    <div class="managed-by participant">







                      <div class="info">







                        <div class="name content_colo">







                          <?php echo $getworkorder['contact_name'];?>







                          <?php echo $getworkorder['company_name'];?>  







                        </div>







                        <a href="tel:(958) 431-6586" class="phone-number" style="color:#009688;margin-top: 10px; line-height: 2.0;    font-size: 15px;">







                        <?php echo $getworkorder['mobile'];?>   







                        </a>







                        </div>







                        <p>Not Scheduled</p>







                      </div>







                    </div>







                    <div>







                      <center>







                        <a href="<?php echo base_url('owner/workOrderDetails/').$getworkorder['id'];?>" class="btn view_work_order" style="margin-bottom: 20px;" file-name="">VIEW WORK ORDER







                        </a>







                       







                      </center>







                    </div>







                  </div>







                </div>







              </div>







            </div>







          <?php } } ?>







          </div> 







  







          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg">







            <div>







              <h1>Participants</h1>







                <h4>







              Managed By







                















              </h4>







              <h5 class="title">







                  <p class="card-body"><?php echo $userdataworkorder['user_id']?><br>







                    <?php echo $userdataworkorder['mobile']?>







                </p>







              </h5>














              <h5 class="title">







                  <p class="card-body"><?php echo $userdataworkorder['user_id']?><br>







                    <?php echo $userdataworkorder['mobile']?>







                </p>







              </h5>







            </div>







          </div>







         </div>







         <div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







            <div class="modal-dialog" role="document">







              <div class="modal-content">







                <div class="modal-header">







                  <h5 class="modal-title" id="exampleModalLabel">Managed By</h5>







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







                            <form action="<?php echo base_url('owner/maintenanceRequestManagedBy/').$requestbasicinfo['id'];?>" method="POST">







                               <input type="hidden" name="id" value="<?php echo $requestbasicinfo['id']; ?>">







                              <div class="row bottom">







                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >







                                   <div class="form-group bmd-form-group is-filled">







                                      <label for="address" class="bmd-label-floating">Managed By *</label>







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







          <div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







            <div class="modal-dialog" role="document">







              <div class="modal-content">







                <div class="modal-header">







                  <h5 class="modal-title" id="exampleModalLabel">Edit Maintenance Request</h5>







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







                            <form action="<?php echo base_url('owner/edit_request/').$requestbasicinfo['id'];?>" method="POST">







                              <input type="hidden" name="id" value="<?php echo $requestbasicinfo['id']; ?>">







                              <div class="row bottom">







                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 " >







                                       <div class="form-group bmd-form-group is-filled">







                                          <label for="address" class="bmd-label-floating">Category</label>







                                          <div class="select-wrapper">







                                             <select class="form-control" id="exampleFormControlSelect1" name="service_id" required="">







                                                 <?php







                                                foreach ($services as $service)







                                                 {?>







                                             <option  value="<?php echo $service['id']?>"<?php if(in_array($service['id'],$workerservices)){ echo "selected";}?>   ><?php echo $service['name']?></option>







                                             <?php }







                                                ?>







                                              </select>







                                             <span class="caret">▼</span>







                                          </div>







                                       </div>







                                    </div>







                                 </div>







                              <div class="form-group ">







                                <label for="address " class="bmd-label-floating">What's the request? *</label>







                                <input type="address" name="request_text" class="form-control" id="address" required="" minlength="20" value="<?php echo $requestbasicinfo['request_text']; ?>" >







                              </div>







                              <div class="form-group ">







                                <label for="address " class="bmd-label-floating">Instructions  *</label>







                                <input type="address" name="description_text" class="form-control" required="" minlength="20" id="address" value="<?php echo $requestbasicinfo['description_text']; ?>">







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







         















          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >










            <div style="color: red;"><?php echo $this->session->flashdata('errmsg')?></div>




            <div class="modal" id="teamModal">







               <div class="modal-dialog">







                  <div class="modal-content">







                     <!-- Modal Header -->







                     <div class="modal-header">







                        <h4 class="modal-title">New Maintenance Work Order</h4>







                        <button type="button" class="close" data-dismiss="modal">&times;</button>







                     </div>







                     <!-- Modal body -->







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







                60 







                                     =>  'minute',







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



<style type="text/css">







  .hide {







  display: none;







}







</style>







<script type="text/javascript">







  function maintenance_views() {







 var checkBox = document.getElementById("chackbox");







 var text = document.getElementById("hide_workOrder");







 if (checkBox.checked == true){







   text.style.display = "block";







 } else {







    text.style.display = "none";







 }







 







}







</script>