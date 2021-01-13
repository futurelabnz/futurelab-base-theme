<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'elements' => [
        'header' => [
            'view_template' => __DIR__.'/components/header/header.php',
            'style_path' => __DIR__.'/components/header/header.css'
        ],
        'top_desktop_menu'=> [
            'view_template' => __DIR__.'/components/top_desktop_menu/top_desktop_menu.php',
            'style_path' => __DIR__.'/components/top_desktop_menu/top_desktop_menu.css'
        ],
        'top_mobile_menu'=> [
            'view_template' => __DIR__.'/components/top_mobile_menu/top_mobile_menu.php',
            'style_path' => __DIR__.'/components/top_mobile_menu/top_mobile_menu.css'
        ],
       /* 
       'slider'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'news'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'tile'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'team_member'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'accordion'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        'footer_menu'=> [
            'view_template' => __DIR__.'/components/body/body.php',
            'style_path' => __DIR__.'/components/body/body.css'
        ],
        */
        'footer'=> [
            'view_template' => __DIR__.'/components/footer/footer.php',
            'style_path' => __DIR__.'/components/footer/footer.css'
        ],
    ],
 );

