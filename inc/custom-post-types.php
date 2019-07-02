<?php
/**
 * Custom content types for FutureLab base
 */


add_action( 'init', 'fl_add_services' );
add_action( 'init', 'fl_add_team_members' );


function fl_add_services() {

// Content type for daily news archive
	register_post_type( 'fl_services',
		array(
			'labels'                => array(
				'name'               => __( 'Services', 'futurelab-base' ),
				'singular_name'      => __( 'Services', 'futurelab-base' ),
				'add_new_item'       => __( 'Add service', 'futurelab-base' ),
				'edit_item'          => __( 'Edit service', 'futurelab-base' ),
				'new_item'           => __( 'New service', 'futurelab-base' ),
				'all_items'          => __( 'All services', 'futurelab-base' ),
				'view_item'          => __( 'View service', 'futurelab-base' ),
				'search_items'       => __( 'Search services', 'futurelab-base' ),
				'not_found'          => __( 'No services found', 'futurelab-base' ),
				'not_found_in_trash' => __( 'No services found in trash', 'futurelab-base' )
			),
			'show_in_rest'          => true,
			'rest_base'             => 'services',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'public'                => true,
			'hierarchical'          => true,
			'has_archive'           => true,
			'menu_position'         => 5,
			'supports'          => array(
				'title',
				'editor',
				'thumbnail',
				'author',
				'excerpt',
				'custom-fields',
				'revisions',
				'post-formats',
				'page-attributes'
			),
			'show_in_nav_menus' => true,
			'rewrite'           => array( 'slug' => 'service' ),
			'taxonomies'        => array( 'service_category' )
		)
	);
}

function fl_add_team_members() {

// Content type for daily news archive
	register_post_type( 'fl_team_member',
		array(
			'labels'                => array(
				'name'               => __( 'Team members', 'futurelab-base' ),
				'singular_name'      => __( 'Team member', 'futurelab-base' ),
				'add_new_item'       => __( 'Add team member', 'futurelab-base' ),
				'edit_item'          => __( 'Edit team member', 'futurelab-base' ),
				'new_item'           => __( 'New team member', 'futurelab-base' ),
				'all_items'          => __( 'All team members', 'futurelab-base' ),
				'view_item'          => __( 'View team members', 'futurelab-base' ),
				'search_items'       => __( 'Search team members', 'futurelab-base' ),
				'not_found'          => __( 'No team members found', 'futurelab-base' ),
				'not_found_in_trash' => __( 'No team members found in trash', 'futurelab-base' )
			),
			'show_in_rest'          => true,
			'rest_base'             => 'team-members',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'public'                => true,
			'has_archive'           => true,
			'menu_position'         => 5,
			'supports'              => array(
				'title',
				'editor',
				'thumbnail',
				'author',
				'excerpt',
				'custom-fields',
				'revisions',
				'post-formats'
			),
			'show_in_nav_menus'     => true,
			'rewrite'               => array( 'slug' => 'team-members' ),
			'taxonomies'            => array( 'fl_teams' )
		)
	);
}