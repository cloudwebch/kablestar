<?php
/**
 * KabelStar
 *
 * Front page posts slider and regular ones.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_front_page_posts(){
	$args = [
		'posts_per_page' => 5
	];
	$index = 1;
	$output = '<div class="featured-articles">';
	$blog_posts = get_site_posts('post', $args);
	foreach ($blog_posts->posts as $post){
//		d($index);
		$class = $index < 4 ? 'slide-article' : 'regular-article';
		$image_size = $index < 4 ? 'front-slide' : 'featured-product';
		$post_id = $post->ID;
		$image = get_the_featured_image( $post_id, $image_size );
		$categories = get_the_category($post_id);
		if($index === 1){
			$output .= '<div class="featured-articles-slider" rel="slider">';
		}
		if($index === 4){
			$output .= '</div><div class="featured-articles-secondary">';
		}

		$output .= sprintf('
		<a class="featured-article %s" href="%s" title="%s">
			<div class="featured-article-visual">%s</div>
			<div class="featured-article-excerpt">
				%s
				<h2>%s</h2>
			</div>
		</a>
		
		', $class,
			get_permalink($post_id),
			the_title_attribute( ['echo' =>false, 'post' => $post_id] ),
			$image,
			$categories ? sprintf('<span>%s</span>', $categories[0]->name ) : '',
		get_the_title($post_id)
		);



		if($index === $blog_posts->post_count) {
//			d($blog_posts->post_count);
			$output .= '</div>';
		}

		$index++;
	}
	\wp_reset_query();
	$output .= '</div>';
	return $output;
//	d($blog_posts);
}
