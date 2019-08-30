<?php
/**
 * Returns the HTML for a breadcrumb element.
 *
 * @param $object
 *
 * @return string
 */

function get_futurelab_breadcrumbs( $object, $separator = '&gt;' ) {

	$html   = '<nav class="futurelab-breadcrumbs">';
	$crumbs = array();

	if ( is_singular( 'page' ) && ! is_front_page() && $object->post_parent !== 0 ) {

		$crumbs[0]['id']    = $object->ID;
		$crumbs[0]['link']  = get_the_permalink( $object->ID );
		$crumbs[0]['title'] = get_the_title( $object->ID );

		$parent_id = $object->post_parent;
		$i         = 1;

		while ( $parent_id > 1 ) {

			$parent_post = get_post( $parent_id );

			$crumbs[ $i ]['id']    = $parent_post->ID;
			$crumbs[ $i ]['link']  = get_the_permalink( $parent_post->ID );
			$crumbs[ $i ]['title'] = get_the_title( $parent_post->ID );

			$parent_id = $parent_post->post_parent;

		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$is_shop = is_shop();
	} else {
		$is_shop = false;
	}

	if ( false === $is_shop && ( is_tax() || is_archive() ) ) {

		$crumbs[0]['id']    = $object->term_id;
		$crumbs[0]['link']  = get_term_link( $object->term_id );
		$crumbs[0]['title'] = $object->name;

		$parent_id = $object->parent;
		$i         = 1;

		while ( $parent_id > 1 ) {

			$parent_term = get_term( $parent_id );

			$crumbs[ $i ]['id']    = $parent_term->term_id;
			$crumbs[ $i ]['link']  = get_term_link( $parent_term->term_id );
			$crumbs[ $i ]['title'] = $parent_term->name;

			$parent_id = $parent_term->parent;

		}

	}

	if ( ! empty( $crumbs ) ) {

		$current = $crumbs[0]['title'];
		$home    = '<a href="' . get_bloginfo( 'url' ) . '" rel="nofollow" title="Go to home">Home</a>&nbsp;' . $separator . '&nbsp;';
		unset( $crumbs[0] );
		$crumbs = array_reverse( $crumbs );

		$html .= $home;

		foreach ( $crumbs as $crumb ) {
			$html .= '<a href="' . $crumb['link'] . '" title="Go to ' . $crumb['title'] . '">' . $crumb['title'] . '</a>';
			$html .= '&nbsp;' . $separator . '&nbsp;';
		}

		$html .= $current;
		$html .= '</nav>';
	}

	if ( ! empty( $crumbs ) ) {
		return $html;
	} else {
		return '';
	}

}

function get_futurelab_menu( $post_id, $key, $position ) {

	$the_menu = '';

	if ( empty( $post_id ) || empty( $key ) || empty( $position ) ) {
		return $the_menu;
	}

	$menu = get_post_meta( $post_id, $key, true );

	if ( ! empty( $menu ) && $menu != 'no-menu' ) {
		$the_menu = wp_nav_menu( array(
			'theme-location'  => $position,
			'menu'            => $menu,
			'container_class' => $position . '-container',
			'echo'            => false,
			'items_wrap'      => '<ul id="' . $position . '" class="' . $position . '">%3$s</ul>'
		) );
	}

	return $the_menu;

}

function get_futurelab_title_meta( $post ) {

	$title_meta = '';

	if ( is_single() || is_page() ) {

		$title_meta = get_post_meta( $post->ID, 'fl_page_meta_title', true );

		if( ! empty( $title_meta ) ){
			return $title_meta;
		}

		switch ( $post->post_type ) {

			case 'fl_services':
					$title_meta = 'Services';
				break;
			case 'post':

				$term_links   = '';
				$parent_links = '';
				$terms        = get_the_terms( $post->ID, 'category' );

				if ( ! empty( $terms ) ) {
					$title_meta = $terms[0]->name;
				}

				break;
			case 'page':

				if( $post->parent > 0 ) {
					$title_meta = get_the_title( $post->parent );
				}
				
				break;
			default:
				break;
		}
	}

	if( is_archive() ){
		$term = get_queried_object();
		$title_meta = get_term_field( 'name', $term->parent );
	}

	return $title_meta;

}

/**
 *
 */
function get_futurelab_title( $post ) {

	$title = '';

	if ( is_single() || is_page() ) {

		$title = esc_html( get_the_title() );
	}

	if ( is_archive() ) {
		$term = get_queried_object();
		$title   = $term->name;
	}

	return $title;
}

/**
 * Returns the subtitle for the banner header, based on post type.
 * NB: Do NOT escape - this may contain HTML.
 *
 * @param $post
 *
 * @return string
 */
function get_futurelab_sub_title( $post ) {

	$sub_title = '';

	if ( is_single() || is_page() ) {
		switch ( $post->post_type ) {

			case 'fl_services':
			case 'post':
			case 'page':
				$sub_title = get_post_meta( $post->ID, 'fl_page_subheadline', true );
				break;
			default:
				break;

		}
	}

	if ( is_archive() ) {
		$term = get_queried_object();
		$sub_title = $term->description;
	}

	return $sub_title;
}

