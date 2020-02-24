<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

get_header();

?>

    <div id="primary" class="content-area grid-container fluid">
        <main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
				<?php
				endif;
				?>
				<div class="entry-content">
					<?php

						$posts_per_page = 6;

						$args = array(
							'posts_per_page'   => $posts_per_page,
							'post_status'      => 'publish',
							'suppress_filters' => false,
							'paged' => $paged,
						);

						$recent_posts = get_posts( $args );

						$list_items_markup = '';


						foreach ( $recent_posts as $post ) {

							$thumbnail = get_the_post_thumbnail( $post, 'large' ); // change to "large" because i need image to cover the full column, Hank
							if ( empty( $thumbnail ) ) {
								$thumbnail = '<div class="image-placeholder"></div>';
							}

							$title = get_the_title( $post );
							if ( ! $title ) {
								$title = __( '(Untitled)' );
							}
							$list_items_markup .= '<li class="post-item">';

							$list_items_markup .= sprintf(
								'<a class="post-image" href="%1$s">%2$s</a>',
								esc_url( get_permalink( $post ) ),
								$thumbnail
							);

							$list_items_markup .= sprintf(
								'<div class="post-more-arrow"></div>'
							);

							$list_items_markup .= '<div class="news-caption">';

							$list_items_markup .= sprintf(
								'<div class="post-text-content" style="top: 0px; position: relative;">'
							);


							$list_items_markup .= sprintf(
								'<time datetime="%1$s" class="wp-block-latest-posts__post-date">%2$s</time>',
								esc_attr( get_the_date( 'c', $post ) ),
								esc_html( get_the_date( 'M j, Y', $post ) )
							);

							$list_items_markup .= sprintf(
								'<div class="post-title"><a href="%1$s">%2$s</a></div>',
								esc_url( get_permalink( $post ) ),
								$title
							);

							$list_items_markup .= "</div></li>\n";
						}

						$class = 'wp-block-latest-posts wp-block-latest-posts__list is-grid columns-3 has-dates';

						$block_content = sprintf(
							'<ul class="%1$s">%2$s</ul>',
							esc_attr( $class ),
							$list_items_markup
						);

						echo $block_content;
						?>

						<div class="grid-x alignwide align-spaced">
						
							<?php 

								next_posts_link( 'Older Entries', $posts_per_page );
								previous_posts_link( 'Next Entries &raquo;' ); 
							
							?>
						</div>

					</div>
					<?php 
				

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
