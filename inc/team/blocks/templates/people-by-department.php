<?php include(get_theme_file_path().'/inc/team/blocks/settings.php'); ?>

<?php
$department_and_people = TeamDepartment::get_all();

// Hide Department Headers
$hide_department_headers = get_field('hide_department_headers');

?>


<?php

// Make sure we have departments and people
if(is_array($department_and_people) && !empty($department_and_people)) {

    echo '<div class="'.prefix().'-people">';

    // Add the containing Group if we don't have headers
    if($hide_department_headers === true) {
        echo '<div class="group group-flex">';
    }

    // Loop through each DEPARTMENT
    foreach($department_and_people as $department) {

        // Do we have people in this Department?
        if(is_array($department->people) && !empty($department->people)) { ?>


            <?php

            // If we toggled the headers off...
            if($hide_department_headers !== true) { ?>
                <h2><?=$department->name?></h2>

                <div class="group">
            <?php } ?>

                <?php foreach($department->people as $person) { ?>

                    <div class="c c-4">
                        <?php TeamCore::person_pod($person); ?>
                    </div>

                <?php } ?>


            <?php

            // If we toggled the headers off...
            if($hide_department_headers !== true) { ?>
            </div>
            <?php } ?>


    <?php }

    }

    // Add the containing Group if we don't have headers
    if($hide_department_headers === true) {
        echo '</div>';
    }


    echo '</div>';

}

?>