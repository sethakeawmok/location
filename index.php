<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html {
        height: 100%;
        margin: 0;
        padding: 0;
		text-align: center;
      }

      #map {
        height: 500px;
        width: 600px;
      }
    </style>
  </head>
  <body>
  <div id="map"></div>
    <script>

      function initMap() {
			var mapOptions = {
			  center: {lat: 13.0957776, lng: 100.977819},
			  zoom: 10,
			}
				
			var maps = new google.maps.Map(document.getElementById("map"),mapOptions);

			var marker, info;

			$.getJSON( "json.php", function( jsonObj ) {
					//*** loop
          var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
					$.each(jsonObj, function(i, item){
            var n = item.meta_value.indexOf(",");
            var LAT = item.meta_value.substr(0, n);
            var LNG = item.meta_value.substr(n+1);

						marker = new google.maps.Marker({
						   position: new google.maps.LatLng(LAT,LNG),
						   map: maps,
               icon: image,
						   title: item.post_title
						});

					  info = new google.maps.InfoWindow();

					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
						  info.setContent(item.post_title);
						  info.open(maps, marker);
						}
					  })(marker, i));
					}); // loop

			 });

       $.getJSON( "json.php", function( jsonObj ) {
					//*** loop
          var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
					$.each(jsonObj, function(i, item){
            var n = item.meta_value.indexOf(",");
            var LAT = item.meta_value.substr(0, n);
            var LNG = item.meta_value.substr(n+1);

						marker = new google.maps.Marker({
						   position: new google.maps.LatLng(LAT,LNG),
						   map: maps,
               //icon: image,
						   title: item.post_title
						});

					  info = new google.maps.InfoWindow();

					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
						  info.setContent(item.post_title);
						  info.open(maps, marker);
						}
					  })(marker, i));
					}); // loop

			 });

		}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwMCVWAxG65StnYY_GCthsJCjzwiVXLRI&callback=initMap" async defer></script>
  </body>
</html>