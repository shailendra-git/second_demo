<div class="contnet-area">
   <div class="container">
      <div class="row bg">
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " >                     </div>
         <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 "  >
         
            <div style="color: red;"><?php echo $this->session->flashdata('errmsg')?></div>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_overflow" >
            <style>            table {              font-family: arial, sans-serif;              border-collapse: collapse;              width: 100%;            }            td, th {                            padding: 6px;            }            </style>
            <table class="border1" width="100%" class="dis" cellpadding="20px" >
               <thead class="border1">
                  <tr>
                     <th class="name">COTENANT NAME</th>
                     <th class="contact-info">COTENANT MOBILE</th>
                     <th class="expertise">COTENANT EMAIL</th>
                     
                  </tr>
               </thead>
               <tbody class="border1">
                  <?php                  if(!empty($cotenants))                  {                     foreach($cotenants as $team)                     {                     ?>                                  
                  <tr>
                     <td>                 
                     <?php echo ucfirst($team['co_applicant_name'].' ');?>
                    </td>
                     <td>                 
                     <?php echo ucfirst($team['co_applicant_mobile'].' ');?>
                    </td> <td>                 
                     <?php echo ucfirst($team['co_applicant_email'].' ');?>
                    </td>
			        

                  
       
            
                  </tr>
                  <?php }} ?>               
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
