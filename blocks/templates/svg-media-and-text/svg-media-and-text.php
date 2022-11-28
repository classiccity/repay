<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/svg-media-and-text/svg-media-and-text.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-svg-media-and-text';

	$svg_option = get_field('svg_option'); // 'dot-circle' 'dot-wave' 'none'
	$layout = get_field('layout'); // 'image-left' 'image-right'
	$size_option = get_field('size_option'); // '50-50' '60-40'

	$media = get_field('media');
	$media_html = ($media) ? wp_get_attachment_image($media['ID'], 'large') : false;

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

			<?php if( $media_html ): ?>
				<div class="<?php echo $block_name . '__media-container'; ?>">
					<?=$media_html?>
				</div>
			<?php endif; ?>

			<div class="<?php echo $block_name . '__text-container'; ?>">

				<?php if( $heading ): ?>
					<h3 class="<?php echo $block_name . '__heading'; ?>">
						<?=$heading?>
					</h3>
				<?php endif; ?>

				<?php if( $text ): ?>
					<div class="<?php echo $block_name . '__text'; ?>">
						<?=$text?>
					</div>
				<?php endif; ?>

				<?php if(have_rows('icon_list')): ?>
					<ul class="<?php echo $block_name . '__icon-list'; ?>">
						<?php while ( have_rows('icon_list') ) : the_row();

							$item_icon = get_sub_field('item_icon');
							$item_icon_html = ($item_icon) ? wp_get_attachment_image($item_icon['ID'], prefix().'-thumbnail-full' ) : false;
							$item_text = get_sub_field('item_text');
						?>
							<li>
								<?php if($item_icon_html) echo $item_icon_html; ?>
								<div>
									<?=$item_text?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>

				<?php
					if( $button_link ):
						UI::html_acf_link($button_link, 'button');
					endif;
				?>

			</div>

</div>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/svg-media-and-text/svg-media-and-text.php -->