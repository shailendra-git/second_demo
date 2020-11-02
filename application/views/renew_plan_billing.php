<style type="text/css">
  label {
    line-height: 4 !important;
}
.input_label{    font-size: 18px !important; padding: 1px 26px;text-transform: uppercase;color: #27364f;
    text-align: center; width: 100%;}

</style>
<div class="contnet-area"> 
  <form  id="stripepayment" action="<?php echo base_url('payment/proceed_pay')?>" method="POST" >                 
    <div class="form-group"> 
      <div class="row bottom "> 

        <!-- <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 " >               

        </div>  -->       
        <br>          

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">                          
          <div class="row">           
            <label for="purchaseunit" class="input_label">Total Billing <strong>$<span><?php echo $totalamount;?></strong></span></label>

            <input type="hidden" name="purchaseunit" id="purchaseunit" class="form-control" value="<?php echo $purchaseunit?>">
          
            <input type="hidden" name="totalamount" id="totalamount" class="form-control" value="<?php echo $totalamount?>">
            <input type="hidden" name="perunitcost" id="perunitcost" class="form-control" value="<?php echo $unit_price?>">
            <input type="hidden" name="baseprice" id="baseprice" class="form-control" value="<?php echo $base_price?>">
            
          </div>   
                                                                            
        </div>                     

      <div class="modal-footer">
       <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo($this->config->item('public_payment_key'));?>" 
                     data-name="Onelane Property"
                     data-description="<?php echo $totalamount?>"
                     data-amount="<?php echo $totalamount*100;?>"
                     data-email=""></script>
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