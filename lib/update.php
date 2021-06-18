<?php
/**
 * Setup KabelStar theme
 *
 * @package  KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}
//set_site_transient( 'update_themes', null );
/******************Change this*******************/
//$api_url = 'https://thenextstep.ch/update-api/';
/************************************************/

/*******************Child Theme******************
 * //Use this section to provide updates for a child theme
 * //If using on child theme be sure to prefix all functions properly to avoid
 * //function exists errors
 **************************************************/
//if ( function_exists( 'wp_get_theme' ) ) {
//	$theme_data    = wp_get_theme( get_option( 'stylesheet' ) );
//	$theme_version = $theme_data->Version;
//} else {
//	$theme_data    = get_theme_data( get_stylesheet_directory() . '/style.css' );
//	$theme_version = $theme_data['Version'];
//}
//$theme_base = get_option( 'stylesheet' );


//Uncomment below to find the theme slug that will need to be setup on the api server
//d('test', $theme_base);

add_filter( 'pre_set_site_transient_update_themes', __NAMESPACE__ . '\check_for_update' );

function check_for_update( $checked_data ) {
	global $wp_version;
	$theme   = wp_get_theme();
	$api_url = 'https://thenextstep.ch/update-api/index.php';
	$theme_slug = strtolower( $theme->get( 'Name' ) );
	$request = array(
		'slug'    => $theme_slug,
		'version' => $theme->get( 'Version' )
	);

	// Start checking for an update
	$send_for_check = array(
		'body'       => array(
			'action'  => 'theme_update',
			'request' => serialize( $request ),
			'api-key' => md5( home_url( '/' ) )
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
	);
	$raw_response   = \wp_remote_post( $api_url, $send_for_check );

//		var_dump('$send_for_check', $send_for_check);
//	var_dump( 'response body', $raw_response['body'] );

	if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
		$response = unserialize( $raw_response['body'] );
	}

//	var_dump( '$response', $response );

	// Feed the update data into WP updater
	if (  $response ) {
		$checked_data->response[ $theme_slug  ] = $response;
	}
//var_dump('$checked_data', $checked_data);
	return $checked_data;
}

// Take over the Theme info screen on WP multisite
//add_filter( 'themes_api', __NAMESPACE__ . '\theme_api_call', 10, 3 );
//
//function theme_api_call( $def, $action, $args ) {
//	$theme   = wp_get_theme();
//	$api_url = 'https://thenextstep.ch/update-api/index.php';
//
//	if ( $args->slug != strtolower( $theme->get( 'Name' ) ) ) {
//		return false;
//	}
//
//	// Get the current version
//
//	$args->version  = $theme->get( 'Version' );
//	$request_string = prepare_request( $action, $args );
//	$request        = wp_remote_post( $api_url, $request_string );
//
//	if ( is_wp_error( $request ) ) {
//		$res = new \WP_Error( 'themes_api_failed', __( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
//	} else {
//		$res = unserialize( $request['body'] );
//
//		if ( $res === false ) {
//			$res = new \WP_Error( 'themes_api_failed', __( 'An unknown error occurred' ), $request['body'] );
//		}
//	}
//
//	return $res;
//}

if ( is_admin() ) {
	$current = get_transient( 'update_themes' );
}
?>
