<?php
add_theme_support( 'align-wide' );
add_theme_support( 'align-full' );

$color_palette = array(
	array(
		'name'  => 'REPAY Lime',
		'slug'  => 'repay-lime',
		'color' => '#81BD41',
		'opposite' => '#ffffff',
	),
	array(
		'name'  => 'Dark Blue',
		'slug'  => 'dark-blue',
		'color' => '#002B54',
		'opposite' => '#ffffff',
	),
	array(
		'name'  => 'Steel Gray',
		'slug'  => 'steel-gray',
		'color' => '#dae0e6',
		'opposite' => '#000000',
	),
	array(
		'name'  => 'Extra Light Gray',
		'slug'  => 'extra-light-gray',
		'color' => '#E8E8E8',
		'opposite' => '#000000',
	),
);


function mytheme_setup_theme_supported_features() {
	global $color_palette;
	$editor_color_palette = array_merge(
		array( // start with black and white...
			array(
				'name'  => 'Black',
				'slug'  => 'black',
				'color' => '#000000',
				'opposite' => '#ffffff',
			),
			array(
				'name'  => 'White',
				'slug'  => 'white',
				'color' => '#ffffff',
				'opposite' => '#000000',
			)
		),
		$color_palette
	);
	add_theme_support( 'editor-color-palette', $editor_color_palette);
}
add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );


function add_custom_color_palette_to_acf_color_picker_args() {

  // DOCS:  https://www.advancedcustomfields.com/resources/javascript-api/#filters-color_picker_args

	global $color_palette;

	$color_palette_codes = [ '#000000', '#ffffff' ]; // start with black and white...

	foreach( $color_palette as $color ) {
		$color_palette_codes[]= $color['color']; // add hex codes from every custom color
	}

	$color_palette_json = json_encode( $color_palette_codes );

	?>
		<script>
			acf.add_filter('color_picker_args', function( args, field ){
				args.palettes = <?php echo $color_palette_json; ?>;
				return args;
			});
		</script>
	<?php
}
add_action('in_admin_footer', 'add_custom_color_palette_to_acf_color_picker_args');




add_action('wp_head', 'color_palette_css_classes');
function color_palette_css_classes() {

		// Get the colors
		global $color_palette;

    // Elements to text color
    $elements = array('h1','h2','h3','h4','h5','h6','p','li');

    echo '<style data id="color_palette_css_classes">';

    // Loop through each master palette
    foreach ($color_palette as $color) {
			?>
			.has-text-color.has-<?=$color['slug']?>-color,
			.has-text-color.has-<?=$color['slug']?>-color a,
			.has-text-color.has-<?=$color['slug']?>-color:after,
			.has-text-color.has-<?=$color['slug']?>-color:before {
				color: var(--<?=$color['slug']?>, --wp--preset--color--<?=$color['slug']?>) !important;
			}

			.has-<?=$color['slug']?>-light-background-color,
			.has-<?=$color['slug']?>-dark-background-color,
			.has-<?=$color['slug']?>-background-color {
					background: var(--wp--preset--color--<?=$color['slug']?>) !important;
					color: var(--<?=$color['slug']?>-opposite) !important;
			}`

        .has-<?=$color['slug']?>-light-background-color.wp-block-button__link,
        .has-<?=$color['slug']?>-dark-background-color.wp-block-button__link,
        .has-<?=$color['slug']?>-background-color.wp-block-button__link {
            color: var(--<?=$color['slug']?>-opposite) !important;
        }


        <?php foreach($elements as $element) { ?>
            .has-<?=$color['slug']?>-light-background-color <?=$element?>,
            .has-<?=$color['slug']?>-dark-background-color <?=$element?> {
                color:var(--<?=$color['slug']?>-opposite) !important;
            }
        <?php } ?>

        <?php

    }

    echo ':root {';
    foreach ($color_palette as $color) {
      echo '--' . $color['slug'] . ': ' . $color['color'] . ';' . "\n";
			echo '--' . $color['slug'] . '-opposite : ' . $color['opposite'] . ';' . "\n";
    }
    echo '}';

    echo '</style>';

}