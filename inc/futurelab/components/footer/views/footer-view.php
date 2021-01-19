<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="container">
      <div class="row">
        <div class="col-12 col-md">
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
  </div>
</footer>