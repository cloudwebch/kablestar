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
//	$options['smoothHeight']   = false;
//	$options['animationLoop']   = true;

	return $options;
}


add_filter( 'woocommerce_gallery_image_size', function(){
	return 'product_gallery';
} );

add_filter( 'woocommerce_gallery_full_size', function(){
	return 'product_lightbox';
} );

add_filter( 'woocommerce_product_thumbnails_large_size', function(){
	return 'product_lightbox';
} );

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
		'width'  => 310,
		'height' => 182,
		'crop'   => 1,
	);
} );

function filter_woocommerce_single_product_image_thumbnail_html( $sprintf, $post_id ) {
//	d($sprintf);
	$search = 'class="woocommerce-product-gallery__image"><a';
	$replace = 'class="woocommerce-product-gallery__image"><a data-fancybox="images" data-type="image"';

	return str_replace ($search, $replace, $sprintf);;
};

// add the filter
add_filter( 'woocommerce_single_product_image_thumbnail_html', __NAMESPACE__ . '\filter_woocommerce_single_product_image_thumbnail_html', 10, 2 );
