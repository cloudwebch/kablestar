<?php
/**
 * KabelStar
 *
 * woocommerce_format_sale_price Callback.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

//add_filter( 'woocommerce_get_price_suffix', __NAMESPACE__ . '\add_price_suffix', 99, 4 );

//function add_price_suffix( $html, $product, $price, $qty ){
//	d($price);
//	$html .= ' suffix';
//	return $html;
//}

//add_filter( 'woocommerce_get_price_html', __NAMESPACE__ . '\add_price_prefix', 99, 2 );
//
//function add_price_prefix( $price, $product ){
//	d($price);
//	$price = $price . 'Prefix';
//	return $price;
//}

function format_sale_price($price, $regular_price, $sale_price){
	global $product;

	if ( $product->is_type( 'variable' ) ) {
		return false;
	}
	$price = '<del>' . ( is_decimal( $regular_price ) ? wc_price( $regular_price ) : sprintf('%s.–', $regular_price) ) . '</del> <ins>' . ( is_decimal( $sale_price ) ? wc_price( $sale_price ) : sprintf('%s.–', $sale_price) ) . '</ins>';

	return $price;
}
