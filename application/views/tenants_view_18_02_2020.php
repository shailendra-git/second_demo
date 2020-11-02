<div class="contnet-area">
	<div class="container">
		<div class="row bg">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " ></div>
			<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 "  >
				<div>
					<a class=" btn2 new_req_btn add_services_mobile  simple-ajax-popup-align-top btn btn-raised btn-primary btnn1" href="/team/addTenant">          INVITE TENANT            </a>
					<span></span>
				</div>
				<div style="color: red;">
					<?php echo $this->session->flashdata('errmsg')?>
				</div>
			</div>
			<div class="col-md-12 table_overflow" >
				<style>            table {              font-family: arial, sans-serif;              border-collapse: collapse;                          }            td, th {                            padding: 6px;            }            </style>
				<table class="border1" cellpadding="20px" >
					<thead class="border1">
						<tr>
							<th class="name">TENANTS</th>
							<th class="contact-info">PROPERTY</th>
							<th class="expertise">RENT</th>
							<th class="expertise">  END DATE</th>
							<th class="expertise">MESSAGES</th>
							<th class="expertise">DOCS</th>
							<th class="expertise">DOCS-Tenant</th>
							<th class="expertise"> CO-TENANT</th>
							<th class="expertise">  LEASE TERMS</th>
							<th class="expertise"> PRIVATE NOTES</th>
							<th class="expertise"> Deactive</th>
						</tr>
					</thead>
					<tbody class="border1">
						<?php                  if(!empty($tenantData))                  {                    
						 foreach($tenantData as $team)                     {                     ?>
						<tr>
							<td>
								<a class="simple-ajax-popup-align-top" href="/team/editTenantById/
									<?php echo $team['main_tenant_id'] ?>" style="color:#009688;" >
									<?php echo ucfirst($team['firstname'].' ');?>
								</a>
								<?php if ($team['user_id']=='0') {?>                               (Invited)                              
								<?php } ?>
							</td>
							<td>
								<a href="#">
									<?php echo $team['address'];?>,                              Unit-
									<?php echo $team['unit'];?>
								</a>
							</td>
							<td class="right-align">                                                           $
								<?php echo $team['monthly_rent'];?>/-                                                           
							</td>
							<td class="right-align">
								<?php echo $team['formatted_date'];?>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getTenantMessageById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >                                Views (                              
									<?php                                 $this->db->select('count(*) as tenantdata');                                 $this->db->from('tenant_messages');                                 $this->db->where('tenant_messages.tenant_id',$team['main_tenant_id']);                                 $permissions = $this->db->get()->result_array();                                 if(!empty($permissions)){                                 $comma = '';                                 foreach ($permissions as $permission) {                                    echo $comma.''.$permission['tenantdata'];                                    $comma = ',';                              }                              }                              ?>)                                
								</a>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/tenantUplodeById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >                                 Uploded Docs (
									<?php                                 $this->db->select('count(*) as tenantdoc');                                 $this->db->from('tenant_docs');                                 $this->db->where('tenant_docs.tenant_id',$team['main_tenant_id']);                                 $permissions = $this->db->get()->result_array();                                 if(!empty($permissions)){                                 $comma = '';                                 foreach ($permissions as $permission) {                                    echo $comma.''.$permission['tenantdoc'];                                    $comma = ',';                              }                              }                              ?>)                              
								</a>
							</td>
							<!-- Teant doc added by tenant-->
							<td class="right-align">
								<a class="" href="/team/mainTenantUplodeById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >                                 View Docs                              
								</a>
							</td>
							<!-------------------------------->
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getCOTenantById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >                                Views( 
									<?php                                       $this->db->select('count(*) as counttennat');                                        $this->db->from('co_tenant');                                        $this->db->where('co_tenant.tenant_id',$team['main_tenant_id']);                                        $permissions = $this->db->get()->result_array();                                         if(!empty($permissions))                                         {                                                                                 foreach ($permissions as $count) {                                          echo $count['counttennat'];}}                                            ?>)                                
								</a>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getLeaseTermsById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >
									<i class="material-icons btn btn-raised btn-primary edit-icon" data-toggle="modal" data-target="#instructionsModal">edit</i>
								</a>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getTenantnotesById/
									<?php echo $team['main_tenant_id'];?>" style="color:#009688;" >
									<i class="material-icons btn btn-raised btn-primary edit-icon" data-toggle="modal" data-target="#instructionsModal">edit</i>
								</a>
							</td>
								<!-- active botton -->
							<td class="right-align">
								<a href="/team/getTenantDeleteById/
									<?php echo $team['main_tenant_id'];?>"  id="active_deactive" onclick="return confirm('Are you sure want to remove tenant from your property?');" style="color:#009688;font-size: 20px;" data-toltip="Deactive">
									<i class="fa fa-remove btn btn-raised btn-primary edit-icon"></i>
								</a>
							</td>
						</tr>
          
						<?php }} ?>
					</tbody>
				</table>
			</div>
		</div>


       
       <!-- delete history teneant -->


<div class="row bg">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " ></div>
			<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 "  >
				<!-- <div>
					<center><h1>ARCHIVE TENANTS</h1></center>
					<span></span>
				</div> -->
				<div style="color: red;">
					<?php echo $this->session->flashdata('errmsg')?>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_overflow" >
				<center><h1>ARCHIVE TENANTS</h1></center>
				<br>
				<style>            table {              font-family: arial, sans-serif;              border-collapse: collapse;              width: 100%;            }            td, th {                            padding: 6px;            }            </style>
				<table class="border1" width="100%" class="dis" cellpadding="20px" >
					<thead class="border1">
						<tr>
							<th class="name">TENANTS</th>
							<th class="contact-info">PROPERTY</th>
							<th class="expertise">RENT</th>
							<th class="expertise">  END DATE</th>
							<th class="expertise">MESSAGES</th>
							<th class="expertise">DOCS</th>
							<th class="expertise">DOCS-Tenant</th>
							<th class="expertise">CO-TENANT</th>
						</tr>
					</thead>
					<tbody class="border1">
						<?php                  if(!empty($gethistorytenantdata))                  {                    
						 foreach($gethistorytenantdata as $tenanthistory)                     {                     ?>
						<tr>
							<td>
								<a class="simple-ajax-popup-align-top" href="/team/editTenantById/
									<?php echo $tenanthistory['main_old_tenant_id'] ?>" style="color:#009688;" >
									<?php echo ucfirst($tenanthistory['firstname'].' ');?>
								</a>
								<?php if ($tenanthistory['user_id']=='0') {?>                               (Invited)                              
								<?php } ?>
							</td>
							<td>
								<a href="#">
									<?php echo $tenanthistory['address'];?>,                              Unit-
									<?php echo $tenanthistory['unit'];?>
								</a>
							</td>
							<td class="right-align">                                                           $
								<?php echo $tenanthistory['monthly_rent'];?>/-                                                           
							</td>
							<td class="right-align">
								<?php echo $tenanthistory['formatted_date'];?>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getTenantMessageById/
									<?php echo $tenanthistory['main_old_tenant_id'];?>" style="color:#009688;" >                                Views (                              
									<?php                                 $this->db->select('count(*) as tenantdata');                                 $this->db->from('tenant_messages');                                 $this->db->where('tenant_messages.tenant_id',$tenanthistory['main_old_tenant_id']);                                 $permissions = $this->db->get()->result_array();                                 if(!empty($permissions)){                                 $comma = '';                                 foreach ($permissions as $permission) {                                    echo $comma.''.$permission['tenantdata'];                                    $comma = ',';                              }                              }                              ?>)                                
								</a>
							</td>
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/tenantUplodeById/
									<?php echo $tenanthistory['main_old_tenant_id'];?>" style="color:#009688;" >                                 Uploded Docs (
									<?php                                 $this->db->select('count(*) as tenantdoc');                                 $this->db->from('tenant_docs');                                 $this->db->where('tenant_docs.tenant_id',$tenanthistory['main_old_tenant_id']);                                 $permissions = $this->db->get()->result_array();                                 if(!empty($permissions)){                                 $comma = '';                                 foreach ($permissions as $permission) {                                    echo $comma.''.$permission['tenantdoc'];                                    $comma = ',';                              }                              }                              ?>)                              
								</a>
							</td>
							<!-- Teant doc added by tenant-->
							<td class="right-align">
								<a class="" href="/team/mainTenantUplodeById/
									<?php echo $tenanthistory['main_old_tenant_id'];?>" style="color:#009688;" >                                 View Docs                              
								</a>
							</td>
							<!-------------------------------->
							<td class="right-align">
								<a class="simple-ajax-popup-align-top" href="/team/getCOTenantById/
									<?php echo $tenanthistory['main_old_tenant_id'];?>" style="color:#009688;" >                                Views( 
									<?php                                       $this->db->select('count(*) as counttennat');                                        $this->db->from('co_tenant');                                        $this->db->where('co_tenant.tenant_id',$tenanthistory['main_old_tenant_id']);                                        $permissions = $this->db->get()->result_array();                                         if(!empty($permissions))                                         {                                                                                 foreach ($permissions as $count) {                                          echo $count['counttennat'];}}                                            ?>)                                
								</a>
							</td>
			
						</tr>
						<?php }}

						 else{
                               	?>
                               	<tr>
                                    <td colspan="8" style="text-align:center;">Data Not Found</td>
                               	</tr>
                               	<?php
                               }
                               ?>
					</tbody>
				</table>
			</div>
		</div>







	</div>
</div>

<script type="text/javascript">   function addTeamValidation()    {         var val=$("#select-id").chosen().val();      if (val==null)       {         $("#myDIV").show();         return false;      }      var pro=$("#property-id").chosen().val();      if (pro==null)       {         $("#myProDIV").show();         return false;      }         return true;   }</script>