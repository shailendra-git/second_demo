<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
<script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<style>
#datepicker , #datepicker1 {
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    text-align: center;
}
.col-md-3 {
    float: left;
}
.col-md-2 {
    float: left;
}
a.nav-link {

    margin: 0px 30px;
}


</style>
<!-- <div class="contnet-area" style="background-color:#fff"> -->
<?php 
if(!empty($status))
  {
   $selected =  $status; 
 }
else
  { 
    $selected = 'Selected'; 
}

 ?>
<!-- </div> -->
<div class="contnet-area">
       <ul class="nav nav-tabs" style="background-color:#fff">
          <li class="nav-item">
            <a class="nav-link"  href="<?php echo base_url('/financial/transaction'); ?>">Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/recurring'); ?>">Recurring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active; ?>" href="<?php echo base_url('/financial/leaseLedgerData'); ?>">Lease Ledger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/IncomeExpenseData'); ?>">Income & Expense</a>
          </li>
        </ul>
<div class="container">
    <!-- start first section -->

 <div class="row row_bottom" style="margin-bottom:-15px !important;">

             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

                <div class="action-top d-flex justify-content-between">

                <div class="filter pull-left">
                  <div class="dropdown">
                    <button class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php
                      if(!empty($financial_id)){
                        $property_select = $this->financial_model->getPropertyDataTenantSelect($financial_id);
                        echo substr( $property_select['address'],0,30);
                      }else{
                        echo 'All Properties';
                      }
                      ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?php echo base_url('financial/leaseLedgerData/')?>">All Properties</a>
                      <?php 
                        if (isset($propertydatatenat))
                        foreach($propertydatatenat as $value)
                        {?>

                           <!-- <a class="dropdown-item" href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info')?>"><?php echo substr( $value['address'],0,30)?></a> -->
                            <a class="dropdown-item" href="<?php echo base_url('financial/leaseLedgerData/'.$value['id'])?>"><?php echo substr( $value['address'],0,30)?></a>

                       <?php }?>
                    </div>
                  </div>
             <!--  <div class="switch ">
                <form action = "check.php" method = "post">
                    <label class="cls_opn">
                      <span class="closed_right">Archived</span>
                        <input type="checkbox" onchange="maintainceRequest();" id="statusChacked" <?php if($status==1 ){?> checked <?php }?> >
                      <span class="lever"></span>
                      <span class="open_left">Active</span>
                    </label>
                  </form> 
                </div> -->
              </div>
              </div>
           </div>
        </div>
     <div class="row row_bottom" style="margin-bottom:-15px !important;">  
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="btn_download">
              <form  id="submit_data_income" method="POST" action="<?php echo base_url('financial/leaseLedgerExport/'.$financial_id); ?>" style="float:right;">
                <input type="hidden" name="income_start_date" id="income_start_date" value="<?php echo $start_date; ?>">
                <input type="hidden" name="income_end_date" id="income_end_date" value="<?php echo $end_date; ?>">
                <input type="hidden" name="income_property" id="income_property" value="<?php echo $financial_id; ?>">
                <button type="submit"   value="DOWNLOAD" class="btn" style="background-color:#009688; color:#ffffff;">DOWNLOAD</button>
              </form>
            </div>
        </div>
    </div> 
    <!-- end first section -->
      <div class="row">
        <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="action-top d-flex">
           <!--    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              Property
              </div> -->
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                 <table border="1"  style="text-align:center;">
                  <th style="padding:20px !important">Due Date</th>
                 <?php 
                    foreach ($due_arr as $value) {
                    ?>
                    <tr>
                       <td><?php echo $value; ?></td> 
                     </tr>
                    <?php
                  }
                  ?>
                  </table>
                </div>

                 <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="overflow-x: auto; margin-left:-21px !important;">

                 <table cellspacing="10" cellpadding="10" border="1" width="600px"  style="text-align:center;">
                  <tr>
                    <th style="display:none">Due Date</th>
                    <?php
                    foreach ($months_data['monthnames'] as $value) {
                    ?>
                    <th><?php echo $value; ?></th>
                    <?php
                    }
                    ?>
                  </tr>
                    <?php 
                    foreach ($due_arr as $value) {
                    ?>
                    <tr>
                    <td style="display:none"><?php echo $value; ?></td>
                    <?php
                    if($value == 'Paid'){
                      foreach ($months_data['month'] as $value) {
                        $start_date = $value;
                        $end_date = date("Y-m-t",strtotime($start_date));
                        $getLeaseValue = $this->financial_model->getLeaseLedger($start_date,$end_date,$financial_id);
                         // echo "<pre>";
                         // print_r($getLeaseValue);
                        // exit; 
                       // exit;
                        if(!empty($getLeaseValue['sumOfAmount'])){
                        ?>
                        <td><?php echo $getLeaseValue['sumOfAmount']; ?></td>
                        <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                        <?php
                         }else{
                        ?>
                          <td><?php echo '-'; ?></td>
                        <?php
                         }
                      }
                      ?>
                        </tr>
                        <?php
                    }
                    if($value == 'Balance'){
                      foreach ($months_data['month'] as $value) {
                        $start_date = $value;
                        $end_date = date("Y-m-t",strtotime($start_date));
                        $getLeaseValue = $this->financial_model->getLeaseLedger($start_date,$end_date,$financial_id);
                         // echo "<pre>";
                         // print_r($getLeaseValue);
                        // exit; 
                       // exit;
                        if(!empty($getLeaseValue['sumTotalAmount'])  && $getLeaseValue['sumTotalAmount'] > 0){
                        ?>
                        <td><?php echo $getLeaseValue['sumTotalAmount']; ?></td>
                        <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                        <?php
                         }else{
                        ?>
                          <td><?php echo '-'; ?></td>
                        <?php
                         }
                      }
                      ?>
                        </tr>
                        <?php
                  }
                  if($value == 'Scheduled'){
                      foreach ($months_data['month'] as $value) {
                        $start_date = $value;
                        $end_date = date("Y-m-t",strtotime($start_date));
                        $getLeaseValue = $this->financial_model->getLeaseLedger($start_date,$end_date,$financial_id);
                         // echo "<pre>";
                         // print_r($getLeaseValue);
                        // exit; 
                       // exit;
                        if(!empty($getLeaseValue['sumTotalAmount'])){
                        ?>
                        <td><?php echo '-'; ?></td>
                        <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                        <?php
                         }else{
                        ?>
                          <td><?php echo '-'; ?></td>
                        <?php
                         }
                      }
                      ?>
                        </tr>
                        <?php
                    }
                    if($value == 'Requested'){
                      foreach ($months_data['month'] as $value) {
                        $start_date = $value;
                        $end_date = date("Y-m-t",strtotime($start_date));
                        $getLeaseValue = $this->financial_model->getLeaseLedger($start_date,$end_date,$financial_id);
                         // echo "<pre>";
                         // print_r($getLeaseValue);
                        // exit; 
                       // exit;
                        if(!empty($getLeaseValue['sumTotalAmount'])){
                        ?>
                        <td><?php echo '-'; ?></td>
                        <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                        <?php
                         }else{
                        ?>
                          <td><?php echo '-'; ?></td>
                        <?php
                         }
                      }
                      ?>
                        </tr>
                        <?php
                    }
                     if($value == 'Prior Balance'){
                      foreach ($months_data['month'] as $value) {
                        $start_date = $value;
                        $end_date = date("Y-m-t",strtotime($start_date));
                        $getLeaseValue = $this->financial_model->getLeaseLedger($start_date,$end_date,$financial_id);
                         // echo "<pre>";
                         // print_r($getLeaseValue);
                        // exit; 
                       // exit;
                        if(!empty($getLeaseValue['sumTotalAmount'])){
                        ?>
                        <td style="padding-top:40px;"><?php echo '-'; ?></td>
                        <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                        <?php
                         }else{
                        ?>
                          <td style="padding-top:40px;"><?php echo '-'; ?></td>
                        <?php
                         }
                      }
                      ?>
                        </tr>
                        <?php
                    }
                  }
                  ?>
                 </table>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>
<script>

function submitExportIncome()
{
  //alert('hello');
  $("#submit_data_income").submit();
}

$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
$( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

$('#p_and_d').on('change', function(){
   var paid_due = $('#p_and_d').val();
   $('#showdatetype').html(paid_due+' date from');
});

</script>

