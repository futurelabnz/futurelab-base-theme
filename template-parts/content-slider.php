<?php
$slider = get_post( get_theme_mod('home_slider'));
?>
    <div class="slider-area grid-container fluid">

		<?php
		echo $slider->post_content;
		?>

    </div>