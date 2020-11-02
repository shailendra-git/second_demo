
<div  id="editModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-body">
          <form  action="<?php echo base_url('owner/popupworkOrderform/').$requestworkorder['id'];?>" method="POST" >
            <input type="hidden" name="id" value="<?php echo $requestworkorder['id']?>">
                <h4 class="modal-title">New Maintenance Work Order <span class="pull-right"> 
                  <button type='button' class="btn btn-default" onclick="location.href = '<?php echo base_url('owner/edit_request/').$requestworkorder['id'];?>'" style="font-size: 25px; font-weight: 900">&times;</button></span></h4>
               
                      
                      <!-- Modal body -->
                <div class="modal-body">
                          What type of user do you want to assign this work order to?

                  <div>
                    <div class="form-group">
                          <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="form-group bmd-form-group is-filled">

                                 <input type="radio"  name="maintenance_type" value="Service professional"
                                checked> Service professional
                            
                               </div>
                               
                            </div>
                            
                         </div>

                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="form-group bmd-form-group is-filled">
                                  <label for="address" class="bmd-label-floating">Service Professional *</label>
                                  <div class="select-wrapper">
                                     <select name="service_user_id" class="form-control" required="">
                                        <?php 
                                  foreach ($servicesuserdata as $service_user)
                                         {?>

                                     <option  value="<?php echo $service_user['id']?>"><?php echo $service_user['contact_name']?> ( <?php echo $service_user['company_name']?> )</option>
                                     <?php }
                                        ?>
                                     </select>
                                     <span class="caret">▼</span>
                                     
                                  </div>
                               </div>
                               
                            </div>
                            
                         </div>
                        
                        
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="form-group maintenance-input ">
                                  <label for="maintenance " class="bmd-label-floating">Title *</label>
                                  <div class="input-group">
                                     
                                     <textarea class="form-control" name="title" required=""><?php echo $requestworkorder['request_text']?></textarea>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="form-group maintenance-input ">
                                  <label for="maintenance " class="bmd-label-floating">Instructions </label>
                                  <div class="input-group">
                                     <textarea class="form-control" name="maintenance_instructions" required=""><?php echo $requestworkorder['description_text']?></textarea>
                                  </div>
                               </div>
                            </div>
                         </div>
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
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn2 btn_team_edit_save" >CREATE WORK ORDER</button>
                       <button type='button' class="btn btn-default" onclick="location.href = '<?php echo base_url('owner/edit_request/').$requestworkorder['id'];?>'">Cancel</button>

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
 

