<?php
/**
 * Template name: Services page
 */

get_header();
?>

    <div id="primary" class="content-area grid-container full">
        <main id="main" class="site-main">

			<?php get_template_part( 'template-parts/partial', 'banner-header' ); ?>

			<?php
			while ( have_posts() ) :
				the_post();

				/*
				 * Content list displays a list of posts, in single column format, image left,
				 * title and excerpt right and clicks through to the relevant detail page
				*/
				get_template_part( 'template-parts/list-services' );


			endwhile; // End of the loop.

			$widget_area = 'bottom-of-services-page';
			if ( is_active_sidebar( $widget_area ) ): ?>

                <div class="grid-container fluid">
                    <div class="grid-x align-self-middle">
                        <div class="large-12 text-center">
							<?php dynamic_sidebar( $widget_area ); ?>
                        </div>
                    </div>
                </div>

			<?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();


