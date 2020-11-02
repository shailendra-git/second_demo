<div class="contnet-area">



   <div class="container">



      <div class="row bg">



         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " >



            <h3>Show All Messages</h3>



         </div>



         <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 "  >



          



            <div><a class=" btn2 new_req_btn add_services_mobile  simple-ajax-popup-align-top btn btn-raised btn-primary" href="/tenant/addMessage">



            SEND MESSAGES



            </a><span>



           



         </span></div>



            











         



            







         </div>



         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_overflow" >



           



             <?php



                    if(!empty($tenantMessageData))







                    foreach ($tenantMessageData as $getupdaterequest) {



                  ?>



                  



                      <div class="row">



                        <div class="col-md-12 show_msg_breack">



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



<script type="text/javascript">



   function addTeamValidation() 



   {

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



