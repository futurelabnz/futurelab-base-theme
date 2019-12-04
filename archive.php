<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

get_header();
?>

    <div id="primary" class="content-area">
    <main id="main" class="site-main">

<?php if ( have_posts() ) : ?>

    <?php get_template_part( 'template-parts/partial-banner-header'); ?>

	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();


		/*
		 * Content list displays a list of posts, in single column format, image left,
		 * title and excerpt right and clicks through to the relevant detail page
		*/

		get_template_part( 'template-parts/list-inside-loop' );

	endwhile;

	wp_reset_postdata();
	wp_reset_query();

	?>

<?php endif; ?>

    </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
