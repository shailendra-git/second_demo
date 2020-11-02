<!DOCTYPE html>



<html>



   <head>



      <meta name="viewport" content="width=device-width, initial-scale=1">



      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">



      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css"> 



      <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>

       <script src="https://www.google.com/recaptcha/api.js" async defer></script>


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


   </head>



   <body>



   

<div id="navbar" style="background-color: #27364f">

      <div>

         <center>        <img  style='    max-width: 100%;' src='/assets/images/onelanelogo.png'>       <!--  <a href="javascript:void(0)" id="logo" style=" float: none;" class="text-center">Onelane</a> -->      </center>  

          </div>

      </div>



      


      <div  class="div_form" >



         <h3 class="text-center login">SIGN UP</h3>



         <form method="post" onsubmit="return addcheckRegisterValidation()" action="<?php echo base_url('auth/signup')?>" class="form_center2">



            



            <div class="row ">

              <div class="col-md-12">
                 <ul class="list-inline" style="text-align: center;">
                   
                   <li class="list-inline-item"> <a href="<?php echo $google_login_btn;  ?>"><img src="<?php echo base_url('assets/images/go_icon.png')?>" class="google_view"></a></li>
                   <li class="list-inline-item"><a class="loginBtn loginBtn--facebook" id="test">
                   <img src="<?php echo base_url('assets/images/facebook.png')?>" class="facebook_view"></a></li>
                 </ul>
               </div>




               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  First Name *</label>



                  <input type="text" class="form-control input_border" name="firstname" placeholder="Firstname" required="" value="<?php if(!empty($firstname)) { echo $firstname; }else{ ''; } ?>">



               </div>



                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  Last Name *</label>



                  <input type="text" class="form-control input_border" name="lastname" placeholder="Lastname" required="" value="<?php if(!empty($lastname)) { echo $lastname; }else{ ''; } ?>">



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >



                  <label > Company Name </label>



                  <input type="text" class="form-control input_border" name="company_name" placeholder="Company Name (Optional)" >



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >Email *</label>



                  <input type="email" name="email" class="form-control input_border" id="addEmail" required=""  placeholder="example@gmail.com" autocomplete="off" value="<?php if(!empty($email)) { echo $email; }else{ ''; } ?>">



                   <div id="myEmailValid" style="display: none; color: red; font-size: 16px;">



                  Please provide a valid email address.



                </div>



                <div id="myEmail" style="display: none; color: red; font-size: 16px;">



                                    Email already exists.



                                    </div>



                  



               </div>



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  Phone Number </label>



                  <input type="text" class="form-control input_border" placeholder="Phone Number (Optional)" name="mobile" minlength="10">



               </div>



            </div>
            
           




            <div class="row ">



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >Password *</label>



                  <input type="password" class="form-control input_border"  placeholder=" password" minlength="8"  name="password" id="password" required="">



               </div>



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label > Confirm Password *</label>



                  <input type="password" class="form-control input_border"  placeholder=" Confirm Password " minlength="8" id="confirm_password" name="confirm_password" required="">



                  <div id="mychackDIV" style="display: none; color: red; font-size: 16px;">



                  Your password Not matching.



                </div>



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >



                  <label >How did you hear about us? (Optional)</label>



                  <textarea class="form-control input_border" placeholder="Send Your Message" name="user_referral_comments"></textarea>



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >



                  <p class="font_p ">



                     By clicking "Register" below, I accept the <a href="https://onelane.com.au/terms-of-use/" target="_blank">Terms of Service</a>. Your <a href="https://onelane.com.au/privacy-policy/" target="_blank">privacy</a> is protected.



                  </p>



               </div>



            </div>

            <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="6Leu-rEZAAAAAAsQoxSpoTWb40qyoNFxIiqc86Fx"></div>
             



             <div class=" signup_padding_media" >



               



            



               <!-- <a href="<?php echo base_url('auth/signin')?>" class="clr_signuplink"> Log in</a> -->
              
              <div class="row">
                  <div class="col-md-4">
                   <button type="submit" id="submit" class="btn_login btn_team_edit_save">REGISTER</button>
                   <!-- <button type='submit' class="btn_login btn_login_view" style="z-index:999;">LOGIN</button> -->
                  </div>
                  <div class="col-md-8">
               <a href="<?php echo base_url('auth/signin')?>" class="clr_signuplink"> Log in</a>
                  </div>
                </div>


            </div>
            <br>
            <?php if(!empty($statusMsg)){ ?>
              <h6 class="status-msg <?php echo $status; ?> text-danger"><?php echo $statusMsg; ?></h6>
              <?php } ?>

         </form>

      </div>



      <!-- content end -->



      <!-- footer start -->



      <footer class="footer_back">



         <div class="container container_width">



                     <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last" >© Onelane, Inc. <?php echo  date(Y) ?></p>



           



         </div>



      </footer>



      <!-- footer end -->



 <!--      <script>



         // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size



         window.onscroll = function() {scrollFunction()};



         



         function scrollFunction() {



           if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {



             document.getElementById("navbar").style.padding = "15px ";



             document.getElementById("logo").style.fontSize = "25px";



              document.getElementById("navbar").style.backgroundColor = "rgba(255,255,255,0.8)";



           } else {



             document.getElementById("navbar").style.padding = "37px ";



             document.getElementById("logo").style.fontSize = "25px";



              document.getElementById("navbar").style.backgroundColor = "transparent";



           }



         }



      </script> -->







      <script type="text/javascript">



         



         $(document).ready(function(){  



        



           $("#addEmail").change(function()  



              {  



                  // alert('123456');



                  var email = document.getElementById('addEmail');



                  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;



                  // alert (123454566776);







                  if (!filter.test(email.value)) 



                {



                     $("#myEmailValid").show();



                     email.focus;



                     return false;



                  }



                  else



                  {



                     // alert(47236784623786);



                  $.ajax({



                   type: "POST",



                   url: "/auth/addCheckRegisterEmailExists", 



                   data: {email: $("#addEmail").val()},



                   cache:false,



                   success: function(data){



                          // alert(data);  //as a debugging message.




                        // console.log(data);


                          if(data == 1)



                         {



                           $("#myEmail").show();



                           $(".btn_team_edit_save").attr("disabled", true);



                          return false;



                         }



                          $("#myEmail").hide();



                          $(".btn_team_edit_save").attr("disabled", false);



                          return true;



                        }



                    });// you have missed this bracket



                  $("#myEmailValid").hide();



                     return true;



                 }
           });

       });


      </script>



      <script type="text/javascript">



         



         function addRegisterValidation() {    



               // chackbox filed chacked



                var chack = ($('#password').val() == $('#confirm_password').val());



                 // alert(123345566);



                if(chack == null || chack == "")



                 {



                  // alert(123456);



                   $("#mychackDIV").show();



                  return false;



                 }



                 // alert(46562346);



                return true;



            } 



      </script>
<script>
   function addcheckRegisterValidation(){
     
      var response = grecaptcha.getResponse();
      //alert(response);

       if(response == ''){
          alert("Please check reChaptcha");
           return false;
       }

    return true;

  }
</script>
<!-- Start of onelane Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=7360335e-5477-461d-8d26-fe12af86d0ff"> </script>
<!-- End of onelane Zendesk Widget script -->



<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<script type="text/javascript">
// $(document).ready(function(){)
  // document.getElementById('test').css('cursor', 'pointer');
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
       //   statusChangeCallback(response);        // Returns the login status.
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