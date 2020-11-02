<div class="contnet-area">

   <div class="container">

   

      <div class="row">



         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_overflow" >

           

            <div class="card col-md-8" style="    margin-top: 10px;">

            <div class="card-body">

               <h3 style="margin-top: 20px; margin-bottom: 20px;">Tenant Settings</h3>

                     <form action="<?php echo base_url('tenant/updateSettings')?>" method="POST">

                      <input  type="hidden" name="user_id" value="<?php echo $getTenantSettings['user_id'] ?>">

                      

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                             <label for="">FirstName *</label>

                              <input type="text" style="color: #b5aeae" class="form-control" id="firstname"  placeholder="Enter Your firstname" name="firstname" required="" value="<?php echo $getTenantSettings['firstname'] ?>">

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                             <label for="">LastName *</label>

                             <input type="text" style="color: #b5aeae" class="form-control" id="lastname"  placeholder="Enter Your LastName" name="lastname" required="" value="<?php echo $getTenantSettings['lastname'] ?>">

                          </div>

                        </div>

                      </div>

                         <div class="form-control-group ">

                             <label for="">Email </label>

                        

                           <div class="form-control"> <?php echo $getTenantSettings['email'] ?></div><br>

                        </div>

                        <div class="form-group">

                           <label for="">Phone Number</label>

                           <input style="color: #b5aeae" class="form-control" id="mobile" placeholder="Enter Your Phone Number" name="mobile" value=" <?php echo $getTenantSettings['mobile'] ?>">

                        </div>

                        <div class="form-group">

                           <label for="">Mailing Address</label>

                           <textarea style="color: #b5aeae" class="form-control" id="address" placeholder="Enter Your Address" name="address"><?php echo $getTenantSettings['address'] ?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">City</label>

                            <input type="text" style="color: #b5aeae" class="form-control" id="" placeholder="City" name="city" value=" <?php echo $getTenantSettings['city'] ?>">

                        </div>

                        <div class="form-group">

                           <label for="">State</label>

                           <input type="text" style="color: #b5aeae" class="form-control" id="" placeholder="State" name="state" value=" <?php echo $getTenantSettings['state'] ?>" >

                        </div>

                         <div class="form-group">

                           <label for="">Zip</label>

                           <input type="text" style="color: #b5aeae" class="form-control" id="" placeholder="Zip Code" name="zip" value=" <?php echo $getTenantSettings['zip'] ?>">

                        </div>

                        <div class="form-group">

                           <button type="submit" class="btn btn-primary btn-raised">Update</button>

                        

                        </div>

                       

                     </form>

                 

            </div>

         </div>

         </div>

      </div>

   </div>

</div>

<script type="text/javascript">

   function addTeamValidation() 

   {

      // alert('123456'); 

      var val=$("#select-id").chosen().val();

      if (val==null) 

      {

         $("#myDIV").show();

         return false;

      }

      var pro=$("#property-id").chosen().val();

      if (pro==null) 

      {

         $("#myProDIV").show();

         return false;

      }

         return true;

   }

</script>

