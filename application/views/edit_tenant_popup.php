
   
      <h3 class="text-center login" style="margin: 40px;" >Update Tenant User</h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         
        <form target="_parent" method="POST"  class="popup_form_margin" action="<?php echo base_url('team/updateTenannt/').$tenantdata['id'];?>">
            
            <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label > Name *</label>
                  <input type="text" class="form-control input_border" name="firstname" placeholder="Firstname" required=""  value="<?php echo $tenantdata['firstname']; ?>">
               </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >  Phone Number *</label>
                  <input type="text" class="form-control input_border" placeholder="Phone Number" name="mobile" minlength="10" required="" value="<?php echo $tenantdata['mobile']; ?>">
               </div>
                
            </div>
       
            
            <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6  " >
                  <label >Email *</label>
                  <div class="form-control input_border"><?php echo $tenantdata['email']; ?></div> 
               </div>
            </div>
            <div class="form-group" style="margin:40px;">
                 <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save">UPDATE</button>
                 <button type='button' class="btn btn-default btn_cancle" >Cancel</button>
                </div>
         </form>
      </div>

