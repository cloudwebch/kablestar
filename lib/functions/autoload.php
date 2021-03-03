<?php
/**
 * File autoloader
 *
 * We could use Composer, but it feels a bit heavy for the number of files we need to load up.  As this is procedural
 * and not OOP, we can handle loading the files directly right here in this file.  Now to add more files to be loaded,
 * well shucks you can do that right here.  A function is provided for each folder.
 *
 * Resist the temptation to add widgets, custom post types, taxonomies, and/or shortcodes in your theme.  Those features
 * go into a plugin and not in your theme.  If you put them here, I want you to picture me shaking my head back and
 * forth.  Come on....I taught you better than that.
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

/**
 * Loads non admin files.
 *
 * @since 1.0.1
 *
 * @return void
 */
function load_nonadmin_files() {
	$filenames = array(
		'setup.php',
		'functions/helpers.php',// Add the helper functions.
		'functions/load-assets.php',// Add the assets and enqueue styles and scripts.
		'functions/theme/theme-support.php',// Add theme support functions.
		'functions/theme/add-image-sizes.php',
		'functions/theme/custom-logo.php',// Include Custom logo replacement for Header Image.
		'functions/theme/customize.php',// Add Image upload and Color select to WordPress Theme Customizer.
		'functions/theme/genesis-adjustments.php',// Include Genesis adjustments.
		'functions/theme/login-logo.php',// Include login logo replacement.
		'functions/theme/menus.php',// Add our responsive menu settings.
		'functions/theme/optional-acf-settings-page.php',
		'functions/theme/output.php',// Include Customizer CSS.
		'functions/theme/speed-tuning.php',// Add speed tuning functions.
		'functions/theme/theme-default.php',
		'functions/theme/widgets.php',// Add widgets.
		'functions/woocommerce/woocommerce-setup.php',// Add WooCommerce support.
		'functions/woocommerce/woocommerce-output.php',// Add the required WooCommerce styles and Customizer CSS.
		'fucntions/woocommerce/woocommerce-notice.php',// Add the Genesis Connect WooCommerce notice.
		'functions/filters.php',
//		'functions/register-post-type.php',
		'functions/templates.php',
		// 'structure/structure.php',
	);
	load_specified_files( $filenames );
}


/**
 * Load each of the specified files.
 *
 * @since 1.0.0
 *
 * @param array $filenames
 * @param string $folder_root
 *
 * @return void
 */
function load_specified_files( array $filenames, $folder_root = '' ) {
	$folder_root = $folder_root ?: CHILD_THEME_DIR . '/lib/';

	foreach( $filenames as $filename ) {
		include( $folder_root . $filename );
	}
}

load_nonadmin_files();
