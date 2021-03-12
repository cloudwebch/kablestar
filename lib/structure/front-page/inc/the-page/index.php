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

function get_latest_products(){
	$html = '<div class="latest-products" rel="latest-products">';
	$args = array(
		'orderby'    => 'date',
		'order'      => 'DESC',
		'posts_per_page' => 8
	);

	$latest_products = get_site_posts( 'product', $args );
//	d($latest_products);
	if( !$latest_products->have_posts() ){
		printf( '%s', __( 'No products to show', 'kabelstar' ) );
		return false;
	}
	while ( $latest_products->have_posts() ) {
		$latest_products->the_post();
		$product_id    = \get_the_ID();
		$product_image = get_the_featured_image( $product_id, 'woocommerce_thumbnail' );
		$product       = new \WC_Product( $product_id );
		$product_price = is_decimal($product->get_price()) ? $product->get_price() : sprintf('%s.–', $product->get_price());
		$product_name  = $product->get_name();
		$product_url   = get_permalink( $product->get_id() );
//d($product_image);
//		d(is_decimal($product_price));
		$html .= sprintf('
			<div class="latest-product">
				<a href="%1$s" title="%2$s">
					<div class="latest-product-visual">
						%4$s
					</div>
					<div class="latest-product-details">
						<span>%3$s</span>
						<h4>%5$s</h4>
					</div>
				</a>
</div> 
		',
			$product_url,
			$product_name,
			$product_price,
			$product_image,
			get_first_word($product_name));

	}

	\wp_reset_query();
	$html .= '</div>';

	echo $html;
}

function get_front_page_entry_content(){
	$get_center_section = get_center_section();
	$get_aside_section = get_aside_section();
	printf('<div class="front-page-section">%s%s</div>',
		$get_center_section,
		$get_aside_section
	);
}
