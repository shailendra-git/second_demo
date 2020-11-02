<div class="contnet-area">



   <div class="container">



      <div class="row bg">



         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " >



            <form action="<?php echo base_url('team/getTeams')?>" method="POST">



               <select data-ember-action="" data-ember-action-1206="1206" class="bor" name="searchFilter" id="searchFilter">



                  <option value="all">All &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret">▼</span> </option>



                    <?php



                  foreach ($services as $service) {?>



                  <option value="<?php echo $service['id']?>" <?php echo $search_by==$service['id'] ? 'selected' : ''?>><?php echo $service['name']?></option>



                  <?php }



                  ?>



               </select>



            </form>



         </div>



         <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 "  >



          



            <div><a class=" btn2 new_req_btn add_services_mobile  simple-ajax-popup-align-top btn btn-raised btn-primary btnn1" href="/team/addServicePro" >



            ADD SERVICE PRO



            </a><span>



            <?php



            if ($this->session->userdata('user_type')!='4') {?>



               <a style="margin-right: 10px;" class=" btn2 new_req_btn add_services_mobile  simple-ajax-popup-align-top btn btn-raised btn-primary btnn1" href="/team/addPropertyUser" >



            ADD PROPERTY USER



            </a>



            <?php }?>



         </span></div>



            











            <div style="color: red;"><?php echo $this->session->flashdata('errmsg')?></div>




            







         </div>



         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table_overflow" >



            <style>



            table {



              font-family: arial, sans-serif;



              border-collapse: collapse;



              width: 100%;



            }







            td, th {



             



              padding: 6px;



            }







            </style>



            <table class="border1 dis" width="100%"  cellpadding="20px" >



               <thead class="border1">



                  <tr>



                     <th class="name">Name</th>



                     <th class="contact-info">Contact Info</th>



                     <th class="expertise">Expertise</th>



                      <th class="expertise">Properties</th>



                  </tr>



               </thead>



               <tbody class="border1">



                  <?php



                  if(!empty($teamsData)){



                     foreach($teamsData as $team)

                     {
                     ?>             



                     <tr>



                        <?php if ($team['user_type']!='1') 



                        {?>











                           <td>



                              <?php if ($team['user_type']=='2') 



                                 {?>







                             <?php }else{



                              ?>



                             



                              <a class="simple-ajax-popup-align-top" href="/team/getTeamById/<?php echo $team['id'] ?>" style="color:#009688;" >



                              <?php echo ucfirst($team['contact_name'].' ');?>



                              </a>



                     

                                       <a class="simple-ajax-popup-align-top" href="/team/editPropertyUser/<?php echo $team['id'] ?>" style="color:#009688;" ><?php echo ucfirst($team['firstname']); ?></a>



                                    <?php echo $team['company_name'];?>



                              <?php }?>



                           </td>



                           <td>







                              <?php if ($team['user_type']=='2') 



                                 {?>







                              <?php }else{



                              ?>



                              <a href="#">



                              <?php echo $team['mobile'];?>



                              </a><br>



                              <?php echo $team['email'];?>



                        



                              <?php }?>



                           </td>



                           <td class="right-align" >



  



                              <?php if ($team['user_type']=='2') 



                                 {?>







                             <?php }



                             elseif ($team['user_type']=='3')



                             {



                              ?>



                              



                              <?php



                              



                              $this->db->select('*');



                              $this->db->from('worker_services');



                              $this->db->join('services','worker_services.service_id = services.id');







                              $this->db->where('worker_services.user_id',$team['id']);



                            







                              $services = $this->db->get()->result_array();



                              if(!empty($services)){





                              foreach ($services as $service) {



                                 ?>



                                 <span class="border-design">



                                 <?php



                                 echo  $service['name']; ?>



                                 </span>



                                 <?php



                              }



                              }



                           }else



                           {



                              ?>







                              



                                <?php



                                 $this->db->select('*');



                                 $this->db->from('agent_permissions');



                                 $this->db->where('agent_permissions.agent_id',$team['id']);



                                $this->db->order_by("agent_permissions.agent_id","DESC");



                                 $permissions['data']= $this->db->get()->row_array();



                                 $dataarray['permissions'] =  $permissions['data']['permissions'];



                                 



                                 $data['selected_permissions'] =explode(",", $dataarray['permissions']); 







                                 $permissions = $data['selected_permissions'];








                                 if(!empty($permissions)){



                               



                                 foreach ($permissions as $permission) { ?>



                                    <span class="border-design">



                                       <?php



                                    echo $permission;?>



                                 </span>



                                 <?php



                                 }    



                              



                                 }



                                 }?>



                           </td>



                           <td class="right-align">



                              <?php if ($team['user_type']=='2') 



                                 {?>







                             <?php }else{



                              ?>



                                  



                                    <?php



                                    if ($this->session->userdata('user_type')!='4') {?>



                                       <?php



                                       $this->db->select('*');



                                       $this->db->from('worker_property');



                                        $this->db->join('properties','worker_property.property_id = properties.id');



                                       



                                       $this->db->where('worker_property.user_id',$team['id']);



                                      







 







                                      



                                       $properties = $this->db->get()->result_array();



                                       if(!empty($properties)){



                                      



                                       foreach ($properties as $property) {



                                          $prodata =$property['address'];



                                          ?>



                                       <span class="border-design">



                                          



                                          <?php echo substr($prodata,0,30);?>



                                       </span>



                                          <?php



                                       }



                                       }



                                    }



                                    else



                                    {



                                       $this->db->select('*');



                                       $this->db->from('worker_property');



                                       $this->db->join('properties','worker_property.property_id = properties.id');



                                       $this->db->join('agent_property','worker_property.property_id = agent_property.property_id');







                                     



                                       $this->db->where('worker_property.user_id',$team['id']);



                                        $this->db->where('agent_property.agent_id',$this->session->userdata('agent_id'));



                                      



 



                                       $properties = $this->db->get()->result_array();



                                       if(!empty($properties)){



                                     



                                       foreach ($properties as $property) { 



                                          $prodata= $property['address'];



                                          ?>



                                          <span class="border-design">



                                          



                                            <?php echo substr($prodata,0,30);?>



                                          </span>



                                    <?php



                                       }



                                       }



                                    }



                                 ?>







                               



                                <?php



                              $this->db->select('*');



                              $this->db->from('agent_property');



                              $this->db->join('properties','agent_property.property_id = properties.id');



                              $this->db->where('agent_property.agent_id',$team['id']);



                              



                            



                              $properties = $this->db->get()->result_array();



                              if(!empty($properties)){



                             



                              foreach ($properties as $property) {







                                 $prodata= $property['address'];?>



                                 <span class="border-design">



                                   <?php echo substr($prodata,0,30);?>



                                 </span>



                             <?php  



                              }



                              }



                              ?>



                            



                           <?php }?>



                           </td>



                        <?php }?>



                     </tr>



                  <?php }}



                  else



                  {



                     if(!empty($teamsDataByFilter)){



                     foreach($teamsDataByFilter as $team)



                     {



                     ?>             



                     <tr>



                     <td>



                     <a  href="#"  class="blue editWorker" data-workerid='<?php echo $team['user_id'] ?>' data-toggle="modal" data-target="#editModal">



                     <?php echo ucfirst($team['contact_name']);?>



                     <?php echo $team['company_name'];?>



                     </a>                        



                     </td>



                     <td>



                        <a href="#">



                        <?php echo $team['mobile'];?>



                        </a><br>



                        <?php echo $team['email'];?>



                        </a>



                     </td>



                     <td class="right-align">



                        <?php



                        $this->db->select('*');



                        $this->db->from('worker_services');



                        $this->db->join('services','worker_services.service_id = services.id');



                        $this->db->where('worker_services.user_id',$team['user_id']);



                        



                        $services = $this->db->get()->result_array();







                        if(!empty($services)){



                      



                        foreach ($services as $service) { ?>



                            <span class="border-design">



                              <?php



                           echo $service['name'];?>



                        </span>



                           <?php



                        }



                        }



                       



                        ?>



                     </td>



                      <td class="right-align">



                        <?php



                        $this->db->select('*');



                        $this->db->from('worker_property');



                        $this->db->join('properties','worker_property.property_id = properties.id');



                        $this->db->where('worker_property.user_id',$team['user_id']);







                        



                        $properties = $this->db->get()->result_array();







                        if(!empty($properties)){



                      



                        foreach ($properties as $property) {



                           $prodata= $property['address'];



                           ?>



                            <span class="border-design">



                             <?php echo substr($prodata,0,30);?>



                        </span>



                        <?php



                          



                        }



                        }



                        



                        ?>



                     </td>



                  </tr>



                  <?php }}



                     } ?>



                  <!---->            



               </tbody>



            </table>



         </div>



      </div>



   </div>



</div>



<script type="text/javascript">



   function addTeamValidation() 



   {



    


      var val=$("#select-id").chosen().val();



      if (val==null) 



      {



         $("#myDIV").show();



         return false;



      }



      var pro=$("#property-id").chosen().val();



      if (pro==null) 



      {



         $("#myProDIV").show();



         return false;



      }



         return true;



   }



</script>



<script type="text/javascript">











</script>



