<?php
/**
 * Proper way to enqueue scripts and styles
 */
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'fl-body-style', get_template_directory_uri().'/inc/futurelab/components/body/body.css' );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
