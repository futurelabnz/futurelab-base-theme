<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'elements' => [
        'head' => [
            'view_template' => __DIR__.'/components/head/head.php',
            'style_path' => __DIR__.'/components/head/head.css'
        ],
        'header' => [
            'view_template' => __DIR__.'/components/header/header.php',
            'style_path' => __DIR__.'/components/header/header.css'
        ],
        'body'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'footer'=> [
            'view_template' => __DIR__.'/components/footer/footer.php',
            'style_path' => __DIR__.'/components/footer/footer.css'
        ],
    ],
 );

