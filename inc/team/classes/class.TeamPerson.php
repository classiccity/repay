<?php
Class TeamPerson {

    public $id;
    public $name;
    public $job_title;
    public $tiny_bio;
    public $bio;
    public $photos;
    public $department;
    public $link;

    /**
     * TeamPerson constructor.
     * @param int|WP_Post $post
     */
    public function __construct($post) {

        // If $post is an object...
        if(isset($post->ID)) {

            // Set the ID based on the object
            $this->id = $post->ID;

            // Set the title too
            $this->name = $post->post_title;

        }
        else {

            // It's just an integer
            $this->id = $post;

            // Grab the title
            $this->name = get_the_title($this->id);

        }

        // Grab the Job Title
        $this->job_title = get_field('job_title',$this->id);

        // Grab the Tiny Bio
        $this->tiny_bio = get_field('tiny_bio',$this->id);

        // Get the full bio
        $this->bio = get_the_content(null,false,$this->id);

        // Grab the two photos
        $this->photos = array(
            'primary'           => get_the_post_thumbnail_url($this->id),
            'transparent'       => get_field('transparent_headshot',$this->id)
        );

        // Get the permalink for this person
        $this->link = get_permalink($this->id);

        // Get the Department
        $departments = get_the_terms($this->id,'department');

        // Do we have a Department?
        if(isset($departments[0]->term_id)) {
            $this->department = new TeamDepartment($departments[0]);
        }
    }

}