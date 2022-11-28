<?php get_header(); ?>

<?php
global $post;

// Get all fields
$fields = get_fields();

// Setup the core prefix
$prefix = 'ypm-podcast';

// Site-specific prefix
$site_prefix = "";

// Do we have a Prefix defined at the theme level?
if(function_exists('prefix')) {
    $site_prefix = prefix().'-podcast';
}

$site_prefix = apply_filters('podcast_filter_css_class',$site_prefix,$post->ID);

$small_title = "Episode ".$fields['episode_number'];
$small_title = apply_filters('podcast_filter_small_title',$small_title,$post->ID);

$title = $fields['topic'];
$title = apply_filters('podcast_filter_title',$title,$post->ID);

$show_notes_title = "Show Notes";
$show_notes_title = apply_filters('podcast_filter_show_notes_title',$show_notes_title,$post->ID);

$sponsors_title = "Sponsors";
$sponsors_title = apply_filters('podcast_filter_sponsors_title',$sponsors_title,$post->ID);

$listen_title = "Listen";
$listen_title = apply_filters('podcast_filter_listen_title',$listen_title,$post->ID);

$transcript_title = "Transcript";
$transcript_title = apply_filters('podcast_filter_transcript_title',$transcript_title,$post->ID);

$about_title = "About ".$post->post_title;
$about_title = apply_filters('podcast_filter_about_title',$about_title,$post->ID);

$resources_title = "Resources";
$resources_title = apply_filters('podcast_filter_resources_title',$resources_title,$post->ID);

$resource_icon = '<i class="far fa-external-link"></i> ';
$resource_icon = apply_filters('podcast_filter_resources_icon',$resource_icon,$post->ID);
?>

<div class="is-hero <?=$site_prefix?> <?=$prefix?>__hero <?=$prefix?>__hero--podcast">
    <div class="container">
        <div class="group group-flex">
            <div class="c c-8">
                <h1 class="is-topper is-small"><?=$small_title?></h1>
                <p class="h1 has-topper"><?=$title?></p>
                <?php do_action('podcast_header_below', $post->ID); ?>
            </div>
            <div class="c c-4">
                <div class="<?=$prefix?>__image">
                    <img src="<?=get_the_post_thumbnail_url($post)?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="group">
        <div class="c c-8 <?=$prefix?>__content">

            <section class="<?=$prefix?>__show-notes">
                <h2><?=$show_notes_title?></h2>
                <?php do_action('podcast_shownotes_above', $post->ID); ?>
                <?php the_content(); ?>
                <?php do_action('podcast_shownotes_below', $post->ID); ?>
            </section>

            <?php if(strlen($fields['callout_description']) > 1) { ?>
                <section class="<?=$prefix?>__callout">
                    <div class="group">
                        <div class="c c-3">
                            <img src="<?=$fields['callout_image']['url']?>" alt="">
                        </div>
                        <div class="c c-9">
                            <h2 class="h4"><?=$fields['callout_title']?></h2>
                            <?=$fields['callout_description']?>
                            <a href="<?=$fields['callout_button_link']?>" class="<?=$prefix?>__button"><?=$fields['callout_button_label']?></a>
                        </div>
                    </div>
                </section>
            <?php } ?>

            <?php if(is_array($fields['sponsors']) && !empty($fields['sponsors'])) { ?>
                <section class="<?=$prefix?>__sponsors">
                    <h2><?=$sponsors_title?></h2>

                    <?php do_action('podcast_sponsors_above', $post->ID); ?>

                    <div class="<?=$prefix?>__sponsor-list">
                        <?php foreach($fields['sponsors'] as $sponsor_object) {

                            // Get all Sponsor meta data
                            $sponsor_data = get_fields($sponsor_object->ID);

                            ?>

                            <div class="<?=$prefix?>__sponsor">
                                <p class="<?=$prefix?>__sponsor-name"><?=$sponsor_data['name']?></p>
                                <p class="<?=$prefix?>__sponsor-description"><?=$sponsor_data['description']?></p>
                                <a href="<?=$sponsor_data['url']?>" target="_blank" class="<?=$prefix?>__button <?=$prefix?>__sponsor-button"><?=$sponsor_data['button_text']?></a>
                            </div>

                        <?php } ?>
                    </div>

                    <?php do_action('podcast_sponsors_below', $post->ID); ?>
                </section>
            <?php } ?>

            <?php if(strlen($fields['podcast_embed']) > 1) { ?>
                <section class="<?=$prefix?>__embed">
                    <h2><?=$listen_title?></h2>

                    <?php do_action('podcast_embed_above', $post->ID); ?>

                    <?=$fields['podcast_embed']?>

                    <?php do_action('podcast_embed_below', $post->ID); ?>
                </section>
            <?php } ?>

            <?php if(strlen($fields['transcript']) > 1) { ?>
                <section class="<?=$prefix?>__transcription">
                    <h2><?=$transcript_title?></h2>

                    <?php do_action('podcast_embed_above', $post->ID); ?>

                    <div class="<?=$prefix?>__transcript">
                        <?=$fields['transcript']?>
                    </div>

                    <?php do_action('podcast_embed_below', $post->ID); ?>
                </section>
            <?php } ?>
        </div>

        <div class="c c-4 <?=$prefix?>__sidebar">

            <?php do_action('podcast_sidebar_above', $post->ID); ?>

            <section>
                <h2 class="h4"><?=$about_title?></h2>
                <p><?=$fields['guest_bio']?></p>
            </section>

            <?php do_action('podcast_sidebar_middle', $post->ID); ?>

            <?php // Do we have resources?
            if(is_array($fields['resources']) && !empty($fields['resources'])) { ?>

                <section>
                    <h2 class="h4"><?=$resources_title?></h2>
                    <ul class="<?=$prefix?>__resources">
                        <?php foreach($fields['resources'] as $resource) { ?>
                            <li><?=$resource_icon?><a href="<?=$resource['link']?>" target="_blank"><?=$resource['label']?></a></li>
                        <?php } ?>
                    </ul>
                </section>

            <?php } ?>

            <?php do_action('podcast_sidebar_below', $post->ID); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
