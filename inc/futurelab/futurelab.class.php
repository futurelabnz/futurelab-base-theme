<?php

namespace FutureLab;

class FutureLabCore {

    protected $_config;

    public function __construct(){
        $this->load_config();
        add_action( 'init', [$this, 'create_custom_post_types'], 0 );
        add_action( 'wp_enqueue_scripts', [$this, 'load_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'load_javascript'] );
        add_action( 'after_setup_theme', [$this, 'fl_after_setup_theme'] );
        add_action( 'widgets_init', [$this, 'fl_widgets_init'] );
    }

    public function fl_after_setup_theme(){
        register_nav_menus(
			$this->_config['menu_positions']
		);
    }

    public function fl_widgets_init() {
        if ( ! isset ( $this->_config['widgets'] ) || empty ( $this->_config['widgets'] ) ) {
            return false;
        }

        foreach ( $this->_config['widgets'] as $sidebar ) {
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
                                            filemtime( get_template_directory() .
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
        foreach( $this->_config['global']['js'] as $javascript ){
            wp_enqueue_script(
                $javascript['name'],
                get_template_directory_uri().$javascript['path'],
                $javascript['dependent_on'],
                filemtime( get_template_directory().$javascript['path'] )
            );
        }
    }

    function create_custom_post_types() {
        
        if( !isset( $this->_config['custom_post_types'] ) || empty( $this->_config['custom_post_types'] ) ) {
            return false;
        }

        foreach( $this->_config['custom_post_types'] as $cpt ) {
            $labels = array(
                'name'                => _x( $cpt['name']['singular'], 'Post Type General Name', 'futurelab-base-theme2' ),
                'singular_name'       => _x( $cpt['name']['singular'], 'Post Type Singular Name', 'futurelab-base-theme2' ),
                'menu_name'           => __( $cpt['name']['plural'], 'futurelab-base-theme2' ),
                'parent_item_colon'   => __( 'Parent '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'all_items'           => __( 'All '.$cpt['name']['plural'], 'futurelab-base-theme2' ),
                'view_item'           => __( 'View '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'add_new_item'        => __( 'Add New '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'add_new'             => __( 'Add New', 'futurelab-base-theme2' ),
                'edit_item'           => __( 'Edit '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'update_item'         => __( 'Update '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'search_items'        => __( 'Search '.$cpt['name']['singular'], 'futurelab-base-theme2' ),
                'not_found'           => __( 'Not Found', 'futurelab-base-theme2' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'futurelab-base-theme2' ),
            );
            
            $args = array(
                'label'               => __( $cpt['id'], 'futurelab-base-theme2' ),
                'description'         => __( $cpt['description'], 'futurelab-base-theme2' ),
                'labels'              => $labels,
                'supports'            => $cpt['supports'],
                'taxonomies'          => array( 'genres' ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'post',
                'show_in_rest' => true,
            );
            
            // Registering your Custom Post Type
            register_post_type( 'movies', $args );
        }
    
    }

    public function get_element_content( $element, $template = 'view' ) {
        if( ! $this->validate_element( $element ) ){
            return false;
        }

        require_once ( get_template_directory() . DIRECTORY_SEPARATOR . $this->_config['components_path'] . DIRECTORY_SEPARATOR . $element . DIRECTORY_SEPARATOR . $element.'.class.php' );

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
        return get_template_directory() . DIRECTORY_SEPARATOR . $this->_config['components_path'] . DIRECTORY_SEPARATOR . $element;
    }


    protected function load_config(){
        //load config from child theme
        if( \file_exists( get_stylesheet_directory() . '/inc/futurelab/config.php' ) ) {
            return $this->_config = include( get_stylesheet_directory() . '/inc/futurelab/config.php' );
        } else {
            //include default config file
            return $this->_config = include( __DIR__ . '/config.php' );
        }
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
            $this->_config['components_path'] .
                DIRECTORY_SEPARATOR . $element .
                DIRECTORY_SEPARATOR . 'views' .
                DIRECTORY_SEPARATOR . $element,
            $template,
            array(
                'futurelab' => $this
            ),
        );


        $html = ob_get_clean();

		return $html;

    }

    protected function get_element_config( $element ) {
        return $this->_config['elements'][$element] ?? false;
    }


}
