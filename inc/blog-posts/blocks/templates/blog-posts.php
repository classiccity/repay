<?php include(get_theme_file_path().'/inc/blog-posts/blocks/settings.php'); ?>

<?php

// Set the prefix
$prefix = prefix().'-posts';

// Add prefix to all classes
$all_classes = $prefix . " " . $all_classes;

// How should we pull posts?
$how_to_pull_posts = get_field('how_to_pull_posts'); // category or manual

// If the post-pull is Category-based...
if($how_to_pull_posts === 'category') {

    // How many posts to pull
    $how_many_posts = get_field('how_many_posts');

    // What category object should we pull?
    $which_category = get_field('which_category');

    // Args to get posts within the category
    $args = array(
        'posts_per_page' => $how_many_posts,
        'category' => $which_category->term_id
    );

    // Get posts
    $all_posts = get_posts($args);

}

// Else, it's a manual pull
else {

    // Pull the manual list of posts
    $select_the_posts_to_display = get_field('select_the_posts_to_display');

    // Assign the array of Post Objects to our $all_posts variables
    $all_posts = $select_the_posts_to_display;

}



// Get the color selection
$color = get_field('color');

// Add the color to the class list
$all_classes .= " is-".$color;

// Get the column count
$column_count = get_field('column_count');

// Make sure we HAVE a column count...
if($column_count < 1) {
    $column_count = 4;
}


?>

<div class="<?=$all_classes?>">

    <div class="row">

        <?php

        // Make sure we have Blog Posts to show...
        if(is_array($all_posts) && !empty($all_posts)) {

            // Loop through each Post
            foreach($all_posts as $single_post) { ?>

                <div class="<?=$prefix?>__col col-12 col-md-6 col-lg-<?=$column_count?>">
                    <?php BlogPostCore::pod($single_post); ?>
                </div>

            <?php }

        }

        ?>

    </div>

</div>
