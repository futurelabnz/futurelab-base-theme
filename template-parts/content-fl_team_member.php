<?php

/**
 * Template part for displaying post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php // get_template_part('template-parts/partial', 'banner-header'); ?>
	<div class="entry-content">

		<div class="grid-container-x">
			<div class="grid-x grid-margin-x">
				<div class="cell large-3 team-member-sidebar">
					<?php $thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'large' ); ?>
					<img src="<?php echo esc_url( $thumbnail_url ); ?>" class="service-header-icon" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
					<div class="team-member-contact">
						
						<?php
						if ( get_post_meta( $post->ID, 'fl_team_member_number', true ) || get_post_meta( $post->ID, 'fl_team_email', true ) || get_post_meta( $post->ID, 'fl_team_linkedin', true ) ) {
							?>
								<h4 class="title">Contact</h4>
						<?php
						} else {
                        ?>
                        <!-- empty p tag for spacing -->
                        <p></p>
                        <?php 
                        }
						?>
						
						<?php
						if ( get_post_meta( $post->ID, 'fl_team_member_number', true ) ) {
							?>
							<p class="number"><a href="tel:<?php echo get_post_meta( $post->ID, 'fl_team_member_number', true ); ?>"> T: <?php echo get_post_meta( $post->ID, 'fl_team_member_number', true ); ?> </a></p>
							<?php
						}
						?>
						<?php
						if ( get_post_meta( $post->ID, 'fl_team_email', true ) ) {
							?>
							<p class="email"><a href="mailto:<?php echo get_post_meta( $post->ID, 'fl_team_email', true ); ?>"><?php echo get_post_meta( $post->ID, 'fl_team_email', true ); ?></a></p>
							<?php
						}
						?>
						<?php
						if ( get_post_meta( $post->ID, 'fl_team_linkedin', true ) ) {
							?>
							<p class="linkedin"><a href="<?php echo get_post_meta( $post->ID, 'fl_team_linkedin', true ); ?>">LinkedIn</a></p>
							<?php
						}
						?>

					</div>
				</div>
				<div class="cell large-9 team-member-content">
					<?php the_content(); ?>
				</div>
			</div>

			<?php

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'futurelab-base' ),
					'after'  => '</div>',
				)
			);
			?>

			<?php
			$widget_area = 'bottom-of-posts-page';
			if ( is_active_sidebar( $widget_area ) ) :
				?>
				<div class="grid-container-x">
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
