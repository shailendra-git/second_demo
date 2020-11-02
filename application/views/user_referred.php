<style type="text/css">
input{
   background-image: none !important;
}
</style>
<div>
    <h3 class="text-center login">refer a friend</h3>
         <form method="post" action="<?php echo base_url('owner/getReferred')?>" class="form_center2" id="referredform" onsubmit="return validationEvent()">
            <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >Name </label>
                  <input type="text" class="form-control input_border input_name" name="firstname[]" id="firstname" placeholder="Firstname">
               </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                   <label >Email </label>
                   <input  name="firstemail[]" class="form-control input_border" id="firstemail" placeholder="example@gmail.com" autocomplete="off">
                    <div id="firstmsg" style="display: none; color: red; font-size: 16px;">
                     Please provide a valid email address.
                   </div>
               </div>
            </div>
            <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >Name </label>
                  <input type="text" class="form-control input_border input_name" name="firstname[]" id="secondname" placeholder="Secondname" >
               </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >Email </label>
                   <input  name="firstemail[]" class="form-control input_border" id="secondemail"   placeholder="example@gmail.com" autocomplete="off">
                      <div id="secondmsg" style="display: none; color: red; font-size: 16px;">
                       Please provide a valid email address.
                    </div>
               </div>
            </div>
            <div class="row ">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                  <label >Name </label>
                  <input type="text" class="form-control input_border input_name" name="firstname[]" id="thirdname" placeholder="Thirdname" >
               </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  " >
                   <label >Email </label>
                   <input  name="firstemail[]" class="form-control input_border" id="thirdemail"   placeholder="example@gmail.com" autocomplete="off">
                       <div id="thirdmsg" style="display: none; color: red; font-size: 16px;">
                        Please provide a valid email address.
                      </div>
               </div>
            </div>
           
             <div class="text-center" >
               <button type="submit" id="submit" class="btn" style="background-color:#009688; color:#ffffff;">SUBMIT</button>
            </div>
            <br>
              <div class="row ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5>Please enter at least one email address.</h5>
               </div>
             </div>
         </form>
</div>


<script type="text/javascript">

function validationEvent(){
   
  var firstName   = $('#firstname').val();
  var secondName  = $('#secondname').val();
  var thirdName   = $('#thirdname').val();
  var firstEmail  = $('#firstemail').val();
  var secondEmail = $('#secondemail').val();
  var thirdEmail  = $('#thirdemail').val();
  var flag = 0;


 if(firstName=="" && firstEmail =="" && secondName=="" && secondEmail ==""  && thirdName=="" && thirdEmail ==""){
    alert("Please enter at least one name and email address.");
   return false;
 }


  if(firstName!="" && firstEmail !="")
  {

   var email = firstEmail;
   var checkEmail = IsEmail(email);
    //var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (checkEmail == false) 
    {
        $('#firstemail').focus();
        $("#firstmsg").show();
          
          return false;
      }else{
        flag=1;
      }
    // }
  }

  if(firstName !="" || firstEmail !="")
  {
    if(firstName=="")
    {
      alert("Please entre your first name");
      $('#firstname').focus();
     return false;
    }

   var email = firstEmail;
   var checkEmail = IsEmail(email);
    if (checkEmail == false) 
    {
          $("#firstmsg").show();
          $('#firstemail').focus();
          email.focus;
          return false;
      }else{
        flag=1;
      }
  }
  
// second condition 
if(secondName!="" && secondEmail !="")
  {
    
  var email = secondEmail;
   var checkEmail = IsEmail(email);
    if (checkEmail == false) 
    {     
          $('#secondemail').focus();
          $("#secondmsg").show();
          return false;
      }else{
        flag=1;
      }
  }

  if(secondName !="" || secondEmail !="")
  {
    if(secondName=="")
    {
      alert("Please entre your second name");
       $('#secondname').focus();
     return false;
    }

   var email = secondEmail;
   var checkEmail = IsEmail(email);
    if (checkEmail == false) 
    {      
         $('#secondemail').focus();
          $("#secondmsg").show();
          email.focus;
          return false;
      }else{
        flag=1;
      }
  }


// third condition 

if(thirdName!="" && thirdEmail !="")
  {
    
   var email = thirdEmail;
   var checkEmail = IsEmail(email);
    if (checkEmail == false) 
    {
          $("#thirdmsg").show();
          $('#thirdemail').focus();
          return false;
      }else{
        flag=1;
      }
  }

  if(thirdName !="" || thirdEmail !="")
  {
    if(thirdName=="")
    {
      alert("Please entre your third name");
       $('#thirdname').focus();
     return false;
    }

   var email = thirdEmail;
   var checkEmail = IsEmail(email);
    if (checkEmail == false) 
    {      
          $('#thirdemail').focus();
          $("#thirdmsg").show();
          return false;
      }else{
        flag=1;
      }
  }
  
  if(flag==0)
  {   
      return false;
  }
  //alert("hello");
  return true;

  }

function IsEmail(email) {
  //var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!regex.test(email)) {
    return false;
  }
}

</script>
