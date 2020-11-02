<form style="height: 600px;" onsubmit="return check_validation();" class="popup_form_margin" id="transaction_validation" target="_parent" action="#" method="POST">
    <br>
    <br>
    <h3 class="modal-title offline_payment">Add Adjustment</h3>  
    <br>
    <br>
    <div class="form-group">
      <div class="row bottom">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
            <input type="radio" name="payment" value="offline_payment" checked> Offline Payment
            <input type="radio" name="payment" value="uncollectible"> Uncollectible
          </div>
      </div>
    </div>
    
    <div class="form-group">
      <div class="row bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
          <div class="form-group ">
            <input type="hidden" name="remaning_amount" id="remaning_amount" class="form-control"  placeholder="$ e.g. 123.45" value="<?php echo $transaction_data['paid_amount']; ?>">
          </div>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="row bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
          <div class="form-group ">
            <label for="total_amount" class="bmd-label-floating">Amount *</label>
            <input type="text" name="due_amount" id="due_amount" class="form-control"  placeholder="$ e.g. 123.45" required="">
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row bottom">
       <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
          <div class="form-group ">
            <label for="paid_date" class="bmd-label-floating">Paid Date</label>
            <input type="text" id="paid_date" name="paid_date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $transaction_data['paid_date']; ?>" autocomplete="off" required="">
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
            <input type="text" id="p_memo" name="p_memo" class="memo form-control" required="">
          </div>
        </div>
      </div>
    </div> 

    <div class="form-group pull-right">
      <button type="submit" class="btn btn-primary btn-raised">CONFIRM</button>
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
var due_amount = $('#due_amount').val();

if(parseFloat(remaning_amount) < parseFloat(due_amount) ){
  alert('Amount cannot be greater then remaining amount '+  parseFloat(remaning_amount));
  return false;
}
return true;
}

$("#due_amount").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
 });
</script>
