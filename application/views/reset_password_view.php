<!DOCTYPE html><html>   <head>      <meta name="viewport" content="width=device-width, initial-scale=1">      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">       <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css">                 <script type="text/javascript" src="<?php echo base_url()?>assets/iaoalert/js/iao-alert.jquery.min.js"></script>      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/iaoalert/css/iao-alert.min.css">   </head>   <body>      <div id="navbar" style="background-color: #27364f">      <div >        <center>        <img  style='width:83px;height:74px' src='//dqxenvn30vw3w.cloudfront.net/assets/icons/small/logo-transparent-white-2062efea380013c022b1a9ed984401f4.png'>        <a href="javascript:void(0)" id="logo" style=" float: none;" class="text-center">Onelane</a>      </center>          </div>      </div>           <div  class="div_form" style="margin-top: 90px; margin-bottom: 90px;">         <h3 class="text-center login">Reset Password</h3>         <form action="<?php echo base_url('auth/reset_new_password')?>" class="form_center"          method='POST' onSubmit="return validateData()">           
<div class="form-group">               <label >New Password:</label>            <input type="hidden" name="userid" value="<?php echo $enc_user_id?>">            <input type="password" name="newpassword" id="newpassword" class="form-control input_border" placeholder="New Password" autocomplete="off" >            </div>
<div class="form-group">               <label >Confirm Password:</label>                        <input type="password" name="conpassword" id="conpassword" class="form-control input_border" placeholder="Confirm Password" autocomplete="off" >            </div>
<button type="submit" href="" class="btn_login ">Change Password</button>                       <div  class="signup_padding_media">               <a href="<?php echo base_url('auth/signin')?>" class="clr_signuplink">Log in</a>               <a href="<?php echo base_url('auth/signup')?>" class="clr_signuplink"> Sign up</a>            </div>                </form>      </div>      <footer class="footer_back">         <div class="container container_width">                     <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last" >© Onelane, Inc. 2019</p>                    </div>      </footer>         <script>                window.onscroll = function() {scrollFunction()};                  function scrollFunction() {           if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {             document.getElementById("navbar").style.padding = "15px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "rgba(255,255,255,0.8)";           } else {             document.getElementById("navbar").style.padding = "37px ";             document.getElementById("logo").style.fontSize = "25px";              document.getElementById("navbar").style.backgroundColor = "transparent";           }         }         var  errMsg = '<?php echo $this->session->flashdata('error_msg')?>';         var  success_msg = '<?php echo $this->session->flashdata('success_msg')?>';                 if(errMsg)        {            $.iaoAlert({msg: "Email not found!",            type: "error",            mode: "dark",})        }        else if(success_msg)        {              $.iaoAlert({msg: "Check Your Email Inbox, we sent an email!",            type: "success",            mode: "dark",})        }        console.log('======='+errMsg);      </script>  
<script>
    function validateData()
    {
        var pass = document.getElementById('newpassword').value;
        var conpass = document.getElementById('conpassword').value;
        if(typeof pass == 'undefined' || pass == '')
        {
            alert('Password is empty');
            return false
        }
        if(typeof conpass == 'undefined' || conpass == '')
        {
            alert('Confirm Password is empty');
            return false
        }
        
        if(pass != conpass)
        {
            alert('Password and Confirm not matched');
            return false    
        }
        
        if(pass.length < 8)
        {
            alert('Password should be 8 characters long');
            return false
        }
        return true;
    }
</script>
</body></html>