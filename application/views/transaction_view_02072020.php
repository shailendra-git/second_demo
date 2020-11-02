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
.complete{
  color:#4caf50!important;
}
.incomplete{
  color:#ff0000;
}
a.nav-link {

    margin: 0px 30px;
}
</style>
 
<div class="contnet-area">

  <ul class="nav nav-tabs ta" style="background-color:#fff">
          <li class="nav-item">
            <a class="nav-link <?php echo $active; ?>" href="<?php echo base_url('/financial/transaction'); ?>">Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/recurring'); ?>">Recurring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/leaseLedgerData'); ?>">Lease Ledger</a>
          </li>
          <li class="nav-item in">
            <a class="nav-link" href="<?php echo base_url('/financial/IncomeExpenseData'); ?>">Income & Expense</a>
          </li>
        </ul>

   <div class="container container_m_padding">

          <div class="row row_bottom">

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

      <div class="row row_bottom">
      <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
        <div class="action-top d-flex justify-content-between">
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><h1 class="record">Record Payments<h1></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="filter pull-left">
              <div class="dropdown">
                <button class="btn btn-raised btn-primary dropdown-toggle btn_4" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  OFFLINE PAYMENT

                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <a class="simple-ajax-popup-align-top dropdown-item add_transaction"  href="one_time_popup" value="one-time">Record one-time</a> -->
                    <a class="dropdown-item add_transaction  simple-ajax-popup-align-top" href="/financial/one_time_popup">Record one-time</a>
                    <a class="dropdown-item add_recurring simple-ajax-popup-align-top" href="/financial/recurring_popup" value="recurring">Record recurring</a>
                    <!-- <a class="dropdown-item" href="#" value="request">Record against online request</a> -->
                </div>
              </div>
            </div>
          </div>
         </div>
      </div>
      </div>

      <div class="row row_bottom">
      <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="action-top ac_top">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
           <div class="select-wrapper c1">
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
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="select-wrapper c2">
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
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 due_date">
           <span style="font-size:12px" class="due">Due date from</span> 
           <input type="text" id="datepicker" placeholder="Any" name="start_date" autocomplete="off" class="any"><span class="to">to</span> <input type="text" id="datepicker1" placeholder="Any" name="end_date" autocomplete="off" class="due1"> 
           <button onclick="searchbydata();"class="btn btn-primary btn1" style="background-color:#008276;color:#ffffff"><i class="fa fa-search" aria-hidden="true"></i></button> 
           <button onclick="submitExport()"   class="btn btn1" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
              <form  id="submit_data" method="POST" action="<?php echo base_url('financial/transactionExportCSV/'); ?>">
                <input type="hidden" name="exp_status" id="exp_status" value="">
                <input type="hidden" name="exp_category" id="exp_category" value="">
                <input type="hidden" name="exp_end_date" id="exp_end_date" value="">
                <input type="hidden" name="exp_start_date" id="exp_start_date" value="">
                <button type="submit"  style="display:none" class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
              </form>
          </div>
        </div>
      </div>
      </div>

    <!-- start input search code  -->
    <!-- base_url('financial/show_data') -->
     <!--  <form action="#" method="POST">
        <div class="row row_bottom">
          <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="action-top d-flex">
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
               <input type="text" placeholder="Payment Reference Number" name="search" class="form-control">
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button type="submit" class="btn btn-primary" style="border: 2px solid #517bbe !important; color:#517bbe;">Search</button>
              </div>
            </div>
          </div>
        </div>
      </form> -->
    <!-- end input search code  -->

      <div class="row row_bottom">
        <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
          <div class="action-top d-flex">
            <table class="table table-hover" id="userstatusdata">
              <!-- <tr><td><p>Date: <input type="text" id="datepicker"></p></td></tr> -->
              <!-- <tr><td colspan="3">Due date from <input type="text" id="datepicker" placeholder="Any" name="start_date"> to <input type="text" id="datepicker1" placeholder="Any" name="end_date"> <button onclick="searchbydata();"class="btn btn-primary" style="background-color:#008276;color:#ffffff">Search</button></td> -->
              <tr><td colspan="3"></td>
                <td colspan="3"> 
                  <div class="select-wrapper" >
                   <!--  <form  id="submit_data" method="POST" action="<?php echo base_url('financial/exportCSV/'); ?>">
                      <input type="hidden" name="exp_status" id="exp_status" value="">
                      <input type="hidden" name="exp_category" id="exp_category" value="">
                      <input type="hidden" name="exp_end_date" id="exp_end_date" value="">
                      <input type="hidden" name="exp_start_date" id="exp_start_date" value="">
                      <button type="submit" class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
                    </form> -->
                  <!-- <button class="btn"  style="background-color:#009688; color:#ffffff;">DOWNLOAD</button> -->
                   <!--  <select class="form-control">
                       <option><span class="caret">▼</span> DOWNLOAD</option>
                       <option>Invoices</option>
                       <option>Payments</option>
                    </select> -->
                  </div>
                </td>
              </tr>
              <tr>
                 <th class="aa"></th>
                 <th class="aa">INFO</th>
                 <th class="aa">CATEGORY<br><small>MONEY TYPE</small></th>
                 <th class="aa">STATUS<br><small>DUE DATE</small></th>
                 <th class="aa">BALANCE<br><small>TOTAL</small></th>
                 <th class="aa">ACTIONS</th>
              </tr>
              <?php
              foreach ($getFinancialData as $data) {
                if($data['payment_type'] == 1){

                     $payment_type = 'One-time';
                }else{

                     $payment_type = 'Recurring';
                }
                ?>
                <tr>
                  <td  class="arrow_val" onclick="showTrascationRow(<?php echo $data['id']; ?>)"><i class="fa fa-caret-right" aria-hidden="true"></i></td>
                  <td><?php echo  $data['group_name']; ?> Paid you<br><small><?php echo $data['address'].', unit-'.$data['unit']; ?><small></td>
                  <td><?php echo ucfirst($data['category_show_name']);    ?><br><small><?php echo $payment_type; ?></small></td>
                  <td><span class="<?php echo $data['status'];  ?>"><?php echo ucfirst($data['status']);  ?></span><br><small><?php if($data['payment_type'] == 2){ echo $data['start_date']; }else{ echo $data['date']; }?></small></td>
                  <?php if($data['payment_type'] == 2){
                   ?>
                   <td>$<?php echo $data['due_amount']; ?></td>
                   <?php 
                  }else{
                    ?>
                  <td>$<?php echo $data['paid_amount'];  ?><br><small>$<?php echo $data['amount']; ?></small></td>
                  <?php
                  }
                  ?>
                  <td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
                </tr>
                <tr id="transaction_<?php echo $data['id']; ?>" style="display:none">
                  <td></td>
                    <td colspan="5">
                 <p>Payments</p>
                 <br>
                 <?php
              if($data['payment_type'] == 1){
                foreach ($data['paymentdata'] as $key => $value) {
                if($value->del_status === 'yes'){
                  ?>
                   <p><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></p>
                   <p>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</p>
                   <br>
                  <?php
                }
                } 
              }else{
                foreach ($data['paymentdata'] as $key => $value) {
                  if($value->p_payment_type == 'recurring'){
                    if($value->del_status === 'yes'){
                    ?>
                     <p><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></p>
                     <p>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</p>
                     <br>
                    <?php
                     }
                  }
                } 
              }
                  ?>    

                </td></tr>
              <?php }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
function submitExport()
{
  $("#submit_data").submit();
}


 $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
 $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();



// $("#select_tra_list").change(function() {
// //alert($('#userstatusdata').empty().last('tr'));
//     var status = $(this).val();
//    // var category_id = $('#select_category_list').val();

//     // $('#reset_btn').on('click', function(){
//       $('#datepicker').datepicker('setDate', null);
//       $('#datepicker1').datepicker('setDate', null);
//     });
//     alert(status);   
//     var trHTML = '<tr><td colspan="5"><center>NO RECORD FOUND</center></td></tr>';
//     $.ajax({
//         url: '<?php echo base_url('financial/transaction_list_data/') ?>'+status,
//         type:"GET", 
//         dataType: 'json',

//         success: function(result){
//           if(result.success == 'true'){
//             $('#userstatusdata tr:gt(1)').remove();

//              trHTML = '';
   
//             $.each(result.data, function (i, data) {
                  
//                 trHTML += '<tr><td>' + data.address + '</td><td>' + data.transaction_category_name + '<br><small>' + data.payment_type + '</small></td><td>' + data.status + '<br><small>' + data.date + '</small></td><td>' + data.amount + '</td><td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td></tr>';
//             });
              
//             $('#userstatusdata').append(trHTML);
              
//           }
//           else{
//              $('#userstatusdata tr:gt(1)').remove();
//              $('#userstatusdata').append(trHTML);
//           }
//         },
//           error: function (msg) {
//               alert(msg.responseText);
//           }
//     });
// });


// $('#select_category_list').change(function(){
     
//     var category_id = $(this).val();
//      //alert(category);
//      $('#datepicker').datepicker('setDate', null);
//      $('#datepicker1').datepicker('setDate', null);
//     var trHTML = '<tr><td colspan="5"><center>NO RECORD FOUND</center></td></tr>';
//     $.ajax({
//         url: '<?php echo base_url('financial/transaction_category_list/') ?>'+category_id,
//         type:"GET", 
//         dataType: 'json',
//         success:function(result){
//         if(result.success == 'true'){
//             $('#userstatusdata tr:gt(1)').remove();

//              trHTML = '';
          
//             $.each(result.data, function (i, data) {
                  
//                 trHTML += '<tr><td>' + data.address + '</td><td>' + data.transaction_category_name + '<br><small>' + data.payment_type + '</small></td><td>' + data.status + '<br><small>' + data.date + '</small></td><td>' + data.amount + '</td><td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td></tr>';
//             });
              
//             $('#userstatusdata').append(trHTML);
              
//         }
//         else{
//              $('#userstatusdata tr:gt(1)').remove();
//              $('#userstatusdata').append(trHTML);
//           }
//         },
//           error: function (msg) {
//               alert(msg.responseText);
//           }
//     });

// });
//searchbydata();
function searchbydata(){
  var start_date =  $('#datepicker').val();
  var end_date   =  $('#datepicker1').val();
  var status     =  $('#select_tra_list').val();
  var category_id = $('#select_category_list').val();
  //alert(category_id);
  //alert(start_date);
 var trHTML = '<tr><td colspan="5"><center>NO RECORD FOUND</center></td></tr>';
   $.ajax({
        url: '<?php echo base_url('financial/search_by_tra_date_list/') ?>',
        type:"POST",
        data:{start_date:start_date,end_date:end_date,status:status,category_id:category_id},
        dataType: 'json',
        success:function(result){
        if(result.success == 'true'){
            $('#userstatusdata tr:gt(1)').remove();

             trHTML = '';
          
            $.each(result.data, function (i, data) {
                  
                if(data.payment_type == 1){
                  var payment  = 'One-time';
                }else{
                  var payment  = 'Recurring';
                } 
                // var amountData = [];
                if(data.payment_type == 2) {
                  $.each(data.paymentdata, function (i,paymentdata){
                   //alert(paymentdata.p_id);
                     trHTML += '<tr><td onclick="showTrascationRow('+data.id+')"><i class="fa fa-caret-right" aria-hidden="true"></i></td><td>' +data.group_name + ' Paid you<small><br>' + data.address +', Unit-'+ data.unit +'</td><td>' + data.category_show_name + '<br><small>' + payment + '</small></td><td><span class="'+data.status+'">' + data.status + '</span><br><small>' + data.start_date + '</small></td><td>$' + data.due_amount + '<br></td><td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td></tr><tr id="transaction_'+data.id+'" style="display:none;"><td></td><td colspan="5"><p>Payments</p><br><p>Succeeded  &nbsp&nbsp#'+data.id+'</p><p>$'+paymentdata.p_amount+' paid on '+paymentdata.p_date+'. Manual Override.</p></td></tr>';
                  });
                }else{
                   $.each(data.paymentdata, function (i,paymentdata){
                   //alert(paymentdata.p_id);
                     trHTML += '<tr><td onclick="showTrascationRow('+data.id+')"><i class="fa fa-caret-right" aria-hidden="true"></i></td><td>' +data.group_name + ' Paid you<small><br>' + data.address +', Unit-'+ data.unit +'</td><td>' + data.category_show_name + '<br><small>' + payment + '</small></td><td><span class="'+data.status+'">' + data.status + '</span><br><small>' + data.date + '</small></td><td>$' + data.paid_amount + '<br><small>'+ data.amount+'</small></td><td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td></tr><tr id="transaction_'+data.id+'" style="display:none;"><td></td><td colspan="5"><p>Payments</p><br><p>Succeeded  &nbsp&nbsp#'+data.id+'</p><p>$'+paymentdata.p_amount+' paid on '+paymentdata.p_date+'. Manual Override.</p></td></tr>';
                  });
                }
            });
              
            $('#userstatusdata').append(trHTML);     
        }
        else{
             $('#userstatusdata tr:gt(1)').remove();
             $('#userstatusdata').append(trHTML);
          }
        },
          error: function (msg) {
              alert(msg.responseText);
          }
    });
} 

function showTrascationRow(id)
{
  $("#transaction_"+id).toggle();
  // alert($("#transaction_"+id).text());

}
// function exportdata(){
//     var start_date =  $('#datepicker').val();
//     var end_date   =  $('#datepicker1').val();
//     var status     =  $('#select_tra_list').val();
//     var category_id = $('#select_category_list').val();

//     $.ajax({
//         url: '<?php echo base_url('financial/exportCSV/') ?>',
//         type:"POST",
//         data:{start_date:start_date,end_date:end_date,status:status,category_id:category_id},
//         //dataType: 'json',
//         success:function(result){
//          $.each(result, function (i, data) {
//               console.log(data);    
//           });
//         },
//           error: function (msg) {
//               alert(msg.responseText);
//           }
//     });
// }

$('#submit_data').on('submit' ,function( event ) {
    var start_date =  $('#datepicker').val();
    var end_date   =  $('#datepicker1').val();
    var status     =  $('#select_tra_list').val();
    var category_id = $('#select_category_list').val();
    $('#exp_status').val(status);
    $('#exp_category').val(category_id);
    $('#exp_start_date').val(start_date);
    $('#exp_end_date').val(end_date);
    return true;
});
</script>

  





