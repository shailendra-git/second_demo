<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css">
    <script type="text/javascript" src="<?php echo base_url()?>assets/iaoalert/js/iao-alert.jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/iaoalert/css/iao-alert.min.css"> </head>

<body>
    <div id="navbar" style="background-color: #27364f">
        <div>
            <center> <img style='    max-width: 100%;' src='/assets/images/onelanelogo.png'>
                <!--  <a href="javascript:void(0)" id="logo" style=" float: none;" class="text-center">Onelane</a> --></center>
        </div>
    </div>

  
  
    <div class="div_form">
        <form action='<?php echo base_url("auth/signin")?>' method='POST' class="form_center" autocomplete='off'>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control input_border" name='email' placeholder="email@example.com"> </div>
                <span><?php echo validation_errors();?></span>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control input_border" name='password' placeholder="Password"> </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me</label>
            </div>
            <button type='submit' class="btn_login ">LOGIN</button>
            <div class=" signup_padding_media"> <a href="<?php echo base_url('auth/signup')?>" class="clr_signuplink text-left">Sign up</a> <a href="<?php echo base_url('auth/forgotpassword')?>" class="clr_signuplink text-left">Forgot your password?</a> </div>
        </form>
    </div>
    <footer class="footer_back">
        <div class="container container_width">
            <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last">© Onelane, Inc. 2019</p>
        </div>
    </footer>
    <script>
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                document.getElementById("navbar").style.padding = "15px ";
                document.getElementById("logo").style.fontSize = "25px";
                document.getElementById("navbar").style.backgroundColor = "#27364f";
            } else {
                document.getElementById("navbar").style.padding = "18px ";
                document.getElementById("logo").style.fontSize = "25px";
                document.getElementById("navbar").style.backgroundColor = "#27364f";
            }
        }
        var errMsg = '<?php echo $this->session->flashdata('
        error_msg ')?>';
        if (errMsg) {
            $.iaoAlert({
                msg: "Either Email/Password Wrong! <br> Or Your Account is Inactive!",
                type: "error",
                mode: "dark",
            })
        }
        var successMsg = '<?php echo $this->session->flashdata('
        success_msg '); ?>';
        var success_msg_forgotpass = '<?php echo $this->session->flashdata('
        success_msg_forgotpass '); ?>';
        var success_msg_forgotpass_success = '<?php echo $this->session->flashdata('
        success_msg_forgotpass_success '); ?>';

        if (success_msg_forgotpass_success) {
            $.iaoAlert({
                msg: success_msg_forgotpass_success,
                type: "success",
                mode: "dark",
            })
        }

        if (successMsg) {
            $.iaoAlert({
                msg: "Check Your Email Inbox, we sent an email!",
                type: "success",
                mode: "dark",
            })
        }
        if (success_msg_forgotpass) {
            $.iaoAlert({
                msg: success_msg_forgotpass,
                type: "error",
                mode: "dark",
            })
        }

        var signUpMsg = '<?php echo $this->session->flashdata('
        sign_up_msg ');  ?>';
        if (signUpMsg) {
            $.iaoAlert({
                msg: "Your Account is Active",
                type: "success",
                mode: "dark",
            })
        }
    </script>
</body>

</html>