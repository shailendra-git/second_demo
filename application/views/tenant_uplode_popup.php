<div class="container" style="margin-top: 50px;">

  <h3>Tenant Uplode Docs</h3>

  

         

         <div class="card col-md-12 mt-3">

         <div id="showImages">

            <?php

               if(!empty($tenantdocs))

               {

                foreach ($tenantdocs as $tenantdoc) { 

                  $filename = explode('.',$tenantdoc['file_name']);
                  //print_r($filename[1]);

               // if($fil)

            ?>

            <div id="<?php echo $filename[0]?>"  >

            <div style="float: left; margin: 10px; margin-left: 0px;">

               <a <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/tenant_doc/').$tenantdoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/tenant_doc/').$tenantdoc['file_name']?>" data-lightbox="example-set" <?php } ?>>
              
               <?php
               if($filename[1] == pdf){
                  ?>
                   <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                <?php
                }else{
                  ?>
                <img  src="<?php echo base_url('upload/tenant_doc/').$tenantdoc['file_name']?>" class="example-image img-thumbnail size_image">
               <?php
                 }
               ?>
               </a>
                  <div>

                  <center>

               <button class='removeTenantDoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $tenantdoc['tenant_id']?>" rem-file="<?php echo $tenantdoc['file_name']?>" >

                  Remove</button>

                  </center>

                 

                  </div>

                  </div>

            </div>

            <?php }

               }

               ?>

         </div>

      </div>

      <div class="card col-md-12 mt-3">

         <div class="card-body ">

         <h6 class="mb-3">Private Property Documents</h6>

         <p class="text-small text-secondary my-3">Documents uploaded here are only visible to you and Tenant members who can access the Tenant tab.

         </p>

         

         <form action="<?php echo base_url('owner/tenant_doc_uploadAndDelete')?>" class="dropzone" id=""> 

        

         <input type="hidden" name="tenant_doc_id" value="<?php echo $tenantData['id']?>">    

         </form>

         </div>

         </div>

      </div>

</div>

