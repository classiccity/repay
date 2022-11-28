<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/svg-showcase/svg-showcase.php -->
<?php
	include(get_theme_file_path().'/blocks/blocks.settings.php');
	$block_name = prefix() . '-svg-showcase';
	$svg_option = get_field('svg_option');

	$position = get_field('position');

	$animation_on = get_field('animation_on');

	$style = "padding: 5% 0;";
	if('behind' == $position) {
		$style = "
			padding: 0 0;
			height: 0;
			position: relative;
			z-index: -1;
		";
	}
	elseif('behind-25-25' == $position) {
		$style = "
			padding: 0 0;
			height: auto;
			position: relative;
			z-index: -1;
			margin-top: -8%;
			margin-bottom: -6%;
		";
	}
	elseif('behind-above' == $position) {
		$style = "
			padding: 0 0;
			position: relative;
			z-index: -1;
			height: 0;
		";
	}
	elseif('behind-below' == $position) {
		$style = "
			padding: 0 0;
			position: relative;
			z-index: -1;
			height: 0;
		";
	}

	if('dot-wave-3' == $svg_option) {
		$animation_on = false;
	}
?>
<div class="<?php echo $block_name . ' ' . $all_classes . ' ' . $svg_option . ' ' . $position; ?>"
	style="<?=$style?>"
>
	<?php
		$template_part_args = array(
			'modifier_class' => $block_name.'__svg-background '.$svg_option,
			'svg' => $svg_option,
			'animation_on' => $animation_on,
		);
		get_template_part('template-parts/svg-animation', null, $template_part_args);
	?>
</div>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/svg-showcase/svg-showcase.php -->