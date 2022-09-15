<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/accordion-drawers/accordion-drawers.php -->
<?php

$block_name = prefix() . '-accordion-drawers';

?>
<div class="<?php echo $block_name; ?>">

	<?php if( have_rows('drawers') ): ?>

		<?php while( have_rows('drawers') ) : the_row();

			$title = get_sub_field('title');
			$text = get_sub_field('text');

		?>

		<div
			class="<?php echo $block_name . '__drawer'; ?>"
			aria-expanded="false"
			>

		<button
			class="<?php echo $block_name . '__toggle'; ?>"
			title="Open/Close"
			onclick="javascript: parentElement.setAttribute('aria-expanded',parentElement.getAttribute('aria-expanded') !== 'true');"
			>

			<div class="<?php echo $block_name . '__toggle-icon'; ?>">
				<div class="toggle-line toggle-line--1"></div>
				<div class="toggle-line toggle-line--2"></div>
			</div>

			<h3 class="<?php echo $block_name . '__title'; ?>">
				<?php echo $title; ?>
			</h3>

		</button>



			<!-- <div class="<?php // echo $block_name . '__text-container'; ?>"> -->

				<div class="<?php echo $block_name . '__text'; ?>">
					<?php echo $text; ?>
				</div>

			<!-- </div> -->

		</div>

		<?php endwhile; ?>

	<?php endif; ?>

</div>


<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/accordion-drawers/accordion-drawers.php -->