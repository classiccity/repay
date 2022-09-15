<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/svg-showcase/svg-showcase.php -->
<?php

	$block_name = prefix() . '-svg-showcase';

?>
<div class="<?php echo $block_name; ?> alignfull">

	<?php
		$u_id = 'svg-'.new_unique_id();
		// get_template_part('inc/img/svg/inline', 'green-dot-wave.svg', array('classname'=> $u_id));
	?>

	<script>
		jQuery( document ).ready(function() {
			window['pop_gdw_svg_target_class'] = '<?=$u_id?>';
			// pop_gdw();
			// setInterval(pop_gdw, 10000);
		});
	</script>



	<?php
		$u_id = 'svg-'.new_unique_id();
		//get_template_part('inc/img/svg/inline', 'green-dot-wave-2.svg', array('classname'=> $u_id));
	?>

	<script>
		jQuery( document ).ready(function() {
			window['pop_gdw2_svg_target_class'] = '<?=$u_id?>';
			// pop_gdw2();
			// setInterval(pop_gdw2, 7000);
		});
	</script>



	<?php
		$u_id = 'svg-'.new_unique_id();
		get_template_part('inc/img/svg/inline', 'green-dot-wave-3.svg', array('classname'=> $u_id));
	?>

	<script>
		jQuery( document ).ready(function() {
			window['pop_gdw3_svg_target_class'] = '<?=$u_id?>';
			pop_gdw3();
			setInterval(pop_gdw3, 7000);
		});
	</script>



	<?php
		$u_id = 'svg-'.new_unique_id();
		// get_template_part('inc/img/svg/inline', 'green-blue-dot-circle.svg', array('classname'=> $u_id));
	?>

	<script>
		jQuery( document ).ready(function() {
			window['pop_gbdc_svg_target_class'] = '<?=$u_id?>';
			// setInterval(pop_gbdc, 7000);
		});
	</script>

</div>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/svg-showcase/svg-showcase.php -->