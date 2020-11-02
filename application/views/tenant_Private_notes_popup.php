<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container">



  <div class="row">



     <div class="col s12">



                <div class="modal-header">



                  <h1 style="margin-top: 30px;">Private Notes</h1>



                </div>







                 



                



                 <div class="row">



                    <div class="col-md-12 col-sm-12 col-" id="myTabContent">



                      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">



                            <form  method="post" target="_parent" action="<?php echo base_url('team/saveTenantnoteData')?>/<?php echo $tenantData['id']?>">



                              <input type="hidden" name="id" id="id" value="<?php echo $tenantMessageNotesData['id'] ?>">



                              <div class="form-group bmd-form-group">



                              <textarea type="text" name="message" rows="2" cols="50" class="form-control" style="line-height: 20px;"  placeholder="Enter Your Message Here..." required="" id="message" ><?php echo $tenantMessageNotesData['message'] ?></textarea>



                              </div>



                              <div class="form-group">



                              <button type="submit" class="btn btn-primary btn-raised edit-icon">Update Message</button>



                                <?php if ($tenantMessageNotesData['id']=='') { ?>



                                 



                                <?php } else { ?>



                               <a target="_parent" href="<?php echo base_url('team/deletePrivateNotesData')?>/<?php echo $tenantMessageNotesData['id']?>" >



                                          <i class="fa fa-trash" style="font-size:24px;color:red"></i>



                                         </a>



                                    <?php } ?>







                              </div>



                            </form>



                         



                      </div>



                    </div>



                 </div>



                 <div>



                 



                </div>



            



                



                      



          </div>



    



  </div>



</div>