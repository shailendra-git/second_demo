
<style type="text/css">
  .min-height-extra-short{
    margin: 1px 25px 17px;
  }
  .p_cls_data{margin-top: 37px;}
</style>

<div class="contnet-area">

   <div class="container container_m_padding">

      <div class="row row_bottom">

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

            

            <div >


            
              

               <div class="modal" id="myModal">

                  <div class="modal-dialog modal_width">

                     <div class="modal-content">

                      

                        <div class="modal-header">

                           <h4 class="modal-title">New Maintenance Request</h4>

                           <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>

                        <div class="modal-body">

                           <form  action="<?php echo base_url('tenant/addRequest')?>" method="POST" >



                              <div class="form-group">

                                 <div class="row bottom">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 " >

                                       <div class="form-group bmd-form-group is-filled">

                                          <label for="address" class="bmd-label-floating">Category (select "Unassigned" if unsure) *</label>

                                          <div class="select-wrapper">

                                             <select class="form-control" id="exampleFormControlSelect1" name="service_id" required="">

                                                 <?php

                                          foreach ($services as $service)

                                                 {?>

                                             <option  value="<?php echo $service['id']?>"><?php echo $service['name']?></option>

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

                                          <label for="maintenance " class="bmd-label-floating">What's the request? *</label>

                                          <div class="input-group">

                                             

                                             <textarea class="form-control" name="request_text" required="" minlength="20"></textarea>

                                          </div>

                                       </div>

                                    </div>

                                 </div>

                                 <div class="row bottom">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

                                       <div class="form-group maintenance-input ">

                                          <label for="maintenance " class="bmd-label-floating">Description *</label>

                                          <div class="input-group">

                                             <textarea class="form-control" name="description_text" required="" minlength="20"></textarea>

                                          </div>

                                       </div>

                                    </div>

                                 </div>

                                 <div class="row bottom">

                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="hide_div" style="display: none;">

                                       <div class="form-group maintenance-input bmd-form-group">

                                          <div class="input-group">

                                             <input type="checkbox" class="chackbox" name="check" checked=""> Managed by maintenance coordinator

                                             

                                          </div>

                                       </div>

                                    </div>

                                 </div>

                              </div>

                               <div class="modal-footer">

                           <button type="submit" class="btn2 btn_team_edit_save" >CREATE</button>

                           <button type="button" class="btn " data-dismiss="modal">Cancel</button>

                        </div>

                           </form>

                        </div>

                       
                       

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

     

        

      <div id="maintenance_hide">

        <div class="row row_bottom">

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >

              <h6 class="text-center h6_font">Maintenance Requests</h6>

           </div>

        </div>

        <div class="row">
        <?php 
        foreach($requestdata as $data)
          {?>
          

           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >

              <div class="white_clrbackground" style="    height: 295px; margin-top: 20px; ">

                 <div class="plumbing_div_padding">

                    <h5 class="text-left plumbing_margin_h5"><?php echo $data['name'];?></h5>

                 </div>

                 <div class="body">

                    <div class="min-height-extra-short">

                      <a href="<?php echo base_url('tenant/edit_request/').$data['id'].'/'.$data['owner_id'];?>" 

                        class="title repair_clr"><?php echo $data['request_text']; ?> </a>

                      

                      <br>

                      <p class="p_cls_data"> <?php echo $data['description_text']; ?></p>

                    </div>

                 </div>



                 <div class="section" style="    padding-top: 0rem;">

                    <div style="margin-bottom: 1em;" class="property">

                       <i class="material-icons font_home">home</i><span class="font_home"> <?php echo $data['address']; ?>, Unit  <?php  echo $data['unit']; ?></span> 

                    </div>

                    <div class="reference-number font_property">REF-<?php echo $data['ref_id']; ?></div>

                   

                    <div class="created font_property" style="text-transform: capitalize;">

                        <?php $data['formatted_date'] ?> 

                    </div>

                    <div class="created font_property">

                        Managed by maintenance coordinator

                    </div>

                    

                 </div>

              </div>

           </div>

          

        
      <?php }
        ?>
</div>
      </div>

      

   </div>

</div>







<style type="text/css">

 .chackbox {

    top: 0;

    width: 20px;

    height: 20px;

    border: 2px solid #517bbe;

    background-color: #517bbe;

    z-index: 0;

}

</style>



