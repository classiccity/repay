<?php include(get_theme_file_path().'/inc/testimonials/blocks/settings.php'); ?>

<?php

// Get all fields
$fields = get_fields();

// Set the prefix
$prefix = prefix().'-testimonials';

// Append to all_classes
$all_classes = $prefix . ' ' . $all_classes;

// Make sure we have testimonials
if(isset($fields['testimonials']) && is_array($fields['testimonials']) && !empty($fields['testimonials'])) { ?>

    <div class="<?=$all_classes?>">
        <div class="group">
            <?php foreach($fields['testimonials'] as $testimonial) { ?>

            <div class="c c-4">
                <?php
                $new_testimonial = new Testimonial($testimonial);
                $new_testimonial->html_pod();
                ?>
            </div>

            <?php } ?>
        </div>

    </div>

<?php } ?>
