<?php

function prefix() {
	return "repay";
}


add_theme_support( 'post-thumbnails' );


/**
 * Get array of menu items
 */
function get_menu_items($menu_slug) {

    // Final output array
    $menu_items_organized = array();

    // Parent menu items counter
    $parent_counter = 0;

    // Get our nav locations (set in our theme, usually functions.php)
    $menu_locations = get_nav_menu_locations();

    // Get the *primary* menu ID
    if(isset($menu_locations[ $menu_slug ])) {
        $menu_id = $menu_locations[$menu_slug];

        // Get the array of wp objects, the nav items for our queried location.
        $menu_items = wp_get_nav_menu_items($menu_id);

        // Make sure we have menu items
        if (is_array($menu_items) && !empty($menu_items)) {

            // Let's organize this into a menu / sub-menu array
            foreach ($menu_items as $menu_item_post) {

                // Does this item have a parent?
                if (is_numeric($menu_item_post->menu_item_parent) && $menu_item_post->menu_item_parent > 0) {

                    // Set the parent ID
                    $parent_id = $menu_item_post->menu_item_parent;

                    // Loop through all the current posts in the menu
                    foreach ($menu_items_organized as $count => $single_menu) {

                        // Is this the correct parent?
                        if ($single_menu->ID == $parent_id) {

                            // Add it to the submenu array
                            $menu_items_organized[$count]->submenu[] = $menu_item_post;
                        }

                    }


                } // This is a high-level menu item, add it to the array
                else {

                    // Initialize the menu object
                    $menu_items_organized[$parent_counter] = new stdClass();

                    // Create the object
                    foreach ($menu_item_post as $key => $value) {
                        $menu_items_organized[$parent_counter]->$key = $value;
                    }

                    // Tack on the submenu
                    $menu_items_organized[$parent_counter]->submenu = array();

                    // Increase the parent counter
                    $parent_counter++;

                }


            }

        }

    }


    return $menu_items_organized;


}
