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
<html <?php language_attributes(); ?> style="font-size:100%">

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
    <header id="masthead" class="site-header">
        <div class="grid-x header-inner-container alignwide">
            <!-- desktop tablet site logo -->
            <div class="site-branding header-inner-left large-3 medium-6 hide-for-small-only">
				<?php the_custom_logo(); ?>
            </div>

            <!-- Additional navigation button for tablets -->
            <?php
				/* Optional button added through customizer */
				$button = get_theme_mod( 'additional_navigation_button' );
				if ( ! empty( $button ) ) : ?>
                    <div class="grid-x tablets-additional-button-container medium-6 show-for-medium-only align-right">
                      <div class="wp-block-button">
                        <a title="<?php echo esc_attr( $button ); ?>" class="wp-block-button__link">
							<?php echo esc_html( $button ); ?>
                        </a>
                    </div>
                </div>
			<?php endif; ?>
            
            <!-- site nav mobile header and other elements -->
            <div class="grid-x header-inner-right large-9 medium-12 small-12 align-self-middle align-right">
                    <!-- site navigation -->
                    <nav id="site-navigation"
                         class="grid-x main-navigation large-8 medium-12 small-12 align-self-middle">
                         
                         <!-- mobile header -->
                        <div class="grid-x mobile-inner-container small-12 text-center align-middle show-for-small-only">
                            <!-- mobile logo -->
                            <div class="mobile-logo mobile-inner-left show-for-small-only small-10 align-middle">
                                <?php if ( display_header_text() ) : ?>
                                    <h1 class="mobile-logo-text">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                            <?php bloginfo( 'name' ); ?>
                                        </a>
                                    </h1>
                                <?php else : ?>
                                    <?php ?>
                                    <?php the_custom_logo(); ?>
                                <?php endif; ?>
                            </div>
                            <!-- hamburger button -->
                            <div class="mobile-inner-right small-2 align-middle">
                                <button id="mobile-menu" class="toggle-menu hamburger-button" aria-controls="mobile-menu"
                                        aria-expanded="false"
                                        style="border:0;background: none;font-size:24px;padding: 20px 10px;">
                                    <i class="fa fa-bars">&nbsp;</i>
                                </button>
                            </div>
                        </div>

                        <!-- desktop and tablets nav menu -->
                        <div class="grid-x normal-size-primary-menu-container hide-for-small-only align-center">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu'
							) );
							?>
                        </div>
                        <!--  mobile nav menu -->
                        <div class="grid-x small-12 mobile-primary-menu-button-container show-for-small-only align-center">
                                <?php
                                /* Optional button added through customizer */
								$phone_number = esc_html( get_theme_mod( 'business_number' ) );
								//$cleaned_number = ereg_replace( "[^0 - 9]", '', $phone_number);
								//todo clean number
								$cleaned_number = str_replace( '-', '', $phone_number );
								$cleaned_number = str_replace( ' ', '', $cleaned_number );
								$cleaned_number = str_replace( '+', '', $cleaned_number );
								$cleaned_number = $phone_number;
								if ( ! empty( $phone_number ) ):
									$number_button = '<div class="wp-block-button mobile-phone-link aligncenter">';
									$number_button .= '<a title="' . esc_attr( $button ) . '" target="_blank" href="tel:' . $cleaned_number . '" class="wp-block-button__link" style="color:#ffffff;">';
									$number_button .= 'CALL ' . $phone_number . ' NOW</a></div>';
                                endif;
                                
								/* Optional button added through customizer */
								$book_button   = '';
								$button        = get_theme_mod( 'additional_navigation_button' );
								$button_url    = get_theme_mod( 'additional_navigation_button_url' );
								$button_target = get_theme_mod( 'additional_navigation_button_target' );
								if ( ! empty( $button ) ) :
									$book_button = '
                                    <div class="wp-block-button additional-navigation-button aligncenter">';
									$book_button .= '<a title="' . esc_attr( $button ) . '" target="' . esc_attr( $button_target ) . '"
                                                            href="' . $button_url . '" class="wp-block-button__link">';
									$book_button .= esc_html( $button ) . '</a></div>';
                                endif;
                                 ?>
                                <!-- inner container of mobile menu -->
                                <div class="mobile-menu-container">
                                    <!-- render primary menu with additional buttons if exist -->
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
                     
                    <!-- font size switcher -->
                    <?php 
                        $is_show_adjust_fontsize = get_theme_mod( 'additional_navigation_addjust_fontsize' );
                        if ( $is_show_adjust_fontsize) {
                            ?>
                            <div class="adjust-fontsize large-1 medium-12 small-12 align-self-middle ">
                                <div class="adjust">
                                    <div class="normal-text-size-container">
                                        <span class="normal-text-size" tabindex="0" role="button" aria-label="Normal font size">A</span>
                                        <span class="normal-text-size-discription">Normal font size</span>
                                    </div>
                                    <span class='divider'>
                                        | 
                                    </span>
                                     <div class="larger-text-size-container">
                                         <span class="larger-text-size" tabindex="0" role="button" aria-label="Larger font size">A+</span>
                                         <span class="larger-text-size-discription">Larger font size</span>
                                     </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>

                    <!-- Additional navigation button for desktops-->
                    <div class="grid-x normal-addi-nav-btn-container large-3 show-for-large align-right">
						<?php
						/* Optional button added through customizer */
						$button        = get_theme_mod( 'additional_navigation_button' );
						$button_url    = get_theme_mod( 'additional_navigation_button_url' );
						$button_target = get_theme_mod( 'additional_navigation_button_target' );
						if ( ! empty( $button ) ) : ?>
                            <div class="wp-block-button additional-navigation-button">
                                <a title="<?php echo esc_attr( $button ); ?>"
                                   target="<?php echo esc_attr( $button_target ); ?>"
                                   href="<?php echo $button_url; ?>" class="wp-block-button__link">
									<?php echo esc_html( $button ); ?>
                                </a>
                            </div>
						<?php endif; ?>
                    </div>
            </div>
        </div>
    </header><!-- #masthead -->

<?php get_template_part( 'template-parts/header', 'secondary' ); ?>

    <div id="content" class="site-content">


<?php echo get_futurelab_breadcrumbs( get_queried_object() ); ?>