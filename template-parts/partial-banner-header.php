<?php
/*
 * The banner containing header image, selected menu, title, and subtitle of
 * some post type single pages
 */

$thumbnail_url = '';
if ( has_post_thumbnail() ):
	$thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'full' ); ?>
<div class="banner-header-image hide-for-small-only" style="background-image: url('<?php echo $thumbnail_url; ?>');">
    <div class="banner-header-overlay">
        <div class="alignwide">
            <header class="banner-header-titles">
                <?php 
                if( $h3 = get_futurelab_header_h3( $post ) ):
                    echo '<h3>'.get_futurelab_header_h3( $post ).'</h3>'; 
                endif;
                if( $h1 = get_futurelab_header_h1( $post ) ):
                    echo '<h1>'.get_futurelab_header_h1( $post ).'</h1>'; 
                endif;
                if( $h2 = get_futurelab_header_h2( $post ) ):
                    echo '<h2>'.get_futurelab_header_h2( $post ).'</h2>'; 
                endif;
                ?>
				<?php echo get_futurelab_menu( $post->ID, 'fl_banner_menu', 'banner-header-menu' ); ?>
            </header>
        </div>
    </div>
    <div class="down-arrow-container" style="background-image: url( '<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_arrow_scroll_down.svg'; ?>' );">
        <a href="#primary">&nbsp;</a>
    </div>
</div>

<?php include( get_template_directory() . '/template-parts/mobile-banner-header.php' ); ?>

<?php endif; ?>