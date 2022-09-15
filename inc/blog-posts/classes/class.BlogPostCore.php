<?php

Class BlogPostCore {

    /**
     * Outputs HTML for the Blog Post Pod
     * @param WP_Post $post
     */
    public static function pod($post) {

        // Get the main category for the post
        $category = self::get_post_main_category($post->ID);

        // Prefix for CSS
        $prefix = prefix().'-post-pod';

        // Get the link
        $link = get_permalink($post);

        ?>


        <a href="<?=$link?>" class="<?=$prefix?>">
            <div class="<?=$prefix?>__image">
                <img src="https://plan-gap.local/wp-content/uploads/2021/09/51820556_m-2.jpg" alt="">
            </div>
            <div class="<?=$prefix?>__content">
                <h3 class="<?=$prefix?>__title"><?=$post->post_title?></h3>
                <p class="<?=$prefix?>__excerpt"><?=get_the_excerpt($post)?></p>
            </div>
        </a>

    <?php }





    /**
     * Pulls the post's primary category
     * @param int $post_id - Post ID
     * @return array|object|WP_Error|WP_Term|null - WP_Term object
     */
    public static function get_post_main_category($post_id) {

        $category = get_the_category($post_id);

        // Get primary (Yoast) term if it is set
        $category_display = '';
        $category_slug = '';

        if ( class_exists('WPSEO_Primary_Term') ) {

            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
            $wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post_id );

            // Get the term
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

            // Pull the term object
            $term = get_term( $wpseo_primary_term );

            // If there is an error from the Yoast term
            if ( is_wp_error( $term ) ) {

                return $category[0];

            }

            // Else, no error from Yoast
            else {

                // Check if category has parent
                $category_id = $term->term_id;
                $category_term = get_category($category_id);

                return $category_term;

            }
        } else {

            return $category[0];

        }
    }

}