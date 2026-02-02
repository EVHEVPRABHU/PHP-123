<?php
add_action( 'wp_enqueue_scripts', 'technex_child_theme_styles',3);
function technex_child_theme_styles() {
		
    wp_enqueue_style('technex-parent-style', get_template_directory_uri(). '/style.css', array('bootstrap'));
    wp_enqueue_style('technex-child-style', get_stylesheet_uri(), array( 'technex-parent-style') );
}





