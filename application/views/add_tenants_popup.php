<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



     



  <form   action="<?php echo base_url('team/saveTenantData')?>" target="_parent" method="POST" class="popup_form_margin">



    <h1 style="margin-top: 30px;">Invite New Tenant</h1>



                              <div class="form-group">



                                 <div class="row bottom">



                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12  " >



                                       <div class="form-group bmd-form-group is-filled">



                                          <label for="address" class="bmd-label-floating">Property *</label>



                                          <div class="select-wrapper">



                                             <select  id="propertydata" name="property_id" class="form-control" onchange="showDiv('hidden_div', this)" required="">



                                                <option value="">Select a property</option>



                                                <?php



                                          foreach ($propertydatatenat as $property)



                                                 {?>


                                             <option  value="<?php echo $property['id']?>"><?php echo $property['address']?></option>



                                             <?php }



                                                ?>



                                             </select>



                                             <span class="caret">▼</span>



                                             



                                          </div>



                                       </div>



                                       



                                    </div>



                                    <div id="mychackDIV" style="display: none; color: red;">



                                        Please Select atleast one field!



                                    </div>



                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 " id="hidden_div" style="display: none;" >



                                       <div class="form-group bmd-form-group is-filled"  >



                                          <label for="address" class="bmd-label-floating">Unit *</label>



                                          <div class="select-wrapper">



                                             <select  id="mySelect" name="unit_id" class="form-control" required="" >



                                     

                                              <?php



                                              foreach ($combineUnit as $combine)



                                                 {?>



                                             <option  value="<?php echo $combine['id']?>"><?php echo $combine['unit']?></option>



                                             <?php }



                                                ?>



                                            </select> 



                                            <span class="caret">▼</span>







                                          </div>



                                       </div>



                                    </div>



                                 </div>







                                 <h3 style="margin-bottom: 20px;">Applicant Info</h3>



                                 <div class="row bottom">



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Name *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="firstname" required=""></textarea>



                                          </div>



                                       </div>



                                     </div>







                                   



                                   



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Phone Number *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="mobile" required="" ></textarea>



                                          </div>



                                       </div>



                                    </div>



                                  </div>



                                 <div class="row bottom">



                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >



                                       <div class="form-group ">



                                        <label for="address " class="bmd-label-floating">Email  *</label>



                                         <input type="email" name="email" class="form-control" id="email" required="" 



                                                             autocomplete="off">



                                        <div id="myEmailValid" style="display: none; color: red;">



                                          Please provide a valid email address.



                                        </div>



                                        <div id="myEmail" style="display: none; color: red;">



                                          Email already exists.



                                          </div>



                                      </div>



                                    </div>







                                 </div>







                                <div id="cotenant_1" style="display: none;">



                                 <div class="row bottom">



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">



                                          Co-applicant Name *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="co_applicant_name1"></textarea>



                                          </div>



                                       </div>



                                     </div>







                                   



                                   



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="co_applicant_mobile1"  ></textarea>



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



                                <div id="cotenant_2" style="display: none;">



                                 <div class="row bottom">



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">



                                          Co-applicant Name *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="co_applicant_name2" ></textarea>



                                          </div>



                                       </div>



                                     </div>







                                   



                                   



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>



                                          <div class="input-group">



                                             



                                             <textarea class="form-control" name="co_applicant_mobile2"  ></textarea>



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







                               







                                 



                                  



                                



                                 <h3 style="margin-bottom: 20px;">Lease Terms</h3>



                                 <div class="row bottom">



                                    



                                  



                                 



                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                       <div class="">



                                          <label for="maintenance " class="bmd-label-floating">Start Date * </label>



                                          <div class="input-group">



                                            <input  type="text" id="datepicker" class="form-control" name="start_date" required="" autocomplete="off">



                                          </div>



                                       </div>



                                    </div>



                                



                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                       <div class="">



                                          <label for="maintenance " class="bmd-label-floating">End Date * </label>



                                          <div class="input-group">



                                            <input  type="text" id="datapicker" class="form-control" name="end_date" required="" autocomplete="off">



                                          </div>



                                       </div>



                                    </div>



                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                          <label for="address" class="bmd-label-floating">After lease end *</label>



                                          <div class="select-wrapper">



                                             <select  name="after_lease_end" class="form-control" required="">



                                                <option value="Month To Month">Month To Month</option>



                                                







                                             <option  value="Terminate">Terminate</option>



                                            



                                             </select>



                                             <span class="caret">▼</span>



                                             



                                          </div>



                                       </div>



                                     </div>



                                    



                                <div class="row bottom">



                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                     <div class="padd-top">



                                        <label for="maintenance " class="bmd-label-floating">Monthly rent *</label>



                                        <div class="input-group">



                                           <input type="text" class="form-control" name="monthly_rent" required="" autocomplete="off">



                                        </div>



                                     </div>



                                  </div>



                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                          <label for="address" class="bmd-label-floating">Due On *</label>



                                          <div class="select-wrapper">



                                             <select   name="due_on" class="form-control">



                                                <option value="1st">1st</option>



                                                   <option value="2nd">2nd</option>



                                                    <option value="3rd">3rd</option>



                                                     <option value="4th">4th</option>



                                                      <option value="5th">5th</option>



                                                       <option value="6th">6th</option>



                                                       <option value="7th">7th</option>



                                                       <option value="8th">8th</option>



                                                       <option value="9th">9th</option>



                                                       <option value="10th">10th</option>



                                                       <option value="11th">11th</option>



                                                       <option value="12th">12th</option>



                                                       <option value="13th">13th</option>



                                                       <option value="14th">14th</option>



                                                       <option value="15th">15th</option>



                                                       <option value="16th">16th</option>



                                                       <option value="17th">17th</option>



                                                       <option value="18th">18th</option>



                                                       <option value="19th">19th</option>



                                                       <option value="20th">20th</option>



                                                       <option value="21st">21st</option>



                                                       <option value="22nd">22nd</option>



                                                       <option value="23rd">23rd</option>



                                                       <option value="24th">24th</option>



                                                       <option value="25th">25th</option>



                                                       <option value="26th">26th</option>



                                                       <option value="27th">27th</option>



                                                       <option value="28th">28th</option>



                                                       <option value="29th">29th</option>



                                                       <option value="30th">30th</option>



                                                       <option value="31st">31st</option>



                                            



                                             </select>



                                             <span class="caret">▼</span>



                                             



                                          </div>



                                       </div>











                               



                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >



                                     <div class="padd-top">



                                        <label for="maintenance " class="bmd-label-floating">Security deposit *</label>



                                        <div class="input-group">



                                           <input type="text" class="form-control" name="security_deposit" required="" autocomplete="off">



                                        </div>



                                     </div>



                                  </div>



                               </div>



                                 <h3 style="margin-bottom: 20px;">Assets Late Fee</h3>



                               <div class="row bottom">



                                  



                                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                          <label for="address" class="bmd-label-floating">Late Fee Start On *</label>



                                          <div class="select-wrapper">



                                             <select   name="late_fees_start_on" class="form-control">



                                                <option value="1st">1st</option>



                                                   <option value="2nd">2nd</option>



                                                    <option value="3rd">3rd</option>



                                                     <option value="4th">4th</option>



                                                      <option value="5th">5th</option>



                                                       <option value="6th">6th</option>



                                                       <option value="7th">7th</option>



                                                       <option value="8th">8th</option>



                                                       <option value="9th">9th</option>



                                                       <option value="10th">10th</option>



                                                       <option value="11th">11th</option>



                                                       <option value="12th">12th</option>



                                                       <option value="13th">13th</option>



                                                       <option value="14th">14th</option>



                                                       <option value="15th">15th</option>



                                                       <option value="16th">16th</option>



                                                       <option value="17th">17th</option>



                                                       <option value="18th">18th</option>



                                                       <option value="19th">19th</option>



                                                       <option value="20th">20th</option>



                                                       <option value="21st">21st</option>



                                                       <option value="22nd">22nd</option>



                                                       <option value="23rd">23rd</option>



                                                       <option value="24th">24th</option>



                                                       <option value="25th">25th</option>



                                                       <option value="26th">26th</option>



                                                       <option value="27th">27th</option>



                                                       <option value="28th">28th</option>



                                                       <option value="29th">29th</option>



                                                       <option value="30th">30th</option>



                                                       <option value="31st">31st</option>







                                            



                                             </select>



                                             <span class="caret">▼</span>



                                             



                                          </div>



                                       </div>



                                       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                          <label for="address" class="bmd-label-floating">Late Fee Type *</label>



                                          <div class="select-wrapper" >



                                             <select  name="late_fee_type" id="colorselector" class="form-control" required="">



                                                <option  value="One_Time">One Time</option>



                                                







                                             <option  value="Daily">Daily</option>



                                            



                                             </select>



                                             <span class="caret">▼</span>



                                             



                                          </div>



                                       </div>



                               </div>



                                <div class="row bottom colors" id="One_Time">



                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >



                                     <div class="padd-top">



                                        <label for="maintenance" class="bmd-label-floating">Late Fee Amount *</label>



                                        <div class="input-group">



                                           <input type="text" class="form-control" name="late_fee_amount">



                                        </div>



                                     </div>



                                  </div>







                                </div>



                                <div class="row bottom colors" id="Daily" style="display: none;">



                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     <div class="padd-top">



                                        <label for="maintenance " class="bmd-label-floating">Initial Amount *</label>



                                        <div class="input-group">



                                           <input type="text" class="form-control" name="initial_amount">



                                        </div>



                                     </div>



                                     <span>Late fee charged on the first day late fee starts.</span>



                                  </div>



                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     <div class="padd-top">



                                        <label for="maintenance " class="bmd-label-floating">Daily Amount *</label>



                                        <div class="input-group">



                                           <input type="text" class="form-control" name="daily_amount">



                                        </div>



                                     </div>



                                     <span>Late fee charged every day after the first day late  fee starts.



                                      Tip. If you charge a flat daily late fee, leave Daily Late Fee the same as Initial Late Fee.</span>



                                  </div>



                                  



                                </div>



                              </div>



                               <div class="modal-footer">



                           <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save" style="padding: 7px 26px;">Save</button>



                <button type='button' class="btn btn-default btn_cancle" >Cancel</button>



                        </div>



                           </form>







  



  







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script>



   function showDiv(element)
   {
      document.getElementById('hidden_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';
      document.getElementById('hide_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';

   }


</script>







