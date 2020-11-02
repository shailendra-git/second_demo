<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.error{
  color:red;
}
</style>
  <form style="height: 600px;" class="popup_form_margin" id="property_validation" target="_parent" action="<?php echo base_url('owner/property_basicinfo')?>" method="POST">
    <h4 class="modal-title add_service">Add Property</h4>
              <input type="hidden" name="lat" id="lat" value="">
              <input type="hidden" name="lng" id="lng" value="">
              <div class="form-group ">
                <label for="address " class="bmd-label-floating">Address  *</label>
                <input type="address" name="address" class="form-control" id="pac-input" placeholder="Search Your Address">
              </div>
            
                
              <div id="map"></div>
            
              <div class="form-group  is-filled">
                <label for="address" class="bmd-label-floating">Time Zone *</label>
                <div class="select-wrapper">
                  <select class="form-control" id="exampleFormControlSelect1" name="timezone" required="">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                  <span class="caret">▼</span>
                </div>
              </div>

              

              <div class="form-group maintenance-input">
                     <label for="maintenance " class="bmd-label-floating">Maintenance Threshold *</label>
                     <div class="input-group">
                        <span class="input-group-text" >$</span>
                        <input type="text" class="form-control" id="maintenance"  name="maintenance_threshold">
                     </div>
                  </div>
              <div class="form-group">
                <small class="text-muted  mt-3">Maintenance coordinator will use this to automatically approve work order pricing estimates. If this amount is set to $0 pricing should be approved by the property owner for every request.
                </small>
              </div>
              <div class="form-group ">
                <label for="Notes" class="bmd-label-floating">Additional Notes</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="notes" name="notes">
                </div>
              </div>
              <div class="form-group ">
                <label for="Notes" class="bmd-label-floating">PropertyManager Name </label>
                <div class="input-group">
                  <input type="text" class="form-control" id="propertymanager_name" name="propertymanager_name">
                </div>
              </div>
              <div class="form-group ">
                <label for="Notes" class="bmd-label-floating">PropertyManager Email </label>
                <div class="input-group">
                  <input type="text" class="form-control" id="propertymanager_email" name="propertymanager_email" >
                </div>
              </div>
              <div class="form-group ">
                <label for="Notes" class="bmd-label-floating">PropertyManager Phone </label>
                <div class="input-group">
                  <input type="text" class="form-control" id="propertymanager_phone" name="propertymanager_phone" >
                </div>
              </div>
              <div class="form-group">
                <small class="text-muted mt-3">Use this to write down information such as key codes, insurance policy numbers, and etc. This is only visible to you and your property members.
                </small>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-raised">Save</button>
                <button type='button' class="btn btn-default btn_cancle">Cancel</button>
              </div>
            </form>
           
  <script>
    $("#property_validation").validate({
           
           rules : {
              address : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
              maintenance_threshold : {
                 required : true,  
              },
           },
           messages : {
             address : {
                 required : "Please Enter Address",
            
              },
               maintenance_threshold : {
                 required : "Please Enter Maintenance Threshold",  
              },

           },
            submitHandler: function(form) {
              $(form).submit();
            },
     });
      
  </script>


