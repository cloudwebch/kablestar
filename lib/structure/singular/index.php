<?php
/**
 * KabelStar
 *
 * This file autoload the singular  files.
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
function load_singular_files() {
	$filenames = array(
		'structure/singular/post/index.php',
	);
	load_specified_files( $filenames );
}

load_singular_files();
