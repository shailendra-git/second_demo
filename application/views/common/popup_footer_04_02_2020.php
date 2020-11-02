 <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>



     <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>



     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">



     <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 



       <script src="<?php echo base_url('assets/js/common.js');?>"></script>



      <script src="<?php echo base_url('assets/js/change.js');?>"></script>



      



        <script src="<?php echo base_url('assets/js/slick.min.js')?>"></script>



        <script src="<?php echo base_url('assets/js/jquery.magnific-popup.js')?>"></script>



       <script src="<?php echo base_url('assets/js/dropzone.js');?>"></script>



   



<script type="text/javascript">



  $(document).ready(function()



  {



    $("#colorselector").ready(function()  



      {  



       $val = ($("#colorselector").val());




       if ($val=='daily') {



          $("#daily").removeAttr("style").hide();



          $("#daily").show();



        }else{



          $("#one").removeAttr("style").hide();



          $("#one").show();



        }   



      });







     $("#colorselector").click(function()  



      {  



       $val = ($("#colorselector").val());






       if ($val=='daily') {



           $('#daily_amount').removeAttr('value');



            $('#initial_amount').removeAttr('value');



           $("#daily_amount").prop('required', true);



            $("#initial_amount").prop('required', true);



            $("#late_fee_amount").prop('required', false);



        }else{



          $('#late_fee_amount').removeAttr('value');



           $("#daily_amount").prop('required', false);



            $("#initial_amount").prop('required', false);



            $("#late_fee_amount").prop('required', true);



        }   



      });



  });







</script>



    <script type="text/javascript">



    $(function(){



        $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){



            var minValue = $(this).val();



            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);



            minValue.setDate(minValue.getDate()+1);



            $("#to").datepicker( "option", "minDate", minValue );



        })



    });







  </script>



  <script type="text/javascript">



    $(function(){



        $("#datapicker").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){



            var minValue = $(this).val();



            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);



            minValue.setDate(minValue.getDate()+1);



            $("#to").datepicker( "option", "minDate", minValue );



        })



    });







  </script>  



  <script type="text/javascript">



  $(document).ready(function(){  



    $("#propertydata").change(function()  



      {  



       ($("#propertydata").val());     



        $.ajax({



           type: "POST",



           url: "/owner/getPropertyUnit", 



           data: {property_id: $("#propertydata").val()},



           cache:false,



           success: function(result){



                  $('#mySelect').find('option').remove();



                 var selectValues =  jQuery.parseJSON(result);



                 $.each(selectValues, function(key, value) {  




                 $('#mySelect')



                     .append($("<option></option>")



                                .attr("value",key)



                                .text(value)); 



                  });



                  if (!$.trim(data))



                   {



                      $("#unitdata").show();



                      return false;



                   }



                    $("#unitdata").hide();



                    return true;



                  }



      });


    });







  });



</script>







<script>



$(document).ready(function(){



  $("#cotenant_add_btn").click(function(){




      var pro = parseInt($("#hidden_co_tenant").val()) +1;



      $()







$("#hidden_co_tenant").val(pro);



$("#cotenant_"+pro).show();







if(pro >=2)



{



  $(this).hide();



}



  });



});











        $('button.removeTenantDoc').click(function(){



          id = $(this).attr('data-proid');



          filename = $(this).attr('file-name');



          rem_file = $(this).attr('rem-file');



           $.ajax({



                    type: 'POST',



                    url: "<?php echo base_url('owner/tenant_doc_uploadAndDelete')?>",



                    data: {name: rem_file,tenant_id:id,request: 'REMOVEFILE'},



                    success: function(data){



                      $('div#'+filename).remove();



                    }



                });



        })







$(document).ready(function(){



  $("#delete_btn").click(function(){



    



      var pro = parseInt($("#hidden_co_tenant").val()) -1;



      $()



    if(pro <=2)



{



  $("#hidden_co_tenant").val(pro);



  $("#cotenant_2").hide();



   $("#cotenant_add_btn").show();



}











if(pro >=2)



{



  $(this).hide();



}











  });



});







$(document).ready(function(){



  $("#delete_btn_b").click(function(){





      var pro = parseInt($("#hidden_co_tenant").val()) -1;



      $()



    if(pro <=2)



{



  $("#hidden_co_tenant").val(pro);



  $("#cotenant_1").hide();



   $("#cotenant_add_btn").show();



}











if(pro >=2)



{



  $(this).hide();



}











  });



});



</script>















<script type="text/javascript">



   $(function() {



        $('#colorselector').change(function(){



            $('.colors').hide();



            $('#' + $(this).val()).show();



        });



    });



</script>







<script type="text/javascript">



  $(".dropzoneForm").dropzone({
    maxFiles: 1,
    url: "<?php echo base_url('owner/workOrderImageRequest')?>",
    success: function(file, response){
      console.log('test');


       this.removeAllFiles();



          this.addFile(file);



        obj = JSON.parse(response);



         



          $("#filename").val(obj.filename);



    }



  });



</script>







  <script>



$(document).ready(function(){






  $(".sch_type").click(function(){



    



    if($(this).val() =='On-Site')



    {



       $("#ondiv").show();



     $("#customdiv").hide();







      $(".onsite-input").prop('required', true);







      $(".custom-input").prop('required',false);



    }



    else



    {



       $("#customdiv").show();



     $("#ondiv").hide();



     $(".onsite-input").prop('required', false);



      $(".custom-input").prop('required',true);f



    }



    



  });



  



});







$('.chosen-select').chosen({}).change( function(obj, result) {



    console.debug("changed: %o", arguments);



    



    console.log("selected: " + result.selected);



});



</script>



<script>



  $(".btn_cancle").on('click',function(){

    parent.location.reload();

    })



</script>
<script type="text/javascript">







  function deleteCoTenant(increment_id,id)



  {




     $.ajax({



              type: 'POST',



              url: "<?php echo base_url('team/deleteCotenantData')?>",



              data: {id:id},



              success: function(data)

              {





                $("#id_"+increment_id).val("");



                 $("#co_applicant_name_"+increment_id).val("");



                 $("#co_applicant_mobile_"+increment_id).val("");



                 $("#co_applicant_email_"+increment_id).val("");



                  $("#delete_btn_"+increment_id).remove();

                 $("#co_applicant_name_"+increment_id).prop('required', false);



                  $("#co_applicant_mobile_"+increment_id).prop('required', false);



                  $("#co_applicant_email_"+increment_id).prop('required', false);

              }

            });

  }

</script>
<!-- 15-10-2019 create date -->
<script type="text/javascript">


  $(".dropzoneForm_view").dropzone({
    maxFiles: 1,
    url: "<?php echo base_url('maintenance/workOrderImageRequest')?>",
    success: function(file, response){
     // console.log('test');


       this.removeAllFiles();



          this.addFile(file);



        obj = JSON.parse(response);

          $("#filename").val(obj.filename);

    }

  });

</script>


  <script type="text/javascript">



  $(document).ready(function(){  



    $("#propertydata").change(function()  



      {  



       ($("#propertydata").val());     



        $.ajax({



           type: "POST",



           url: "/financial/getPropertyUnit", 



           data: {property_id: $("#propertydata").val()},



           cache:false,



           success: function(result){



                  $('#mySelect').find('option').remove();



                 var selectValues =  jQuery.parseJSON(result);



                 $.each(selectValues, function(key, value) {  




                 $('#mySelect')



                     .append($("<option></option>")



                                .attr("value",key)



                                .text(value)); 



                  });



                  if (!$.trim(data))



                   {



                      $("#unitdata").show();



                      return false;



                   }



                    $("#unitdata").hide();



                    return true;



                  }



      });


    });







  });



</script>


  <script type="text/javascript">



  $(document).ready(function(){  



    $("#financialpropertydata").change(function()  



      {  



       //alert(($("#financialpropertydata").val()));     



        $.ajax({



           type: "POST",



           url: "/financial/getPropertyUnitAll", 



           data: {property_id: $("#financialpropertydata").val()},



           cache:false,



           success: function(result){

                  //alert(result);

                  $('#mySelect1').find('option').remove();



                 var selectValues =  jQuery.parseJSON(result);

                // alert(selectValues.unit);
                if(selectValues != ''){

                $.each(selectValues, function(key, value) {  


                //alert(value.unit);
                

                 $('#mySelect1')



                     .append($("<option></option>")



                                .attr("value",value.id)



                                .text(value.unit)); 
                     $('#uniterror').hide(); 

                   
                  });
                  }else{
                      //alert("hello");
                      $('#uniterror').show(); 
                      return false;
                  }

                

                  if (!$.trim(data))



                   {



                      $("#unitdata").show();



                      return false;



                   }



                    $("#unitdata").hide();



                    return true;



                  }



      });


    });


  });



</script>

