

<div class="contnet-area">

   <div class="bg-theme text-white">

      <nav class="navbar navbar-light bg-white sub-navbar">

         <ul class="nav nav-tabs" id="myTab" role="tablist">
             <li>
            <div class="dropdown">
    
          <button class="btn btn-raised btn-primary dropdown-toggle bt_4" type="button" id="dropdownMenuButton" style="margin-top: 10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $propertyData['address'];?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php 
              if (isset($propertyAllData))
              foreach($propertyAllData as $value)

              {?>
                 <a class="dropdown-item" href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info')?>"><?php echo substr( $value['address'],0,30)?></a>
             <?php }?>
          </div>
        </div>
          </li>
            <li class="nav-item basic_info_margin">

               <a class="nav-link"  href="<?php echo base_url('owner/property_basicinfo/').$propertyData['id'];?>/basic-info"  role="tab" aria-controls="guide" aria-selected="false">Property Info</a>

            </li>

            <li class="nav-item basic_info_margin">

               <a class="nav-link"  href="<?php echo base_url('owner/property_basicinfo_unit/').$propertyData['id'];?>/units" role="tab" aria-controls="guide" aria-selected="false">House / Unit</a>

            </li>

            <li class="nav-item basic_info_margin">

               <a class="nav-link" id="guide-tab"  href="<?php echo base_url('owner/editproperty_guide/').$propertyData['id'];?>"  role="tab" aria-controls="guide" aria-selected="false">Guide</a>

            </li>

         </ul>

      </nav>

   </div>

  

      <div class="tab-pane basic_indo_margin show active" id="guide" role="tabpanel" aria-labelledby="contact-tab">

         <div class="card col-md-8">

            <div class="card-body">

               

                     <form action="<?php echo base_url('owner/editproperty_guide/').$propertyData['id'];?>" method="POST">

                        <div class="form-group">

                           <label for="">Water & Garbage *</label>

                           <textarea style="color: #b5aeae" class="form-control" id=""  placeholder="e.g. provider company and contact info." name="watergarbage" required=""><?php echo $propertyGuide['watergarbage'];?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">Gas & Electricity *</label>

                           <textarea style="color: #b5aeae" class="form-control" id=""  placeholder="e.g. provider company and contact info." name="gaselectricity" required=""><?php echo $propertyGuide['gaselectricity']?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">Keys</label>

                           <textarea style="color: #b5aeae" class="form-control" id=""  placeholder="e.g. number of sets of keys, where to pick up." name="keys"><?php echo $propertyGuide['keys']?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">HOA/Community</label>

                           <textarea style="color: #b5aeae" class="form-control" id="" placeholder="e.g. HOA/community rules and registration." name="hoacommunity"><?php echo $propertyGuide['hoacommunity']?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">Mail</label>

                           <textarea style="color: #b5aeae" class="form-control" id="" placeholder="e.g. mailbox location and address change reminder." name="mail"><?php echo $propertyGuide['mail']?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">Internet & TV</label>

                           <textarea style="color: #b5aeae" class="form-control" id="" placeholder="e.g. internet/TV provider information." name="internettv"><?php echo $propertyGuide['internettv']?></textarea>

                        </div>

                        <div class="form-group">

                           <label for="">Misc/Notes</label>

                           <textarea style="color: #b5aeae" class="form-control" id="" placeholder="Misc. Notes" name="miscnotes"><?php echo $propertyGuide['miscnotes'];?></textarea>

                        </div>

                        <div class="form-group">

                           <button type="submit" class="btn btn-primary btn-raised">Update</button>

                           <button type='button' class="btn btn-default" onclick="location.href = '<?php echo base_url()?>owner/properties';">Cancel</button>

                        </div>

                       

                     </form>

                 

            </div>

         </div>

         <div class="card col-md-8 mt-3">

            <div id="showImages">

               <?php

               if(!empty($propertyguidedocs))

               {

                  foreach ($propertyguidedocs as $propertyguidedoc) { 

                     $filename = explode('.',$propertyguidedoc['file_name']);

               

                     ?>

                  <div id="<?php echo $filename[0]?>"  >

                     <div style="float: left; margin: 10px; margin-left: 0px;">

                    <a  <?php  if($filename[1] == pdf){ ?>class="pdf" href="<?php echo base_url('upload/property_guide_doc/').$propertyguidedoc['file_name']?>" <?php }else{ ?> class="example-image-link" href="<?php echo base_url('upload/property_guide_doc/').$propertyguidedoc['file_name']?>"  data-lightbox="example-set" <?php } ?>>
                       <?php
                       if($filename[1] == pdf){
                        ?>
                          <img  src="<?php echo base_url('/assets/images/pdf.png')?>" class="example-image img-thumbnail size_image">
                        <?php
                        }else{
                        ?>
                        <img  src="<?php echo base_url('upload/property_guide_doc/').$propertyguidedoc['file_name']?>" class="example-image img-thumbnail size_image">
                      <?php
                       }
                      ?>
                      </a>

                        <div>

                           <center>

                              <button class='fileremdoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $propertyguidedoc['id']?>" rem-file="<?php echo $propertyguidedoc['file_name']?>" >

                                 Remove

                              </button>

                           </center>

                        </div>

                     </div>

                  </div>

               <?php }

                  }

               ?>

            </div>

         </div>



         <div class="card col-md-8 mt-3">

            <div class="card-body ">

               <h6 class="mb-3">Property Guide Documents</h6>

               <p class="text-small text-secondary my-3">Documents uploaded here are only visible to you and property members who can access the Property tab.

               </p>

               <form action="<?php echo base_url('owner/property_guide_doc_uploadAndDelete')?>" class="dropzone" id=""> 

               <input type="hidden" name="property_guide_doc_id" value="<?php echo $propertyGuide['id']?>">     

               </form>



            </div>

         </div>

      </div>

   </div>

</div>





