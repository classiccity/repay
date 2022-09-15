<?php
Class UI {



    /**
     * Get a list of available colors
     * @return array - colors
     */
    public static function colors() {
        return array(
            'primary'                        => "Blue",
            'secondary'                      => "Green",
            'dark'                           => "Gray",

            'primary-opposite'               => "White (with Blue accent)",
            'secondary-opposite'             => "White (with Green accent)",
            'dark-opposite'                  => "White (with Gray accent)",
        );
    }



    /**
     * Outputs the `hero` using a post object
     * @param $post
     */
    public static function hero_from_post($post) {

        // If it's an object
        if(isset($post->ID)) {
            $post_id = $post->ID;
        } else {
            $post_id = $post;
        }

        // Get some core meta data
        $turn_off_hero = get_field('turn_off_hero',$post_id);

        // If the toggle is NOT true...
        if($turn_off_hero !== true) {

            // Holder of data
            $hero_data = array();

            // CSS Classes holder
            $hero_data['css_classes'] = "";

            // Get button data
            $button = get_field('button',$post_id);

            // Figure out whether to use the Post Title or the Override Title
            $hero_title = get_the_title($post_id);
            $hero_override_title = get_field('title_override',$post_id);
            $hero_title = (strlen($hero_override_title) > 1) ? $hero_override_title : $hero_title;

            // Get the subtitle
            $hero_data['subtitle'] = get_field('hero_subtitle',$post_id);

            // Get the Style
            $style = get_field('hero_style',$post_id);

            // Get the text color
            $text_color = get_field('text_color',$post_id);

            // If we have a style selected...
            if(strlen($style) > 1) {
                $hero_data['css_classes'] .= " is-".$style;
            }

            if(strlen($text_color) > 1) {
                $hero_data['css_classes'] .= " is-".$text_color;
            } else {
                $hero_data['css_classes'] .= ' nope';
            }

            // Where to pull the background image from?
            $where_bg = get_field('where_to_pull_bg_image',$post_id);

            // We don't actually have a selection OR Featured Image
            if(strlen($where_bg) < 1 || $where_bg === "featured") {

                // The hero image is the Featured Image
                $hero_background_image = get_the_post_thumbnail_url($post_id);

                // Add a CSS class just in case
                $hero_data['css_classes'] .= " is-bg-featured";

            }

            // We have a manual selection
            elseif($where_bg === "manual") {

                // Get the custom uploaded field
                $hero_image_object = get_field('background_image',$post_id);

                // Set the URL of the BG image
                $hero_background_image = $hero_image_object['url'];

                // Add a CSS class just in case
                $hero_data['css_classes'] .= " is-bg-manual";
            }

            // Else, we don't have an image
            else {
                $hero_background_image = "";

                // Add a CSS class just in case
                $hero_data['css_classes'] .= " is-bg-no-image";
            }


            // Get the background color overlay
            $hero_background_color = get_field('hero_background_color',$post_id);

            // Get the paragraphical description
            $hero_description = get_field('hero_description',$post_id);

            // Get the Ninja Forms ID
            $hero_form_id = false; // get_field('ninja_forms_id',$post_id);

            // If we have a title...
            if(strlen($hero_title) > 1) { $hero_data['title'] = $hero_title; }

            // If we have a bg image...
            if(strlen($hero_background_image) > 1) { $hero_data['background_image'] = $hero_background_image; }

            // If we have a bg color...
            if(strlen($hero_background_color) > 1) { $hero_data['background_color'] = $hero_background_color; }

            // If we have a description...
            if(strlen($hero_description) > 1) { $hero_data['description'] = $hero_description; }

            // If we have a form id...
            if($hero_form_id > 1) { $hero_data['form_id'] = $hero_form_id; }

            // Do we have a button?
            if(strlen($button['label']) > 1 && strlen($button['link']) > 1) {

                // Assign the button data to the array
                $hero_data['button_text'] = $button['label'];
                $hero_data['button_link'] = $button['link'];
                $hero_data['button_color'] = $button['color'];

                // Add a CSS class modifier to it too
                $hero_data['css_classes'] .= " is-button";

            }


            self::hero($hero_data);

        }

    }

    /**
     * Outputs the standard hero section for the website
     * @param $args
     */
    public static function hero($args) {

        // Default data
        $default_args = array(
            'background_color'          => 'has-'.prefix().'-primary-900-background-color',
            'title'                     => '',
            'subtitle'                  => '',
            'description'               => '',
            'background_image'          => '',
            'overlapping_image'         => '',
            'form_id'                   => 0,
            'css_classes'               => '',
            'button_text'               => '',
            'button_link'               => '',
            'button_color'              => ''
        );

        // Merge the data points together
        $data = array_merge($default_args,$args);

        ?>

        <div class="wp-block-genesis-blocks-gb-container <?=prefix()?>-hero <?=$data['css_classes']?> <?=(strlen($data['form_id']) >= 1) ? 'is-form' : ''?> alignfull gb-block-container <?=$data['background_color']?>">
            <div class="gb-container-inside">

                <?php if(strlen($data['background_image']) > 1) { ?>
                    <div class="gb-container-image-wrap">
                        <img class="gb-container-image has-background-dim-20 has-background-dim" src="<?=$data['background_image']?>" alt="">
                    </div>
                <?php } ?>
                <div class="gb-container-content">
                    <div class="wp-block-columns">
                        <div class="wp-block-column" style="flex-basis:<?=($data['form_id'] >= 1) ? "50%" : "100%"?>">

                            <?php if(strlen($data['subtitle']) > 1) { ?>
                                <p class="h2 is-topper is-small has-gray-gray-1-color has-text-color"><?=$data['subtitle']?></p>
                            <?php } ?>

                            <?php if(strlen($data['title']) > 1) { ?>
                                <h1 class="has-gray-gray-1-color has-topper has-text-color"><?=$data['title']?></h1>
                            <?php } ?>

                            <?php if(strlen($data['description']) > 1) { ?>
                                <p class="has-gray-gray-1-color has-text-color"><?=$data['description']?></p>
                            <?php } ?>
                        </div>

                        <?php if($data['form_id'] >= 1) { ?>
                            <div class="wp-block-column" style="flex-basis:50%">
                                <div class="ccc-simple-hero__form">
                                    <?=do_shortcode('[ninja_form id='.$data['form_id'].']')?>
                                </div>
                            </div>
                        <?php } elseif(strlen($data['overlapping_image']) > 1) { ?>
                            <div class="wp-block-column ccc-overlapping-image" style="flex-basis:50%">
                                <img src="<?=$data['overlapping_image']?>" class="ccc-overlap-image" alt="">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php }




    /**
     * Echoes out a navigation menu
     * @param string $menu - slug for the menu
     * @param string $logo - Either SVG or an IMG tag
     */
    public static function grid_navigation_bar($menu,$logo) {

        // Main menu items
        $menu_items = get_menu_items($menu);

        // Get the current URL
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        ?>
        <nav class="<?=prefix()?>-navigation" id="nav" data-nav-bar="top">

						<div class="<?=prefix()?>-header-menu-topper group group-flex ">
							<div class="<?=prefix()?>-header-menu-topper-inner alignwide">

								<?php if( has_nav_menu( 'header-topper-menu' ) ): ?>

									<nav role="navigation" class="header-menu-topper">
										<ul>
											<?php
												wp_nav_menu(
													array(
														'container'      => '',
														'depth'          => 1,
														'items_wrap'     => '%3$s',
														'theme_location' => 'header-topper-menu',
													)
												);
											?>
										</ul>
									</nav>

								<?php endif; ?>

							</div>
						</div>

            <div class="group group-flex alignwide">

								<div class="c c-xs-2 <?=prefix()?>-mobile-menu-toggle" data-toggle="<?=prefix()?>-active" data-target=".<?=prefix()?>-navigation">
										<i class="fal fa-regular fa-bars"></i>
								</div>

                <div class="c c-3 c-xs-8 <?=prefix()?>-navigation__logo">
                    <a href="/"><?=$logo?></a>
                </div>

                <div class="c c-9 c-xs-12 <?=prefix()?>-navigation__menus-wrapper">
                    <?php if(is_array($menu_items) && !empty($menu_items)) { ?>
                        <ul class="<?=prefix()?>-navigation__menu">
                            <?php foreach($menu_items as $menu_item) {
																$is_tel = strpos($menu_item->url, 'tel:') === 0;
																?>

                                <li class="<?=prefix()?>-navigation-menu__item <?=($current_url === $menu_item->url) ? 'current' : ''?> <?=(!empty($menu_item->submenu)) ? prefix().'-navigation-menu__item--submenu' : ''?> <?php if( $is_tel ) echo prefix().'--has-tel'; ?>" <?=(!empty($menu_item->submenu)) ? 'data-submenu-selector=".'.prefix().'-navigation__sub-menu" data-submenu-class-toggle="'.prefix().'-active"' : ''?>>

																<?php if( $is_tel ) { ?>
																	<a href="<?=$menu_item->url?>" class="<?=prefix()?>-navigation-menu__link <?=prefix()?>--tel <?=implode(' ', $menu_item->classes)?>" target="<?=$menu_item->target?>" title="<?=$menu_item->title?>"><i class="fa fa-phone"></i></a>
																<?php	} else { ?>
																	<a href="<?=$menu_item->url?>" class="<?=prefix()?>-navigation-menu__link <?=implode(' ', $menu_item->classes)?>" target="<?=$menu_item->target?>" title="<?=$menu_item->attr_title?>"><?=$menu_item->title?></a>
																	<i class="<?=prefix()?>-sub-icon fal fa-angle-down" tabindex="-1" role="button" aria-hidden="true"></i>
																<?php } ?>

                                    <?php if(!empty($menu_item->submenu)) { ?>

                                        <ul class="<?=prefix()?>-navigation__sub-menu">
                                            <?php foreach($menu_item->submenu as $submenu_item) { ?>
                                            <li class="<?=prefix()?>-navigation-submenu__item">
                                                <a href="<?=$submenu_item->url?>" class="<?=prefix()?>-navigation-submenu__link <?=implode(' ', $submenu_item->classes)?>" target="<?=$submenu_item->target?>" title="<?=$submenu_item->attr_title?>"><?=$submenu_item->title?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>

                                    <?php } ?>

                                </li>

                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
    <?php }


    /**
     * Returns the HTML of a button
     * @param string $label - button label
     * @param string $url - link for button
     * @param array $features - array of extra data
     *
     * @return string - STRING of button or "" if nothing
     */
    public static function button($label,$url,$features = array()) {

        // Make sure we have a URL and Label
        if(strlen($label) > 1 && strlen($url) > 1) {

            // Button CSS clas prefix
            $prefix = prefix().'-button';

            // CSS classes for the button container
            $css_button_container = array();


            // CSS classes
            $css_classes[] = $prefix;

            // Do we have a color?
            if(isset($features['color'])) {

                // If it's an OUTLINE button
                if($features['style'] === "is-style-outline") {
                    $css_classes[] = "has-".$features['color']."-color has-text-color";
                }

                // Otherwise, it's a fill
                else {
                    $css_classes[] = "has-".$features['color']."-background-color has-background-color";
                    $css_classes[] = "has-".$features['color']."-opposite-color has-text-color";
                }

            }

            // Do we have a size?
            if(isset($features['size'])) {
                $css_classes[] = $prefix.'--'.$features['size'];
            }

            // Do we have a block?
            if(isset($features['display_block'])) {
                $css_classes[] = $prefix.'--block';
            }

            // Set the target
            if(isset($features['new_window']) && $features['new_window'] === true) {
                $target = 'target="_blank"';
            } else {
                $target = "";
            }

            // Do we have a style set?
            if(isset($features['style'])) {

                // Add in the style as a CSS class
                $css_button_container[] = $features['style'];

            }

            ob_start();

            ?>

            <div class="wp-block-button <?=implode(' ',$css_button_container)?>">
                <a class="wp-block-button__link <?=implode(' ',$css_classes)?>"
                   href="<?= $url ?>"
                    <?=$target?>><?= $label ?></a>
            </div>


            <?php
            $button_html = ob_get_contents();
            ob_end_clean();

            return $button_html;

        } else {
            return "";
        }

    }


    /**
     * Gets an image URL with a default of the Featured Image
     * @param array $acf_image - ACF image object
     * @param int $post_id - Post ID
     * @param array $sizes - a list of sizes to loop through
     *
     * @return string|bool - STRING for the URL or FALSE if nothing
     */
    public static function get_image_url($acf_image,$post_id,$sizes=array('medium')) {

        // Flag to just get the Featured Image
        $get_the_featured_image = false;

        // Do we have an image at all?
        if(isset($acf_image['sizes'])) {

            // What size do we want?
            foreach($sizes as $size) {

                // Do we have the size?
                if(isset($acf_image['sizes'][$size]) && strlen($acf_image['sizes'][$size]) > 1) {

                    // Return back the URL for that size
                    return $acf_image['sizes'][$size];

                }

            }

        }

        // We don't have data from an ACF image at all

        // Get the Featured Image Attachment ID
        $featured_image_id = get_post_thumbnail_id($post_id);


        // What size do we want?
        foreach($sizes as $size) {

            // Get the Featured Image source
            $featured_image_url = wp_get_attachment_image_src( $featured_image_id , $size );



            // Do we have an image this size?
            if(isset($featured_image_url[0]) && strlen($featured_image_url[0]) > 1) {
                return $featured_image_url[0];
            }

        }

        // We have zero images at all
        return false;

    }



    public static function html_icon_links() {

        // Get all the icon links
        $icon_links = get_field('icon_links','options');

        // Do we have any?
        if(is_array($icon_links) && !empty($icon_links)) { ?>

            <ul class="<?=prefix()?>-icons">
                <?php foreach($icon_links as $icon_link) { ?>
                    <li class="<?=prefix()?>-icons__item">
                        <a href="<?=$icon_link['link']?>" <?=($icon_link['new_window'] === true) ? 'target="_blank"' : ''?>><?=$icon_link['icon']?></a>
                    </li>
                <?php } ?>
            </ul>

        <?php }

    }



		public static function html_acf_link( $link, $css_classes = '', $echo = true) {

			if( ! key_exists( 'url', $link ) || ! key_exists( 'title', $link ) ) {
				return false;
			}

			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';

			$link_html = '<a class="'.$css_classes.'" href="'.esc_url( $link_url ).'" target="'.esc_attr( $link_target ).'">'.esc_html( $link_title ).'</a>';

			if( $echo ) {
				echo $link_html;
				return;
			} else {
				return $link_html;
			}
		}






}
