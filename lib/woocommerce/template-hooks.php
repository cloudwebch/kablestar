<?php
/**
 * KabelStar
 *
 * This file adds and remove woocommerce hooks.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

include_once __DIR__ . '/hooks/index.php';
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
\add_filter('woocommerce_short_description', '__return_false');
add_filter( 'woocommerce_attribute_label', __NAMESPACE__ .'\custom_attribute_label', 10, 3 );
add_filter( 'raw_woocommerce_price', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_product_get_price', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_product_get_regular_price', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_product_variation_get_price', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_product_variation_get_regular_price', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_get_price_excluding_tax', __NAMESPACE__ . '\round_price_product', 1000, 1 );
add_filter( 'woocommerce_get_price_including_tax', __NAMESPACE__ . '\round_price_product', 1000, 1 );
//add_filter( 'woocommerce_tax_round', __NAMESPACE__ . '\round_price_product', 1000, 1 );
function round_price_product( $price ){
	// Return rounded price
//	return round( $price, 2 );
//	return round($price * 2, 0) / 2;
//	return ceil( $price );
	return ceiling($price, 0.05);
}

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action('woocommerce_after_add_to_cart_form', __NAMESPACE__ . '\add_shipping_time');
add_action('after_stock_string', __NAMESPACE__ . '\add_shipping_time');
