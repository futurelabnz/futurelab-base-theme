<nav id="site-navigation" class="main-navigation my-2 my-md-0 mr-md-3">
	<?php
		wp_nav_menu([
			'theme_location'		=> 'primary',
			'depth'						 => 2,
			'container'				 => 'div',
			'container_class'	 => 'collapse navbar-collapse',
			'container_id'			=> 'bs-example-navbar-collapse-1',
			'menu_class'				=> 'nav navbar-nav',
			'fallback_cb'			 => 'WP_Bootstrap_Navwalker::fallback',
			'walker'						=> new WP_Bootstrap_Navwalker(),
		]);
	?>
</nav>
<!-- comment -->