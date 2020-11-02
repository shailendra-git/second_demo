// alert(123);


function editagentValidation() {
// alert(123345566);
   // chackbox filed chacked

    var chack = ($("input[name='permissions[]']:checked").val());
    // alert(1234564375748);
    if(chack == null || chack == "")
     {
       $("#mychackDIV").show();
      return false;
     }
    var pro = $("#property-id").chosen().val();
    // alert(12345);
    // alert(val);
       if(pro == null || pro == "")
       {
         $("#myProDIV").show();
        return false;
       }


    return true; 


} 
function addagentValidation() {
// alert(123345566);
   // chackbox filed chacked

    var chack = ($("input[type=checkbox]:checked").val());
    // alert(1234564375748);
    if(chack == null || chack == "")
     {
       $("#mychackDIV").show();
      return false;
     }
    var pro = $("#property-id").chosen().val();
    // alert(12345);
    // alert(val);
       if(pro == null || pro == "")
       {
         $("#myProDIV").show();
        return false;
       }


    return true; 


} 



 function addTeamValidation() {
// alert(123345566);
  var val = $("#select-id").chosen().val();
    // alert(val);
       if(val == null || val == "")
       {
         $("#myDIV").show();
        return false;
       }

    var pro = $("#property-id").chosen().val();
    // alert(12345);
    // alert(val);
       if(pro == null || pro == "")
       {
         $("#myProDIV").show();
        return false;
       }
} 


// select choosen validation
function editTeamValidation() {
// alert(123345566);
  	var val = $("#select-id").chosen().val();
  	// alert(val);
       if(val == null || val == "")
       {
       	 $("#myDIV").show();
        return false;
       }

    var pro = $("#property-id").chosen().val();
    // alert(val);
       if(pro == null || pro == "")
       {
         $("#myProDIV").show();
        return false;
       }

    var val = $("#filename").val();
    alert(val);
       if(val == null || val == "")
       {
         $("#myInvoiceDIV").show();
        return false;
       }
      
        return true;
} 
// radio button validation
function scheduleValidation() {
  //alert(99999999999999);
var val = ($("input[name=sch_type]:checked").val()); 
    
    if(val == 'On-Site')
    {
      var val = $(".selectvalue").val();
      // alert(val);
       if(val == '')
       {
        $("#myInvoiceDIV").show();
        return false;
       }
    }
    return true; 
}
// alert(55555); 

function invoiceValidation() {
// alert(1234556);
    var val = $("#filename").val();
    // alert(val);
       if(val == null || val == "")
       {
         $("#myInvoiceDIV").show();
        return false;
       }
        return true;
} 

 $(document).ready(function(){  

     $("#email").change(function()  
        {  
          // form validation
          var email = document.getElementById('email');
          var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

          if (!filter.test(email.value)) 
          {
              $("#myEmailValid").show();
            email.focus;
            return false;
          }else{
          

        // alert('123456');     
         $.ajax({
             type: "POST",
             url: "/team/checkEmailExists", 
             data: {email: $("#email").val(),id : $("#hidden_id").val()},
             
             cache:false,
             success: function(data){
                    // alert(data);  //as a debugging message.

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