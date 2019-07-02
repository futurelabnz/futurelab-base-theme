<?php

/*
 Template Name: Shop Page
 */

get_header();
?>

    <div id="primary" class="content-area grid-container">
        <main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

		    // if( is_front_page() ){
		    //     get_template_part( 'template-parts/content', 'home' );
            // }
		    // else{
			//     get_template_part( 'template-parts/content', 'page' );
            // }

            get_template_part( 'template-parts/content-home', 'page' );


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				//comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();