<?php 
	require_once (get_stylesheet_directory() . '/inc/futurelab/futurelab.class.php');
	$futurelab = new \FutureLab\FutureLabCore();
?>


<header id="masthead" class="site-header">
	<?php 
		// echo $futurelab->get_element_content( 'menu', 'top' );
	?>
	
	<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="site-branding navbar-brand my-0 mr-md-auto font-weight-normal">
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
	</nav>
</header>