<?php


/**
 * Change the post template if it's a Podcast post
 */

add_filter( 'template_include', 'ccc_podcast_single_template', 99 );
function ccc_podcast_single_template( $template ) {
    if ( in_category( CCC_PODCAST_CATEGORY_SLUG )  ) {
        return get_theme_file_path().'/inc/podcast/templates/single-post-podcast.php';
    }
    return $template;
}