<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/testimonial-slides/testimonial-slides.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-testimonial-slides';

	$svg_option = get_field('svg_option'); // 'dot-wave' 'dot-wave-3' 'none'

	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$display = get_field('display');

	$testimonials = get_field('testimonials');

	$slides_per_view = (get_field('slides_per_view')) ? get_field('slides_per_view') : '2';

	$u_id = new_unique_id();

?>
<section class="<?php echo $block_name . ' ' . $all_classes . ' has-' . $svg_option . ' slides-per-view-' . $slides_per_view; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

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

		<?php if( $subheading ): ?>
			<div class="<?php echo $block_name . '__subheading'; ?>">
				<?=$subheading?>
			</div>
		<?php endif; ?>
	</header>

	<?php

		// var_dump($display);
		// var_dump(in_array('headline', $display));
	?>

	<?php if( $testimonials ): ?>
		<div class="swiper mySwiper<?=$u_id?>">
			<div class="swiper-wrapper">

				<?php foreach($testimonials as $testimonial):

					$t_ID = $testimonial->ID;

					$headline = (in_array('headline', $display)) ? get_field('headline', $t_ID) : false;
					$quote = (in_array('quote', $display)) ? get_field('quote', $t_ID) : false;

					$button_link = (in_array('button_link', $display)) ? get_field('button_link', $t_ID) : false;

					$persons_name = (in_array('persons_name', $display)) ? get_field('persons_name', $t_ID) : false;
					$persons_title = (in_array('persons_title', $display)) ? get_field('persons_title', $t_ID) : false;

					$company_logo = (in_array('company_logo', $display)) ? get_field('company_logo', $t_ID) : false;
					$company_logo_html = ($company_logo) ? wp_get_attachment_image($company_logo['ID'], 'large') : false;
					$company_logo_after = (in_array('company_logo_after', $display)) ? get_field('company_logo_after', $t_ID) : false;

					?>
						<div class="swiper-slide">

							<div class="<?php echo $block_name . '__text-container'; ?>">

								<?php if( $headline ): ?>
									<strong class="<?php echo $block_name . '__headline'; ?>">
										<?=$headline?>
									</strong>
								<?php endif; ?>

								<?php if( $quote ): ?>
									<div class="<?php echo $block_name . '__quote'; ?>">
									&ldquo;<?=$quote?>&rdquo;
									</div>
								<?php endif; ?>

								<?php if( $button_link ): ?>
									<div class="<?php echo $block_name . '__button_link'; ?>">
										<?php UI::html_acf_link( $button_link, 'button dot-link' ); ?>
									</div>
								<?php endif; ?>

							</div><!-- text-container -->

							<div class="<?php echo $block_name . '__footer-container'; ?>">

								<?php if( $company_logo_html || $company_logo_after ): ?>
									<div class="<?php echo $block_name . '__logo-container'; ?>">
										<?php if( $company_logo_html ): ?>
											<?=$company_logo_html?>
											<?php endif; ?>
											<?php if( $company_logo_after ): ?>
												<div><?=$company_logo_after?></div>
											<?php endif; ?>
										</div><!-- logo-container -->
								<?php endif; ?>

								<?php if( $persons_name ||  $persons_title ): ?>
									<div class="<?php echo $block_name . '__cite-container'; ?>">
										<?php if( $persons_name ): ?>
											<div><?=$persons_name?></div>
										<?php endif; ?>
										<?php if( $persons_title ): ?>
											<div><?=$persons_title?></div>
										<?php endif; ?>
									</div><!-- logo-container -->
								<?php endif; ?>

							</div><!-- footer-container -->

						</div><!-- swiper-slide -->
					<?php endforeach; ?>


				</div><!-- swiper-wrapper -->
			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div><!-- swiper mySwiper -->

		<!-- Initialize Swiper -->
		<script>
			var swiper = new Swiper(".mySwiper<?=$u_id?>", {
				slidesPerView: <?=$slides_per_view?>,
				spaceBetween: 32,
				slidesPerGroup: 1,
				loop: true,
				loopFillGroupWithBlank: false,
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
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/testimonial-slides/testimonial-slides.php -->