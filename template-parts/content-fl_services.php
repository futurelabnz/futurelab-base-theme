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

                <div class="large-3 medium-3 hide-for-small-only fl-service-sidebar">
					<?php
					$menu = get_futurelab_menu( $post->ID, 'fl_sidebar_menu', 'sidebar-menu' );
					if ( ! empty( $menu ) ) {
						echo '<div class="sidebar-menu-container">' . $menu . '</div>';
					} else {

						$services = wp_list_pages(
							array(
								'post_type' => 'fl_services',
								'echo'      => false,
								'title_li'  => null
							)
						);
						//todo style menu
						echo '<div class="sidebar-menu-container"><ul id="sidebar-menu" class="sidebar-menu">' . $services . '</ul></div>';
					}
					?>

                </div>
                <div class="large-9 medium-9 small-12 fl-service-content">

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
		$widget_area = 'bottom-of-services-page';
		if ( is_active_sidebar( 'bottom-of-services-page' ) ): ?>
            <div class="grid-container-x alignfull">
                <?php if( is_single()) : ?>
                <hr class="wp-block-separator is-style-fl-customized-separator-shadow-above alignfull"/>
                <?php endif; ?>
                <div class="grid-x align-self-middle">
                    <div class="large-12 text-center">
						<?php dynamic_sidebar( 'bottom-of-services-page' ); ?>
                    </div>
                </div>
            </div>

		<?php endif; ?>


    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
