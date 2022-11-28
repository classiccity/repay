<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/svg-text-and-icons/svg-text-and-icons.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-svg-text-and-icons';

	$svg_option = get_field('svg_option'); // 'dot-circle' 'dot-wave' 'none'
	$layout = get_field('layout'); // 'icons-left' 'icons-right'
	$size_option = get_field('size_option'); // '50-50' '60-40'

	$heading = get_field('heading');
	$text = get_field('text');
	$button_link = get_field('button_link');

?>
<div class="<?php echo $block_name . ' ' . $all_classes . ' ' . $layout . ' size-option-' . $size_option ; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

	<?php
		if('none' !== $svg_option):
			echo "<!-- svg_option : $svg_option -->";
			$template_part_args = array(
				'modifier_class' => $block_name.'__svg-background '.$svg_option,
				'svg' => $svg_option,
			);
			get_template_part('template-parts/svg-animation', null, $template_part_args);
		endif;
	?>

			<?php if( have_rows('icons') ): ?>
				<div class="<?php echo $block_name . '__icons-container'; ?>">
					<?php while( have_rows('icons') ) : the_row();
						$icon_image = get_sub_field('icon_image');
						$icon_image_html = wp_get_attachment_image($icon_image['ID'], 'thumbnail');
						$blurb = get_sub_field('blurb');
					?>
						<div class="<?php echo $block_name . '__icon'; ?>">

							<?=$icon_image_html?>

							<?php if($blurb): ?>
								<div class="<?php echo $block_name . '__icon-blurb'; ?>">
									<?=$blurb?>
								</div>
							<?php endif; ?>

						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<div class="<?php echo $block_name . '__text-container'; ?>">

				<?php if( $heading ): ?>
					<h3 class="<?php echo $block_name . '__heading'; ?> repay-lime">
						<?=$heading?>
					</h3>
				<?php endif; ?>

				<?php if( $text ): ?>
					<div class="<?php echo $block_name . '__text'; ?>">
						<?=$text?>
					</div>
				<?php endif; ?>

				<?php
					if( $button_link ):
						UI::html_acf_link($button_link, 'button');
					endif;
				?>

			</div>

</div>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/svg-text-and-icons/svg-text-and-icons.php -->