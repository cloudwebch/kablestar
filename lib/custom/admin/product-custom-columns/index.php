<?php

/**
 * KabelStar
 *
 * This file adds add new admin products columns @ WooCommerce Admin
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
function load_admin_products_columns_files() {
	$filenames = array(
		'custom/admin/product-custom-columns/product-custom-column-day/index.php',
		'custom/admin/product-custom-columns/product-custom-column-week/index.php',
	);
	load_specified_files( $filenames );
}

load_admin_products_columns_files();
