<?php
/**
 * Setup KableStar theme
 *
 * @package  KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

// REMOVE WP EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
// Remove rsd link
remove_action( 'wp_head', 'rsd_link' );
// Remove Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link' );
// Index link
remove_action( 'wp_head', 'index_rel_link' );
// Previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// Remove WP version
remove_action( 'wp_head', 'wp_generator' );

if ( ! is_admin() || ! is_admin_bar_showing() ) {
	add_filter( 'script_loader_src', __NAMESPACE__ . '\remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', __NAMESPACE__ . '\remove_script_version', 15, 1 );
}

// Remove version number from js and css
function remove_script_version( $src ) {
	if ( preg_match( "(\?ver=)", $src ) ) {
		$parts = explode( '?', $src );

		return $parts[0];
	} else {
		return $src;
	}
}




add_action( 'genesis_meta', __NAMESPACE__ . '\site_page_layout' ); // templates.php
add_action( 'genesis_setup', __NAMESPACE__ . '\setup', 15 );
/**
 * Setup child theme.
 *
 * @return void
 * @since 1.0.0
 *
 */
function setup() {
	load_child_theme_textdomain( 'genesis-webpack-replace', apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', 'genesis-webpack-replace' ) );
	adds_theme_supports();
	adds_new_image_sizes();
}


////* Remove the header right widget area
// unregister_sidebar( 'header-right' );

//* Unregister secondary sidebar
// unregister_sidebar( 'sidebar-alt' );







