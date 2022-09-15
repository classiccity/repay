<?php include(get_theme_file_path().'/inc/mapbox/blocks/settings.php'); ?>

<?php

// Set the prefix
$prefix = prefix().'-mapbox-map';

// Add prefix to all classes
$all_classes = $prefix . " " . $all_classes;

// Get the fields
$addresses = get_field('addresses');

// Set up the object that we'll later use to create markers on the map
$markers_data = (object) [
    'type' => 'FeatureCollection',
    'features' => array(),
];


if($addresses) {
    foreach($addresses as $address) {

        $street_address = $address['street_address'];
        $city = $address['city'];
        if($city) {
            $city = $city . ',';
        }
        $state = $address['state'];
        $zip = $address['zip'];
        $address_object = (object) [];
        $address_object->address = $street_address . ' ' . $city . ' ' . $state . ' ' . $zip;

				$button_link_html = ($address['button_link']) ? UI::html_acf_link( $address['button_link'], 'button size-xs', false ) : '';

        $marker_data = (object) [
            'type' => 'Feature',
            'properties' => (object) [
								'title' => $address['title'],
                'description' => $street_address . '<br>' . $city . ' ' . $state . ' ' . $zip,
                'address' => $address_object->address,
								'buttonlink' =>  $button_link_html,
            ]
        ];

        // add the community data to the object for map markers
        $markers_data->features[] = $marker_data;

    }
}

?>
<?=get_sub_field('location')?>
<div class="<?=$all_classes?>">
    <div class="map-container" style="position:relative; width: 100%; max-width: 800px; height: 500px; max-height: 80vh; overflow:hidden; padding-top: 45.66%; margin: 0 auto;">
        <div id='map' style='position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%;'></div>
    </div>
</div>
<style>
	#map .mapboxgl-marker svg path {
		fill: #ff884d !important;
	}
	#map .mapboxgl-popup-content {
		color: black;
		cursor: default;
		padding: 1rem 0.75rem;
		text-align: center;
	}
	#map .mapboxgl-popup-content h3 {
		font-size: 1.35rem;
		margin: 0.5em auto;
	}
	#map .mapboxgl-popup-content a.button {
		margin: auto;
	}
</style>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>

<script>
    // This is the mapbox api token

    // RESICAP'S ACCESS TOKEN -- Needs to be whitelisted for whatever domains it's used on.
    mapboxgl.accessToken = 'pk.eyJ1IjoicmVzaWNhcC1kZXYiLCJhIjoiY2wwcGp0bHA1MXBkOTNqbzN5YTMxODNnaiJ9.LxS7ha47wr-p905lnra3LQ';

    // DANIEL'S TEST TOKEN
    mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuaWVsamNvd2FuMSIsImEiOiJjbDB3MXd3dDMwaHBiM2VwNWMxczR2aGE5In0.6Z1oRsROu7ckgknPfYkZLw';
    // Initialize the map and set the zoom and center coordinates
    const map = new mapboxgl.Map({
        container: 'map',
        style: '<?=get_stylesheet_directory_uri()?>/inc/mapbox/js/style.json',
        center: [-83.96,33.79],
        zoom: 8,
    });

    // This is the map marker data
    const markersData = <?=json_encode($markers_data)?>;
    console.log(markersData);


    // Before we loop through the Features, let's set up an empty array to hold the coordinates. We're going to later figure out the center point of these coordinates
    const featureCoordinates = new Array();


    // add markers to map
    for (const feature of markersData.features) {
        const mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
        console.log(feature.properties.address);
        mapboxClient.geocoding
        .forwardGeocode({
            query: feature.properties.address,
            autocomplete: false,
            limit: 1
        })
        .send()
        .then((response) => {
            if ( !response || !response.body || !response.body.features || !response.body.features.length ) {
                console.error('Invalid response:');
                console.error(response);
                return;
            }
            // This is the new Feature (the entitity that gets a marker made from it)
            const newFeature = response.body.features[0];

            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';


            // Create a marker and add it to the map.
            new mapboxgl.Marker()
                .setLngLat(newFeature.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }) // add popups buttonlink
                    .setHTML(
                        `<h3>${feature.properties.title}</h3>${feature.properties.buttonlink}` // <p>${feature.properties.description}</p>
                    )
                )
                .addTo(map);

            // Push the coordinates into the featureCoordinates array
            var singleCoordinates = newFeature.geometry.coordinates;
            featureCoordinates.push(singleCoordinates);
        });

    }

    map.on('load', function() {
        /**
         * Get a center latitude,longitude from an array of like geopoints
        */
        const data = featureCoordinates;

        var num_coords = data.length;

        var X = 0.0;
        var Y = 0.0;
        var Z = 0.0;

        for(i = 0; i < data.length; i++){
            var lat = data[i][0] * Math.PI / 180;
            var lon = data[i][1] * Math.PI / 180;

            var a = Math.cos(lat) * Math.cos(lon);
            var b = Math.cos(lat) * Math.sin(lon);
            var c = Math.sin(lat);

            X += a;
            Y += b;
            Z += c;
        }

        X /= num_coords;
        Y /= num_coords;
        Z /= num_coords;

        var lon = Math.atan2(Y, X);
        var hyp = Math.sqrt(X * X + Y * Y);
        var lat = Math.atan2(Z, hyp);

        var newX = (lat * 180 / Math.PI);
        var newY = (lon * 180 / Math.PI);

        map.flyTo({
            center: new Array(newX, newY)
        });
    });



</script>