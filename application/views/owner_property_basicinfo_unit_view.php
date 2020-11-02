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

   <div class="tab-content p-3" id="myTabContent">


      <div class="tab-pane fade <?php echo $current_tab=='units' ? 'show active' : ''?>"" id="units" role="tabpanel" aria-labelledby="profile-tab">

      <div class="action-top d-flex justify-content-between">

      <div class="switch d-flex justify-content-between">

        <div class="filter pull-left">

         <div class="switch ">

          <form action = "check.php" method = "post">

                <label class="cls_opn">

               

                  <span class="closed_right">Archived</span>



                    <input type="checkbox" onchange="maintainceRequest();" id="statusChacked" <?php if($status==1 ){?> checked <?php }?> >

                  <span class="lever"></span>

                  <span class="open_left">Active</span>

                </label>

              </form> 

           

         </div>

       </div>

      

      </div>

      <div>

    <!--data-toggle="modal" -->
      <button type="button" class="btn btn-raised btn-primary"  data-target="#unitModal" data-backdrop="static" data-keyboard="false">

      Add UNIT

      </button>


      <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

      <div class="modal-content">

      <div class="modal-header">

      <h5 class="modal-title" id="exampleModalLabel">ADD UNIT TO PROPERTY</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

      <span aria-hidden="true">&times;</span>

      </button>

      </div>

      <div class="modal-body">

      <div class="row">

      <div class="tab-content p-3 width_p" id="myTabContent">

      <div class="tab-pane fade show active" id="property" role="tabpanel" aria-labelledby="home-tab">

      <div class="card col-md-12">

      <div class="card-body">

      <form id="addUnitForm">

      <input type="hidden" id="property_id" name="property_id" value="<?php echo $propertyData['id']?>">

      <div class="form-group ">

      <label for="address " class="bmd-label-floating">Unit  *</label>

      <input type="text" name="unit" class="form-control" id="unit">

      <span style='color:red' id="uniterr"></span>

      </div>

      <div class="form-group">

      <button type="submit" class="btn btn-primary btn-raised">Save</button>

      <button class="btn btn-default" data-dismiss="modal">Cancel</button>

      </div>

      </form>

      </div>

      </div>

      </div>

      </div>

      </div>

      </div>

      </div>

      </div>

      </div>



      </div>

      </div>

      <div id="unit_hide">

      <div   class="row" >

      

      <?php if(!empty($propertyUnits)) {

         $count = 0;

         foreach($propertyUnits as $propertyUnit) {

            if(1==0) {}

            else

            {

         ?>

      <div class="col-md-4">

      <div class="card mb-3">

      <div class="card-body">

      <div class="form-group">

     

      <button class="editUnit save_change" data-unit='<?php echo $count;?>' data-propid='<?php echo $propertyUnit['property_id']?>' data-id='<?php echo $propertyUnit['id']?>' >UPDATE</button>

      

     
      Unit<input type="text" class="form-control" value="<?php echo $propertyUnit['unit']?>">

      <span style='color:red' id="updateuniterredit_<?php echo $propertyUnit['id'];?>"></span>



      </div>

      <div class="row achive_bottom_m">

         <div class="col-md-1  checkbox_padding">

          <div class="form-group ">

            <input type="checkbox" class="chackbox font-color" style="height: 50px;width: 24px;" value="1" name="status_<?php echo $propertyUnit['id'];?>" id="status_<?php echo $propertyUnit['id'];?>" 

              <?php if($propertyUnit['status']==0){?>

              checked

            <?php }?>>

          </div>

        </div>

        <div class="col-md-4">

           <label for="address" class="bmd-label-floating" style="margin-top: 20px; color: black;"> Archive </label>

        </div>

       

      </div>

     

      

      <p class="text-muted mb-3"><input type="checkbox" value="1" name="familyhome_<?php echo $propertyUnit['id'];?>" id="familyhome_<?php echo $propertyUnit['id'];?>" <?php echo $propertyUnit['familyhome_status'] == 1 ? 'checked' : ''?>>Single Family Home</p>

      <div class="d-flex justify-content-between">

      

      <div>

      <div class="switch">

      <label><input type="checkbox" checked></label>

      </div>

      </div>

      </div>

      </div>

      </div>

      </div>

      <?php }

      $count++;}}?>

      </div>

    </div>

      </div>

      

   </div>

</div>



<script>

function maintainceRequest()

{

  if($('#statusChacked').is(':checked'))

  {  

    document.location.href="<?php echo base_url('owner/property_basicinfo_unit/').$propertyData['id'];?>/units/1";

  }

  else 

  {



    document.location.href="<?php echo base_url('owner/property_basicinfo_unit/').$propertyData['id'];?>/units/0";

  }

}

</script>

