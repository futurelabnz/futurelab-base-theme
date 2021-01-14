<?php

namespace FutureLab;

class FutureLabCore {

    protected $_config;

    public function __construct(){
        $this->load_config();
        add_action( 'wp_enqueue_scripts', [$this, 'load_styles'] );
        // $this->load_javascript();

    }

    // Hopefully can move this to an iterator
    public function load_styles(){
        $suffix = $this->_config['environment'] == 'production' ? '.min' : '';

        foreach($this->_config['elements'] as $element_name=>$element){
            if( isset( $element['styles'] ) && !empty( $element['styles'] ) ){
                if( is_array( $element['styles'] )){
                    foreach( $element['styles'] as $stylesheet){
                        wp_enqueue_style(   'fl-style-'.$stylesheet,
                                            get_template_directory_uri().
                                                DIRECTORY_SEPARATOR.$this->_config['components_path'].
                                                DIRECTORY_SEPARATOR.$element_name.
                                                DIRECTORY_SEPARATOR.$stylesheet,
                                            '',
                                            filemtime( __DIR__.
                                                DIRECTORY_SEPARATOR.$this->_config['components_path'].
                                                DIRECTORY_SEPARATOR.$element_name.
                                                DIRECTORY_SEPARATOR.$stylesheet )

                        );
                    }
                } else {
                    wp_enqueue_style( 'fl-style-'.$k, get_template_directory_uri().'components/header/header.css' );
                }
            }
        }

        wp_enqueue_style( 'fl-bootstrap-css', get_template_directory_uri().'/vendor/bootstrap/css/bootstrap.min.css' );
        wp_enqueue_style( 'fl-top-menu-style', get_template_directory_uri().'/inc/futurelab/components/top_desktop_menu/top_desktop_menu.css' );
        wp_enqueue_style( 'fl-footer-style', get_template_directory_uri().'/inc/futurelab/components/footer/footer.css' );
        wp_enqueue_style( 'fl-base-style', get_template_directory_uri().'/build/bundle.css' );
    }

    public function load_javascript(){

    }

    public function get_element_content( $element ) {
        if( ! $this->validate_element( $element ) ){
            return false;
        }

        require_once ( __DIR__ . DIRECTORY_SEPARATOR . $this->_config['components_path'] . DIRECTORY_SEPARATOR . $element . DIRECTORY_SEPARATOR . $element.'.class.php' );

        $element_string = 'FutureLab\\'.$this->_config['elements'][$element]['controller'];

        return call_user_func( array( new $element_string(), 'get_content' ), $element );
    }

    public function validate_element( $element ){
        if ( ! isset( $this->_config['elements'][$element]) || ! isset( $this->_config['elements'][$element]['controller'] ) )  {
            echo 'FutureLab Component Error: Missing Configuration for '.$element;
            return false;
        }
        if ( !file_exists( $this->get_element_path( $element ) . DIRECTORY_SEPARATOR . $element.'.class.php') ) {
            echo 'FutureLab Component Error: Missing Controller file for '.$element;
            return false;
        }
        return true;
    }

    public function get_element_path( $element ){
        return __DIR__ . DIRECTORY_SEPARATOR . $this->_config['components_path'] . DIRECTORY_SEPARATOR . $element;
    }


    protected function load_config(){
        //include config file
        $this->_config = include(__DIR__.'/config.php');
    }

    /**
     * Gets content of specific component
     *
     * @param string $element
     * @return string HTML
     */
    protected function get_content( $element ) {

        if( ! $this->validate_element( $element ) ){
            return false;
        }

        ob_start();

        $views_array = $this->get_element_config( $element )['templates'];

        foreach( $views_array as $view_name){
            get_template_part(
                'inc' . DIRECTORY_SEPARATOR . 'futurelab' .
                    DIRECTORY_SEPARATOR . $this->_config['components_path'] .
                    DIRECTORY_SEPARATOR . $element .
                    DIRECTORY_SEPARATOR . 'views' .
                    DIRECTORY_SEPARATOR . $element,
                $view_name
            );
        }


        $html = ob_get_clean();

		return $html;

    }

    protected function get_element_config( $element ) {
        return $this->_config['elements'][$element] ?? false;
    }


}
