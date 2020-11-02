<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.error{
  color:red;
}
</style>
<form onsubmit="return addagentValidation()" id="add_property_tenant" target="_parent" action="<?php echo base_url('team/savePropertyUser')?>" method="POST" class="popup_form_margin">

    <h4 class="modal-title add_service">Add User / Agent</h4>

                <div class="row" style="margin-top: 20px;">

                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >

                    <div class="form-group ">

                      <label for="address " class="bmd-label-floating"> Name *</label>

                      <input type="text" name="firstname" class="form-control" required="" autocomplete="off">

                    </div>
                  </div>

                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >

                       <div class="form-group ">

                        <label for="address " class="bmd-label-floating">Email  *</label>

                         <input type="email" name="email" class="form-control" id="email" required="" autocomplete="off">

                        <div id="myEmailValid" style="display: none; color: red;">

                          Please provide a valid email address.

                        </div>

                        <div id="myEmail" style="display: none; color: red;">

                          Email already exists.

                          </div>

                      </div>

                    </div>

                  </div>

                  <div  class="row" style="margin-top: 20px;">

                      <?php foreach($this->config->item('agent_permissions') as $permission)

                      {?>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 " >

                            <div class="form-group ">

                              <label for="address" class="bmd-label-floating"> <?php echo ucfirst($permission);?> *</label>
                              <input type="checkbox" class="chackbox font-color" value="<?php echo $permission;?>" name="permissions[]"  
                                style="height: 19px;width: 24px; float: left;">

                            </div>

                          </div>
                      <?php 

                      }

                      ?>

                   <div id="mychackDIV" style="display: none; color: red;">

                        Please fill atleast one field Chacked.

                    </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">

                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 " >

                      <label for="Notes" class="bmd-label-floating" style="padding-right: 48px;">Properties *</label>
                                    <select id="property-id" data-ember-action="" data-ember-action-1206="1206" class="bor chosen-select"    multiple="" name="property[]" style="min-width: 100%">

                                       <?php

                                          foreach ($propertydata as $property)

                                                 {?>

                                             <option  value="<?php echo $property['id']?>"><?php echo $property['address']?></option>
                                             <?php }

                                                ?>

                                    </select> 

                                    <div id="myProDIV" style="display: none; color: red;">

                                    Please fill out this field.
                                    </div>

                      </div>
                    </div>
               </div>

              <div class="row" style="margin-top: 20px;">

                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 " >
                <div class="form-group" style="margin:30px;">
                  <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save save_add_user">Save</button>
                  <button type='button' class="btn btn-default btn_cancle" >Cancel</button>
                </div>
            </div>
          </div>
     </form>
 <script>
    $("#add_property_tenant").validate({
           
           rules : {
              firstname : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
              email : {
                 required : true, 
                 email  : true, 
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
           },
           messages : {
             firstname : {
                 required : "Please Enter Firstname",
            
              },
              email : {
                 required : "Please Enter Email",  
              },

           },
            submitHandler: function(form) {
              $(form).submit();
            },
     });
      
  </script>










    











