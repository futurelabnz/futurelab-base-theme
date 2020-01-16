<?php
/*
 * Lists services post type
 */


$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query_args = array(
	'post_type' => 'fl_services',
	'paged'     => $paged,
);

$services = new WP_Query( $query_args );

if ( $services->have_posts() ) : ?>

    <div id="primary" class="content-area grid-container full">
        <main id="main" class="site-main post-list">

			<!-- add div to fix narrator doesn't read first image -->
			<div class="clearfix"></div>
			<?php
			while ( $services->have_posts() ) :

				$services->the_post();

				/*
				 * Content list displays a list of posts, in single column format, image left,
				 * title and excerpt right and clicks through to the relevant detail page
				*/

               get_template_part( 'template-parts/list', 'inside-loop' );

			endwhile;

			wp_reset_postdata();
			wp_reset_query();

			?>

        </main><!-- #main -->
    </div><!-- #primary -->


<?php endif; ?>

