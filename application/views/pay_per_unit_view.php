<style type="text/css">
  label {
    line-height: 4 !important;
}
.stripe-button{display: block !important;
    min-height: 30px !important;
    position: absolute !important;
    bottom: 13% !important;
    left: 46% !important;}
</style>
<div class="contnet-area"> 
  <form  id="stripepayment" action="<?php echo base_url('payment/paynow_per_unit')?>" method="POST" >                 
    <div class="form-group"> 
      <div class="row bottom "> 

       <!--  <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 " >               

        </div>  -->       
        <br>          

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">                          
          <div class="row">           
           <!--  <label for="purchaseunit">Total Billing $<span><?php //echo $totalamount;?></span></label> -->
            <input type="hidden" name="purchaseunit" id="purchaseunit" class="form-control" value="<?php echo $purchaseunit?>">
          
            <input type="hidden" name="totalamount" id="totalamount" class="form-control" value="<?php echo $totalamount?>">
            <input type="hidden" name="perunitcost" id="perunitcost" class="form-control" value="<?php echo $perunitcost?>">
            <input type="hidden" name="baseprice" id="baseprice" class="form-control" value="<?php echo $baseprice?>">
            
          </div>   
                                                                            
        </div>                     

        <div class="modal-footer">                           
   <script src="https://checkout.stripe.com/checkout.js" class="stripe-button ffd" data-key="<?php echo($this->config->item('public_payment_key'));?>" 

                    data-name="Onelane Property"

                    data-description="$<?php echo $totalamount; ?>"

                    data-amount="<?php echo $totalamount*100 ?> "

                    data-email="">
                  </script>
                                                        

        </div>       

        </form>                   

    </div>           

    </div>          

</div>                    

</div>
<script type="text/javascript">
  $(function(){
    $(".stripe-button-el").trigger('click');
  })
</script>