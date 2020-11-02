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
   
<!-- </div> -->
<div class="contnet-area">
       <ul class="nav nav-tabs" style="background-color:#fff">
          <li class="nav-item">
            <a class="nav-link active"  href="<?php echo base_url('/financial/transaction'); ?>">Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Recurring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Lease Ledger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/leasepaymentdata'); ?>">Income & Expense</a>
          </li>
        </ul>
    <div class="container">
    <!-- first section -->

     <div class="row row_bottom mt-4">

             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

                <div class="action-top d-flex justify-content-between">

                <div class="filter pull-left">
                  <div class="dropdown">
                    <button class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      All Properties
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <?php 
                        if (isset($propertydata))
                        foreach($propertydata as $value)
                        {?>

                           <!-- <a class="dropdown-item" href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info')?>"><?php echo substr( $value['address'],0,30)?></a> -->
                            <a class="dropdown-item" href="#"><?php echo substr( $value['address'],0,30)?></a>

                       <?php }?>
                    </div>
                  </div>
              </div>
              </div>
           </div>
        </div>


      <div class="row row_bottom">
      <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="action-top d-flex">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
           <div class="select-wrapper">
              <select class="form-control" name="p_and_d"  id="p_and_d">
                 <option value="Paid">Paid Date</option>
                 <option value="Due">Due Date</option>
              </select>
              <span class="caret">▼</span>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="select-wrapper">
            <select class="form-control" name="select_tra_list" id="select_tra_list">
                 <option value="">All Active</option>
                 <option value="complete">Complete</option>
                 <option value="intransit">In transit</option>
                 <option value="incomplete">Incomplete</option>
                 <option value="cancelled">Cancelled</option>
              </select>
              <span class="caret">▼</span>
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
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
           <span style="font-size:12px" id="showdatetype">Paid date from</span> 
           <input type="text" id="datepicker" placeholder="Any" name="s_date" autocomplete="off" value="2019-12-17"> to <input type="text" id="datepicker1" placeholder="Any" name="e_date" autocomplete="off" value="2019-12-17"> 
           <button onclick="leasePayment();"class="btn btn-primary" style="background-color:#008276;color:#ffffff"><i class="fa fa-search" aria-hidden="true"></i></button> 
           <!-- <button onclick="submitExport()"   class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button> -->
              <!-- <form  id="submit_data" method="POST" action="<?php echo base_url('financial/exportCSV/'); ?>">
                <input type="hidden" name="exp_status" id="exp_status" value="">
                <input type="hidden" name="exp_category" id="exp_category" value="">
                <input type="hidden" name="exp_end_date" id="exp_end_date" value="">
                <input type="hidden" name="exp_start_date" id="exp_start_date" value="">
                <button type="submit"  style="display:none" class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
              </form> -->
          </div>
      </div>
      </div>
      <div class="row col-md-12 bg">
      <div class="col-md-12">
      <table cellspacing="10" border="1" width="700px" style="text-align:center;">
        <tr>
          <th>Category</th>
          <th>DEC'19</th>
          <th>NOV'19</th>
          <th>OCT'19</th>
          <!-- <th>SEP'19</th>
          <th>AUG'19</th>  -->
        </tr>
      <?php
      // echo "<pre>";
      // print_r($transaction_category);
       foreach ($transaction_category as $category) {
      ?>
      <tr>
        <td>
          <?php echo $category['category_show_name']; ?>
        </td>
        <?php
        foreach ($getLastMonth as $key => $value) {
           $getMonth = $this->financial_model->getMonthData($category['id'],$value['month']);
           // echo "<Pre>";
           // print_r($getMonth);
           if(!empty($getMonth) && $getMonth['amount'] > 0){
            ?>
            <td>$<?php echo $getMonth['amount']; ?></td>
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
      ?>
      <tr>
        <td><b>TOTAL</b></td>
        <?php
        foreach ($getLastMonth as $key => $value) {
            $getTotal = $this->financial_model->getMonthTotal($value['month']);
             if(!empty($getTotal) && $getTotal['sumamount'] > 0){
               ?>
               <td><b>$<?php echo $getTotal['sumamount']; ?></b></td>
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
     <!-- first section -->
  </div>
</div>
<script>
$( "#datepicker" ).datepicker({ dateFormat: 'yy-m-d' }).val();
$( "#datepicker1" ).datepicker({ dateFormat: 'yy-m-d' }).val();

$('#p_and_d').on('change', function(){
   var paid_due = $('#p_and_d').val();
   $('#showdatetype').html(paid_due+' date from');
});

</script>

