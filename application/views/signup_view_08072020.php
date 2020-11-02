<!DOCTYPE html>



<html>



   <head>



      <meta name="viewport" content="width=device-width, initial-scale=1">



      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">



      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



      <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css"> 



      <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-3.1.1.js"></script>



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



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  First Name *</label>



                  <input type="text" class="form-control input_border" name="firstname" placeholder="Firstname" required="">



               </div>



                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  Last Name *</label>



                  <input type="text" class="form-control input_border" name="lastname" placeholder="Lastname" required="">



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >



                  <label > Company Name *</label>



                  <input type="text" class="form-control input_border" name="company_name" placeholder="Company Name" required="">



               </div>



            </div>



            <div class="row ">



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >Email *</label>



                  <input type="email" name="email" class="form-control input_border" id="addEmail" required=""  placeholder="example@gmail.com" autocomplete="off">



                   <div id="myEmailValid" style="display: none; color: red; font-size: 16px;">



                  Please provide a valid email address.



                </div>



                <div id="myEmail" style="display: none; color: red; font-size: 16px;">



                                    Email already exists.



                                    </div>



                  



               </div>



               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >



                  <label >  Phone Number *</label>



                  <input type="text" class="form-control input_border" placeholder="Phone Number" name="mobile" minlength="10" required="">



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



                     By clicking "Register" below, I accept the <a href="#" target="_blank">Terms of Service</a>. Your <a href="#" target="_blank">privacy</a> is protected.



                  </p>



               </div>



            </div>



             <div class=" signup_padding_media" >



               <button type="submit" id="submit" class="btn_login btn_team_edit_save">REGISTER</button>



            



               <a href="<?php echo base_url('auth/signin')?>" class="clr_signuplink"> Log in</a>



            </div>



         </form>



        



         



         



      </div>



      <!-- content end -->



      <!-- footer start -->



      <footer class="footer_back">



         <div class="container container_width">



                     <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last" >© Onelane, Inc. 2019</p>



           



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
<!-- <script>
  
  function addcheckRegisterValidation(){

    var check = ($('#password').val()  == $('#confirm_password').val());

    if(check == null || check == ""){
      $('#mychackDIV').show();
      return false;
    }
    return true;
  }
</script> -->



   </body>



</html>