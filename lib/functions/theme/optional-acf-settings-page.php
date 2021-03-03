<?php
/**
 * Add (optional) Advanced Custom Fields Theme Options Page
 *
 * @package KableStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KableStar;

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/*
 * Create ACF Theme Options Page
*/

// if ( function_exists( 'acf_add_options_page' ) ) {

//	acf_add_options_page( array(
//		'page_title' => 'Theme General Settings',
//		'menu_title' => 'Theme Settings',
//		'menu_slug'  => 'theme-general-settings',
//		'capability' => 'edit_posts',
//		'redirect'   => false
//	) );

//	acf_add_options_sub_page( array(
//		'page_title'  => 'Theme Header Settings',
//		'menu_title'  => 'Header',
//		'parent_slug' => 'theme-general-settings',
//	) );

//	acf_add_options_sub_page( array(
//		'page_title'  => 'Contact Box',
//		'menu_title'  => 'Contact Box',
//		'parent_slug' => 'theme-general-settings',
//	) );

//	acf_add_options_sub_page( array(
//		'page_title'  => 'Theme Footer Settings',
//		'menu_title'  => 'Footer',
//		'parent_slug' => 'theme-general-settings',
//	) );

// }
