<?php

Class TeamDepartment {

    public $id;
    public $name;
    public $link;
    public $description;
    public $order;
    public $image;
    public $icon;
    public $people;


    /**
     * TeamDepartment constructor.
     * @param WP_Term|int $term
     */
    public function __construct($term) {

        // If we only have an ID
        if(is_numeric($term)) {

            // Set the term object
            $term = get_term($term);

        }

        // Set the ID
        $this->id = $term->term_id;


        // Name of the department
        $this->name = $term->name;

        // Get the permalink for the department
        $this->link = get_term_link($this->id);

        // Get the description
        $this->description = $term->description;

        // Get the Order
        $this->order = get_field('order',$term->taxonomy."_".$this->id);

        // Get the image
        $this->image = get_field('image',$term->taxonomy."_".$this->id);

        // Get the icon
        $this->icon = get_field('icon',$term->taxonomy."_".$this->id);

    }


    /**
     * Adds an array of TeamPerson objects for people in this department
     */
    public function get_people() {

        // Setup post arguments to get people within the department
        $args = array(
            'post_type'                 => 'people',
            'numberposts'               => -1,
            'tax_query'                 => array(
                array(
                    'taxonomy' => 'department',
                    'field' => 'term_id',
                    'terms' => $this->id,
                    'include_children' => false
                )
            )
        );

        // Get all the people
        $people = get_posts($args);

        // Do we have any people in this department?
        if(is_array($people) && !empty($people)) {

            // Loop through each person
            foreach($people as $person) {

                // Initialize a new Person class
                $the_person = new TeamPerson($person->ID);

                // Add the object to the array of people
                $this->people[] = $the_person;

            }
        }

    }

    /**
     * Get all Departments with the people attached to it
     * @return array|false
     */
    public static function get_all() {

        // Get all Departments from the system
        $departments = get_terms( array(
            'taxonomy'      => 'department',
            'hide_empty'    => true,
            'orderby'       => 'meta_value',
            'meta_key'      => 'order'
        ) );

        // If we have any departments...
        if(is_array($departments) && !empty($departments)) {

            // Actual Department objects
            $department_objects = array();

            // Loop through each Department so we can create Department objects
            foreach($departments as $department) {

                // Get the department
                $the_department = new TeamDepartment($department);

                // Get the people in the deparment
                $the_department->get_people();

                $department_objects[] = $the_department;
            }

            return $department_objects;
        }

        // Return false because we don't have Departments
        return false;

    }
}