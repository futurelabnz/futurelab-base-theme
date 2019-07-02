<?php
/*
A widget for selecting a reuable block
*/

class futurelab_reuseable_blocks extends WP_Widget {

	function __construct() {
		// widget actual processes
		parent::__construct(
			'fl_reusable_blocks',
			'Futurelab reusable block widget',
			array(
				'description' => __( 'Display reusable blocks in a widget', 'futurelab-base' )
			)
		);
	}

	public function form( $instance ) {
		// outputs the options on admin
		$reusable_block = ( isset( $instance['post_id'] ) ) ? $instance['post_id'] : '';
		//$title          = ( isset( $instance['title'] ) ) ? $instance['title'] : '';

		$args = array(
			'post_type'       => 'wp_block',
			'number_of_posts' => - 1,
			'fields'          => 'ids'
		);

		$block_ids     = get_posts( $args );
		$custom_blocks = array();

		if ( ! empty( $block_ids ) ) {
			foreach ( $block_ids as $block_id ) {
				$custom_blocks[ $block_id ] = get_the_title( $block_id );
			}
		}

		?>

        <p>
            <label><strong>Select reusable block to display in this widget</strong></label>


            <select name="<?php echo $this->get_field_name( 'post_id' ); ?>"
                    id="<?php echo $this->get_field_id( 'post_id' ); ?>">
				<?php foreach ( $custom_blocks as $key => $value ): ?>
                    <option value="<?php echo $key; ?>" <?php echo ( $reusable_block == $block_id ) ? ' selected ' : '' ?>>
						<?php echo $value; ?>
                    </option>
				<?php endforeach; ?>
            </select>

        </p>


		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance            = $old_instance;
		$instance['post_id'] = $new_instance['post_id'];

		//$instance['title']   = $new_instance['title'];

		return $instance;

	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget

		extract( $args );
		$block_id = $instance['post_id'];
		//$title  = $instance['title'];

		$block = get_post( $block_id );


		echo $block->post_content;

	}

}

add_action( 'widgets_init', function () {
	register_widget( 'futurelab_reuseable_blocks' );
} );