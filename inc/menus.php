<?php

function ccc_all_menus() {
	register_nav_menus(array(
		'header-menu' => __( 'Header Menu' ),
		'header-topper-menu' => __( 'Header Topper Menu' ),
		// 'footer-menu' => __( 'Footer Menu' ),
		// 'social-row' => __( 'Social Row' ),
	));
}
add_action( 'init', 'ccc_all_menus' );