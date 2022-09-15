<?php

// Displays the current date in the given format
// Example: [current_date format="Y"] displays the current year
function current_date_init( $atts ){
  $a = shortcode_atts( [ 'format' => 'F j, Y'], $atts );
  ob_start();
  echo date($a['format']);
  return ob_get_clean();
}
add_shortcode( 'current_date', 'current_date_init' );