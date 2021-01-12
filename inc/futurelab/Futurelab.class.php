<?php

namespace FutureLab;

class FutureLab {

    protected $_config; 

    public function __construct(){
        $this->load_config();
        add_action( 'wp_enqueue_scripts', [$this, 'load_styles'] );
        // $this->load_javascript();

    }

    public function load_styles(){
        $suffix = $this->_config['environment'] == 'production' ? '.min' : '';

        wp_enqueue_style( 'fl-body-style', get_template_directory_uri().'/inc/futurelab/components/body/body.css' );
    }

    public function load_javascript(){

    }

    public function get_element_html( $element ) {
        include ( $this->_config['elements'][$element]['view_template'] );
    }

    public function get_element( char $element ){
        return $_config['elements'][$element];
    }
    
    
    protected function load_config(){
        //include config file
        $this->_config = include_once(__DIR__.'/config.php');
    }


}


$config['environment'] = 'production';

#(in fuctions include this file)
$futurelab = new FutureLab();

// /inc/futurelab/templates/menu.php

$futurelab->get_element_html('body');
$futurelab->get_element_html('header');
$futurelab->get_element_html('footer');