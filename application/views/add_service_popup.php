<script src="<?php
echo base_url('assets/js/jquery.min.js');
?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.error{
  color:red;
}
</style>

<form onsubmit="return addTeamValidation()"  id="service_validation" target="_parent" action="<?php
echo base_url('team/saveTeam');
?>" method="POST"  style="height: 600px;"  class="popup_form_margin">



    <h4 class="modal-title add_service">Add Service Professional</h4>



              <input type="hidden" name="lat" id="lat" value="">



              <input type="hidden" name="lng" id="lng" value="">



               <div class="form-group " style="margin-top: 7px;">



                <label for="address " class="bmd-label-floating">Contact Name *</label>



                 <input type="text" name="contactname" class="form-control" autocomplete="off">



              </div>



               <div class="form-group ">



                <label for="address " class="bmd-label-floating">Company Name</label>



                <input type="text" name="companyname" class="form-control" autocomplete="off">



              </div>



              <div class="form-group ">



                <label for="address " class="bmd-label-floating">Address  *</label>



                <input type="address" name="address" class="form-control" id="pac-input" placeholder="Search Your Address">



              </div>

                <div id="map"></div>



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


              <div class="form-group ">



                <label for="Notes" class="bmd-label-floating">Phone Number</label>



                <div class="input-group">



                   <input type="text" name="mobile" class="form-control" required="" maxlength="12" minlength="10" autocomplete="off">



                </div>



              </div>



              



               <div class="form-group">
                <label for="Notes" class="bmd-label-floating">Service Categories *</label>
                                      <select id="select-id" data-ember-action="" data-ember-action-1206="1206" class="bor chosen-select" style="min-width:100%;"  name="category[]" multiple="">
                                      <?php
                                      foreach ($services as $service) {
                                      ?>
                                      <option  value="<?php echo $service['id'];?>"><?php
                                      echo $service['name'];
                                      ?></option>
                                               <?php
                                      }
                                      ?>
                                    </select> 
                                   <div id="myDIV" style="display: none; color: red;">
                                    Please fill out this field.
                                    </div>
                                 </div>
                        <label for="Notes" class="bmd-label-floating" style="padding-right: 48px;">Properties *</label>
                        <select id="property-id" data-ember-action="" data-ember-action-1206="1206" class="bor chosen-select"    multiple="" name="property[]" style="width: 100%">

                        <?php
                foreach ($propertydata as $property)
                {
                ?>
                <option  value="<?php echo $property['id'];?>"><?php
                  echo $property['address'];?></option>
                  <?php
                }
                ?>
              </select> 
              <div id="myProDIV" style="display: none; color: red;">
              Please fill out this field.
              </div>
              </div>
              <div class="form-group" style="margin-top: 30px;">
                <label for="Notes" class="bmd-label-floating">Notes</label>
                <div class="input-group">
                   <input type="text" name="notes" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save">Save</button>
                <button type='button' class="btn btn-default btn_cancle" >Cancel</button>
              </div>
            </form>

<script>
    $("#service_validation").validate({
           
           rules : {
              contactname : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              }, 
              address : {
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
             contactname : {
                 required : "Please Enter Contact Name",
            
              },
              address : {
                 required : "Please Enter Address",
            
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
   <script>

$(document).ready(function(){ resizeChosen(); jQuery(window).on('resize', resizeChosen); }); function resizeChosen() { $(".chosen-container").each(function() { $(this).attr('style', 'width: 100%'); }); }

</script>