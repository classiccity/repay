<?php

// ACF
include('acf/mapbox-map-block.php');

// Blocks
include('blocks/blocks.php');

wp_enqueue_style( prefix().'-mapbox-gl-style', 'https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css');
wp_enqueue_script( prefix().'-mapbox-gl-script', 'https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js');