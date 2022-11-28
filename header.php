<?php
    global $post;
    $body_classes = array(prefix(), 'fade-in-onload');

    // CSS classes for <body>
    if(is_single()) $body_classes[] = prefix()."-single";
    if(is_archive()) $body_classes[] = prefix()."-archive";
    if(is_category()) $body_classes[] = prefix()."-category";
    if(is_author()) $body_classes[] = prefix()."-author";
    if(is_page()) $body_classes[] = prefix()."-page";
    if(isset($post->ID)) $body_classes[] = prefix()."-post-".$post->ID;
    if(isset($post->post_name)) $body_classes[] = prefix()."-post-".$post->post_name;

    if(is_front_page()) $body_classes[] = prefix()."-front-page";
    else $body_classes[] = prefix()."-inside-page";

    if(get_theme_mod(prefix().'_logo')) {
        // Select image from Appearance -> Customize ->  Site Identity
        $logo = '<img src="' . get_theme_mod(prefix().'_logo') . '" class="' . prefix() . '-logo">';
    }
    else {
        // Or copy/paste SVG here
        $logo = '';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php wp_title(); ?></title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

				<?php custom_font_header_tags(); ?>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class( $body_classes ); ?>>
    <a href="#nav" class="screen-reader-only">Skip to Navigation</a>
    <a href="#main" class="screen-reader-only">Skip to Main Content</a>
    <a href="#footer" class="screen-reader-only">Skip to Footer</a>
    <?php UI::grid_navigation_bar('header-menu',$logo); ?>

    <?php get_template_part('template-parts/header','default'); ?>