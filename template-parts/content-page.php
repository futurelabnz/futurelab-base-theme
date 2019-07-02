<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_home() && ! is_front_page() ): ?>

    <?php get_template_part( 'template-parts/partial', 'banner-header'); ?>

        <!-- .entry-header -->

	<?php endif; ?>

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
