<?php
/**
 * KabelStar
 *
 * This file adds front page "blocks"
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;


function get_center_section() {
	$get_the_slider        = get_the_slider();
	$get_featured_products = get_featured_products();
	return sprintf( '<div class="front-page-section-main">%s %s</div>',
		$get_the_slider,
		$get_featured_products
	);
}

function get_aside_section() {
	$get_side_product_of_the_day  = get_side_product_of_the_day();
	$get_side_product_of_the_week = get_side_product_of_the_week();
	return sprintf('<aside class="sidebar sidebar-front">%s %s</aside>',
		$get_side_product_of_the_day,
		$get_side_product_of_the_week);
}

function get_front_page_entry_content(){
	$get_center_section = get_center_section();
	$get_aside_section = get_aside_section();
	printf('<div class="front-page-section">%s%s</div>',
		$get_center_section,
		$get_aside_section
	);
}
