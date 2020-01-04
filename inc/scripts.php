<?php
/**
 * Enqueue scripts and styles.
 */


function bellaworks_scripts() {
	$minifiedStyle = get_template_directory_uri() . '/style.min.css';
	//wp_enqueue_style( 'bellaworks-style', $minifiedStyle );
	wp_enqueue_style( 'bellaworks-style', get_stylesheet_uri() );
	

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', false);	

	wp_enqueue_script( 
			'bellaworks-blocks', 
			get_template_directory_uri() . '/assets/js/vendors.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'bellaworks-custom', 
			get_template_directory_uri() . '/assets/js/custom.js', 
			array(), '20120206', 
			true 
		);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bellaworks_scripts' );