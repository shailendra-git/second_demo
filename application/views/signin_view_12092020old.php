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
 
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172120863-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-172120863-1');
</script>

</head>

<body>

    <div id="navbar" style="background-color: #27364f">
        <div>
            <center> <img style='max-width: 100%;'  id="logo"  src='<?php echo base_url()?>assets/images/onelanelogo.png'>
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
           <div class="row">
                <div class="col-md-4">
                 <button type='submit' class="btn_login btn_login_view" style="z-index:999;">LOGIN</button>
                </div>
                <div class="col-md-8">
                 <ul class="list-inline">
                  <li class="list-inline-item inline-item_view"><h5 class="head5">Or sign up with</h5></li>
                  <li class="list-inline-item"> <a href="<?php echo $google_login_btn;  ?>"><img src="<?php echo base_url('assets/images/go_icon.png')?>" class="google_view"></a></li>
                  <li class="list-inline-item"><a class="loginBtn loginBtn--facebook" id="test">
                  <img src="<?php echo base_url('assets/images/facebook-logo.jpg')?>" class="facebook_view"></a></li>
                </ul>
                </div>
              </div>
            <div class=" signup_padding_media"> <a href="<?php echo base_url('auth/signup')?>" class="clr_signuplink text-left">Sign up</a> <a href="<?php echo base_url('auth/forgotpassword')?>" class="clr_signuplink text-left">Forgot your password?</a> </div>
             
        </form>
    </div>
    <footer class="footer_back">
        <div class="container container_width">
            <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last">© Onelane, Inc.  <?php echo  date(Y) ?></p>
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
        var errMsg = '<?php echo $this->session->flashdata('error_msg')?>';
        if (errMsg) {
            $.iaoAlert({
                msg: "Either Email/Password Wrong! <br> Or Your Account is Inactive!",
                type: "error",
                mode: "dark",
            })
        }
        var successMsg = '<?php echo $this->session->flashdata('success_msg'); ?>';
        var success_msg_forgotpass = '<?php echo $this->session->flashdata('success_msg_forgotpass'); ?>';
        var success_msg_forgotpass_success = '<?php echo $this->session->flashdata('success_msg_forgotpass_success'); ?>';

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

        var signUpMsg = '<?php echo $this->session->flashdata('sign_up_msg');  ?>';
        if (signUpMsg) {
            $.iaoAlert({
                msg: "Your Account is Active",
                type: "success",
                mode: "dark",
            })
        }
    </script>

    <!-- Start of onelane Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=7360335e-5477-461d-8d26-fe12af86d0ff"> </script>
<!-- End of onelane Zendesk Widget script -->

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<script type="text/javascript">
// $(document).ready(function(){)
    document.getElementById('test').addEventListener('click', function() {
      //do the login
        FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
    }, false); 
        


    function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
        console.log('statusChangeCallback');
        console.log(response);                   // The current login status of the person.
        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
          testAPI();  
        } else {                                 // Not logged into your webpage or we are unable to tell.
          document.getElementById('status').innerHTML = 'Please log ' +
            'into this webpage.';
        }
      }

      function checkLoginState() {               // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function(response) {   // See the onlogin handler
          statusChangeCallback(response);
        });
      }


      window.fbAsyncInit = function() {
        FB.init({
          appId      : '334193920567731',
          cookie     : true,                     // Enable cookies to allow the server to access the session.
          xfbml      : true,                     // Parse social plugins on this webpage.
          version    : 'v7.0'           // Use this Graph API version for this call.
        });


        FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
          statusChangeCallback(response);        // Returns the login status.
        });
      };
     
      function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=id,first_name,last_name,email,locale,picture', function(response) {
          console.log('data ',response);


          console.log('Successful login for: ' + response.name);

           
           //window.parent.location = '/auth/facebook_login_url?fb_id='+response.id+'&email='+response.email+'&first_name='+response.first_name+'&last_name='+response.last_name+'&gender='+response.gender;
           window.parent.location = '/auth/facebook_login_url?fb_id='+response.id+'&email='+response.email+'&first_name='+response.first_name+'&last_name='+response.last_name+'&gender='+response.gender;
          // document.getElementById('status').innerHTML =
          //   'Thanks for logging in, ' + response.name + '!';

        });
      }


</script>
</body>

</html>