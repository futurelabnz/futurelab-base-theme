	<?php
		wp_nav_menu([
			'theme_location'	=> 'top_menu',
			'depth'				=> 2,
			'container'			=> 'div',
			'container_class'	=> 'collapse navbar-collapse',
			'container_id'		=> 'bs-example-navbar-collapse-1',
			'menu_class'		=> 'nav navbar-nav ml-auto',
			'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
			'walker'			=> new WP_Bootstrap_Navwalker(),
		]);
	?>
<!-- comment -->