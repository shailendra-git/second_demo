<style type="text/css">
input{
   background-image: none !important;
}
</style>
<div>
         <h3 class="text-center login">YOUR PROFILE</h3>
 <form method="post" action="#" class="form_center2">
       <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >  First Name *</label>
                  <input type="text" class="form-control input_border" name="firstname" placeholder="Firstname" readonly value="<?php  echo $userprofile['firstname']; ?>">
               </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >  Last Name *</label>
                  <input type="text" class="form-control input_border" name="lastname" placeholder="Lastname" readonly value="<?php  echo $userprofile['lastname']; ?>">
               </div>
            </div>
            <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
                  <label > Company Name *</label>
                  <input type="text" class="form-control input_border" name="company_name" placeholder="Company Name" readonly value="<?php  echo $userprofile['company_name']; ?>">
               </div>
            </div>
            <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >Email *</label>
                  <input type="email" name="email" class="form-control input_border" id="addEmail" readonly value="<?php  echo $userprofile['email']; ?>"  placeholder="example@gmail.com" autocomplete="off">
                 <!--   <div id="myEmailValid" style="display: none; color: red; font-size: 16px;">
                  Please provide a valid email address.
                </div>
                <div id="myEmail" style="display: none; color: red; font-size: 16px;">
                                    Email already exists.
                                    </div> -->

               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >  Phone Number *</label>
                  <input type="text" class="form-control input_border" placeholder="Phone Number" name="mobile" minlength="10" readonly value="<?php  echo $userprofile['mobile']; ?>">
               </div>
            </div>
            <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <center>
               <a href="<?php echo base_url('auth/changepassword')?>"> 
                  <!-- <div class="secondary-content email">Change Password</div> -->
                  <button type="button" class="btn_login ">Change Password</button>
               </a>
            </center>
               </div>
            <!--    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label > Confirm Password *</label>
                  <input type="password" class="form-control input_border"  placeholder=" Confirm Password " minlength="8" id="confirm_password" name="confirm_password" required="">
                  <div id="mychackDIV" style="display: none; color: red; font-size: 16px;">
                  Your password Not matching.
                </div>
               </div> -->
            </div>
            <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
                  <label >How did you hear about us?</label>
                  <textarea class="form-control input_border" placeholder="Send Your Message"  readonly name="user_referral_comments"><?php echo $userprofile['user_referral_comments']; ?></textarea>
               </div>
            </div>
           <!--  <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
                  <p class="font_p ">
                     By clicking "Register" below, I accept the <a href="#" target="_blank">Terms of Service</a>. Your <a href="#" target="_blank">privacy</a> is protected.
                  </p>
               </div>
            </div> -->
         </form>
      </div>
