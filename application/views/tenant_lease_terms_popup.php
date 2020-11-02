



<form   action="<?php echo base_url('team/updateLeaseTermsData')?>" target="_parent" method="POST" class="popup_form_margin">

    <h1 style="margin-top: 30px;">Update Lease Terms</h1>



    <hr>

    <br>

      <input type="hidden" name="id" value="<?php echo $leasedata['id'] ?>">

                              <div class="form-group">

                                 <div class="row bottom">

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >

                                       <div class="">

                                          <label for="maintenance " class="bmd-label-floating">Start Date * </label>

                                          <div class="input-group">

                                            <input  type="text" id="datepicker" class="form-control" name="start_date" required="" autocomplete="off" value="<?php echo $leasedata['start_date'] ?>">

                                          </div>

                                       </div>

                                    </div>

                                

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >

                                       <div class="">

                                          <label for="maintenance " class="bmd-label-floating">End Date * </label>

                                          <div class="input-group">

                                            <input  type="text" id="datapicker" class="form-control" name="end_date" required="" autocomplete="off" value="<?php echo $leasedata['end_date'] ?>">

                                          </div>

                                       </div>

                                    </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >

                                          <label for="address" class="bmd-label-floating">After lease end *</label>

                                          <div class="select-wrapper">

                                             <select  name="after_lease_end" class="form-control" required="">





                                              <option value="1" <?php echo $leasedata['after_lease_end'] == 1 ? 'selected' : ''?>>Month To Month</option>

                                              <option value="2" <?php echo $leasedata['after_lease_end'] == 2 ? 'selected' : ''?>>Terminate</option>

                                            

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

                                           <input type="text" class="form-control" name="monthly_rent" required="" autocomplete="off"  value="<?php echo $leasedata['monthly_rent'] ?>">

                                        </div>

                                     </div>

                                  </div>

                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >

                                          <label for="address" class="bmd-label-floating">Due On *</label>

                                          <div class="select-wrapper">

                                             <select   name="due_on" class="form-control">

                                              

                                              <?php 

                                              $i="1";

                                              for ($i=1; $i<=31 ; $i++) { 

                                                

                                              ?>  

                                                  <option value="<?php echo $i; ?>" <?php echo $leasedata['due_on'] == $i ? 'selected' : ''?> > <?php echo $i; ?></option>

                                                <?php 

                                              }

                                              ?>

                                             

                                             </select>

                                             <span class="caret">▼</span>

                                             

                                          </div>

                                       </div>





                               

                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >

                                     <div class="padd-top">

                                        <label for="maintenance " class="bmd-label-floating">Security deposit *</label>

                                        <div class="input-group">

                                           <input type="text" class="form-control" name="security_deposit" required="" value="<?php echo $leasedata['security_deposit'] ?>" autocomplete="off">

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

                                                

                                              <?php 



                                              $i="1";

                                              for ($i=1; $i<=31 ; $i++) { 

                                              

                                              ?>  

                                            

                                  

                                                <option value="<?php echo $i; ?>" <?php echo $leasedata['late_fees_start_on'] == $i ? 'selected' : ''?> > <?php echo $i; ?></option>

                                              <?php 

                                              } 

                                              ?>

                                            

                                             </select>

                                             <span class="caret">▼</span>

                                             

                                          </div>

                                       </div>

                                       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >

                                          <label for="address" class="bmd-label-floating">Late Fee Type *</label>

                                          <div class="select-wrapper" >

                                             <select  name="late_fee_type" id="colorselector" class="form-control" required="">

                                              <option  value="one" <?php echo $leasedata['late_fee_type'] == 'one' ? 'selected' : ''?>>One Time</option>

                                              <option  value="daily" <?php echo $leasedata['late_fee_type'] == 'daily' ? 'selected' : ''?> >Daily</option>



                                             </select>

                                             <span class="caret">▼</span>

                                             

                                          </div>

                                       </div>

                               </div>

                                <div class="row bottom colors" id="one"  style="display: none;">

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >

                                     <div class="padd-top">

                                        <label for="maintenance" class="bmd-label-floating">Late Fee Amount *</label>

                                        <div class="input-group">

                                           <input type="text" class="form-control" id="late_fee_amount" name="late_fee_amount" value="<?php echo $leasedata['late_fee_amount'] ?>">

                                        </div>

                                     </div>

                                  </div>



                                </div>

                                <?php if ($leasedata['late_fee_type'] == 'daily') {



                                  # code...

                                } ?>

                                <div class="row bottom colors" id="daily" style="display: none;">

                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >

                                     <div class="padd-top">

                                        <label for="maintenance " class="bmd-label-floating">Initial Amount *</label>

                                        <div class="input-group">

                                           <input type="text" class="form-control" id="initial_amount" name="initial_amount" value="<?php echo $leasedata['initial_amount'] ?>">

                                        </div>

                                     </div>

                                     <span>Late fee charged on the first day late fee starts.</span>

                                  </div>

                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >

                                     <div class="padd-top">

                                        <label for="maintenance " class="bmd-label-floating">Daily Amount *</label>

                                        <div class="input-group">

                                           <input id="daily_amount" type="text" class="form-control" name="daily_amount" value="<?php echo $leasedata['daily_amount'] ?>">

                                        </div>

                                     </div>

                                     <span>Late fee charged every day after the first day late  fee starts.

                                      Tip. If you charge a flat daily late fee, leave Daily Late Fee the same as Initial Late Fee.</span>

                                  </div>

                                  

                                </div>

                              </div>

                               <div class="modal-footer">

                           <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save">Save</button>

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