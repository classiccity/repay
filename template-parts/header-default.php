<?php
// All the posts/pages that we don't want a hero section
if(is_author() || is_singular('post')) {
    // Do nothing...
}

// Get the homepage hero section
elseif(is_home()) {

    // Get the ID for the Home Page (ie. blog posts)
    $home_page_id = get_option('page_for_posts');
    new HeroSection($home_page_id);

}

// Is this a post archive page?
elseif(is_archive()) {

    $hero = new HeroSection();

    $hero->style = "simple";
    $hero->color = "light";
    $hero->meta['hero_background_color'] = "primary-light";
    $hero->title = single_term_title("",false);

    $hero->add_basic_css_classes();

    $hero->html_simple();

}

// Default is just throwing the Post object in there
else {
    new HeroSection($post);
}