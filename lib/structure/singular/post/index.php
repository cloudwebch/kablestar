<?php
/**
 * KabelStar
 *
 * This file autoload the singular post files.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads structures files.
 *
 * @return void
 * @since 1.0.1
 *
 */
function load_singular_post_files() {
	$filenames = array(
		'structure/singular/post/inc/featured-image.php',
		'structure/singular/post/inc/above-header.php',
		'structure/singular/post/inc/post-categories.php',
	);
	load_specified_files( $filenames );
}

load_singular_post_files();
