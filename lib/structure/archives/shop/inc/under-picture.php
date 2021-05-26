<?php
/**
 * KabelStar
 *
 * Wrapper for product price, title, on sale, reviews and cart button
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function product_details_wrapper(){
	global $product;
	$average = $product->get_average_rating();
	include __DIR__ . '/views/details-wrapper.php';
}
