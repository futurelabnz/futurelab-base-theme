<?php
/**
 * futurelab base functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package futurelab_base
 */

if (!function_exists('futurelab_base_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function futurelab_base_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on futurelab base, use a find and replace
		 * to change 'futurelab-base' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('futurelab-base', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'futurelab-base'),
		));

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(array(
			'menu-2' => esc_html__('Secondary', 'futurelab-base'),
		));

		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(array(
			'services-menu' => esc_html__('Services menu', 'futurelab-base'),
		));

		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(array(
			'banner-header-menu' => esc_html__('Banner header menu', 'futurelab-base'),
		));

		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(array(
			'services-sidebar-menu' => esc_html__('Services sidebar menu', 'futurelab-base'),
		));


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('futurelab_base_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
		/**
		 * add support for full width
		 */
		add_theme_support('align-wide');
	}
endif;
add_action('after_setup_theme', 'futurelab_base_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if (!isset($content_width)) {
	$content_width = 640;
}

function mytheme_adjust_content_width()
{ }

add_action('template_redirect', 'futurelab_base_content_width');
function futurelab_base_content_width()
{
	global $content_width;
	$content_width = 640;
}

add_action('after_setup_theme', 'futurelab_base_content_width', 0);

/**
 * Register FutureLab widget areas
 * We create an array of widget data and feed it to the register_sidebar
 * function. This scales better than doing it separately for each one
 *
 */
add_action('widgets_init', 'futurelab_base_widgets_init');
function futurelab_base_widgets_init()
{

	$sidebars = array(
		array(
			'id'          => 'sidebar-1',
			'name'        => 'Sidebar',
			'description' => 'Add widgets here.'
		),
		array(
			'name'        => 'Secondary header on home',
			'id'          => 'home-secondary-header',
			'description' => 'Add widgets for home page secondary header here.'
		),
		array(
			'name'        => 'Footer column 1',
			'id'          => 'footer-col-1',
			'description' => 'Add footer column one widgets here.'
		),
		array(
			'name'        => 'Footer column 2',
			'id'          => 'footer-col-2',
			'description' => 'Add widgets for footer column two here.'
		),
		array(
			'name'        => 'Footer column 3',
			'id'          => 'footer-col-3',
			'description' => 'Add widgets for footer column three here.'
		),
		array(
			'name'        => 'Footer column 4',
			'id'          => 'footer-col-4',
			'description' => 'Add widgets for footer column four here . '
		),
		array(
			'name'        => 'Pages secondary header',
			'id'          => 'pages-secondary-header',
			'description' => 'Secondary header widgets for pages'
		),
		array(
			'name'        => 'Bottom of services pages',
			'id'          => 'bottom-of-services-page',
			'description' => 'Widgets for the bottom of services'
		),
		array(
			'name'        => 'Bottom of news/post pages',
			'id'          => 'bottom-of-posts-page',
			'description' => 'Widgets for the bottom of news (post or blog) pages'
		),
		array(
			'name'        => 'Left sidebar of news/post pages',
			'id'          => 'left-of-posts-page',
			'description' => 'Widgets for the left sidebar of news (post or blog) pages'
		),
		array(
			'name'        => 'Left sidebar of services pages',
			'id'          => 'left-of-services-page',
			'description' => 'Widgets for the left sidebar of services pages'
		)
	);

	foreach ($sidebars as $sidebar) {

		register_sidebar(array(
			'name'          => esc_html__($sidebar['name'], 'futurelab-base'),
			'id'            => $sidebar['id'],
			'description'   => esc_html__($sidebar['description'], 'futurelab-base'),
			'before_widget' => '<section id = "%1$s" class="widget %2$s" > ',
			'after_widget'  => '</section >',
			'before_title'  => '',
			'after_title'   => '',
		));
	}
}

/**
 * Enqueue scripts and styles for the front end
 * 1. Swiper scripts are loaded separately. They don't take well to webpack bundling
 *    and are at assets/swiper/js/swiper.min.js
 * 2. Theme frontend scripts are bundled to one in assets/dist/themefrontend.js
 * 3. We load foundation seperately. Unfortunately, foundation conflicts with the editor dashboard.
 * If we want the theme styling in the block editor, we need to drop it as an import and load it
 * separately.
 * 3. Theme stylesheet file imports all rules from assets/dist/style.min.css
 */
add_action('wp_enqueue_scripts', 'load_futurelab_frontend_assets');
function load_futurelab_frontend_assets()
{

	wp_enqueue_script(
		'futurelab-swiper',
		get_template_directory_uri() . '/assets/swiper/js/swiper.min.js',
		array(),
		filemtime(get_template_directory() . '/assets/swiper/js/swiper.min.js'),
		true
	);

	wp_enqueue_script(
		'init-swiper-js',
		get_template_directory_uri() . '/assets/js/initialize.js',
		array('futurelab-swiper, jquery'),
		filemtime(get_template_directory() . '/assets/js/initialize.js'),
		true
	);

	wp_enqueue_script(
		'futurelab-frontend-js',
		get_template_directory_uri() . '/assets/dist/themefrontend.min.js',
		array('init-swiper-js'),
		filemtime(get_template_directory() . '/assets/dist/themefrontend.min.js'),
		true
	);

	// wp_enqueue_script(
	// 	'futurelab-foundation-js',
	// 	get_template_directory_uri() . '/assets/foundation/js/vendor/foundation.min.js',
	// 	array('jquery'),
	// 	microtime(),
	// 	true
	// );

	// wp_enqueue_script(
	// 	'futurelab-responsive-tables-js',
	// 	get_template_directory_uri() . '/assets/foundation/js/vendor/responsive-tables.js',
	// 	array('jquery'),
	// 	microtime(),
	// 	true
	// );

	/*
	wp_enqueue_style(
		'futurelab-foundation-style',
		get_template_directory_uri() . '/assets/foundation/css/foundation.css',
		array(),
		filemtime( get_template_directory() . '/assets/foundation/css/foundation.css' ),
		false
	);
	*/

	wp_enqueue_script(
		'futurelab-fontawesome-style',
		"https://use.fontawesome.com/4b5cf91c35.js",
		array(),
		filemtime(get_template_directory() . '/assets/fontawesome/css/all.css'),
		true
	);

	wp_enqueue_style(
		'futurelab-base-style',
		get_template_directory_uri() . '/assets/dist/style.min.css',
		array(),
		filemtime(get_template_directory() . '/assets/dist/style.min.css'),
		false
	);
}

/**
 * Enqueue scripts and styles for the admin area
 * 1. Swiper is loaded separately from /assets/swiper/js/swiper.min.js
 * 2. Scripts are at assets/dist/themebackend.min.js
 * 3. Add theme support for editor styling. The style-editor.css in the theme
 *  is currently empty - WordPress can't handle imports in these files. It
 * messes up the pathing.
 */
add_action('enqueue_block_editor_assets', 'load_theme_css_for_gutenberg');
function load_theme_css_for_gutenberg()
{

	//add_theme_support( 'editor-styles' );
	//add_editor_style( 'style-editor.css' );

	/*
	 * todo fix ul > li and ol > li that
	 * is breaking wordpress dashboard
	 *
	wp_enqueue_style(
		'futurelab-base-style',
		get_template_directory_uri() . '/style.css',
		array(),
		filemtime( get_template_directory() . '/style.css' ),
		false
	);
	*/

	wp_enqueue_script(
		'futurelab-swiper',
		get_template_directory_uri() . '/assets/swiper/js/swiper.min.js',
		array(),
		'4.0',
		true
	);

	wp_enqueue_script(
		'futurelab-backend-js',
		get_template_directory_uri() . '/assets/dist/themebackend.min.js',
		array(),
		'2.0',
		false
	);
}

/**
 * add woocommerce suppourt
 */
function futurelab_base_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'futurelab_base_add_woocommerce_support');

// /**
//  * remove woocommerce theme color
//  */
// add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/*
 * todo filter image sizes
 * /

function futurelab_custom_responsive_image_sizes($sizes, $size) {
  $width = $size[0];
  // blog posts
  if ( is_singular( 'post' ) ) {
    // half width images - medium size
    if ( $width === 600 ) {
      return '(min-width: 768px) 322px, (min-width: 576px) 255px, calc( (100vw - 30px) / 2)';
    }
    // full width images - large size
    if ( $width === 1024 ) {
      return '(min-width: 768px) 642px, (min-width: 576px) 510px, calc(100vw - 30px)';
    }
    // default to return if condition is not met
    return '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
  }
  // default to return if condition is not met
  return '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
}
add_filter('wp_calculate_image_sizes', 'futurelab_custom_responsive_image_sizes', 10 , 2);
*/


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom taxonomies.
 */
require get_template_directory() . '/inc/custom_color_palette.php';

/**
 * Custom post types.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Custom taxonomies.
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Custom meta-data.
 */
require get_template_directory() . '/inc/custom-meta-data.php';

/**
 * Custom taxonomies.
 */
require get_template_directory() . '/inc/custom-theme-tags.php';

/**
 * Custom taxonomies.
 */
require get_template_directory() . '/widgets/reusable-blocks.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
