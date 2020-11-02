

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     
  <form   action="<?php echo base_url('team/saveTenantBlankData')?>/<?php echo $tenantData['id']?>" target="_parent" method="POST" class="popup_form_margin">
   
    <h1 style="margin: 30px;">Invite New Tenant</h1>
                              <div class="form-group">
                                <div id="cotenant_1" style="display: none;">
                                 <div class="row bottom">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
                                       <div class="form-group maintenance-input ">
                                          <label for="maintenance " class="bmd-label-floating">
                                          Co-applicant Name *</label>
                                          <div class="input-group"> 
                                             <input class="form-control" id="co_applicant_name1" name="co_applicant_name1" required="">
                                          </div>
                                       </div>
                                     </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
                                       <div class="form-group maintenance-input ">
                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>
                                          <div class="input-group">
                                             
                                             <input class="form-control" name="co_applicant_mobile1"  id="co_applicant_mobile1" >
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                  <div class="row bottom">
                                     <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 " >
                                       <div class="form-group ">
                                        <label for="address " class="bmd-label-floating">Co-applicant Email  *</label>
                                         <input type="email" name="co_applicant_email1" class="form-control"  
                                                             autocomplete="off">
                                       
                                      </div>
                                    </div>
                                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 " >
                                        <a id="delete_btn_b" style="float: right;"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a>
                                     </div>
                                   </div>
                               </div>
                               <br>
                               <hr>
                               <br>
                                <div id="cotenant_2" style="display: none;">
                                 <div class="row bottom">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
                                     
                                       <div class="form-group maintenance-input ">
                                          <label for="maintenance " class="bmd-label-floating">
                                          Co-applicant Name *</label>
                                          <div class="input-group">
                                             
                                             <input class="form-control" name="co_applicant_name2" id="co_applicant_name2">
                                          </div>
                                       </div>
                                     </div>

                                   
                                   
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
                                       <div class="form-group maintenance-input ">
                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>
                                          <div class="input-group">
                                             
                                             <input class="form-control" name="co_applicant_mobile2" id="co_applicant_mobile2" >
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                  <div class="row bottom">
                                     <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 " >
                                       <div class="form-group ">
                                        <label for="address " class="bmd-label-floating">Co-applicant Email  *</label>
                                         <input type="email" name="co_applicant_email2" class="form-control" 
                                                             autocomplete="off">
                                       
                                      </div>
                                    </div>
                                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 " >
                                        <a id="delete_btn" style="float: right;"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a>
                                     </div>
                                   </div>
                               </div>
                                  <div class="row bottom">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " >
                                     <div>
                                        <p><a id="cotenant_add_btn" style="color: #009688; border: 1 solid #009688;" class="assign_style hide">ADD A CO-TENANT</a></p>
                                      </div>
                                    </div>
                                  </div>
                                   <div class="row bottom">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 " >
                                     <div>
                                       <input type="hidden" name="hidden_co_tenant" id="hidden_co_tenant" value="0">
                                      </div>
                                    </div>
                                  </div>
                              </div>
                               <div class="modal-footer">
                           <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save" >Save</button>
                <button type='button' class="btn btn-default btn_cancle" >Cancel</button>
                        </div>
                           </form>
