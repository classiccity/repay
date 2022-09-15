<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/social-row -->
<?php
	$prefix = 'social-row';

	$color = get_field('color');

	$color = ($color) ? $color : 'currentColor';

?>
<?php
	if( has_nav_menu('social-row') ) :
		?>
		<ul
			class="<?php echo $prefix; ?>"
			style="<?php echo "color: $color !important"; ?>"
			>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'social-row',
					'items_wrap'     => '%3$s',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span>',
					'link_after'     => '</span>',
					'fallback_cb'    => false,
				)
			);
			?>
		</ul>
		<?php
		else:
			if( is_admin() || is_customize_preview() ):
			?>
				<h2 style="color: white; background-color: red; text-align: center; padding: 1em;">No "Social Row" menu is available or assigned that Menu Location</h2>
			<?
			endif;
	endif;
?>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/social-row -->