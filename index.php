<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package futurelab_base
 */

get_header();

?>

    <div id="primary" class="content-area grid-container full">
        <main id="main" class="site-main">

			<div class="entry-content">
				<?php 
					$args = array(
						'posts_per_page'   => '12',
						'post_status'      => 'publish',
						// 'order'            => $attributes['order'],
						// 'orderby'          => $attributes['orderBy'],
						'suppress_filters' => false,
					);
				
					// if (isset($attributes['categories'])) {
					// 	$args['category'] = $attributes['categories'];
					// }
				
					$recent_posts = get_posts($args);
				
					$list_items_markup = '';
				
					$excerpt_length = '50';
				
					foreach ($recent_posts as $post) {
				
						$thumbnail = get_the_post_thumbnail($post, 'large'); // change to "large" because i need image to cover the full column, Hank
						if (empty($thumbnail)) {
							$thumbnail = '<div class="image-placeholder"></div>';
						}
				
						$title = get_the_title($post);
						if (!$title) {
							$title = __('(Untitled)');
						}
						$list_items_markup .= '<li class="post-item">';
				
						$list_items_markup .= sprintf(
							'<a class="post-image" href="%1$s">%2$s</a>',
							esc_url(get_permalink($post)),
							$thumbnail
						);
				
						$list_items_markup .= sprintf(
							'<div class="post-more-arrow"></div>'
						);
				
						$list_items_markup .= '<div class="news-caption">';
				
						$list_items_markup .= sprintf(
							'<div class="post-text-content" style="top: 0px; position: relative;">'
						);
				
						if (isset($attributes['displayPostDate']) && $attributes['displayPostDate']) {
							$list_items_markup .= sprintf(
								'<time datetime="%1$s" class="wp-block-latest-posts__post-date">%2$s</time>',
								esc_attr(get_the_date('c', $post)),
								esc_html(get_the_date('M j, Y', $post))
							);
						}
				
						$list_items_markup .= sprintf(
							'<div class="post-title"><a href="%1$s">%2$s</a></div>',
							esc_url(get_permalink($post)),
							$title
						);
				
						if (
							isset($attributes['displayPostContent']) && $attributes['displayPostContent']
							&& isset($attributes['displayPostContentRadio']) && 'excerpt' == $attributes['displayPostContentRadio']
						) {
							$post_excerpt = $post->post_excerpt;
							if (!($post_excerpt)) {
								$post_excerpt = $post->post_content;
							}
							$trimmed_excerpt = esc_html(wp_trim_words($post_excerpt, $excerpt_length, ' &hellip; '));
				
							$list_items_markup .= sprintf(
								'<div class="wp-block-latest-posts__post-excerpt">%1$s',
								$trimmed_excerpt
							);
				
							if (strpos($trimmed_excerpt, ' &hellip; ') !== false) {
								$list_items_markup .= sprintf(
									'<a href="%1$s">%2$s</a></div>',
									esc_url(get_permalink($post)),
									__('Read More')
								);
							} else {
								$list_items_markup .= sprintf(
									'</div>'
								);
							}
						}
				
						if (
							isset($attributes['displayPostContent']) && $attributes['displayPostContent']
							&& isset($attributes['displayPostContentRadio']) && 'full_post' == $attributes['displayPostContentRadio']
						) {
							$list_items_markup .= sprintf(
								'<div class="wp-block-latest-posts__post-full-content">%1$s</div>',
								wp_kses_post(html_entity_decode($post->post_content, ENT_QUOTES, get_option('blog_charset')))
							);
						}
				
						$list_items_markup .= "</div></li>\n";
					}
				
					$class = 'wp-block-latest-posts wp-block-latest-posts__list is-grid columns-3 has-dates';
					if (isset($attributes['align'])) {
						$class .= ' align' . $attributes['align'];
					}
				
					if (isset($attributes['postLayout']) && 'grid' === $attributes['postLayout']) {
						$class .= ' is-grid';
					}
				
					if (isset($attributes['columns']) && 'grid' === $attributes['postLayout']) {
						$class .= ' columns-' . $attributes['columns'];
					}
				
					if (isset($attributes['displayPostDate']) && $attributes['displayPostDate']) {
						$class .= ' has-dates';
					}
				
					if (isset($attributes['className'])) {
						$class .= ' ' . $attributes['className'];
					}
				
					$block_content = sprintf(
						'<ul class="%1$s">%2$s</ul>',
						esc_attr($class),
						$list_items_markup
					);
				
					echo $block_content; ?>

				</div>
		
		</main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();