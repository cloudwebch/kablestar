<?php
/**
 * KabelStar
 *
 * Header structure files - product search box
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_product_search_box(){
	ob_start();
	 get_product_search_form();
	$search_form = \ob_get_clean();

	printf('<div class="product-search-box">%s</div>', $search_form);

}
