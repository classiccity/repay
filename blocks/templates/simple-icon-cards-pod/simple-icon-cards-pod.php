<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/simple-icon-cards/simple-icon-cards.php -->
<?php

$block_name = prefix() . '-simple-icon-cards-pod';

?>
<div class="<?php echo $block_name; ?>">

	<?php if( have_rows('cards') ): ?>

		<?php while( have_rows('cards') ) : the_row();

			$title = get_sub_field('title');
			$text = get_sub_field('text');
			$link = get_sub_field('button_link');

			$icon = get_sub_field('icon');
			$icon_url = $icon['sizes'][prefix().'-thumbnail-full'];
		?>

		<div class="<?php echo $block_name . '__card'; ?>">

			<?php if( $icon_url ): ?>
				<div class="<?php echo $block_name . '__icon-container'; ?>">
					<img class="<?php echo $block_name . '__icon'; ?>" src="<?php echo $icon_url; ?>" alt="">
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

	<?php endif; ?>

</div>

<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/simple-icon-cards/simple-icon-cards.php -->