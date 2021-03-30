<?php
/**
 * KabelStar
 *
 * Modify variable prices.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


//add_filter( 'woocommerce_variable_sale_price_html', __NAMESPACE__ . '\variations_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', __NAMESPACE__ . '\variations_price_format', 10, 2 );

function variations_price_format( $price, $product ) {

// Main Price
	$main_prices = array( $product->get_variation_price( 'min', true ) * 1, $product->get_variation_price( 'max', true ) *1 );
//	d($prices);
//	d(clean_num($prices[0]));
//	d(clean_num($prices[1]));
	$price = $main_prices[0] !== $main_prices[1] ?
		sprintf( __( 'ab: %1$s', 'kabelstar' ),
			(is_decimal($main_prices[0] ) ? \wc_price( $main_prices[0] ) : sprintf('%s.–', $main_prices[0]) )) : (is_decimal($main_prices[0] ) ? \wc_price( $main_prices[0] ) : sprintf('%s.–', $main_prices[0]));

// Sale Price
	$sales_prices = array( $product->get_variation_regular_price( 'min', true ) * 1, $product->get_variation_regular_price( 'max', true ) * 1 );
	sort( $sales_prices );
	$saleprice =
		$sales_prices[0] !== $sales_prices[1] ?
			sprintf( __( 'ab: %1$s', 'kabelstar' ), (is_decimal($sales_prices[0] ) ? \wc_price( $sales_prices[0] ) : sprintf('%s.–', $sales_prices[0]) )) :
			(is_decimal($sales_prices[0] ) ? \wc_price( $sales_prices[0] ) : sprintf('%s.–', $sales_prices[0]));

	if ( $price !== $saleprice ) {
		$percentage = round( ( ( $sales_prices[0] - $main_prices[0] ) / $sales_prices[0] ) * 100 );
//		d('$main_prices[0]', $main_prices);
//		d('$main_prices[1]', $main_prices[1]);
//		d('$sales_prices[0]', $sales_prices);
//		d('$sales_prices[1]', $sales_prices[1]);
//		d($percentage);
		$percentage_html = sprintf('<span class="onsale">-%s%%</span>', $percentage);
		$price = $percentage_html . ' <ins>' . $price . '</ins>';
	}
	return $price;
}

add_filter( 'woocommerce_available_variation', __NAMESPACE__ . '\add_custom_price_field_variation_data' );

function add_custom_price_field_variation_data( $variations ) {
	global $product;
	$product_variation = new \WC_Product_Variation($variations['variation_id']);
	$regular_price = $product_variation->get_regular_price();
	$sale_price = $product_variation->get_sale_price();

	$price = $sale_price ? $sale_price : $regular_price;
//d($regular_price);
//d($sale_price);
	$variations['custom_price'] = sprintf('<span class="price"><span class="woocommerce-Price-amount amount"><bdi>%s</bdi></span></span>',
		is_decimal( $regular_price ) ? $price : sprintf('%s.–', $price)
	)
	;
//	d($variations);
	return $variations;
}
