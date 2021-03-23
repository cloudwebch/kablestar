<?php
/**
 * KabelStar
 *
 * This file autoload the archives shop files.
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
function load_shop_archive_files() {
	$filenames = array(
		'structure/archives/shop/inc/product-above.php',
	);
	load_specified_files( $filenames );
}

load_shop_archive_files();
