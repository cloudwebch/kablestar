<?php
/**
 * KabelStar
 *
 * This file autoload the theme specific files.
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
function load_theme_files() {
	$filenames = array(
		'functions/theme/theme-support.php',// Add theme support functions.
		'functions/theme/add-image-sizes.php',
		'functions/theme/custom-logo.php',// Include Custom logo replacement for Header Image.
		'functions/theme/customize.php',// Add Image upload and Color select to WordPress Theme Customizer.
		'functions/theme/genesis-adjustments.php',// Include Genesis adjustments.
		'functions/theme/login-logo.php',// Include login logo replacement.
		'functions/theme/menus.php',// Add our responsive menu settings.
		'functions/theme/optional-acf-settings-page.php',
		'functions/theme/output.php',// Include Customizer CSS.
//		'functions/theme/speed-tuning.php',// Add speed tuning functions.
		'functions/theme/theme-defaults.php',
		'functions/theme/widgets.php',// Add widgets.
	);
	load_specified_files( $filenames );
}

load_theme_files();
