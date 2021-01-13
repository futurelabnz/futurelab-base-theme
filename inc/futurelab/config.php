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
            'templates' => [
                'view', 'somethingnew'
            ],
            'styles' => [
                'header.css'
            ],
            'js' => []
        ],
        'menu' => [
            'controller' => 'Menu',
            'templates' => [
                'view'
            ],
            'styles' => [
                'menu.css'
            ],
            'js' => []
        ],
        'footer' => [
            'controller' => 'Footer',
            'templates' => [
                'view'
            ],
            'styles' => [
                'footer.css'
            ],
            'js' => []
        ],
    ],
 );

