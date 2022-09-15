<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/featured-clients/featured-clients.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-featured-clients';

?>
<?php if( have_rows('clients') ): ?>
	<div class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>

		<?php while( have_rows('clients') ) : the_row();
				$name = get_sub_field('name');
				$image = get_sub_field('image');
				$url = get_sub_field('url');
				$image_url = wp_get_attachment_image_url($image['ID'], 'medium');
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
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/featured-clients/featured-clients.php -->