<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>      
      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css">
      <script type="text/javascript" src="<?php echo base_url()?>assets/iaoalert/js/iao-alert.jquery.min.js"></script>      
      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/iaoalert/css/iao-alert.min.css">
      <style type="text/css">
         .bg{
         width: 45% !important; 
         margin: auto !important;
         }
         .contnet-area{padding:0px !important;}
         .div_form{font-size: 19px !important;}
         .plans__subtitle{text-align: center;}
         .annually{font-size: 32px	;font-weight: 700; line-height: .62;letter-spacing: .5px;color: #517bbe; line-height: 64px !important;}
         .input_cls{    width: 20%;height: 43px;text-align: center;}
      </style>
   </head>
   <body>
      <div id="navbar" style="background-color: #27364f">
         <div >
            <center>
               <img  style='    max-width: 100%;' src='/assets/images/onelanelogo.png'>       <!--  <a href="javascript:void(0)" id="logo" style=" float: none;" class="text-center">Onelane</a> -->      
            </center>
         </div>
      </div>
<div  class="div_form" >
<div class="contnet-area">
<div class="container">
<div class="row bg">
<center>	
<div class="plans">
  <div class="plans__basic">
     <div class="plans__basic__top" style="margin-bottom: 48px;">
        <div class="plans__box">
           <div class="plans__subtitle">End-to-end leasing and<br>management software<br>&nbsp;</div>
           <div style="padding: 12px 25px 12px 22px;">
              </h2 class="plans__basic__top__price"><span class="annually cost">
              </span><span class="input"><span class="annually">$<?php echo $plan_details['unit_price']?>×</span><input id='unitalot' value="1" class="input_cls"><span class="annually">units</span></span></h2><span class="plans__basic__top__price__desc"><span class="annually">+ $<?php echo $plan_details['base_price']?> base</span></span>
              <h2 class="plans__basic__top__price bottom"><span class="rate" style="margin-top: 0px; margin-right: 0.5rem;color: #517bbe;">=</span><span class="annually annuallycost cost">$32</span><span class="rate annually">/month</span></h2>
           </div>
        </div>
        <div class="plans__hr"></div>
        <ul class="plans__list" style="text-align: left;padding-left: 8%;">
           <li><span>Rental Advertising</span></li>
           <li><span>Prospective Tenant Tracking</span></li>
           <li><span>Applications &amp; Screening</span></li>
           <li><span>Lease Management</span></li>
           <li><span>Financials &amp; Online Rent</span></li>
           <li><span>Maintenance </span></li>
        </ul>
     </div>
     <div class="plans__basic__bottom">
        <div class="plans__basic__bottom__buttons">
           <form action="<?php echo base_url('owner/subscriptions_prompt_next')?>" method="POST">
            <input type="hidden" id="perunitprice" name="perunitprice" value="<?php echo $plan_details['unit_price']?>">
              <input id='baseprice' name="baseprice" type='hidden' value="<?php echo $plan_details['base_price']?>">
              <input type="hidden" name="trialunitamount" id="trialunitamount">
              <input type="hidden" name="trialunit" id="trialunit" value="1">
              <button type="sybmit" style="border-color: #d33659;
                 background-color: #d33659;
                 color: #fff;
                 outline: none;" class="btn btn-primary">Try for free</button>
           </form>
        </div>
        <a href="#pricing-packages-section" class="plans__basic__bottom__features">Compare and view features</a>
     </div>
  </div>
</div>
</center>
</div>
</div>
</div>
         <script type="text/javascript">
            var unitAlot = parseInt($('#perunitprice').val());
            var baseprice = parseInt($('#baseprice').val());
            var totalUnit=(unitAlot*1)+baseprice;
            $('#trialunitamount').val(totalUnit);
            $('.annuallycost').html('').html('$'+totalUnit);
            var totalUnits=$('#unitalot').val()
            $('#trialunit').val(totalUnits);
            
            
            $('#unitalot').on('keyup',function(){
            	var unit = $(this).val();
            	if(unit>0)
            	{
            		//alert(unit);
            		var unit = parseInt(unit);
            		var baseprice = parseInt($('#baseprice').val());
            		var totalUnit=(unitAlot*unit)+baseprice;	
            
            		//alert(totalUnit);
            		$('.annuallycost').html('').html('$'+totalUnit);
            		$('#trialunitamount').val(totalUnit);
            		$('#trialunit').val(unit);
            	}
            });
         </script>         
      </div>
      <footer class="footer_back">
         <div class="container container_width">
            <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last" >© Onelane, Inc. 2019</p>
         </div>
      </footer>
      <script>         window.onscroll = function() {scrollFunction()};                  function scrollFunction() {           if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {             document.getElementById("navbar").style.padding = "15px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "#27364f";           } else {             document.getElementById("navbar").style.padding = "18px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "#27364f";           }         }        var  errMsg = '<?php echo $this->session->flashdata('error_msg')?>';        if(errMsg)        {            $.iaoAlert({msg: "Either Email/Password Wrong! <br> Or Your Account is Inactive!",            type: "error",            mode: "dark",})        }   
         var  successMsg = '<?php echo $this->session->flashdata('success_msg'); ?>'; 
         var  success_msg_forgotpass = '<?php echo $this->session->flashdata('success_msg_forgotpass'); ?>'; 
         var  success_msg_forgotpass_success = '<?php echo $this->session->flashdata('success_msg_forgotpass_success'); ?>'; 
         
         if(success_msg_forgotpass_success)
         {
             $.iaoAlert({msg: success_msg_forgotpass_success,        
          	    type: "success",            mode: "dark",})  
         }
         
          if(successMsg)        
          	{            
          	$.iaoAlert({msg: "Check Your Email Inbox, we sent an email!",        
          	    type: "success",            mode: "dark",})   
             }
             if(success_msg_forgotpass)
             {
                 $.iaoAlert({msg: success_msg_forgotpass,        
          	    type: "error",            mode: "dark",})  
             }
             
         
         var  signUpMsg = '<?php echo $this->session->flashdata('sign_up_msg');  ?>';       
          if(signUpMsg)        
          	{            
          	$.iaoAlert({msg: "Your Account is Active",            
          		type: "success",            mode: "dark",})   
             }    
      </script>   
   </body>
</html>