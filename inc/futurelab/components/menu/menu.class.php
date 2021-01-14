<?php

namespace FutureLab;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Menu extends FutureLabCore {

    public function __construct(){
        parent::__construct();

        $this->install_bootstrap_wp_walker();
    }

    public function install_bootstrap_wp_walker(){
        if( !file_exists( get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php' ) ) {
            return new \WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'FL Error: You most likely forgot to do composer install. Missing WP Bootstrap Walker library.', 'wp-bootstrap-navwalker' ) );
        }
        
        require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
    } 

}