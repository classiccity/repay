<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/cta-slides/cta-slides.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-cta-slides';

	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$slides = [];
	$style = get_field('style');
	$slides_layout = get_field('slides_layout') ?? 'centered'; // 'centered' 'offset'

	$u_id = new_unique_id();

	while(have_rows('slides')) {
		the_row();
		$slide_image = get_sub_field('slide_image');
		$slide_card = array(
			'slide_heading' => get_sub_field('slide_heading'),
			'slide_image_html' => ($slide_image) ? wp_get_attachment_image($slide_image['ID'], 'large') : false,
			'button_link' => get_sub_field('button_link'),
		);

		$slides[]= $slide_card;
	}

	if(count($slides) && count($slides) < 6) {
		while(count($slides) < 6) {
			foreach($slides as $slide_card) {
				$slides[]= $slide_card;
			}
		}
	}



?>
<section class="<?php echo $block_name . ' ' . $all_classes . ' ' . $style;  ?> alignfull" <?php if( !empty( $id )) echo "id='$id'"; ?>>

	<div class="container">
	<div class="group">
	<div class="c c-12">

		<header>
			<?php if( $heading ): ?>
				<h3 class="<?php echo $block_name . '__heading'; ?>">
					<?=$heading?>
				</h3>
			<?php endif; ?>
		</header>

		<?php if( count($slides) ): ?>
			<div class="swiper-ctrl slides-layout--<?= $slides_layout ?>">
			<div class="swiper mySwiper<?=$u_id?>">

				<div class="swiper-navigation">
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>

				<div class="swiper-wrapper">

					<?php foreach($slides as $slide_card):

						$slide_heading = $slide_card['slide_heading'];
						$slide_image_html = $slide_card['slide_image_html'];
						$button_link = $slide_card['button_link'];

						?>
							<div class="swiper-slide" onclick="go_to_my_link(this)">

									<?php if( $slide_heading ): ?>
										<strong class="
											<?php echo $block_name . '__slide-heading'; ?>
											<?php if(!$slide_image_html) echo 'h3'; ?>
										">
											<?=$slide_heading?>
										</strong>
									<?php else: ?>
										<!-- </br> -->
									<?php endif; ?>

									<?php if( $slide_image_html ): ?>
										<div class="<?php echo $block_name . '__image-container'; ?>">
												<?=$slide_image_html?>
										</div><!-- logo-container -->
									<?php endif; ?>

										<!-- </br> -->

									<?php
										if( $button_link ):
											UI::html_acf_link($button_link, 'dot-link '. $block_name . '__link');
										else:
											echo '</br>';
										endif;
									?>


							</div><!-- swiper-slide -->
						<?php endforeach; ?>


					</div><!-- swiper-wrapper -->
				<!-- <div class="swiper-pagination"></div> -->
			</div><!-- swiper mySwiper -->

			<!-- Initialize Swiper -->
			<script>
				var swiper = new Swiper(".mySwiper<?=$u_id?>", {
					slidesPerView: 4,
					spaceBetween: 32,
					slidesPerGroup: 1,
					loop: true,
					loopFillGroupWithBlank: true,
					// pagination: {
					// 	el: ".swiper-pagination",
					// 	clickable: true,
					// },
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
				});
			</script>
		</div>
		<?php endif; ?>

	</div>
	</div>
	</div>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/cta-slides/cta-slides.php -->