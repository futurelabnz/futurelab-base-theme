<?php
/**
 * Mobile version for all banner headers
 */ ?>
<div class="show-for-small-only grid-container grid-padding-x">
    <header class="small-12 mobile-banner-header-titles">
		<div class="meta-title">
            <?php echo get_futurelab_title_meta( $post ); ?>
        </div>
        <h1>
			<?php echo get_futurelab_title( $post ); ?>
        </h1>
        <h2>
			<?php echo get_futurelab_sub_title( $post ); ?>
        </h2>
    </header>
</div>
