<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/staff-cards/staff-cards.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-staff-cards';

	$svg_option = 'dot-circle'; // get_field('svg_option'); // 'dot-circle' 'dot-wave' 'none'

?>

<div class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

	<?php
		if('none' !== $svg_option):
			$template_part_args = array(
				'modifier_class' => $block_name.'__svg-background '.$svg_option,
				'svg' => $svg_option,
			);
			get_template_part('template-parts/svg-animation', null, $template_part_args);
		endif;
	?>

	<?php if( have_rows('staff') ): ?>
		<ul class="<?php echo $block_name . '__staff-cards'; ?>">
			<?php while( have_rows('staff') ) : the_row();
					$name = get_sub_field('name');
					$title = get_sub_field('title');
					$link = get_sub_field('link');

					$image = get_sub_field('image');
					$image_html = wp_get_attachment_image($image['ID'], 'medium');
				?>

					<li class="<?php echo $block_name . '__staff-card'; ?>">

						<?php if( $image_html ): ?>
							<div class="<?php echo $block_name . '__image-container'; ?>">
								<?php echo $image_html; ?>
							</div>
						<?php endif; ?>

						<?php if( $name ): ?>
							<h3 class="<?php echo $block_name . '__name'; ?> has-medium-font-size">
								<?php echo $name; ?>
							</h3>
						<?php endif; ?>

						<?php if( $title ): ?>
							<p class="<?php echo $block_name . '__title'; ?>">
								<?php echo $title; ?>
							</p>
						<?php endif; ?>

						<?php if( $link ): ?>
							<div class="<?php echo $block_name . '__button'; ?>">
								<?php UI::html_acf_link( $link, 'dot-link' ); ?>
							</div>
						<?php endif; ?>

					</li>

				<?php
				endwhile;
			?>

		</ul>
	<?php endif; ?>

</div>

<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/staff-cards/staff-cards.php -->