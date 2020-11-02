<div class="contnet-area">
  <div class="container" style="margin-top: 30px;">
  <h3 class="tenant_doc">Tenant All Docs</h3>
        
        <div class="row">
           <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                   <div class="card-body ">
                     <h6 class="mb-3">GOVERNMENT PHOTO ID</h6>
                    
                     
                     <form action="<?php echo base_url('tenant/tenant_govt_doc_uploadAndDelete')?>" class="dropzone" id=""> 
                    
                     <input type="hidden" name="tenant_doc_id" value="<?php echo $tenantData['id']?>">    
                     </form>
                   </div>
              </div>
          <div class=" col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="card" style="padding: 10px;margin-top: 52px;">  
                 <div id="showImages" class="div_showimg">
                <?php
                   if(!empty($tenantdocs))
                   {
                    foreach ($tenantdocs as $tenantdoc) { 
                      $filename = explode('.',$tenantdoc['file_name']);
                   
                      ?>
                <div id="<?php echo $filename[0]?>"  >
                <div style="float: left; margin: 10px; margin-left: 0px;">

                  
                    <a <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/govt_doc/').$tenantdoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/govt_doc/').$tenantdoc['file_name']?>" data-lightbox="example-set" <?php } ?>>
                      
                       <?php
                       if($filename[1] == pdf){
                          ?>
                           <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                        <?php
                        }else{
                          ?>

                       <img  src="<?php echo base_url('upload/govt_doc/').$tenantdoc['file_name']?>" class="img-thumbnail size_image">
                     
                      <?php
                         }
                       ?>
                     </a>

                      <div>
                      <center>
                   <!--<button class='removeTenantGovtDoc save_change m_top_buttom ' file-name='<?php //echo $filename[0]?>' data-proid="<?php //echo $tenantdoc['tenant_id']?>" rem-file="<?php //echo $tenantdoc['file_name']?>" >
                      Remove</button>-->
                      </center>
                     
                      </div>
                      </div>
                </div>
                <?php }
                   }
                   ?>
              </div>
             </div>
             </div>
            
              
            </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="card-body ">
               <h6 class="mb-3">RENTER'S INSURANCE</h6>
              
               
               <form action="<?php echo base_url('tenant/tenant_renter_doc_uploadAndDelete')?>" class="dropzone" id=""> 
              
               <input type="hidden" name="tenant_doc_id" value="<?php echo $tenantData['id']?>">    
               </form>
               </div>
            </div>
            <div class=" col-lg-7 col-md-7 col-sm-12 col-xs-12">
               <div class="card" style="padding: 10px; margin-top:52px;"> 
               <div id="showImages" class="div_showimg">
              <?php
                 if(!empty($tenantrenterdocs))
                 {
                  foreach ($tenantrenterdocs as $tenantdoc) { 
                    $filename = explode('.',$tenantdoc['file_name']);
                 
                    ?>
              <div id="<?php echo $filename[0]?>"  >
              <div style="float: left; margin: 10px; margin-left: 0px;">

               <a <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/renter_doc/').$tenantdoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/renter_doc/').$tenantdoc['file_name']?>" data-lightbox="example-set" <?php } ?>>
                      
               <?php
               if($filename[1] == pdf){
                  ?>
                   <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                <?php
                }else{
                  ?>

                 <img  src="<?php echo base_url('upload/renter_doc/').$tenantdoc['file_name']?>" class="img-thumbnail size_image">
                <?php
                }
                ?> 
              </a>
                 
                    <div>
                    <center>
                <!-- <button class='removeTenantRenterDoc save_change m_top_buttom ' file-name='<?php //echo $filename[0]?>' data-proid="<?php //echo $tenantdoc['tenant_id']?>" rem-file="<?php //echo $tenantdoc['file_name']?>" >
                    Remove</button>-->
                    </center>
                   
                    </div>
                    </div>
              </div>
              <?php }
                 }
                 ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            
             <div class="card-body ">
           <h6 class="mb-3">DOCUMENTS</h6>
          
           
           <form action="<?php echo base_url('tenant/tenant_document_doc_uploadAndDelete')?>" class="dropzone" id=""> 
          
           <input type="hidden" name="tenant_doc_id" value="<?php echo $tenantData['id']?>">    
           </form>
           </div>
            </div>
             <div class=" col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="card" style="padding: 10px; margin-top:52px;"> 
                  <div id="showImages" class="div_showimg">
                    <?php
                       if(!empty($tenantdocumentsdocs))
                       {
                        foreach ($tenantdocumentsdocs as $tenantdoc) { 
                          $filename = explode('.',$tenantdoc['file_name']);
                       
                          ?>
                    <div id="<?php echo $filename[0]?>"  >
                    <div style="float: left; margin: 10px; margin-left: 0px;">

                      <a <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/request_doc/').$tenantdoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/request_doc/').$tenantdoc['file_name']?>" data-lightbox="example-set" <?php } ?>>
                      
                       <?php
                       if($filename[1] == pdf){
                          ?>
                           <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                        <?php
                        }else{
                          ?>

                       <img  src="<?php echo base_url('upload/request_doc/').$tenantdoc['file_name']?>" class="img-thumbnail size_image">
                       
                         <?php
                          }
                          ?> 
                        </a>

                          <div>
                          <center>
                       <!--button class='removeTenantdocumentDoc save_change m_top_buttom ' file-name='<?php //echo $filename[0]?>' data-proid="<?php //echo $tenantdoc['tenant_id']?>" rem-file="<?php //echo $tenantdoc['file_name']?>" >
                          Remove</button>-->
                          </center>
                         
                          </div>
                          </div>
                    </div>
                    <?php }
                       }
                       ?>
                  </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>