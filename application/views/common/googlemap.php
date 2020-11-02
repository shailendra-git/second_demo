<script>



      function initAutocomplete() {

        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:<?php echo $lat;?> , lng: <?php echo $lng;?>  },
          zoom: 13,
          mapTypeId: 'roadmap'
        });

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



