<?php

// THE BLOCKS
add_action('acf/init', 'ccc_acf_blocks');
function ccc_acf_blocks() {
	if( function_exists('acf_register_block') ) {

	    // Testimonials
			//        acf_register_block_type(array(
			//            'name'              => 'testimonials',
			//            'title'             => 'Testimonials',
			//            'description'       => 'Shows a list of Testimonials',
			//            'render_template'   => 'blocks/templates/callouts/testimonials.php',
			//            'category'          => prefix().'-callouts',
			//            'icon'              => '<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M448 224h-64v-24c0-30.9 25.1-56 56-56h16c22.1 0 40-17.9 40-40V72c0-22.1-17.9-40-40-40h-16c-92.6 0-168 75.4-168 168v216c0 35.3 28.7 64 64 64h112c35.3 0 64-28.7 64-64V288c0-35.3-28.7-64-64-64zm32 192c0 17.7-14.3 32-32 32H336c-17.7 0-32-14.3-32-32V200c0-75.1 60.9-136 136-136h16c4.4 0 8 3.6 8 8v32c0 4.4-3.6 8-8 8h-16c-48.6 0-88 39.4-88 88v56h96c17.7 0 32 14.3 32 32v128zM176 224h-64v-24c0-30.9 25.1-56 56-56h16c22.1 0 40-17.9 40-40V72c0-22.1-17.9-40-40-40h-16C75.4 32 0 107.4 0 200v216c0 35.3 28.7 64 64 64h112c35.3 0 64-28.7 64-64V288c0-35.3-28.7-64-64-64zm32 192c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V200c0-75.1 60.9-136 136-136h16c4.4 0 8 3.6 8 8v32c0 4.4-3.6 8-8 8h-16c-48.6 0-88 39.4-88 88v56h96c17.7 0 32 14.3 32 32v128z"></path></svg>',
			//            'keywords'          => array( 'testimonials', 'quote', 'repay','customer' ),
			//        ));


			// acf_register_block_type(array(
			// 	'name'              => 'social-row',
			// 	'title'             => __('Social Row'),
			// 	'description'       => __('Display the Social Row from the Menus, if one exists and is assigned to that location'),
			// 	'category'          => prefix().'-custom',
			// 	'render_template'   => '/blocks/templates/social-row/social-row.php',
			// 	'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/social-row/css/social-row.css',
			// 	'icon'              => 'cloud',
			// 	'keywords'          => array( 'social', 'repay', 'custom', 'widget' ),
			// 	'mode' => 'auto',
			// ));

			// acf_register_block_type(array(
			// 	'name'              => 'cta-icon-card-pod',
			// 	'title'             => __('CTA Icon Card w/ Button Pod'),
			// 	'description'       => __('Display an icon image, title, text, button, with a background image.'),
			// 	'category'          => prefix().'-custom',
			// 	'render_template'   => '/blocks/templates/cta-icon-card-pod/cta-icon-card-pod.php',
			// 	'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/cta-icon-card-pod/css/cta-icon-card-pod.css',
			// 	'icon'              => 'text-page',
			// 	'keywords'          => array( 'card', 'cta', 'repay', 'custom', 'pod' ),
			// 	'mode' => 'auto',
			// 	// 'example'  => array(
			// 	// 	'attributes' => array(
			// 	// 			'mode' => 'preview',
			// 	// 			'data' => array(
			// 	// 				'testimonial'   => "Your testimonial text here",
			// 	// 				'author'        => "John Smith"
			// 	// 			)
			// 	// 	)
			// 	// )
			// ));

			acf_register_block_type(array(
				'name'              => 'staff-cards',
				'title'             => __('Staff Cards'),
				'description'       => __('Display cards with image, name, title, and popup bio.'),
				'category'          => prefix().'-custom',
				'render_template'   => '/blocks/templates/staff-cards/staff-cards.php',
				'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/staff-cards/css/staff-cards.css',
				'icon'              => 'groups',
				'keywords'          => array( 'card', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				'enqueue_assets' 		=> function(){
					wp_enqueue_script( 'utlis-script',  get_template_directory_uri() . '/js/utlis.js' );
					wp_enqueue_script( 'dialog-script',  get_template_directory_uri() . '/js/dialog.js' );
				},
			));

			acf_register_block_type(array(
				'name'              => 'featured-clients',
				'title'             => __('Featured Clients Pod'),
				'description'       => __('Add images to display clients'),
				'category'          => prefix().'-custom',
				'render_template'   => '/blocks/templates/featured-clients/featured-clients.php',
				'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/featured-clients/css/featured-clients.css',
				'icon'              => 'grid-view',
				'keywords'          => array( 'featured', 'clients', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			// acf_register_block_type(array(
			// 	'name'              => 'image-cta-cards-pod',
			// 	'title'             => __('Image & CTA Cards Pod'),
			// 	'description'       => __('Display cards with an image, title, text, and button link'),
			// 	'category'          => prefix().'-custom',
			// 	'render_template'   => '/blocks/templates/image-cta-cards-pod/image-cta-cards-pod.php',
			// 	'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/image-cta-cards-pod/css/image-cta-cards-pod.css',
			// 	'icon'              => 'screenoptions',
			// 	'keywords'          => array( 'image', 'cta', 'repay', 'custom', 'pod' ),
			// 	'mode' => 'auto',
			// 	// 'example'  => array(
			// 	// 	'attributes' => array(
			// 	// 			'mode' => 'preview',
			// 	// 			'data' => array(
			// 	// 				'testimonial'   => "Your testimonial text here",
			// 	// 				'author'        => "John Smith"
			// 	// 			)
			// 	// 	)
			// 	// )
			// ));

			// acf_register_block_type(array(
			// 	'name'              => 'simple-icon-cards-pod',
			// 	'title'             => __('Simple Icon Cards (CTA optional)'),
			// 	'description'       => __('Display cards with an icon, title, text, and button link'),
			// 	'category'          => prefix().'-custom',
			// 	'render_template'   => '/blocks/templates/simple-icon-cards-pod/simple-icon-cards-pod.php',
			// 	'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/simple-icon-cards-pod/css/simple-icon-cards-pod.css',
			// 	'icon'              => 'screenoptions',
			// 	'keywords'          => array( 'icon', 'cta', 'repay', 'custom', 'cards', 'pod' ),
			// 	'mode' => 'auto',
			// 	// 'example'  => array(
			// 	// 	'attributes' => array(
			// 	// 			'mode' => 'preview',
			// 	// 			'data' => array(
			// 	// 				'testimonial'   => "Your testimonial text here",
			// 	// 				'author'        => "John Smith"
			// 	// 			)
			// 	// 	)
			// 	// )
			// ));

			acf_register_block_type(array(
				'name'              => 'button-link-pod',
				'title'             => __('REPAY - Button Link'),
				'description'       => __('Use the one for button links on theme with REPAY'),
				'category'          => prefix().'-custom',
				'render_template'   => '/blocks/templates/button-link-pod/button-link-pod.php',
				// 'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/button-link-pod/css/button-link-pod.css',
				'icon'              => 'share-alt2',
				'keywords'          => array( 'button', 'link', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			// acf_register_block_type(array(
			// 	'name'              => 'accordion-drawers',
			// 	'title'             => __('Accordion Drawers - FAQ'),
			// 	'description'       => __(''),
			// 	'category'          => prefix().'-custom',
			// 	'render_template'   => '/blocks/templates/accordion-drawers/accordion-drawers.php',
			// 	'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/accordion-drawers/css/accordion-drawers.css',
			// 	'icon'              => 'list-view',
			// 	'keywords'          => array( 'accordion', 'drawers', 'repay', 'custom', 'pod' ),
			// 	'mode' => 'auto',
			// 	// 'example'  => array(
			// 	// 	'attributes' => array(
			// 	// 			'mode' => 'preview',
			// 	// 			'data' => array(
			// 	// 				'testimonial'   => "Your testimonial text here",
			// 	// 				'author'        => "John Smith"
			// 	// 			)
			// 	// 	)
			// 	// )
			// ));

			acf_register_block_type(array(
				'name'              => 'options-showcase',
				'title'             => __('Options Showcase'),
				'description'       => __(''),
				'category'          => prefix().'-custom',
				'render_template'   => '/blocks/templates/options-showcase/options-showcase.php',
				'enqueue_style' 		=> get_stylesheet_directory_uri() . '/blocks/templates/options-showcase/css/options-showcase.css',
				'icon'              => 'table-col-before',
				'keywords'          => array( 'options', 'showcase', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'svg-showcase';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('SVG Options Showcase'),
				'description'       => __(''),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
			// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'art',
				'keywords'          => array( 'options', 'svg', 'repay', 'custom', 'pod', 'animation' ),
				'mode' => 'edit',
			));

			$slug = 'svg-media-and-text';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('SVG Media & Text'),
				'description'       => __('Custom Media and Text block, with SVG animation options for behind the block.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'align-pull-left',
				'keywords'          => array( 'options', 'svg', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'svg-media-and-text-slides';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('SVG Media & Text - Slides'),
				'description'       => __('Custom block with Media and Text slides, and SVG animation options for behind the block.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'align-wide',
				'keywords'          => array( 'slides', 'svg', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'svg-text-and-icons';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('SVG Text & Icons'),
				'description'       => __('Custom Text and Icons block, with SVG animation options for behind the block.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'align-pull-right',
				'keywords'          => array( 'icons', 'svg', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'link-cards';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Link Cards'),
				'description'       => __('Custom heading and text, with a list of Link Cards with heading and text.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'editor-table',
				'keywords'          => array( 'options', 'cards', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'counter-stats';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Counter Stats'),
				'description'       => __('Custom strip of animated statistics that count up to thier set numbers'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'info-outline',
				'keywords'          => array( 'counter', 'stats', 'repay', 'custom', 'pod' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'repay-cta';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('REPAY CTA'),
				'description'       => __('Custom Call To Action with background image'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'align-left',
				'keywords'          => array( 'repay', 'custom' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'repay-cta-form';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('REPAY CTA Form'),
				'description'       => __('Custom Form Call To Action with background image'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'align-left',
				'keywords'          => array( 'repay', 'custom', 'form' ),
				'mode' => 'auto',
			));

			$slug = 'testimonial-slides';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Testimonial Slides'),
				'description'       => __('Custom Testimonial slides, and SVG animation options for behind the block.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'format-quote',
				'keywords'          => array( 'slides', 'svg', 'repay', 'custom', 'pod', 'testimonial' ),
				'mode' => 'auto',
				// 'example'  => array(
				// 	'attributes' => array(
				// 			'mode' => 'preview',
				// 			'data' => array(
				// 				'testimonial'   => "Your testimonial text here",
				// 				'author'        => "John Smith"
				// 			)
				// 	)
				// )
			));

			$slug = 'cta-slides';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('CTA Slides'),
				'description'       => __('Custom CTA slides'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'editor-insertmore',
				'keywords'          => array( 'slides', 'svg', 'repay', 'custom', 'pod', 'cta' ),
				'mode' => 'auto',
			));

			$slug = 'tabbed-content';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Tabbed Content'),
				'description'       => __('Custom Tabs with inner media, text, icon-list, and SVG background.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'table-row-after',
				'keywords'          => array( 'tab', 'svg', 'repay', 'custom', 'pod', 'icon', 'svg'),
				'mode' => 'auto',
				'enqueue_assets' 		=> function(){
					wp_enqueue_script( 'tab-list-script',  get_template_directory_uri() . '/js/tabs-manual.js' );
				},
			));

			$slug = 'post-feed-picker';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Post Feed Picker'),
				'description'       => __('Select posts to show as linked cards'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				// 'enqueue_script' 		=> get_template_directory_uri() . "/blocks/templates/$slug/js/$slug.js",
				'icon'              => 'editor-insertmore',
				'keywords'          => array( 'repay', 'custom' ),
				'mode' => 'auto',
			));

			$slug = 'colored-bullets-list';
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __('Colored Bullets List'),
				'description'       => __('Unordered list with custom colors for each bullet.'),
				'category'          => prefix().'-custom',
				'render_template'   => "/blocks/templates/$slug/$slug.php",
				'enqueue_style' 		=> get_stylesheet_directory_uri() . "/blocks/templates/$slug/css/$slug.css",
				'icon'              => 'editor-ul',
				'keywords'          => array( 'repay', 'custom' ),
				'mode' => 'auto',
			));


	}
}