<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package futurelab_base
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Montserrat:300,400,500,600']
                }
            });
        </script>

		<?php wp_head(); ?>

    </head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'futurelab-base' ); ?>
    </a>
    <header id="masthead" class="site-header grid-container-fluid">
        <div class="grid-x alignwide">
            <div class="site-branding large-3 medium-6 hide-for-small-only flex-child-grow">
				<?php the_custom_logo(); ?>
            </div>

            <div class="medium-5 show-for-medium-only cell flex-child-shrink small-margin align-self-middle align-right">
				<?php
				/* Optional button added through customizer */
				$button = get_theme_mod( 'additional_navigation_button' );
				if ( ! empty( $button ) ) : ?>
                    <div class="wp-block-button alignleft">
                        <a title="<?php echo esc_attr( $button ); ?>"
                           class="wp-block-button__link"
                           aria-label=" Click to <?php echo esc_attr( $button ); ?>"
                        >
							<?php echo esc_html( $button ); ?>
                        </a>
                    </div>
				<?php endif; ?>
            </div>

            <div class="large-9 medium-12 small-12 align-self-middle align-right">
                <div class="grid-x grid-padding-x align-right">
                    <nav id="site-navigation"
                         class="main-navigation large-9 medium-12 small-12 flex-child-grow alignright align-self-middle">
                        <div class="small-12 text-center align-middle show-for-small-only">
                            <div class="grid-x">
                                <div class="show-for-small-only small-10 mobile-logo align-middle">
									<?php if ( display_header_text() ) : ?>
                                        <h1 class="mobile-logo-text">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                               rel="home"
                                               aria-label="Link to home"
                                            >
												<?php bloginfo( 'name' ); ?>
                                            </a>
                                        </h1>
									<?php else : ?>
										<?php ?>
										<?php the_custom_logo(); ?>
									<?php endif; ?>
                                </div>
                                <div class="small-2 align-middle">
                                    <button id="mobile-menu" class="toggle-menu" aria-controls="mobile-menu"
                                            aria-expanded="false"
                                            style="border:0;background: none;font-size:24px;padding: 20px 10px;">
                                        <i class="fa fa-bars">&nbsp;</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hide-for-small-only align-right alignright" style="padding-right:20px;">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
							?>
                        </div>
                        <div class="show-for-small-only small-12">
                            <div>
								<?php
								/* Optional button added through customizer */
								$book_button   = '';
								$button        = get_theme_mod( 'additional_navigation_button' );
								$button_url    = get_theme_mod( 'additional_navigation_button_url' );
								$button_target = get_theme_mod( 'additional_navigation_button_target' );
								if ( ! empty( $button ) ) :
									$book_button = '
                                    <div class="wp-block-button aligncenter">';
									$book_button .= '<a title="' . esc_attr( $button ) . '" aria-label="Click to ' . esc_attr( $button ) . '" target="' . esc_attr( $button_target ) . '"
                                                            href="' . $button_url . '" class="wp-block-button__link">';
									$book_button .= esc_html( $button ) . '</a></div>';
								endif;
								/* Optional button added through customizer */
								$phone_number = esc_html( get_theme_mod( 'business_number' ) );
								//$cleaned_number = ereg_replace( "[^0 - 9]", '', $phone_number);
								//todo clean number
								$cleaned_number = str_replace( '-', '', $phone_number );
								$cleaned_number = str_replace( ' ', '', $cleaned_number );
								$cleaned_number = str_replace( '+', '', $cleaned_number );
								$cleaned_number = $phone_number;
								if ( ! empty( $phone_number ) ):
									$number_button = '<div class="wp-block-button aligncenter">';
									$number_button .= '<a aria-label="Click to call ' . esc_attr( $button ) . '" title="' . esc_attr( $button ) . '" target="_blank" href="tel:' . $cleaned_number . '" class="wp-block-button__link" style="color:#ffffff;">';
									$number_button .= 'CALL ' . $phone_number . ' NOW</a></div>';
								endif; ?>
                            </div>
                            <div class="mobile-menu-container">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu-mobile',
									'items_wrap'     => '<ul id="%1$s" class="%2$s"><li class="mobile-menu-button">' . $number_button . '</li><li class="mobile-menu-button">' . $book_button . '</li>%3$s</ul>'
								) );
								?>
                            </div>
                        </div>
                    </nav>
                    <div class="show-for-large large-2 flex-child-shrink small-margin alignleft">
						<?php
						/* Optional button added through customizer */
						$button        = get_theme_mod( 'additional_navigation_button' );
						$button_url    = get_theme_mod( 'additional_navigation_button_url' );
						$button_target = get_theme_mod( 'additional_navigation_button_target' );
						if ( ! empty( $button ) ) : ?>
                            <div class="wp-block-button alignleft">
                                <a title="<?php echo esc_attr( $button ); ?>"
                                   target="<?php echo esc_attr( $button_target ); ?>"
                                   aria-label="Click to <?php echo esc_attr( $button ); ?>"
                                   href="<?php echo $button_url; ?>" class="wp-block-button__link">
									<?php echo esc_html( $button ); ?>
                                </a>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

<?php get_template_part( 'template-parts/header', 'secondary' ); ?>

    <div id="content" class="site-content">


<?php echo get_futurelab_breadcrumbs( get_queried_object() ); ?>
