<?php
/**
 * KabelStar
 *
 * This file adds menus to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

// If statement for menu placement.
if ( get_theme_mod( 'navigation_layout_select' ) === 'centered' ) {
	// Add support for right and left menu & rename top menu.
	add_theme_support(
		'genesis-menus',
		array(
			'primary'      => __( 'Above Header Menu', 'KabelStar' ),
			'header-left'  => __( 'Header Left', 'KabelStar' ),
			'header-right' => __( 'Header Right', 'KabelStar' ),
			'secondary'    => __( 'Footer Menu', 'KabelStar' ),
		)
	);
} else {
	// Rename primary and secondary navigation menus.
	add_theme_support(
		'genesis-menus',
		array(
			'primary'   => __( 'Header Menu', 'KabelStar' ),
			'secondary' => __( 'Footer Menu', 'KabelStar' ),
		)
	);
}

/**
 * Define our standard responsive menu settings.
 */
function standard_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'KabelStar' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'KabelStar' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

/**
 * Define our centered logo responsive menu settings.
 */
function centered_logo_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'KabelStar' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'KabelStar' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header-left',
				'.nav-header-right',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

/**
 * Hook menu to left of logo.
 *
 * @since 1.0.0
 */
function header_left_menu() {

	genesis_nav_menu(
		array(
			'theme_location' => 'header-left',
			'depth'          => 2,
		)
	);

}

/**
 * Hook menu to right of logo.
 *
 * @since 1.0.0
 */
function header_right_menu() {

	genesis_nav_menu(
		array(
			'theme_location' => 'header-right',
			'depth'          => 2,
		)
	);

}

/**
 * Reposition the primary navigation menu.
 */
if ( get_theme_mod( 'navigation_layout_select' ) === 'centered' ) {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav', 7 );
	add_action( 'genesis_header', __NAMESPACE__ . '\header_left_menu', 6 );
	add_action( 'genesis_header', __NAMESPACE__ . '\header_right_menu', 9 );
}

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\secondary_menu_args' );
/**
 * Reduce the secondary navigation menu to one level depth.
 *
 * @param array $args Menu arguments.
 */
function secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}
