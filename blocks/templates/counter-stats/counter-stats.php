<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/counter-stats/counter-stats.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-counter-stats';

	$heading = get_field('heading');

	$u_id = new_unique_id();
?>

<section class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>
	<div class="containerx">

		<header>

			<?php if( $heading ): ?>
				<h3 class="<?php echo $block_name . '__heading'; ?>">
					<?php echo $heading; ?>
				</h3>
			<?php endif; ?>

		</header>

		<?php if( have_rows('stats') ):
			$statCount = 0;
			?>

			<ul class="<?php echo $block_name . '__stats'; ?> fade-in-onload" style="list-style: none; display: flex; flex-direction: row; flex-wrap: wrap; margin: 2rem auto; padding: 0; width: 100%">
			<?php while( have_rows('stats') ) : the_row();
				$statCount++;
				$delay = ($statCount - 1) * 500;
				// $delay = 0;
				$u_id = new_unique_id();

				$stat_before = get_sub_field('stat_before');
				$stat_number = get_sub_field('stat_number');
				$stat_after = get_sub_field('stat_after');
				$stat_subtext = get_sub_field('stat_subtext');

				// Figure out format of stat_number
				$decimal = strpos($stat_number,'.');
				$decimal_place = (false == $decimal) ? 0 : strlen($stat_number) - ($decimal + 1);

				// Cast string to number
				$number = str_replace(',','',$stat_number);
				$number = (float) $number;

				// Cut into random-ish size pieces
				$step = $number / 17.3;
				$steps = [];
				for($i=1; $step * $i <= $number; $i++) {
					// Format each step like stat_number
					$steps[]= number_format((float)($step * $i), $decimal_place, '.', '');
				}

				// Convert to JS array
				$js_steps = json_encode($steps);

			?>

				<li id="counter-stat<?=$u_id?>" class="<?php echo $block_name . '__stat'; ?> scroll-class" style="padding: 2%; transition: all 0s 0s; --transition-delay:<?=$delay?>ms" data-inview-action="start_counter_stats<?=$u_id?>();">

					<?php if( $stat_number ): ?>
						<h4 class="<?php echo $block_name . '__stat-number'; ?>">
							<span class='stat-before'><?php echo $stat_before; ?></span><span class='stat-number counter-stat-number<?=$u_id?>' data-count-to="<?php echo $stat_number; ?>">0</span><span class='stat-after'><?php echo $stat_after; ?></span>
						</h4>
					<?php endif; ?>

					<?php if( $stat_subtext ): ?>
						<div class="<?php echo $block_name . '__stat-subtext'; ?>">
							<?php echo $stat_subtext; ?>
						</div>
					<?php endif; ?>

					<script>

						function start_counter_stats<?=$u_id?>() {
							setTimeout(function(){

								let target = document.getElementsByClassName('counter-stat-number<?=$u_id?>')[0];

								window.stat_intervals<?=$u_id?> = {
									count_to_string : "<?=$stat_number?>",
									steps : <?=$js_steps?>,
									target,
									container_id : "counter-stat<?=$u_id?>",
									i : 0,
								}

								window.stat_interval<?=$u_id?> = setInterval(function () {
									let i = window.stat_intervals<?=$u_id?>.i; // Get index
									window.stat_intervals<?=$u_id?>.i = i+1; // Iterate for next interval
									if(i < window.stat_intervals<?=$u_id?>.steps.length) {
										// Update the counter innerHTML
										window.stat_intervals<?=$u_id?>.target.innerHTML = Number(window.stat_intervals<?=$u_id?>.steps[i]).toLocaleString("en-US");
									}
									else {
										// Counter finished
										window.stat_intervals<?=$u_id?>.target.innerHTML = window.stat_intervals<?=$u_id?>.count_to_string;
										document.getElementById(window.stat_intervals<?=$u_id?>.container_id).classList.add('counter-finished');
										clearInterval(window.stat_interval<?=$u_id?>);
									}
								}, 100);

							}, (window.innerWidth > 767) ? <?=$delay?> : (<?=$delay?>/4));
						}

					</script>

				</li>

			<?php endwhile; ?>

			</ul>

		<?php endif; ?>

	</div>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/counter-stats/counter-stats.php -->