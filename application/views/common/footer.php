

</div>


<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>



<script src="<?php echo base_url('assets/js/bootstrap-material-design.js')?>"></script>

<script src="<?php echo base_url('assets/js/common.js');?>"></script>

<script src="<?php echo base_url('assets/js/moment.js');?>"></script>

<script src="<?php echo base_url('assets/js/datepicker.js');?>"></script>



<script src="<?php echo base_url('assets/js/slick.min.js')?>"></script>

<script src="<?php echo base_url('assets/js/jquery.magnific-popup.js')?>"></script>

<!-- DROPZONE JS -->

<script src="<?php echo base_url('assets/js/dropzone.js');?>"></script>

<script src="<?php echo base_url('assets/chosen/chosen.jquery.min.js');?>"></script>

 <script src="<?php echo base_url('assets/chosen/docsupport/prism.js')?>" type="text/javascript" charset="utf-8"></script>

 <script src="<?php echo base_url('assets/chosen/docsupport/init.js')?>" type="text/javascript" charset="utf-8">

 </script>

<?php



	if (isset($popuptype) && $popuptype =='iframe') 

	{

		?>



		<script type="text/javascript">

      $(document).ready(function() {



        $('.simple-ajax-popup-align-top').magnificPopup({

          type: 'iframe',

          alignTop: true,

          closeOnBgClick:false,  

        });

      });

    </script>

    <?php

	}	

    else

    {

    ?>

	<script type="text/javascript">

      $(document).ready(function() {



        $('.simple-ajax-popup-align-top').magnificPopup({

          type: 'ajax',

          alignTop: true,

          closeOnBgClick:false,

        });

      });

    </script>

    <?php

	}

    ?>



<script type="text/javascript">

	

	function closePopup() {

  $.magnificPopup.close();

}

</script>

<script>



   $(".chosen-select").chosen()



	$( window ).scroll( function () {

		var height = $( window ).scrollTop();

		if ( height > 100 ) {

			$( '#back2Top' ).fadeIn();

		} else {

			$( '#back2Top' ).fadeOut();

		}

	} );

	$( document ).ready( function () {

		$( "#back2Top" ).click( function ( event ) {

			event.preventDefault();

			$( "html, body" ).animate( {

				scrollTop: 0

			}, "slow" );

			return false;

		} );

	});



	$('form#asignStatusForm').on('change',function(e){

		

		  if($('#status').is("input:checked")) {

	    		var status = $('#status').val("Open");

	  		} 

	  		else {

	    		var status = $('#status').val("Close");

	  		}

		if(status!=''){

			

		var url = '<?php echo base_url()?>';

		var id = $('#id').val();

		
		$.ajax({

		url:'<?php echo base_url('owner/addAsignStatus')?>',

		type:'POST',

		dataType:'json',

		data:{'id':$('#id').val(),'status':$('#status').val()},



		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				

			}

			else

			{

				

				window.location.href = url+'owner/edit_request/'+id+'';

			}

		}

	})

	}

	

	})







	$('form#asignStatusFormPrint').on('change',function(e){



		  if($('#status').is("input:checked")) {

	    		var status = $('#status').val("Open");

	  		} 

	  		else {

	    		var status = $('#status').val("Close");

	  		}

		if(status!=''){

		var url = '<?php echo base_url()?>';

		var id = $('#id').val();

		
		$.ajax({

		url:'<?php echo base_url('owner/addAsignStatus')?>',

		type:'POST',

		dataType:'json',

		data:{'id':$('#id').val(),'status':$('#status').val()},



		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				

			}

			else

			{

				

				window.location.href = url+'owner/maintenance_request_printer/'+id+'';

			}

		}

	})

	}

	

	})




	$('form#workOrderStatusForm').on('change',function(e){



		  if($('#status').is("input:checked")) {

	    		var status = $('#status').val("Open");

	  		} 

	  		else {

	    		var status = $('#status').val("Close");

	  		}

		if(status!=''){

		var url = '<?php echo base_url()?>';

		var id = $('#id').val();

		


		$.ajax({

		url:'<?php echo base_url('owner/workOrderStatus')?>',

		type:'POST',

		dataType:'json',

		data:{'id':$('#id').val(),'status':$('#status').val()},



		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				

			}

			else

			{

				

				window.location.href = url+'owner/workOrderDetails/'+id+'';

			}

		}

	})

	}

	

	})




	$('form#requestUpdateFormPrint').on('submit',function(e){

		e.preventDefault();

		var update = $('#update').val();

		if(update!=''){

		var url = '<?php echo base_url()?>';

		var maintenance_id = $('#maintenance_id').val();

		$.ajax({

		url:'<?php echo base_url('owner/requestUpdateForm')?>',

		type:'POST',

		dataType:'json',

		data:{'maintenance_id':$('#maintenance_id').val(),'update_content':$('#update_content').val()},

		success:function(res)

		{
			
			if(res.code == 'ALREADYEXISTS')

			{

				$('span#updateerr').html(res.msg);

			}

			else

			{

				$('span#updateerr').html('');

				window.location.href = url+'owner/maintenance_request_printer/'+maintenance_id+'';

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})



// Tenant update form 
$('form#requestTenantUpdateForm').on('submit',function(e){

		e.preventDefault();

		var update = $('#update').val();
		var owner_id = $('#owner_id').val();

		if(update!=''){

		var url = '<?php echo base_url()?>';

		var maintenance_id = $('#maintenance_id').val();

		$.ajax({

		url:'<?php echo base_url('tenant/requestUpdateForm')?>',

		type:'POST',

		dataType:'json',

		data:{'maintenance_id':$('#maintenance_id').val(),'update_content':$('#update_content').val()},

		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				$('span#updateerr').html(res.msg);

			}

			else

			{

				$('span#updateerr').html('');

				window.location.href = url+'tenant/edit_request/'+maintenance_id+'/'+owner_id;

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})

	



	$('form#requestUpdateForm').on('submit',function(e){

		e.preventDefault();

		var update = $('#update').val();

		if(update!=''){

		var url = '<?php echo base_url()?>';

		var maintenance_id = $('#maintenance_id').val();
		var owner_id = $('#owner_id').val();
		var property_id = $('#property_id').val();
		var unit_id = $('#unit_id').val();

		$.ajax({

		url:'<?php echo base_url('owner/requestUpdateForm')?>',

		type:'POST',

		dataType:'json',

		data:{'maintenance_id':$('#maintenance_id').val(),'update_content':$('#update_content').val(),'owner_id':owner_id,'property_id':property_id,'unit_id':unit_id},

		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				$('span#updateerr').html(res.msg);

			}

			else

			{

				$('span#updateerr').html('');

				window.location.href = url+'owner/edit_request/'+maintenance_id+'';

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})







	$('form#addUpdateForm').on('submit',function(e){

		e.preventDefault();

		var update = $('#update').val();

		if(update!=''){

		var url = '<?php echo base_url()?>';


		var workorder_id = $('#workorder_id').val();
       
		$.ajax({

		url:'<?php echo base_url('owner/addUpdateToWorkOrder')?>',

		type:'POST',

		dataType:'json',

		data:{'workorder_id':$('#workorder_id').val(),'update_content':$('#update_content').val()},

		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				$('span#updateerr').html(res.msg);

			}

			else

			{

				$('span#updateerr').html('');

				window.location.href = url+'owner/workOrderDetails/'+workorder_id+'';

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})




	$('form#addUnitForm').on('submit',function(e){

		e.preventDefault();

		var unit = $('#unit').val();

		if(unit.match(/^\s*$/g)) {
				console.log('regex');	
		     $('span#uniterr').html('Enter unit');
		     return false;
		}

		if(unit!=''){


		var url = '<?php echo base_url()?>';

		var property_id = $('#property_id').val();

		$.ajax({

		url:'<?php echo base_url('owner/addUnitToProperty')?>',

		type:'POST',

		dataType:'json',

		data:{'property_id':property_id,'unit':unit},

		success:function(res)

		{   
			if(res.code == 'SPACEEXISTS')

			{

				$('span#uniterr').html(res.msg);

			}

			else if(res.code == 'UNITCONSUMED')

			{

				$('span#uniterr').html(res.msg);

			}
			

			else if(res.code == 'ALREADYEXISTS')

			{

				$('span#uniterr').html(res.msg);

			}

			else

			{

				$('span#uniterr').html('');

				window.location.href = url+'owner/property_basicinfo_unit/'+property_id+'/units';

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})


        $('button.removeTenantdocumentDoc').click(function(){

          id = $(this).attr('data-proid');

          filename = $(this).attr('file-name');

          rem_file = $(this).attr('rem-file');

           $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('tenant/tenant_document_doc_uploadAndDelete')?>",

                    data: {name: rem_file,user_id:id,request: 'REMOVEFILE'},

                    success: function(data){

                      $('div#'+filename).remove();

                    }

                });

        })

	

        $('button.removeTenantRenterDoc').click(function(){

          id = $(this).attr('data-proid');

          filename = $(this).attr('file-name');

          rem_file = $(this).attr('rem-file');

           $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('tenant/tenant_renter_doc_uploadAndDelete')?>",

                    data: {name: rem_file,user_id:id,request: 'REMOVEFILE'},

                    success: function(data){

                      $('div#'+filename).remove();

                    }

                });

        })

	

        $('button.removeTenantGovtDoc').click(function(){

          id = $(this).attr('data-proid');

          filename = $(this).attr('file-name');

          rem_file = $(this).attr('rem-file');

           $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('tenant/tenant_govt_doc_uploadAndDelete')?>",

                    data: {name: rem_file,user_id:id,request: 'REMOVEFILE'},

                    success: function(data){

                      $('div#'+filename).remove();

                    }

                });

        })



        $('button.remdoc').click(function(){

        	property_id = $(this).attr('data-proid');

        	filename = $(this).attr('file-name');

        	rem_file = $(this).attr('rem-file');

        	 $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('owner/property_doc_uploadAndDelete')?>",

                    data: {name: rem_file,property_id:property_id,request: 'REMOVEFILE'},

                    success: function(data){

                    	$('div#'+filename).remove();

                    }

                });

        })


        $('button.invoiceremdoc').click(function(){

        	

        	workorder_id = $(this).attr('data-proid');

        	filename = $(this).attr('file-name');

        	rem_file = $(this).attr('rem-file');

        	 $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('owner/workOrderInvoiceUploadAndDelete')?>",

                    data: {name: rem_file	,workorder_id:workorder_id,request: 'REMOVEFILE'},

                    success: function(data){

                    	$('div#'+filename).remove();

                    }

                });

        })

        $('button.workorderremdoc').click(function(){

        	workorder_id = $(this).attr('data-proid');

        	filename = $(this).attr('file-name');

        	rem_file = $(this).attr('rem-file');

        	 $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('owner/work_order_doc_uploadAndDelete')?>",

                    data: {name: rem_file,id:workorder_id,request: 'REMOVEFILE'},

                    success: function(data){

                   
                    	$('#'+filename).remove();

                    }

                });

        })

      
        $('button.requestfileremdoc').click(function(){

        	request_id = $(this).attr('data-proid');

        	filename = $(this).attr('file-name');

        	rem_file = $(this).attr('rem-file');

        	var is_confirm = confirm('Do you want to Remove file?');

        	if(is_confirm == true)
        	{
        		 $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('owner/request_doc_uploadAndDelete')?>",

                    data: {name: rem_file,id:request_id,request: 'REMOVEFILE'},

                    success: function(data){

                    
                    	$('#'+filename).remove();

                    }

                });
        	}

        	

        })

       
               $('button.fileremdoc').click(function(){



        	pro_id = $(this).attr('data-proid');

        	filename = $(this).attr('file-name');

        	rem_file = $(this).attr('rem-file');

        	

        	 $.ajax({

                    type: 'POST',

                    url: "<?php echo base_url('owner/property_guide_doc_uploadAndDelete')?>",

                    data: {name: rem_file	,id:pro_id,request: 'REMOVEFILE'},

                    success: function(data){

                    	$('div#'+filename).remove();

                    }

                });

        })



 

  

        $('button.editUnit').on('click', function(){

        	

        	property_id = $(this).attr('data-propid');

        	id = $(this).attr('data-id');

			familyhome_status = 0;        	

        	if($('#familyhome_' + id).is(":checked")) {

	    		familyhome_status = 1;

	  		}

    		unitval 	= $(this).next('input').val();
    		//familyhome 	= $(this).next('checkbox').next('checkbox').val();
    		//alert(familyhome);
    		
    		//return false;
            
            if(unitval.match(/^\s*$/g)) {
				console.log('regex');	
		     $('span#updateuniterredit_25').html('Enter unit');
		     return false;
		    }

    		if($('#status_' + id).is(":checked")) {

	    		var status = 0;

	  		} 

	  		else {

	    		var status = 1;

	  		}


			$.ajax({

			url:'<?php echo base_url('owner/updateUnitToProperty')?>',

			type:'POST',

			dataType:'json',

			data:{'property_id':property_id,'status':status,'id':id,'unit':unitval,'familyhome_status':familyhome_status},

			success:function(res)

			

			{

	

			if(res.code == 0)

			{

				

				 $('span#updateuniterredit_'+id).html(res.msg);

				 $("span#updateuniterredit_"+id).css({"color": "#FF0000"});



			}

			else

			{

				

				 $('span#updateuniterredit_'+id).html(res.msg);

				 $("span#updateuniterredit_"+id).css({"color": "#008276"});

				

			}

			}

			})

		});

		$('#searchFilter').change(function(){

			this.form.submit();	

		})

		$('a.editWorker').click(function(){

			worker_id = $(this).attr('data-workerid');

			 $.ajax({

                    type: 'POST',

                   dataType:'json',

                    url: "<?php echo base_url('team/get_workerData')?>",

                    data: {worker_id: worker_id},

                    success: function(data){

                    

                    	console.log(data);


						for(i=0;i<7;i++)

						{

							

							 $("#edit_categories option[value='" + i + "']").removeAttr("selected");

						}



						servicesData = data.services;

						servicesDataLength = servicesData.length;

						for(i=0;i<servicesDataLength;i++)

						{


							 $("#edit_categories option[value='" + servicesData[i]['service_id'] + "']").attr("selected", 1);

						}



                    	$('#worker_id').val(data.id)

                    	$('#edit_contactname').val(data.contact_name);

                    	$('#edit_address').val(data.address);

                    	$('#edit_companyname').val(data.company_name);

                    	$('#edit_email').val(data.email);

                    	$('#edit_mobile').val(data.mobile);

                    	$('#edit_notes').val(data.notes);

                    }

                });

		});



		 $(document).ready(function(){  

		  

		     $("#addEmail").change(function()  

		        {  
		        	

	            	var email = document.getElementById('addEmail');

		           	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;



		            if (!filter.test(email.value)) 

				    {

		              	$("#myEmailValid").show();

		            	email.focus;

		            	return false;

		          	}

		          	else

		          	{

		          		

			          

		            $.ajax({

		             type: "POST",

		             url: "/team/addCheckEmailExists", 

		             data: {email: $("#addEmail").val(),id : $("#id").val()},

		             

		             cache:false,

		             success: function(data){

		                   



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

		              });

		            $("#myEmailValid").hide();

			          	return true;

			        }

		     });

		 });

// transaction image data
		 $('button.payremdoc').click(function(){

		          doc_id = $(this).attr('data-proid');

		          filename = $(this).attr('file-name');

		          rem_file = $(this).attr('rem-file');

		           $.ajax({

		                    type: 'POST',

		                    url: "<?php echo base_url('financial/transaction_doc_uploadAndDelete')?>",

		                    data: {name: rem_file,doc_id:doc_id,request: 'REMOVEFILE'},

		                    success: function(data){

		                      $('div#'+filename).remove();

		                    }

		                });
		        })
// transaction image data
		

</script>

 

<script>

        function myFunction() {

        

        var x = document.getElementById("mySelect").value;

        var y= document.getElementById("demo").innerHTML = "Pay Now : $" + x*<?php echo($this->config->item('PropertyRate'));?>;

        
      

      }

       $('button[data-target=#unitModal]').on('click', function (ev) {
        ev.preventDefault();
        //var filters = 'raj1';
       // alert(filters);
       	$.ajax({

		url:'<?php echo base_url('owner/check_familyhome_status')?>',

		type:'POST',

		dataType:'json',

		data:{'property_id':$('#property_id').val()},



		success:function(res)

		{

			if(res.code == '100')

			{

				alert('Single Family Home cannot add unit');

			}

			else

			{

				$("#unitModal").modal("show");

				

			}

		}

	})

        
    });



//14-10-2019 create by date

	$('form#addUpdateForm_View').on('submit',function(e){

		e.preventDefault();

		var update = $('#update').val();

		if(update!=''){

		var url = '<?php echo base_url()?>';


		var workorder_id = $('#workorder_id').val();
       
		$.ajax({

		url:'<?php echo base_url('maintenance/addUpdateToWorkOrder')?>',

		type:'POST',

		dataType:'json',

		data:{'workorder_id':$('#workorder_id').val(),'update_content':$('#update_content').val()},

		success:function(res)

		{

			if(res.code == 'ALREADYEXISTS')

			{

				$('span#updateerr').html(res.msg);

			}

			else

			{

				$('span#updateerr').html('');

				window.location.href = url+'/maintenance/work_order_view/'+workorder_id+'';

			}

		}

	})

	}

	else

	{

		$('span#uniterr').html('Enter Unit');

	}

	})



      </script>
      <!-- Start of onelane Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=7360335e-5477-461d-8d26-fe12af86d0ff"> </script>
<!-- End of onelane Zendesk Widget script -->
  </body>
  </html>

