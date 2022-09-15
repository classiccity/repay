<?php

/**
 * 1. Testimonial CPT Initialization
 * 2. Changes "Post Title" Placeholder Text
 */

$singular = "Testimonial";
$plural = "Testimonials";
$singular_lower = strtolower($singular);
$plural_lower = strtolower($plural);

// Set UI labels for Custom Post Type
$labels = array(
    'name'                => _x( $plural, 'Post Type General Name', prefix() ),
    'singular_name'       => _x( $singular, 'Post Type Singular Name', prefix() ),
    'menu_name'           => __( $plural, prefix() ),
    'parent_item_colon'   => __( 'Parent '.$singular, prefix() ),
    'all_items'           => __( 'All '.$plural, prefix() ),
    'view_item'           => __( 'View '.$singular, prefix() ),
    'add_new_item'        => __( 'Add New '.$singular, prefix() ),
    'add_new'             => __( 'Add New', prefix() ),
    'edit_item'           => __( 'Edit '.$singular, prefix() ),
    'update_item'         => __( 'Update '.$singular, prefix() ),
    'search_items'        => __( 'Search '.$singular, prefix() ),
    'not_found'           => __( 'Not Found', prefix() ),
    'not_found_in_trash'  => __( 'Not found in Trash', prefix() ),
);

// Set other options for Custom Post Type

$args = array(
    'label'               => __( $plural_lower, prefix() ),
    'description'         => __( $plural, prefix() ),
    'labels'              => $labels,
    // Features this CPT supports in Post Editor
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
    'show_in_rest'        => true,
    // You can associate this CPT with a taxonomy or custom taxonomy.
    //'taxonomies'          => array( 'department' ),
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
    'menu_icon'           => 'dashicons-editor-quote',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
);

// Registering your Custom Post Type
register_post_type( $plural_lower, $args );


// Change to Post Title placeholder
add_filter( 'enter_title_here', 'testimonial_post_title_text' );
function testimonial_post_title_text( $input ) {
    if ( 'testimonials' === get_post_type() ) {
        return __( 'First Name + Last Name', prefix() );
    }

    return $input;
}