<?php

// Enqueue Ion parent theme CSS file

add_action( 'wp_enqueue_scripts', 'appp_ion_enqueue_styles' );
function appp_ion_enqueue_styles() {

	// parent theme css
	$version = AppPresser_Ion_Theme_Setup::VERSION . '.' . filemtime( get_template_directory() . '/style.css' );
    wp_enqueue_style( 'ion-style', get_template_directory_uri().'/style.css', null, $version );

    // child theme css
		wp_enqueue_style( 'appderma-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,700', false );
		}
    wp_enqueue_style( 'ion-child-style', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css' ) );
		wp_enqueue_style( 'material-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css' );
}
