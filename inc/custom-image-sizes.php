<?php

// Add Custom Image Size
add_image_size( prefix().'-blog-pod', 345, 180, true );
add_image_size( prefix().'-shield-image', 544, 408, true );
add_image_size( prefix().'-testimonial', 600, 600, true );
add_image_size( prefix().'-thumbnail', 325, 325, true );
add_image_size( prefix().'-background-image', 1920, 1080, false );
add_image_size( prefix().'-thumbnail-full', 150, 150, false );



// All sizes
add_filter( 'image_size_names_choose', 'mg_custom_image_sizes' );
function mg_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		prefix().'-blog-pod'                    => __( 'Blog Pod' ),
		prefix().'-shield-image'                => __( 'Shield Image' ),
		prefix().'-testimonial'                 => __( 'Testimonial' ),
		prefix().'-thumbnail'                   => __( 'Thumbnail Large' ),
		prefix().'-background-image'            => __( 'Background Image' ),
		prefix().'-thumbnail-full'              => __( 'Thumbnail (Full Image)' ),
	) );
}