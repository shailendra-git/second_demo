<div class="container">

  <div class="row">

     <div class="col s12">

                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">TENANT MESSAGES</h5>

                </div>

                 <div class="row">

                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">

                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">

                            <form  method="post" target="_parent" action="<?php echo base_url('team/saveTenantMessageData')?>/<?php echo $tenantData['id']?>">

                              <div class="form-group bmd-form-group">

                              <input type="text" name="message" class="form-control"  placeholder="Enter Your Message Here..." required="">

                              </div>

                              <div class="form-group">

                              <button type="submit" class="btn btn-primary btn-raised edit-icon">Add Message</button>

                              </div>

                            </form>

                         

                      </div>

                    </div>

                 </div>

                 <div>

                  <?php

                    if(!empty($tenantMessageData))
                    
                    //print_r($tenantMessageData);
                      // foreach ($parentData as $key => $value) {
                      //   if($value['parent_user_id'] == 0){
                      //     echo "tenat";
                      //   }else{
                      //     echo "owner";
                      //   }
                      // }

                    foreach ($tenantMessageData as $getupdaterequest) {

                  ?>



          <div class="row">

            <div class="col-md-12">

              <?php echo $getupdaterequest['message']; ?>

              <br>
           
              Send by <B><?php echo $getupdaterequest['message_by_tenant'] == 0 ? ucfirst($getupdaterequest['owner']) : ucfirst($getupdaterequest['tenant']); ?></B> in a<b><?php echo $getupdaterequest['formatted_date']; ?></b>

            </div>                        

          </div>

                      <hr>

                  <?php } ?>

                </div>

            

                

                 

          </div>

    

  </div>

</div>