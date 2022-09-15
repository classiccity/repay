<footer id="footer">
    <div class="xalignwide container footer-container">

					<div class="footer-left-container">

						<?php
							if(get_theme_mod(prefix().'_logo')) {
								// Select image from Appearance -> Customize ->  Site Identity
								echo '<img src="' . get_theme_mod(prefix().'_logo') . '" class="' . prefix() . '-logo">';
							}
						?>

						<div class="footer-left">
								<?php dynamic_sidebar( 'footer-left' ); ?>
						</div>

					</div><!-- footer-left-container -->

					<div class="footer-right-container">
<!--
						<?php // if( has_nav_menu( 'footer-menu' ) ): ?>
							<nav role="navigation" class="footer-menu-wrapper">
								<ul tabindex="0" class="footer-menu">
									<?php
										// wp_nav_menu(
										// 	array(
										// 		'container'      => '',
										// 		'menu_class'		 => 'footer-menu',
										// 		'depth'          => 1, // Show one level deep of child menu items
										// 		'items_wrap'     => '%3$s',
										// 		'theme_location' => 'footer-menu',
										// 	)
										// );
									?>
								</ul>
							</nav>
						<?php // endif; ?> -->

						<div class="footer-right">
								<?php dynamic_sidebar( 'footer-right' ); ?>
						</div>

					</div><!-- footer-right-container -->

    </div>
</footer>

        <?php wp_footer(); ?>
    </body>
</html>