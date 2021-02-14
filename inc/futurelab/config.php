<?php
/**
 * Base Config File for loading elements
 */

 return array (
    'environment' => 'development',
    'components_path' => 'inc' . DIRECTORY_SEPARATOR . 'futurelab' . DIRECTORY_SEPARATOR . 'components',
    'menu_positions' => [
        'primary_menu' => esc_html__( 'Primary menu', 'futurelab-base-theme2' ),
        'footer_menu' => esc_html__( 'Footer menu', 'futurelab-base-theme2' ),
        'top_menu' => esc_html__( 'Top menu', 'futurelab-base-theme2' ),
    ],
    'widgets' => [
        [
            'name'        => 'Footer widgets area 1',
            'id'          => 'footer_widgets_area_1',
            'description' => 'Content for "Footer widgets area 1"',
        ],
        [
            'name'        => 'Footer widgets area 2',
            'id'          => 'footer_widgets_area_2',
            'description' => 'Content for "Footer widgets area 2"',
        ],
        [
            'name'        => 'Footer widgets area 3',
            'id'          => 'footer_widgets_area_3',
            'description' => 'Content for "Footer widgets area 3"',
        ],
        [
            'name'        => 'Footer widgets area 4',
            'id'          => 'footer_widgets_area_4',
            'description' => 'Content for "Footer widgets area 4"',
        ]
    ],
    'elements' => [
        'header' => [
            'controller' => 'Header',
            'styles' => [
                'header.css'
            ],
            'js' => []
        ],
        'header2' => [
            'controller' => 'Header2',
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
    'custom_post_types' => [
        [
            'id' => 'portfolio',
            'name' => [
                'singular' => 'Portfolio',
                'plural' => 'Portfolios'
            ],
            'description' => 'Portfolio items',
            'supports' => [
                'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'
            ]
        ]
    ]
 );

