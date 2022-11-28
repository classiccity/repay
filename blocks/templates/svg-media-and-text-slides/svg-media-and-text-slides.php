<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/svg-media-and-text-slides/svg-media-and-text-slides.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-svg-media-and-text-slides';

	$svg_option = get_field('svg_option'); // 'dot-circle' 'dot-wave' 'none'
	$size_option = '50-50'; // get_field('size_option'); // '50-50' '60-40'

	$heading = get_field('heading');
	$text = get_field('text');

	$u_id = new_unique_id();

?>
<section class="<?php echo $block_name . ' ' . $all_classes . ' size-option-' . $size_option . ' has-' . $svg_option ; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

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

	<header>
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
	</header>

	<?php if( have_rows('slides') ): ?>
		<div class="swiper mySwiper<?=$u_id?>">

			<div class="swiper-navigation">
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>

			<div class="swiper-wrapper">

				<?php while( have_rows('slides') ) : the_row();
					$layout = 'image-left'; // get_sub_field('layout'); // 'image-left' 'image-right'
					$media = get_sub_field('media');
					$media_html = ($media) ? wp_get_attachment_image($media['ID'], 'large') : false;

					$heading = get_sub_field('heading');
					$text = get_sub_field('text');
					$button_link = get_sub_field('button_link');
					?>
						<div class="swiper-slide  <?=$layout?>">

							<?php if( $media_html ): ?>
								<div class="<?php echo $block_name . '__media-container'; ?>">
									<?=$media_html?>
								</div><!-- media-container -->
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

								<?php
									if( $button_link ):
										UI::html_acf_link($button_link, 'button');
									endif;
								?>
							</div><!-- text-container -->

						</div><!-- swiper-slide -->
					<?php endwhile; ?>


				</div><!-- swiper-wrapper -->
			<div class="swiper-pagination"></div>
		</div><!-- swiper mySwiper -->

		<!-- Initialize Swiper -->
		<script>
			var swiper = new Swiper(".mySwiper<?=$u_id?>", {
				slidesPerView: 1,
				spaceBetween: 0,
				slidesPerGroup: 1,
				loop: true,
				loopFillGroupWithBlank: true,
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		</script>

	<?php endif; ?>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/svg-media-and-text-slides/svg-media-and-text-slides.php -->