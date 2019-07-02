<?php
/**
 * Template part for displaying page content in template-wide-page
 * This is for when content is unconstrained by a block boarder but needs to be constrained in the layout
 * todo
 * Fix - this is a very hacky solution
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'futurelab-base' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->