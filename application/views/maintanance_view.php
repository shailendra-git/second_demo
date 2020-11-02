<div class="contnet-area">

   <div class="container container_m_padding">

      <div class="row row_bottom">

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

            <div class="filter pull-left">

               <div class="switch ">

                  <label class="cls_opn">

                  <span class="closed_right">Closed</span>

                 <input type="checkbox" onchange="maintainceRequest();" id="statusChacked" <?php if($status==1 ){?> checked <?php }?> ></legend>

                  <span class="lever"></span>

                  <span class="open_left">Open</span>

                  </label>

               </div>

            </div>

            <div >

               <!-- ADD SERVICE PRO button -->

               <a style="color: #fff;" href="#" class="btn2 new_req_btn pull-right " data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">

               New Request

               </a>

               <!-- ADD SERVICE PRO button -->

               <!-- The Modal -->

               <div class="modal" id="myModal">

                  <div class="modal-dialog modal_width">

                     <div class="modal-content">

                        <!-- Modal Header -->

                        <div class="modal-header">

                           <h4 class="modal-title">New Maintenance Request</h4>

                           <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>

                        <!-- Modal body -->

                        <div class="modal-body">

                           <form  action="<?php echo base_url('owner/addRequest')?>" method="POST" >



                              <div class="form-group">

                                 <div class="row bottom">

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12  " >

                                       <div class="form-group bmd-form-group is-filled">

                                          <label for="address" class="bmd-label-floating">Property *</label>

                                          <div class="select-wrapper">


                                             <select  id="propertydata" name="property_id" class="form-control" onchange="showDiv('hidden_div', this)" required="">

                                                <option value="">Select a property</option>

                                                <?php
                                    
                                                foreach ($propertydata as $key => $property)
                

                                                 {?>

                                             <option  value="<?php echo $property['id']; ?>"><?php echo substr( $property['address'],0,40)?></option>

                                             <?php }

                                                ?>

                                             </select>

                                             <span class="caret">▼</span>

                                             

                                          </div>

                                       </div>

                                       

                                    </div>

                                    <div id="mychackDIV" style="display: none; color: red;">

                                        Please Select atleast one field!

                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 " id="hidden_div" style="display: none;" >

                                       <div class="form-group bmd-form-group is-filled"  >

                                          <label for="address" class="bmd-label-floating">Unit *</label>

                                          <div class="select-wrapper">

                                             <select  id="mySelect" name="unit_id" class="form-control" required="" >

                                       <!-- <option>Select Category </option> -->

                                              <?php

                                              foreach ($combineUnit as $combine)

                                                 {?>

                                             <option  value="<?php echo $combine['id']?>"><?php echo $combine['unit']?></option>

                                             <?php }

                                                ?>

                                            </select> 

                                            <span class="caret">▼</span>



                                          </div>

                                       </div>

                                    </div>

                                 </div>

                                

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

                           <button type="submit" class="btn_3 btn_team_edit_save">CREATE</button>

                           <button style="line-height: 24px;" type="button" class="btn " data-dismiss="modal">Cancel</button>

                        </div>

                           </form>

                        </div>

                        <!-- Modal footer -->

                       

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

            foreach ($requestdata as $request) {

      
            ?>

           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >

              <div class="white_clrbackground" style="    height: 344px; margin-top: 20px; ">

                 <div class="plumbing_div_padding">

                    <h5 class="text-left plumbing_margin_h5"><?php echo $request['name'];?></h5>

                 </div>

                 <div class="body">

                    <div class="min-height-extra-short">

                       <a href="<?php echo base_url('owner/edit_request/').$request['id'];?>" 

                        class="title repair_clr"><?php echo $request['request_text']; ?> </a>

                    </div>

                 </div>

                 <div class="section">

                    <div style="margin-bottom: 1em;" class="property">

                       <i class="material-icons font_home">home</i><span class="font_home"><?php echo $request['address']; ?>, Unit <?php echo $request['unit']; ?></span> 

                    </div>

                    <div class="reference-number font_property">REF-<?php echo $request['ref_id']; ?></div>

                 

                    <div class="created font_property" style="text-transform: capitalize;">

                        <?php echo $request['firstname'];?> <?php echo $request['lastname'];?> ,<?php echo $request['formatted_date']; ?> 

                    </div>

                    <div class="created font_property">

                        Managed by maintenance coordinator

                    </div>

                    

                 </div>

              </div>

           </div>

           <?php

         }

           ?>

        </div>

      </div>

      

   </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

   function showDiv(element)

   {

      document.getElementById('hidden_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';



      document.getElementById('hide_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';

   }

</script>

<!-- <script>

   function showdiv(divId, element)

   {

      document.getElementById(divId).style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';

   }

</script> -->

<script type="text/javascript">

  $(document).ready(function(){  

    $("#propertydata").change(function()  

      {  

       ($("#propertydata").val());     

        let property_id = $("#propertydata").val();
        $.ajax({

           type: "POST",

           url: "/owner/getPropertyUnits", 

           data: {property_id: $("#propertydata").val()},

           cache:false,

           success: function(result){

                  $('#mySelect').find('option').remove();

                 var selectValues =  jQuery.parseJSON(result);

                 // alert(selectValues);

                 $.each(selectValues, function(key, value) {  

                 // alert(key + "==>"+ value); 

                 $('#mySelect')

                     .append($("<option></option>")

                                .attr("value",key)

                                .text(value)); 

                  });

                  if (!$.trim(property_id))

                   {

                      $("#unitdata").show();

                      return false;

                   }

                    $("#unitdata").hide();

                    return true;

                  }

      });// you have missed this bracket

    });



  });

</script>

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




<script>







function maintainceRequest()

{

  if($('#statusChacked').is(':checked'))

  {  

    document.location.href="<?php echo base_url('owner/requests/open')?>/<?php echo $property_id;?>";

  }

  else 

  {



    document.location.href="<?php echo base_url('owner/requests/close')?>/<?php echo $property_id;?>";

  }

}







</script>




