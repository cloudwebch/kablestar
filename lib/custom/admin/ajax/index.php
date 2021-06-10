<?php

/**
 * KabelStar
 *
 * @package KabelStar
 * @snippet AJAX Event Handlers
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */


namespace CloudWeb\KabelStar;

/**
 * Loads ajax handlers files.
 *
 * @since 1.0.1
 *
 * @return void
 */
function load_ajax_handlers_files() {
	$filenames = array(
		'custom/admin/ajax/featured-day.php',
		'custom/admin/ajax/featured-week.php',
		'custom/admin/ajax/last-seen-products.php',
		'custom/admin/ajax/infinite-scroll.php',
	);
	load_specified_files( $filenames );
}

load_ajax_handlers_files();
