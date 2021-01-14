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
                ''
            ],
            'js' => []
        ],
    ],
    'global' => [
        'js' => [
            [
                'name' => 'bootstrap',
                'path' => '/vendor/bootstrap/js/bootstrap.min.js',
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
                'path' => '/vendor/bootstrap/css/bootstrap.min.css',
                'dependent_on' => null,
            ]
        ]
    ]
 );

