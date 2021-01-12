<?php
/**
 * Proper way to enqueue scripts and styles
 */
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'fl-body-style', __DIR__.'/components/body/body.scss' );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
