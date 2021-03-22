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

function format_sale_price($price, $regular_price, $sale_price){
	$price = '<del>' . ( is_decimal( $regular_price ) ? wc_price( $regular_price ) : sprintf('%s.–', $regular_price) ) . '</del> <ins>' . ( is_decimal( $sale_price ) ? wc_price( $sale_price ) : sprintf('%s.–', $sale_price) ) . '</ins>';

	return $price;
}
