<footer id="colophon" class="site-footer">
  <div class="site-info container">
      <div class="row">
        <div class="col-12 col-lg-6 col-md">
          <?php 
              $widget_area = "footer_widgets_area_1";
              if ( is_active_sidebar( $widget_area ) ) {
                dynamic_sidebar( $widget_area );
              }
          ?>
        </div>
        <div class="col-6 col-md">
          <?php 
              $widget_area = "footer_widgets_area_2";
              if ( is_active_sidebar( $widget_area ) ) {
                dynamic_sidebar( $widget_area );
              }
          ?>
        </div>
        <div class="col-6 col-md">
          <?php 
                $widget_area = "footer_widgets_area_3";
                if ( is_active_sidebar( $widget_area ) ) {
                  dynamic_sidebar( $widget_area );
                }
          ?>
        </div>
        <div class="col-6 col-md">
          <?php 
                $widget_area = "footer_widgets_area_4";
                if ( is_active_sidebar( $widget_area ) ) {
                  dynamic_sidebar( $widget_area );
                }
          ?>
        </div>
      </div>
  </div><!-- .site-info -->
</footer><!-- #colophon -->