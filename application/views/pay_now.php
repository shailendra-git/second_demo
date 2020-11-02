<div class="contnet-area"> 
  <form  action="<?php echo base_url('payment/processToPay')?>" method="POST" >                 
    <div class="form-group"> 
      <div class="row bottom "> 
        <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 " >               
        </div>                  
        <div class="  col-lg-6 col-md-6 col-sm-12 col-xs-12 " >                    
          <h3 style="margin-top: 30px;">Select Property Payment
          </h3>                    
          <br> 
          <hr>                    
          <input type="hidden" name="pay_per_property" value="<?php echo($this->config->item('PropertyRate'));?>">                      
          <input type="hidden" name="discount" value="0">                       
          <br>                                              
          <label for="address" class="bmd-label-floating">Select Property*
          </label>                      
          <div class="select-wrapper">                                                  
            <?php                           $owner_id= $this->session->userdata('owner_id');                                                     if(!empty($prodata))                            {                              foreach($prodata as $property)                              {                              $startdate = $paycount['next_subcription_date'];                              $expire = strtotime($startdate);                              $today = strtotime("today midnight");                              if($today >= $expire)                               {                                                                $this->db->select('count(*) as propertyCount');                                 $this->db->from('onelane_properties');                                 $this->db->where('onelane_properties.owner_id',$owner_id);                                 $this->db->where('onelane_properties.status ','Open');                                 $permissions = $this->db->get()->result_array();                                                                  if(!empty($permissions))                                 {                                                                  foreach ($permissions as $permission)                                      {                                        $j= $permission['propertyCount'];                                                                             }                                  }                                 $s =$j;                              }                              else                              {                                ?>                                                               
            <?php                                 $this->db->select('count(*) as propertyCount');                                 $this->db->from('onelane_properties');                                 $this->db->where('onelane_properties.owner_id',$owner_id);                                 $this->db->where('onelane_properties.status ','Open');                                 $permissions = $this->db->get()->result_array();                                 if(!empty($permissions))                                 {                                                                  foreach ($permissions as $permission)                                      {                                        $j= $permission['propertyCount'];                                                                             }                                  }                                   $s= $j-$paycount['subscribe_properties'];                                }                                                              }                            }                                                    ?>                           
            <select  id="mySelect" onchange="myFunction()"   name="num_of_properties" class="form-control" rem-file="due_on">                            
              <?php                          $i="1";                          for ($i=1; $i<= $s; $i++) {                                                       ?>                                
              <option value="<?php echo $i; ?>" 
                      <?php if($i==$s){echo "selected";}?>> 
              <?php echo $i; ?>
              </option>                            
            <?php                           }                                                 ?>                         
            </select>                          
          <div id="demo">
          </div>                                                                                    
          <span class="caret">▼
          </span>                      
        </div>                     
        <div class="modal-footer">                           
          <button type="submit" style="margin-top: 30px;" class="btn2 btn_team_edit_save">Pay To Process
          </button>                                                  
        </div>       
        </form>                   
    </div>           
    </div>          
</div>                    
</div>
