<?php
/**
 * KabelStar
 *
 * woocommerce_sale_flash Callback.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_filter('woocommerce_sale_flash', __NAMESPACE__ . '\sale_flash', 10, 2);

function sale_flash($post, $product){
	global $product;
	$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
	return sprintf('<span class="onsale">-%s%%</span>', $percentage);
}
