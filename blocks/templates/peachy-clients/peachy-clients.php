<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/peachy-clients/peachy-clients.php -->
<?php

	$block_name = prefix() . '-peachy-clients';

?>
<?php if( have_rows('clients') ): ?>
	<div class="<?php echo $block_name; ?>">

		<?php while( have_rows('clients') ) : the_row();
				$name = get_sub_field('name');
				$image = get_sub_field('image');
				$url = get_sub_field('url');
				$image_url = $image['sizes']['thumbnail'];
				if( empty( $image_url )) {
					$image_url = $image['url'];
				}
				$add_padding = get_sub_field('add_padding');
			?>

				<?php if( ! empty( $url )) echo "<a href='$url' target='_blank'>"; ?>

					<img class="<?php echo $block_name . '__icon'; ?> <?php if( $add_padding ) echo $block_name . '__icon--padding'; ?>" src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>">

				<?php if( ! empty( $url )) echo "</a>"; ?>
			<?php
			endwhile;
		?>

	</div>
<?php endif; ?>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/peachy-clients/peachy-clients.php -->