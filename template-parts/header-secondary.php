<?php
/*
 * If there is an active secondary menu
 */
$secondary_menu = '';
if( is_singular('fl_services')){
	$secondary_menu = wp_nav_menu( array(
		'theme_location' => 'services-menu',
		'menu_id'        => 'services-menu',
		'fallback_cb'    => null,
		'echo'           => false
	) );
}
else{
	$secondary_menu = wp_nav_menu( array(
		'theme_location' => 'menu-2',
		'menu_id'        => 'secondary-menu',
		'fallback_cb'    => null,
		'echo'           => false
	) );
}

if ( ! empty( $secondary_menu ) || $secondary_menu !== false ) :
	?>

    <nav class="secondary-menu grid-container fluid">
        <div class="grid-x align-self-middle">
            <div class="large-4"></div>
            <div class="large-4 flex-child-grow text-center">
				<?php echo $secondary_menu; ?>
            </div>
            <div class="large-4"></div>
        </div>
    </nav>

<?php endif; ?>

<?php
/**
 * If this is a single page and we need to show a sibling menu
 */
if ( is_singular() ):

	$siblings_menu = '';
	if ( $post->post_parent !== 0 ) {

		$siblings_menu = wp_list_pages( array(
			'child_of' => $post->post_parent,
			'title_li' => '',
			'echo'     => false,
			'orderby'  => 'menu'
		) );
	}

	if ( ! empty( $siblings_menu ) && $siblings_menu !== false ): ?>

        <nav class="secondary-menu grid-container fluid">
            <div class="grid-x align-self-middle">
                <div class="large-4"></div>
                <div class="large-4 flex-child-grow text-center">
                    <div class="menu-secondary-container">
                        <ul id="secondary-menu" class="menu">
							<?php echo $siblings_menu; ?>
                        </ul>
                    </div>
                </div>
                <div class="large-4"></div>
            </div>
        </nav>

	<?php endif; ?>
<?php endif; ?>

<?php
/*
 * If we need to show a widget
 * Front and other pages have different widget areas
 */
if ( is_front_page() ):

	if ( is_active_sidebar( 'home-secondary-header' ) ): ?>

        <nav class="secondary-menu grid-container fluid">
            <div class="grid-x align-self-middle">
                <div class="large-4"></div>
                <div class="large-4 flex-child-grow text-center">
					<?php dynamic_sidebar( 'home-secondary-header' ); ?>
                </div>
                <div class="large-4"></div>
            </div>
        </nav>

	<?php endif;
else:
	$widget_area = 'pages-secondary-header';
	if ( is_active_sidebar( 'pages-secondary-header' ) ): ?>

        <nav class="secondary-menu grid-container fluid">
            <div class="grid-x align-self-middle">
                <div class="large-4"></div>
                <div class="large-4 flex-child-grow text-center">
					<?php dynamic_sidebar( 'pages-secondary-header' ); ?>
                </div>
                <div class="large-4"></div>
            </div>
        </nav>

	<?php endif;
endif;
