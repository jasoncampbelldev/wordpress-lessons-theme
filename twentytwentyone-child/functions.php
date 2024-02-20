<?php


function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style';
	$theme        = wp_get_theme();
    wp_enqueue_style( 'bootstrap-cdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap-cdn-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function lesson_theme_enqueue_styles2(){
  	wp_enqueue_style( 'parent-style', get_template_directory_uri().'-child/style.css' );
}
add_action( 'wp_enqueue_scripts', 'lesson_theme_enqueue_styles2', 99 );