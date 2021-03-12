<?php
/**
 * KabelStar
 *
 * This file adds header structure files.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads header files.
 *
 * @return void
 * @since 1.0.1
 *
 */
function load_header_files() {
	$filenames = array(
		'structure/header/inc/product-search-box.php',
		'structure/header/inc/login-logout.php',
	);
	load_specified_files( $filenames );
}

load_header_files();

