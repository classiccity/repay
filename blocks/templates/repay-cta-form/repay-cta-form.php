<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/repay-cta-form/repay-cta-form.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-repay-cta-form';

	$heading = get_field('heading');
	$text = get_field('text');
	$form_shortcode = get_field('form_shortcode');
	$layout = get_field('layout');
	$background_image = get_field('background_image');

	$background_image_url = ($background_image) ? wp_get_attachment_image_url($background_image['ID'],'large') : false;

	$background_image_inline_style = ($background_image_url) ? "background-image: url($background_image_url)" : '';
?>

<section class="<?php echo $block_name . ' ' . $all_classes . ' ' . $layout; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

	<div class="<?php echo $block_name . '__background-image'; ?>" style="<?php echo $background_image_inline_style; ?>"></div>
	<div class="<?php echo $block_name . '__overlay'; ?>"></div>

	<div class="<?php echo $block_name . '__content container'; ?>">
		<div class="<?php echo $block_name . '__content-wrapper'; ?>">
			<div class="<?php echo $block_name . '__glass-box'; ?>">

					<?php if( $heading ): ?>
						<h3 class="<?php echo $block_name . '__heading h2'; ?>">
							<?php echo $heading; ?>
						</h3>
					<?php endif; ?>

					<?php if( $text ): ?>
						<p class="<?php echo $block_name . '__text'; ?>">
							<?php echo $text; ?>
						</p>
					<?php endif; ?>

					<?php if( $form_shortcode ): ?>
						<div class="<?php echo $block_name . '__form'; ?>">
							<?php echo do_shortcode($form_shortcode); ?>
						</div>
					<?php endif; ?>

			</div>
		</div>
	</div>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/repay-cta-form/repay-cta-form.php -->