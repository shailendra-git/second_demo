
<div  id="editModal">
   <div class="padd-top-l">
      <div class="">
         <!-- Modal Header --> 
         <div class="">
          <h4 class="modal-title">ADD SCHEDULING CONTACT</h4>
          
          
          <form method="post"  target="_parent" onsubmit="return scheduleValidation()" action="<?php echo base_url('owner/uploadWorkOrderschedul');?>">
            <!-- Modal body -->

                <div class="padd-top-l">
                  <input type="radio" id="onsite" class="sch_type selectschvalue"  name="sch_type" value="On-Site" checked="" 
                  > On-Site
                  <input type="radio" id="custom"  class="sch_type"  name="sch_type" value="Custom"
                > Custom
                    <input type="hidden"
                     name="workorder_id" value="<?php echo $workorderinfo['id']; ?>">
                        <div id="ondiv">
                          <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                               <div class="form-group bmd-form-group is-filled ">
                                  <label for="address" class="bmd-label-floating">Property Member Tenant *</label>
                                  <div class="select-wrapper">
                                     <select class=" selectvalue form-control onsite-input" name="owner_id">
                                      
                                        <?php 
                                  foreach ($userdata as $userdatas)
                                         {?>
                                    <option value="">Select Value</option>
                                    <option  value="<?php echo $userdatas['id']?>"><?php echo $userdatas['user_id']?></option>
                                     <?php }
                                        ?>
                                    
                                      </select>
                                     <span class="caret">▼</span>
                                  </div>
                                  <div id="myInvoiceDIV" style="display: none; color: red;">
                            plese select Schedule.
                          </div> 
                                  
                               </div>
                            </div>
                          </div>
                        </div>
                        <br><br>
                        <div id="customdiv" style="display: none;">  
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="form-group maintenance-input  ">
                                  <label for="maintenance " class="bmd-label-floating">First Name * </label>
                                  <div class="input-group">
                                    <input type="text" class="form-control custom-input selectvalue" id="yes" name="cus_fname" autocomplete="off"  >
                                     
                                  </div>
                               </div>
                               
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="form-group maintenance-input  ">
                                  <label for="maintenance " class="bmd-label-floating">Last Name * </label>
                                  <div class="input-group">
                                    <input type="text" class="form-control custom-input" name="cus_lname"  id="acc" autocomplete="off" >
                                     
                                  </div>
                               </div>
                               
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="form-group maintenance-input ">
                                  <label for="maintenance " class="bmd-label-floating">Phone Number * </label>
                                  <div class="input-group padd">
                                    <input type="text" class="form-control padd custom-input" name="cus_phone"  autocomplete="off" minlength="10" maxlength="10" >
                                     
                                  </div>
                               </div>
                               
                            </div>
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" id="submit" class="btn2">Submit</button>
                          <button type="button" class="btn btn-raised " onClick="parent.closePopup();">Cancel</button>
                          
                        </div>
                  </div>
                </div>
            </form>
          </div>
        <!-- Modal footer -->
      </div>
   </div>
</div>

<style>
#myDIV {

  text-align: left;
  
  margin-top: 10px;
}
form#mainform input[type="email"] {
    border: 1px solid #E5E5E5;
    margin-bottom: 3px;
    padding: 5px;
}
form#mainform input[name="submit"] {
    border: 1px solid #BBBBBB;
    border-radius: 12px 12px 12px 12px;
    color: #464646;
    cursor: pointer;
    font-size: 13px;
    margin-top: 10px;
    padding: 3px 8px;
}
form#mainform input[name="submit"]:hover {
    border: 1px solid #666666;
}
span.validation {
    font-style:italic;
    color:#B41F2B;
}
span.loading {
    font-style: italic;
    left: 5px;
    position: relative;
}
</style>


 



  



 

