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
    $selected = 'Select'; 
}

 ?>
<!-- </div> -->
  <div class="contnet-area">
       <ul class="nav nav-tabs ta" style="background-color:#fff">
          <li class="nav-item">
            <a class="nav-link"  href="<?php echo base_url('/financial/transaction'); ?>">Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/recurring'); ?>">Recurring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/leaseLedgerData'); ?>">Lease Ledger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active; ?>" href="<?php echo base_url('/financial/IncomeExpenseData'); ?>">Income & Expense</a>
          </li>
        </ul>
  <div class="container">
    <!-- start first section -->

    <div class="row row_bottom">

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
                      <a class="dropdown-item" href="<?php echo base_url('financial/IncomeExpenseData/')?>">All Properties</a>
                      <?php 
                        if (isset($propertydatatenat))
                        foreach($propertydatatenat as $value)
                        {?>

                           <!-- <a class="dropdown-item" href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info')?>"><?php echo substr( $value['address'],0,30)?></a> -->
                            <a class="dropdown-item" href="<?php echo base_url('financial/IncomeExpenseData/'.$value['id'])?>"><?php echo substr( $value['address'],0,30)?></a>

                       <?php }?>
                    </div>
                  </div>
              </div>
              </div>
           </div>
        </div>
    <!-- end first section -->
    
    <form action="<?php echo base_url('financial/IncomeExpenseData/'.$financial_id)?>" method="post"> 
      <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="action-top d-flex">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
           <div class="select-wrapper c11">
              <select class="form-control paid_1"  name="p_and_d"  id="p_and_d">
                 <option value="Paid">Paid Date</option>
                 <option value="Due">Due Date</option>
              </select>
              <span class="caret caree1">▼</span>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="select-wrapper c11">
            <select class="form-control paid_2" name="select_tra_list" id="select_tra_list">
                 <option value=""> <?php echo $selected; ?> </option>
                 <option value="complete">complete</option>
                 <option value="intransit">in transit</option>
                 <option value="incomplete">incomplete</option>
                 <option value="cancelled">cancelled</option>
              </select>
              <span class="caret caree2">▼</span>
            </div>
          </div>  
          <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="select-wrapper">
              <select class="form-control" name="category"  id="select_category_list">
                 <option value="">All Services</option>
                    <?php
                     foreach ($transaction_category as $category) {
                    ?>
                     <option  value="<?php echo $category['id'];?>"><?php
                     echo ucfirst($category['category_show_name']);
                     ?></option>
                    <?php
                     }
                    ?>
              </select>
              <span class="caret">▼</span>
            </div>
          </div> -->
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
           <span style="font-size:12px" id="showdatetype" class="paid_date">Paid date from</span> 
           <input type="text" class="data_pic" id="datepicker" placeholder="Any" name="s_date" autocomplete="off" value="<?php echo $start_date; ?>" required=""> <span class="too">to </span>
           <input type="text" class="data_pic1" id="datepicker1" placeholder="Any" name="e_date" autocomplete="off" value="<?php echo $end_date; ?>" required=""> 
           <button onclick="leasePayment();"class="btn btn-primary btn2 cls_btn_search" style="background-color:#008276;color:#ffffff"><i class="fa fa-search" aria-hidden="true"></i></button> 
          <button type="button" onclick="submitExportIncome()"   class="btn btn_33" style="background-color:#008276; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
          </div>
      </div>
      </div>
    </form>
    <form  id="submit_data_income" method="POST" action="<?php echo base_url('financial/incomeAndExpense/'.$financial_id); ?>">
        <input type="hidden" name="income_status" id="income_status" value="<?php echo $status; ?>">
        <input type="hidden" name="income_category" id="income_category" value="">
        <input type="hidden" name="income_start_date" id="income_start_date" value="<?php echo $start_date; ?>">
        <input type="hidden" name="income_end_date" id="income_end_date" value="<?php echo $end_date; ?>">
        <button type="submit"   class="btn" style="background-color:#009688; color:#ffffff; display:none;"><i class="fa fa-download" aria-hidden="true"></i></button>
    </form>
  <!-- start first table section -->
      <div class="row col-md-12 bg">
      <div class="col-md-12">
      <table cellspacing="10" border="1" class="cat_tab" style="text-align:center;">
        <tr>
          <th>CATEGORY</th>
          <?php
          foreach ($months_data['month_names'] as $value) {
            ?>
            <th><?php echo $value; ?></th>
            <?php
          }
          ?>
        </tr>
      <?php
      // echo "<pre>";
      // print_r($transaction_category);
       foreach ($transaction_category as $category) {
        if($category['transaction_category_name'] != 'security-deposit'){
          ?>
          <tr>
            <td>
              <?php echo $category['category_show_name']; ?>
            </td>
            <?php
            //echo $status;
              foreach ($months_data['months'] as $value) {
                $start_date = $value;
                $end_date = date("Y-m-t",strtotime($start_date));
                //$getMonthValue = $this->financial_model->getMonthData($start_date,$end_date,$status,$category['id'],$financial_id);
                $getRecurringMonthvalue = $this->financial_model->getRecurringMonthData($start_date,$end_date,$status,$category['id'],$financial_id);
               //echo $getRecurringMonthvalue['sumOfRecurringAmount'];
               // exit;
                //$totalMonth = $getMonthValue['sumOfAmount'] + $getRecurringMonthvalue['sumOfRecurringAmount'];
                if(!empty($getRecurringMonthvalue['sumOfRecurringAmount'])  && $getRecurringMonthvalue['sumOfRecurringAmount'] > 0){
                ?>
                 <td><?php echo $getRecurringMonthvalue['sumOfRecurringAmount']; ?></td> 
                <!--  <td><?php echo $start_date ."   ----  ".$end_date;?></td>  -->
                <?php
                 }
                 else{
                ?>
                  <td><?php echo '-'; ?></td>
                <?php
                 }
            }
                ?>
          </tr>
          <?php
        }
      }
      ?>
      <tr>
      <td><b>TOTAL</b></td>
   <?php
              //$i=1;
              foreach ($months_data['months'] as $value) {
                $start_date = $value;
                $end_date = date("Y-m-t",strtotime($start_date));
                //$getMonthValue = $this->financial_model->getMonthData($start_date,$end_date,$status,0,$financial_id);
     //23-03-2020          $getRecurringMonthvalue = $this->financial_model->getLeaseLedger($start_date,$end_date,$status,0,$financial_id);
                $getRecurringMonthTotalvalue = $this->financial_model->getIncomeExpenseTotal($start_date,$end_date,$status,2,$financial_id);
               //  echo "<pre>";
               //  print_r($getMonthValue);
                 // $getMonthValue['sumOfAmount'];
                 // $getRecurringMonthvalue['sumOfRecurringAmount'];

                //$totalMonth = $getMonthValue['sumOfAmount'] + $getRecurringMonthvalue['sumOfRecurringAmount'];
                if(!empty($getRecurringMonthTotalvalue['sumOfRecurringTotalAmount'])){
                ?>
                <td><?php echo $getRecurringMonthTotalvalue['sumOfRecurringTotalAmount']; ?></td>
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
      </table>
      </div>
    </div>    
    <!-- end first table section -->

    <!-- start second table section -->
      <div class="row col-md-12 bg">
      <div class="col-md-12">
      <table cellspacing="10" border="1" class="cat_tab" style="text-align:center;">
        <tr>
          <th>ACCOUNTS PAYABLE</th>
          <?php
          foreach ($months_data['month_names'] as $value) {
            ?>
            <th><?php echo $value; ?></th>
            <?php
          }
          ?>
        </tr>
      <?php
      // echo "<pre>";
      // print_r($transaction_category);
       foreach ($transaction_category as $category) {
        if($category['transaction_category_name'] === 'security-deposit'){
          ?>
          <tr>
            <td>
              <?php echo $category['category_show_name']; ?>
            </td>
            <?php
              foreach ($months_data['months'] as $value) {
                $start_date = $value;
                $end_date = date("Y-m-t",strtotime($start_date));
               // $getMonthValue = $this->financial_model->getMonthData($start_date,$end_date,$status,$category['id'],$financial_id);
                $getRecurringMonthvalue = $this->financial_model->getRecurringMonthData($start_date,$end_date,$status,$category['id'],$financial_id);
               // exit;
                if(!empty($getRecurringMonthvalue['sumOfRecurringAmount'])){
                ?>
                <td><?php echo $getRecurringMonthvalue['sumOfRecurringAmount']; ?></td>
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
      }
      ?>
      <tr>
      </table>
      </div>
    </div>    
    <!-- end second table section -->


   
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

