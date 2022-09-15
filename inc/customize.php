<?php
// Customizer settings
function additional_customizer_settings( $wp_customize ) {
    $wp_customize->add_setting(
        prefix().'_logo',
        array(
            'default' => '',
            'type' => 'option',
            'capability' => 'edit_theme_options'
        ),
    );

    $wp_customize->add_setting( prefix().'_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'forwardtogether_logo', array(
      'label'    => __('Logo'),
      'section'  => 'title_tagline',
      'settings' => prefix().'_logo',
    )));
}
add_action( 'customize_register', 'additional_customizer_settings' );