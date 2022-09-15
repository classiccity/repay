<?php

add_filter( 'block_categories_all', function( $categories, $block_editor_context  ) {

	$prefix = "REPAY";

	return array_merge(
		$categories,
		array(
			array(
				'title' => __($prefix.' | Callouts'),
				'slug'  => prefix().'-callouts'
			),
			array(
				'title' => __($prefix.' | Custom'),
				'slug'  => prefix().'-custom'
			),
		)
	);
}, 10, 2 );

