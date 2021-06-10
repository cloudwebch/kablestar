<?php
/**
 * KabelStar
 *
 * This file autoload the product archives files.
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
function load_product_archive_files() {
	$filenames = array(
		'structure/archives/product/inc/after-loop.php',
//		'structure/archives/product/inc/sidebar.php',
	);
	load_specified_files( $filenames );
}

load_product_archive_files();
