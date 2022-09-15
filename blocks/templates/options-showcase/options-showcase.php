<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/options-showcase/options-showcase.php -->
<?php

	$block_name = prefix() . '-options-showcase';

	$buttons = [];

	$u_id = new_unique_id();

?>
<div
	id="<?php echo 'showcase-'.$u_id; ?>"
	class="<?php echo $block_name; ?>"
	>

	<?php if( have_rows('options') ): ?>

		<div class="<?php echo $block_name . '__showcase-container'; ?>">

			<?php
				$index = 0;
				while( have_rows('options') ) : the_row();

					$title = get_sub_field('title');
					$subtitle = get_sub_field('subtitle');
					$text = get_sub_field('text');
					$image = get_sub_field('image');
					$image_url = $image['sizes']['large'];
					if( empty( $image_url )) {
						$image_url = $image['url']; //  Full size
					}

					$buttons[]= $title;

				?>

					<div class="<?php echo $block_name . '__option'; ?>" <?php if($index !== 0) echo 'hidden'; ?>>

						<header class="<?php echo $block_name . '__header'; ?>">

							<h3 class="<?php echo $block_name . '__title'; ?>">
								<?php echo $title; ?>
							</h3>

							<?php if( $subtitle ): ?>
								<p class="<?php echo $block_name . '__subtitle'; ?>">
									<?php echo $subtitle; ?>
								</p>
							<?php endif; ?>

							<?php if( $text ): ?>
								<div class="<?php echo $block_name . '__text'; ?>">
									<?php echo $text; ?>
								</div>
							<?php endif; ?>

						</header>


						<div class="<?php echo $block_name . '__image-container'; ?>">
							<img class="<?php echo $block_name . '__image'; ?>" src="<?php echo $image_url; ?>" alt="">
						</div>

					</div>

				<?php
						$index++;
					endwhile;
			?>

		</div>
		<div class="<?php echo $block_name . '__button-container'; ?>">

			<h3 class="hide-large">Select an Option</h3>

			<?php
				$index = 0;
				foreach( $buttons as $button): ?>
				<button
					class="button <?php if($index === 0) echo 'active'; ?>"
					onclick="showcase_<?php echo $u_id; ?>(<?php echo $index; ?>)">
					<?php echo esc_html( $button ); ?>
				</button>
			<?php
					$index++;
				endforeach;
				?>
		</div>

	<?php endif; ?>

</div>
<script>
	function showcase_<?php echo $u_id; ?>( selected_index ) {
		// console.log('showcase', selected_index);
		const showcase_id = '<?php echo 'showcase-'.$u_id; ?>';
		const showcase = document.getElementById(showcase_id);
		const options = showcase.getElementsByClassName('<?php echo $block_name . '__option'; ?>');
		const button_container = showcase.getElementsByClassName('<?php echo $block_name . '__button-container'; ?>')[0];
		const buttons = button_container.getElementsByClassName('button');

		for(let i = 0; options[i]; i++) {
			if(i !== selected_index) {
				options[i].hidden = true;
				buttons[i].classList.remove('active');
			} else {
				options[i].hidden = false;
				buttons[i].classList.add('active');
			}
		}

		// If the view is stacked on smaler screen, and the view height is shorter than the showcase offsetHeight
		// if( window.innerWidth < 1201) { // (Nested "if" because WP doesn't let you use JS "&&" logical operator in a template)
		// 	if(showcase.offsetHeight > window.innerHeight) {

		// 		const button_container_end = button_container.getBoundingClientRect().bottom + window.scrollY;
		// 		const nav = document.getElementById('nav');
		// 		const offset = nav.offsetHeight + 100;

		// 		window['scroll_to'] = button_container_end - offset;

		// 		setTimeout(function(){
		// 			window.scrollTo({
		// 					 top: window['scroll_to'],
		// 					 behavior: "smooth"
		// 			});
		// 		}, 400);
		// 	}
		// }

	}

</script>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/options-showcase/options-showcase.php -->