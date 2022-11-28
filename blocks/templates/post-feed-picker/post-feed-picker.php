<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/post-feed-picker/post-feed-picker.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-post-feed-picker';

	$heading = get_field('heading');

	$select_posts_method = get_field('select_posts'); // 'most_recent' 'by_category' 'manually'

	$categories = get_field('categories');
	$which_posts = get_field('which_posts');
	$how_many_posts = get_field('how_many_posts') ? get_field('how_many_posts') : '3';


	$selected_posts = array();
	$return_output_as = OBJECT;

	if('manually' ===  $select_posts_method && !empty($which_posts)) {
		$selected_posts = $which_posts;
	}
	elseif('by_category' ===  $select_posts_method && !empty($categories) && !empty($how_many_posts)) {
		$q_posts = wp_get_recent_posts(array(
			'posts_per_page' => $how_many_posts,
			'post_status' => 'publish',
			'category' => $categories,
		),
		$return_output_as);
		$selected_posts = $q_posts;
	}
	elseif('most_recent' ===  $select_posts_method && !empty($how_many_posts)) {
		$q_posts = wp_get_recent_posts(array(
			'posts_per_page' => $how_many_posts,
			'post_status' => 'publish',
		),
		$return_output_as);
		$selected_posts = $q_posts;
	}

	$snippet_args = array(
		'character_limit' => 140,
	);

?>
<section class="<?php echo $block_name . ' ' . $all_classes; ?> alignfull" <?php if( !empty( $id )) echo "id='$id'"; ?>>

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


		<nav>
			<ul class="<?php echo $block_name . '__feed-list'; ?>" style="list-style: none;">

				<?php foreach($selected_posts as $s_post):
					$s_post_image_html = get_the_post_thumbnail($s_post, 'medium');
					$s_post_title = get_the_title($s_post);
					$s_post_text = get_snippet($s_post, $snippet_args);
					$s_post_url = get_permalink($s_post->ID);
				?>

					<li class="<?php echo $block_name . '__card'; ?>" onclick="go_to_my_link(this)">
						<article>

							<?php if( $s_post_image_html ): ?>
								<div class="<?php echo $block_name . '__image-container'; ?>">
										<?=$s_post_image_html?>
								</div>
							<?php endif; ?>

							<div class="<?php echo $block_name . '__text-container'; ?>">

								<?php if( $s_post_title ): ?>
									<h3 class="<?php echo $block_name . '__title'; ?>">
										<?=$s_post_title?>
									</h3>
								<?php endif; ?>

								<?php if( $s_post_text ): ?>
									<div class="<?php echo $block_name . '__text'; ?>">
										<?=$s_post_text?>
									</div>
								<?php endif; ?>

								<?php
									$button_link = array(
										'url' => $s_post_url,
										'title' => 'READ MORE',
										'attributes' => "aria-label='Read about $s_post_title'",
									);
									UI::html_acf_link($button_link, 'dot-link '. $block_name . '__link');
								?>

							</div>

						</article>
					</li>

				<?php endforeach; ?>

			</ul>
		</nav>



	</div>
	</div>
	</div>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/post-feed-picker/post-feed-picker.php -->