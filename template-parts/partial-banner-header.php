<?php
/*
 * The banner containing header image, selected menu, title, and subtitle of
 * some post type single pages
 */

$thumbnail_url = '';
	$thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'full' ); ?>
    <div class="banner-header-image hide-for-small-only"
         style="background-image: url('<?php echo $thumbnail_url; ?>');">
        <div class="banner-header-overlay">
            <div class="alignwide">
                <header class="banner-header-titles">
					<?php
					$title_meta = get_futurelab_title_meta( $post );
					$title      = get_futurelab_title( $post );
					$sub_title  = get_futurelab_sub_title( $post );
					if ( ! empty( $title_meta ) ):
						echo '<div class="title-meta">' . $title_meta . '</div>';
					endif;
					if ( ! empty( $title ) ):
						echo '<h1>' . $title . '</h1>';
					endif;
					if ( ! empty( $sub_title ) ):
						echo '<h2>' . $sub_title . '</h2>';
					endif;
					?>
					<?php echo get_futurelab_menu( $post->ID, 'fl_banner_menu', 'banner-header-menu' ); ?>
                </header>
            </div>
        </div>
        <div class="down-arrow-container"
             style="background-image: url( '<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_arrow_scroll_down.svg'; ?>' );">
            <a href="#primary">&nbsp;</a>
        </div>
    </div>

	<?php include( get_template_directory() . '/template-parts/mobile-banner-header.php' ); ?>
