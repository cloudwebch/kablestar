<?php
/**
 * KabelStar
 *
 * This file adds the custom logo functions to replace header image used in the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_action( 'genesis_theme_settings_metaboxes', __NAMESPACE__ . '\remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 1.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', __NAMESPACE__ . '\remove_customizer_settings' );
/**
 * Removes output of header settings in the Customizer.
 *
 * @since 1.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );
