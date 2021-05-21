<?php
/**
 * KabelStar
 *
 * This file adds front page structure files.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads front page structures files.
 *
 * @since 1.0.1
 *
 * @return void
 */
function load_front_page_files() {
	$filenames = array(
		'structure/front-page/inc/blog-posts/index.php',
//		'structure/front-page/inc/slider/index.php',
//		'structure/front-page/inc/featured-products/index.php',
		'structure/front-page/inc/side/index.php',
		'structure/front-page/inc/the-page/index.php',
	);
	load_specified_files( $filenames );
}

load_front_page_files();
