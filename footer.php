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

<footer id="colophon" class="site-footer">
    <div class="site-info-container">
        <div class="grid-x site-info">

            <?php
            $widget_areas = array('footer-col-1', 'footer-col-2', 'footer-col-3');
            $sidebars     = false;
            foreach ($widget_areas as $widget_area) {
                if (is_active_sidebar($widget_area)) {
                    $sidebars = true;
                }
            }
            if ($sidebars === true) : ?>
                <div class="grid-x site-footer-widget-container large-12 alignwide">
                    <?php
                    foreach ($widget_areas as $widget_area) :
                        $width = ($widget_area == 'footer-col-1') ? 'site-footer-widget large-6 medium-12' : 'site-footer-widget large-3 medium-6'
                        ?>

                        <div class="<?php echo $width; ?> small-12">
                            <?php dynamic_sidebar($widget_area); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="grid-x site-footer-widget-container large-12 medium-12 small-12 medium-order-2 small-order-1">
                    <div class="site-footer-widget-1 large-4 medium-6 cell text-right">
                        <?php $phone_number = esc_html(get_theme_mod('business_number'));
                        echo (!empty($phone_number)) ? '<i class="fas fa-phone"></i> ' . $phone_number : ''; ?>
                    </div>
                    <div class="site-footer-widget-2 large-4 medium-6 small-12 cell">
                        <?php $address = nl2br(get_theme_mod('physical_address')); ?>
                        <strong><?php echo esc_html(get_theme_mod('business_name')); ?></strong>
                        <br>
                        <?php echo (!empty($address)) ? $address : ''; ?>
                    </div>
                    <div class="site-footer-widget-3 large-4 medium-6 small-12 cell">
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
            <?php endif; ?>
        </div>
    </div>

    <div class="grid-x site-copyright alignwide">
        <div class="site-copyright-left large-6 medium-6 small-12 cell align-self-bottom tiny-text">
            &copy; <?php echo esc_html(get_theme_mod('business_name')); ?> <?php echo date('Y', strtotime('now')); ?>
        </div>
        <div class="site-copyright-right large-6 medium-6 small-12 cell align-self-bottom text-right tiny-text">
            Built by FutureLab
        </div>
    </div>
    <!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


</body>

</html>