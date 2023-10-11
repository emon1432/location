<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Integrate Google Maps here using the Google Maps JavaScript API -->
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>List of Countries</h2>
                <ul>
                    @foreach ($countries as $country)
                        <li>
                            <a href="javascript:void(0)" onclick="initMap({{ $country['lat'] }}, {{ $country['lng'] }})">
                                {{ $country['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <h2>Google Map</h2>
                <!-- Integrate Google Maps here using the Google Maps JavaScript API -->
                <div id="map"></div>
            </div>
        </div>
    </div>


    <script>
        function initMap(lat, lng) {
            // The location of Uluru
            const uluru = {
                lat: lat,
                lng: lng
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
