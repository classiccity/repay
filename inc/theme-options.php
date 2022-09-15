<?php

add_action('acf/init', 'core_template_options_pages');
function core_template_options_pages()
{
// Add the options page
    if (function_exists('acf_add_options_page')) {

        $page = acf_add_options_sub_page(array(
            'page_title' => __(strtoupper(prefix()) . ' Theme Options', prefix() . '-theme-options'),
            'menu_title' => __(strtoupper(prefix()) . ' Theme Options', prefix() . '-theme-options'),
            'menu_slug' => prefix().'-theme-options',
            'capability' => 'edit_posts',
            'redirect' => false,
            'parent_slug' => 'options-general.php'
        ));

    }
}