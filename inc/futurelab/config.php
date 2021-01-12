<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'elements' => [
        'header' => [
            'controller_path' => './components/header/header.php',
            'view_template' => './components/header/header.html',
            'style_path' => './components/header/header.scss'
        ],
        'body'=> [
            'controller_path' => './components/body/body.php',
            'view_template' => './components/body/body.html',
            'style_path' => './components/body/body.scss'
        ],
        'footer'=> [
            'controller_path' => './components/footer/footer.php',
            'view_template' => './components/footer/footer.html',
            'style_path' => './components/footer/footer.scss'
        ],
    ],
 );

