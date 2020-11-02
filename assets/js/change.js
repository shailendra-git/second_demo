jQuery(function($) {
    var val_holder;
    $("form input[name='email']").change(function() { // triggred click
            val_holder      = 0;// last name field
        var email       = jQuery.trim($("form input[name='email']").val()); // email field
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // reg ex email check 
        if(val_holder == 1) {
            return false;
        }
        val_holder = 0;
        /************** start: email exist function and etc. **************/
        $("span.loading").html("");
        $("span.validation").html("");
        var datastring = 'email='+ email; // get data in the form manual
        //var datastring = $('form#mainform').serialize(); // or use serialize
        $.ajax({
                    type: "POST", // type
                    url: base_url + "team/editTeamData", // request file the 'check_email.php'
                    data: datastring, // post the data
                    
                    success: function(responseText) { // get the response
                        if(responseText == 1) { // if the response is 1
                            $("span.email_val").html(" Email are already exist.");
                            $("span.loading").html("");
                            return false;
                        } else { // else blank response
                            // alert(1111);
                            return true;
                        }
                    } // end success
        }); // ajax end
        /************** end: email exist function and etc. **************/
    }); // click end
}); // jquery end
