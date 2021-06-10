<?php
/**
 *
 * @package     CloudWeb\KabelStar
 * @since       1.0.0
 * @author      @valentin cloudweb team
 * @link        https://www.cloudweb.ch
 * @license     GNU General Public License 2.0+
 */

namespace CloudWeb\KabelStar;

add_action( 'wp_ajax_get_latest_seen_products', __NAMESPACE__ . '\get_latest_seen_products' );
add_action( 'wp_ajax_nopriv_get_latest_seen_products', __NAMESPACE__ . '\get_latest_seen_products' );

function get_latest_seen_products(){
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'last_seen_products') ) {
		echo json_encode( 'No naughty business please' );
		wp_die();
	}

	$viewed_products_raw = ! empty( $_GET['products'] ) ? (array) explode( '\",', wp_unslash( $_GET['products'] ) ) : array();
	$viewed_products     = array_reverse( array_filter( array_map( 'absint', json_decode($viewed_products_raw[0]) ) ) );

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
//		$product_price = is_decimal( $product->get_price() ) ? $product->get_price() : sprintf( '%s.–', $product->get_price() );
		$product_price = $product->get_price_html();
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

	\wp_send_json_success( $output );

	wp_die();
}
