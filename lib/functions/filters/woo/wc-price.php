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

function wc_price($return, $price, $args, $unformatted_price){
//d($price);
	$negative          = $price < 0;
	$formatted_price = ( $negative ? '-' : '' ) . sprintf( '%s', is_decimal( $price ) ? $price : sprintf('%s.–', $price) );
	$return          = '<span class="woocommerce-Price-amount amount"><bdi>' . $formatted_price . '</bdi></span>';

	return $return;
}
