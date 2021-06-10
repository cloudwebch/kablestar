<?php
/**
 *
 * This file adds footer structure files.
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
function load_footer_files() {
	$filenames = array(
		'structure/footer/inc/last-seen/index.php',
		'structure/footer/inc/sticky-add-cart/index.php',
	);
	load_specified_files( $filenames );
}

load_footer_files();
