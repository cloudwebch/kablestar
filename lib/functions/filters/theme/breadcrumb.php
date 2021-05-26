<?php
/**
 * KabelStar
 *
 * Breadcrumb filter.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function wpseo_breadcrumb_output( $output ) {

	if ( ! is_product() ) {
		return $output;
	}

	$from = sprintf( '<a href="%s/shop/">Shop</a> ˃ ', site_url() );

	$to = '';

	$output = str_replace( $from, $to, $output );


	return $output;
}

function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
	return '<svg width="14" height="14" viewBox="0 0 16 16"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg>';
};

// add the filter
add_filter('wpseo_breadcrumb_separator', __NAMESPACE__ . '\filter_wpseo_breadcrumb_separator', 10, 1);

function breadcrumb_args( $args ) {
//	$args['home'] = 'Homee';
//	$args['list_sep'] = ', ';
//	d($args);
	$args['sep'] = '<svg width="16" height="16" viewBox="0 0 16 16"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg>';
	return $args;
}
