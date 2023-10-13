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
            height: 600px;
            width: 100%;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="col-md-4 p-2">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control single-select">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" data-latitude="{{ $country->latitude }}"
                                    data-longitude="{{ $country->longitude }}">
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <div class="form-group" id="state">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-control">
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <div class="form-group" id="city">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <h2>Google Map</h2>
                <!-- Integrate Google Maps here using the Google Maps JavaScript API -->
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //ask for my location
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                //make it number
                latitude = Number(latitude);
                longitude = Number(longitude);
                initMap(latitude, longitude);
            });
        });

        // Initialize and add the map
        function initMap(lat, lng) {
            // The location of Uluru
            const uluru = {
                lat: lat,
                lng: lng
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: uluru,
            });
            // The marker, positioned at Uluru and jumping animation
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
                animation: google.maps.Animation.BOUNCE,
            });
        }

        // Get the latitude and longitude of the country
        $(document).on('change', '#country', function() {
            var country_id = $(this).val();
            var latitude = $(this).find(':selected').data('latitude');
            var longitude = $(this).find(':selected').data('longitude');
            //make it number
            latitude = Number(latitude);
            longitude = Number(longitude);
            initMap(latitude, longitude);

            if (country_id != '') {
                $.ajax({
                    url: "{{ route('get-state') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="state"]').empty();
                        $('select[name="state"]').append(
                            `<option value="">Select State</option>`
                        );
                        $.each(data, function(key, value) {
                            $('select[name="state"]').append(
                                `<option value="${value.id}" data-latitude="${value.latitude}" data-longitude="${value.longitude}">${value.name}</option>`
                            );
                        });
                    }
                });
            }
        });

        // Get the latitude and longitude of the state
        $(document).on('change', '#state', function() {
            var state_id = $(this).val();
            var latitude = $(this).find(':selected').data('latitude');
            var longitude = $(this).find(':selected').data('longitude');
            //make it number
            latitude = Number(latitude);
            longitude = Number(longitude);
            initMap(latitude, longitude);

            if (state_id != '') {
                $.ajax({
                    url: "{{ route('get-city') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="city"]').empty();
                        $('select[name="city"]').append(
                            `<option value="">Select City</option>`
                        );
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append(
                                `<option value="${value.id}" data-latitude="${value.latitude}" data-longitude="${value.longitude}">${value.name}</option>`
                            );
                        });
                    }
                });
            }
        });

        // Get the latitude and longitude of the city
        $(document).on('change', '#city', function() {
            var latitude = $(this).find(':selected').data('latitude');
            var longitude = $(this).find(':selected').data('longitude');
            //make it number
            latitude = Number(latitude);
            longitude = Number(longitude);
            initMap(latitude, longitude);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
