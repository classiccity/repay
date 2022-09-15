<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/image-cta-cards-pod/image-cta-cards-pod.php -->
<?php

	$block_name = prefix() . '-image-cta-cards-pod';

?>
<?php if( have_rows('cards') ): ?>

	<div class="<?php echo $block_name; ?>">

		<?php while( have_rows('cards') ) : the_row();

			$title = get_sub_field('title');
			$text = get_sub_field('text');
			$link = get_sub_field('button_link');

			$image = get_sub_field('image');
			$image_url = $image['sizes']['large'];
			if( empty( $image_url )) {
				$image_url = $image['url']; //  Full size
			}
		?>

		<div class="<?php echo $block_name . '__card'; ?>">

			<?php if( $image_url ): ?>
				<div class="<?php echo $block_name . '__image-container'; ?>">
					<img class="<?php echo $block_name . '__image'; ?>" src="<?php echo $image_url; ?>" alt="">
				</div>
			<?php endif; ?>

			<div class="<?php echo $block_name . '__cta-container'; ?>">

				<?php if( $title ): ?>
					<h3 class="<?php echo $block_name . '__title'; ?>">
						<?php echo $title; ?>
					</h3>
				<?php endif; ?>

				<?php if( $text ): ?>
					<div class="<?php echo $block_name . '__text'; ?>">
						<?php echo $text; ?>
					</div>
				<?php endif; ?>

				<?php if( $link ): ?>
					<div class="<?php echo $block_name . '__button'; ?>">
						<?php UI::html_acf_link( $link, 'button' ); ?>
					</div>
				<?php endif; ?>

			</div>

		</div><!-- __card -->

		<?php endwhile; ?>

	</div>

<?php endif; ?>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/image-cta-cards-pod/image-cta-cards-pod.php -->