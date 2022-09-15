<?php
//hook into the init action and call create_book_taxonomies when it fires

add_action( 'init', 'ccc_team_tax_departments', 0 );

//create a custom taxonomy name it departments for your posts

function ccc_team_tax_departments() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

    $labels = array(
        'name' => _x( 'Departments', 'taxonomy general name' ),
        'singular_name' => _x( 'Department', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Departments' ),
        'all_items' => __( 'All Departments' ),
        'parent_item' => __( 'Parent Department' ),
        'parent_item_colon' => __( 'Parent Department:' ),
        'edit_item' => __( 'Edit Department' ),
        'update_item' => __( 'Update Department' ),
        'add_new_item' => __( 'Add New Department' ),
        'new_item_name' => __( 'New Department Name' ),
        'menu_name' => __( 'Departments' ),
    );

// Now register the taxonomy
    register_taxonomy('department',array('people'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'department' ),
    ));

}