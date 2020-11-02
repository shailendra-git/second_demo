<?php
 $financial_id = $this->session->userdata('financial_id');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
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
  <form style="height: 600px;" class="popup_form_margin" id="transaction_validation" target="_parent" action="<?php echo base_url('financial/one_time_data_save')?>" method="POST">
    <h4 class="modal-title add_transaction">Record Offline Transaction</h4>
          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 " >
                 <div class="form-group bmd-form-group is-filled">

                      <label for="address" class="bmd-label-floating">Property *</label>
                      <div class="select-wrapper">
                         <select  id="financialpropertydata" name="property_id" class="form-control" onchange="showDiv('hidden_div', this)" required="">
                              <?php
                              if(!empty($financial_id)){
                                $property_select = $this->financial_model->getPropertyDataTenantSelect($financial_id);
                                //print_r($property_select['address']);
                                ?>
                                <option value="<?php echo $property_select['id']?>"><?php echo $property_select['address']; ?></option>
                                <?php
                              }else{
                                ?>
                                <option value="">All Properties</option>;
                                <?php
                              }
                            ?>
                            <?php
                            foreach ($propertydatatenat as $property)
                             {?>
                               <option  value="<?php echo $property['id']?>"><?php echo $property['address']?></option>
                             <?php }
                                ?>
                         </select>
                         <span class="caret">▼</span>
                      </div>
                  </div>
              </div>
              
             <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 " id="hidden_div" style="display:none;">
              <div class="form-group bmd-form-group is-filled"  >
                <label for="address" class="bmd-label-floating">Unit *</label>
                <div class="select-wrapper">
                   <select  id="mySelect1" name="unit_id" class="form-control" required="" >
                   
                  </select> 
                  <span class="caret">▼</span>
                </div>
                 <div  id="uniterror" style="display:none; color:red;">This property do not  have any unit</div> 
              </div>
             </div>

          <?php
            if($financial_id == 0){
              
            }else{
           ?>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 ">
              <div class="form-group bmd-form-group is-filled" id="unit_hide"  >
                <label for="address" class="bmd-label-floating">Unit *</label>
                <div class="select-wrapper">
                   <select  id="unit" name="unit_id" class="form-control" required="" >
                    <?php
                        foreach ($combineUnits as $unit)
                        {?>
                        <option  value="<?php echo $unit['id']; ?>"><?php echo $unit['unit']?></option>
                            
                        <?php }
                        ?>
                  </select> 
                  <span class="caret">▼</span>
                </div>
              </div>
              <?php if(!empty($combineUnits)){?>
                 <div  id="uniterror1" style="display:none; color:red;">This property do not  have any unit</div> 
                <?php
              }else{
              ?>
                 <div  id="uniterror1" style="color:red;">This property do not  have any unit</div> 
              <?php
              }
              ?>
             </div>
             <?php
           }
           ?>
             
            </div>
           </div>   
          <hr>
   

          <!-- <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                <div>
                  <label><center><h1>Was this transaction from or to your account?</h1></center></label><br>
                </div>
              </div>
            
            </div>
          </div> -->

          <div class="form-group">
            <div style="text-align: center;"><h1>Was this transaction from or to your account?</h1></div>
            <div class="row bottom">
             
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 "  style="padding-right: 0px; padding-left: 0px;" >
                <div class="form-group ">
                    <div class="money_switch money_in" id="money_in">
                      <center>
                        <input type="radio" value="credit" name="money" checked=""  id="maney_credit"><h6>TO</h6>
                        <div>( MONEY IN )</div>
                      </center>
                    </div>
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12"  style="padding-right: 0px; padding-left: 0px;" >
                <div class="form-group ">
                  <div class="money_switch" id="money_out">
                      <center>
                        <input type="radio" value="debit" name="money"  id="maney_debit"><h6>FROM</h6>
                        <div>( MONEY OUT )</div>
                      </center>
                    </div>
                </div>
              </div>

            </div>
          </div>    

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

            <div class="row bottom">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group ">
                  
                  <label for="group_data" id="group_text" class="bmd-label-floating">Tenant Group *</label><br>

                   <div class="select-wrapper" id="tenant" >
                   <select class="form-control" name="tenant">
                  <?php
                    foreach ($getalltenant as $key => $alltenant) {
                  ?>  
                      <option value="<?php echo $alltenant['firstname']; ?>"><?php echo $alltenant['firstname'] ?></option>
                  <?php
                    }
                  ?>
                   </select>
                   <span class="caret">▼</span>
                   </div>
                 

                  <div class="select-wrapper" id="property_contacts" style="display:none;">
                   <select class="form-control" name="team" >
                     <?php
                    foreach ($tenantData as $key => $teams) {
                  ?>
                      <option value="<?php echo $teams['firstname'] ?>"><?php echo $teams['firstname'] ?></option>
                  <?php
                    }
                  ?>
                    <!--   <option value="">Select a property member :</option>
                       <option  value="">shailendra</option> -->
                   </select>
                   <span class="caret">▼</span>
                   </div>
                   <div class="select-wrapper" id="other" style="display:none;">
                    <input type="text" class="form-control" name="other">
                   </div>
                </div>
              </div>
            
            </div>

          </div>   

          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 " >
                <label for="category" class="bmd-label-floating">Category *</label>
                <div class="select-wrapper">
                  <select name="category" class="form-control" >
                    <?php
                     foreach ($transaction_category as $category) {
                     ?>
                     <option  value="<?php echo $category['id'];?>"><?php
                     echo $category['category_show_name'];
                     ?></option>
                             <?php
                     }
                     ?>
                  </select> 
                  <span class="caret">▼</span>
                </div>
              </div>
            
            </div>
          </div>   

          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
                <div class="form-group">
                  <label for="due_date " class="bmd-label-floating">Due Date *</label>
                  <input type="text" name="due_date" class="form-control" id="due_date" placeholder="YYYY-MM-DD" autocomplete="off">
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
                <div class="form-group ">
                  <label for="paid_date" class="bmd-label-floating">Paid Date (leave blank if same as due date)</label>
                  <input type="text" name="paid_date" class="form-control"   id="paid_date" placeholder="YYYY-MM-DD" autocomplete="off">
                </div>
              </div>

            </div>
          </div>   

          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 " >
                <div class="form-group ">
                  <label for="total_amount" class="bmd-label-floating">Total Amount *</label>
                  <input type="text" name="total_amount" id="total_amount" class="form-control"  placeholder="$ e.g. 123.45">
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12" >
                <div class="form-group ">
                  <label for="paid_amount" class="bmd-label-floating">Paid Amount</label>
                  <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="$ e.g. 123.45">
                  <div id="check_amount" style="color:red;"></div>
                </div>
              </div>

            </div>
          </div>   

          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                <div class="form-group ">
                  <label for="demotext" class="bmd-label-floating">Paid amount: Enter a number less than total amount to receive payment reminders. Blank defaults to $0.</label>
                  <!-- <input type="category" name="category" class="form-control" id="pac-input" placeholder="Select category"> -->
                </div>
              </div>
            
            </div>
          </div>   
          
          <div class="form-group">
            <div class="row bottom">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                <div class="form-group ">
                  <label for="memo" class="bmd-label-floating">Memo</label>
                  <input type="text" name="memo" class="form-control">
                </div>
              </div>
            
            </div>
          </div>   
          
                
          <div class="form-group pull-right">
            <button type="submit" class="btn btn-primary btn-raised">RECORD</button>
            <button type='button' class="btn btn-default btn_cancle">CANCEL</button>
          </div>
  </form>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<script>
$.validator.addMethod('greaterThan', function (value, element, param) {
return this.optional(element) || parseInt(value) <= parseInt($(param).val());
}, 'Invalid value');
    $("#transaction_validation").validate({
          
           rules : {
              property_id : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
              category : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
              due_date : {
                 required : true,   
              },
              paid_date : {
                 required : true,  
              },
              total_amount : {
                 required : true,
                 number: true,   
              },
              paid_amount : {
                 required: true,
                 number: true, 
                 greaterThan: "#total_amount",
              }, 
              memo : {
                 required : true, 
                 normalizer: function(value) {
                             return $.trim(value);
                 },     
              },
           },
           messages : {
              property_id : {
                 required : "Please Select Property",
            
              },
              category : {
                 required : "Please Select Category",
            
              },
              due_date : {
                 required : "Please Select Due Date",   
              },
              paid_date : {
                 required : "Please Select Paid Date",  
              },
              total_amount : {
                 required : "Please Enter Amount",   
              },
              paid_amount : {
                 required : "Please Enter Paid Amount",  
              },
              memo : {
                 required : "Please Enter Memo",   
              },

           },
            submitHandler: function(form) {
              //alert('hello');
              $(form).submit();
            }
     });  
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

// function isNumberKey(evt){
//     var charCode = (evt.which) ? evt.which : event.keyCode
//     if (charCode > 31 && (charCode < 48 || charCode > 57))
//         return false;
//     return true;
// }

$("#total_amount ,#paid_amount").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
 });

 $( "#paid_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
 $( "#due_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

</script>

  
