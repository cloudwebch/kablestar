<?php
/**
 * KabelStar
 *
 * This file adds speed tuning functions to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

//add_filter( 'script_loader_tag', __NAMESPACE__ . '\js_defer_attr', 10 );
/**
 * Function to add defer to all scripts
 *
 * @param string $tag All script tags.
 */
function js_defer_attr( $tag ) {
	// Add async to all remaining scripts.
	if ( ! is_admin() ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	} else {
		return $tag;
	}
}
