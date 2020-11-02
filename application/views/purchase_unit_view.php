<style type="text/css">
  label {
    line-height: 4 !important;
} 
 .card-body{padding: 2.25rem;}
 .label_cls{
    line-height: 4 !important;
    font-size: 17px !important;
    font-weight: bold;  
    text-align: center !important;
    width: 100%;
    text-transform: uppercase;}
    .ml_cls{
    display: block;
    margin: auto;
    }
    .amount_cls{   display: block;
    padding: 34px 0px 4px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    text-align: center;
    color: #009688; 
  }
</style>
<div class="contnet-area mt-5">                    
    <div class="form-group"> 
      <div class="row bottom ">           
        <div class="col-md-8 m-auto">  
          <div class="row">
          <div class="card card-body" style="background-color: #fff">           
      <form  action="<?php echo base_url('payment/pay_per_unit')?>" method="POST" >                        
          <label for="purchaseunit" class="label_cls">Enter Units/ Per Unit $<span><?php echo $plan_details['unit_price']?></span></label>

          <input type="text" name="purchaseunit" id="purchaseunit" class="form-control" value="1">
          <input type="hidden" name="baseprice" id="" class="form-control" value="<?php echo $plan_details['base_price']?>">
          <input type="hidden" name="perunitcost" id="perunitcost" class="form-control" value="<?php echo $plan_details['unit_price']?>">
          <input type="hidden" name="totalamount" id="totalamount" class="form-control" value="">
           
        <span id="previewamount" class="amount_cls"></span>   
        <button type="submit" class="btn btn-raised btn-primary ml_cls">Proceed To Pay</button>                      
      </form>                           
        </div>                                
        </div>                                
    </div>          
    </div>          
    </div>          
    </div>          
             

              
<script type="text/javascript">
      var purchaseunit = parseInt($('#purchaseunit').val());
  var perunitcost = parseInt($('#perunitcost').val());
  var totalamount = purchaseunit*perunitcost;
  $('#totalamount').val(totalamount);
  $('#previewamount').text('TO PAY $'+totalamount);


  $('#purchaseunit').on('keyup',function(){
    var purchaseunit = parseInt($('#purchaseunit').val());    
              var perunitcost = parseInt($('#perunitcost').val());
var totalamount = purchaseunit*perunitcost;
//alert(purchaseunit);
$('#totalamount').val(totalamount);
if(isNaN(totalamount))
{
$('#totalamount').val(perunitcost*1);
 $('#previewamount').text('TO PAY $'+perunitcost*1);
}
else 
  $('#previewamount').text('TO PAY $'+totalamount);
  })
 
</script>