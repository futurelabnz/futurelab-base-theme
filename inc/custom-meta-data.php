<?php
/**
 * todo put in a class and make this scaleable
 * todo even better set it up via react for gutenberg proper
 */

namespace FutureLab;

class custom_meta_data {

	/*
	 * This obviously needs to go into a proper set of arrays that will allow easy reuse of functions,
	 * but for now in the interests of time...
	 * todo
	 */

	/*
	 * Meta for teams
	 */
	private $fl_team_fields = array(
		'fl_team_position'  => 'Position in the company',
		'fl_team_email'     => 'Email address',
		'fl_team_linkedin'  => 'URL of LinkedIn profile',
		'fl_team_facebook'  => 'URL of Facebook profile',
		'fl_team_twitter'   => 'URL of Twitter profile',
		'fl_team_instagram' => 'URL of Instagram profile'
	);

	/*
	 * Meta for pages
	 */
	private $page_fields = array(
		'fl_display_secondary_menu'             => 'Display a secondary menu',
		'fl_display_siblings_as_secondary_menu' => 'Display siblings as a secondary menu',
	);

	/*
	 * Meta for services
	 */
	private $services_fields = array(
		'fl_display_secondary_menu'             => 'Display a secondary menu',
		'fl_display_siblings_as_secondary_menu' => 'Display siblings as a secondary menu',
	);

	/*
	 * Text inputs for pages and services and posts
	 * Removed 29/8/2019 'fl_page_headline'    => 'Main page headline'
	 *
	 * fl_page_meta_title => displays in the partial-banner-header.php in a div styled the same as an h3
	 * fl_page_subheadline => displays in the partial-banner-header.php as h2
	 */
	private $sp_text_fields = array(
		'fl_page_meta_title'    => 'Page tag line',
		'fl_page_subheadline' => 'Page subheadline'
	);

	/*
	 * Menu slect for pages, posts, teams and services
	 */
	private $fl_menu_options = array(
		'fl_banner_menu'  => 'Select a menu to display in the banner',
		'fl_sidebar_menu' => 'Select a menu to display in the sidebar'
	);

	/*
	 * Category meta
	 */
	private $fl_category_meta = array(
		'fl_banner_menu' => 'Select a menu to display in the banner of category pages'
	);


	protected static $instance = null;

	public static function init() {

		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {

		add_action( 'save_post', array( $this, 'save_postdata' ) );
		add_action( 'init', array( $this, 'register_meta' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_filter( 'rest_api_init', array( $this, 'add_meta_to_rest' ) );
		//add_action( 'category_edit_form_fields',  array( $this, 'render_category_metaboxes' ) );
		//add_action( 'edited_category', array( $this, 'save_term_meta' ), 0, 2 );
		//add_action( 'created_category', array( $this, 'save_term_meta' ), 0, 2 );

	}


	public function register_meta() {

		foreach ( $this->fl_team_fields as $key => $value ) {

			register_meta( 'fl_team_member', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->page_fields as $key => $value ) {

			register_meta( 'page', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->services_fields as $key => $value ) {

			register_meta( 'fl_services', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->sp_text_fields as $key => $value ) {

			register_meta( 'fl_services', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->sp_text_fields as $key => $value ) {

			register_meta( 'page', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->sp_text_fields as $key => $value ) {

			register_meta( 'post', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);
		}

		foreach ( $this->fl_menu_options as $key => $vvalue ) {

			register_meta( 'page', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);

			register_meta( 'fl_team_members', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);

			register_meta( 'fl_services', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);

		}

		foreach ( $this->fl_category_meta as $key => $value ) {

			register_term_meta( 'category', $key, array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => 'string',
				)
			);

		}


	}

	function add_meta_boxes() {

		add_meta_box(
			'fl_team_data',
			esc_html__( 'Member information', 'futurelab-base' ),
			array( $this, 'render_team_meta_boxes' ),
			'fl_team_member',
			'side',
			'high'
		);

		add_meta_box(
			'fl_page_data',
			esc_html__( 'Page options', 'futurelab-base' ),
			array( $this, 'render_page_meta_boxes' ),
			'page',
			'side',
			'high'
		);

		add_meta_box(
			'fl_services_data',
			esc_html__( 'Services options', 'futurelab-base' ),
			array( $this, 'render_services_meta_boxes' ),
			'fl_services',
			'side',
			'high'
		);

		add_meta_box(
			'fl_post_data',
			esc_html__( 'Blog options', 'futurelab-base' ),
			array( $this, 'render_post_meta_boxes' ),
			'post',
			'side',
			'high'
		);

	}

	function render_category_metaboxes( $term ) {

		ob_start(); ?>

		<?php //wp_nonce_field( basename( __FILE__ ), 'term_meta_text_nonce' ); ?>

		<?php foreach ( $this->fl_category_meta as $key => $value ):
			$meta_value = get_term_meta( $term->ID, $key, true ); ?>

            <tr class="form-field term-meta-text-wrap">
                <th scope="row"><label for="<?php echo $key; ?>">
						<?php echo $value; ?>
                    </label>
                </th>
                <th scope="row">
                    <label for="<?php echo $key; ?>">
						<?php esc_html( $meta_value ); ?>
                    </label>
                </th>
                <td>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           value="<?php echo esc_attr( $meta_value ); ?>" class="term-meta-text-field"/>
                </td>
            </tr>

		<?php endforeach;

		$html = ob_get_clean();
		echo $html;
	}

	function render_page_meta_boxes( $post ) {

		ob_start();

		wp_nonce_field( basename( __FILE__ ), 'fl-page-nonce' );
		?>

        <div class="components-base-control editor-post-excerpt__textarea">

			<?php foreach ( $this->page_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="page-post-class"><?php echo $value; ?></label>
                    <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="1" <?php echo ( get_post_meta( $post->ID, $key, true ) == '1' ) ? ' checked ' : ''; ?>>
                </div>
			<?php endforeach; ?>

			<?php foreach ( $this->sp_text_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="page-post-class"><?php echo $value; ?></label>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="<?php echo( get_post_meta( $post->ID, $key, true ) ); ?>"
                    >
                </div>
			<?php endforeach;

			$this->render_menu_meta_boxes( $post );

			?>

        </div>
		<?php
		$html = ob_get_clean();
		echo $html;
	}

	function render_post_meta_boxes( $post ) {

		ob_start();

		wp_nonce_field( basename( __FILE__ ), 'fl-page-nonce' );
		?>

        <div class="components-base-control editor-post-excerpt__textarea">

			<?php foreach ( $this->page_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="page-post-class"><?php echo $value; ?></label>
                    <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="1" <?php echo ( get_post_meta( $post->ID, $key, true ) == '1' ) ? ' checked ' : ''; ?>>
                </div>
			<?php endforeach; ?>

			<?php foreach ( $this->sp_text_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="page-post-class"><?php echo $value; ?></label>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="<?php echo( get_post_meta( $post->ID, $key, true ) ); ?>"
                    >
                </div>
			<?php endforeach;

			$this->render_menu_meta_boxes( $post );

			?>

        </div>
		<?php
		$html = ob_get_clean();
		echo $html;
	}

	function render_team_meta_boxes( $post ) {

		ob_start();

		wp_nonce_field( basename( __FILE__ ), 'fl-team-member-nonce' );
		?>

        <div class="components-base-control editor-post-excerpt__textarea">

			<?php foreach ( $this->fl_team_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="fl_team_member-post-class"><?php echo $value; ?></label>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-post-post-schedule"
                           value="<?php echo get_post_meta( $post->ID, $key, true ); ?>">
                </div>
			<?php endforeach; ?>

        </div>
		<?php
		$html = ob_get_clean();
		echo $html;
	}

	function render_services_meta_boxes( $post ) {

		ob_start();

		wp_nonce_field( basename( __FILE__ ), 'fl-page-nonce' );
		?>

        <div class="components-base-control editor-post-excerpt__textarea">

			<?php foreach ( $this->services_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="fl_services-post-class"><?php echo $value; ?></label>
                    <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="1" <?php echo ( get_post_meta( $post->ID, $key, true ) == '1' ) ? ' checked ' : ''; ?>>
                </div>
			<?php endforeach; ?>

			<?php foreach ( $this->sp_text_fields as $key => $value ) : ?>
                <div class="components-base-control__field">
                    <label class="components-base-control__label"
                           for="fl_services-post-class"><?php echo $value; ?></label>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                           class="edit-page-post-schedule"
                           value="<?php echo( get_post_meta( $post->ID, $key, true ) ); ?>">
                </div>
			<?php endforeach; ?>

			<?php $this->render_menu_meta_boxes( $post ); ?>


        </div>
		<?php
		$html = ob_get_clean();
		echo $html;
	}

	function render_menu_meta_boxes( $post ) {

		$options = $this->get_all_menus();
		?>

		<?php foreach ( $this->fl_menu_options as $key => $value ) : ?>
            <div class="components-base-control__field">
                <label class="components-base-control__label"
                       for="fl_services-post-class"><?php echo $value; ?></label>
                <select name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                        class="edit-page-post-schedule">
                    <option value="no-menu">No menu</option>
					<?php foreach ( $options as $option_key => $option_value ): ?>
                        <option value="<?php echo $option_key; ?>"
							<?php echo ( get_post_meta( $post->ID, $key, true ) === $option_key ) ? ' selected ' : ''; ?>><?php echo $option_value; ?></option>
					<?php endforeach; ?>
                </select>
            </div>
		<?php endforeach; ?>

		<?php
	}

	public function save_postdata( $post_id ) {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return $post_id;
		}

		foreach ( $this->page_fields as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_post_meta(
					$post_id,
					$key,
					$_POST[ $key ]
				);
			}
		}

		foreach ( $this->fl_team_fields as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_post_meta(
					$post_id,
					$key,
					$_POST[ $key ]
				);
			}
		}

		foreach ( $this->services_fields as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_post_meta(
					$post_id,
					$key,
					$_POST[ $key ]
				);
			}
		}

		foreach ( $this->sp_text_fields as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_post_meta(
					$post_id,
					$key,
					$_POST[ $key ]
				);
			}
		}

		foreach ( $this->fl_menu_options as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_post_meta(
					$post_id,
					$key,
					$_POST[ $key ]
				);
			}
		}
	}

	public function save_term_meta( $term_id, $two, $three ){

		error_log(print_r( $term_id ) );
		error_log(print_r( $two ) );
		error_log(print_r( $three ) );
	    error_log(print_r( $_POST ) );


	    /*
		if ( ! current_user_can( 'edit_posts' ) ) {
			return $term_id;
		}
	    */

		foreach ( $this->fl_category_meta as $key => $value ) {

			if ( array_key_exists( $key, $_POST ) ) {
				update_term_meta(
					$term_id,
					$key,
					$_POST[ $key ]
				);
			}
		}



    }

	public function add_meta_to_rest() {

		foreach ( $this->page_fields as $key => $value ) {
			register_rest_field( 'page',
				$key,
				array(
					'get_callback'    => array( $this, 'get_meta_for_api' ),
					'update_callback' => array( $this, 'update_meta_for_api' ),
					'schema'          => null,
				)
			);
		}

		foreach ( $this->fl_team_fields as $key => $value ) {
			register_rest_field( 'fl_team_member',
				$key,
				array(
					'get_callback'    => array( $this, 'get_meta_for_api' ),
					'update_callback' => array( $this, 'update_meta_for_api' ),
					'schema'          => null,
				)
			);
		}
	}

	public function get_meta_for_api( $object, $field_name, $request ) {
		return get_post_meta( $object['id'], $field_name );
	}

	public function supdate_meta_for_api( $value, $object, $field_name ) {
		return update_post_meta( $object['id'], $field_name, $value );
	}

	/**
	 * Returns an array of menus as $slug => $name
	 *
	 * @return array
	 */
	private function get_all_menus() {

		$menu_data = array();
		$menus     = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		if ( ! empty( $menus ) && $menus !== false ) {

			foreach ( $menus as $menu ) {
				$menu_data[ $menu->slug ] = $menu->name;
			}

		}

		return $menu_data;

	}


}

add_action( 'init', array( 'FutureLab\custom_meta_data', 'init' ) );



