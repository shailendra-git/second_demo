<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



<form   action="<?php echo base_url('team/updateCO_TenantData')?>" target="_parent" method="POST" class="popup_form_margin">



    <h1 style="margin: 60px;">Update Co-TENANT</h1>



                              <div class="form-group">







                                <?php



                                $j=1;







                                foreach ($coTenantData as $row) {



                                  



                                ?>



                                 <input type="hidden" name="tenant_id" value="<?php echo $row['tenant_id'] ?>">



                                 <input type="hidden" name="id_<?php echo $j; ?>" id="id_<?php echo $j; ?>" value="<?php echo $row['id'] ?>">







                                 <div class="row bottom">



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">



                                          Co-applicant Name *</label>



                                          <div class="input-group">



                                             



                                             <input type="text" class="form-control"  required="" id="co_applicant_name_<?php echo $j; ?>" name="co_applicant_name_<?php echo $j; ?>" value="<?php echo $row['co_applicant_name'] ?>">



                                          </div>  



                                       </div>



                                     </div>







                                   



                                   



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>



                                          <div class="input-group">



                                             



                                             <input type="text" class="form-control" required="" name="co_applicant_mobile_<?php echo $j; ?>" id="co_applicant_mobile_<?php echo $j; ?>"  value="<?php echo $row['co_applicant_mobile'] ?>">



                                          </div>



                                       </div>



                                    </div>



                                  </div>



                                  <div class="row bottom">



                                     <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 " >



                                       <div class="form-group">



                                        <label for="address " class="bmd-label-floating">Co-applicant Email  *</label>



                                         <input type="email" required="" name="co_applicant_email_<?php echo $j; ?>" id="co_applicant_email_<?php echo $j; ?>" class="form-control"   value="<?php echo $row['co_applicant_email'] ?>" 



                                        >



                                       



                                      </div>



                                    </div>



                                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 " >



                                        



                                        <a id="delete_btn_<?php echo $j;?>" class=' m_top_buttom ' file-name='<?php echo $row['co_applicant_name'];?>'  file-phone="<?php echo $row['co_applicant_mobile'];?>" file-email="<?php echo $row['co_applicant_email'];?>" data-proid="<?php echo $row['id']?>" onclick="deleteCoTenant(<?php echo $j;?>,<?php echo $row['id']?>)">



                                          <i class="fa fa-trash" style="font-size:24px;color:red"></i>



                                         </a>



                                     </div>



                                   </div>



                                   







                                     <?php







                                       $this->db->select('count(*) as counttennat');



                                        $this->db->from('co_tenant');



                                        $this->db->where('co_tenant.tenant_id',$row['tenant_id']);



                                        $permissions = $this->db->get()->result_array();



                                         if(!empty($permissions))



                                         {



                                        



                                         foreach ($permissions as $counttenant) {







                                            if ($counttenant['counttennat']==1) {?>



                                               



                                                <div class="row bottom">



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                     



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">



                                          Co-applicant Name *</label>



                                          <div class="input-group">



                                             



                                             <input class="form-control" name="co_applicant_name_2" >



                                          </div>



                                       </div>



                                     </div>



                                   



                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >



                                       <div class="form-group maintenance-input ">



                                          <label for="maintenance " class="bmd-label-floating">Co-applicant Phone Number *</label>



                                          <div class="input-group">



                                             



                                             <input class="form-control" name="co_applicant_mobile_2">



                                          </div>



                                       </div>



                                    </div>



                                  </div>



                                  <div class="row bottom">



                                     <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 " >



                                       <div class="form-group ">



                                        <label for="address " class="bmd-label-floating">Co-applicant Email  *</label>



                                         <input type="email" name="co_applicant_email_2" class="form-control" 



                                                             autocomplete="off">



                                       



                                      </div>



                                    </div>



                                   </div>



                               </div>



                               



                              <?php



                                    }  



                                          }



                                        }



                                      $j++;



                                        }



                                        ?>











                                      







                              </div>



                               <div class="modal-footer">



                <button type="submit" class="btn btn-primary btn-raised btn_team_edit_save" style="padding: 8px 25px;">SAVE</button>



                <button type='button' class="btn btn-default btn_cancle" >Cancel</button>



                        </div>



                           </form>







  



  







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script>



   function showDiv(element)



   {



      document.getElementById('hidden_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';







      document.getElementById('hide_div').style.display = element.value == 1||2||3||4||5||6||7 ? 'block' : 'none';



   }



</script>