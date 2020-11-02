<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.error{
  color:red;
}
#datepicker , #datepicker1 {
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    text-align: center;
}
.complete{
  color:#4caf50!important;
}
.incomplete{
  color:#ff0000;
}
a.nav-link {

    margin: 0px 30px;
}
</style>
<div class="contnet-area">

    <ul class="nav nav-tabs" style="background-color:#fff">
          <li class="nav-item">
            <a class="nav-link <?php echo $active; ?>" href="<?php echo base_url('/financial/transaction'); ?>">Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/recurring'); ?>">Recurring</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/leaseLedgerData'); ?>">Lease Ledger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/financial/IncomeExpenseData'); ?>">Income & Expense</a>
          </li>
    </ul>

  <div class="container container_m_padding">

   <div class="bg-theme text-white">



      <nav class="navbar navbar-light bg-white sub-navbar">



         <ul class="nav nav-tabs" id="myTab" role="tablist">

             <li>

            <div class="dropdown">

    
          <span class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-top: 10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $propertyData['address'];?>
            
      
        </span>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php 
              if (isset($propertyAllData))

              foreach($propertyAllData as $value)
              {?>

                 <a class="dropdown-item " href="<?php echo base_url('financial/financial_property_basicinfo/'.$value['id']) ?>"><?php echo substr( $value['address'],0,30)?></a>

             <?php }?>

          </div>

        </div>

          </li>

    <!--         <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='basic-info' ? 'active' : ''?>" id="property-tab" data-toggle="tab" href="#property" role="tab" aria-controls="property" aria-selected="true">Property Info</a>



            </li> -->


<!-- 
             <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='property_basicinfo_unit' ? 'active' : ''?>"  href="<?php echo base_url('owner/property_basicinfo_unit/').$propertyData['id'];?>/units" role="tab" aria-controls="guide" aria-selected="false">House / Unit</a>



            </li> -->



        <!--     <li class="nav-item basic_info_margin">



               <a class="nav-link <?php echo $current_tab=='editproperty_guide' ? 'active' : ''?>"   id="guide-tab"  href="<?php echo base_url('owner/editproperty_guide/').$propertyData['id'];?>" role="tab"  aria-controls="guide" aria-selected="false">Guide</a>



            </li> -->



         </ul>



      </nav>



   </div>



  



    <!-- <div class="tab-pane fade basic_indo_margin <?php echo $current_tab=='basic-info' ? 'show active' : ''?>" id="property" role="tabpanel" aria-labelledby="home-tab"> -->
      <div class="row row_bottom">
              <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                <div class="action-top d-flex justify-content-between">
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><h1>Record Payments<h1></div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="filter pull-left">
                      <div class="dropdown">
                        <button class="btn btn-raised btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-bottom: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                          OFFLINE PAYMENT
                  
                        </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <!-- <a class="simple-ajax-popup-align-top dropdown-item add_transaction"  href="one_time_popup" value="one-time">Record one-time</a> -->
                            <a class="dropdown-item add_transaction  simple-ajax-popup-align-top" href="/financial/one_time_popup/<?php echo $financial_id; ?>">Record one-time</a>
                            <a class="dropdown-item add_recurring simple-ajax-popup-align-top" href="/financial/recurring_popup" value="recurring">Record recurring</a>
                            <!-- <a class="dropdown-item" href="#" value="request">Record against online request</a> -->
                        </div>

                      </div>
                    </div>
                  </div>
                 </div>
              </div>
      </div>


      <div class="row row_bottom">
      <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="action-top d-flex">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
           <div class="select-wrapper">
              <select class="form-control" name="select_tra_list" id="select_tra_list">
                 <option value="">All Active</option>
                 <option value="complete">Complete</option>
                 <option value="intransit">In transit</option>
                 <option value="incomplete">Incomplete</option>
                 <option value="cancelled">Cancelled</option>
              </select>
              <span class="caret">▼</span>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="select-wrapper">
              <select class="form-control" name="category"  id="select_category_list">
                 <option value="">All Services</option>
                    <?php
                     foreach ($transaction_category as $category) {
                    ?>
                     <option  value="<?php echo $category['id'];?>"><?php
                     echo ucfirst($category['category_show_name']);
                     ?></option>
                    <?php
                     }
                    ?>
              </select>
              <span class="caret">▼</span>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
           <span style="font-size:12px">Due date from</span> 
           <input type="text" id="datepicker" placeholder="Any" name="start_date" autocomplete="off"> to <input type="text" id="datepicker1" placeholder="Any" name="end_date" autocomplete="off"> 
           <button onclick="searchbydata();"class="btn btn-primary" style="background-color:#008276;color:#ffffff"><i class="fa fa-search" aria-hidden="true"></i></button> 
           <button onclick="submitExport()"   class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
              <form  id="submit_data" method="POST" action="<?php echo base_url('financial/transactionExportCSV/'); ?>">
                <input type="hidden" name="exp_status" id="exp_status" value="">
                <input type="hidden" name="exp_category" id="exp_category" value="">
                <input type="hidden" name="exp_end_date" id="exp_end_date" value="">
                <input type="hidden" name="exp_start_date" id="exp_start_date" value="">
                <button type="submit"  style="display:none" class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
              </form>
          </div>
        </div>
      </div>
      </div>

        <div class="row row_bottom">
        <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
          <div class="action-top d-flex">
            <table class="table table-hover" id="userstatusdata">
              <!-- <tr><td><p>Date: <input type="text" id="datepicker"></p></td></tr> -->
              <!-- <tr><td colspan="3">Due date from <input type="text" id="datepicker" placeholder="Any" name="start_date"> to <input type="text" id="datepicker1" placeholder="Any" name="end_date"> <button onclick="searchbydata();"class="btn btn-primary" style="background-color:#008276;color:#ffffff">Search</button></td> -->
              <tr><td colspan="3"></td>
                <td colspan="3"> 
                  <div class="select-wrapper" >
                   <!--  <form  id="submit_data" method="POST" action="<?php echo base_url('financial/exportCSV/'); ?>">
                      <input type="hidden" name="exp_status" id="exp_status" value="">
                      <input type="hidden" name="exp_category" id="exp_category" value="">
                      <input type="hidden" name="exp_end_date" id="exp_end_date" value="">
                      <input type="hidden" name="exp_start_date" id="exp_start_date" value="">
                      <button type="submit" class="btn" style="background-color:#009688; color:#ffffff;"><i class="fa fa-download" aria-hidden="true"></i></button>
                    </form> -->
                  <!-- <button class="btn"  style="background-color:#009688; color:#ffffff;">DOWNLOAD</button> -->
                   <!--  <select class="form-control">
                       <option><span class="caret">▼</span> DOWNLOAD</option>
                       <option>Invoices</option>
                       <option>Payments</option>
                    </select> -->
                  </div>
                </td>
              </tr>
              <tr>
                 <th></th>
                 <th>INFO</th>
                 <th>CATEGORY<br><small>MONEY TYPE</small></th>
                 <th>STATUS<br><small>DUE DATE</small></th>
                 <th>BALANCE<br><small>TOTAL</small></th>
                 <th>ACTIONS</th>
              </tr>
              <?php
              foreach ($getFinancialData as $data) {
                if($data['payment_type'] == 1){

                     $payment_type = 'One-time';
                }else{

                     $payment_type = 'Recurring';
                }
                ?>
                <tr>
                  <td  class="arrow_val" onclick="showTrascationRow(<?php echo $data['id']; ?>)"><i class="fa fa-caret-right" aria-hidden="true"></i></td>
                  <td><?php echo  $data['group_name']; ?> Paid you<br><small><?php echo $data['address'].', unit-'.$data['unit']; ?><small></td>
                  <td><?php echo ucfirst($data['category_show_name']);    ?><br><small><?php echo $payment_type; ?></small></td>
                  <td><span class="<?php echo $data['status'];  ?>"><?php echo ucfirst($data['status']);  ?></span><br><small><?php if($data['payment_type'] == 2){ echo $data['start_date']; }else{ echo $data['date']; }?></small></td>
                  <?php if($data['payment_type'] == 2){
                   ?>
                   <td>$<?php echo $data['due_amount']; ?></td>
                   <?php 
                  }else{
                    ?>
                  <td>$<?php echo $data['paid_amount'];  ?><br><small>$<?php echo $data['amount']; ?></small></td>
                  <?php
                  }
                  ?>
                  <td><a href="/financial/transaction_view/<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="auto" title="View"><button class="btn" style="background-color:#008276;"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
                </tr>
                <tr id="transaction_<?php echo $data['id']; ?>" style="display:none">
                  <td></td>
                    <td colspan="5">
                 <p>Payments</p>
                 <br>
                 <?php
              if($data['payment_type'] == 1){
                foreach ($data['paymentdata'] as $key => $value) {
                if($value->del_status === 'yes'){
                  ?>
                   <p><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></p>
                   <p>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</p>
                   <br>
                  <?php
                }
                } 
              }else{
                foreach ($data['paymentdata'] as $key => $value) {
                  if($value->p_payment_type == 'recurring'){
                    if($value->del_status === 'yes'){
                    ?>
                     <p><span><?php echo ($value->del_status === 'yes') ? 'Succeeded' : 'Cancelled' ?></span><span>&nbsp&nbsp&nbsp&nbsp&nbsp #<?php echo $value->transaction_id; ?></span></p>
                     <p>$<?php echo $value->p_amount; ?> paid on <?php echo $value->p_date; ?>. Manual Override.</p>
                     <br>
                    <?php
                     }
                  }
                } 
              }
                  ?>    

                </td></tr>
              <?php }
              ?>
            </table>
          </div>
        </div>
      </div>

        
    <!-- </div> -->



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

