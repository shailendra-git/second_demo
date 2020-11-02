<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<div class="container"> 
 <div class="row">    
  <div class="col s12">                
  	<div class="modal-header">                 
  	 <h5 class="modal-title" id="exampleModalLabel">TENANT SEND MESSAGES</h5>     
  	            </div>               
  	              <div class="row">                   
  	               <div class="col-md-12 col-sm-12 col-" id="myTabContent">      
               <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">                         
                  <form  method="post" target="_parent" id="msg_target" action="<?php echo base_url('tenant/saveTenantMessageData/')?><?php echo $tenantData['id']?>">                              
                  	<div class="form-group bmd-form-group">                             
                  	 <input type="text" name="message" class="form-control"  placeholder="Enter Your Message Here..." id="msg_input" required=""> 
                     <span style="color:red" id="msg_error"></span>
                </div>                            
                  <div class="form-group">                             
                   <button type="submit" class="btn btn-primary btn-raised edit-icon" id="add_mag">Add Message</button>                            
                     </div>                           
                      </form>                                              
                      </div>                    
                  </div>                
                   </div>        
                     </div>      
                 </div></div>


<script>
$(document).ready(function(){

	$( "#msg_target" ).submit(function( event ) {   
     var mag_val = $('#msg_input').val();
      if(mag_val.match(/^\s*$/g)) {
				// console.log('regex');	
		     $('span#msg_error').html('Enter unit');
		     return false;
		  }
    // event.preventDefault();
});
});
</script>