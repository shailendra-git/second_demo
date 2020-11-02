<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.error{
  color:red;
}
</style>
<div class="contnet-area">



   <div class="bg-theme text-white">



      <nav class="navbar navbar-light bg-white sub-navbar">



         <ul class="nav nav-tabs" id="myTab" role="tablist">

             <li>

            <div class="dropdown">

    
          <span class="btn btn-raised btn-primary dropdown-toggle bt_4" type="button" id="dropdownMenuButton" style="margin-top: 10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $propertyData['address'];?>
            
      
        </span>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php 
              if (isset($propertyAllData))

              foreach($propertyAllData as $value)
              {?>

                 <a class="dropdown-item " href="<?php echo base_url('owner/property_basicinfo/'.$value['id'].'/basic-info') ?>"><?php echo substr( $value['address'],0,30)?></a>

             <?php }?>

          </div>

        </div>

          </li>

            <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='basic-info' ? 'active' : ''?>" id="property-tab" data-toggle="tab" href="#property" role="tab" aria-controls="property" aria-selected="true">Property Info</a>



            </li>



             <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='property_basicinfo_unit' ? 'active' : ''?>"  href="<?php echo base_url('owner/property_basicinfo_unit/').$propertyData['id'];?>/units" role="tab" aria-controls="guide" aria-selected="false">House / Unit</a>



            </li>



            <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='editproperty_guide' ? 'active' : ''?>"   id="guide-tab"  href="<?php echo base_url('owner/editproperty_guide/').$propertyData['id'];?>" role="tab"  aria-controls="guide" aria-selected="false">Guide</a>



            </li>



         </ul>



      </nav>



   </div>



  



    <div class="tab-pane fade basic_indo_margin <?php echo $current_tab=='basic-info' ? 'show active' : ''?>" id="property" role="tabpanel" aria-labelledby="home-tab">



         <div class="card col-md-8 sm-3">



            <div class="card-body">



               <form style="height: 1100px;" id="property_edit_validation" action="<?php echo base_url('owner/editproperty_basicinfo')?>" method="POST">



                  <input type="hidden" name="property_id" value="<?php echo $propertyData['id']?>">



                  <input type="hidden" name="lat" id="lat" value="<?php echo $propertyData['lat']?>">



                  <input type="hidden" name="lng" id="lng" value="<?php echo $propertyData['lng']?>">



                  <div class="form-group">



                     <label for="address " class="bmd-label-floating">Address  *</label>



                     <input type="address" name="address" class="form-control" id="pac-input" value="<?php



                        echo $propertyData['address'];



                        ?>">



                  </div>



                  <div id="map"></div>



                  <div class="form-group">



                     <label for="address" class="bmd-label-floating">Time Zone *</label>



                     <div class="select-wrapper">



                        <select class="form-control" id="exampleFormControlSelect1" name="timezone">



                           <option <?php echo $propertyData['timezone'] == 1 ? 'selected' : ''?>>1</option>



                           <option <?php echo $propertyData['timezone'] == 2 ? 'selected' : ''?>>2</option>



                           <option <?php echo $propertyData['timezone'] == 3 ? 'selected' : ''?>>3</option>



                           <option <?php echo $propertyData['timezone'] == 4 ? 'selected' : ''?>>4</option>



                           <option <?php echo $propertyData['timezone'] == 5 ? 'selected' : ''?>>5</option>



                        </select>



                        <span class="caret">▼</span>



                     </div>



                  </div>



                  <div class="form-group maintenance-input">



                     <label for="maintenance " class="bmd-label-floating">Maintenance Threshold *</label>



                     <div class="input-group">



                        <span class="input-group-text" >$</span>



                        <input type="number" class="form-control" id="maintenance" name="maintenance_threshold" value="<?php echo $propertyData['maintenance_threshold']?>">



                     </div>



                  </div>



                  <div class="form-group maintenance-input">



                     <label for="maintenance " class="bmd-label-floating">PropertyManager Name</label>



                     <div class="input-group">



                        <span class="input-group-text" ></span>



                        <input type="text" class="form-control" id="propertymanager_name" name="propertymanager_name" value="<?php echo $propertyData['propertymanager_name']?>">



                     </div>



                  </div>



                   <div class="form-group maintenance-input">



                     <label for="maintenance " class="bmd-label-floating">PropertyManager Email</label>



                     <div class="input-group">



                        <span class="input-group-text" ></span>



                        <input type="text" class="form-control" id="propertymanager_email" name="propertymanager_email" value="<?php echo $propertyData['propertymanager_email']?>">



                     </div>



                  </div>



                   <div class="form-group maintenance-input">



                     <label for="maintenance " class="bmd-label-floating">PropertyManager Phone</label>



                     <div class="input-group">



                        <span class="input-group-text" ></span>



                        <input type="text" class="form-control" id="propertymanager_phone" name="propertymanager_phone" value="<?php echo $propertyData['propertymanager_phone']?>" maxlength="10">



                     </div>



                  </div>



                  <div class="form-group">



                     <small class="text-muted  mt-3">Maintenance coordinator will use this to automatically approve work order pricing estimates. If this amount is set to $0 pricing should be approved by the property owner for every request.



                     </small>



                  </div>



                  <div class="form-group">



                     <label for="Notes" class="bmd-label-floating">Additional Notes</label>



                     <div class="input-group">



                        <input type="text" class="form-control" id="notes" name="notes" value="<?php echo $propertyData['notes'];?>">



                     </div>



                  </div>



                  <div class="form-group">



                     <small class="text-muted mt-3">Use this to write down information such as key codes, insurance policy numbers, and etc. This is only visible to you and your property members.



                     </small>



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



               if(!empty($propertydocs))



               {



                foreach ($propertydocs as $propertydoc) { 



                  $filename = explode('.',$propertydoc['file_name']);



               



                  ?>



            <div id="<?php echo $filename[0]?>"  >



            <div style="float: left; margin: 10px; margin-left: 0px;">


                <a class="example-image-link" href="<?php echo base_url('upload/property_doc/').$propertydoc['file_name']?>" data-lightbox="example-set">
                 <img  src="<?php echo base_url('upload/property_doc/').$propertydoc['file_name']?>" class="example-image img-thumbnail size_image">
                 </a>



                  <div>



                  <center>



               <button class='remdoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $propertydoc['property_id']?>" rem-file="<?php echo $propertydoc['file_name']?>" >



                  Remove</button>



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



         <h6 class="mb-3">Private Property Documents</h6>



         <p class="text-small text-secondary my-3">Documents uploaded here are only visible to you and property members who can access the Property tab.



         </p>



         



         <form action="<?php echo base_url('owner/property_doc_uploadAndDelete')?>" class="dropzone" id=""> 



         <input type="hidden" name="property_doc_id" value="<?php echo $propertyData['id']?>">    



         </form>



         </div>



         </div>



      </div>



</div>



<script>

    $("#property_edit_validation").validate({
           
           rules : {
              address : {
                 required : true,
                 normalizer: function(value) {
                             return $.trim(value);
                 },   
              },
              maintenance_threshold : {
                 required : true,  
              },
           },
           messages : {
             address : {
                 required : "Please Enter Address",
            
              },
               maintenance_threshold : {
                 required : "Please Enter Maintenance Threshold",  
              },

           },
            submitHandler: function(form) {
              $(form).submit();
            }
     });
      
</script>
<script>
    function initAutocomplete() {




        var map = new google.maps.Map(document.getElementById('map'), {



          center: {lat: <?php echo $lat;?>, lng: <?php echo $lng;?>},



        


          zoom: 13,



          mapTypeId: 'roadmap'



        });







        var myLatLng = {lat: <?php echo $lat;?>, lng: <?php echo $lng;?>};



        var marker = new google.maps.Marker({



            position: myLatLng,



            title:"<?php echo $address;?>"



        });







        marker.setMap(map);



      


        



        var input = document.getElementById('pac-input');



        var searchBox = new google.maps.places.SearchBox(input);





        map.addListener('bounds_changed', function() {



          searchBox.setBounds(map.getBounds());



        });







        var markers = [];



      


        searchBox.addListener('places_changed', function() {



        

          var places = searchBox.getPlaces();









          if (places.length == 0) {



            return;



          }



          







          



          markers.forEach(function(marker) {



            marker.setMap(null);







          });



          markers = [];







        


          var bounds = new google.maps.LatLngBounds();



          places.forEach(function(place) {



            if (!place.geometry) {



              console.log("Returned place contains no geometry");



              return;



            }







            document.getElementById('lat').value =place.geometry.location.lat();



            document.getElementById('lng').value =place.geometry.location.lng();



            

            var icon = {



              url: place.icon,



              size: new google.maps.Size(71, 71),



              origin: new google.maps.Point(0, 0),



              anchor: new google.maps.Point(17, 34),



              scaledSize: new google.maps.Size(25, 25)



            };







           


            markers.push(new google.maps.Marker({



              map: map,



              icon: icon,



              title: place.name,



              position: place.geometry.location



            }));







            if (place.geometry.viewport) {



             

              bounds.union(place.geometry.viewport);



            } else {



              bounds.extend(place.geometry.location);



            }



          });



          map.fitBounds(bounds);



        });



      }


    </script>


    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo($this->config->item('google_api_key'));?>&libraries=places&callback=initAutocomplete"



         async defer></script>
