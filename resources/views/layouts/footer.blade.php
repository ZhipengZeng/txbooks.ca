<!-- views/layouts/footer.blade.php -->

<footer class="navbar navbar-inverse navbar-static-bottom">
    <div class="container">
        <div class="navbar-header col-lg-3">
            <a class="navbar-brand" href="{{ URL::route('home') }}">Txbooks.ca</a>
        </div>
        <div class="col-lg-6" id="map"  class="col-lg-6 col-lg-offset-3"  style="padding:1px; height:300px;"></div>
        <div class="footer-footer col-lg-3">
            <p><span class="glyphicon glyphicon-earphone"></span> : 416-857-6107</p>
            <p><span class="glyphicon glyphicon-envelope"></span> : keviniszzp@gmail.com</p>
            <p><img src="http://qrickit.com/api/qr?d=Welcome+to+Txbooks
            &amp;txtcolor=442EFF&amp;fgdcolor=888888&amp;bgdcolor=ffffff&amp;qrsize=150&amp;t=p&amp;e=m"></p>
            <p><a href="{{ URL::route('aboutus') }}" style="color:white;">About us</a></p>
            <p>&copy;<?php echo date("Y"); ?> All Rights Reserved.</p>
        </div>
    </div>

</footer>

<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/sweetalert.min.js') }}"></script>
<script>
    ////// sweet alert //////
    @if(notify()->ready())
        swal({
            title: "{{ notify()->message() }}",
            type: "{{ notify()->type() }}"
        });
    @endif
    ////// simple google map api //////
    
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 43.728784, lng: -79.607881},//43.728784, -79.607881 Humber College
        zoom: 15
      });

      var infowindow = new google.maps.InfoWindow();
      var service = new google.maps.places.PlacesService(map);

      service.getDetails({
        placeId: 'ChIJP1ieg1Q6K4gR15UYi3GI3do'
      }, function(place, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          var marker = new google.maps.Marker({// create a marker at Humber College
            map: map,
            position: place.geometry.location
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name);
            infowindow.open(map, this);
          });
        }
      });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places&callback=initMap" async defer></script>