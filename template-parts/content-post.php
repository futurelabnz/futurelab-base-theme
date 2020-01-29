<?php
/**
 * Template part for displaying post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<?php get_template_part( 'template-parts/partial', 'banner-header' ); ?>

    <div class="entry-content">

        <div class="grid-container-x alignwide">

            <div class="grid-x grid-padding-x">

                <div class="large-3 medium-3 hide-for-small-only post-sidebar">

					<?php
					$widget_area = 'left-of-posts-page';
					if ( is_active_sidebar( $widget_area ) ): ?>
						<?php dynamic_sidebar( $widget_area ); ?>
					<?php endif; ?>

                </div>
                <div class="large-9 medium-9 small-12 post-content">

					<?php

					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'futurelab-base' ),
						'after'  => '</div>',
					) );
					?>

                </div>

            </div>
        </div>

		<?php
		$widget_area = 'bottom-of-posts-page';
		if ( is_active_sidebar( $widget_area ) ): ?>
            <div class="grid-container-x alignfull">
                <hr class="wp-block-separator is-style-fl-customized-separator-shadow-above alignfull" />
                <div class="grid-x align-self-middle">
                    <div class="large-12 text-center">
						<?php dynamic_sidebar( $widget_area ); ?>
                    </div>
                </div>
            </div>
		<?php endif; ?>


    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
