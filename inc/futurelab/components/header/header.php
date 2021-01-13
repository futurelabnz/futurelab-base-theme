<?php
function themename_custom_header_setup() {
    $args = array(
        'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
        'default-text-color' => '543',
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>FutureLab</title>
  <meta name="description" content="FutureLab Master Website">
  <meta name="author" content="FutureLab">
    <?php wp_head();?>
</head>
<body>