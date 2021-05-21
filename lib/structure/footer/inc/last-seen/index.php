<?php
/**
 *
 * Footer last watched products.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_action( 'template_redirect', __NAMESPACE__ . '\track_product_view', 20 );

function track_product_view() {
	if ( ! is_singular( 'product' ) ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
	}

	if ( ! in_array( $post->ID, $viewed_products ) ) {
		$viewed_products[] = $post->ID;
	}

	if ( sizeof( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

function get_last_seen_products() {
	$last_seen_products = last_seen_products();
	if ( ! $last_seen_products ) {
		return false;
	}
	ob_start();
	include __DIR__ . '/views/index.php';
	echo \ob_get_clean();

}

function last_seen_products() {
	$output              = '';
	$viewed_products_raw = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
	$viewed_products     = array_reverse( array_filter( array_map( 'absint', $viewed_products_raw ) ) );

	if ( ! $viewed_products ) {
		return false;
	}
//	d($viewed_products);
	$args = array(
		'posts_per_page' => 10,
		'post__in'       => $viewed_products,
//		'orderby'        => 'rand'
	);

	// Add meta_query to query args
	$args['meta_query'] = array();

	// Check products stock status
	$args['meta_query'][] = \WC()->query->stock_status_meta_query();

	$products = get_site_posts( 'product', $args );
//	d( $products );
	if ( ! $products->have_posts() ) {
		return false;
	}
	ob_start();
	while ( $products->have_posts() ) {
		$products->the_post();
		$product_id    = \get_the_ID();
		$product_image = get_the_featured_image( $product_id, 'last-seen' );
		$product       = new \WC_Product( $product_id );
		$product_price = is_decimal( $product->get_price() ) ? $product->get_price() : sprintf( '%s.–', $product->get_price() );
		$product_name  = $product->get_name();
		$product_url   = get_permalink( $product->get_id() );

		$output .= sprintf( '<div class="last-seen-product" data-product-id="%s">
		<a href="%s" title="%s">
			<div class="last-seen-product-visual">%s</div>
			<div class="last-seen-product-price"><span>%s</></div>
			<div class="last-seen-product-title"><h4>%s</h4></div>
			</div></a>',
			$product_id,
			esc_url( $product_url ),
			esc_attr( $product_name ),
			$product_image,
			$product_price,
			get_first_word( $product_name )
		);
	}

	\wp_reset_query();

//	d( $viewed_products );
	$output .= \ob_get_clean();

	return $output;

}
