<?php
/**
 * KabelStar
 *
 * This file autoload the woocommerce specific files.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/**
 * Loads non admin files.
 *
 * @since 1.0.1
 *
 * @return void
 */
function load_woocommerce_files() {
	$filenames = array(
		'woocommerce/woocommerce-setup.php',// Add WooCommerce support.
		'woocommerce/woocommerce-output.php',// Add the required WooCommerce styles and Customizer CSS.
		'woocommerce/woocommerce-notice.php',// Add the Genesis Connect WooCommerce notice.
//		'woocommerce/template-functions.php',// Add the Genesis Connect WooCommerce notice.
	);
	load_specified_files( $filenames );
}

load_woocommerce_files();
