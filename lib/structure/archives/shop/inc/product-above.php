<?php
/**
 * KabelStar
 *
 * Create above product content (category and stock)
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function above_product() {
	global $product;
	//rosu - out off stock = 0
	//galben - less than 10
	//verde - more than 10
//	$stock_qty   = $product->get_stock_quantity();
	$stock_class = get_stock_icon_class( $product );
//	switch ( $stock_qty ) {
//		case 0:
//			$stock_class = 'stock-icon-red';
//			break;
//		case ( $stock_qty > 0 && $stock_qty <= 10 ) :
//			$stock_class = 'stock-icon-yellow';
//			break;
//		default :
//			$stock_class = 'stock-icon-green';
//			break;
//
//	}
//
//
//	d($product->get_stock_quantity());
//	d($product->get_stock_status());
	printf( '<div class="above-product-info">
<div class="above-product-category">%s</div>
<div class="above-product-stock">
<span class="stock-icon %s"><i></i></span>
</div>
</div>', $product->get_categories(), $stock_class );
}
