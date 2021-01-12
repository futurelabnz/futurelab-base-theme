<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'elements' => [
        'header' => [
            'controller_path' => './comonents/header/header.php',
            'view_template' => './comonents/header/header.html',
            'style_path' => './comonents/header/header.scss'
        ],
        'body'=> [
            'controller_path' => './comonents/body/body.php',
            'view_template' => './comonents/body/body.html',
            'style_path' => './comonents/body/body.scss'
        ],
        'footer'=> [
            'controller_path' => './comonents/footer/footer.php',
            'view_template' => './comonents/footer/footer.html',
            'style_path' => './comonents/footer/footer.scss'
        ],
    ],
 );

