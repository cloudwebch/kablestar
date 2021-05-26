<?php
/**
 * KabelStar
 *
 * Create sorting filters and view mode
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function create_sorting_and_view(){
//	$product_sort = product_sort();
	$view_mode = view_mode();
//	printf("<div class='sorting'>%s\n%s</div>", $product_sort, $view_mode);
	printf("<div class='sorting'>%s</div>", $view_mode);
}

//function product_sort(){
//	return sprintf('<div class="sorting-filters">Sorting Boxes</div>');
//}

function view_mode(){
	ob_start();
	include_once __DIR__ . '/views/view-mode.php';
	return \ob_get_clean();
}
