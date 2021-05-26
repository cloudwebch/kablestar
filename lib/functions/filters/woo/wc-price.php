<?php
/**
 * KabelStar
 *
 * wc_price Callback.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

//function wc_price($return, $price, $args, $unformatted_price){
////d($price);
//	$negative          = $price < 0;
//	$formatted_price = ( $negative ? '-' : '' ) . sprintf( '%s', is_decimal( $price ) ? $price : sprintf('%s.–', $price) );
//	$return          = '<span class="woocommerce-Price-amount amount"><bdi>' . $formatted_price . '</bdi></span>';
//
//	return $return;
//}

//function cw_change_product_price_display( $price ) {
//	d($price);
//	$price .= ' At Each Item Product';
//	return $price;
//}
//add_filter( 'woocommerce_get_price_html', __NAMESPACE__ . '\cw_change_product_price_display' );
//add_filter( 'woocommerce_cart_item_price', __NAMESPACE__ . '\cw_change_product_price_display' );
