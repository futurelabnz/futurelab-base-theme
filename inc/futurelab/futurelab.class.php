<?php

namespace FutureLab;

class FutureLabCore {

    protected $_config;

    public function __construct(){
        $this->load_config();
        add_action( 'wp_enqueue_scripts', [$this, 'load_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'load_javascript'] );
        add_action( 'after_setup_theme', [$this, 'fl_after_setup_theme'] );
        add_action( 'widgets_init', [$this, 'fl_widgets_init'] );

    }

    public function fl_after_setup_theme(){
        register_nav_menus(
			array(
                'primary' => esc_html__( 'Primary', 'futurelab-base-theme2' ),
			)
		);
    }

    public function fl_widgets_init() {
        $sidebars = array(
            array(
                'name'        => 'Footer widgets area 1',
                'id'          => 'footer_widgets_area_1',
                'description' => 'Content for "Footer widgets area 1"',
            ),
            array(
                'name'        => 'Footer widgets area 2',
                'id'          => 'footer_widgets_area_2',
                'description' => 'Content for "Footer widgets area 2"',
            ),
            array(
                'name'        => 'Footer widgets area 3',
                'id'          => 'footer_widgets_area_3',
                'description' => 'Content for "Footer widgets area 3"',
            ),
            array(
                'name'        => 'Footer widgets area 4',
                'id'          => 'footer_widgets_area_4',
                'description' => 'Content for "Footer widgets area 4"',
            ),
        );
    
        foreach ( $sidebars as $sidebar ) {
    
            register_sidebar(
                array(
                    'name'          => esc_html__( $sidebar['name'], 'futurelab-base-theme2' ),
                    'id'            => $sidebar['id'],
                    'description'   => esc_html__( $sidebar['description'], 'futurelab-base-theme2' ),
                    'before_widget' => '<section id = "%1$s" class="widget %2$s" > ',
                    'after_widget'  => '</section >',
                    'before_title'  => '<h5 class="title">',
                    'after_title'   => '</h5>',
                )
            );
        }
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

        wp_enqueue_style( 'fl-bootstrap-css', get_template_directory_uri().'/vendor/twbs/bootstrap/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'fl-base-style', get_template_directory_uri().'/build/bundle.css' );
    }

    public function load_javascript(){
        // foreach($this->_config['elements'] as $element_name=>$element){
        //     if( isset( $element['styles'] ) && !empty( $element['styles'] ) ){
        //         if( is_array( $element['styles'] )){
        //             foreach( $element['styles'] as $stylesheet){
        //                 wp_enqueue_style(   'fl-style-'.$stylesheet,
        //                                     get_template_directory_uri().
        //                                         DIRECTORY_SEPARATOR.$this->_config['components_path'].
        //                                         DIRECTORY_SEPARATOR.$element_name.
        //                                         DIRECTORY_SEPARATOR.$stylesheet,
        //                                     '',
        //                                     filemtime( __DIR__.
        //                                         DIRECTORY_SEPARATOR.$this->_config['components_path'].
        //                                         DIRECTORY_SEPARATOR.$element_name.
        //                                         DIRECTORY_SEPARATOR.$stylesheet )

        //                 );
        //             }
        //         } else {
        //             wp_enqueue_style( 'fl-style-'.$k, get_template_directory_uri().'components/header/header.css' );
        //         }
        //     }
        // }

        foreach( $this->_config['global']['js'] as $javascript ){
            wp_enqueue_script(
                $javascript['name'],
                get_template_directory_uri().$javascript['path'],
                $javascript['dependent_on'],
                filemtime( get_template_directory().$javascript['path'] )
            );
        }
    }

    public function get_element_content( $element, $template = 'view' ) {
        if( ! $this->validate_element( $element ) ){
            return false;
        }

        require_once ( __DIR__ . DIRECTORY_SEPARATOR . $this->_config['components_path'] . DIRECTORY_SEPARATOR . $element . DIRECTORY_SEPARATOR . $element.'.class.php' );

        $element_string = 'FutureLab\\'.$this->_config['elements'][$element]['controller'];

        return call_user_func( array( new $element_string(), 'get_content' ), $element, $template );
    }

    public function validate_element( $element ){
        if ( ! isset( $this->_config['elements'][$element]) || ! isset( $this->_config['elements'][$element]['controller'] ) )  {
            return new \WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'FL Error: Missing Configuration for '.$element, 'wp-bootstrap-navwalker' ) );
        }
        if ( ! file_exists( $this->get_element_path( $element ) . DIRECTORY_SEPARATOR . $element.'.class.php') ) {
            return new \WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'FutureLab Component Error: Missing Controller file for '.$element, 'wp-bootstrap-navwalker' ) );
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
    protected function get_content( $element, $template ) {

        if( ! $this->validate_element( $element ) ){
            return false;
        }

        ob_start();

        get_template_part(
            'inc' . DIRECTORY_SEPARATOR . 'futurelab' .
                DIRECTORY_SEPARATOR . $this->_config['components_path'] .
                DIRECTORY_SEPARATOR . $element .
                DIRECTORY_SEPARATOR . 'views' .
                DIRECTORY_SEPARATOR . $element,
            $template
        );


        $html = ob_get_clean();

		return $html;

    }

    protected function get_element_config( $element ) {
        return $this->_config['elements'][$element] ?? false;
    }


}
