<?php
/**
 * KabelStar
 *
 * This file adds featured image to single post.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


function singular_post_featured_image(){
	$featured_image = get_the_featured_image( \get_the_ID(), $size = 'post' );
	printf('<div class="featured-post-image">%s</div>', $featured_image);
}
