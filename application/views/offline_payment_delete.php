<?php
    foreach ($paidEditData as $key => $value) {
    ?>
<form style="height: 600px;" class="popup_form_margin" id="transaction_validation" target="_parent" action="/financial/offlineUpdateDeleteData/<?php echo $value->p_id; ?>" method="POST">
    <br>
    <br>
    <h3 class="modal-title offline_payment_delete">CONFIRM</h3>  
    <br>
    <br>
    
    <div class="form-group">
      <div class="row bottom">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
          <h3>Are you sure you want to cancel this payment?</h3>
          </div>
      </div>
    </div> 
    <div class="form-group">
      <div class="row bottom">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
          <input type="hidden" name="transaction" value="<?php echo $value->transaction_id; ?>">
          </div>
      </div>
    </div> 
   

    <div class="form-group pull-right">
      <button type="submit" class="btn btn-primary btn-raised">OK</button>
      <button type='button' class="btn btn-default btn_cancle">CANCEL</button>
    </div>

    <?php
    }
    ?>
  </form>

<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
  <script>
  $( "#paid_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  </script>


  