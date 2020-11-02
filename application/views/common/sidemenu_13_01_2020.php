<div class="hamburger">
  <nav id="sidebar">
    <ul class="side-nav fixed">
  <li id="logo">
    <div class="branding">
      <!--<a href="/" class="center-align waves-effect">-->
        <div class="logo-wrapper">
          <center><img src="/assets/images/adminlogo.png"></center>
        </div>
      <!--</a>-->
    </div>
  </li>
  <?php if($this->session->userdata('user_type')!=2 ){ ?>
  <li <?php echo $activeclass == 'dashboard' ? 'class="active"' : 'class=""'?>>
    <a href="<?php echo base_url('owner/dashboard')?>"><i class="material-icons">dashboard</i> Dashboard</a>  </li>
<?php } ?>
    <li class="no-padding">
    <ul class="collapsible">
      <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Properties',$this->session->userdata('agent_permissions_array'))) { ?>
     
      <li <?php echo $activeclass == 'properties' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/properties')?>"><i class="material-icons">home</i> Properties</a></li>
    <?php
      }
        }
    else
    { if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'properties' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/properties')?>"><i class="material-icons">home</i> Properties</a></li>

    <?php } } ?>

     <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Your Team',$this->session->userdata('agent_permissions_array'))) { ?>
     
      <li <?php echo $activeclass == 'teams' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/getTeams')?>"><i class="material-icons">people</i> Your Team</a></li>
    <?php
      }
        }
    else
    { if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'teams' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/getTeams')?>"><i class="material-icons">people</i> Your Team</a></li>

    <?php }} ?>



     <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Tenants & Leases',$this->session->userdata('agent_permissions_array'))) { ?>
     
      <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/tenants')?>"><i class="material-icons">face</i> Tenants &amp; Leases</a></li>
    <?php
      }
        }
    else
    {if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/tenants')?>"><i class="material-icons">face</i> Tenants &amp; Leases</a></li>

    <?php } }?>
    <?php 
    if ($this->session->userdata('user_type')==2) { ?>

      <li <?php echo $activeclass == 'message' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/messages')?>"><i class="material-icons">mail_outline</i>Messages</a></li> 
      <li <?php echo $activeclass == 'termsanddocs' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/tenant_docs')?>"><i class="material-icons">cloud_upload</i>Terms &  docs</a></li>
    <?php  }
    ?>
      <?php 
      if ($this->session->userdata('user_type')==2){?>
       <li <?php echo $activeclass == 'cotenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/get_cotenants')?>"><i class="material-icons">people</i> My Co-Tenants</a></li>
     <?php }

      ?>


     <?php if($this->session->userdata('user_type')==2 ){?>
         <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/requests')?>"><i class="material-icons">warning</i> Maintenance &amp; Repair</a></li>


    <?php }elseif($this->session->userdata('user_type')==4 ){
      

       if(in_array('Maintenance & Repair',$this->session->userdata('agent_permissions_array'))) { ?>
     
     <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/requests')?>"><i class="material-icons">warning</i> Maintenance &amp; Repair</a></li>
    <?php
      }
        }
    else
    {?>
        <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/requests')?>"><i class="material-icons">warning</i> Maintenance  &amp; Repair</a></li>

    <?php } ?>


    <!-- 24-10-2019 create date -->
    <?php if($this->session->userdata('user_type')==2 ){?>
    <?php
    }else{
    ?>
      <li <?php echo $activeclass == 'financial' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('financial/transaction')?>"><i class="material-icons">attach_money</i> Financials</a></li>
    <?php } ?>
    <!-- 24-10-2019 -->

     <?php 
    if ($this->session->userdata('user_type')==2) { ?>
     

      <li <?php echo $activeclass == 'settings' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/settings')?>"><i class="material-icons">settings</i> settings</a></li>

      <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('auth/signout')?>"><i class="material-icons">logout</i>logout</a></li>
    <?php  }
    ?>

        
      
    </ul>
  </li>

  
</ul>
  </nav>
    <div class="overlay"></div>
</div>

<div class="bg-theme text-white">
  <nav class="navbar navbar-light bg-white top-head">
    <div class="container-fluid d-flex justify-content-start align-items-center p-0">

      <div>
        
        <div class="dropdown">
        
          <button  type="button" id="sidebarCollapse"   style="margin-top: 10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info navbar-btn mb-0 height54 px-2"> <i class="material-icons" style="color: #009688; ">menu</i>
          </button>

          <div class="dropdown-menu" style="color: #fff;" aria-labelledby="dropdownMenuButton">
            <ul class="side-nav fixed">
  <?php //echo '>>>>>>>>',$activeclass; exit;?>

  <li <?php echo $activeclass == 'dashboard' ? 'class="active"' : 'class=""'?>>
    <a href="<?php echo base_url('owner/dashboard')?>"><i class="material-icons">dashboard</i> Dashboard</a>  </li>

    <li class="no-padding">
    <ul class="collapsible">
      <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Properties',$this->session->userdata('agent_permissions_array'))) { ?>
     
      <li <?php echo $activeclass == 'properties' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/properties')?>"><i class="material-icons">home</i> Properties</a></li>
    <?php
      }
        }
    else
    { if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'properties' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/properties')?>"><i class="material-icons">home</i> Properties</a></li>

    <?php } } ?>

     <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Your Team',$this->session->userdata('agent_permissions_array'))) { ?>
     
      <li <?php echo $activeclass == 'teams' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/getTeams')?>"><i class="material-icons">people</i> Your Team</a></li>
    <?php
      }
        }
    else
    { if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'teams' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/getTeams')?>"><i class="material-icons">people</i> Your Team</a></li>

    <?php }} ?>



     <?php if($this->session->userdata('user_type')==4 ){
      

       if(in_array('Tenants & Leases',$this->session->userdata('agent_permissions_array'))) { ?>
     
      < li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/tenants')?>"><i class="material-icons">face</i> Tenants &amp; Leases</a></li>
    <?php
      }
        }
    else
    {if ($this->session->userdata('user_type')==2) { 
      
      }
      else
      { ?>
        <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('team/tenants')?>"><i class="material-icons">face</i> Tenants &amp; Leases</a></li>

    <?php } }?>
    <?php 
    if ($this->session->userdata('user_type')==2) { ?>

      <li <?php echo $activeclass == 'message' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/messages')?>"><i class="material-icons">mail_outline</i>Messages</a></li> 
      <li <?php echo $activeclass == 'termsanddocs' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/tenant_docs')?>"><i class="material-icons">cloud_upload</i>Terms &  docs</a></li>
    <?php  }
    ?>
      
    <?php if($this->session->userdata('user_type')==2 ){?>
         <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/requests')?>"><i class="material-icons">warning</i> Maintenance &amp; Repair</a></li>


    <?php }elseif($this->session->userdata('user_type')==4 ){
      

       if(in_array('Maintenance & Repair',$this->session->userdata('agent_permissions_array'))) { ?>
     
     <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/requests')?>"><i class="material-icons">warning</i> Maintenance &amp; Repair</a></li>
    <?php
      }
        }
    else
    {?>
        <li <?php echo $activeclass == 'maintenance' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('owner/requests')?>"><i class="material-icons">warning</i> Maintenance &amp; Repair</a></li>

    <?php } ?>

   

     <?php 
    if ($this->session->userdata('user_type')==2) { ?>
      
     <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="javascript:void(0);"><i class="material-icons">book</i> Banks & Cards</a></li>
      <li <?php echo $activeclass == 'settings' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('tenant/settings')?>"><i class="material-icons">settings</i> settings</a></li>

      <li <?php echo $activeclass == 'tenants' ? 'class="active"' : 'class=""'?>><a href="<?php echo base_url('auth/signout')?>"><i class="material-icons">logout</i>logout</a></li>
    <?php  }
    ?>

         
      
    </ul>
  </li>

  
</ul>
          </div>
        </div>
      </div>
     
     
      
      <div class="ml-auto">
         <div class="dropdown user-account">
            <a href="#" class="btn btn-link dropdown-toggle"  id="userAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="material-icons grey-text">account_circle</i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userAccount">
              <?php
              $profile_controller = 'owner/profile';
              if ($this->session->userdata('user_type')==2){
                $profile_controller = 'tenant/settings';
              }
              ?>
              <a class="dropdown-item" href="<?php echo base_url($profile_controller)?>">
                <i class="material-icons">settings</i> 
                <div class="drop-body">
                  <div class="full-name"><?php echo ucfirst($this->session->userdata('firstname'));?></div>
                  <div class="secondary-content email"><?php echo $this->session->userdata('email');?></div>
                </div>
              </a>
              <?php if ($this->session->userdata('user_type')==2) { 
                
                }else{/* ?>
              <a class="dropdown-item" href="<?php echo base_url('owner/payment')?>">
                <i class="material-icons">payment</i> 
                <div class="drop-body"><div class="secondary-content email">Banks & Cards</div>
              </div>
              </a>

            <?php */}?>
                <?php if ($this->session->userdata('user_type')!=2) { ?>
              <a class="dropdown-item" href="javascript:void(0);"><i class="material-icons">loop</i> 
                <div class="drop-body">
                  <div class="secondary-content email">Subscriptions</div>
                </div>
              </a>
              <?php } ?>
              <a class="dropdown-item" href="<?php echo base_url('auth/changepassword')?>"><i class="material-icons">update</i> 
                <div class="drop-body">
                  <div class="secondary-content email">Change Password</div>
                </div>
              </a>
              
              <?php if ($this->session->userdata('user_type')==2) { 
                
                }elseif ($this->session->userdata('user_type')==4) {
                 
                }else{ ?>
                   <a class="dropdown-item" href="<?php echo base_url('payment/history')?>"><i class="material-icons">payment</i> 
                <div class="drop-body">
                  <div class="secondary-content email">Payment History</div>
                </div>
              </a>
            <?php  }?>
              <?php if ($this->session->userdata('user_type')==2) { 
                
                }else{ ?>
                  
              <a class="dropdown-item" href="<?php echo base_url('auth/signout')?>"><i class="material-icons">exit_to_app</i> 
                <div class="drop-body">
                <div class="secondary-content email">Logout</div>
              </div>
              </a>
            <?php  }?>
            </div>
          </div>
      </div>
   
    </div>
  </nav>
</div>
