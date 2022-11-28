<?php

include('inc/core.php');
include('inc/enqueue.php');
include('inc/class.ui.php');
include('inc/menus.php');
include('inc/custom-image-sizes.php');
include('inc/settings.gutenberg.php');
include('inc/theme-options.php');
include('inc/customize.php');
include('inc/shortcodes.php');
include('inc/class.HeroSection.php');
// include('inc/svg/social-to-svg.php');

// ACF Field Type
//include('inc/acf.field.color-dropdown.php');

// ACF Blocks
include('blocks/blocks.categories.php');
include('blocks/blocks.blocks.php');
// include('inc/mapbox/load.php');

// Custom features
// include('inc/testimonials/load.php');

// Widget areas
include('inc/widget-areas.php');



add_action( 'admin_init', 'disable_gutenberg_autosave' );
function disable_gutenberg_autosave() {
	wp_deregister_script( 'autosave' );
}

function new_unique_id() {
	list($usec, $sec) = explode(" ", microtime()); // 0.11173200 1597075457 -> 0.11173200
	list($zero, $micro) = explode(".", $usec); // 0.11173200 -> 11173200
	$u_id = $micro/100; // 11173200 -> 111732 (It will always have 00 on the end, so we trim them)
	return $u_id;
}


// Fix embeds inside Gutenberg saved blocks.
// Move priority of `do_blocks` to be earlier than `\WP_Embed::run_shortcode`.
add_action( 'init', function() {
	global $wp_embed;

	if (
		has_filter( 'the_content', 'do_blocks' ) === 9 &&
		has_filter( 'the_content', [ $wp_embed, 'run_shortcode' ] ) === 8
	) {
		remove_filter( 'the_content', 'do_blocks', 9 );
		add_filter( 'the_content', 'do_blocks', 7 );
	}
} );


function add_manage_reusable_blocks_link_to_posts_submenu() {
	add_submenu_page( 'edit.php', 'Reusable blocks', 'Manage Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 10);
}
add_action( 'admin_menu', 'add_manage_reusable_blocks_link_to_posts_submenu' );


function my_custom_admin_style() {
  echo '
	<style>
	.widgets-php .blocks-widgets-container .wp-block-widget-area__inner-blocks.editor-styles-wrapper>.block-editor-block-list__layout {
		background: #f8f8f8;
	}
  </style>';
}
add_action('admin_head', 'my_custom_admin_style');

// Protect Javascript in PHP templates from being char encoded
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'the_content', 'convert_chars' );



// [fliptext before="My Examples" text_1="First Example" text_2="Second Example" after="After the fliptext"]
function fliptext_handler( $atts ) {
	$default_atts = array(
		'text_1' => false,
		'text_2' => false,
		'text_3' => false,
		'text_4' => false,
		'text_5' => false,
		'text_6' => false,
		'text_7' => false,
		'text_8' => false,
		'text_9' => false,
		'text_10' => false,
		'before' => '',
		'after' => '',
	);
	$fields = shortcode_atts( $default_atts, $atts );

	$slides = array(
		$fields['text_1'],
		$fields['text_2'],
		$fields['text_3'],
		$fields['text_4'],
		$fields['text_5'],
		$fields['text_6'],
		$fields['text_7'],
		$fields['text_8'],
		$fields['text_9'],
		$fields['text_10'],
	);

	if(!empty($fields['before'])) echo $fields['before'];

	?>
		<div class="fliptext swiper mySwiper">
			<div class="swiper-wrapper">
				<?php
					foreach($slides as $index => $slide):
						if(empty($slide)) continue;
						?>
							<div class="swiper-slide fliptext-<?=$index?>">
								<div class="fliptext-text">
									<?=$slide?>
								</div>
							</div>
						<?php
					endforeach;
				?>
			</div>
		</div>

	 <!-- Initialize Swiper -->
		<script>
      var swiper = new Swiper(".mySwiper", {
				loop: true,
				// effect: "flip",
				// flipEffect: {
   			// 	slideShadows: false,
  			// },
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
				// Ref: https://codesandbox.io/s/kuj18u?file=/index.html:6458-6758
				effect: "creative",
        creativeEffect: {
          prev: {
            shadow: false,
            translate: [0, 0, -400],
            rotate: [180, 0, 0],
          },
          next: {
            shadow: false,
            translate: [0, 0, -400],
            rotate: [-180, 0, 0],
          },
				},

      });


			jQuery(document).ready(function(){
				jQuery('.fliptext').addClass('transition-control');
			});

    </script>
	<?php

	if(!empty($fields['after'])) echo $fields['after'];

}
add_shortcode( 'fliptext', 'fliptext_handler' );



function get_snippet($post, $args = []) {

	$default_args = array(
		'character_limit' => 300,
		'add_ellipsis' => true,
		'ellipsis_string' => '...',
		'strip_WYSIWYG_tags' => true,
	);

	$args = array_merge($default_args, $args);

	$strip_WYSIWYG_tags = $args['strip_WYSIWYG_tags'];

	$string = $post->post_excerpt;

	if(empty($string)) {
		$string = $post->post_content;

		// ---

		$string = str_replace(array("<ul>", "<ol>"), '', $string);
		$string = str_replace(array("</ul>", "</ol>"), '', $string);

		$string = str_replace(array("<li>"), '<span> ', $string);
		$string = str_replace(array("</li>"), ',</span> ', $string);

		$string = str_replace(array("<h1>"), '<p> ', $string);
		$string = str_replace(array("</h1>"), '</p> ', $string);

		$string = str_replace(array("<h2>"), '<p> ', $string);
		$string = str_replace(array("</h2>"), '</p> ', $string);

		$string = str_replace(array("<h3>"), '<p> ', $string);
		$string = str_replace(array("</h3>"), '</p> ', $string);

		$string = str_replace(array("<h4>"), '<p> ', $string);
		$string = str_replace(array("</h4>"), '</p> ', $string);

		$string = str_replace(array("<h5>"), '<p> ', $string);
		$string = str_replace(array("</h5>"), '</p> ', $string);

		$string = str_replace(array("<h6>"), '<p> ', $string);
		$string = str_replace(array("</h6>"), '</p> ', $string);

		$string = str_replace(array("<p></p>"), '', $string);
		$string = str_replace(array("<p> </p>"), '', $string);

		// ---

		$allowed_tags = ($strip_WYSIWYG_tags) ? null : '<p><br><span>';
		$dirty = strip_tags($string, $allowed_tags);
		$dirty = str_replace(array("\r", "\n",'  '), '', $dirty);
		$cleaned = new DOMDocument();
		@$cleaned->loadHTML(utf8_decode($dirty));
		$string = $cleaned->saveHTML();
		$string = strip_tags($string, $allowed_tags);

	}

	return create_snippet($string, $args);
}

function create_snippet($string, $args = []) {
	$default_args = array(
		'character_limit' => 300,
		'add_ellipsis' => true,
		'ellipsis_string' => '...',
	);

	$args = array_merge($default_args, $args);

	$character_limit = $args['character_limit'];
	$add_ellipsis = $args['add_ellipsis'];
	$ellipsis_string = $args['ellipsis_string'];

	$snippet = $string;

	if( strlen($snippet) > $character_limit ) {
		$sub_string = substr($snippet, 0, $character_limit); // Trim the length back to character limit
		$sub_string = substr($sub_string, 0, strrpos($sub_string, ' ', -1)); // Trim back again to the last whitespace
		$snippet = $sub_string;
		if($add_ellipsis) $snippet .= $ellipsis_string;
	}
	return $snippet;
}