<?php
/**
 * KabelStar
 *
 * This file adds front page structure files - side products
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
function load_side_products_files() {
	$filenames = array(
		'structure/front-page/inc/side/highlight-day/index.php',
		'structure/front-page/inc/side/highlight-week/index.php',
	);
	load_specified_files( $filenames );
}

load_side_products_files();
