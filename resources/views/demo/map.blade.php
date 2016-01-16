<!-- resources/views/demo/map.blade.php -->
@extends('layouts/master')

@section('content')
    
    @if($id == 1)
    <h1>
        <a href="https://developers.google.com/maps/documentation/javascript/" target="_blank">Google Maps JavaScript API</a>
    </h1>
    <div id="demo_map" class="col-lg-6 col-lg-offset-3" style="margin-top:20px; padding: 1px; height: 400px;"></div>
    <a class="btn btn-info col-lg-6 col-lg-offset-3" href="{{ URL::to('demo/map') }}">
        <span class="glyphicon glyphicon-menu-left"></span>Menu
    </a>
    <script type="text/javascript">

        var map1;
        var styleArray = [
        {
            featureType: "all",
            stylers: [
                { saturation: -80 }
            ]
        },
        {
            featureType: "road.arterial",
            elementType: "geometry",
            stylers: [
                { hue: "#00ffee" },
                { saturation: 50 }
            ]
        },
        {
            featureType: "poi.business",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
        ];
        function initMap_demo_1() {
          map1 = new google.maps.Map(document.getElementById('demo_map'), {
            center: {lat: 43.728784, lng: -79.607881},
            zoom: 14,
            styles: styleArray
          });
        }

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsI2rCfnOCaY1QgF45WL_go7aDZ9gzy24&callback=initMap_demo_1">
        // make sure the callback function's name is matched to your js function
    </script>
    @elseif($id == 2)
    <h1>
        <a href="https://developers.google.com/maps/documentation/embed/" target="_blank">Google Maps Embed API</a>
    </h1>
    <iframe height="450" frameborder="0" style="padding:1px;margin-top:20px;" class="col-lg-6 col-lg-offset-3" 
    src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJpTvG15DL1IkRd8S0KlBVNTI&key=AIzaSyBsI2rCfnOCaY1QgF45WL_go7aDZ9gzy24" allowfullscreen>
    </iframe>
    <a class="btn btn-info col-lg-6 col-lg-offset-3" href="{{ URL::to('demo/map') }}">
      <span class="glyphicon glyphicon-menu-left"></span>Menu
    </a>
    @elseif($id == 3)
    <h1>
        <a href="https://developers.google.com/maps/documentation/streetview/"  target="_blank">Google Street View Image API</a>
    </h1>
    <img height="450" style="padding:1px;margin-top:20px;" class="col-lg-6 col-lg-offset-3" 
    src="https://maps.googleapis.com/maps/api/streetview?size=600x450&location=43.728784,-79.607881&heading=151.78&key=AIzaSyBsI2rCfnOCaY1QgF45WL_go7aDZ9gzy24" allowfullscreen>
    
    <a class="btn btn-info col-lg-6 col-lg-offset-3" href="{{ URL::to('demo/map') }}">
      <span class="glyphicon glyphicon-menu-left"></span>Menu
    </a>
    @elseif($id == 4)
    <h1>
        <a href="https://developers.google.com/places/javascript/" target="_blank">Google Places API JavaScript Library</a>
    </h1>
    <div id="map" class="col-lg-6 col-lg-offset-3"  style="padding:1px;margin-top:20px; height:450px;"></div>
    <a class="btn btn-info col-lg-6 col-lg-offset-3" href="{{ URL::to('demo/map') }}">
      <span class="glyphicon glyphicon-menu-left"></span>Menu
    </a>

    <script>
        function initMap_demo_4() {
          var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 43.728784, lng: -79.607881},
            zoom: 15
          });

          var infowindow = new google.maps.InfoWindow();
          var service = new google.maps.places.PlacesService(map);

          service.getDetails({
            placeId: 'ChIJP1ieg1Q6K4gR15UYi3GI3do'
          }, function(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
              var marker = new google.maps.Marker({
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsI2rCfnOCaY1QgF45WL_go7aDZ9gzy24&libraries=places&callback=initMap_demo_4" async defer></script>

    @elseif($id == 5)
    <h1>
        <a href="https://developers.google.com/maps/documentation/static-maps/" target="_blank">Google Static Maps API</a>
    </h1>
    <img height="450" style="padding:1px;margin-top:20px;" class="col-lg-6 col-lg-offset-3" 
    src="https://maps.googleapis.com/maps/api/staticmap?maptype=satellite&center=37.530101,38.600062&zoom=14&size=640x400&key=AIzaSyBsI2rCfnOCaY1QgF45WL_go7aDZ9gzy24" allowfullscreen>
    
    <a class="btn btn-info col-lg-6 col-lg-offset-3" href="{{ URL::to('demo/map') }}">
      <span class="glyphicon glyphicon-menu-left"></span>Menu
    </a>
    @else
    <a class="col-lg-4 btn btn-default" href="{{ URL::to('demo/map/1') }}" style="margin-top:20px;">Google Maps JavaScript API</a>
    <a class="col-lg-4 btn btn-info" href="{{ URL::to('demo/map/2') }}" style="margin-top:20px;">Google Maps Embed API</a>
    <a class="col-lg-4 btn btn-primary" href="{{ URL::to('demo/map/3') }}" style="margin-top:20px;">Google Street View Image API</a>
    <a class="col-lg-4 btn btn-warning" href="{{ URL::to('demo/map/4') }}" style="margin-top:20px;">Google Places API JavaScript Library</a>
    <a class="col-lg-4 btn btn-danger" href="{{ URL::to('demo/map/5') }}" style="margin-top:20px;">Google Static Maps API</a>
    <a class="col-lg-4 btn btn-default" href="https://console.developers.google.com" style="margin-top:20px;">console.developers.google.com</a>

    @endif

@endsection