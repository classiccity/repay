<?php

    add_action( 'wp_enqueue_scripts', 'ccc_enqueue', 99 );
    function ccc_enqueue() {
	    wp_enqueue_style( prefix().'-web', get_template_directory_uri().'/css/web.css', false, filemtime( get_template_directory() . '/css/web.css' ) );
	    //wp_enqueue_script( 'ccc-common', get_template_directory_uri().'/src/js/common.js', array('jquery'),false,false );

	    wp_enqueue_script( prefix().'-fontawesome', 'https://kit.fontawesome.com/a01141edf2.js', array() );
	    wp_enqueue_script( prefix().'-main', get_template_directory_uri().'/js/main.js', array('jquery'), filemtime( get_template_directory() . '/js/main.js' ), true );
			// wp_enqueue_script( prefix().'-svg-animation', get_template_directory_uri().'/js/svg-animation.js', array('jquery'), filemtime( get_template_directory() . '/js/svg-animation.js' ), true );

			wp_enqueue_script( 'swiper-bundle-script', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js' );
			wp_enqueue_style( 'swiper-bundle-style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');
    }

    // Remove Atomic Blocks Font Awesome
    add_action( 'wp_enqueue_scripts', 'remove_atomic_block_fontawesome', 100 );

    function remove_atomic_block_fontawesome(){
        wp_dequeue_style( 'atomic-blocks-fontawesome' );
    }

    // Add in our styles to Gutenberg
    add_action( 'after_setup_theme', 'add_custom_theme_styles_to_gutenberg' );

    function add_custom_theme_styles_to_gutenberg(){

        add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
        add_editor_style( get_template_directory_uri().'/css/web.css' ); // tries to include style-editor.css directly from your theme folder

    }


		function custom_font_header_tags() {
			echo '
			<!-- Google Fonts -->
			<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
		';
		}
		add_action('admin_head', 'custom_font_header_tags');

?>