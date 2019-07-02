<?php
/*
 * The inner html content of a list loop
 */

?>

<div class="wp-block-columns alignwide has-2-columns">
    <div class="wp-block-column post-list-thumbnail">

		<?php if ( has_post_thumbnail( $post->ID ) ): ?>
            <a href="<?php echo get_the_permalink( $post->ID ); ?>"
               title="Go to <?php echo get_the_title( $post->ID ); ?>">
                <figure class="wp-block-image">
					<?php echo get_the_post_thumbnail( $post->ID ); ?>
                </figure>
            </a>
		<?php else:
			echo '<div class="image-placeholder"></div>';
		endif; ?>

    </div>

    <div class="wp-block-column">
        <h5 class="post-list-title">
            <a href="<?php echo get_the_permalink( $post->ID ); ?>"
               title="Go to <?php echo get_the_title( $post->ID ); ?>">
				<?php echo get_the_title( $post->ID ); ?>
            </a>
        </h5>
        <div class="post-list-content">
			<?php echo get_the_excerpt( $post->ID ); ?>
        </div>
        <div class="post-list-read-more">
            <a href="<?php echo get_the_permalink( $post->ID ); ?>"
               title="Go to <?php echo get_the_title( $post->ID ); ?>">
                Read more
            </a>
        </div>
    </div>
</div>

<hr class="wp-block-separator is-style-wide">