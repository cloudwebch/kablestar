<?php
/**
 * KabelStar
 *
 * woocommerce_single_product_carousel_options Callback.
 *
 * Change single product gallery slider
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


add_filter( 'woocommerce_single_product_carousel_options', __NAMESPACE__ . '/single_product_carousel_options' );

function single_product_carousel_options( $options ) {
	$options['directionNav'] = true;
	$options['slideshow']    = true;
	$options['controlNav']   = 'dots';
//	$options['animationLoop']   = true;

	return $options;
}

add_filter( 'woocommerce_gallery_image_size', function( $size ) {
	return array(
		'width' => 810,
		'height' => 626,
		'crop' => 0,
	);
} );

add_filter( 'woocommerce_gallery_full_size', function( $size ) {
	return array(
		'width' => 1400,
		'height' => 824,
		'crop' => 0,
	);
} );
