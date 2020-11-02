<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js" ></script> -->
<script>

function recurring_validation_check(){

  var x = document.forms["recurring_form"]["property_name"].value;
  var memo = document.forms["recurring_form"]["memo"].value;
  //alert(x);
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }else if(memo == "") {

    alert("Memo must be filled out");
    return false;
  
  }

  

return true;
}
function allLetter(inputtxt)
{ 
      var letters = /^[A-Za-z]+$/;
      if(inputtxt.value.match(letters))
      {
      //alert('Your name have accepted : you can try another');
      return true;
      }
      else
      {
      //var memo = document.forms["recurring_form"]["memo"].value = '';
      alert('Please alphabet characters only');
      return false;
      }
      //var memo = document.forms["recurring_form"]["memo"].value = '';
}

</script>
<style>
.error{
  color:red;
}
.money_switch {
    border: 2px solid #8199c1;
}
.money_in{
   background:#009688;
   color:#fff;
   border: 2px solid #009688 !important;
}

.money_out{
   background:#ff5722;
   color:#fff;
   border: 2px solid #ff5722 !important;
}
input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
     transform: scale(1.5);
     margin: 10px 10px;
}
</style>
  <form style="height: 600px;" class="popup_form_margin" name="recurring_form" onsubmit="return recurring_validation_check();" id="recurring_validation" target="_parent" action="<?php echo base_url('financial/recurring_data_save')?>" method="POST">
    <h4 class="modal-title add_recurring">Record Offline Transaction</h4>
          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 " >
                 <div class="form-group bmd-form-group is-filled">

                      <label for="address" class="bmd-label-floating">Property *</label>
                      <div class="select-wrapper">
                         <select  id="propertydata" name="property_name" class="form-control" onchange="showDiv('hidden_div', this)" required="">
                            <option value="">Pick a property</option>
                            <?php
                            foreach ($propertydatatenat as $property)
                             {?>
                               <option  value="<?php echo $property['id']?>"><?php echo $property['address']?></option>
                             <?php }
                                ?>
                         </select>
                         <span class="caret">▼</span>
                         <div id="property_error"></div>
                      </div>
                  </div>
              </div>
          <hr>

          <div class="form-group" id="payment_source" >
            <div class="row bottom">
              <!-- <h3 class="payment_source">Payment Source</h3> -->
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group ">
                  <label for="payment_source" id="payment_source_text" class="bmd-label-floating"><h3>Payment Source</h3></label><br>
                  <input type="radio" name="payment" value="tenants" checked>Tenants
                  <input type="radio" name="payment" value="team">Your Team
                  <input type="radio" name="payment" value="other"> Other
                </div>
              </div>
            </div>
          </div> 


          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 " >
                <div class="form-group ">
                   <label for="select_month_weekly" class="bmd-label-floating">Frequency *</label>
                   <div class="select-wrapper">
                    <select class="form-control" name="select_month_weekly" id="select_month_weekly">
                       <option value="monthly">Monthly</option>
                       <option value="weekly">Weekly</option>
                       
                    </select>
                    <span class="caret">▼</span>
                </div>
              </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
                <div class="form-group ">

                <div class="select-wrapper" style="display:none;" id="weekly_date">
                     <label for="weekly_date" class="bmd-label-floating">Due Day of Week *</label>
                     <select class="form-control" name="weekly_date" id="monthly_due_date">
                     <!-- <option value="all"></option> -->
                         <option value="monday">Monday</option>
                         <option value="tuesday">Tuesday</option>
                         <option value="wednesday">Wednesday</option>
                         <option value="thursday">Thursday</option>
                         <option value="friday">Friday</option>
                         <option value="saturday">Saturday</option>
                         <option value="sunday">Sunday</option>
                     </select>
                    <span class="caret">▼</span>
                </div>
              </div>
              </div>

            </div>
          </div>      

          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                <div class="form-group ">
                  <label for="memo" class="bmd-label-floating">Memo</label>
                  <input type="memo" id="memo" name="memo" class="memo form-control" onkeypress="allLetter(document.recurring_form.memo)">
                </div>
              </div>
            
            </div>
          </div>   
                
          <div class="form-group pull-right">
            <button type="submit" class="btn btn-primary btn-raised">RECORD</button>
            <button type='button' class="btn btn-default btn_cancle">CANCEL</button>
          </div>
  </form>
<script>
//   $(document).ready(function () {
//     function recurring_validation_check(){
// alert($('#propertydata').val());
// // var pro = $('#propertydata').val();
// // if(empty(pro) && pro == ''){
// //   alert('hello');
// // }
// //   if(empty($('#propertydata').val())){
// //    alert('Fill all field');
// //   return false;
// // }
// }
// });
    // $("#recurring_validation").validate({
          
    //        rules : {
    //           property_name : {
    //              required : true,
    //              normalizer: function(value) {
    //                          return $.trim(value);
    //              },   
    //           },
    //           category : {
    //              required : true,
    //              normalizer: function(value) {
    //                          return $.trim(value);
    //              },   
    //           },
    //           select_month_weekly : {
    //              required : true,   
    //           },
                              
    //           start_date : {
    //              required : true,   
    //           },
    //           end_date : {
    //              required : true,   
    //           },
    //           due_amount : {
    //              required : true,   
    //           },
    //           // auto_check : {
    //           //    required : true,   
    //           // },
    //           memo : {
    //              required : true,   
    //           },

    //        },
    //        messages : {
    //           property_name : {
    //              required : "Please Select Property",
            
    //           },
    //           category : {
    //              required : "Please Select Category",
            
    //           },
    //           select_month_weekly : {
    //              required : "Please Select Any One",   
    //           },
    //           // monthly_due_date : {
    //           //    required : "Please Select Paid Date",  
    //           // },
    //           start_date : {
    //              required : "Please Select Start Date",   
    //           },
    //           end_date : {
    //              required : "Please Select End Date",   
    //           },
    //           due_amount : {
    //              required : "Please Enter Due Amount",   
    //           },
    //           // auto_check : {
    //           //    required : true,   
    //           // },
    //           memo : {
    //              required : "Please Enter Memo",   
    //           },

    //        },
    //         submitHandler: function(form) {
    //           //alert('hello');
    //           $(form).submit();
    //         }
    //  });
      
</script>
<script>
   function showDiv(element)
   {
      document.getElementById('hidden_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';
  
   }
</script>
<script>

$("#maney_credit").click(function(){
    $("#payment_source").show();
    $("#money_in").addClass('money_in');
    $("#money_out").css('border', '2px solid #009688');
    $("#money_out").removeClass('money_out');
    $("#payment_source_text").html("<h3>Payment Source</h3>");
});
$("#maney_debit").click(function(){

    $("#payment_source").show();
    $("#money_out").addClass('money_out');
    $("#money_in").css('border', '2px solid #ff5722');
    $("#money_in").removeClass('money_in');
    $("#payment_source_text").html("<h3>Payment Destination</h3>");
});

$('input[name="payment"]').on('change',function(){

    var name = $('input[name="payment"]:checked').val();
    if(name === 'tenants'){
       $("#group_text").html("Tenant Group *");
       $("#tenant").show();
       $("#property_contacts").css('display', 'none');
       $("#other").css('display', 'none');
    }
    else if(name === 'team'){
        $("#group_text").html("Property Member *");
        $("#property_contacts").show();
        $("#tenant").css('display', 'none');
        $("#other").css('display', 'none');
      }
       else{
         $("#group_text").html("Other *");
         $("#other").show();
         $("#tenant").css('display', 'none');
         $("#property_contacts").css('display', 'none');
      }
  
});


$("#select_month_weekly").on('change', function() {

  var monthly_and_weekly = $("#select_month_weekly").val();

  if(monthly_and_weekly === 'monthly'){
    $("#weekly_date").css('display','none');
    $("#monthly_date").show();
  }else{
    $("#monthly_date").css('display','none');
    $("#weekly_date").show();
  }

});


 $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
 $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

</script>
           
  
 public function check(){
            
           $data['userdata'] =  $this->Request_model->getOwnerRequest();

        $data['propertyAllData'] = $this->property_model->getAllPropertyData();

        $propertydatatenat = $this->property_model->getPropertyDataTenant();
        
        $data['propertydatatenat'] = $propertydatatenat;
        // echo "<pre>";
        // print_r($data['propertydatatenat']);
        // //exit;

        $data['lat']= $this->config->item('latitude');

        $data['lng']= $this->config->item('longitude');

        $data['transaction_category']=$this->financial_model->getTransactionCategory();
        
        $data['tenantData']   = $this->team_model->getTenant();

        foreach ($data['propertyAllData'] as $key => $value) {
                 $property_id = $value['id'];

                $getTenantWithUnit = $this->financial_model->getAllTenantData($property_id);
                // echo "<pre>";
                // print_r($getTenantWithUnit);
                // $getalltenants = array();
            foreach ($getTenantWithUnit as $key => $tenantWithUnit) {
                // print_r($tenantWithUnit['id']);
              $getalltenants[$tenantWithUnit['id']]  = array('id'=>$tenantWithUnit['id'],'firstname'=>$tenantWithUnit['firstname']) ;
              
          }
        }
        // echo "<pre>";
        // print_r($getalltenants);
        $data['getalltenant'] = $getalltenants;


        $this->load->view('common/popup_header',$data);

        $this->load->view('recurring_view_check',$data);

        $this->load->view('common/popup_footer',$data);
        

      }