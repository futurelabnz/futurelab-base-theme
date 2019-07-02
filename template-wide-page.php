<?php

/**
 * Template name: Wide page layout
 */

get_header(); ?>

	<div id="primary" class="content-area grid-container full">
		<main id="main" class="site-main">

			<?php get_template_part( 'template-parts/partial', 'banner-header' ); ?>

			<?php
			while ( have_posts() ) :
				the_post();

				/*
				 * Content list displays a list of posts, in single column format, image left,
				 * title and excerpt right and clicks through to the relevant detail page
				*/ ?>

				<div class="alignwide">

				<?php get_template_part( 'template-parts/content-page-wide' ); ?>

				</div>


			<?php endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

