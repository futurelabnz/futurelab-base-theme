<?php
/*
 * Custom taxonomies
 */


add_action( 'init', 'fl_add_futurelab_teams' );
add_action( 'init', 'fl_add_futurelab_service_category' );

function fl_add_futurelab_teams() {

	$labels = array(
		'name'              => _x( 'Our teams', 'taxonomy general name', 'futurelab-base' ),
		'singular_name'     => _x( 'Our teams', 'taxonomy singular name', 'futurelab-base' ),
		'search_items'      => __( 'Search teams', 'futurelab-base' ),
		'all_items'         => __( 'All teams', 'futurelab-base' ),
		'parent_item'       => __( 'Parent team', 'futurelab-base' ),
		'parent_item_colon' => __( 'Parent team:', 'futurelab-base' ),
		'edit_item'         => __( 'Edit team', 'futurelab-base' ),
		'update_item'       => __( 'Update team', 'futurelab-base' ),
		'add_new_item'      => __( 'Add new team', 'futurelab-base' ),
		'new_item_name'     => __( 'New team name', 'futurelab-base' ),
		'menu_name'         => __( 'Teams', 'futurelab-base' ),
	);

	$args = array(
		'public'            => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'teams' )
	);

	register_taxonomy( 'fl_teams', array( 'fl_team_member' ), $args );
}

function fl_add_futurelab_service_category() {

	$labels = array(
		'name'              => _x( 'Service category', 'taxonomy general name', 'futurelab-base' ),
		'singular_name'     => _x( 'Service category', 'taxonomy singular name', 'futurelab-base' ),
		'search_items'      => __( 'Search service categories', 'futurelab-base' ),
		'all_items'         => __( 'All service categories', 'futurelab-base' ),
		'parent_item'       => __( 'Parent service category', 'futurelab-base' ),
		'parent_item_colon' => __( 'Parent service category:', 'futurelab-base' ),
		'edit_item'         => __( 'Edit service category', 'futurelab-base' ),
		'update_item'       => __( 'Update service category', 'futurelab-base' ),
		'add_new_item'      => __( 'Add new service category', 'futurelab-base' ),
		'new_item_name'     => __( 'New service category', 'futurelab-base' ),
		'menu_name'         => __( 'Service categories', 'futurelab-base' ),
	);

	$args = array(
		'public'            => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'services' )
	);

	register_taxonomy( 'fl_service_category', array( 'fl_services' ), $args );
}