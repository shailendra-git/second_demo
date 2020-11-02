<!-- print_r($transaction_data) -->
<?php
$payment = '';
if($transaction_data['payment_type'] == 1){
  $payment = 'One-time';
}else{
  $payment = 'Recurring';
}

?>
<style>
.col-md-6 {
    float: left;
    clear: none;
}
.dropzone {
    min-height: 0px;
    padding: 0px 0px;
}
.cancelled{
  display: none;
}
.complete{
  color:#4caf50!important;
}
.incomplete{
  color:#ff0000;
}
</style>

<div class="contnet-area">
	<div class="container">
    <!-- first section -->
      <div class="row col-md-10 bg">
         <div class="col-md-12">
          <center>
            <br>
           <h3>Transaction Record</h3>
         </center>
         </div>
         <br>
         <br>
         <br>
         <div class="col-md-12">
           <div class="col-md-6">
             <h5><span><?php echo ucfirst($transaction_data['category_show_name']); ?></span> [ <span><?php echo $payment; ?></span> ]</h5>
             <br>
             <h5><span>$<?php echo ucfirst($transaction_data['amount']); ?></span><span> Due <?php echo $transaction_data['date']; ?></span></h5>
             <br>
             <h6><span><?php echo ucfirst($transaction_data['address'].', Unit-'.$transaction_data['unit']); ?></span></h6>
             <br>
             <h6><span><?php echo ucfirst($transaction_data['group_name']); ?></span></h6>
             <br>
             <br>
             <h6><span><?php echo ucfirst('Payment made offline :'); ?></span></h6>
             <br>
             <br>
             <?php
             if($transaction_data['paid_amount'] != 0 &&  $transaction_data['paid_amount'] > 0 ){
             ?>
             <div class="filter pull-right">
             <a class="btn btn-raised btn-primary dropdown-item offline_payment simple-ajax-popup-align-top" href="/financial/paymentOfflineViewData/<?php echo $transaction_data['id']; ?>"> + OFFLINE PAYMENT</a>
             <!--  <div class="dropdown">
                <button class="btn btn-raised btn-primary offline_payment simple-ajax-popup-align-top" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <a href="/financial/paymentOfflineViewData">
                 + OFFLINE PAYMENT
                 </a>
                </button>
              </div> -->
            </div>
            <?php
            }
            ?>
          </div>
           <div class="col-md-6">
            <center>
              <?php 
              // if($transaction_data['paid_amount'] > 0){
              //   $check_status = 'incomplete';
              // }else{
              //   $check_status = 'complete';
              // }
              ?>
              <h5><span class="<?php echo $transaction_data['status']; ?>"><?php echo ucfirst($transaction_data['status']); ?></span></h5>
              <br>
              <h5>$<?php echo $transaction_data['paid_amount'].' bal'; ?></h5>
              <br>
              <!-- <h5><input type="file"></h5> -->
               <div class="card-body ">
               <h6 class="mb-2">Private Transaction Documents</h6>
               <p class="text-small text-secondary my-2">Documents uploaded here are only visible to you and property members who can access the Property tab.
               </p>
               <form action="<?php echo base_url('financial/transaction_doc_uploadAndDelete')?>" class="dropzone" id=""> 
               <input type="hidden" name="transaction_doc_id" value="<?php echo  $transaction_data['id']; ?>">    
               </form>
               </div>
              <br>
              <div class="filter pull-left">
              <div class="dropdown">
                <button class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  OTHER ACTIONS

                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <a class="simple-ajax-popup-align-top dropdown-item add_transaction"  href="one_time_popup" value="one-time">Record one-time</a> -->
                    <a class="dropdown-item update_category simple-ajax-popup-align-top" href="/financial/updateCategoryViewData/<?php echo $transaction_data['id']; ?>">Change Category</a>
                    <!-- <a class="dropdown-item confirm_payment simple-ajax-popup-align-top" href="/financial/confirmPaymentViewData">Cancel Request</a> -->
                    <!-- <a class="dropdown-item" href="#" value="request">Record against online request</a> -->
                </div>
              </div>

            </div>

             <!--  <select class="form-control" style="border: 2px solid #517bbe !important; width: 65%;">
                 <option>&nbsp&nbsp<span class="caret">▼</span>&nbsp OTHER ACTIONS</option>
                 <option>&nbsp&nbsp&nbsp&nbsp<a href="<?php echo '/financial/updateCategoryViewData'; ?>">Change Category</a></option>
                 <option>&nbsp&nbsp&nbsp&nbspCancel Request</option>
              </select> -->
            </center>
           </div>
         </div>

        <!-- image box show images -->
        <div class="col-md-12">
          <center>
          <div id="showImages">
            <?php
               if(!empty($transactiondocs))
               {
                foreach ($transactiondocs as $key => $transactiondoc) { 

                  ///print_r($transactiondoc);

                  $filename = explode('.',$transactiondoc['file_name']);
                  ?>
            <div id="<?php echo $filename[0]?>"  >
            <div style="float: left; margin: 10px; margin-left: 0px;">

              <a <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/transaction_doc/').$transactiondoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/transaction_doc/').$transactiondoc['file_name']?>" data-lightbox="example-set" <?php } ?>>
              
               <?php
               if($filename[1] == pdf){
                  ?>
                   <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                <?php
                }else{
                  ?>

                  <img  src="<?php echo base_url('upload/transaction_doc/').$transactiondoc['file_name']?>" class="example-image img-thumbnail size_image">
               <?php
               }
               ?>
                </a>
                  <div>
                  <center>
               <button class='payremdoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $transactiondoc['id']?>" rem-file="<?php echo $transactiondoc['file_name']?>" >
                  Remove</button>
                  </center>
                  </div>
                  </div>
            </div>
            <?php }

               }
               ?>
         </div>
         </center>
        </div>
        <!-- image box show images -->
      </div>
    <!-- first section -->
    <!-- second section -->
    <div class="row col-md-10 bg">

      <div class="col-md-12">
         <div class="col-md-6">
           <h5>Payments</h5>
           <br>
          </div>
         <div class="col-md-6">
          <center>
            <h5><input type="checkbox" id="can_include" name="che_cancel" >&nbsp&nbsp Include Cancelled</h5>
            <br>
          </center>
         </div>
      </div>

    <?php 
    if($transaction_data['payment_type'] == 1){

    foreach ($paidData as $key => $value) {
      // print_r($value);
      $check_include = '';
      if($value->del_status === 'yes'){
        $check_include = 'succeeded';
      }else{
        $check_include = 'cancelled';
      }
     ?>
    
        <!--  <div class="col-md-12">
           <div class="col-md-6">
             <h5>Payments</h5>
             <br>
            </div>
           <div class="col-md-6">
            <center>
              <h5><input type="checkbox" name="che_cancel">&nbsp&nbsp Include Cancelled</h5>
              <br>
            </center>
           </div>
         </div> -->
       <!--   <div class="col-md-12">
          <div class="col-md-12">
            <input type="text" name="paid_id" value="<?php echo  $value->p_id; ?>"> 
          </div>
         </div> --> 
           <?php
           // $date=date_create($value->p_date);
           // $date_f = date_format($date,"D d Y");
           ?>
          <div class="col-md-12 <?php echo $check_include; ?>">
           <div class="col-md-6">
             <h5><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></h5>
             <br>
             <h5>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</h5>
             <br>
             <h5><?php echo isset($value->p_memo) ? $value->p_memo : ''; ?></h5>
            </div>
           <div class="col-md-6">
            <center>
             <!--  <div class="card-body ">
                   <h6 class="mb-2">Private Transaction Documents</h6>
                   <p class="text-small text-secondary my-2">Documents uploaded here are only visible to you and property members who can access the Property tab.
                   </p>
                   <form action="<?php echo base_url('financial/transaction_doc_uploadAndDelete')?>" class="dropzone" id=""> 
                   <input type="hidden" name="transaction_doc_id" value="<?php echo  $transaction_data['id']; ?>">       
                   </form>
              </div> -->
              <br>
              <!-- <button class="btn btn-danger" style="background-color:red;color:#ffffff;"><i class="fa fa-trash-o" aria-hidden="true"></i></button> -->
              <a class="btn btn-danger offline_payment_delete simple-ajax-popup-align-top" href="/financial/paymentOfflineDeleteData/<?php echo $value->p_id; ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              &nbsp&nbsp<a class="offline_payment_edit simple-ajax-popup-align-top" href="/financial/paymentOfflineEditData/<?php echo $value->p_id; ?>" style="font-size:20px; color:blue;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </center>
           </div>
         </div>
        <div class="col-md-12 <?php echo $check_include; ?>" >
          <div class="col-md-12">
          <hr>
          </div>
        </div>
     
      <?php
    }
  }else{
    foreach ($paidData as $key => $value) {

    if($value->p_payment_type === 'recurring'){
      $check_include = '';
      if($value->del_status === 'yes'){
        $check_include = 'succeeded';
      }else{
        $check_include = 'cancelled';
      }
      ?>

       <!-- <div class="row col-md-10 bg"> -->
         <div class="col-md-12 <?php echo $check_include; ?>" >
          <div class="col-md-12">
          <br>
           <h5> Future scheduled payments will be ignored if the remaining amount due is less than the scheduled amount.</h5>
          <br>
          </div>
         </div>
           <!-- <div class="col-md-6">
             <h5><span>Active</span><span>&nbsp&nbsp&nbsp&nbsp&nbsp Scheduled for due date</span></h5>
             <br>
             <h5>Auto-generated payment override</h5>
            </div> -->

          <div class="col-md-12 <?php echo $check_include; ?>">
           <div class="col-md-6">
             <h5><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></h5>
             <br>
             <h5>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</h5>
             <br>
             <h5><?php echo isset($value->p_memo) ? $value->p_memo : ''; ?></h5>
            </div>
           <div class="col-md-6">
            <center>
              <!-- <h5>$<?php echo $value->paid_amount; ?></h5> -->
              <br>
              <a class="btn btn-danger offline_payment_delete simple-ajax-popup-align-top" href="/financial/paymentOfflineDeleteData/<?php echo $value->p_id; ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              &nbsp&nbsp<a class="offline_payment_edit simple-ajax-popup-align-top" href="/financial/paymentOfflineEditData/<?php echo $value->p_id; ?>" style="font-size:20px; color:blue;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </center>
           </div>
          </div>
        <div class="col-md-12 <?php echo $check_include; ?>">
          <div class="col-md-12">
          <hr>
          </div>
        </div>
      <?php
      }
    }
  }
    ?>
  </div>
     <!-- second section -->
  </div>
</div>
<script>
$('input[type="checkbox"]').click(function(){
   if($(this).is(":checked")){
        $('.cancelled').show();
      }
      else if($(this).is(":not(:checked)")){
          $('.cancelled').hide();
      }
});
</script>
