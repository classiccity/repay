<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/counter-stats/counter-stats.php -->
<?php

	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-counter-stats';

	$heading = get_field('heading');

	$u_id = new_unique_id();
?>

<section class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>
	<div class="container">

		<header>

			<?php if( $heading ): ?>
				<h3 class="<?php echo $block_name . '__heading'; ?>">
					<?php echo $heading; ?>
				</h3>
			<?php endif; ?>

		</header>

		<?php if( have_rows('stats') ): ?>
			<ul class="<?php echo $block_name . '__stats'; ?>" style="list-style: none; display: flex; flex-direction: row; flex-wrap: wrap; margin: 2rem auto; padding: 0;">
			<?php while( have_rows('stats') ) : the_row();

				$stat_before = get_sub_field('stat_before');
				$stat_number = get_sub_field('stat_number');
				$stat_after = get_sub_field('stat_after');
				$stat_subtext = get_sub_field('stat_subtext');

			?>

				<li class="<?php echo $block_name . '__stat '; ?>" style="padding: 1rem;">

					<?php if( $stat_number ): ?>
						<h4 class="<?php echo $block_name . '__stat-number'; ?>">
							<span class='stat-before'>
								<?php echo $stat_before; ?>
							</span>
							<span class='stat-number counter-stat-number<?=$u_id?>' data-count-to="<?php echo $stat_number; ?>">0</span>
							<span class='stat-after'>
								<?php echo $stat_after; ?>
							</span>
						</h4>
					<?php endif; ?>

					<?php if( $stat_subtext ): ?>
						<div class="<?php echo $block_name . '__stat-subtext'; ?>">
							<?php echo $stat_subtext; ?>
						</div>
					<?php endif; ?>

				</li>

			<?php endwhile; ?>

			</ul>

		<?php endif; ?>

	</div>


	<script>

		function start_counter_stats<?=$u_id?>() {
			let stats = document.getElementsByClassName('counter-stat-number<?=$u_id?>');
			window.stat_intervals<?=$u_id?> = [];

			for( let i = 0; stats[i]; i++ ) {
				let count_to_string = stats[i].getAttribute('data-count-to');
				if(undefined === count_to_string) {
					console.warn('No data-count-to attrinbute:',stats[i]);
					continue;
				}

				count_to_number = Number(count_to_string.replace(/,/g, '')); // strip commas, convert to number
				step = (Math.floor(count_to_number / 17.2));
				step = (step > 0) ? step : 1;
				current_number = step;

				stats[i].innerHTML = current_number.toLocaleString("en-US");

				let interval_settings = {
					count_to_string,
					count_to_number,
					target : stats[i],
					step,
					current_number,
				}
				window.stat_intervals<?=$u_id?>.push(interval_settings);
			}

			window.stat_interval<?=$u_id?> = setInterval(function () {
				let done = false;
				for( let i = 0; window.stat_intervals<?=$u_id?>[i]; i++ ) {
					if(done || (window.stat_intervals<?=$u_id?>[i].current_number + window.stat_intervals<?=$u_id?>[i].step) >= window.stat_intervals<?=$u_id?>[i].count_to_number) {
						window.stat_intervals<?=$u_id?>[i].target.innerHTML = window.stat_intervals<?=$u_id?>[i].count_to_string;
						// console.log(window.stat_intervals<?=$u_id?>[i].count_to_string,window.stat_intervals<?=$u_id?>[i]);
						done = true;
					}
					else {
						window.stat_intervals<?=$u_id?>[i].current_number+= window.stat_intervals<?=$u_id?>[i].step;
						window.stat_intervals<?=$u_id?>[i].target.innerHTML = window.stat_intervals<?=$u_id?>[i].current_number.toLocaleString("en-US");
					}
				}
				if(done) {
					// console.log('clearing window.stat_interval<?=$u_id?>', window.stat_intervals<?=$u_id?>);
					clearInterval(window.stat_interval<?=$u_id?>);
				}
			}, 100)
		}

		jQuery( document ).ready(function() {
			start_counter_stats<?=$u_id?>();
		})

	</script>

</section>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/counter-stats/counter-stats.php -->