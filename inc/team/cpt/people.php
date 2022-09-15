<?php
$singular = "Person";
$plural = "People";
$singular_lower = strtolower($singular);
$plural_lower = strtolower($plural);

// Set UI labels for Custom Post Type
$labels = array(
    'name'                => _x( $plural, 'Post Type General Name', 'twentythirteen' ),
    'singular_name'       => _x( $singular, 'Post Type Singular Name', 'twentythirteen' ),
    'menu_name'           => __( $plural, 'twentythirteen' ),
    'parent_item_colon'   => __( 'Parent '.$singular, 'twentythirteen' ),
    'all_items'           => __( 'All '.$plural, 'twentythirteen' ),
    'view_item'           => __( 'View '.$singular, 'twentythirteen' ),
    'add_new_item'        => __( 'Add New '.$singular, 'twentythirteen' ),
    'add_new'             => __( 'Add New', 'twentythirteen' ),
    'edit_item'           => __( 'Edit '.$singular, 'twentythirteen' ),
    'update_item'         => __( 'Update '.$singular, 'twentythirteen' ),
    'search_items'        => __( 'Search '.$singular, 'twentythirteen' ),
    'not_found'           => __( 'Not Found', 'twentythirteen' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
);

// Set other options for Custom Post Type

$args = array(
    'label'               => __( $plural_lower, 'twentythirteen' ),
    'description'         => __( $plural, 'twentythirteen' ),
    'labels'              => $labels,
    // Features this CPT supports in Post Editor
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
    'show_in_rest'        => true,
    // You can associate this CPT with a taxonomy or custom taxonomy.
    'taxonomies'          => array( 'department' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    //'show_in_menu'        => self::$menu_location,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-networking',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
);

// Registering your Custom Post Type
register_post_type( $plural_lower, $args );