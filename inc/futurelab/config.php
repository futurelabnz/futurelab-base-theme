<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'elements' => [
        'header' => [
            'view_template' => __DIR__.'/components/header/header.php',
            'style_path' => __DIR__.'/components/header/header.scss'
        ],
        'body'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.scss'
        ],
        'footer'=> [
            'view_template' => __DIR__.'/components/footer/footer.php',
            'style_path' => __DIR__.'/components/footer/footer.scss'
        ],
    ],
 );

