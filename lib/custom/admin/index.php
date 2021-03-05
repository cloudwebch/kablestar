<?php

/**
 * KabelStar
 *
 * This file adds add new admin functionalities
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads admin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_custom_admin_files() {
	$filenames = array(
		'custom/admin/product-custom-columns/index.php',
		'custom/admin/ajax/index.php',
	);
	load_specified_files( $filenames );
}

load_custom_admin_files();
