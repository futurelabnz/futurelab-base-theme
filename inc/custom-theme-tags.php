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

	if ( is_tax() || is_archive() ) {

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

function get_futurelab_header_h3( $post ) {

	$h3 = '';

	if( is_single() || is_page() ) {
		switch ( $post->post_type ) {


			case 'fl_services':

				$is_parent = false;

				if ( $post->post_parent !== 0 ) {
					$h3 = get_the_title( $post->post_parent );
				}
				if ( $post->post_parent === 0 ) {
					$is_parent = true;
					$h3        = get_the_title( $post->ID );
				}

				break;

			case 'post':

				$term_links   = '';
				$parent_links = '';
				$terms        = get_the_terms( $post->ID, 'category' );

				if ( ! empty( $terms ) ) {

					foreach ( $terms as $term ) {
						if ( $term->parent > 0 ) {
							$term_parents[] = $term->parent;
						}
						$term_links .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '" title="Go to' . $term->name . '">' . $term->name . '</a>&nbsp;';
					}
					if ( ! empty( $term_parents ) ) {

						foreach ( $term_parents as $parent_id ) {
							$term         = get_term( $parent_id );
							$parent_links .= '<a href="' . esc_url( get_term_link( $term->id ) ) . '" title="Go to' . $term->name . '">' . $term->name . '</a>&nbsp;/&nbsp;';
						}
					}

				}

				$h3 = $parent_links . $term_links;

				break;
			case 'page':
				$h3 = get_the_title( $post->ID );
				break;
			default:
				break;


		}
	}

	if( is_archive() ){
		$term = get_queried_object();
		$h3 = $term->name;
	}

	return $h3;

}

function get_futurelab_header_h1( $post ) {

	$h1 = '';

	if( is_single() || is_page()  ) {
		switch ( $post->post_type ) {

			case 'fl_services':

				if ( $post->post_parent == 0 ) {
					$h1 = get_post_meta( $post->ID, 'fl_page_headline', true );
				} else {
					$h1 = get_the_title( $post->ID );
				}

				break;
			case 'post':
				$h1 = esc_html( the_title() );
				break;
			case 'page':
				$h1 = esc_html( get_post_meta( $post->ID, 'fl_page_headline', true ) );
				break;
			default:
				break;

		}
	}

	if( is_archive() ){
		$term = get_queried_object();
		$h1 = term_description( $term->ID );
	}

	return $h1;

}

/*
 * Returns the contents of the h2 tag for the banner header, based on post type.
 * NB: Do NOT escape - this may contain HTML.
 */
function get_futurelab_header_h2( $post ) {

	$h2 = '';

	if( is_single() || is_page() ) {
		switch ( $post->post_type ) {

			case 'fl_services':
			case 'post':
			case 'page':
				$h2 = get_post_meta( $post->ID, 'fl_page_subheadline', true );
				break;
			default:
				break;

		}
	}

	if( is_archive() ){

		$term = get_queried_object();
		$h2 = '';

	}

	return $h2;
}

