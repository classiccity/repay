<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/cta-icon-card-pod/cta-icon-card-pod.php -->
<?php

	$block_name = prefix() . '-cta-icon-card-pod';

	$title = get_field('title');
	$text = get_field('text');
	$link = get_field('button_link');

	$icon = get_field('icon');
	$icon_url = $icon['sizes']['thumbnail'];

	$background_image = get_field('background_image');
	$background_image_url = $background_image['sizes'][prefix().'-background-image'];
	if( empty( $background_image_url )) {
		$background_image_url = $background_image['url']; //  Full size
	}

?>

<div class="<?php echo $block_name; ?>" style="<?php echo "background-image: url($background_image_url)"; ?>">
	<div class="<?php echo $block_name . '__overlay'; ?>"></div>
	<div class="<?php echo $block_name . '__content'; ?>">
		<div class="<?php echo $block_name . '__content-container'; ?>">

			<?php if( $icon_url ): ?>
				<!-- <div class="<?php // echo $block_name . '__icon-container'; ?>"> -->
					<img class="<?php echo $block_name . '__icon'; ?>" src="<?php echo $icon_url; ?>" alt="">
				<!-- </div> -->
			<?php endif; ?>

			<?php if( $title ): ?>
				<h3 class="<?php echo $block_name . '__title'; ?>">
					<?php echo $title; ?>
				</h3>
			<?php endif; ?>

			<?php if( $text ): ?>
				<p>
					<?php echo $text; ?>
				</p>
			<?php endif; ?>

			<?php if( $link ): ?>
				<div class="<?php echo $block_name . '__button'; ?>">
					<?php UI::html_acf_link( $link, 'button' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>

<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/cta-icon-card-pod/cta-icon-card-pod.php -->