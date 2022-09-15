<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/button-link-pod/button-link-pod.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$button_link = get_field('button_link');

	if( ! empty( $button_link ) ):

		UI::html_acf_link( $button_link, 'button'. ' ' . $all_classes );

	else:
		if( is_admin() || is_customize_preview() ):
		?>
			<h6 style="color: white; background-color: darkmagenta; text-align: center; padding: 1em; display: inline;">Click here to add Button Link</h6>
		<?
		endif;
	endif;
?>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/button-link-pod/button-link-pod.php -->