<header id="masthead" class="site-header">
	<nav class="navbar navbar-top navbar-expand-lg navbar-light mb-3 bg-white border-bottom shadow-sm" role="navigation-top">
		<div class="container">
			<?php 
				echo $args['futurelab']->get_element_content( 'menu', 'top' );
			?>
		</div>
	</nav>
	
	<nav class="navbar navbar-bottom navbar-expand-lg navbar-light mb-3 bg-white border-bottom shadow-sm" role="navigation-bottom">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-primary-menu-navbar-collapse-1" aria-controls="bs-primary-menu-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'futurelab-base-theme2' ); ?>">
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
				echo $args['futurelab']->get_element_content( 'menu' );
			?>
		</div>
	</nav>
</header>