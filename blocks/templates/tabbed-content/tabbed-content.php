<?php

// Accessible tabs modified from https://www.w3.org/WAI/ARIA/apg/example-index/tabs/tabs-manual.html

include(get_theme_file_path().'/blocks/blocks.settings.php');

$block_name = prefix() . '-tabbed-content';

$heading = get_field('heading');
$subheading = get_field('subheading');

$u_id = new_unique_id();

$svg_option = 'dot-circle';

?>

<section class="<?php echo $block_name . ' ' . $all_classes ?> alignfull" <?php if( !empty( $id )) echo "id='$id'"; ?>>
	<header class="container">

		<?php if($heading): ?>
			<h2 class="h3"><?=$heading;?></h2>
		<?php endif; ?>

		<?php if($subheading): ?>
			<p><?=$subheading;?></p>
		<?php endif; ?>

	</header>

	<div class="tab-list">

		<div class="container">

			<?php if(have_rows('tabs')):
				$count = 0;
				?>

				<div role="tablist" aria-labelledby="tablist-<?=$count?>" class="manual">
					<?php while ( have_rows('tabs') ) : the_row(); $count++; ?>
						<button id="tab-<?=$count?>" type="button" role="tab" aria-selected="<?php echo ($count == 1) ? 'true' : 'false'; ?>" aria-controls="tabpanel-<?=$count?>">
							<?php the_sub_field('tab_heading'); ?>
						</button>
					<?php endwhile; ?>
				</div>

			<?php endif; // tabs - 1 ?>

			<?php if(have_rows('tabs')):
				$count = 0;
				?>
				<?php while ( have_rows('tabs') ) : the_row(); $count++; // content

					$content_image = get_sub_field('content_image');
					$content_image_html = ($content_image) ? wp_get_attachment_image($content_image['ID'], 'large') : false;

					$content_heading = get_sub_field('content_heading');
					$content_text = get_sub_field('content_text');

					$button_link = get_sub_field('button_link');

				?>
					<div id="tabpanel-<?=$count?>" role="tabpanel" aria-labelledby="tab-<?=$count?>" <?php if($count > 1) echo 'tabindex="-1" class="is-hidden"'; ?>>

									<?php if( $content_image_html ): ?>

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

										<div class="<?php echo $block_name . '__media-container'; ?>">
											<?=$content_image_html?>
										</div>

									<?php endif; ?>

									<div class="<?php echo $block_name . '__text-container'; ?>">

										<?php if( $content_heading ): ?>
											<h3 class="h5 <?php echo $block_name . '__heading'; ?>">
												<?=$content_heading?>
											</h3>
										<?php endif; ?>

										<?php if( $content_text ): ?>
											<div class="<?php echo $block_name . '__text'; ?>">
												<?=$content_text?>
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
				<?php endwhile; ?>
			<?php endif; // tabs - 2 ?>

		</div><!-- container -->
	</div><!-- tab-list -->
</section>