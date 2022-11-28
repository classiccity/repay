<?php

// THE BLOCKS
add_action('acf/init', 'tesitmonial_custom_acf_blocks');
function tesitmonial_custom_acf_blocks() {
    if( function_exists('acf_register_block') ) {


        acf_register_block_type(array(
            'name'              => 'testimonials',
            'title'             => 'Testimonials',
            'description'       => 'Select multiple testimonials that you would like to display',
            'render_template'   => 'inc/testimonials/blocks/templates/testimonials.php',
            'category'          => prefix().'-testimonials',
            'icon'              => '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="quote-right" class="svg-inline--fa fa-quote-right fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M176 32H48A48 48 0 0 0 0 80v128a48 48 0 0 0 48 48h80v64a64.06 64.06 0 0 1-64 64h-8a23.94 23.94 0 0 0-24 23.88V456a23.94 23.94 0 0 0 23.88 24H64a160 160 0 0 0 160-160V80a48 48 0 0 0-48-48z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M464 32H336a48 48 0 0 0-48 48v128a48 48 0 0 0 48 48h80v64a64.06 64.06 0 0 1-64 64h-8a23.94 23.94 0 0 0-24 23.88V456a23.94 23.94 0 0 0 23.88 24H352a160 160 0 0 0 160-160V80a48 48 0 0 0-48-48z"></path></g></svg>',
            'keywords'          => array( 'quote', 'repay', 'company' ),
        ));







    }
}
