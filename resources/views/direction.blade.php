<?php
define("API_KEY", "AIzaSyA6qhsdjTXt5cBu_PuFotJzRGLRaiBnVF8");
?>
<html>
<head>
<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.min.js"></script>
<style>
#map-layer {
    max-width: 900px;
    min-height: 550px;
}
</style>
</head>
<body>
    <div id="map-layer"></div>
    <script>
          var map;
          x = navigator.geolocation;
          x.getCurrentPosition(success, failure);
          function success(position)
          {
              var myLat = position.coords.latitude;
              var myLong = position.coords.longitude;
              coords = new google.maps.LatLng(myLat,myLong);
              var mapLayer = document.getElementById("map-layer"); 
                  
                  
        		var defaultOptions = { center: coords, zoom: 8 }
                map = new google.maps.Map(mapLayer, defaultOptions);
                var end = new google.maps.LatLng("{{$lats1}}", "{{$long1}}");

	
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);
                    drawPath(directionsService, directionsDisplay,coords,end);
          }
          function failure()
          {}
      	
        	function drawPath(directionsService, directionsDisplay,x , y) {
            directionsService.route({
              origin: x,
              destination: y,
              travelMode: "DRIVING"
            }, function(response, status) {
                if (status === 'OK') {
                directionsDisplay.setDirections(response);
                } else {
                window.alert('Problem in showing direction due to ' + status);
                }
            });
      }
	</script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>">
    </script>
</body>
</html>