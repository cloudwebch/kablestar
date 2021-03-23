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

function above_product(){
	global $product;


	d($product->get_stock_quantity());
	d($product->get_stock_status());
	printf('<div class="above-product-info">
<div class="above-product-category">%s</div>
<div class="above-product-stock">Stock</div>
</div>', $product->get_categories());
}
