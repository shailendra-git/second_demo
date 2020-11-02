<div class="contnet-area">



 <form  action="<?php echo base_url('payment/paymentSuccess')?>" method="POST" >

    

    

    <br>

          <div class="form-group">

             

            <div class="row bottom ">

                   <div class="  col-lg-3 col-md-3 col-sm-12 col-xs-12 " >

                    <a class="btn btn-raised btn-primary" href="<?php echo base_url('payment/makePayment');?>">Back</a>

                   </div>

                  <div class="  col-lg-6 col-md-6 col-sm-12 col-xs-12 " >

                    

                    <h3 class="text-center" style="margin-top: 30px;">Pay To Process</h3>

                    <hr>

                    <br>

                    <div> Selected Property:

                      <input type="hidden" name="num_of_properties" value="<?php echo $num_of_properties = $this->input->post('num_of_properties');?>">

                    <b>

                      <?php if ($num_of_properties<10) {?>

                       0<?php echo $num_of_properties = $this->input->post('num_of_properties');

                      }else{



                       echo $num_of_properties = $this->input->post('num_of_properties'); }?></b>

                    </div>

                    <hr> 

                    <div> Per Property Fee : 

                    <input type="hidden" name="pay_per_property" value="<?php echo $pay_per_property = $this->input->post('pay_per_property');?>"> 

                    <b>$<?php echo $pay_per_property = $this->input->post('pay_per_property');?></b>

                    </div>

                    <hr>

                    

                    <div>Discount Applied : <input type="hidden" name="discount" value="<?php echo  $discount = $this->input->post('discount'); ?>">

                     <b>$<?php echo  $discount = $this->input->post('discount'); ?></b>

                    </div>

                    <hr>

                    <div>Final Amount :

                       <input type="hidden" name="pay_amount" value="<?php echo $total = $pay_per_property *  $num_of_properties- $discount; ?>"><b>

                      $<?php echo $total = $pay_per_property *  $num_of_properties- $discount; ?>  </b>

                    </div>

                    <hr>

                    

                    

                  

                      

                    

                      <div class="modal-footer">

                     <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo($this->config->item('public_payment_key'));?>" 

                    data-name="Onelane Property"

                    data-description="$<?php echo $total = $pay_per_property *  $num_of_properties- $discount; ?>"

                    data-amount="<?php echo $total = (($pay_per_property *  $num_of_properties) - $discount)*100; ?> "

                    data-email="">

                    </script>

                   



                      </div>

       </form>

                   </div>

           </div>

          </div>

           



    

    

 

</div>



