<?php
/**
 * KabelStar
 *
 * This file autoload the structure specific files.
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
function load_structure_files() {
	$filenames = array(
		'structure/header/index.php',
		'structure/front-page/index.php',
	);
	load_specified_files( $filenames );
}

load_structure_files();
