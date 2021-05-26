<?php
/**
 * KabelStar
 *
 * This file adds front page structure files - the featured products section.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

function get_featured_products() {
	$html        = '<div class="featured-products">';
	$meta_query  = \WC()->query->get_meta_query();
	$tax_query   = \WC()->query->get_tax_query();
	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
	);
	$args        = array(
		'stock'      => 1,
		'showposts'  => 2,
		'orderby'    => 'date',
		'order'      => 'DESC',
		'meta_query' => $meta_query,
		'tax_query'  => $tax_query,
	);

	$featured_products = get_site_posts( 'product', $args );

	if ( ! $featured_products->have_posts() ) {
		printf( '%s', __( 'No featured products to show', 'kabelstar' ) );

		return false;
	}

	while ( $featured_products->have_posts() ) {
		$featured_products->the_post();
		$product_id    = \get_the_ID();
		$product_image = get_the_featured_image( $product_id, 'featured-product' );
		$product       = new \WC_Product( $product_id );
//		$product_price = $product->get_price();
		$product_price = $product->get_price_html();
		$product_name  = $product->get_name();
		$product_url   = get_permalink( $product->get_id() );
		//more product methods here - https://www.businessbloomer.com/woocommerce-easily-get-product-info-title-sku-desc-product-object/

		$html .= sprintf( '<div class="featured-product">
<a href="%s" title="%s">
<div class="featured-product-visual">
%s
</div>
<div class="featured-product-title">
<span>- Small Text - </span>
<h3>%s</h3>
</div>
</a>
</div>',
			\esc_url( $product_url ),
			esc_attr( $product_name ),
			$product_image,
			$product_name );
	}
	\wp_reset_query();

	$html .= '</div>';

//	d( $featured_products );

	return $html;

}
