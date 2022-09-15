<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/link-cards/link-cards.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-link-cards';

	$heading = get_field('heading');
	$text = get_field('text');

	$svg_option = get_field('svg_option'); // 'dot-wave' 'none'

?>

<section class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

	<header>

		<?php if( $heading ): ?>
			<h3 class="<?php echo $block_name . '__heading'; ?>">
				<?php echo $heading; ?>
			</h3>
		<?php endif; ?>

		<?php if( $text ): ?>
			<div class="<?php echo $block_name . '__text'; ?>">
				<?php echo $text; ?>
			</div>
		<?php endif; ?>

	</header>

	<?php if( have_rows('link_cards') ): ?>
		<ul class="<?php echo $block_name . '__cards'; ?>">
		<?php while( have_rows('link_cards') ) : the_row();

			$card_heading = get_sub_field('card_heading');
			$card_text = get_sub_field('card_text');
			$card_link = get_sub_field('card_link');
		?>

			<li class="<?php echo $block_name . '__card'; ?> scroll-class" data-scroll-class="is-viewed" data-removable-scroll-class="false">

				<?php if( $card_heading ): ?>
					<h4 class="<?php echo $block_name . '__card-title'; ?>">
						<?php echo $card_heading; ?>
					</h4>
				<?php endif; ?>

				<?php if( $card_text ): ?>
					<div class="<?php echo $block_name . '__card-text'; ?>">
						<?php echo $card_text; ?>
					</div>
				<?php endif; ?>

				<?php if( $card_link ): ?>
					<div class="<?php echo $block_name . '__card-button'; ?>">
						<?php UI::html_acf_link( $card_link, 'text-button dot-link' ); ?>
					</div>
				<?php endif; ?>

			</li>

		<?php endwhile; ?>

		</ul>

	<?php endif; ?>

	<?php
	if('none' !== $svg_option):
			$template_part_args = array(
				'modifier_class' => $block_name.'__svg-background '.$svg_option,
				'svg' => $svg_option,
			);
			get_template_part('template-parts/svg-animation', null, $template_part_args);
		endif;
	?>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/link-cards/link-cards.php -->