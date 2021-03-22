<?php
/**
 * KabelStar
 *
 * Above header section
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;
//[post_comments] [post_edit]

function above_header_section(){
	$post_categories = get_the_post_categories();
	printf('<div class="entry-title-above">%s %s</div>', $post_categories, \do_shortcode( '[post_comments]' ));
}
