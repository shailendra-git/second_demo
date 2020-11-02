<!DOCTYPE html><html>  
 <head>      
 	<meta name="viewport" content="width=device-width, initial-scale=1">      
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">     
 	 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">     
 	   <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>
 	         <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css">
 	       <script type="text/javascript" src="<?php echo base_url()?>assets/iaoalert/js/iao-alert.jquery.min.js"></script>      
 	       <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/iaoalert/css/iao-alert.min.css"> 
 	        
 	          <!-- Global site tag (gtag.js) - Google Analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172120863-1"></script>
				<script>
				  window.dataLayer = window.dataLayer || [];
				  function gtag(){dataLayer.push(arguments);}
				  gtag('js', new Date());

				  gtag('config', 'UA-172120863-1');
				</script>
               
               <!-- Global site tag (gtag.js) - Google Ads: 611941517 -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=AW-611941517"></script>
				<script>
				  window.dataLayer = window.dataLayer || [];
				  function gtag(){dataLayer.push(arguments);}
				  gtag('js', new Date());

				  gtag('config', 'AW-611941517');
				</script>

				<script>
				window.addEventListener('load',function(){ 
				if(window.location.href.indexOf('https://app.onelane.com.au/auth/thankYou')>-1){
				 gtag('event', 'conversion', {'send_to': 'AW-611941517/CSK7CP_Rtt4BEI355aMC'});
				}
				}) 
				</script>
                



 	         </head>   <body>      <div id="navbar" style="background-color: #27364f">      
 	         <div >        
 	         	<center>   
 	         	<img style='    max-width: 100%;' src='<?php echo base_url()?>assets/images/Onelane-Logo-240x90-white.png'>        
 	         	<!-- 	<img  style='width:83px;height:74px' src='//dqxenvn30vw3w.cloudfront.net/assets/icons/small/logo-transparent-white-2062efea380013c022b1a9ed984401f4.png'>     
 	         		   <a href="javascript:void(0)" id="logo" style=" float: none;" class="text-center">Onelane</a>  -->    
 	         		    </center>          
 	         		</div>      
 	         	</div>           
 	         	<div  class="div_form" style="margin-top: 90px; margin-bottom: 90px;">  
 	         	       <h3 class="text-center login">FORGOT YOUR PASSWORD?</h3>         <form action="<?php echo base_url('auth/check_forgotemail_and_sendemail')?>" class="form_center"          method='POST'>            <div class="form-group">               <label >Email:</label>            <input type="hidden" name="email_type" value="">            <input type="email" name="email" class="form-control input_border" placeholder="youremail@email.com" autocomplete="off" >            </div>            <button type="submit" href="" class="btn_login ">Send reset password instructions</button>                       <div  class="signup_padding_media">               <a href="<?php echo base_url('auth/signin')?>" class="clr_signuplink">Log in</a>               <a href="<?php echo base_url('auth/signup')?>" class="clr_signuplink"> Sign up</a>            </div>                </form>      </div>      <footer class="footer_back">         <div class="container container_width">                     <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last" >© Onelane, Inc.  <?php echo  date(Y) ?></p>                    </div>      </footer>         <script>                window.onscroll = function() {scrollFunction()};                  function scrollFunction() {           if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {             document.getElementById("navbar").style.padding = "15px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "rgba(255,255,255,0.8)";           } else {             document.getElementById("navbar").style.padding = "37px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "transparent";           }         }         var  errMsg = '<?php echo $this->session->flashdata('error_msg')?>';         var  success_msg = '<?php echo $this->session->flashdata('success_msg')?>';                 if(errMsg)        {            $.iaoAlert({msg: "Email not found!",            type: "error",            mode: "dark",})        }        else if(success_msg)        {              $.iaoAlert({msg: "Check Your Email Inbox, we sent an email!",            type: "success",            mode: "dark",})        }        console.log('======='+errMsg);      </script>   </body></html>