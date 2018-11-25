// This sample uses the Place Autocomplete widget to allow the user to search
      // for and select a place. The sample then displays an info window containing
      // the place ID and other information about the place that the user has
      // selected.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });

        var from = document.getElementById('pac-from');
        var to = document.getElementById('pac-to');
        var dirs = [from, to];
        for (i = 0; i < dirs.length; i++) { 
            var element = dirs[i];
        
            var autocomplete = new google.maps.places.Autocomplete(element);
            autocomplete.bindTo('bounds', map);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(element);

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
              map: map
            });
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });

            autocomplete.addListener('place_changed', function() {
              infowindow.close();
              var place = autocomplete.getPlace();
              if (!place.geometry) {
                return;
              }

              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
              }

              // Set the position of the marker using the place ID and location.
              marker.setPlace({
                placeId: place.place_id,
                location: place.geometry.location
              });
              marker.setVisible(true);

              infowindowContent.children['place-name'].textContent = place.name;
              infowindowContent.children['place-id'].textContent = place.place_id;
              infowindowContent.children['place-address'].textContent = place.formatted_address;
              infowindow.open(map, marker);
            });
        }
    }