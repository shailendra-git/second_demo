
<form style="height: 600px;" class="popup_form_margin" onsubmit="return check_validation();"  id="transaction_validation" target="_parent" action="#" method="POST">
    <br>
    <br>
    <h3 class="modal-title offline_payment_edit">Add Adjustment</h3>  
    <br>
    <br>
<!--     <div class="form-group">
      <div class="row bottom">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
            <input type="radio" name="payment" value="offline_payment" checked> Offline Payment
            <input type="radio" name="payment" value="uncollectible"> Uncollectible
          </div>
      </div>
    </div> -->

    <div class="form-group">
      <div class="row bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
          <div class="form-group ">
            <input type="hidden" name="remaning_amount" id="remaning_amount" class="form-control"   value="<?php echo $transaction_data['paid_amount']; ?>">
            
          </div>
        </div>
      </div>
    </div>
    <?php
foreach ($paidEditData as $key => $value) {
 // print_r($value);

?>
 <input type="hidden" name="edit_store" id="edit_store" class="form-control"   value="<?php echo ucfirst($value->p_amount); ?>">
    <div class="form-group">
      <div class="row bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
          <div class="form-group ">
            <label for="total_amount" class="bmd-label-floating">Amount *</label>
            <input type="paid_amount" name="edit_amount" id="edit_amount" class="form-control"  placeholder="$ e.g. 123.45" value="<?php echo ucfirst($value->p_amount); ?>" required="">
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row bottom">
       <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
          <div class="form-group ">
            <label for="paid_date" class="bmd-label-floating">Paid Date</label>
            <input type="text" id="edit_date" name="edit_date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $value->p_date; ?>" autocomplete="off">
            <div id="check_amount" style="color:red;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row bottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
          <div class="form-group ">
            <label for="memo" class="bmd-label-floating">Memo</label>
            <input type="text" id="edit_memo" name="edit_memo" class="memo form-control" value="<?php echo $value->p_memo; ?>" required="">
          </div>
        </div>
      </div>
    </div> 
  <?php
}
?>
    <div class="form-group pull-right">
      <button type="submit" class="btn btn-primary btn-raised" href="/financial/updatePaidData/<?php echo $value->p_id; ?>">SAVE</button>
      <button type='button' class="btn btn-default btn_cancle">CANCEL</button>
    </div>
  </form>

<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
  <script>
  $( "#paid_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  </script>
  <script>
function check_validation(){

var remaning_amount = $('#remaning_amount').val();
var edit_amount = $('#edit_amount').val();
var edit_store = $('#edit_store').val();
//alert(edit_store);
var remaining_edit_amount = parseFloat(remaning_amount) + parseFloat(edit_store);
if(parseFloat(remaining_edit_amount) < parseFloat(edit_amount) ){
  
  alert('Amount cannot be greater then remaining amount '+  parseFloat(remaining_edit_amount));
  return false;
}
return true;
}

$("#edit_amount").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
 });

</script>



  
