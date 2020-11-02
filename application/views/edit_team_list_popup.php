
  <form  id="send" onsubmit="return addTeamValidation()"  target="_parent" action="<?php echo base_url('team/editTeamData')?>" method="POST"  style="height: 600px;"  class="popup_form_margin">

    <h4 class="modal-title add_service">Edit Service Professional</h4>

    <input type="hidden" name="id" id="hidden_id" value="<?php echo $workerData['id']?>">

              <input type="hidden" name="lat" id="lat" value="<?php echo $workerData['lat']?>">

              <input type="hidden" name="lng" id="lng" value="<?php echo $workerData['lng']?>">

               <div class="form-group">

                <label for="address " class="bmd-label-floating">Contact Name</label>

                <input type="text" name="contact_name" class="form-control" id="edit_contactname" autocomplete="off"  required="" value="<?php echo $workerData['contact_name']?>" >

              </div>

               <div class="form-group">

                <label for="address " class="bmd-label-floating">Company Name</label>

                 <input type="text" name="company_name" class="form-control" id="edit_companyname" autocomplete="off" value="<?php echo $workerData['company_name']?>">

              </div>

              <div class="form-group">

                <label for="address " class="bmd-label-floating">Address  *</label>

                <input type="address" name="address" class="form-control" id="pac-input" placeholder="Search Your Address"  value="<?php  echo $workerData['address']?>">

              </div>



                <div id="map"></div>

               <div class="form-group">

                <label for="address " class="bmd-label-floating">Email  *</label>

                 <input type="email" name="email" class="form-control" id="email" required="" autocomplete="off" value="<?php  echo $workerData['email']?>">

                          <div id="myEmailValid" style="display: none; color: red;">

                        Please provide a valid email address.

                        </div>

                         <div id="myEmail" style="display: none; color: red;">

                        Email already exists.

                        </div>

              </div>



              <div class="form-group">

                <label for="Notes" class="bmd-label-floating">Phone Number</label>

                <div class="input-group">

                   <input type="text" name="mobile" class="form-control" required="" id="edit_mobile" autocomplete="off" value="<?php  echo $workerData['mobile']?>">

                </div>

              </div>

              

             <div class="form-group">

                <label for="Notes" class="bmd-label-floating">Service Categories *</label>

                                    <!--down -->



                                    <select id="select-id" data-ember-action="" data-ember-action-1206="1206" class="bor chosen-select" style="width: 100%"  name="category[]" multiple="">

                                       <!-- <option>Select Category </option> -->

                                <?php

                                foreach ($getservices as $service)

                                       {?>

                                <option   value="<?php echo $service['id']?>"

                                   <?php if(in_array($service['id'],$workerservices)){ echo "selected";}?>   

                                 ><?php echo $service['name']

                                     ?>

                                   </option>

                       

                                   <?php }

                                      ?>

                                    </select>  

                                   <div id="myDIV" style="display: none; color: red;">

                                    Please fill out this field.

                                    </div>



                                 </div>

                           

               <label for="Notes" class="bmd-label-floating" style="padding-right: 48px;">Properties *</label>

                                    <!--down -->



                                    <select id="property-id" data-ember-action="" data-ember-action-1206="1206" class="bor chosen-select"    multiple="" name="property[]" style="width: 100%">

                                    <!--    <option>Select Property </option> -->

                                       <?php

                                foreach ($propertydata as $property)

                                       {?>

                                <option   value="<?php echo $property['id']?>"

                                   <?php if(in_array($property['id'],$workerproperty)){ echo "selected";}?>   

                                 ><?php echo $property['address']

                                     ?>

                                   </option>

                       

                                   <?php }

                                      ?>

                                    </select> 

                                    <div id="myProDIV" style="display: none; color: red;">

                                    Please fill out this field.

                                    </div>



                                 </div>

                              </div>

              <div class="form-group" style="margin-top: 30px;">

                <label for="Notes" class="bmd-label-floating">Notes</label>

                <div class="input-group">

                 <input type="text" autocomplete="off" name="notes" class="form-control" id="textbox" value="<?php  echo $workerData['notes']?>">

                </div>

              </div>

              

              <div class="form-group">

                <button type="submit" class="btn444 btn_team_edit_save" >Update</button>

                <button type='button' class="btn btn-default btn_cancle" >Cancel</button>

              </div>

            </form>

<script>

$(document).ready(function(){ resizeChosen(); jQuery(window).on('resize', resizeChosen); }); function resizeChosen() { $(".chosen-container").each(function() { $(this).attr('style', 'width: 100%'); }); }

</script>
