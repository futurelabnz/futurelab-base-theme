<?php

namespace FutureLab;

class FutureLab {

    protected $_config; 

    public function __construct(){

        $this->load_styles();
        $this->load_javascript();

    }

    public function load_styles(){
        $suffix = $config['environment'] == 'production' ? '.min' : '';

        foreach($this->config['elements'] as $k=>&$value){
            //load element
            include ($value['style_path']);
        }
    }

    public function load_javascript(){

    }

    public function get_element_html( $element ) {
        include ( $config['elements'][$element]['view_template'] );
    }

    public function get_element( char $element ){
        return $_config['elements'][$element];
    }
    
    
    protected function load_config(){
        //include config file
        $this->_config = include_once('./config.php');
    }



}


$config['environment'] = 'production';

#(in fuctions include this file)
$futurelab = new FutureLab();

// /inc/futurelab/templates/menu.php

$futurelab->get_element_html('menu');