<input type="hidden" name="direccion" id="direccion" value="{{ $cliente->direccion }}">
<div id="map" class="gmaps">

</div>
<script>
    $(document).ready(function() {
      direccion = $('#direccion').val();
      var geocoder;
      var map;
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var mapOptions = {
          zoom: 18,
          center: latlng
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        geocoder.geocode( { 'address': direccion}, function(results, status) {
            if (status == 'OK') {
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    });
</script>