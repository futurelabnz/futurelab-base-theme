<?php

namespace FutureLab\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( 'Walker_Nav_Menu_Edit_Custom.php' );
require_once( 'Walker_Primary_Mobile_Menu.php' );


class Menu_Options {


	/**
	 * Custom fields
	 */
	private $checkbox_fields = array(
		array(
			'id'              => 'menu-item-column',
			'meta_key'        => '_menu_item_column',
			'object_key'      => 'is_header',
			'value'           => 'true',
			'label'           => 'Start a column',
			'render_callback' => 'add_header_classes'
		),
		array(
			'id'              => 'menu-item-row',
			'meta_key'        => '_menu_item_row',
			'object_key'      => 'is_row',
			'value'           => 'true',
			'label'           => 'Start a menu row',
			'render_callback' => 'add_header_classes'
		),
		array(
			'id'              => 'menu-item-hide-title',
			'meta_key'        => '_menu_item_hide-title',
			'object_key'      => 'hide_title',
			'value'           => 'true',
			'label'           => 'Hide the navigation label',
			'render_callback' => 'hide_menu_item_titles'
		)
	);

	/**
	 * Class instance.
	 *
	 * @var menu_options instance
	 */
	protected static $instance = null;

	/**
	 * Get class instance
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_walker_filter' ) );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'save_checkbox_values' ), 10, 3 );
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'render_checkbox' ), 10, 4 );

		foreach ( $this->checkbox_fields as $field ) {
			add_filter( 'wp_get_nav_menu_items', array( $this, $field['render_callback'] ), null, 3 );
		}

	}

	/**
	 * Replacement menu walker class in admin
	 *
	 * @return string
	 */
	function menu_walker_filter() {
		return 'Walker_Nav_Menu_Edit_Custom';
	}


	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function add_custom_nav_fields( $menu_item ) {

		foreach ( $this->checkbox_fields as $field ) {

			$key             = $field['object_key'];
			$menu_item->$key = get_post_meta( $menu_item->ID, $field['meta_key'], true );

		}

		return $menu_item;
	}

	/**
	 * Save menu custom field values
	 *
	 * @access      public
	 * @return      void
	 * @since       1.0
	 */
	public function save_checkbox_values( $menu_id, $menu_item_db_id, $args ) {

		foreach ( $this->checkbox_fields as $field ) {
			$value = ( isset( $_REQUEST[ $field['id'] ][ $menu_item_db_id ] ) ) ? $_REQUEST[ $field['id'] ][ $menu_item_db_id ] : 'false';
			update_post_meta( $menu_item_db_id, $field['meta_key'], sanitize_text_field( $value ) );
		}

	}

	/**
	 * Filters menu items for the custom checkbox value === true
	 * for 'hide the title'. Removes title is _menu_item_hide_title === true
	 *
	 * @param $items
	 * @param $menu
	 * @param $args
	 *
	 * @return mixed
	 */
	public function hide_menu_item_titles( $items, $menu, $args ) {

		foreach ( $items as $key => $item ) {

			if ( 'true' === get_post_meta( $item->ID, '_menu_item_hide_title', true ) ) {
				$items[ $key ]->title = '';
			}
		}

		return $items;
	}

	/**
	 * Filters menu items for the custom checkbox value === true
	 * Adds class "menu-item-column-header" if _menu_item_column === true
	 * Adds class "menu-item-row" if _menu_item_row === true
	 *
	 * @param $items
	 * @param $menu
	 * @param $args
	 *
	 * @return mixed
	 */
	public function add_header_classes( $items, $menu, $args ) {

		foreach ( $items as $key => $item ) {

			if ( 'true' === get_post_meta( $item->ID, '_menu_item_column', true ) ) {
				$items[ $key ]->classes[] = 'menu-item-column-header';
			}

			if ( 'true' === get_post_meta( $item->ID, '_menu_item_row', true ) ) {
				$items[ $key ]->classes[] = 'menu-item-row';
			}
		}

		return $items;
	}

	/**
	 * Adds the custom checkbox field
	 */
	public function render_checkbox( $item_id, $item, $depth, $args ) {

		foreach ( $this->checkbox_fields as $field ) {

			$key = $field['object_key'];

			ob_start(); ?>

            <p class="field-custom description description-wide">
                <label for="<?php echo $field['id']; ?>-<?php echo $item->ID; ?>">
                    <input type="checkbox"
                           id="<?php echo $field['id']; ?>-<?php echo $item->ID; ?>"
                           class="widefat code edit-menu-item-custom"
                           value="<?php echo $field['value']; ?>"
                           name="<?php echo $field['id']; ?>[<?php echo $item->ID; ?>]"
						<?php echo ( $item->$key === $field['value'] ) ? 'checked' : ''; ?>
                    />
					<?php echo $field['label']; ?>
                </label>
            </p>

			<?php $html = ob_get_clean();

			echo $html;
		}
	}


}

menu_options::get_instance();
