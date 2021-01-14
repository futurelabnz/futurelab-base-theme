<?php 
	require_once (get_stylesheet_directory() . '/inc/futurelab/futurelab.class.php');
	$futurelab = new \FutureLab\FutureLabCore();
?>


<header id="masthead" class="site-header">
	<?php 
		echo $futurelab->get_element_content( 'menu', 'top' );
	?>
	
	<div class="navbar navbar-light shadow-sm">
		<div class="container d-flex justify-content-between">
			<div class="site-branding my-0 mr-md-auto font-weight-normal">
				<?php
				if ( has_custom_logo() ):
					the_custom_logo();
				else:
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;
					
					$futurelab_base_theme2_description = get_bloginfo( 'description', 'display' );
					if ( $futurelab_base_theme2_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $futurelab_base_theme2_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
	 			<?php endif ?> 

			</div><!-- .site-branding -->
			<?php 
				echo $futurelab->get_element_content( 'menu' );
			?>
		</div>
	</div>
</header>