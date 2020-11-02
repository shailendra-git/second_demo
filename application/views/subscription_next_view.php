
<style type="text/css">
  .modal-dialog{max-width: 600px !important;}

   table.bordered td:first-child, table.bordered th:first-child, table.full td:first-child, table.full th:first-child {padding: 27px 51px 24px 19px !important;
    display: table-cell !important;
    text-align: left !important;
    border-radius: 2px !important;}
table.bordered td:last-child, table.bordered th:last-child, table.full td:last-child, table.full th:last-child{padding-left: 39px;}
  th{font-size: .9rem !important; }
  td{font-size: 17px !important;}
  /*table, tr, td{border-bottom: 1px solid #cccccc;}*/
.modal tfoot,tr,td{border-bottom: 1px solid #cccccc;}  
  td:first-child{

    padding-left: 1.5rem !important;
  }
  .text-cls{ margin-left: 34%;font-weight: 600;}
  .modal-body{
  padding: 0px !important;
}
.input_cls_form{width: 100%;text-align: center;font-weight: bold;}
.td_div{width: 16% !important;}
section{margin: 0px !important;    margin-left: 10px !important;}
.modal-content .modal-footer{padding: 8px 38px 25px 29px !important;}
.ml_cls{margin: 5px 37px !important;}
</style>

<div class="contnet-area">
	<div class="container">
      <div class="row bg">
         <div class="col-md-12 ">
          Your trial has ended (certain functionalities have been disabled). Please subscribe now.

         </div>
         <div class="col-md-12">
          <button style="min-width: 160px;
                  background: blue;
                   color: #fff;" class="btn btn-primary" data-toggle="modal" data-target="#subscribedModal">Subscribe</button></div>
       </div>
       </div>
       </div>

<!-- Modal -->
<div id="subscribedModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-cls">RENEW YOUR PLAN</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form action="<?php echo base_url('payment/plan_rebill')?>" method='post'>
      <div class="section">

      <div class="row">
     
        <div class="col-md-12">
          <table id="ember1324" class="bordered hl-stripe-subscription-preview ember-view">
            <thead>
  <tr>
    <th>
      Pricing Plan Preview
    </th>
    <th class="text-center">
      Qty
    </th>
    <th class="text-center">
      Total
    </th>
  </tr>
</thead>
<tbody>
    <tr>
      <td>
        Basic Package <br>
        <strong>$<?php echo $plan_details['unit_price']?></strong> / Unit / Month
      </td>
      <td class="text-center td_div">
       <input type="text" name="unitalot" class="input_cls_form" id='unitalot' value="<?php echo $units_initial_purchase;//$units['units_purchased'];?>"> 
      </td>
      <input type="hidden" id="minunit" name="minunit" value="<?php echo $units_can_purchase;?>">
      <td class="text-right" id="priceunitspermonth">
          <strong>$<?php echo number_format(($plan_details['unit_price']*$units_initial_purchase),2,'.','');?></strong> / Month
      </td>
    </tr>
    <tr>
      <td>
        Platform Fee <br>
        <strong>$<?php echo $plan_details['base_price'];?></strong> / Account / Month

      </td>
      <td class="text-center">
        <strong>1</strong>
      </td>
      <td class="text-right">
          <strong>$<?php echo $plan_details['base_price'];?></strong> / Month
      </td>
    </tr>
</tbody>
<tfoot>
  <tr>
    <th colspan="2" class="text-center" style="border: none !important; font-size: 17px !important; text-align: right !important;padding-right: 0px !important;">
      Estimated Total
<!---->    </th>
    <th class="text-right" style=" font-size: 17px !important;" id="finalamount">
        <strong>$<?php echo number_format(($plan_details['unit_price']*$units_initial_purchase)+$plan_details['base_price'],2,'.','');?></strong> / Month
    </th>
  </tr>
                   

</tfoot></table>
        </div>
      </div>
       <input type="hidden" id='pay_amount' name="pay_amount" value="<?php echo ($plan_details['unit_price']*$units_initial_purchase)+$plan_details['base_price'];?>"><b>
        <input type="hidden" id="unit_price" name="unit_price" value="<?php echo $plan_details['unit_price']?>">
        <input type="hidden" id='base_price' name="base_price" value="<?php echo $plan_details['base_price']?>">
        <span id="uniterr"></span>
        <button type="submit" class="btn btn-raised btn-primary ml_cls">Proceed to pay</button>
 
     
       
    </div>
  </form>

      </div>
      <div class="modal-footer123">
      </div>
    </div>

  </div>
</div>
<script>
  $('#unitalot').on('keyup',function(){
              var unit = parseInt($(this).val());
              var  minunit= parseInt($("#minunit").val());
              var  unit_price= parseInt($("#unit_price").val());

              if(unit>=minunit)
              {
                $('#uniterr').text('');
                //alert(unit);
                //var unit = parseInt(unit);
                var baseprice = parseInt($('#base_price').val());

                var unitPricePerMonth=(unit*unit_price);  
            
                //alert(totalUnit);
                $('#priceunitspermonth').html('').html('$'+unitPricePerMonth+'/Month');
            $('#finalamount').html('').html('$'+(unitPricePerMonth+baseprice));
               // $('#trialunitamount').val(totalUnit);
               // $('#trialunit').val(unit);
              // alert(unitPricePerMonth+baseprice);
               $('#pay_amount').val(unitPricePerMonth+baseprice);
              }
              else
              {
                //alert('Units cannot below '+minunit);
                $('#uniterr').text('Units cannot below '+minunit);
              }
            });
</script>

    
        
