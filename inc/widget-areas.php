<?php
function ccc_widget_areas() {

    register_sidebar( array(
        'name'          => 'Footer Left',
        'id'            => 'footer-left',
        'before_widget' => '<div class="'.prefix().'-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="'.prefix().'-widget__title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Right ',
        'id'            => 'footer-right',
        'before_widget' => '<div class="'.prefix().'-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="'.prefix().'-widget__title">',
        'after_title'   => '</h2>',
    ) );

    // register_sidebar( array(
    //     'name'          => 'Footer 3',
    //     'id'            => 'footer-3',
    //     'before_widget' => '<div class="'.prefix().'-widget">',
    //     'after_widget'  => '</div>',
    //     'before_title'  => '<h2 class="'.prefix().'-widget__title">',
    //     'after_title'   => '</h2>',
    // ) );

}
add_action( 'widgets_init', 'ccc_widget_areas' );