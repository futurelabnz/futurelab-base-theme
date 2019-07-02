<?php
/**
 * Mobile version for all banner headers
 */ ?>
<div class="show-for-small-only grid-container grid-padding-x">
    <header class="small-12 mobile-banner-header-titles">
		<?php the_title( '<h3>', '</h3>' ); ?>
        <h1>
			<?php echo esc_html( get_post_meta( $post->ID, 'fl_page_headline', true ) ); ?>
        </h1>
        <h2>
			<?php echo esc_html( get_post_meta( $post->ID, 'fl_page_subheadline', true ) ); ?>
        </h2>
    </header>
</div>