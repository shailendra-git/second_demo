<style type="text/css">
   .h2_cls{
      padding: 12px 0px 12px 12px;
   }

  @media only screen and (max-width: 767px) {
      .h2_cls{text-align: center !important;}
      .prop-block h6{font-size: 19px !important;}
   }
</style>

<div class="contnet-area">
<div class="p-4">
   <div class="action-top d-flex justify-content-between">         
   </div>
   <div id="property_hide">
      
      <div class="card col-md-12" style="margin-bottom:5px">
         <div class="card-body">
            <h2  class="h2_cls">Outstanding Tasks</h2>
            <div class="row">
               <div class="col-md-12 sm-3 m-auto">
                  <div class="d-flex flex-wrap">
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6 class="property_heading_m_top">Onboarding</h6>
                        </div>
                        <div>
                           <h1 class="count-font">
                              -
                           </h1>
                        </div>
                        <?php /*echo base_url('owner/property_basicinfo_unit/').$property['id'];?>/units*/?>
                        <a href="<?php ?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>
                     </div>
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6>Property Setup</h6>
                        </div>
                        <div><i class="material-icons count-font font-color">-</i></div>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button>
                     </div>
                     
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6>Management</h6>
                        </div>
                        <div>
                           <h1 class="count-font">-</h1>
                        </div>
                        <?php //echo base_url('owner/requests/open/').$property['id'];?>
                        <a href="<?php //echo base_url('owner/requests/open/').$property['id'];?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
   </div>
   <div id="property_hide">
      
      <div class="card col-md-12" style="margin-bottom:5px">
         <div class="card-body">
            <h2  class="h2_cls">Quick Stats</h2>
            <div class="row">
               <div class="col-md-12 sm-3">
                  <div class="d-flex flex-wrap">
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6 class="property_heading_m_top">Late Payments</h6>
                        </div>
                        <div>
                           <h1 class="count-font">
                              -
                           </h1>
                        </div>
                        <?php /*echo base_url('owner/property_basicinfo_unit/').$property['id'];?>/units*/?>
                        <a href="<?php ?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>
                     </div>
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6>Open Maintenance</h6>
                        </div>
                        <div><i class="material-icons count-font font-color"><?php echo $maintainence_count>0 ? 'check' : '-';?></i></div>
                        <a href="<?php echo base_url('owner/requests');?>"><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>
                     </div>
                    
                     <div class="col-md-4 prop-block">
                        <div>
                           <h6>Prospective Tenants</h6>
                        </div>
                        <div>
                           <h1 class="count-font"><?php echo $tenant_count;?></h1>
                        </div>
                        <?php //echo base_url('owner/requests/open/').$property['id'];?>
                        <a href="<?php echo base_url('team/tenants');?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">View</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
   </div>
   <div id="property_hide">
      
      <div class="card col-md-12" style="margin-bottom:5px">
         <div class="card-body">
            <h2  class="h2_cls">Quick Links</h2>
            <div class="row">
               <div class="col-md-12 sm-3">
                  <div class="d-flex flex-wrap">
                     <div class="col-md-3 prop-block">
                                                
                        <?php /*echo base_url('owner/property_basicinfo_unit/').$property['id'];?>/units*/?>
                        <a href="<?php echo base_url('owner/properties')?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">PROPERTIES</button></a>
                     </div>
                     <div class="col-md-3 prop-block">
                        
                   
                        <a href="<?php echo base_url('team/getTeams')?>"><button type="button" class="btn btn-outline-primary btn-sm btn-block">YOUR TEAM</button></a>
                     </div>
                    
                     <div class="col-md-3 prop-block">
                        
                        <?php //echo base_url('owner/requests/open/').$property['id'];?>
                        <a href="<?php echo base_url('team/tenants')?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">TENANTS & LEASES</button></a>
                     </div>

                     <div class="col-md-3 prop-block">
                        
                        <?php //echo base_url('owner/requests/open/').$property['id'];?>
                        <a href="<?php echo base_url('owner/requests')?>" class=""><button type="button" class="btn btn-outline-primary btn-sm btn-block">MAINTENANCE & REPAIR</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
   </div>
</div>

<script></script>