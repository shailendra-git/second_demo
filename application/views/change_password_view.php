<div class="contnet-area">           <div class="tab-pane basic_indo_margin show active" id="guide" role="tabpanel" aria-labelledby="contact-tab">         <div class="card col-md-8">            <div class="card-body">                                    <form action="<?php echo base_url('auth/changepassword')?>"  method="post" onsubmit="return addRegisterValidation()">                        <div class="form-group">                          <label >Password *</label>                  <input type="password" class="form-control"  placeholder=" password"  name="password" id="password" minlength="8" required="">                        </div>                        <div class="form-group">                            <label > Confirm Password *</label>                  <input type="password" class="form-control" minlength="8"  placeholder=" Password again *" id="confirm_password" name="confirm_password" required="">                  <div id="mychackDIV" style="display: none; color: red; font-size: 16px;">                  Your password Not matching.                </div>                        </div>                                                <div class="form-group">                           <button type="submit" value="submit" class="btn btn-primary btn-raised">Update</button>                           <button type='button' class="btn btn-default" onclick="location.href = '<?php echo base_url()?>owner/properties';">Cancel</button>                        </div>                                            </form>                             </div>         </div>                          </div>      </div>   </div></div><script type="text/javascript">                  function addRegisterValidation() {                                         var chack = ($('#password').val() == $('#confirm_password').val());                if(chack == null || chack == "")                 {                   $("#mychackDIV").show();                  return false;                 }                              alert("Your Password Has Been Changed, Please Login Again!");                return true;            }       </script>      