<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'components_path' => 'components',
    'elements' => [
        'header' => [
            'controller' => 'Header',
            'styles' => [
                ''
            ],
            'js' => []
        ],
        'menu' => [
            'controller' => 'Menu',
            'styles' => [
                'menu.css'
            ],
            'js' => []
        ],
        'footer' => [
            'controller' => 'Footer',
            'styles' => [
                'footer.css'
            ],
            'js' => []
        ],
    ],
    'global' => [
        'js' => [
            [
                'name' => 'bootstrap',
                'path' => '/vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
                'dependent_on' => ['jquery'],
            ],
            [
                'name' => 'jquery',
                'path' => '/vendor/components/jquery/jquery.min.js',
                'dependent_on' => null,
            ]
        ],
        'css' => [
            [
                'name' => 'bootstrap',
                'path' => '/vendor//twbs/bootstrap/dist/css/bootstrap.min.css',
                'dependent_on' => null,
            ]
        ]
    ]
 );

