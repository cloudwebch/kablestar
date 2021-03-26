<?php
/**
 * KabelStar
 *
 * This file adds theme filters.
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
function load_theme_filters_files() {
	$filenames = array(
		'functions/filters/woo/format-sale-price.php',
		'functions/filters/woo/wc-price.php',
		'functions/filters/woo/sale-flash.php',
		'functions/filters/woo/single-product-carousel-options.php',
		'functions/filters/theme/breadcrumb.php',
		'functions/filters/theme/primary-menu-items.php',
		'functions/filters/theme/author-avatar.php',
	);
	load_specified_files( $filenames );
}

load_theme_filters_files();
