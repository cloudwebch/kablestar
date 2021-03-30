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
	$index = 0;
	$output = '<div class="featured-articles">';
	$blog_posts = get_site_posts('post', $args);
	foreach ($blog_posts->posts as $post){
		if($index === 0){
			$output .= '<div class="featured-articles-slider" rel="slider">';
		}


		if($index === 2){
			$output = '</div><div class="featured-articles-secondary">';
		}

		if($index === $blog_posts->post_count){
			$output = '</div>';
		}
		$index++;
	}
	$output .= '<div>';
	d($blog_posts);
}
