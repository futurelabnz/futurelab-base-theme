<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package futurelab_base
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer grid-container-fluid">
    <div class="site-info-container grid-container-fluid">
        <div class="site-info grid-x">

            <?php
            $widget_areas = array('footer-col-1', 'footer-col-2', 'footer-col-3');
            $sidebars     = false;
            foreach ($widget_areas as $widget_area) {
                if (is_active_sidebar($widget_area)) {
                    $sidebars = true;
                }
            }
            if ($sidebars === true) : ?>
                <div class="large-12 alignwide site-footer-widget-container">
                    <div class="grid-x grid-padding-x">
                        <?php
                        foreach ($widget_areas as $widget_area) :
                            $width = ($widget_area == 'footer-col-1') ? 'large-6 medium 12' : 'large-3 medium 6'
                            ?>

                            <div class="<?php echo $width; ?> small-12 flex-child-shrink align-self-top">
                                <?php dynamic_sidebar($widget_area); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="large-12 medium-12 small-12 medium-order-2 small-order-1 flex-child-grow">
                    <div class="grid-x grid-padding-x">
                        <div class="large-4 medium-6 cell text-right">
                            <?php $phone_number = esc_html(get_theme_mod('business_number'));
                            echo (!empty($phone_number)) ? '<i class="fas fa-phone"></i> ' . $phone_number : ''; ?>
                        </div>
                        <div class="large-4 medium-6 small-12 cell">
                            <?php $address = nl2br(get_theme_mod('physical_address')); ?>
                            <strong><?php echo esc_html(get_theme_mod('business_name')); ?></strong>
                            <br>
                            <?php echo (!empty($address)) ? $address : ''; ?>
                        </div>
                        <div class="large-4 medium-6 small-12 cell">
                            <?php
                            $social_media_accounts = get_option('fl_social_media', false);

                            if ($social_media_accounts !== false && !empty($social_media_accounts)) :
                                $social_media_order = get_option('fl_social_media_order', false);
                                $social_profiles   = array();

                                foreach ($social_media_accounts as $key => $value) {
                                    if (!empty($social_media_order[$key])) {
                                        $social_profiles[$key] = $social_media_order[$key];
                                    }
                                }

                                foreach ($social_profiles as $key => $value) : ?>
                                    <a href="<?php echo esc_url($value); ?>" title="Find us on <?php echo esc_attr(ucfirst(substr($key, 3))); ?>">
                                        <i class="fa <?php echo esc_attr($key); ?>"></i>&nbsp;
                                    </a>
                                    &nbsp;
                                <?php endforeach;
                        endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="site-copyright grid-x alignwide">
        <div class="large-6 medium-6 small-12 cell align-self-bottom tiny-text">
            &copy; <?php echo esc_html(get_theme_mod('business_name')); ?> <?php echo date('Y', strtotime('now')); ?>
        </div>
        <div class="large-6 medium-6 small-12 cell align-self-bottom text-right tiny-text">
            Built by FutureLab
        </div>
    </div>
    <!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- SCRIPTS AFTER BODY -->
<script>
    var swiperSliders = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });

    var swiperCarousels = new Swiper('.swiper-carousel-container', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });

    var swiperGalleries = new Swiper('.swiper-gallery-container', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // foundation instance for Sticky header
    // jQuery(document).foundation();
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {
        myFunction()
    };

    // Get the header
    var header = document.getElementById("masthead");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky-header");
        } else {
            header.classList.remove("sticky-header");
        }
    }

    // scolldown arrow for header event listener
    (function() {
        'use strict';

        try {
            const btnScrollDown = document.querySelector('.down-arrow-container');
            const scrollDownHeight = document.querySelector(
                '.banner-header-image'
            ).clientHeight;

            // console.log('scrollDownHeight', scrollDownHeight);

            function scrollDown() {
                (function scroll() {
                    // window.scrollTo desnot support IE
                    window.scrollTo({
                        top: scrollDownHeight - 100,
                        left: 0,
                        behavior: 'smooth',
                    });
                }());
            }
            btnScrollDown.addEventListener('click', scrollDown);
        } catch (error) {
            console.log('slider frontend.js error', error);
        }
    }());
</script>


</body>

</html>